<?php

require_once("classifieds/ListingField/ListingFieldManager.php");
require_once("classifieds/ListingType/ListingTypeManager.php");

$tp = SJB_System::getTemplateProcessor();
$listing_field_sid = isset($_REQUEST['listing_sid']) ? $_REQUEST['listing_sid'] : null;
$errors = array();

if (!is_null($listing_field_sid)) {
	$listing_field = SJB_ListingFieldManager::getFieldInfoBySID($listing_field_sid);
	$listing_type_id = 'Job/Resume';
	if ($listing_field['listing_type_sid'] != 0)
		$listing_type_id = SJB_ListingTypeManager::getListingTypeIDBySID($listing_field['listing_type_sid']);

	$tp->assign("listing_type_id", $listing_type_id);
	$tp->assign("listing_sid", $listing_field_sid);
	$tp->assign("listing_field_info", $listing_field);
	$tp->assign("listing_type_sid", $listing_field['listing_type_sid']);
} 
else {
	$errors[] = 'The system cannot proceed as Listing SID is not set';
}

$tp->assign("errors", $errors);
$tp->display("attention_listing_type_field.tpl");
