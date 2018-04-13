<?php


require_once("classifieds/ListingType/ListingTypeManager.php");

$listing_type_sid = isset($_REQUEST['sid']) ? $_REQUEST['sid'] : null;

if (!is_null($listing_type_sid)) {
	
	SJB_ListingTypeManager::deleteListingTypeBySID($listing_type_sid);
	
	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/listing-types/");
	
} else {
	
	echo 'The system  cannot proceed as Listing Type SID is not set';
	
}

