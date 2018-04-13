<?php

require_once("orm/ObjectDBManager.php");

class SJB_SubAdminDBManager extends SJB_ObjectDBManager
{
	/**
	 * Save subadmin to database
	 * 
	 * @param SJB_SubAdmin $user
	 * @return boolean
	 */
	function saveSubAdmin(&$user)
	{
		return parent::saveObject("subadmins", $user);
		
	}	//		function saveSubAdmin(&$user)

	
	function getAllSubAdminsInfo()
	{
		return parent::getObjectsInfoByType("subadmins");
	}
	
	function deleteSubAdminBySubAdminName($username)
	{
		$user_sid = SJB_DB::query("SELECT sid FROM subadmins WHERE username = ?s", $username);
		$user_sid = array_pop(array_pop($user_sid));
		return parent::deleteObjectInfoFromDB('subadmins', $user_sid);
	}
	
	function deleteSubAdminById($id)
	{
		return parent::deleteObjectInfoFromDB('subadmins', $id);
	}
	
	function deleteEmptySubAdmins()
	{
		SJB_DB::query("DELETE FROM `subadmins` WHERE `username` = ?s OR `username` IS NULL", "");
	}
	
	function getSubAdminInfoByUserName($username)
	{
		$user_sid = SJB_DB::query("SELECT sid FROM `subadmins` WHERE username = ?s", $username);
		if (empty($user_sid)) {
			return null;
		}
		
		$user_sid = array_pop(array_pop($user_sid));
		return parent::getObjectInfo("subadmins", $user_sid);
	}
	
	function getSubAdminInfoByEmail($email)
	{
		$user_sid = SJB_DB::query("SELECT sid FROM `subadmins` WHERE email = ?s", $email);
		if (empty($user_sid)) {
			return null;
		}
		$user_sid = array_pop(array_pop($user_sid));
		return parent::getObjectInfo("subadmins", $user_sid);
	}
	
	public static function getSubAdminInfoBySID($user_sid)
	{
		return parent::getObjectInfo("subadmins", $user_sid);
	}
	
	function getUsernameBySubAdminSID($user_sid)
	{
		$user_info = SJB_DB::query("SELECT username FROM `subadmins` WHERE sid = ?n", $user_sid);
		if (!empty($user_info))
			return $user_sid = array_pop(array_pop($user_info));
		return null;
	}

	function getSubAdminSIDsLikeSubAdminname($username)
	{
		if (empty($username))
			return null;
		
		$subadmins_info = SJB_DB::query("SELECT `sid` FROM `subadmins` WHERE `username` LIKE '%?w%'", $username);
		if (!empty($subadmins_info)) {
			foreach ($subadmins_info as $id => $user_info)
				$subadmins_sids[$user_info['sid']] = $user_info['sid'];
			return $subadmins_sids;
		}
		return null;
	}
	
}

