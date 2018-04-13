<?php

require_once ('users/User/UserManager.php');
require_once 'payment/Payment/PaymentManager.php';
require_once 'payment/OpenInvoice/OpenInvoice.php';
require_once 'payment/OpenInvoice/OpenInvoiceManager.php';

require_once "classifieds/Listing/ListingManager.php";
require_once ("miscellaneous/Notifications.php");

$tp = SJB_System::getTemplateProcessor();
$errors = array();

$amount = $_REQUEST['amount'];
$payment_id = $_REQUEST['payment_id'];
if (isset($payment_id) && isset($_REQUEST['item_name']) && isset($amount)) {
	$payment_info = SJB_PaymentManager::getPaymentInfoBySID($payment_id);
	$currentUserInfo = SJB_UserManager::getCurrentUserInfo();
	$product_info = !empty($payment_info) ? unserialize($payment_info['product_info']) : array();
	$openInvoiceInfo = array(
		'amount'      => $amount,
		'user_sid'    => $currentUserInfo['sid'],
		'payment_sid' => $payment_id,
		'is_opened'   => true
	);
	$openInvoice = new SJB_OpenInvoice($openInvoiceInfo);
	SJB_OpenInvoiceManager::saveOpenInvoice($openInvoice, $payment_id);
	if (isset($product_info['listing_id'])) {
		SJB_ListingManager::activateListingBySID($product_info['listing_id']);
	} elseif(isset($product_info['listings_ids'])) {		
		$listing_ids = array_pop($product_info['listings_ids']);
		foreach($listing_ids as $listing_id) {
			SJB_ListingManager::activateListingBySID($listing_id);
		}
	}

	// Auto-allow subscription if settings option is set
	if(SJB_Settings::getSettingByName('auto_access_before_pay') == '1') {
		$user_sid = SJB_UserManager::getCurrentUserSID();
		$user = SJB_UserManager::getObjectBySID($user_sid);
		if ($user && isset($product_info['membership_plan_id'])) {
			$contract = new SJB_Contract(array('membership_plan_id' => isset($product_info['membership_plan_id']) ? $product_info['membership_plan_id'] : 40));
			$contract->setUserSID($user_sid);
			$contract->saveInDB();
		}
		SJB_PaymentManager::endorsePayment($payment_id);
	}

    $tp->assign('payment_id', $payment_id);
    $tp->assign('item_name', $_REQUEST['item_name']);
    $tp->assign('amount', $amount);
	$tp->assign('user', $currentUserInfo);
}
else {
    $errors['INVALID_PAYMENT_ID'] = true;
}

$tp->assign('errors', $errors);
$tp->display(SJB_Request::getVar('template', 'cash_gateway') . '.tpl');


$user_info = SJB_UserManager::getUserInfoBySID($payment_info['user_sid']);
$listings = array();
if (isset($product_info['listing_id'])) {
	$listings[] = SJB_ListingManager::getListingInfoBySID($product_info['listing_id']);
} elseif(isset($product_info['listings_ids'])) {
	$listing_ids = array_pop($product_info['listings_ids']);
//	foreach($listing_ids as $listing_id) {
//		$listings[] = SJB_ListingManager::getListingInfoBySID($listing_id);
//	}
}
$tp->assign("user_info", $user_info);
$tp->assign("listings", $listings);
$tp->assign("payment_info", $payment_info);

//$send_email = SJB_Notifications:: sendInvoice($user_info, $listings, $payment_info);
//$tp->assign("send_email", $send_email);

