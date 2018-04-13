<?php

require_once("orm/ObjectDBManager.php");
require_once("UserProfileFieldListItemManager.php");

class SJB_UserProfileFieldDBManager extends SJB_ObjectDBManager
{
	public static function getFieldsInfoByUserGroupSID($user_group_sid)
	{
		$fields = SJB_DB::query("SELECT sid FROM user_profile_fields WHERE user_group_sid = ?n ORDER BY `order`", $user_group_sid);
		$fields_info = array();
		foreach ($fields as $field) {
			$fields_info[] = SJB_UserProfileFieldDBManager::getUserProfileFieldInfoBySID($field['sid']);
		}
		return $fields_info;
	}
	
	function getAllFieldsInfo()
	{
		$fields = SJB_DB::query("SELECT sid FROM user_profile_fields  ORDER BY `order`");
		$fields_info = array();
		foreach ($fields as $field) {
			$fields_info[] = SJB_UserProfileFieldDBManager::getUserProfileFieldInfoBySID($field['sid']);
		}
		foreach ($fields_info as $key => $field_info) {
			$newArr = $fields_info;
			unset($newArr[$key]);
			foreach ($newArr as $value) {
				if ($field_info['id']==$value['id'])
					unset($fields_info[$key]);
			}
		}
		return $fields_info;
	}
	
	public static function getUserProfileFieldInfoBySID($user_profile_field_sid)
	{
		$field_info = parent::getObjectInfo("user_profile_fields", $user_profile_field_sid);
		if ($field_info['type'] == 'list') {
			$field_info['list_values'] = SJB_UserProfileFieldDBManager::getListValuesBySID($user_profile_field_sid);
		}
		elseif ($field_info['type'] == 'tree') {
			$field_info['tree_values'] = SJB_UserProfileFieldTreeManager::getTreeValuesBySID($user_profile_field_sid);
			$field_info['tree_depth'] = SJB_UserProfileFieldTreeManager::getTreeDepthBySID($user_profile_field_sid);
		}
		elseif ($field_info['type'] == 'monetary') {
			require_once "miscellaneous/Currency/Currency.php";
			$field_info['currency_values'] = SJB_CurrencyManager::getActiveCurrencyList();
		}
		
		return $field_info;
	}
	
	public static function getListValuesBySID($user_profile_field_sid)
	{
		$UserProfileFieldListItemManager = new SJB_UserProfileFieldListItemManager;
		$values = $UserProfileFieldListItemManager->getHashedListItemsByFieldSID($user_profile_field_sid);
		$field_values = array();
		
		foreach ($values as $key => $value) {
			$field_values[] = array('id' => $value, 'caption' => $value);
		}
		return $field_values;
	}

	function saveUserProfileField($user_profile_field)
	{
		$user_group_sid = $user_profile_field->getUserGroupSID();
		if ($user_group_sid) {
			parent::saveObject("user_profile_fields", $user_profile_field);
			if ($user_profile_field->getOrder()) {
			    return true;
			}
			
			$max_order = SJB_DB::query("SELECT MAX(`order`) FROM user_profile_fields WHERE user_group_sid = ?n", $user_group_sid);
			$max_order = array_pop(array_pop($max_order));
			$next_order = $max_order + 1;
            return SJB_DB::query("UPDATE user_profile_fields SET user_group_sid = ?n, `order` = ?n WHERE sid = ?n", $user_group_sid, $next_order, $user_profile_field->getSID());
		
		}
		return false;
	}
	
	function deleteUserProfileFieldInfo($user_profile_field_sid)
	{
		$field_info = SJB_UserProfileFieldDBManager::getUserProfileFieldInfoBySID($user_profile_field_sid);
		if (!strcasecmp("list", $field_info['type'])) {
			SJB_DB::query("DELETE FROM user_profile_field_list WHERE field_sid = ?n" . $user_profile_field_sid);
		}
		return parent::deleteObjectInfoFromDB('user_profile_fields', $user_profile_field_sid);
	}
	
	function moveUpFieldBySID($field_sid)
	{
		$field_info = SJB_UserProfileFieldDBManager::getUserProfileFieldInfoBySID($field_sid);
		if (empty($field_info))
		    return false;
		$user_group_sid = $field_info['user_group_sid'];
		$current_order = $field_info['order'];
		$up_order = SJB_DB::query("SELECT MAX(`order`) FROM user_profile_fields WHERE user_group_sid = ?n AND `order` < ?n", $user_group_sid, $current_order);
		$up_order = array_pop(array_pop($up_order));
		if ($up_order == 0)
		    return false;
		SJB_DB::query("UPDATE user_profile_fields SET `order` = ?n WHERE `order` = ?n AND `user_group_sid` = ?n", $current_order, $up_order, $user_group_sid);
		SJB_DB::query("UPDATE user_profile_fields SET `order` = ?n WHERE `sid` = ?n", $up_order, $field_sid);
		return true;
	}
	
	function moveDownFieldBySID($field_sid)
	{
		$field_info = SJB_UserProfileFieldDBManager::getUserProfileFieldInfoBySID($field_sid);
		if (empty($field_info))
		    return false;
		$user_group_sid = $field_info['user_group_sid'];
		$current_order = $field_info['order'];
		$less_order = SJB_DB::query("SELECT MIN(`order`) FROM user_profile_fields WHERE user_group_sid = ?n AND `order` > ?n", $user_group_sid, $current_order);
		$less_order = array_pop(array_pop($less_order));
		if ($less_order == 0)
		    return false;
		SJB_DB::query("UPDATE user_profile_fields SET `order` = ?n WHERE `order` = ?n AND `user_group_sid` = ?n", $current_order, $less_order, $user_group_sid);
		SJB_DB::query("UPDATE user_profile_fields SET `order` = ?n WHERE `sid` = ?n", $less_order, $field_sid);
		return true;
	}
	
	
	
	/* 29 april 2015*/
	
	
	/* job credits mod 2016*/
	//		$field_id="ResumeAccessCredits";
	function updateJobCredits30($credits_num, $user_db_sid)
	{
		SJB_DB::query("UPDATE users_properties SET `value` = ?n
				WHERE `object_sid` = ?n AND `id` = 'JobCredits30'", $credits_num, $user_db_sid);
		return true;
	}
	
	function updateJobCredits60($credits_num, $user_db_sid)
	{
		SJB_DB::query("UPDATE users_properties SET `value` = ?n
				WHERE `object_sid` = ?n AND `id` = 'JobCredits60'", $credits_num, $user_db_sid);
		return true;
	}
	function updateJobCredits90($credits_num, $user_db_sid)
	{
		SJB_DB::query("UPDATE users_properties SET `value` = ?n
				WHERE `object_sid` = ?n AND `id` = 'JobCredits90'", $credits_num, $user_db_sid);
		return true;
	}
	
	
}

