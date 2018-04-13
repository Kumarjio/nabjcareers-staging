<?php

require_once 'membership_plan/MembershipPlanManager.php';
require_once 'membership_plan/ContractManager.php';

$pageConfig = SJB_Request::getInstance()->page_config;
$tp         = SJB_System::getTemplateProcessor();

if (SJB_UserManager::isUserLoggedIn())
{
	$array_membership_plans = array();
	if (is_array($pageConfig->membership)) {
		foreach ($pageConfig->membership as $val) {
			$array_membership_plans[] = $val['id_membership'];
		}
	}
	
	if (empty($array_membership_plans)) {
	    $result = array();
	}
	else {
    	$array_membership_plans = implode(',',$array_membership_plans);
    	$result = SJB_DB::query('SELECT `id`, `name`, `price`, `description` FROM `membership_plans` WHERE `id` IN ('.$array_membership_plans.')');
	}
	
	$getParam = '';
	if ($_GET) {
		$getParam .= '?';
		foreach ($_GET as $key => $val) {
			$getParam .= $key.'='.$val.'&';
		}
		$getParam = substr($getParam, 0, -1);
	}
	
	$page         = base64_encode(SJB_System::getURI().$getParam);
	$current_user = SJB_UserManager::getCurrentUser();
	
	// ----------- ELDAR: added || $current_user->hasContract -----------------
	
	if (!$current_user->hasContract() || $current_user->hasContract()) {
		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL')."/subscription/?page=".$page);
	}
		
	// -------------- ELDAR ----------------
	
	
	// get user membership plan, than look for it in `page_access` table
	// if it is presented in table - that NOT_SUBSCRIBE error, else ACCESS_DENIED
	$contract_id   = $current_user->getContractID();
	$contract_info = SJB_ContractManager::getInfo($contract_id);
	
	$membership_plan_id = $contract_info['membership_plan_id'];
	$check = SJB_MembershipPlanManager::checkPageAccessForMembershipPlanSID($membership_plan_id);
	
	if ( $check ) {
		$tp->assign('ERROR', 'NOT_SUBSCRIBE');
	} else {
		$tp->assign('ERROR', 'ACCESS_DENIED');
		//$tp->display('../membership_plan/subscription_page.tpl');
	}
	
	$tp->assign('membership_plans', $result);
}
else 
{
	$tp->assign('ERROR', 'NOT_LOGIN');
}

$tp->assign('page_function', $pageConfig->function);

$tp->display('../miscellaneous/error.tpl');