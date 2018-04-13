<?php

require_once "classifieds/SearchEngine/SearchFormBuilder.php";
require_once "classifieds/SearchEngine/PropertyAliases.php";
require_once "classifieds/Listing/ListingSearcher.php";
require_once "classifieds/Listing/ListingCriteriaSaver.php";

$tp = SJB_System::getTemplateProcessor();
$listing_types = SJB_ListingTypeManager::getAllListingTypesInfo();

$count_listings = array();
foreach ($listing_types as $type) {
	$requested_data = array();
	$requested_data['action'] = 'search';
	$requested_data['listing_type']['equal'] = $type['id'];
	$found_listings_sids = array();
	$requireApprove = SJB_ListingTypeManager::getWaitApproveSettingByListingType($type['sid']);
	if ($requireApprove) 
	    $requested_data['status']['equal'] = 'approved';
	    
    $requested_data['active']['equal'] = '1';
	
    $listing = new SJB_Listing(array(), $type['sid']);
	$id_alias_info = $listing->addIDProperty();
	$listing->addActivationDateProperty();
	$username_alias_info = $listing->addUsernameProperty();
	$listing_type_id_info = $listing->addListingTypeIDProperty();
	$companyNameAliasInfo = $listing->addCompanyNameProperty();
		
	$requested_data['access_type'] = array('accessible' => SJB_UserManager::getCurrentUserSID());

	$criteria = SJB_SearchFormBuilder::extractCriteriaFromRequestData($requested_data, $listing);
		
	$aliases = new SJB_PropertyAliases();
	$aliases->addAlias($id_alias_info);
	$aliases->addAlias($username_alias_info);
	$aliases->addAlias($listing_type_id_info);
	$aliases->addAlias($companyNameAliasInfo);
		
	$searcher = new SJB_ListingSearcher();
	$found_listings_sids = $searcher->getObjectsSIDsByCriteria($criteria, $aliases);
	$count_listings[$type['id']] = count($found_listings_sids);
}
$tp->assign('listings_types', $count_listings);
$tp->display('count_listings.tpl');