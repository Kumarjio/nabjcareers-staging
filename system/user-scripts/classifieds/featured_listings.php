<?php

require_once("classifieds/Listing/ListingManager.php");

$template = SJB_Request::getVar("featured_listings_template", 'featured_listings.tpl');
$number_of_rows = SJB_Request::getVar('number_of_rows', 1);
$number_of_cols = SJB_Request::getVar('number_of_cols', 1);
$listing_type = SJB_Request::getVar('listing_type', '');
$count_listing = SJB_Request::getVar('count_listing', $number_of_cols * $number_of_rows);

$listings = SJB_ListingManager::getFeaturedListings($count_listing,$listing_type);

$listing_structure = array();
$listings_structure = array();
$listing_structure_meta_data = array();

foreach ($listings as $listing) {	
	$listing_structure = SJB_ListingManager::createTemplateStructureForListing($listing);
	$listings_structure[] = $listing_structure;	
	if (isset($listing_structure['METADATA']))
		$listing_structure_meta_data = array_merge($listing_structure_meta_data, $listing_structure['METADATA']);
}

$tp = SJB_System::getTemplateProcessor();

$metaDataProvider = SJB_ObjectMother::getMetaDataProvider();
$tp->assign (
	"METADATA",	array (
		"listing" => $metaDataProvider->getMetaData("Property_", $listing_structure_meta_data), 
	)
);

$tp->assign("listings", $listings_structure);
$tp->assign("number_of_rows", $number_of_rows);
$tp->assign("number_of_cols", $number_of_cols);
$tp->display($template);
