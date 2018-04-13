<?php

require_once("orm/ObjectDBManager.php");
require_once("users/UserProfileField/UserProfileFieldManager.php");

class SJB_UserGroupDBManager extends SJB_ObjectDBManager
{
	
	function deleteUserGroupInfo($user_group_sid)
	{
		return parent::deleteObjectInfoFromDB('user_groups', $user_group_sid);
	}
	
	function getAllUserGroupsInfo()
	{
		return parent::getObjectsInfoByType("user_groups");
	}
	
	public static function getUserGroupInfoBySID($user_group_sid)
	{
		return parent::getObjectInfo("user_groups", $user_group_sid);
	}
	
	function getMembershipPlanSIDsByUserGroupSID($user_group_sid)
	{
		$membership_plans_info = SJB_DB::query("SELECT `id` FROM `membership_plans` WHERE `user_group_sid` = ?n ORDER BY `order`", $user_group_sid);
		$sids = array();
		foreach ($membership_plans_info as $membership_plan_info) {
			$sids[] = $membership_plan_info['id'];
		}
		
		return $sids;
	}
	
	function saveUserGroup($user_group)
	{
		parent::saveObject("user_groups", $user_group);
	}
	
	function getUserGroupSIDByID($user_group_id)
	{
		$sid = SJB_DB::query("SELECT sid FROM user_groups WHERE id = ?s", $user_group_id);
		if (!empty($sid)) {
			return array_pop(array_pop($sid));
		}			  
		return null;		
	}
	
	function getUserGroupIDBySID($user_group_sid)
	{
		$id = SJB_DB::query("SELECT id FROM user_groups WHERE sid = ?s", $user_group_sid);
		
		if (!empty($id)) {
			return array_pop(array_pop($id));
		}
		return null;		
	}

	function getUserGroupNameBySID($user_group_sid)
	{

		$user_group_info = parent::getObjectInfo("user_groups", $user_group_sid);
		return $user_group_info['name'];
	}

	function getUserGroupSIDByName($user_group_name)
	{
		$user_group_sid = SJB_DB::query("SELECT `object_sid` FROM `user_groups_properties` WHERE `id`='name' AND `value`=?s", $user_group_name);

		if (!empty($user_group_sid)) {
			return array_pop(array_pop($user_group_sid));
		}
		return null;
	}
	
	function moveUpMembershipPlanBySID($membership_plan_sid, $user_group_sid)
	{
		$membership_plan_info = SJB_DB::query("SELECT * FROM `membership_plans` WHERE `id` = ?n", $membership_plan_sid);
		if (empty($membership_plan_info)) 
			return false;
			
		$membership_plan_info = array_pop($membership_plan_info);
		$current_order = $membership_plan_info['order'];
		$up_order = SJB_DB::query("SELECT MAX(`order`) FROM `membership_plans` WHERE `order` < ?n  AND `user_group_sid` = ?n", 
								$current_order, $user_group_sid);
		$up_order = array_pop(array_pop($up_order));
		if ($up_order == 0) 
			return false;
		
		SJB_DB::query("UPDATE `membership_plans` SET `order` = ?n WHERE `order` = ?n  AND `user_group_sid` = ?n", 
					$current_order, $up_order, $user_group_sid);
		SJB_DB::query("UPDATE `membership_plans` SET `order` = ?n WHERE `id` = ?n", $up_order, $membership_plan_sid);
		return true;
	}
	
	function moveDownMembershipPlanBySID($membership_plan_sid, $user_group_sid)
	{
		$membership_plan_info = SJB_DB::query("SELECT * FROM `membership_plans` WHERE `id` = ?n", $membership_plan_sid);
		if (empty($membership_plan_info)) 
			return false;
		
		$membership_plan_info = array_pop($membership_plan_info);
		$current_order = $membership_plan_info['order'];
		$less_order = SJB_DB::query("SELECT MIN(`order`) FROM `membership_plans` WHERE `order` > ?n AND `user_group_sid` = ?n", 
								$current_order, $user_group_sid);
		$less_order = array_pop(array_pop($less_order));
		if ($less_order == 0) 
			return false;
		SJB_DB::query("UPDATE `membership_plans` SET `order` = ?n WHERE `order` = ?n AND `user_group_sid` = ?n",
					$current_order, $less_order, $user_group_sid);
		SJB_DB::query("UPDATE `membership_plans` SET `order` = ?n WHERE `id` = ?n", $less_order, $membership_plan_sid);
		return true;
	}
}
