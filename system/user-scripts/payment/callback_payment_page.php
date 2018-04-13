<?php

require_once 'payment/PaymentGateway/PaymentGatewayManager.php';
require_once 'payment/Payment/Payment.php';
require_once 'payment/Payment/PaymentManager.php';

$request_uri = $_SERVER['REQUEST_URI'];
$template_processor = SJB_System::getTemplateProcessor();
$callback_page_uri = '';
preg_match('(.*/system/payment/callback/([^/]*)/?)', $request_uri, $mm);
$gateway_id = $mm[1];

$redirectPage = $gateway_id."/";
preg_match("(.*$redirectPage([^/]*)/?)", $request_uri, $payment_sid);
$payment_sid = !empty($payment_sid[1]) ? $payment_sid[1] : 0;
$redirectPage = $gateway_id . "/" . $payment_sid;
preg_match("(.*$redirectPage([^/]*)/?)", $request_uri, $tt);
$redirectPage = $tt[1];
$payment_obj = SJB_PaymentManager::getObjectBySID($payment_sid);
if(!empty($payment_obj) && $payment_obj->getStatus() == 'Completed') {
	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/payment-completed/");
}

$gateway = SJB_PaymentGatewayManager::getObjectByID($gateway_id);

$payment = $gateway->getPaymentFromCallbackData($_REQUEST);

if (is_null($payment)) {
	$errors = $gateway->getErrors();
	$template_processor->assign('errors', $errors);
	$template_processor->display('callback_payment_page.tpl');

} else {
	$payment_status = $payment->getStatus();
	if ($payment_status == PAYMENT_STATUS_VERIFIED || $payment_status == "Pending" || $payment_status == PAYMENT_STATUS_PENDING) {
		SJB_PaymentManager::endorsePayment($payment->getSID(), true);
		$succes_url = $payment->getSuccessPageURL();
		$page = '';
		if (!empty($redirectPage))
			$page = '&' . $redirectPage;
		SJB_HelperFunctions::redirect($succes_url . '?payment_id=' . $payment->getSID() . $page);
	}
	else  {
		$errors = 'PAYMENT_STATUS_NOT_VERIFIED';
		$template_processor->assign('errors', $errors);
		$template_processor->display('callback_payment_page.tpl');
	}
}