<?php

require_once "payment/Payment/Payment.php";
require_once "payment/Payment/PaymentManager.php";
require_once "classifieds/Listing/ListingManager.php";
require_once "users/User/UserManager.php";
require_once "users/UserGroup/UserGroupManager.php";
require_once("membership_plan/Contract.php");
require_once("miscellaneous/Notifications.php");

//if ($_REQUEST) {
//	$file="callback_data.txt";
//	$fp = fopen($file, "a+");
//	foreach($_REQUEST as $k => $v) {
//		fwrite($fp, "_REQUEST['$k']='$v';\n");
//	}
//	fwrite($fp, "--------------" . $_REQUEST['item_number'] . "------\n");
//	fclose ($fp);
//}

$gateway = SJB_PaymentGatewayManager::getObjectByID('paypal_standard');
$payment = $gateway->getPaymentFromCallbackData($_REQUEST);

if (is_null($payment)) {
	//No Payment
	exit;
} else {
	$payment_info = SJB_PaymentManager::getPaymentInfoBySID($payment->getSID());
	$payment_completed = ($payment_info['status'] == 'Completed') ? true : false;
	if (!$payment_completed) {
		$payment_status = $payment->getStatus();
		if ($payment_status == PAYMENT_STATUS_VERIFIED) {
			$product_info = $payment->getProductInfo();
			if (isset($product_info['listing_id'])) {
				SJB_ListingManager::activateListingBySID($product_info['listing_id']);
				SJB_PaymentManager::endorsePayment($payment->getSID());;
			}
			elseif (isset($product_info['membership_plan_id'])) {
				$user_sid = $payment->getUserSID();
				$user = SJB_UserManager::getObjectBySID($payment->getUserSID());
				if ($user) {
					$contract = new SJB_Contract(array('membership_plan_id' => $product_info['membership_plan_id']));
					$contract->setUserSID($user_sid);
					$contract->saveInDB();
				}		
				SJB_PaymentManager::endorsePayment($payment->getSID());
				$payment_info = SJB_PaymentManager::getPaymentInfoBySID($payment->getSID());
			}
			elseif (isset($product_info['featured_listing_id'])) {
				SJB_ListingManager::makeFeaturedBySID($product_info['featured_listing_id']);
				SJB_PaymentManager::endorsePayment($payment->getSID());
			}
			
			// -------------------  ELDAR -------------------
			elseif (isset($product_info['priority_listing_id'])) {
				SJB_ListingManager::makePriorityBySID($product_info['priority_listing_id']);
				SJB_PaymentManager::endorsePayment($payment->getSID());
			}
			// ------------------- end ELDAR -----------------------
		}
	}
}
if ($_REQUEST) {
	$file="callback_data.txt";
	$fp = fopen($file, "a+");
	foreach($_REQUEST as $k => $v) {
		fwrite($fp, "_REQUEST['$k']='$v';\n");
	}
	fwrite($fp, "--------------" . $_REQUEST['item_number'] . "------\n");
	fclose ($fp);
}