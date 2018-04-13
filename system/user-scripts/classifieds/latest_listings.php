<?php

require_once("classifieds/Listing/ListingManager.php");

$template = SJB_Request::getVar('listings_template', 'latest_listings.tpl');

$count_listing = SJB_Request::getVar('count_listing', 1);
$listing_type = SJB_Request::getVar('listing_type', 'Job');
$number_of_rows = SJB_Request::getVar('number_of_rows', 1);
$number_of_cols = SJB_Request::getVar('number_of_cols', 1);

$listings = SJB_ListingManager::getLastListings($count_listing,$listing_type);

$listing_structure = array();
$listings_structure = array();
$listing_structure_meta_data = array();

foreach ($listings as $listing) {
	$listing_structure = SJB_ListingManager::createTemplateStructureForListing($listing);
	@$listing_structure['formatted_date'] = date('D, d M Y H:i:s',strtotime($listing_structure['activation_date']));
	
	
	$listings_structure[] = $listing_structure;	
	if (isset($listing_structure['METADATA'])) {
		$listing_structure_meta_data = array_merge($listing_structure_meta_data, $listing_structure['METADATA']);
	}
}

$tp = SJB_System::getTemplateProcessor();

$metaDataProvider = SJB_ObjectMother::getMetaDataProvider();
$tp->assign
(
	"METADATA",  
	array
	(
		"listing" => $metaDataProvider->getMetaData("Property_", $listing_structure_meta_data), 
	)
);

$tp->assign("listings", $listings_structure);
$tp->assign("number_of_rows", $number_of_rows);

$tp->assign("number_of_cols", $number_of_cols);
$tp->assign("count_listing", $count_listing);
$tp->assign("lastBuildDate" ,date('D, d M Y H:i:s'));
$tp->display($template);
