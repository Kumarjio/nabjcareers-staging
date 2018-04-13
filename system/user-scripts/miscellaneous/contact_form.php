<?php

require_once('ObjectMother.php');
require_once('miscellaneous/Captcha.php');

$tp = SJB_System::getTemplateProcessor();
$contact_form = SJB_ObjectMother::createContactForm();
$contact_form->parseRequestedData($_REQUEST);
$isCaptcha = SJB_System::getSettingByName('contactUsCaptcha') == 1 ? 1 : 0;
if ($isCaptcha) {
	$captcha = new SJB_Captcha($_REQUEST);
	$captcha_form = SJB_ObjectMother::createForm($captcha);
	$contact_form->setCaptcha($captcha_form);
	$captcha_form->registerTags($tp);
	$tp->assign('captcha', array_pop($captcha_form->form_fields));
}
if ($contact_form->isFormSubmitted()) {
	
	if ($contact_form->isDataValid()) {
		$contact_form->sendMessage();
		$tp->assign('message_sent', true);
	} else {
		$tp->assign('field_errors', $contact_form->getFieldErrors());
	}
}

$contact_form->assignTemplateVariables($tp);
$tp->assign('isCaptcha', $isCaptcha);
$tp->display('contact_form.tpl');

