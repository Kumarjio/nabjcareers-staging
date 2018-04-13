<?php
require_once "users/User/UserManager.php";
require_once "classifieds/Listing/ListingManager.php";
require_once("payment/Payment/PaymentManager.php");
require_once ("miscellaneous/Notifications.php");

$tp = SJB_System::getTemplateProcessor();
$errors = array();
$payment_sid = SJB_Request::getVar('payment_sid', null);
$payment_sids = SJB_Request::getVar('payment_sid', null);

if (is_null($payment_sid)) {
	$errors['PAYMENT_ID_DOESNOT_SPECIFIED'] = $payment_sid;
}
else {
	$payment = SJB_PaymentManager::getObjectBySID($payment_sid);
	if (!empty($payment)) {
		$payment_info = SJB_PaymentManager::getPaymentInfoBySID($payment_sid);
		$user_info = SJB_UserManager::getUserInfoBySID($payment_info['user_sid']);
		$product_info = !empty($payment_info) ? unserialize($payment_info['product_info']) : array();
		$listings = array();
		if (isset($product_info['listing_id'])) {
			$listings[] = SJB_ListingManager::getListingInfoBySID($product_info['listing_id']);
		} elseif(isset($product_info['listings_ids'])) {
			$listing_ids = array_pop($product_info['listings_ids']);
			foreach($listing_ids as $listing_id) {
				$listings[] = SJB_ListingManager::getListingInfoBySID($listing_id);
			}
		}
		
		if(isset($product_info['featured_listing_id'])) {
			$listing_featured = SJB_ListingManager::getListingInfoBySID($product_info['featured_listing_id']);
			$tp->assign("featured_listing_info", $listing_featured);
		}
		
		
		if (isset($_REQUEST['send_email'])){
//			$send_email = SJB_Notifications:: sendInvoice($user_info, $listings, $payment_info);
			$tp->assign("send_email", $send_email);
		}
		$tp->assign("payment_info", $payment_info);
		$tp->assign("user_info", $user_info);
		$tp->assign("listings", $listings);
		
		if (isset($product_info['priority_listing_id']) ) {
			$priority_listing_info = SJB_ListingManager::getListingInfoBySID($product_info['priority_listing_id']);
			$tp->assign("priority_listing_info", $priority_listing_info);
		}		
		
		$tp->assign("listings_copy", $listings);

	}
	else {
		$errors['PAYMENT_DOESNOT_EXIST'] = $payment_sid;
	}
}

$tp->assign("errors", $errors);

$tp->assign("id-id", $payment_sid);
$tp->assign("sid-sid", $payment_sids);


$tp->display("print_invoice_user.tpl");
