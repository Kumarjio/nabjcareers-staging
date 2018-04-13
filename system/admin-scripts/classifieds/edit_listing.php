<?php

require_once("classifieds/Listing/ListingManager.php");
require_once("classifieds/Listing/Listing.php");
require_once('comments/Comment/CommentManager.php');
require_once('rating/Rating.php');
require_once("forms/Form.php");

$listing_id = SJB_Request::getVar('listing_id', null);
$listing_info = SJB_ListingManager::getListingInfoBySID($listing_id);

if (!is_null($listing_info)) {

	$filename = SJB_Request::getVar('filename', false);
	if ($filename) {
		require_once("miscellaneous/UploadFileManager.php");
		$file = SJB_UploadFileManager::openFile($filename, $listing_id);
		$errors['NO_SUCH_FILE'] = true;
	}
	
	$form_submitted = SJB_Request::getVar('action', '') == 'add';
	$_REQUEST = array_merge($_REQUEST, $_FILES);
	$listing_info = array_merge($listing_info, $_REQUEST);

	$listing = new SJB_Listing($listing_info, $listing_info['listing_type_sid']);
	$listing->setSID($listing_id);
	
	// delete special JobG8 property from form
	$listing->deleteProperty('company_name');
	$listing_edit_form = new SJB_Form($listing);
	
	$form_is_submitted = SJB_Request::getVar('action') == 'save_info';
	
	$errors = null;
	if ($form_is_submitted) {
		$listing->addProperty(
			array ( 'id'		=> 'access_list',
					'type'		=> 'multilist',
					'value'		=> SJB_Request::getVar("list_emp_ids"),
					'is_system' => true,
				)
	        );
	}

	if ($form_is_submitted && $listing_edit_form->isDataValid($errors)) {
		SJB_ListingManager::saveListing($listing);
		SJB_Event::dispatch('listingEdited', $listing->getSID());
		
		if (SJB_Request::isAjax()) {
			echo "<p class=\"green\">Listing Saved</p>";
			exit;
		}
	}
	$listing->deleteProperty('access_list');
	
	$comments = SJB_CommentManager::getEnabledCommentsToListing($listing_id);
	$comments_total = count($comments);
	$rate = SJB_Rating::getRatingNumToListing($listing_id);

	$tp = SJB_System::getTemplateProcessor();

	$listing_edit_form->registerTags($tp);
	$listing_structure = SJB_ListingManager::createTemplateStructureForListing($listing);
	if (!isset($listing_structure['access_type']))
		$listing_structure['access_type'] = 'everyone';
	$listing_access_list= SJB_ListingManager::getListingAccessList($listing_id, $listing_structure['access_type']);
	$tp->assign("form_fields", $listing_edit_form->getFormFieldsInfo());
	$tp->assign("listing", $listing_structure);
	$tp->assign("errors", $errors);
	$tp->assign("listing_id", $listing_id);
	$tp->assign("listing_access_list", $listing_access_list);
	$tp->assign('comments_total', $comments_total);
	$tp->assign('rate', $rate);
	
	$tp->display("edit_listing.tpl");
}


