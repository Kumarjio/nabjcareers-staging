<?php

require_once("users/UserGroup/UserGroupManager.php");
require_once("ObjectMother.php");
require_once("membership_plan/MembershipPlan.php");
require_once("membership_plan/MembershipPlanManager.php");
require_once("membership_plan/Contract.php");

$tp = SJB_System::getTemplateProcessor();
$user_group_id = SJB_Request::getVar('user_group_id', null);

if (is_null($user_group_id)) {
	$user_groups_info = SJB_UserGroupManager::getAllUserGroupsInfo();
	$tp->assign("jobseeker_sid", $jobseeker_sid);
	$tp->assign("user_groups_info", $user_groups_info);
	$tp->display("add_user_choose_user_group.tpl");
} else {
	$user_group_sid  = SJB_UserGroupManager::getUserGroupSIDByID($user_group_id);
	$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid);
	$user = SJB_ObjectMother::createUser($_REQUEST, $user_group_sid);
	$user->deleteProperty("active");
	$registration_form = SJB_ObjectMother::createForm($user);
	$registration_form->registerTags($tp);
	$form_submitted = SJB_Request::getVar('action', '') == 'add';
	$errors = array();
	if ($form_submitted && $registration_form->isDataValid($errors)) {
		$available_membership_plan_ids = SJB_MembershipPlanManager::getPlansIDByGroupSID($user_group_sid);
		if (count($available_membership_plan_ids) == 1) {
			$membership_plan_id = array_pop($available_membership_plan_ids);
			$membership_plan = new SJB_MembershipPlan(array('id' => $membership_plan_id));
			if ($membership_plan->getPrice() == 0) {
				$contract = new SJB_Contract(array('membership_plan_id' => $membership_plan_id));
				if ($contract->saveInDB()) {
					$user->setContractID($contract->id);
				}
			}
		}
		SJB_UserManager::saveUser($user);
		SJB_UserManager::activateUserByUserName($user->getUserName());
		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/users/?user_group_id=".$user_group_id);
	} else {
		$tp->assign("errors", $errors);
		$tp->assign("user_group", $user_group_info);
		$tp->assign("form_fields", $registration_form->getFormFieldsInfo());
		$tp->display("add_user.tpl");
	}
}
