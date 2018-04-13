<?php
/************************************************************************\
*
\************************************************************************/


require_once "miscellaneous/Notifications.php";
require_once "classifieds/SendListingInfoController.php";

$errors = array();

$controller = new SJB_SendListingInfoController($_REQUEST);
$isDataSubmitted = false;

$isCaptcha = (SJB_System::getSettingByName('contactUserCaptcha') == 1) ? 1 : 0;


if($controller->isListingSpecified()) {

	if($controller->isDataSubmitted()) {
		if($isCaptcha == 1 && empty($_REQUEST['captcha'])) {
			$errors['EMPTY_VALUE'] = true;
		}
		elseif ( $isCaptcha == 1 && SJB_Session::getValue('captcha_keystring') != $_REQUEST['captcha'] ) {
			$errors['NOT_VALID'] = true;
		}
		else {
			$data_to_send = $controller->getData();
			if( !SJB_Notifications::sendContactSellerLetter($data_to_send) )
				$errors['SEND_ERROR'] = true;
			$isDataSubmitted = true;
		}
	}

} else {
	$errors['UNDEFINED_LISTING_ID'] = true;
}

$template_processor = SJB_System::getTemplateProcessor();
$template_processor->assign('errors', $errors);
$template_processor->assign('isCaptcha', $isCaptcha);
$template_processor->assign('listing_id', $controller->getListingID());
$template_processor->assign('is_data_submitted', $isDataSubmitted);
$template_processor->display('contact_seller.tpl');

