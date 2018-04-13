<?php

require_once ("classifieds/Browse/UrlParamProvider.php");
require_once ("classifieds/Listing/ListingManager.php");
require_once ("classifieds/Listing/ListingCriteriaSaver.php");
require_once ("classifieds/MetaDataProvider.php");
require_once ("forms/Form.php");
require_once ('users/User/UserManager.php');
require_once ('comments/Comment/CommentManager.php');

$tp = SJB_System::getTemplateProcessor ();

$errors = array ();
$criteria_saver = new SJB_ListingCriteriaSaver ( 'MyListings' );

$listing_id = SJB_Request::getVar ( "listing_id" );
if (isset ( $_REQUEST ['passed_parameters_via_uri'] )) {
	$passed_parameters_via_uri = SJB_UrlParamProvider::getParams ();
	$listing_id = isset ( $passed_parameters_via_uri [0] ) ? $passed_parameters_via_uri [0] : null;
}

$template = SJB_Request::getVar ( "display_template", "display_listing.tpl" );

if (is_null ( $listing_id )) {
	$errors ['UNDEFINED_LISTING_ID'] = true;
} elseif (is_null ( $listing = SJB_ListingManager::getObjectBySID ( $listing_id ) )) {
	$errors ['WRONG_LISTING_ID_SPECIFIED'] = true;
} elseif (! $listing->isActive () && $listing->getUserSID () != SJB_UserManager::getCurrentUserSID ()) {
	$errors ['LISTING_IS_NOT_ACTIVE'] = true;
} else {
	
	$listing->addPicturesProperty ();
	
	if ($listing->getUserSID () != SJB_UserManager::getCurrentUserSID ())
		$errors ['NOT_OWNER'] = true;
	
	$display_form = new SJB_Form ( $listing );
	$display_form->registerTags ( $tp );
	
	$form_fields = $display_form->getFormFieldsInfo ();
	
	$listing_structure = SJB_ListingManager::createTemplateStructureForListing ( $listing );
	$filename = SJB_Request::getVar ( 'filename', false );
	if ($filename) {
		require_once ("miscellaneous/UploadFileManager.php");
		$file = SJB_UploadFileManager::openFile ( $filename, $listing_id );
		$errors ['NO_SUCH_FILE'] = true;
	}
	$prev_and_next_listing_id = $criteria_saver->getPreviousAndNextObjectID ( $listing_id );
	$metaDataProvider = & SJB_ObjectMother::getMetaDataProvider ();
	$tp->assign ( "METADATA", array ("listing" => $metaDataProvider->getMetaData ( "Property_", $listing_structure ['METADATA'] ), "form_fields" => $metaDataProvider->getFormFieldsMetadata ( "FormFieldCaptions", $form_fields ), "form_field" => array ('caption' => array ('domain' => 'FormFieldCaptions' ) ) ) );
	
	$comments = '';
	$comments_total = '';
	if (SJB_Settings::getSettingByName ( 'show_comments' ) == '1') {
		$comments = SJB_CommentManager::getEnabledCommentsToListing ( $listing_id );
		$comments_total = count ( $comments );
	}
	
	$tp->assign ( 'show_rates', SJB_Settings::getSettingByName ( 'show_rates' ) );
	$tp->assign ( 'show_comments', SJB_Settings::getSettingByName ( 'show_comments' ) );
	$tp->assign ( 'comments', $comments );
	$tp->assign ( 'comments_total', $comments_total );
	$tp->assign ( 'listing_id', $listing_id );
	$tp->assign ( 'user_logged_in', SJB_UserManager::isUserLoggedIn () );
	$tp->assign ( "form_fields", $form_fields );
	$tp->assign('video_fields', SJB_HelperFunctions::takeMediaFields($form_fields));
	$tp->filterThenAssign ( "listing", $listing_structure );
	$tp->assign ( "prev_next_ids", $prev_and_next_listing_id );
}

$search_criteria_structure = $criteria_saver->createTemplateStructureForCriteria ();

$tp->filterThenAssign ( "search_criteria", $search_criteria_structure );
$tp->assign ( "errors", $errors );
$tp->display ( $template );

