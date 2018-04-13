<?php

require_once 'users/User/UserManager.php';

$tp = SJB_System::getTemplateProcessor();
$userId	= $_REQUEST['userId'];
$user_group_id	= $_REQUEST['user_group_id'];
$user	= SJB_UserManager::getUserInfoBySID($userId);

$membership_plans = SJB_ContractManager::getAllContractsInfoByUserSID($userId);
foreach ($membership_plans as $k => $v) {
	$membership_plans[$k]['extra_info'] = unserialize($membership_plans[$k]['serialized_extra_info']);
}

$tp->assign('membership_plans', $membership_plans);
$tp->assign('user', $user);
$tp->assign('user_group_id', $user_group_id);
$tp->display('user_membership_plans.tpl');

