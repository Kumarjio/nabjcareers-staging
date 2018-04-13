<?php

class SJB_Session
{
	public static function init($url)
	{
		$sessionStorage = new SessionStorage();
		session_set_save_handler(
			array($sessionStorage, 'open'),
			array($sessionStorage, 'close'),
			array($sessionStorage, 'read'),
			array($sessionStorage, 'write'),
			array($sessionStorage, 'destroy'),
			array($sessionStorage, 'gc')
		);
		
		$path = SJB_Session::getSessionCookiePath($url);
		SJB_WrappedFunctions::ini_set('session.cookie_path', $path);
		require_once 'Zend/Session.php';
		Zend_Session::start();
	}
	
	public static function getSessionCookiePath($url)
	{
		$url_info = parse_url($url);
		if (empty($url_info['path']))
			return '/';
		
		$path = $url_info['path'];
		if ($path[strlen($path) - 1] != '/')
			$path .= '/';
		return $path;
	}

	public static function getValue($name)
	{
		if (isset($_SESSION[$name]))
			return $_SESSION[$name];
		return null;
	}

	public static function setValue($name, $value)
	{
		$_SESSION[$name] = $value;
	}

	public static function unsetValue($name)
	{
		unset($_SESSION[$name]);
	}

}

class SessionStorage
{
	
	function open($save_path, $session_name)
	{
		return true;
	}

	function close()
	{
		return true;
	}

	function read($id)
	{
		$res = SJB_DB::query('select * from session where `session_id` = ?s', $id);
		if (count($res) > 0)
			return (string) $res[0]['data'];
		return '';
	}
	
	function write($id, $session_data)
	{
		$user_sid = 0;
		if (isset($_SESSION['current_user']))
			$user_sid = $_SESSION['current_user']['sid'];
		if (count(SJB_DB::query('select * from session where `session_id` = ?s', $id)) > 0)
			SJB_DB::query('update session set `data` = ?s, `time` = ?s, `user_sid` = ?n where `session_id` = ?s', $session_data, time(), $user_sid, $id);
		else
			SJB_DB::query('insert into session (`session_id`, `data`, `time`, `user_sid`) values (?s, ?s, ?s, ?n)', $id, $session_data, time(), $user_sid);
		return true;
	}

	function destroy($id)
	{
		SJB_DB::query('delete from `session` where `session_id` = ?s', $id);
		return true;
	}

	function gc($maxLifeTime)
	{
		$expirationTime = time();
		//deleting pictures with temporery listings sids after 1 hour of storaging
		$unloaded_pictures_sids = SJB_DB::query('SELECT * FROM `listings_pictures` WHERE LENGTH(`listing_sid`) >= ?n', strlen($expirationTime)-1);
		require_once 'classifieds/ListingGallery/ListingGallery.php';
		if (!empty($unloaded_pictures_sids)) {
			$gallery = new SJB_ListingGallery();			
			foreach ($unloaded_pictures_sids as $k => $v) {
				if ( $v['listing_sid'] + 60*60*1 < $expirationTime) {
					$gallery->deleteImageBySID($v['sid']);
				}
			}			
		}		
		
		SJB_DB::query("delete from `session` where `time` + {$maxLifeTime} < {$expirationTime}");
		return true;
	}
	
}

