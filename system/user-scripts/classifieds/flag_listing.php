<?php
require_once 'miscellaneous/AdminNotifications.php';
require_once('miscellaneous/Captcha.php');

$tp = SJB_System::getTemplateProcessor();

$listingSID = SJB_Request::getVar('listing_id');
$template   = 'flag_listing.tpl';
$errors     = array();

$isCaptcha  = (SJB_System::getSettingByName('flagListingCaptcha') == 1) ? 1 : 0;
if ($isCaptcha) {
	$captcha = new SJB_Captcha($_REQUEST, 'modal');
	$captcha_form = SJB_ObjectMother::createForm($captcha);
	$captcha_form->registerTags($tp);
	$tp->assign('captcha', array_pop($captcha_form->form_fields));
}
if ($listingSID) {
	// Flag listing
	$reason  = SJB_Request::getVar('reason');
	$comment = SJB_Request::getVar('comment');
	
	$formSubmitted  = SJB_Request::getVar('action');
	
	if ($formSubmitted) {
		if ( $isCaptcha == 1 ) {
			$captcha_errors = array();
			$captcha_form->isDataValid($captcha_errors);
			foreach ($captcha_errors as $error)
				$errors[$error] = true;
		}
	}
	
	$listing = SJB_ListingManager::getObjectBySID($listingSID);
	$listingInfo = SJB_ListingManager::createTemplateStructureForListing($listing);
			
	if ($formSubmitted == 'flag' && empty($errors)) {
		
		$result  = SJB_ListingManager::flagListingBySID($listingSID, $reason, $comment);

		if (SJB_AdminNotifications::isAdminNotifiedOnListingFlagged()) {
			$send = SJB_AdminNotifications::sendAdminListingFlaggedLetter($listingInfo);
		}
		// notify subadmins
		$subAdminsToNotify = SJB_AdminNotifications::isSubAdminNotifiedOnListingFlagged();
		if (is_array($subAdminsToNotify) && !empty($subAdminsToNotify))
			SJB_AdminNotifications::sendAdminListingFlaggedLetter($listingInfo, $subAdminsToNotify);
		
		$template = 'flag_listing_sended.tpl';
		
	} else {
		// Show form to reason
		if (is_numeric($listing->getListingTypeSID())) {
			$reasons = SJB_DB::query("SELECT * FROM `flag_listing_settings` WHERE FIND_IN_SET(?n, `listing_type_sid`)", $listing->getListingTypeSID());
		} else {
			$reasons = array();
		}
		
		$tp->assign('flag_types', $reasons);
	}
	
	$tp->assign('listing_id', $listingSID);
	$tp->assign('listing_type_id', strtolower($listingInfo['type']['id']) );
	
	if (!empty($errors)) {
		$tp->assign('errors', $errors);
		$tp->assign('reason', $reason);
		$tp->assign('comment', $comment);
	}
	$tp->assign('is_captcha', $isCaptcha);
}


$tp->display($template);