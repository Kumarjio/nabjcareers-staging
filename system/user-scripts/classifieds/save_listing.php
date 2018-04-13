<?php

require_once("users/User/UserManager.php");
require_once("classifieds/SavedListings.php");

$template_processor = SJB_System::getTemplateProcessor();
$listing_id = isset($_REQUEST['listing_id']) ? $_REQUEST['listing_id'] : null;
$listing_type = SJB_Request::getVar('listing_type', 'job');
$displayForm = SJB_Request::getVar('displayForm', false);
$error = null;
if(!SJB_Acl::getInstance()->isAllowed('save_' . trim($listing_type))) {
	$error = 'DENIED_SAVE_LISTING';
}
if(SJB_UserManager::isUserLoggedIn()) {
	if (!$error) {
		if (!is_null($listing_id)) {
			if (SJB_UserManager::isUserLoggedIn()) 
				SJB_SavedListings::saveListingOnDB($listing_id, SJB_UserManager::getCurrentUserSID());
			else 
				SJB_SavedListings::saveListingInCookie($listing_id);
			$template_processor->assign("saved_listing", SJB_SavedListings::getSavedListingsByUserAndListingSid(SJB_UserManager::getCurrentUserSID(), $listing_id));
		} 
		else 
			$error = 'LISTING_ID_NOT_SPECIFIED';
	}
	$params = SJB_Request::getVar('params', false);
	$searchId = SJB_Request::getVar('searchId', false);
	$page = SJB_Request::getVar('page', false);
	$template_processor->assign("params", $params);
	$template_processor->assign("searchId", $searchId);
	$template_processor->assign("page", $page);
	$template_processor->assign("listing_type", $listing_type);
	$template_processor->assign("listing_sid", $listing_id);
	$template_processor->assign("from_login", SJB_Request::getVar("from_login", false));
	$template_processor->assign("error", $error);
	$template_processor->assign("displayForm", $displayForm);
	$template_processor->display("save_listing.tpl");
}
else {
	$template_processor->assign("return_url", base64_encode(SJB_Navigator::getURIThis()."&from_login=1"));
	$template_processor->assign("ajaxRelocate", true);
	$template_processor->display("../users/login.tpl");
}

