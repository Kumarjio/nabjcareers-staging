<?php


require_once("classifieds/ListingField/ListingFieldManager.php");

$listing_field_sid = isset($_REQUEST['sid']) ? $_REQUEST['sid'] : null;

if (!is_null($listing_field_sid)) {
	
	$listing_field_info = SJB_ListingFieldManager::getFieldInfoBySID($listing_field_sid);
	
	SJB_ListingFieldManager::deleteListingFieldBySID($listing_field_sid);
	
	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/edit-listing-type/?sid=" . $listing_field_info['listing_type_sid']);
	
} else {
	
	echo 'The system  cannot proceed as Listing Field SID is not set';
	
}

