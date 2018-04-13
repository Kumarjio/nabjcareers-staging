<?php

require_once("orm/ObjectDBManager.php");

class SJB_UserDBManager extends SJB_ObjectDBManager
{
	
	function saveUser(&$user)
	{
		$user_group_sid = $user->getuserGroupSID();
		$user_exists = !is_null($user->getSID());
				
		if (!is_null($user_group_sid)) {
			$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid);
			
			if ( isset($user_group_info['user_email_as_username']) && (($user_group_info['user_email_as_username']) == true) )
			{
				$useremail = $user->details->getProperty('email')->getValue();
				if ( !is_array($useremail) || (!array_key_exists('original', $useremail)) )
					$user->details->getProperty('username')->setValue( $useremail );
				else
					$user->details->getProperty('username')->setValue( $useremail['original'] );
			}
			parent::saveObject("users", $user);
	if(!empty($_REQUEST['password']['original'])) {
		$password = $user->details->getProperty('password')->value;
	}
	$password = !empty($password) ? $password['original'] : '';
	
			if (!$user_exists) {
				SJB_DB::query("UPDATE ?w
						   SET registration_date = NOW(), activation_key=?s, verification_key=?s, access_token=?s
						   WHERE sid = ?n",
						   "users", $user->getActivationKey(), $user->getVerificationKey(), $password, $user->getSID());
			} elseif(!empty($password)) {
				SJB_DB::query("UPDATE ?w SET access_token=?s
				WHERE sid = ?n",
				"users",  $password, $user->getSID());
			}
			
			return SJB_DB::query("UPDATE ?w SET user_group_sid = ?n WHERE sid = ?n", "users", $user_group_sid, $user->getSID());
		}
		
		return false;
	}
	
	function getAllUsersInfo()
	{
		return parent::getObjectsInfoByType("users");
	}
	
	function deleteUserByUserName($username)
	{
		$user_sid = SJB_DB::query("SELECT sid FROM users WHERE username = ?s", $username);
		$user_sid = array_pop(array_pop($user_sid));
		return parent::deleteObjectInfoFromDB('users', $user_sid);
	}
	
	function deleteUserById($id)
	{
		SJB_DB::query('UPDATE `users` SET `parent_sid` = 0 WHERE `parent_sid` = ?n', $id);
		SJB_DB::query('UPDATE `listings` SET `subuser_sid` = 0 WHERE `subuser_sid` = ?n', $id);
		return parent::deleteObjectInfoFromDB('users', $id);
	}
	
	function deleteEmptyUsers()
	{
		SJB_DB::query("DELETE FROM `users` WHERE `username` = ?s OR `username` IS NULL", "");
	}
	
	function activateUserByUserName($username)
	{
		return SJB_DB::query("UPDATE users SET active = 1 WHERE username = ?s", $username);
	}
	
	function deactivateUserByUserName($username)
	{
		SJB_DB::query("UPDATE users SET active = 0 WHERE username = ?s", $username);
	}
	
	function getUserInfoByUserName($username)
	{
		$user_sid = SJB_DB::query("SELECT sid FROM users WHERE username = ?s", $username);
		if (empty($user_sid)) {
			return null;
		}
		
		$user_sid = array_pop(array_pop($user_sid));
		return parent::getObjectInfo("users", $user_sid);
	}
	
	function getUserInfoByUserEmail($email)
	{
		$user_sid = SJB_DB::query("SELECT sid FROM users WHERE email = ?s", $email);
		if (empty($user_sid)) {
			return null;
		}
		$user_sid = array_pop(array_pop($user_sid));
		return parent::getObjectInfo("users", $user_sid);
	}
	
	public static function getUserInfoBySID($user_sid)
	{
		return parent::getObjectInfo("users", $user_sid);
	}
	
	function getUserNameByUserSID($user_sid)
	{
		$user_info = SJB_DB::query("SELECT username FROM users WHERE sid = ?n", $user_sid);
		if (!empty($user_info))
			return $user_sid = array_pop(array_pop($user_info));
		return null;
	}

	
	
	
	/**/
	function getCompanyNameByUserSID($user_sid)
	{
//		$user_info_objsid = SJB_DB::query("SELECT username FROM users WHERE sid = ?n", $user_sid);
		$user_info = SJB_DB::query("SELECT value FROM users_properties WHERE object_sid = ?n AND id='CompanyName'", $user_sid); 
		if (!empty($user_info))
			return $user_sid = array_pop(array_pop($user_info));
		return null;
	}
	
	/**/
	function getUserSIDsLikeUsername($username)
	{
		if (empty($username))
			return null;
		
		$users_info = SJB_DB::query("SELECT `sid` FROM `users` WHERE `username` LIKE '%?w%'", $username);
		if (!empty($users_info)) {
			foreach ($users_info as $id => $user_info)
				$users_sids[$user_info['sid']] = $user_info['sid'];
			return $users_sids;
		}
		return null;
	}
	
	function deleteActivationKeyByUsername($username)
	{
		return SJB_DB::query("UPDATE `users` SET `activation_key`='' WHERE `username` = ?s ", $username);
	}
}

