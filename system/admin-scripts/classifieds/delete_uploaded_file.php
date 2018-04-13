<?php


require_once("classifieds/Listing/ListingManager.php");

require_once("miscellaneous/UploadFileManager.php");

$listing_id = isset($_REQUEST['listing_id']) ? $_REQUEST['listing_id'] : null;

$listing_info = SJB_ListingManager::getListingInfoBySID($listing_id);

$field_id = isset($_REQUEST['field_id']) ? $_REQUEST['field_id'] : null;

if (is_null($listing_id) || is_null($field_id)) {
	
	$errors['PARAMETERS_MISSED'] = 1;
	
} elseif (is_null($listing_info) || !isset($listing_info[$field_id])) {
	
	$errors['WRONG_PARAMETERS_SPECIFIED'] = 1;
	
} else {
	
	$uploaded_file_id = $listing_info[$field_id];
	
	SJB_UploadFileManager::deleteUploadedFileByID($uploaded_file_id);
	
	$listing_info[$field_id] = "";
	
	$listing = new SJB_Listing($listing_info, $listing_info['listing_type_sid']);
	
	$listing->setSID($listing_id);
	
	SJB_ListingManager::saveListing($listing);

}

$template_processor = SJB_System::getTemplateProcessor();

$template_processor->assign("errors", isset($errors) ? $errors : null);

$template_processor->assign("listing_id", $listing_id);

$template_processor->display("delete_uploaded_file.tpl");

