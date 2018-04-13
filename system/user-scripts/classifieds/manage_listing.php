<?php


require_once("classifieds/Listing/ListingManager.php");
require_once("users/User/UserManager.php");
require_once("membership_plan/Contract.php");

// Eldar 1
require_once("membership_plan/MembershipPlan.php");
require_once("membership_plan/MembershipPlanManager.php");
require_once("classifieds/DisplayForm.php");
require_once("users/User/User.php");
require_once("payment/Payment/Payment.php");
require_once("payment/Payment/PaymentManager.php");
require_once("payment/Payment/PaymentFactory.php");
require_once("classifieds/MetaDataProvider.php");


require_once("classifieds/Browse/UrlParamProvider.php");
require_once("classifieds/Listing/ListingCriteriaSaver.php");
require_once("forms/Form.php");
require_once('comments/Comment/CommentManager.php');
require_once("applications/Applications.php");
$prev_page = isset ($_REQUEST['edit_job'] ) ? $_REQUEST['edit_job'] : '';


$listing_id = isset($_REQUEST['listing_id']) ? $_REQUEST['listing_id'] : null;

$listing = SJB_ListingManager::getObjectBySID($listing_id);

$current_user = SJB_UserManager::getCurrentUser();
$template_processor = SJB_System::getTemplateProcessor();

if (is_null($listing_id)) {

	$errors['PARAMETERS_MISSED'] = 1;
	
} elseif (empty($current_user)) {
	
	$errors['NOT_LOGGED_IN'] = 1;
	
} elseif (is_null($listing)) {
	
	$errors['WRONG_PARAMETERS_SPECIFIED'] = 1;
	
} elseif ($listing->getUserSID() != $current_user->getSID()) {

	$errors['NOT_OWNER'] = 1;

} else {

	$package_info = $listing->getListingPackageInfo();
	
	$listing_info = SJB_ListingManager::getListingInfoBySID($listing_id);
	$listing_type_info = SJB_ListingTypeManager::getListingTypeInfoBySID($listing_info['listing_type_sid']);
	$waitApprove = $listing_type_info['waitApprove'];
	
	$listing_info['type'] =  array('id' => $listing_type_info['id'],'caption' 	=> $listing_type_info['name']);
	$listing_info['package'] = $package_info;

	$template_processor->assign("listing", $listing_info);
	
	$contract_id = $listing_info['contract_id'];	
	$template_processor->assign("waitApprove", $waitApprove);
}
$template_processor->assign("errors", isset($errors) ? $errors : null);


// ELDAR 2

		$user				= SJB_UserManager::getCurrentUser();
		$contractsInfo		= SJB_ContractManager::getAllContractsInfoByUserSID($user->sid);

		$cancelRecurringContract = SJB_Request::getVar('cancelRecurringContract', false);
		if ($cancelRecurringContract)
			$tp->assign('cancelRecurringContractId', $cancelRecurringContract);

		foreach ($contractsInfo as $key => $contractInfo) {
			$contractInfo['extra_info'] 	= unserialize($contractInfo['serialized_extra_info']);
			$contractInfo['countListings']	= SJB_ListingManager::getListingsNumberByUserSID($user->sid);
			$contractInfo['avalaibleViews']	= '';
			if (isset($contractInfo['extra_info']['page_access']))
				$contractInfo['avalaibleViews']	= array_sum($contractInfo['extra_info']['page_access']);
			// РїРѕРґС?С‡РёС‚Р°РµРј РєРѕР»РёС‡РµС?С‚РІРѕ РїСЂРѕС?РјРѕС‚СЂРѕРІ, СѓР¶Рµ РёРјРµСЋС‰РёС…С?С? Сѓ РїРѕР»СЊР·РѕРІР°С‚РµР»С?
			$contractInfo['numOfViews']		= array_pop( SJB_DB::query("SELECT count(*) as `count` FROM `page_view` WHERE `id_user` = ?n GROUP BY `id_user`", $user->sid) );
			if (is_array($contractInfo['numOfViews'])) {
				$contractInfo['numOfViews'] = $contractInfo['numOfViews']['count'];
			}
			$contractsInfo[$key] = $contractInfo;
		}


$contractMeta = array(	'creation_date'   => array('type'	=> 'date',),
								'expired_date'    => array('type'	=> 'date',));
$available_membership_plan_ids = SJB_MembershipPlanManager::getPlansIDByGroupSID($current_user->getUserGroupSID());
		$available_membership_plan_ids = array_diff($available_membership_plan_ids, $current_user->getSubscribeOnceMembershipPlansIDByUserId());
		$available_membership_plan_ids = array_diff($available_membership_plan_ids, $current_user->getProhibitSubscribingTwiceMembershipPlansIDByUserIds($current_user->getID(), $current_user->getUserGroupSID()));
		
		$membership_plans_display_info = array();
		
		foreach ($available_membership_plan_ids as $id) {
			$membership_plan = new SJB_MembershipPlan(array('id' => $id));
			$membership_plan_info = $membership_plan->getFieldsInfo();
			$display_form = new SJB_DisplayForm($membership_plan_info);
			$membership_plan_display_fields = $display_form->getFormFields();
			$membership_plans_display_info[$id] = $membership_plan_display_fields;
		}
$template_processor->assign("contractsInfo", $contractsInfo);
$template_processor->assign("available_membership_plans", $membership_plans_display_info);
$template_processor->assign("METADATA", array_merge(array('membership_plan' => SJB_MetaDataProvider::getMembershipPlanMetaData('Membership Plan', current($membership_plans_display_info)), 'contractInfo' => $contractMeta)));
$template_processor->assign("previous_page", $prev_page);

// ELDAR END 2


$template_processor->display("manage_listing.tpl");

