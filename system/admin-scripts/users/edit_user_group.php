<?php

require_once("users/UserGroup/UserGroupManager.php");
require_once("users/UserGroup/UserGroup.php");
require_once("users/User/UserManager.php");
require_once("forms/Form.php");
require_once("membership_plan/MembershipPlanManager.php");

$tp = SJB_System::getTemplateProcessor();
$user_group_sid = SJB_Request::getVar('sid', null);
$errors = array();

if ( !is_null($user_group_sid) ) {
	$action = SJB_Request::getVar("action", false);
	$membership_plan_sid = SJB_Request::getVar("membership_plan_sid", false);
	if ($action && $membership_plan_sid !== false) {
		switch ($action) {
			case 'move_up':
				SJB_UserGroupManager::moveUpMembershipPlanBySID($membership_plan_sid, $user_group_sid);
				break;
			case 'move_down':
				SJB_UserGroupManager::moveDownMembershipPlanBySID($membership_plan_sid, $user_group_sid);
				break;
			case 'set_default_plan':
				SJB_UserGroupManager::setDefaultPlan($user_group_sid, $membership_plan_sid);
				break;
		}
	}
	$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid);
	$user_group_info = array_merge($user_group_info, $_REQUEST);
	$user_group = new SJB_UserGroup($user_group_info);
	$user_group->setSID($user_group_sid);
	$edit_user_group_form = new SJB_Form($user_group);
	$form_is_submitted = SJB_Request::getVar('action', '') == 'save_info';
	
	if ($form_is_submitted && $edit_user_group_form->isDataValid($errors)) {
		SJB_UserGroupManager::saveUserGroup($user_group);
		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/user-groups/");
	} else {
		$membership_plan_sids = SJB_UserGroupManager::getMembershipPlanSIDsByUserGroupsID($user_group_sid);
		$membership_plans_info = array();
		$user_sids_in_group = SJB_UserManager::getUserSIDsByUserGroupSID($user_group_sid);
		$user_group_membership_plan_user_number = array();
		
		foreach ($membership_plan_sids as $membership_plan_sid) {
			$membership_plans_info[] = SJB_MembershipPlanManager::getMembershipPlanInfoByID($membership_plan_sid);
			$user_sids_in_membership_plan = SJB_UserManager::getUserSIDsByMembershipPlanSID($membership_plan_sid);
			$user_number = count(array_intersect($user_sids_in_group, $user_sids_in_membership_plan));
			$user_group_membership_plan_user_number[$membership_plan_sid] = $user_number;
		}
		$edit_user_group_form->registerTags($tp);
	
		$tp->assign("object_sid", $user_group->getSID());
		$tp->assign("user_group_sid", $user_group_sid);
		$tp->assign("user_group_membership_plans_info", $membership_plans_info);
		$tp->assign("user_group_membership_plan_user_number", $user_group_membership_plan_user_number);
		$tp->assign("form_fields", $edit_user_group_form->getFormFieldsInfo());
		
		$membership_plans_info = SJB_MembershipPlanManager::getAllMembershipPlansInfo(); 
		$tp->assign("membership_plans_info", $membership_plans_info);
	}
	
} else {
	$errors['USER_GROUP_SID_NOT_SET'] = 1;
}

$tp->assign("user_group_info", isset($user_group_info) ? $user_group_info : null);
$tp->assign("errors", $errors);
$tp->assign("object_sid", $user_group_sid);
$tp->display("edit_user_group.tpl");

