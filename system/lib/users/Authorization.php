<?php

require_once("users/User/UserManager.php");

class SJB_Authorization
{
	function login($username, $password, $keep_signed, &$errors, $login_as_user = false, $autoriseByUsername = false)
	{
		$login = SJB_UserManager::login($username, $password, $errors, $autoriseByUsername, $login_as_user);
		if ($login) {
			if (SJB_UserManager::checkBan($errors)) {
				return false;
			}
			$userInfo = SJB_UserManager::getUserInfoByUserName($username);
			if (!$userInfo['active']) {
				$errors['USER_NOT_ACTIVE'] = 1;
				return false;
			}
			if (!empty($userInfo['parent_sid'])) {
				$subuserInfo = $userInfo;
				$userInfo = SJB_UserManager::getUserInfoBySID($userInfo['parent_sid']);
				$userInfo['subuser'] = $subuserInfo;
			}
			if ($keep_signed)
				SJB_Authorization::keepUserSignedIn($userInfo);
			
			SJB_Authorization::setSessionForUser($userInfo);
			SJB_DB::query('update `users` set `ip` = ?s where `sid` = ?n', $_SERVER['REMOTE_ADDR'], $userInfo['sid']);
			return true;
		} 
		
		return false;
	}
		
	function keepUserSignedIn($user_info)
	{
		$session_key = SJB_Authorization::generateSessionKey();
		SJB_Authorization::setKeepCookieForUser($session_key);
		SJB_UserManager::saveUserSessionKey($session_key, $user_info['sid']);
	}
	
	function generateSessionKey($length = 32)
	{
		$s = "abcdefghijklmnopqrstuvwxyz0123456789";
		$len = strlen($s);
		$key = '';
		for ($i = 0; $i < $length; $i++) {
			$key .= $s[mt_rand(0, $len - 1)];
		}
		return $key;
	}
	
	function setSessionForUser($user_info)
	{
		$_SESSION['current_user'] = $user_info;	
	}
	
	function setKeepCookieForUser($session_key, $prolong_cookie = true)
	{
		if ($prolong_cookie)
			setcookie('session_key', $session_key, time() + 30 * 24 * 3600, '/');
		else
			setcookie('session_key', $session_key, time() - 30 * 24 * 3600, '/');
	}
	
	function updateCurrentUserSession()
	{
		if (SJB_Authorization::isUserLoggedIn()) {
			$subuser = array();
			if (isset($_SESSION['current_user']['subuser']))
				$subuser = $_SESSION['current_user']['subuser'];
			$_SESSION['current_user'] = SJB_UserManager::getUserInfoByUserName($_SESSION['current_user']['username']);
			if (!empty($subuser)) {
				$_SESSION['current_user']['subuser'] = $subuser;
			}
		}
	}
	
	public static function isUserLoggedIn()
	{
		if (isset($_SESSION['current_user']) && !is_null($_SESSION['current_user']))
			return true;
		return SJB_Authorization::checkForKeep();
	}
	
	public static function checkForKeep()
	{		
		if (isset($_COOKIE['session_key'])) {			
			$user_sid = SJB_UserManager::getUserSIDBySessionKey($_COOKIE['session_key']);			
			
			if (!is_null($user_sid)) {				
				$_SESSION['current_user'] = SJB_UserManager::getUserInfoBySID($user_sid);					
				SJB_Authorization::setKeepCookieForUser($_COOKIE['session_key']);
				return true;
			}
		}
		return false;
	}
	
	function logout()
	{
		if (isset($_COOKIE['session_key'])) {
			$session_key = $_COOKIE['session_key'];
			SJB_UserManager::removeUserSessionKey($session_key);
			SJB_Authorization::setKeepCookieForUser($session_key, false);
		}
		$_SESSION['current_user'] = null;
		SJB_Event::dispatch('Logout');	
	}
	
	function getCurrentUserInfo()
	{
		if (isset($_COOKIE['session_key'])) {
			$user_sid = SJB_UserManager::getUserSIDBySessionKey($_COOKIE['session_key']);

			if (!is_null($user_sid)) {
				$_SESSION['current_user'] = SJB_UserManager::getUserInfoBySID($user_sid);
				SJB_Authorization::setKeepCookieForUser($_COOKIE['session_key']);
			}
		}

		return isset($_SESSION['current_user']) ? $_SESSION['current_user'] : null;
	}
}

