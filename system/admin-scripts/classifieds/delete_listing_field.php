<?php


require_once("classifieds/ListingField/ListingFieldManager.php");

$listing_field_sid = isset($_REQUEST['sid']) ? $_REQUEST['sid'] : null;

if (!is_null($listing_field_sid)) {
	
	SJB_ListingFieldManager::deleteListingFieldBySID($listing_field_sid);
	
	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/listing-fields/");
	
} else {
	
	echo 'The system  cannot proceed as Listing Field SID is not set';
	
}

