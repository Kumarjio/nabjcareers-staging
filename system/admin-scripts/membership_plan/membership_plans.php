<?php

require_once('membership_plan/MembershipPlan.php');
require_once('membership_plan/MembershipPlanManager.php');

if (SJB_Request::getVar('action', '') == 'delete') {
	if (isset($_REQUEST['membership_plan_sid'])) {
		SJB_MembershipPlanManager::deleteMembershipPlanBySID($_REQUEST['membership_plan_sid']);
	}
	SJB_HelperFunctions::redirect('');
}

$tp = SJB_System::getTemplateProcessor();
$membership_plans = SJB_MembershipPlanManager::getAllMembershipPlansInfo();

foreach ($membership_plans as $key => $membership_plan) {
	$membership_plan_object = new SJB_MembershipPlan($membership_plan);
	$membership_plans[$key]['subscribed_users'] = $membership_plan_object->getContractQuantity();
}

$tp->assign('membership_plans', $membership_plans);
$tp->display('membership_plans.tpl');
