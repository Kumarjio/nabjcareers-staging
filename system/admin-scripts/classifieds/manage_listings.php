<?php

require_once "classifieds/SearchEngine/SearchFormBuilder.php";
require_once "classifieds/SearchEngine/PropertyAliases.php";
require_once("classifieds/ListingType/ListingTypeManager.php");
require_once("classifieds/Listing/ListingManager.php");
require_once "classifieds/Listing/ListingRequestCreator.php";
require_once "ObjectMother.php";

$template_processor = SJB_System::getTemplateProcessor();

// если хоть для одного типа есть настройка waitApprove, то покажем это поле
$types = SJB_ListingTypeManager::getAllListingTypesInfo();
$waitApprove = 0;
foreach($types as $type) {
	$waitApprove += $type['waitApprove'];
}
$template_processor->assign('showApprovalStatusField', $waitApprove == 0 ? false : true);
$template_processor->assign('listingsTypesInfo', $types);


$show_search_form = 1;
if (!empty($_REQUEST))
	$show_search_form = 0;
	
$template_processor->assign('show_search_form', $show_search_form);

/**************** S E A R C H   F O R M ****************/
$listing_type_id = isset($_REQUEST['listing_type_id']) ? $_REQUEST['listing_type_id'] : 0;
$listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id);

$listing = &SJB_ObjectMother::createListing(array(), $listing_type_sid);
$id_alias_info			 = $listing->addIDProperty();
$username_alias_info	 = $listing->addUsernameProperty();
$listing_type_alias_info = $listing->addListingTypeIDProperty();
$listing->addActivationDateProperty();
$listing->addExpirationDateProperty();
$listing->addActiveProperty();
$listing->addKeywordsProperty();
$listing->addDataSourceProperty();

$aliases = new SJB_PropertyAliases();
$aliases->addAlias($username_alias_info);
$aliases->addAlias($listing_type_alias_info);
$aliases->addAlias($id_alias_info);

$search_form_builder = new SJB_SearchFormBuilder($listing);
$criteria_saver = SJB_ObjectMother::createListingCriteriaSaver();

if (isset($_REQUEST['restore']))
	$_REQUEST = array_merge($_REQUEST, $criteria_saver->getCriteria());

$criteria = SJB_SearchFormBuilder::extractCriteriaFromRequestData($_REQUEST, $listing);

$search_form_builder->setCriteria($criteria);
$search_form_builder->registerTags($template_processor);
$template_processor->display("manage_listings.tpl");

/************* S E A R C H   F O R M   R E S U L T S *************/

$default_listings_per_page = 10;
$found_listings_sids = array();
$searcher = SJB_ObjectMother::createListingSearcher();

if (SJB_Request::getVar('action', '') == 'search' || isset($_REQUEST['restore'])) {
	if (!isset($_REQUEST['restore']))
		$criteria_saver->resetSearchResultsDisplay();
	
	$found_listings_sids = $searcher->getObjectsSIDsByCriteria($criteria, $aliases); //get found listing sids
	
	// save 'listings per page' in the session
    $listings_per_page = SJB_Request::getVar('listings_per_page', $criteria_saver->getListingsPerPage());
    if (empty($listings_per_page))
        $listings_per_page = $default_listings_per_page;
    
	$criteria_saver->setSessionForListingsPerPage($listings_per_page);
	$criteria_saver->setSessionForCurrentPage(SJB_Request::getVar('page', 1));
	$criteria_saver->setSessionForCriteria($_REQUEST);
	
	$orderInfo = $criteria_saver->getOrderInfo();
	if (isset($_REQUEST['sorting_field'], $_REQUEST['sorting_order'])) {
	    $orderInfo = array (
	    	'sorting_field'	=> $_REQUEST['sorting_field'],
			'sorting_order'	=> $_REQUEST['sorting_order']);
	}
	if (empty($orderInfo)) {
	    $orderInfo = array(
			'sorting_field'	=> 'activation_date',
			'sorting_order'	=> 'DESC');
	}
	$criteria_saver->setSessionForOrderInfo($orderInfo);
}
else {
	$criteria_saver->resetSearchResultsDisplay();
	return;
}
$criteria_saver->setSessionForObjectSIDs($found_listings_sids);

$listing_search_structure  = $criteria_saver->createTemplateStructureForSearch();

/**************** S O R T I N G *****************/
$empty_listing = SJB_ObjectMother::createListing(array(), $listing_type_sid);
$empty_listing->addPicturesProperty();
$empty_listing->addIDProperty();
$empty_listing->addListingTypeIDProperty();
$empty_listing->addActivationDateProperty();
$empty_listing->addExpirationDateProperty();
$empty_listing->addUsernameProperty();
$empty_listing->addPicturesProperty();
$empty_listing->addNumberOfViewsProperty();
$empty_listing->addActiveProperty();
$empty_listing->addKeywordsProperty();
$empty_listing->addDataSourceProperty();

$listing->addRejectReasonProperty();

$sorted_found_listings_sids = array();

if ($empty_listing->propertyIsSet($listing_search_structure['sorting_field'])) {
	$sorting_field = $listing_search_structure['sorting_field'];
	$sorting_order = $listing_search_structure['sorting_order'];
	
	switch ($sorting_field) {
		
		case 'username':
			$ids = join(", ", $found_listings_sids);
			$sql = "	SELECT		listings.* 
						FROM 		listings 
						LEFT JOIN	users on listings.user_sid = users.sid
						WHERE 		listings.sid IN ({$ids})  
						ORDER BY users.username {$sorting_order}";
		
			$listings_info = SJB_DB::query($sql);
			break;
			
		case 'listing_type':
			$ids = join(", ", $found_listings_sids);
			$sql = "	SELECT		listings.* 
						FROM 		listings 
						LEFT JOIN	listing_types on listings.listing_type_sid = listing_types.sid
						WHERE 		listings.sid IN ({$ids})  
						ORDER BY listing_types.id {$sorting_order}";
	
			$listings_info = SJB_DB::query($sql);
			break;
			
		case 'id':
			$ids = join(", ", $found_listings_sids);
			$sql = "	SELECT		listings.* 
						FROM 		listings 
						WHERE		listings.sid IN ({$ids})  
						ORDER BY sid $sorting_order";
	
			$listings_info = SJB_DB::query($sql);
			break;
		default:
			$property = $empty_listing->getProperty($sorting_field);
			$listing_request_creator = &new SJB_ListingRequestCreator($found_listings_sids, array('property'		=> $property, 'sorting_order' 	=> $sorting_order));
			$listings_info = SJB_DB::query($listing_request_creator->getRequest());
			break;
	}

	$listings_sids = array();
	foreach ($listings_info as $listing_info)
		$listings_sids[$listing_info['sid']] = $listing_info['sid'];
	$sorted_found_listings_sids = array_keys($listings_sids);
	$criteria_saver->setSessionForObjectSIDs($sorted_found_listings_sids);
}
else {
	$sorted_found_listings_sids = $found_listings_sids;
	$criteria_saver->setSessionForObjectSIDs($found_listings_sids);
}

/**************** P A G I N G *****************/

$listings_structure	= array();

if ($listing_search_structure['current_page'] > $listing_search_structure['pages_number'])
	$listing_search_structure['current_page'] = $listing_search_structure['pages_number'];
if ($listing_search_structure['current_page'] < 1)
	$listing_search_structure['current_page'] = 1;

if (is_null($listing_search_structure['listings_per_page']))
	$listing_search_structure['listings_per_page'] = 1;

$sorted_found_listings_sids_by_pages = array_chunk($sorted_found_listings_sids, $listing_search_structure['listings_per_page'], true);

/************* S T R U C T U R E **************/
$listings_structure = array();

if (isset($sorted_found_listings_sids_by_pages[$listing_search_structure['current_page']-1])) {
    foreach ($sorted_found_listings_sids_by_pages[$listing_search_structure['current_page']-1] as $sid) {
		$listing = SJB_ListingManager::getObjectBySID($sid);
		$listing->addPicturesProperty();
		$listings_structure[$listing->getID()] = SJB_ListingManager::createTemplateStructureForListing($listing);
		// представим строку JobCategory в виде массива
		$listings_structure[$listing->getID()]['JobCategory']	= explode(",", $listings_structure[$listing->getID()]['JobCategory']);
	}
}

/*************** D I S P L A Y ****************/
$template_processor->assign("sorting_field", $listing_search_structure['sorting_field']);
$template_processor->assign("sorting_order", $listing_search_structure['sorting_order']);
$template_processor->assign("listing_search", $listing_search_structure);
$template_processor->assign("search_criteria", $criteria_saver->createTemplateStructureForCriteria());
$template_processor->assign("listings", $listings_structure);
$template_processor->assign("count_listings", count($sorted_found_listings_sids));
$template_processor->display("display_results.tpl");

