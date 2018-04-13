<?php

require_once("classifieds/Browse/UrlParamProvider.php");
require_once("classifieds/Listing/ListingManager.php");
require_once("classifieds/Listing/ListingCriteriaSaver.php");
require_once("classifieds/MetaDataProvider.php");
require_once("forms/Form.php");
require_once('users/User/UserManager.php');
require_once('comments/Comment/CommentManager.php');
require_once("applications/Applications.php");

$tp = SJB_System::getTemplateProcessor();
$display_form = new SJB_Form();
$display_form->registerTags($tp);

$errors = array();
$template 	= SJB_Request::getVar('display_template', 'manage_resume.tpl');
$action = substr($template, 0, -4);
$listing_id = SJB_Request::getVar("listing_id");
if (isset($_REQUEST['passed_parameters_via_uri'])) {
	$passed_parameters_via_uri = SJB_UrlParamProvider::getParams();
	$listing_id = isset($passed_parameters_via_uri[0]) ? $passed_parameters_via_uri[0] : null;
}

$show_404_header = SJB_System::getSettingByName('exp_listings_404_page');

if ($show_404_header) {
	$header			= $_SERVER['SERVER_PROTOCOL'] . ' 404  Not Found';
	$header_status	= "Status: 404  Not Found";
	SJB_System::setGlobalTemplateVariable('page_not_found', false);	
}

if (is_null($listing_id)) {
	$errors['UNDEFINED_LISTING_ID'] = true;
}
elseif (is_null($listing = SJB_ListingManager::getObjectBySID($listing_id)) || !SJB_ListingManager::isListingAccessableByUser($listing_id, SJB_UserManager::getCurrentUserSID())) {
	$errors['WRONG_LISTING_ID_SPECIFIED'] = true;
}
elseif (!$listing->isActive() && $listing->getUserSID() != SJB_UserManager::getCurrentUserSID()) {
	$errors['LISTING_IS_NOT_ACTIVE'] = true;
}
elseif ( ($listingStatus = SJB_ListingManager::getListingApprovalStatusBySID($listing_id)) != 'approved' && SJB_ListingTypeManager::getWaitApproveSettingByListingType($listing->listing_type_sid) == 1 && $listing->getUserSID() != SJB_UserManager::getCurrentUserSID()) {
	$errors['LISTING_IS_NOT_APPROVED'] = true;
}
elseif ( (SJB_ListingTypeManager::getListingTypeIDBySID($listing->listing_type_sid) == 'Resume' && ( $template == 'display_job.tpl' OR SJB_System::getURI() == '/print-job/' ) ) || 
  (SJB_ListingTypeManager::getListingTypeIDBySID($listing->listing_type_sid) == 'Job' && ($template == 'manage_resume.tpl' OR SJB_System::getURI() == '/print-resume/' ) ) ) {
		$errors['WRONG_DISPLAY_TEMPLATE'] = true;
} else {
	
	$listing_type_id = SJB_ListingTypeManager::getListingTypeIDBySID($listing->listing_type_sid);
	if (SJB_System::getURI() == '/print-listing/') {
		SJB_HelperFunctions::redirect( SJB_System::getSystemSettings('SITE_URL') . '/print-' . strtolower($listing_type_id) . '/?listing_id=' . $listing_id);
		exit;
	}
	
	$listing->addPicturesProperty();
	
	$display_form = new SJB_Form($listing);
	$display_form->registerTags($tp);
	
	$form_fields = $display_form->getFormFieldsInfo();
	if ($action !== 'print_listing')
		SJB_ListingManager::incrementViewsCounterForListing($listing_id);
	$listing_structure = SJB_ListingManager::createTemplateStructureForListing($listing);
	$filename = SJB_Request::getVar('filename', false);
	if ($filename) {
		require_once("miscellaneous/UploadFileManager.php");
		$file = SJB_UploadFileManager::openFile($filename, $listing_id);
		$errors['NO_SUCH_FILE'] = true;
	}
	
	$metaDataProvider =& SJB_ObjectMother::getMetaDataProvider();
	$tp->assign(
		"METADATA", array( 
			"listing"     => $metaDataProvider->getMetaData("Property_", $listing_structure['METADATA']), 
			"form_fields" => $metaDataProvider->getFormFieldsMetadata("FormFieldCaptions", $form_fields), 
			"form_field" => array('caption' => array('domain' => 'FormFieldCaptions'))));

	$comments = '';
	$comments_total = '';
	
	if (SJB_Settings::getSettingByName('show_comments') == '1') {
		$comments = SJB_CommentManager::getEnabledCommentsToListing($listing_id);
		$comments_total = count($comments);
	}
	
	$searchId = SJB_Request::getVar("searchId", "");
	$page = SJB_Request::getVar("page", "");
	$criteria_saver = new SJB_ListingCriteriaSaver($searchId);
	$prevNextIds = $criteria_saver->getPreviousAndNextObjectID($listing_id);
	$search_criteria_structure = $criteria_saver->createTemplateStructureForCriteria();
	$tp->assign("isApplied", SJB_Applications::isApplied($listing_id, SJB_UserManager::getCurrentUserSID()));
	$tp->assign('show_rates', SJB_Settings::getSettingByName('show_rates'));
	$tp->assign('show_comments', SJB_Settings::getSettingByName('show_comments'));
	$tp->assign('comments', $comments);
	$tp->assign('comments_total', $comments_total);
	$tp->assign('listing_id', $listing_id);
	$tp->assign('user_logged_in', SJB_UserManager::isUserLoggedIn());
	$tp->assign("form_fields", $form_fields);
	$tp->assign('video_fields', SJB_HelperFunctions::takeMediaFields($form_fields));
	$listing_structure = SJB_ListingManager::newValueFromSearchCriteria($listing_structure, $criteria_saver->criteria);
	$tp->filterThenAssign("listing", $listing_structure);
	$tp->assign("prev_next_ids", $prevNextIds);
	$tp->assign("searchId", $searchId);
	$tp->assign("page", $page);
	$tp->filterThenAssign("search_criteria", $search_criteria_structure);
	$tp->filterThenAssign("search_uri", $criteria_saver->getUri());
}

if ($errors && $show_404_header) {
	foreach($errors as $k => $v) {
		switch($k) {
			case 'UNDEFINED_LISTING_ID':
			case 'WRONG_LISTING_ID_SPECIFIED':
			case 'LISTING_IS_NOT_ACTIVE':
			case 'LISTING_IS_NOT_APPROVED':
				header($header_status);
				header($header);
				SJB_System::setGlobalTemplateVariable('page_not_found', true);
				break;
		}
	}
}
if ( $field_id = SJB_Request::getVar('field_id'))
{
	$tp->assign('field_id', $field_id);
}

$tp->assign("errors", $errors);
$tp->display($template);
