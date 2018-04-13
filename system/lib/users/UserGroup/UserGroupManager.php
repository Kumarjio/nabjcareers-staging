<?php

require_once 'UserGroup.php';
require_once 'UserGroupDBManager.php';
require_once 'users/User/UserManager.php';

class SJB_UserGroupManager
{
	function getAllUserGroups()
	{
		$user_groups_info = SJB_UserGroupDBManager::getAllUserGroupsInfo();
		$user_groups = array();
		foreach ($user_groups_info as $user_group_info) {
			$user_group = new SJB_UserGroup($user_group_info);
			$user_group->setSID($user_group_info['sid']);
			$user_groups[] = $user_group;
		}
		return $user_groups;
	}
	
	public static function getAllUserGroupsInfo()
	{
		return SJB_UserGroupDBManager::getAllUserGroupsInfo();
	}
	
	function deleteUserGroupBySID($user_group_sid)
	{
		$user_profile_fields_info = SJB_UserProfileFieldManager::getFieldsInfoByUserGroupSID($user_group_sid);
		foreach ($user_profile_fields_info as $user_profile_field_info) {
			SJB_UserProfileFieldManager::deleteUserProfileFieldBySID($user_profile_field_info['sid']);
		}
		SJB_DB::query('DELETE FROM `membership_plans` WHERE `user_group_sid` = ?n', $user_group_sid);
		return SJB_UserGroupDBManager::deleteUserGroupInfo($user_group_sid);
	}
	
	public static function getUserGroupInfoBySID($user_group_sid)
	{
		return SJB_UserGroupDBManager::getUserGroupInfoBySID($user_group_sid);
	}
	
	function getMembershipPlanSIDsByUserGroupSID($user_group_sid)
	{
		return SJB_UserGroupDBManager::getMembershipPlanSIDsByUserGroupSID($user_group_sid);
	}
	
	function saveUserGroup($user_group)
	{
		SJB_UserGroupDBManager::saveUserGroup($user_group);
	}
	
	function getUserGroupSIDByID($user_group_id)
	{
		return SJB_UserGroupDBManager::getUserGroupSIDByID($user_group_id);
	}
	
	function getUserGroupIDBySID($user_group_sid)
	{
		return SJB_UserGroupDBManager::getUserGroupIDBySID($user_group_sid);
	}

	function getUserGroupNameBySID($user_group_sid)
	{
		return SJB_UserGroupDBManager::getUserGroupNameBySID($user_group_sid);
	}

	function getUserGroupSIDByName($user_group_name)
	{
		return SJB_UserGroupDBManager::getUserGroupSIDByName($user_group_name);
	}

	function isSendActivationEmail($user_group_sid)
	{
		$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid);
		if (!empty($user_group_info)) {
			return $user_group_info['send_activation_email'];
		}
		return null;
	}
	
	function isApproveByAdmin($user_group_sid)
	{
		$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid);
		if (!empty($user_group_info)) {
			return !empty($user_group_info['approve_user_by_admin']);
		}
		return null;
	}
	
	function isApproveByAdminChecked()
	{
		$user_groups_info = SJB_UserGroupManager::getAllUserGroupsInfo();
		foreach ($user_groups_info as $user_group_info) {
			if (SJB_UserGroupManager::isApproveByAdmin($user_group_info['sid']))
				return true;
		}
		return false;
	}
	
	public static function isUserEmailAsUsernameInUserGroup($user_group_sid)
	{
		$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid);
		return (!empty($user_group_info) && $user_group_info['user_email_as_username'] == 1);
	}
	
	function getAllUserGroupsIDsAndCaptions()
	{
		$user_groups_info = SJB_UserGroupManager::getAllUserGroupsInfo();
		$user_groups_ids_and_captions = array();
		foreach ($user_groups_info as $user_group_info) {
			$user_groups_ids_and_captions[] = array('id' 		=> $user_group_info['id'],
												    'caption'	=> $user_group_info['name']);
		}
		return $user_groups_ids_and_captions;
	}

    function createTemplateStructureForUserGroups()
	{
		$user_groups_info = SJB_UserGroupManager::getAllUserGroupsInfo();
		$structure = array();
		foreach ($user_groups_info as $user_group_info) {
			$structure[$user_group_info['id']] = array (
				'sid'				=> $user_group_info['sid'],
				'id'				=> $user_group_info['id'],
				'caption'			=> $user_group_info['name'],
				'user_number'		=> SJB_UserManager::getUsersNumberByGroupSID($user_group_info['sid']),
				'reg_form_template'	=> $user_group_info['reg_form_template'],
				'description'		=> $user_group_info['description'],
			);
		}

		return $structure;
	}
	
	function getDefaultNotificationByGroupSID($group_sid)
	{
		$result = SJB_DB::query("SELECT * FROM `user_groups_properties` WHERE `id` in (
			'notify_on_listing_activation',
			'notify_on_listing_expiration',
			'notify_on_contract_expiration',
			'notify_on_listing_approve_or_reject',
			'notify_on_private_message',
			'notify_subscription_activation',
			'notify_subscription_expire_date',
			'notify_subscription_expire_date_days',
			'notify_listing_expire_date',
			'notify_listing_expire_date_days') AND `object_sid` = ?n", $group_sid);
		$resultArr = array();
		foreach ($result as $val) {
			$resultArr[$val['id']] =  $val['value'];
		}
		return $resultArr;
	}
	
	function moveUpMembershipPlanBySID($membership_plan_sid, $user_group_sid)
	{
		return SJB_UserGroupDBManager::moveUpMembershipPlanBySID($membership_plan_sid, $user_group_sid);
	}
	
	function moveDownMembershipPlanBySID($membership_plan_sid, $user_group_sid)
	{
		return SJB_UserGroupDBManager::moveDownMembershipPlanBySID($membership_plan_sid, $user_group_sid);
	}
	
	public static function setDefaultPlan($groupId, $planId)
	{
		SJB_DB::query('UPDATE `user_groups`	SET `default_plan` = ?n WHERE `sid` = ?n', $planId, $groupId);
		return true;
	}
	
	/**
	 * @param integer $groupId
	 * @return integer|false
	 */
	public static function getDefaultPlan($groupId)
	{
		$defaultPlan = SJB_DB::query('SELECT `default_plan` from `user_groups` WHERE `sid` = ?n', $groupId);
		if (empty($defaultPlan))
			return false;
		$defaultPlan = array_pop(array_pop($defaultPlan));
		return (is_numeric($defaultPlan) && $defaultPlan != 0) ? intval($defaultPlan) : false;
	}
	
}
