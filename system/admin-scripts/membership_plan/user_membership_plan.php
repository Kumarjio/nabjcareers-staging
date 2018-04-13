<?php
require_once("users/User/UserManager.php");

$tp = SJB_System::getTemplateProcessor();

$userId			= $_REQUEST['userId'];
$action 		= SJB_Request::getVar('action', false);
$user			= SJB_UserManager::getUserInfoBySID($userId);
$contractID 	= SJB_Request::getVar("contract_id", 0);
$user_group_id 		= SJB_Request::getVar('user_group_id', false);
$contractInfo	= SJB_ContractManager::getInfo($contractID);
$viewContractInfo = true;

if (count($contractInfo) && $userId) {
	if ($action == 'change') {
		$membershipPlanToChange = SJB_Request::getVar('plan_to_change');
		if ($membershipPlanToChange == 0) {
				if (SJB_ContractManager::deleteContract($contractID, $userId)) {
					$tp->assign('deleted', 'yes');
					$viewContractInfo = false;
				}
				else
					$tp->assign('deleted', 'no');
				
		} else {
			$contract = new SJB_Contract(array( 'contract_id' => $contractID, 'membership_plan_id' => $membershipPlanToChange ));
			$contract->id = $contractID;
			$contract->setUserSID($userId);
			$contract->saveInDB();
			$contractInfo = SJB_ContractManager::getInfo($contractID);
			$tp->assign('changed', 1);
		}
	}
	if ($action == 'changeExpirationDate') {
		$expired_date = SJB_Request::getVar('expired_date', false);
		if ($expired_date && $expired_date != 'Never Expire') {
			SJB_DB::query("UPDATE `contracts` SET `expired_date` = ?s WHERE `id`=?n", $expired_date,  $contractID);
		} else {
			SJB_DB::query("UPDATE `contracts` SET `expired_date` = NULL WHERE `id`=?n",  $contractID);
		}
		$contractInfo = SJB_ContractManager::getInfo($contractID);
	}
	if ($viewContractInfo) {
		$contractInfo['extra_info'] = unserialize($contractInfo['serialized_extra_info']);
		$contractInfo['countListings']	= SJB_ListingManager::getListingsNumberByUserSIDAndContractID($user['sid'], $contractID);
		
		$membershipPlan = SJB_MembershipPlanManager::getMembershipPlanInfoByID($contractInfo['membership_plan_id']);
		$membershipPlan['extra_info'] = unserialize($membershipPlan['serialized_extra_info']);
		
		$membershipPlansArray = SJB_MembershipPlanManager::getAllMembershipPlansInfo();
		foreach ( $membershipPlansArray as $plan ) {
			$plans[] = array( 'id' => $plan['id'], 'caption' => $plan['name'] );
		}
		$tp->assign('contract_id', $contractID);
		$tp->assign('userId', $userId);
		$tp->assign('plans', $plans);
		$tp->assign('membershipPlan', $membershipPlan);
	}
}
$tp->assign('user_group_id', $user_group_id);
$tp->assign('contractInfo', $contractInfo);
$tp->assign('user', $user);
$tp->display('user_membership_plan.tpl');