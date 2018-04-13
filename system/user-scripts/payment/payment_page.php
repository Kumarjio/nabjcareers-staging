<?php

require_once('payment/Payment/Payment.php');
require_once('payment/Payment/PaymentManager.php');
require_once("payment/Payment/PaymentFactory.php");
require_once("classifieds/MetaDataProvider.php");


//{* 2013 *}
require_once "classifieds/SearchEngine/SearchFormBuilder.php";
require_once "classifieds/SearchEngine/PropertyAliases.php";
require_once "classifieds/Listing/ListingSearcher.php";
require_once "classifieds/Listing/ListingCriteriaSaver.php";
require_once "classifieds/Listing/ListingRequestCreator.php";
require_once "classifieds/ListingType/ListingTypeManager.php";

require_once "membership_plan/ListingPackageManager.php";

require_once "users/User/UserManager.php";
require_once "applications/Applications.php";
//{* 2013 *}

$payment_id = SJB_Request::getVar('payment_id', null);
$checkPaymentErrors = array();
$tp = SJB_System::getTemplateProcessor();
$tp->assign('subscriptionComplete', SJB_Request::getVar('subscriptionComplete', false, SJB_Request::METHOD_GET));
$page = SJB_Request::getVar("page", 1);

if (SJB_Request::$method == SJB_Request::METHOD_POST) {
    if (isset($_REQUEST['submit'])) {
        $gateway = SJB_PaymentGatewayManager::getObjectByID($_REQUEST['gw'], true);
        $subscription_result = $gateway->createSubscription($_REQUEST);
        if ($subscription_result !== true){
            $tp->assign('form_submit_url', $_SERVER['REQUEST_URI']);
            $tp->assign('form_data_source', $_REQUEST);
            $tp->assign('errors', $subscription_result);
            $tp->display('recurring_payment_page.tpl');
        }
        else {
			SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/subscription/?subscriptionComplete=true');
        }
    }
    else {
        $tp->assign('form_submit_url', $_SERVER['REQUEST_URI']);
        $tp->assign('form_data_source', $_REQUEST);
        $tp->display('recurring_payment_page.tpl');
    }
}
else if (!is_null($payment_id)) {

	if (SJB_Request::getVar('action') == 'exclude_listing') {
		$listingSidToExclude = SJB_Request::getVar('listing_sid');

		$payment = new SJB_Payment(SJB_PaymentManager::getPaymentInfoBySID($payment_id));
		$product_info = $payment->getProductInfo();
		$listingSids = $product_info['listings_ids'][0];

		$listingSids = array_diff($listingSids, array($listingSidToExclude));

		SJB_PaymentManager::deletePaymentBySID($payment_id);
		createPaymentAndRedirect($listingSids);
		
/* ELDAR 09-11-2013 Exclude and delete function for payment page */		
	} elseif (SJB_Request::getVar('action') == 'exclude_and_delete_listing')  {
		$listingSidToExclude = SJB_Request::getVar('listing_sid');		
		$payment = new SJB_Payment(SJB_PaymentManager::getPaymentInfoBySID($payment_id));
		$product_info = $payment->getProductInfo();
		$listingSids = $product_info['listings_ids'][0];		
		$listingSids = array_diff($listingSids, array($listingSidToExclude));		
		SJB_PaymentManager::deletePaymentBySID($payment_id);
				
		/* delete the listing*/
		SJB_ListingManager::deleteListingBySID($listingSidToExclude);
		/**/
		
		createPaymentAndRedirect($listingSids);
/* END */
		
	} elseif (SJB_Request::getVar('action') == 'cancel_addon') {
		$packageIds = array(
			'simple' => array(30 => 40, 60 => 41, 90 => 42),
			'priority' => array(30 => 43, 60 => 44, 90 => 45),
			'featured' => array(30 => 46, 60 => 47, 90 => 48),
			'priority_featured' => array(30 => 49, 60 => 50, 90 => 51),
		);

		$listingSid = SJB_Request::getVar('listing_sid');
		$addon = SJB_Request::getVar('addon');

		$payment = new SJB_Payment(SJB_PaymentManager::getPaymentInfoBySID($payment_id));
		$product_info = $payment->getProductInfo();
		$listingSids = $product_info['listings_ids'][0];

		$listing = SJB_ListingManager::getObjectBySID($listingSid);
		$currentPackageInfo = $listing->getListingPackageInfo();

		$featured = $currentPackageInfo['is_featured'];
		$priority = $currentPackageInfo['priority_listing'];

		if ($addon == 'featured') $featured = false;
		if ($addon == 'priority') $priority = false;

		$key = 'simple';
		if ($featured && $priority) $key = 'priority_featured';
		elseif ($featured) $key = 'featured';
		elseif ($priority) $key = 'priority';

		$newPackageId = $packageIds[$key][$currentPackageInfo['listing_lifetime']];
		SJB_ListingManager::saveListing($listing, $newPackageId);

		$newPackageInfo = SJB_ListingPackageManager::getPackageInfoByListingSID($listing->getSID());
		if ($newPackageInfo['is_featured'])
			SJB_ListingManager::makeFeaturedBySID($listing->getSID());
		else
			SJB_ListingManager::unmakeFeaturedBySID($listing->getSID());
		if ($newPackageInfo['priority_listing'])
			SJB_ListingManager::makePriorityBySID($listing->getSID());
		else
			SJB_ListingManager::unmakePriorityBySID($listing->getSID());

		SJB_PaymentManager::deletePaymentBySID($payment_id);
		createPaymentAndRedirect($listingSids);
	}

	$currentUserSID = SJB_UserManager::getCurrentUserSID();
	$payment_info   = SJB_PaymentManager::getPaymentInfoBySID($payment_id);

	$payment        = new SJB_Payment($payment_info);
	$paymentUserSID = $payment->getUserSID();

	if ($paymentUserSID === $currentUserSID) {
		if ($payment->getStatus() == PAYMENT_STATUS_FAILED) {
			$payment->setStatus(PAYMENT_STATUS_PENDING);
		}
		$payment->setSID($payment_id);

		$product_info = $payment->getProductInfo();
		
		
		//----- 12-05-2014 Checked listings FIX
		
		if (isset($_REQUEST['restore']))
			$reqest_data['restore'] = 1;
		else if ( isset($_REQUEST['listigid']) ) {
			$checked_listings_in_url[$_REQUEST['listigid']] = $_REQUEST['listigid'];
			$tp->assign('checked_listings_in_url', $checked_listings_in_url);
		}
		else {
			foreach ($_REQUEST as $checked_listing_in_url) {
				$checked_listings_in_url[$checked_listing_in_url]= $checked_listing_in_url;
			}
			$tp->assign('checked_listings_in_url', $checked_listings_in_url);
		}	
		
		
		$currentUserInfo 	= SJB_UserManager::getCurrentUserInfo();
		
		/*******************- Credits mod MARCH -2016 *****/		
		$JobCredits30=$currentUserInfo['JobCredits30'];	
		$JobCredits60=$currentUserInfo['JobCredits60'];		
		$JobCredits90=$currentUserInfo['JobCredits90'];
		
		$job_credits_spent30 = 0;
		$job_credits_spent60 = 0;
		$job_credits_spent90 = 0;
			
		$paymentfor = $page;
		
		// get prices
		$thirty_day_listing_price = SJB_DB::query("SELECT * FROM packages WHERE id = 40");
		$thirty_day_listing_price = array_pop($thirty_day_listing_price);
		$thirty_day_listing_price = array_merge($thirty_day_listing_price , unserialize($thirty_day_listing_price['fields']));
		$sixty_day_listing_price = SJB_DB::query("SELECT * FROM packages WHERE id = 41");
		$sixty_day_listing_price = array_pop($sixty_day_listing_price);
		$sixty_day_listing_price = array_merge($sixty_day_listing_price , unserialize($sixty_day_listing_price['fields']));			
		$ninety_day_listing_price = SJB_DB::query("SELECT * FROM packages WHERE id = 42");
		$ninety_day_listing_price = array_pop($ninety_day_listing_price);
		$ninety_day_listing_price = array_merge($ninety_day_listing_price , unserialize($ninety_day_listing_price['fields']));
		/* resumes prices */
		$resumesAccess30_price = SJB_DB::query("SELECT price FROM membership_plans WHERE id = 33");
		$resumesAccess30_price = array_pop($resumesAccess30_price);
		$resumesAccess30_price = array_pop($resumesAccess30_price);
		//print_r($resumesAccess30_price);
		$resumesAccess60_price = SJB_DB::query("SELECT price FROM membership_plans WHERE id = 37");
		$resumesAccess60_price = array_pop($resumesAccess60_price);
		$resumesAccess60_price = array_pop($resumesAccess60_price);
		/* end prices */
			
		$alreadyCreditedJobs = array();
		
		$session_new_jobs =SJB_DB::query("SELECT `sid` FROM `listings` WHERE `is_new` = 1 AND `user_sid` = ?n", SJB_UserManager::getCurrentUserSID());
		
		//if payment for Jobs and user has credits
		if ($checked_listings_in_url  && $paymentfor != "L3NlYXJjaC1yZXN1bWVzLw==" && ($JobCredits30 > 0 || $JobCredits60 > 0 || $JobCredits90 > 0))
		{
			foreach ($session_new_jobs as $job_element) { // check each listing in payment
				$job_element = $job_element['sid'];
				$job_element_object = SJB_ListingPackageManager::getPackageInfoByListingSID($job_element);
		
				// if job duration 30 days AND user HAS 30days CREDITS
				if ($job_element_object['listing_lifetime'] == "30" && $JobCredits30 > 0 ) {
					// apply discount to total sum
					$product_info['price'] -= $thirty_day_listing_price['price'];
					if ($product_info['price'] < 0 ){
						$product_info['price'] = 0;
					}
		
					// if not featured/priority - we activate the listing
					if ($job_element_object['price'] == $thirty_day_listing_price['price']){
						SJB_ListingManager::activateListingBySID($job_element);
						$alreadyCreditedJobs[$job_element] = $job_element;
					}
					else {	// else  - we activate it AND disable featured/priority
						//1. activate
						SJB_ListingManager::activateListingBySID($job_element);
		
						// 2. disable featured/priority of the listing
						SJB_ListingManager::unmakeFeaturedBySID($job_element);
						SJB_ListingManager::unmakePriorityBySID($job_element);
		
						// 3.
						echo "<p>Discount applied, listing ".$job_element." activated.
									Please click 'make featured' / 'make priority' links below to activate the options.</p>";
						$alreadyCreditedJobs[$job_element] = $job_element;
					}
					// debit 1 spent credit
					$JobCredits30--;
					$job_credits_spent30++;
						
					// update  job credits num in the DB
					$updateCredits = SJB_UserProfileFieldDBManager::updateJobCredits30($JobCredits30, $currentUserSID);
		
					// update the payment sum in the DB
					$updatePaymentPrice = SJB_PaymentManager::setPriceMinusCredits($payment_id, $product_info['price']);
					$updatePaymentCredit = SJB_PaymentManager::setCreditsFlag($payment_id);
					$updatePaymentStatus = SJB_PaymentManager::endorsePayment($payment_id, TRUE);
				}
		
				else if ($job_element_object['listing_lifetime'] == "60" && $JobCredits60 > 0) {
					// apply discount to total sum
					$product_info['price'] -= $sixty_day_listing_price['price'];
					if ($product_info['price'] < 0 ) {
						$product_info['price'] = 0;
					}
						
					// activate listing
					if ($job_element_object['price'] == $sixty_day_listing_price['price']) {
						SJB_ListingManager::activateListingBySID($job_element);
						$alreadyCreditedJobs[$job_element] = $job_element;
					}
					else {
						//1. activate
						SJB_ListingManager::activateListingBySID($job_element);
		
						// 2. disable featured/priority of the listing
						SJB_ListingManager::unmakeFeaturedBySID($job_element);
						SJB_ListingManager::unmakePriorityBySID($job_element);
		
						// 3.
						echo "<p>Discount applied, listing ".$job_element." activated.
									Please click 'make featured' / 'make priority' links below to activate the options.</p>";
						$alreadyCreditedJobs[$job_element] = $job_element;
					}
					$JobCredits60--;
					$job_credits_spent60++;
						
					$updateCredits = SJB_UserProfileFieldDBManager::updateJobCredits60($JobCredits60, $currentUserSID);
					$updatePaymentPrice = SJB_PaymentManager::setPriceMinusCredits($payment_id, $product_info['price']);
					$updatePaymentCredit = SJB_PaymentManager::setCreditsFlag($payment_id);
					$updatePaymentStatus = SJB_PaymentManager::endorsePayment($payment_id, TRUE);
				}
		
				else if ($job_element_object['listing_lifetime'] == "90" && $JobCredits90 > 0) {
					// apply discount to total sum
					$product_info['price'] -= $ninety_day_listing_price['price'];
					if ($product_info['price'] < 0 ){
						$product_info['price'] = 0;
					}
						
					// activate listing
					if ($job_element_object['price'] == $ninety_day_listing_price['price']){
						SJB_ListingManager::activateListingBySID($job_element);
						$alreadyCreditedJobs[$job_element] = $job_element;
					}
					else {
						//1. activate
						SJB_ListingManager::activateListingBySID($job_element);
		
						// 2. disable featured/priority of the listing
						SJB_ListingManager::unmakeFeaturedBySID($job_element);
						SJB_ListingManager::unmakePriorityBySID($job_element);
		
						// 3.
						echo "<p>Discount applied, listing ".$job_element." activated.
									Please click 'make featured' / 'make priority' links below to activate the options.</p>";
						$alreadyCreditedJobs[$job_element] = $job_element;
					}
		
					$JobCredits90--;
					$job_credits_spent90++;
					$updateCredits = SJB_UserProfileFieldDBManager::updateJobCredits90($JobCredits90, $currentUserSID);
					$updatePaymentPrice = SJB_PaymentManager::setPriceMinusCredits($payment_id, $product_info['price']);
					$updatePaymentCredit = SJB_PaymentManager::setCreditsFlag($payment_id);
					$updatePaymentStatus = SJB_PaymentManager::endorsePayment($payment_id, TRUE);
				}
		
				else {
					break;
				}
		
			} //foreach end
		
			$n=0;
			if ($alreadyCreditedJobs)
			{
				foreach ($alreadyCreditedJobs as $alreadyCreditedJobId) {
					$n++;
					$alreadyCreditedJobsListURL .= "id".$n."=".$alreadyCreditedJobId."&";
				}
		
				// redirect to the "Activated with credits" page
				SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/activated-with-credits/?'.$alreadyCreditedJobsListURL);
			}
		}		
		
		$payment->setPrice($product_info['price']);
		$payment->setCreditsDiscountedInSubUserSid('-1');
/******************************** END job credits ******************************/
		
		
		
		
		// save payment with new status
		SJB_PaymentManager::savePayment($payment);

		$payment_gateway_forms = SJB_PaymentManager::getPaymentForms($payment);
		
		
		$tp->assign('gateways', $payment_gateway_forms);
		$tp->assign('product_info', $product_info);
	
		$tp->assign('payment', $payment);
		$tp->assign('METADATA', array('product_info' => SJB_MetaDataProvider::getPaymentMetaData('Miscellaneous', $product_info)));

		// Assigned to the template to replace $listing_id in translated phrases,
		// i.e. "Payment for upgrade listing ID $listing_id to featured"
		//	$template_processor->assign('listing_id', $product_info['featured_listing_id']);
	} else {
		$checkPaymentErrors['NOT_OWNER'] = true;
	}

	$tp->assign('checkPaymentErrors', $checkPaymentErrors);
	

	// ------------------------------------------- added from my_listings.php ------------------------------------------- 
		
	$listing_type_id = isset($_REQUEST['listing_type_id']) ? $_REQUEST['listing_type_id'] : null;
	$listing_type_sid = !empty($listing_type_id) ? SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id) : 0;
	$listing = new SJB_Listing(array(), $listing_type_sid);
	$aliases = new SJB_PropertyAliases();
	$criteria = SJB_SearchFormBuilder::extractCriteriaFromRequestData($_REQUEST, $listing);
		
	$searcher 		= new SJB_ListingSearcher();
	
	// to save criteria in the session different from search_results
	$criteria_saver = new SJB_ListingCriteriaSaver('MyListings');
	
	$listing = new SJB_Listing(array(), $listing_type_sid);
		// ������� ���������� � ��������� ���������
	$listingsInfo 		= array();
	


$userGroupID = SJB_UserGroupManager::getUserGroupIDBySID($currentUserInfo['user_group_sid']);

switch ($userGroupID) {
	case 'JobSeeker':
		$listingTypeID = 'Resume';
		break;
	default:
		$listingTypeID = 'Job';
		break;
}
$contractInfo['extra_info']['listing_amount'] = 0;

if ($acl->isAllowed('post_' . $listingTypeID)) {
     $permissionParam = $acl->getPermissionParams('post_' . $listingTypeID);
     if (empty($permissionParam)) {
         $contractInfo['extra_info']['listing_amount'] = 'unlimited';
     }
     else
   	  $contractInfo['extra_info']['listing_amount'] = $permissionParam;
}

$listingsInfo['listingsNum']	= SJB_ListingManager::getListingsNumberByUserSID($currentUserInfo['sid']);

$listingsInfo['listingsMax']	= $contractInfo['extra_info']['listing_amount'];
if ($listingsInfo['listingsMax'] === 'unlimited')
	$listingsInfo['listingsLeft'] = 'unlimited';
else {
	$listingsInfo['listingsLeft']	= $listingsInfo['listingsMax'] - $listingsInfo['listingsNum'];
	$listingsInfo['listingsLeft'] = $listingsInfo['listingsLeft']<0?0:$listingsInfo['listingsLeft'];
}

$userListingsSID				= SJB_ListingDBManager::getListingsSIDByUserSID($currentUserInfo['sid']);

$listingsInfoBySID = '';
if (!empty($userListingsSID)) {
	$listingsInfoBySID				= SJB_ListingManager::getListingInfoBySID($userListingsSID[0]);
	$listingsInfo['listingsType']	= SJB_ListingTypeManager::getListingTypeIDBySID($listingsInfoBySID['listing_type_sid']);
}

/* 05-05-2014 fix Confirm total table - printing out all the listings of the current user*/
for ($i=0; $i<$listingsInfo['listingsNum']; $i++) {
	$listingsInfo['listingsIDs_payment'][$i]	= SJB_ListingManager::getListingInfoBySID($userListingsSID[$i]);
}
/* End */


$tp->assign('listingsInfo', $listingsInfo);

$search_form_builder = new SJB_SearchFormBuilder($listing);
$search_form_builder->registerTags($tp);
$search_form_builder->setCriteria($criteria);

$tp->display('my_listings_form.tpl');
//$page = SJB_Request::getVar("page", 1);

$sorting_field = SJB_Request::getVar("sorting_field", false);
$sorting_order = SJB_Request::getVar("sorting_order", false);

	if ($sorting_order && $sorting_order) {  //save order info in the session
		$criteria_saver->setSessionForOrderInfo(array
												(
													'sorting_field'	=> $sorting_field,
													'sorting_order'	=> $sorting_order,
												));
	}
	
	// $found_listings_sids = $searcher->getObjectsSIDsByCriteria($criteria, $aliases); 
	// get found listing sids
	
	$found_listings_sids = $userListingsSID; // get found listing sids
    $order_info 		= $criteria_saver->getOrderInfo(); //save order info in the session

/*	if(empty($order_info))

*/

// get Applications
$appsGroups = SJB_Applications::getAppGroupsByEmployer( $currentUserInfo['sid'] );
$apps = array();
foreach ($appsGroups as $group) {
	$apps[$group['listing_id']] = $group['count'];
}


$order_info 		= $criteria_saver->getOrderInfo();
$listings_per_page 	= $criteria_saver->getListingsPerPage();
$current_page 		= $criteria_saver->getCurrentPage();

$criteria_saver->setSessionForObjectSIDs($found_listings_sids);
$search_criteria_structure = $criteria_saver->createTemplateStructureForCriteria();
$listing_search_structure  = $criteria_saver->createTemplateStructureForSearch();

/**************** S O R T I N G *****************/
$empty_listing = new SJB_Listing(array(), $listing_type_sid);
$empty_listing->addPicturesProperty();
$empty_listing->addIDProperty();
$empty_listing->addListingTypeIDProperty();
$empty_listing->addActivationDateProperty();
$empty_listing->addNumberOfViewsProperty();
$empty_listing->addApplicationsProperty();
$empty_listing->addSubuserProperty();
$empty_listing->addActiveProperty();

$sorted_found_listings_sids = array();

if (isset($_REQUEST['sorting_field'], $_REQUEST['sorting_order']) &&
	$empty_listing->propertyIsSet($_REQUEST['sorting_field']))
{
	$property = $empty_listing->getProperty($listing_search_structure['sorting_field']);
	
    $sorting_field = $_REQUEST['sorting_field'];
	$sorting_order = $_REQUEST['sorting_order'];
	$ids = join(", ", $found_listings_sids);
	if ($sorting_field == 'listing_type') {
		$sql = '	SELECT listings.*	FROM 
						listings 		LEFT JOIN listing_types 
						on listings.listing_type_sid = listing_types.sid
					WHERE 
						listings.sid IN ('.$ids.')  
					ORDER BY listing_types.id '.$sorting_order;

		$listings_info = SJB_DB::query($sql);
		
	} elseif ($sorting_field == 'id') {
		$sql = '	SELECT listings.*	FROM 
						listings		WHERE 
						listings.sid IN ('.$ids.')  
					ORDER BY sid '.$sorting_order;

		$listings_info = SJB_DB::query($sql);
		
	} elseif ($sorting_field == 'subuser_sid') {
		$sql = '	SELECT `l`.*	FROM
						listings `l` INNER JOIN `users` `u` ON (`l`.`subuser_sid` <> 0 AND `l`.`subuser_sid` = `u`.`sid`) OR (`l`.`subuser_sid` = 0 AND `l`.`user_sid` = `u`.`sid`)		WHERE
						`l`.sid IN ('.$ids.')
					ORDER BY `u`.`username` '.$sorting_order;

		$listings_info = SJB_DB::query($sql);

	} elseif ($sorting_field == 'applications') {
			
		$sql = 'SELECT listings.sid, count(apps.id) as appCount 
					FROM listings 
					LEFT JOIN applications as apps ON listings.sid = apps.listing_id
					WHERE 
						listings.sid IN ('.$ids.') 
					GROUP BY listings.sid 
					ORDER BY appCount '.$sorting_order;

		$listings_info = SJB_DB::query($sql);
		
	} else {
		$listing_request_creator = new SJB_ListingRequestCreator($found_listings_sids, array('property'		 => $property,
																					 'sorting_order' => $listing_search_structure['sorting_order']));
		$listings_info = SJB_DB::query($listing_request_creator->getRequest());
	}	

	$listings_sids = array();

	foreach ($listings_info as $listing_info) 
		$listings_sids[$listing_info['sid']] = $listing_info['sid'];

	
	
	
	
	
	
	$sorted_found_listings_sids = array_keys($listings_sids);

}
else {
	
	
	// закомментировано. Создается множество ключей сессии, которые замедляют загрузку страницы
	$sorted_found_listings_sids = $found_listings_sids;
}
//$criteria_saver->setSessionForObjectSIDs($sorted_found_listings_sids);
/*
$sortable_properties = array();
$property_list = $empty_listing->getPropertyList();

/*foreach ($property_list as $property)
	$sortable_properties[$property]['is_sortable'] = true;

/**************** P A G I N G *****************/

$listings_structure	= array();

if ($listing_search_structure['current_page'] > $listing_search_structure['pages_number'])
	$listing_search_structure['current_page'] = $listing_search_structure['pages_number'];
if ($listing_search_structure['current_page'] < 1)
	$listing_search_structure['current_page'] = 1;
	
	
$sorted_found_listings_sids_by_pages = array_chunk($sorted_found_listings_sids, 10, true);

/************* S T R U C T U R E **************/

$listing_structure = array();
$listings_structure = array();
$listing_structure_meta_data = array();
$listing_anonymous = array();

if (isset($sorted_found_listings_sids_by_pages[$listing_search_structure['current_page']-1])) {
    foreach ($sorted_found_listings_sids_by_pages[$listing_search_structure['current_page']-1] as $sid) {		
		$listing = SJB_ListingManager::getObjectBySID($sid);
		$listing->addPicturesProperty();
		$listing_structure = SJB_ListingManager::createTemplateStructureForListing($listing);
		$listings_structure[$listing->getID()] = $listing_structure;
		
		if (isset($listing_structure['METADATA']))
			$listing_structure_meta_data = array_merge($listing_structure_meta_data, $listing_structure['METADATA']);
	}
}

/** 2 */
$all_listing_structure = array();
$all_listings_structure = array();
$all_listing_structure_meta_data = array();
$all_listing_anonymous = array();

if (isset($sorted_found_listings_sids)) {
	foreach ($sorted_found_listings_sids as $all_sid) {
		$all_listing = SJB_ListingManager::getObjectBySID($all_sid);
		$all_listing->addPicturesProperty();
		$all_listing_structure = SJB_ListingManager::createTemplateStructureForListing($all_listing);
		$all_listings_structure[$all_listing->getID()] = $all_listing_structure;

		if (isset($all_listing_structure['METADATA']))
			$all_listing_structure_meta_data = array_merge($all_listing_structure_meta_data, $all_listing_structure['METADATA']);
	}
}


$tp->assign("listings", $all_listings_structure);
$tp->assign("paymentfor", $page);
	
// ------------------------------------------- END  ------------------------------------------- 


	
	$tp->display('payment_page.tpl');
} else {
	$tp->display('recurring_payment_page.tpl');
}

function createPaymentAndRedirect($listingSids) {
	$currentUser = SJB_UserManager::getCurrentUser();
	$current_user_sid = $currentUser->getSID();

	$payment_amount = 0;
	$listings_ids_arr = array();
	$ecommerce_mode = SJB_System::getSettingByName('ecommerce');
	foreach ($listingSids as $listing_id){
		$listing_info = SJB_ListingPackageManager::getPackageInfoByListingSID($listing_id);
		if ($listing_info['price'] > 0 && $ecommerce_mode ) {
			$payment_amount += $listing_info['price'];
			$listings_ids_arr[] = $listing_id;
		}
	}
	if (!empty($listings_ids_arr)) {
		$product_info = serialize( array( 'listings_ids' => array($listings_ids_arr)) );
		$status = 'Pending';
		$payment_id = SJB_PaymentManager::getPaymentSID_By_UserID_and_ProductInfo_and_Status($current_user_sid, $product_info, $status);
		$listings_ids_str = implode(',',$listings_ids_arr);
		if (empty($payment_id)) {
			$payment_info = array(
				'user_sid' => $current_user_sid,
				'product_info' => $product_info,
				'price' => $payment_amount,
				'name' => 'Payment for listings # ' . $listings_ids_str,
				'success_page_url' => SJB_System::getSystemSettings( 'SITE_URL' ) . "/activate-listing/",
				'status' => $status
			);
			SJB_Event::dispatch('BeforePaymentSave', $payment_info, true);
			$payment = SJB_PaymentFactory::createPayment($payment_info);
			SJB_PaymentManager::savePayment($payment);
			$payment_id = $payment->getSID();
		}
		$payment_page_url = SJB_System::getSystemSettings('SITE_URL') . "/payment-page/?payment_id=" . $payment_id;
		SJB_HelperFunctions::redirect($payment_page_url);
		exit;
	}
}