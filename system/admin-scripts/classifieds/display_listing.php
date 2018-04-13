<?php

require_once("classifieds/Listing/Listing.php");
require_once("classifieds/Listing/ListingManager.php");
require_once('comments/Comment/CommentManager.php');
require_once('rating/Rating.php');
require_once("forms/Form.php");

$tp = SJB_System::getTemplateProcessor();
$errors = array();
$listing_id = SJB_Request::getVar('listing_id', null);

$display_form = new SJB_Form();
$display_form->registerTags($tp);

if (is_null($listing_id)) {
	$errors['LISTING_ID_DOESNOT_SPECIFIED'] = $listing_id;
}
else {
    $listing = SJB_ListingManager::getObjectBySID($listing_id);
    
	$filename = SJB_Request::getVar('filename', false);
	if ($filename) {
		require_once("miscellaneous/UploadFileManager.php");
		$file = SJB_UploadFileManager::openFile($filename, $listing_id);
		$errors['NO_SUCH_FILE'] = true;
	}

    if (!empty($listing)) {
	    $listing->addPicturesProperty();
	    
    	if ($listing->listing_type_sid == 6) {
			$listing->deleteProperty('access_type');
			$listing->deleteProperty('anonymous');
		}
		
		$access_type_properties = $listing->getProperty('access_type');
		$tp->assign('access_type_properties', $access_type_properties);

		$listing_structure = SJB_ListingManager::createTemplateStructureForListing($listing);
		$tp->assign("listing", $listing_structure);
		
		$display_form = new SJB_Form($listing);
		$display_form->registerTags($tp);
		$form_fields = $display_form->getFormFieldsInfo();
		$tp->assign("form_fields", $form_fields);
		
		$waitApprove = SJB_ListingTypeManager::getWaitApproveSettingByListingType( $listing->listing_type_sid );
		$tp->assign('wait_approve', $waitApprove);
	}
    else {
		$errors['LISTING_DOESNOT_EXIST'] = $listing_id;
	}
}

$comments = SJB_CommentManager::getEnabledCommentsToListing($listing_id);
$comments_total = count($comments);
$rate = SJB_Rating::getRatingNumToListing($listing_id);
	
$tp->assign("errors", $errors);
$tp->assign('comments_total', $comments_total);
$tp->assign('rate', $rate);
	
$tp->display("display_listing.tpl");
