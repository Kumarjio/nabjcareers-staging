<?php

require_once "SearchResultsTP_Admin.php";
require_once "ObjectMother.php";
require_once "forms/FormCollection.php";
require_once "classifieds/Alphabet/AlphabetManager.php";
require_once "users/User/UserSearcher.php";
require_once "users/User/UserCriteriaSaver.php";

$tp = SJB_System::getTemplateProcessor();
$template = SJB_Request::getVar('display_template');
$page = 1;
$searchId = SJB_Request::getVar('searchId', time());
if (!empty($_REQUEST["page"]))
	$page = intval($_REQUEST["page"]);
$items_per_page = SJB_Request::getVar('listings_per_page', false);
/// $listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID($_REQUEST["listing_type_id"]);
$alphabets = SJB_AlphabetManager::getAlphabetsForDisplay();
$abArr = array();
foreach ($alphabets as $alphabet)
	$abArr[] = explode(' ', $alphabet['value']);

$action = SJB_Request::getVar('action', 'search_form');
if (SJB_Request::getVar('first_char')) {
	$action = 'search';
	$_REQUEST['LastName']['first_char_like'] = SJB_Request::getVar('first_char');
}
elseif (!isset($_REQUEST['LastName']) || $_REQUEST['LastName']['like'] == ''){
	$_REQUEST['LastName']['not_empty'] = true;
}
$userGroupSid = SJB_UserGroupManager::getUserGroupSIDByID('Employer');
$user = new SJB_User(array(), $userGroupSid);
$_REQUEST['active']['equal'] = 1; 
$search_form_builder = new SJB_SearchFormBuilder($user);
$criteria_saver = new SJB_UserCriteriaSaver($searchId);
$criteria_saver->setSessionForOrderInfo($_REQUEST); 
if (isset($_REQUEST['searchId'])) {
	$action = 'search';
	$_REQUEST = array_merge($_REQUEST, $criteria_saver->getCriteria());
	if (!$items_per_page)
	  $items_per_page = $criteria_saver->listings_per_page;
}

$items_per_page = $items_per_page?$items_per_page:10;
$criteria = $search_form_builder->extractCriteriaFromRequestData($_REQUEST, $user);
if ($items_per_page)
	$criteria_saver->setSessionForListingsPerPage($items_per_page);
$search_form_builder->setCriteria($criteria);
$search_form_builder->registerTags($tp);

$form_fields = $search_form_builder->getFormFieldsInfo();
$tp->assign('form_fields', $form_fields);
$metaDataProvider = SJB_ObjectMother::getMetaDataProvider();
$tp->assign("METADATA",
	array(
		"form_fields" => $metaDataProvider->getFormFieldsMetadata("FormFieldCaptions", $form_fields), 
		"form_field" => array('caption' => array('domain' => 'FormFieldCaptions')),
	) 
);

$tp->assign('action', $action);
$tp->assign('alphabets', $abArr);
$tp->display($template);

if ($action == 'search') {
	$sorting_field = SJB_Request::getVar('sorting_field', false);
	$sorting_order = SJB_Request::getVar('sorting_order', false);
	if (isset($_REQUEST['searchId']) && !$sorting_field){
		$order_info = $criteria_saver->order_info;
		if ($order_info) {
			$sorting_field = $order_info['sorting_field'];
			$sorting_order = $order_info['sorting_order'];
		}
	}
	if (!$sorting_field) {
		$sorting_field = 'LastName';
		$sorting_order = 'ASC';
	}
	$inner_join = false;
	$sortByListingsNumber = false;
	$inner_join = array( 'users_properties' => array( 'sort_field' => 'value', 'join_field' => 'object_sid', 'join_field2' => 'sid', 'join' => 'LEFT JOIN', 'count'=>'COUNT(*) as countRows', 'groupBy'=>'`users_properties`.`object_sid`' ) );
	$searcher = new SJB_UserSearcher(false, $sorting_field, $sorting_order, $inner_join, array('limit'=>($page - 1) * $items_per_page, 'num_rows'=>$items_per_page));
	$found_users = array();
	$found_users_sids = array();
	$sorted = array();
	$found_users_by_criteria = $searcher->getObjectsByCriteria($criteria, null, array(), true);
	$foundObjectSIDs = $searcher->getFoundObjectSIDs();
	/********************************sort**********************************/
	if (!empty($foundObjectSIDs)) {
		$foundObjectSIDs = implode(',',$foundObjectSIDs);
		if ($sorting_field == 'number_of_jobs') {
			if ( SJB_ListingTypeManager::getWaitApproveSettingByListingType($listing_type_sid) == 1)
				$count = "sum( if( `listings`.`status` = 'approved', `listings`.`active`, 0 ) )";
			else 
				$count = "sum(`listings`.`active`)";
			$sql = "SELECT `users`. sid , $count AS {$sorting_field}
				FROM `users`
				LEFT JOIN users_properties  ON  users.sid = `users_properties`.object_sid
				LEFT JOIN `listings` ON `listings`.`user_sid`= `users`.`sid`
				WHERE `users`.`sid`
				IN ($foundObjectSIDs)
				GROUP BY `users`.`sid`
				ORDER BY {$sorting_field} {$sorting_order}";
		}
		else {
			$sql = "SELECT users. sid , CAST( {$sorting_field}.value AS CHAR ) AS {$sorting_field}
				FROM users
				LEFT JOIN users_properties {$sorting_field} ON ( users.sid = $sorting_field.object_sid
				AND $sorting_field.id = '$sorting_field' )
				WHERE users.sid
				IN ($foundObjectSIDs)
				ORDER BY {$sorting_field} {$sorting_order}";
		}
		$sortResult = SJB_DB::query($sql);
		$foundObjectSIDs = array();
		foreach ($sortResult as $value) {
			$foundObjectSIDs[] = $value['sid'];
			$found_users[$value['sid']] = $found_users_by_criteria[$value['sid']];
		} 
	}
	/**********************************************************************/
	
	$criteria_saver->setSession($_REQUEST, $foundObjectSIDs);
	foreach ( $found_users as $id => $user ) {
		$countListings = SJB_ListingDBManager::getActiveAndApproveListingsNumberByUserSID($user->sid);
		$user->addProperty(array( 'id' => 'countListings', 'type' => 'string', 'value' => $countListings ));
		if ($user->getProperty('LastName')) {
    		$found_users_sids[$user->getSID()] = $user->getSID();
    		$found_users[$id] = $user;
    	}
	}
	
	global $affectedRows__;
	$usersCount =$affectedRows__;
	$form_collection = new SJB_FormCollection($found_users);
    $form_collection->registerTags($tp);
    $pages = array();
    
	for ($i = $page - 3; $i < $page + 3; $i ++) {
		if ($i > 0)
			$pages[] = $i;
		if ($i * $items_per_page > $usersCount)
			break;
	}
	
	$totalPages = ceil($usersCount / $items_per_page);
	if (empty($totalPages))
		$totalPages = 1;
	
	if (array_search(1, $pages) === false)
		array_unshift($pages, 1);
	if (array_search($totalPages, $pages) === false)
		array_push($pages, $totalPages);

    $tp->assign("sorting_order", $sorting_order);
    $tp->assign("sorting_field", $sorting_field);
    $tp->assign("found_users_sids", $found_users_sids);
    $tp->assign("listings_per_page", $items_per_page);
    $tp->assign("searchId", $searchId);
    $tp->assign("usersCount", $usersCount);
    $tp->assign("current_page", $page);
    $tp->assign("pages_number", $totalPages);
    $tp->display('search_result_LastName_admin.tpl');
}


