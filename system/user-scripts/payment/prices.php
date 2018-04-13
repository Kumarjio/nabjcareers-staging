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


$membership_plan_fields = $membership_plan->getFieldsInfo();
$input_form = new SJB_InputForm($membership_plan_fields);
$tp->assign('form_fields', $input_form->getFormFields());


$packages = SJB_DB::query('SELECT * FROM packages');
$tp = SJB_System::getTemplateProcessor();

foreach ($packages as $key => $pack_info) {	
	$pack_info_array[$key] = unserialize ($pack_info['fields']); 
	$pack_info_array[$key]['membership_plan_id'] = $pack_info['membership_plan_id'];
	$pack_info_array[$key]['plan_id'] = $pack_info['id'];
}


$tp->assign('plan_packages', $pack_info_array);


$membership_plans = SJB_MembershipPlanManager::getAllMembershipPlansInfo();

foreach ($membership_plans as $key => $membership_plan) {
	$membership_plan_object = new SJB_MembershipPlan($membership_plan);
	$membership_plan_object_id = $membership_plan_object->getPlanId();
	$membership_plans[$key]['subscribed_users'] = $membership_plan_object->getContractQuantity();

				
				$tp->assign('membership_plans', $membership_plans);
				//$tp->display('membership_plans.tpl');
				
				
				$tp->assign('form_fields', $input_form->getFormFields());
				$tp->assign('membership_plan_id', $membership_plan_object_id);
				//echo "<p>".$membership_plan_object_id."</p>";
				
				$MembershipPlanInfo = SJB_MembershipPlanManager::getMembershipPlanInfoByID($membership_plan_object->id);
									
				//	
				
				
				
				/*foreach($packages as $id => $package_info) {
					$package = new SJB_Package($package_info);
					$packages[$id]['number_of_listings'] = $package->getListingQuantity();
				}*/
				//$tp->assign('packages', $packages);
				
				
				

						
//					$packages_block = $tp->fetch('packages_block.tpl');
				
					$MembershipPlanInfo = SJB_MembershipPlanManager::getMembershipPlanInfoByID($membership_plan_object->id);
					$result = unserialize($MembershipPlanInfo['serialized_extra_info']);
					$membershipPlan = new SJB_MembershipPlan($MembershipPlanInfo);
				
					$tp->assign('membership_plan_info',$MembershipPlanInfo);
			//		$tp->assign('packages_block', $packages_block);
					$tp->assign('listing_types_search', @$listing_types_search);
					$tp->assign('subscribed_users', $membershipPlan->getContractQuantity());
					//$tp->display('membership_plan.tpl');
				/*} else {
					$tp->display('add_membership_plan.tpl');
				}*/

}


$tp->display('prices.tpl');