<?php

require_once "miscellaneous/Notifications.php";
require_once "classifieds/SendListingInfoController.php";
require_once('miscellaneous/Captcha.php');

$tp = SJB_System::getTemplateProcessor();
$errors = array();
$controller = new SJB_SendListingInfoController($_REQUEST);
$isDataSubmitted = false;
$isCaptcha = (SJB_System::getSettingByName('contactUserCaptcha') == 1) ? 1 : 0;
if ($isCaptcha) {
	$captcha = new SJB_Captcha($_REQUEST, 'modal');
	$captcha_form = SJB_ObjectMother::createForm($captcha);
	$captcha_form->registerTags($tp);
	$tp->assign('captcha', array_pop($captcha_form->form_fields));
}
if ($controller->isListingSpecified()) {
	if ($controller->isDataSubmitted()) {
		if ($isCaptcha == 1) {
			$captcha_errors = array();
			$captcha_form->isDataValid($captcha_errors);
			foreach ($captcha_errors as $error)
				$errors[$error] = true;
		}
		elseif(!ereg("^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-zA-Z]{2,4}\$",  $_REQUEST['friend_email'] )) {
			$errors['NOT_VALID_EMAIL_FORMAT'] = true;
		}
		else {
			$data_to_send = $controller->getData();
			if(!SJB_Notifications::sendTellFriendLetter($data_to_send))
				$errors['SEND_ERROR'] = true;
			$isDataSubmitted = true;
		}
	}
}
else {
	$errors['UNDEFINED_LISTING_ID'] = true;
}

$tp->assign('errors', $errors);
$tp->assign('info', $_REQUEST);
$tp->assign('isCaptcha', $isCaptcha);
$tp->assign('listing_info', SJB_ListingManager::createTemplateStructureForListing(SJB_ListingManager::getObjectBySID($controller->getListingID())));
$tp->assign('is_data_submitted', $isDataSubmitted);
$tp->display('tell_friend.tpl');
