<?php

require_once('membership_plan/MembershipPlan.php');
require_once('membership_plan/MembershipPlanManager.php');
require_once('membership_plan/Packages.php');
require_once('membership_plan/Package.php');
require_once('classifieds/_InputForm.php');
require_once('membership_plan/ContractManager.php');
require_once('users/User/User.php');
require_once('users/User/UserManager.php');

$_REQUEST['listing_types_search'] = serialize(@$_REQUEST['search_type']);
$membership_plan = new SJB_MembershipPlan($_REQUEST);
$membership_plan_fields = $membership_plan->getFieldsInfo();
$input_form = new SJB_InputForm($membership_plan_fields);
$tp = SJB_System::getTemplateProcessor();

switch (SJB_Request::getVar('action', ''))
{
	case ('save_membership_plan'):
		$input_form->submit();
		if ( $input_form->isValidData() && $membership_plan->saveInDB()) {
			$update_users = SJB_Request::getVar('update_users', 0);
			if ($update_users == 1) {
				$contracts =  SJB_ContractManager::getAllContractsByMemebershipPlanSID($membership_plan->id);
				$contracts_sids = '';
				foreach ($contracts as $contract_id) {
					$contracts_sids .= $contract_id['id'] . ',';
				}
				if ($contracts_sids != '') {
					$contracts_sids = substr($contracts_sids, 0, -1);
					SJB_ContractSQL::updateAllContractsExtraInfoByMembershipPlanID($contracts_sids, $membership_plan->id);
				}
				//выбираем ID юзеров подписанных на план
				$user_sids = SJB_UserManager::getUserSIDsByMembershipPlanSID($membership_plan->id);
				foreach ( $user_sids as $k => $v ) {
					SJB_User::updateSubscribeOnceUsersProperties($membership_plan->id, $v);
				}
			}
			SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/membership-plans/');
		}
		break;
		
	case ('move_up'): 
		$package_id = SJB_Request::getVar('package_id', false);
		if ($package_id && $membership_plan->id)
			SJB_PackagesManager::moveUpPackageBySID($membership_plan->id, $package_id);
		break;
		
	case ('move_down'): 
		$package_id = SJB_Request::getVar('package_id', false);
		if ($package_id && $membership_plan->id)
			SJB_PackagesManager::moveDownPackageBySID($membership_plan->id, $package_id);
		break;
}

$tp->assign('form_fields', $input_form->getFormFields());
$tp->assign('membership_plan_id', $membership_plan->id);
	
$packages = SJB_Packages::getPackages($membership_plan->id);
$result  = SJB_DB::query('SELECT * FROM listing_types ');
foreach ($result as $val) {
	$listing_types[$val['sid']] = $val['id'];
}

$tp->assign('listing_types', $listing_types);
$userGroupsInfo = SJB_UserGroupManager::getAllUserGroupsInfo();
$user_groups = array();
foreach ($userGroupsInfo as $groupInfo) {
    $user_groups[$groupInfo['sid']] = $groupInfo['name'];
}

$tp->assign('user_groups', $user_groups);

if ( !is_null($membership_plan->id) ) {
	
	foreach($packages as $id => $package_info) {
		$package = new SJB_Package($package_info);
		$packages[$id]['number_of_listings'] = $package->getListingQuantity();
	}
	
	$tp->assign('packages', $packages);
	
	$packages_block = $tp->fetch('packages_block.tpl');
	$subscribed_users = $membership_plan->getContractQuantity();
    
	$tp->assign('subscribed_users', $subscribed_users);
    if (!empty($subscribed_users)) {
        $input_form->fields_info['is_recurring']['disabled'] = true;
        $tp->assign('form_fields', $input_form->getFormFields());
    }

	$MembershipPlanInfo = SJB_MembershipPlanManager::getMembershipPlanInfoByID($membership_plan->id);
	$result = unserialize($MembershipPlanInfo['serialized_extra_info']);
	$membershipPlan = new SJB_MembershipPlan($MembershipPlanInfo);

	$tp->assign('membership_plan_info',$MembershipPlanInfo);
	$tp->assign('packages_block', $packages_block);
	$tp->assign('listing_types_search', @$listing_types_search);
	$tp->assign('subscribed_users', $membershipPlan->getContractQuantity());
	$tp->display('membership_plan.tpl');
} else {
	$tp->display('add_membership_plan.tpl');
}
