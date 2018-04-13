<?php

if (!function_exists('_filter_data')){
	function _filter_data(&$array, $key, $pattern){
		if (isset($array[$key])){
			if (!preg_match($pattern, $array[$key]))
				unset($array[$key]);
		}
	}
}

_filter_data($_REQUEST, 'sorting_field', "/^[_\w\d]+$/");
_filter_data($_REQUEST, 'sorting_order', "/(^DESC$)|(^ASC$)/i");
_filter_data($_REQUEST, 'default_sorting_field', "/^[_\w\d]+$/");
_filter_data($_REQUEST, 'default_sorting_order', "/(^DESC$)|(^ASC$)/i");

require_once "classifieds/SearchEngine/SearchFormBuilder.php";
require_once "classifieds/SearchEngine/PropertyAliases.php";
require_once "classifieds/Listing/ListingSearcher.php";
require_once "classifieds/Listing/ListingCriteriaSaver.php";
require_once "classifieds/Listing/ListingRequestCreator.php";
require_once "classifieds/ListingType/ListingTypeManager.php";
require_once "users/User/UserManager.php";
require_once "applications/Applications.php";

require_once("payment/Payment/Payment.php");
require_once("payment/Payment/PaymentManager.php");
require_once("payment/Payment/PaymentFactory.php");

$tp = SJB_System::getTemplateProcessor();
if (!SJB_UserManager::isUserLoggedIn())	{
	$errors['NOT_LOGGED_IN'] = true;
	$tp->assign("ERRORS", $errors);
	$tp->display("error.tpl");
	return;
}

$currentUser = SJB_UserManager::getCurrentUser();
$current_user_sid = $currentUser->getSID();

$listing_type_id = isset($_REQUEST['listing_type_id']) ? $_REQUEST['listing_type_id'] : null;
$listing_type_sid = !empty($listing_type_id) ? SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id) : 0;
$acl = SJB_Acl::getInstance();

$my_listings_criteria = array('user_sid' => array('equal' => $current_user_sid));
if ($currentUser->isSubuser()) {
	$subuserInfo = $currentUser->getSubuserInfo();
	if (!$acl->isAllowed('subuser_manage_listings', $subuserInfo['sid']))
		$my_listings_criteria['subuser_sid'] = array('equal' => $subuserInfo['sid']);
}

/* deleted jobs fix */
$currentUserInfo1 	= SJB_UserManager::getCurrentUserInfo();
$userGroupIDFix = SJB_UserGroupManager::getUserGroupIDBySID($currentUserInfo1['user_group_sid']);
if ($userGroupIDFix != 'JobSeeker') {
	$my_listings_criteria['deleted'] = array('equal' => 0);
}
/* end of deleted jobs fix */

$found_listings_sids = array();
$searcher 		= new SJB_ListingSearcher();

// to save criteria in the session different from search_results
$criteria_saver = new SJB_ListingCriteriaSaver('MyListings');

if (isset($_REQUEST['restore']))
	$_REQUEST = array_merge($_REQUEST, $criteria_saver->getCriteria());

$listing = new SJB_Listing(array(), $listing_type_sid);
$id_alias_info = $listing->addIDProperty();
$listing->addActivationDateProperty();
$listing->addKeywordsProperty();
$listing->addPicturesProperty();
$listing_type_id_alias_info = $listing->addListingTypeIDProperty();

$criteria = SJB_SearchFormBuilder::extractCriteriaFromRequestData($_REQUEST + $my_listings_criteria, $listing);

$aliases = new SJB_PropertyAliases();
$aliases->addAlias($id_alias_info);
$aliases->addAlias($listing_type_id_alias_info);


if (isset($_REQUEST['listings']))
{
	$listings_ids = $_REQUEST['listings'];
	
	if (isset($_REQUEST['action_deactivate'])) {
		foreach ($listings_ids as $listing_id => $value)
			SJB_ListingManager::deactivateListingBySID($listing_id);
	}
		
elseif (isset($_REQUEST['action_activate'])) {
	if (!is_null(SJB_Request::getVar('new_listings'))) {
		$result = SJB_DB::query("SELECT `sid` FROM `listings` WHERE `is_new` = 1 AND `user_sid` = ?n", SJB_UserManager::getCurrentUserSID());
		foreach ($result as $sid) {
			if (!array_key_exists($sid['sid'], $listings_ids)) {
				$listings_ids[$sid['sid']] = 1;
			}
		}
	}

		$payment_amount = 0;
		$listings_ids_arr = array();
		$listings_ids_str = '';
		$ecommerce_mode = SJB_System::getSettingByName('ecommerce');
		foreach ($listings_ids as $listing_id => $value){
			$listing_info = SJB_ListingPackageManager::getPackageInfoByListingSID($listing_id);
			if ($listing_info['price'] > 0 && $ecommerce_mode ) {
				$payment_amount += $listing_info['price'];
				$listings_ids_arr[] = $listing_id;
			} else {
			SJB_ListingManager::activateListingBySID($listing_id);
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
			$page = SJB_Request::getVar('page', false);	
	/**/
			$checked_listings_ids = $_POST['listings'];
			$checked_listings_ids_keys = array_keys($checked_listings_ids);
			foreach ($checked_listings_ids_keys as $checked_listings_id_key) {
				$checked_listings_ids_imploded .= "&".$checked_listings_id_key."=".$checked_listings_id_key;
			}
	/**/

			$new_listing_in_url = '';
			if($_GET['new_listing']) {
				$new_listing_job=$_GET['new_listing'];
				$new_listing_in_url .= "&".$new_listing_job."=".$new_listing_job;
			}
			
			
			if ($page) 
				$page = '&page='.$page;
			$payment_page_url = SJB_System::getSystemSettings('SITE_URL')."/payment-page/?payment_id=".$payment_id.$page.$checked_listings_ids_imploded.$new_listing_in_url;
			SJB_HelperFunctions::redirect($payment_page_url);
			return;
		}
	}
	
	else
		if (isset($_REQUEST['action_delete']))
		{
			$found_listings_sids = $criteria_saver->getObjectSIDs();
			foreach ($listings_ids as $listing_id => $value)
			{
				SJB_ListingManager::deleteListingBySID($listing_id);
				$i = array_search($listing_id, $found_listings_sids);
				unset($found_listings_sids[$i]);
			}
			$criteria_saver->setSessionForObjectSIDs($found_listings_sids);	
		}
									
	/**** DELETED jobs MOD */	
		else if (isset($_REQUEST['action_deleted']))
			{
				$found_listings_sids = $criteria_saver->getObjectSIDs();
				foreach ($listings_ids as $listing_id => $value)
				{
					SJB_ListingManager::deletedListingBySID($listing_id); // mark as Deleted Job
					SJB_ListingManager::deactivateListingBySID($listing_id);// Deactivate the job 
			
					$i = array_search($listing_id, $found_listings_sids);
					unset($found_listings_sids[$i]);
				}
				$criteria_saver->setSessionForObjectSIDs($found_listings_sids);
		
			}
		
	/**** END deleted jobs mod ***/	
								
	else if (isset($_REQUEST['action_sendToApprove'])) {
		foreach ($listings_ids as $listing_id => $value) {
			SJB_ListingManager::setListingApprovalStatus($listing_id, 'pending');
		}
	}
	
	SJB_HelperFunctions::redirect("");
}

// получим информацию о имеющихся листингах
$listingsInfo 		= array();
$currentUserInfo 	= SJB_UserManager::getCurrentUserInfo();
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


/**** redirect if no listings ***
if ($listingsInfo['listingsNum'] == 0) {
	if ($userGroupID=="JobSeeker")
		$addListing_url = SJB_System::getSystemSettings('SITE_URL')."/add-listing/?listing_type_id=Resume";
	else
		$addListing_url = SJB_System::getSystemSettings('SITE_URL')."/add-listing/?listing_type_id=Job";

	SJB_HelperFunctions::redirect($addListing_url);
}
/****** END of redirect if no listings ****/



$userListingsSID				= SJB_ListingDBManager::getListingsSIDByUserSID($currentUserInfo['sid']);

$listingsInfoBySID = '';
if (!empty($userListingsSID)) {
	$listingsInfoBySID				= SJB_ListingManager::getListingInfoBySID($userListingsSID[0]);
	$listingsInfo['listingsType']	= SJB_ListingTypeManager::getListingTypeIDBySID($listingsInfoBySID['listing_type_sid']);
}

$tp->assign('listingsInfo', $listingsInfo);

$search_form_builder = new SJB_SearchFormBuilder($listing);
$search_form_builder->registerTags($tp);
$search_form_builder->setCriteria($criteria);

$tp->display('my_listings_form.tpl');
$page = SJB_Request::getVar("page", 1);

$sorting_field = SJB_Request::getVar("sorting_field", false);
$sorting_order = SJB_Request::getVar("sorting_order", false);

	if ($sorting_order && $sorting_order) {  //save order info in the session
		$criteria_saver->setSessionForOrderInfo(array
												(
													'sorting_field'	=> $sorting_field,
													'sorting_order'	=> $sorting_order,
												));
	}
	
	$found_listings_sids = $searcher->getObjectsSIDsByCriteria($criteria, $aliases); // get found listing sids
    $order_info 		= $criteria_saver->getOrderInfo(); //save order info in the session

	if(empty($order_info))
	{
		$order_info['sorting_field'] = $sorting_field?$sorting_field:!empty($_REQUEST['default_sorting_field']) ? $_REQUEST['default_sorting_field'] : 'activation_date';
		$order_info['sorting_order'] = !empty($_REQUEST['default_sorting_order']) ? $_REQUEST['default_sorting_order'] : 'DESC';

		$criteria_saver->setSessionForOrderInfo(array
												(
													'sorting_field'	=> $order_info['sorting_field'],
													'sorting_order'	=> $order_info['sorting_order'],
												));
	}
	// save values in the REQUEST to initiate sorting below
	$_REQUEST['sorting_field'] = $order_info['sorting_field'];
	$_REQUEST['sorting_order'] = $order_info['sorting_order'];

	$listings_per_page 	= $criteria_saver->getListingsPerPage(); //save 'listings per page' in the session
	if (empty($listings_per_page))
		$listings_per_page = 10;
	$listings_per_page = SJB_Request::getVar("listings_per_page", $listings_per_page);
	$criteria_saver->setSessionForListingsPerPage($listings_per_page);
	$criteria_saver->setSessionForCurrentPage($page);
	$criteria_saver->setSessionForCriteria($_REQUEST);

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


	/* deleted jobs fix */
if ($listings_info ) {
	foreach ($listings_info as $listing_info) 
		$listings_sids[$listing_info['sid']] = $listing_info['sid'];
}
/* END deleted jobs fix */

	$sorted_found_listings_sids = array_keys($listings_sids);
}
else {
	$sorted_found_listings_sids = $found_listings_sids;
}
$criteria_saver->setSessionForObjectSIDs($sorted_found_listings_sids);

$sortable_properties = array();
$property_list = $empty_listing->getPropertyList();

foreach ($property_list as $property)
	$sortable_properties[$property]['is_sortable'] = true;

/**************** P A G I N G *****************/

$listings_structure	= array();

if ($listing_search_structure['current_page'] > $listing_search_structure['pages_number'])
	$listing_search_structure['current_page'] = $listing_search_structure['pages_number'];
if ($listing_search_structure['current_page'] < 1)
	$listing_search_structure['current_page'] = 1;

$sorted_found_listings_sids_by_pages = array_chunk($sorted_found_listings_sids, $listing_search_structure['listings_per_page'], true);

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


/*************** D I S P L A Y ****************/

$metaDataProvider =& SJB_ObjectMother::getMetaDataProvider();
$metadata = array();
$metadata["listing"] = $metaDataProvider->getMetaData("Property_", $listing_structure_meta_data);
$metadata["listing"]["user"]["group"]["caption"]["domain"] = "Miscellaneous";

$waitApprove = false;
if ( !empty($listingsInfoBySID) )
	$waitApprove = SJB_ListingTypeManager::getWaitApproveSettingByListingType( $listingsInfoBySID['listing_type_sid'] );

$tp->assign('show_rates', SJB_Settings::getSettingByName('show_rates'));
$tp->assign('show_comments', SJB_Settings::getSettingByName('show_comments'));
$tp->assign("METADATA", $metadata);
$tp->assign("sorting_field", $listing_search_structure['sorting_field']);
$tp->assign("sorting_order", $listing_search_structure['sorting_order']);
$tp->assign("property", $sortable_properties);
$tp->assign("listing_search", $listing_search_structure);
$tp->assign("search_criteria", $search_criteria_structure);
$tp->assign("listings", $listings_structure);
$tp->assign("waitApprove", $waitApprove);
$tp->assign("apps", $apps);

$hasSubusersWithListings = false;
$subusers = SJB_UserManager::getSubusers($currentUserInfo['sid']);
foreach ($subusers as $subuser) {
	if ($acl->isAllowed('subuser_add_listings', $subuser['sid']) || $acl->isAllowed('subuser_manage_listings', $subuser['sid'])) {
		$hasSubusersWithListings = true;
		break;
	}
}
$tp->assign('hasSubusersWithListings', $hasSubusersWithListings);

$tp->display('my_listings.tpl');
