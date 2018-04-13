<?php

require_once 'payment/PaymentGateway/PaymentGatewayManager.php';
require_once 'payment/Payment/Payment.php';
require_once 'payment/Payment/PaymentManager.php';
require_once 'membership_plan/MembershipPlanManager.php';

$tp = SJB_System::getTemplateProcessor();

$gateway = SJB_PaymentGatewayManager::getObjectByID(SJB_Request::getVar('gateway'), true);

if (!empty($gateway)) {
	$cancelSubscriptionResult = $gateway->cancelSubscription(SJB_Request::getVar('subscriptionId'));
	$errors = array();
	if ($cancelSubscriptionResult !== true) {
		$errors = $cancelSubscriptionResult;
	}
	else {
		SJB_ContractManager::removeSubscriptionId(SJB_Request::getVar('subscriptionId'));
		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/subscription/?cancelRecurringContract=' . SJB_Request::getVar('contractId'));
	}
	$tp->assign('errors', $errors);
	$tp->display('cancel_recurring.tpl');
}

