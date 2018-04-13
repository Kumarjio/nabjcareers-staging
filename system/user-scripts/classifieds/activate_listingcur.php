<?php
require_once("payment/Payment/PaymentManager.php");

require_once("classifieds/Listing/ListingManager.php");
error_reporting(0);
$listing_id="";


$errors = null;

$payment_id = SJB_Request::getVar("payment_id", null);

$payment = SJB_PaymentManager::getObjectBySID($payment_id);



if (!is_null($payment)) {

	$payment_status = $payment->getStatus();

	if ($payment_status == PAYMENT_STATUS_VERIFIED) {		
		$product_info = $payment->getProductInfo();
		$listing	=	unserialize($payment->details->properties['product_info']->value);
		$listing_id	=	 $listing['listing_id'];
		
		
		
		
		if (isset($listing_id)) {
			
			//$listing_id = $product_info['listing_id'];
			SJB_ListingManager::activateListingBySID($listing_id);
		}
		elseif (isset($product_info['listings_ids'])) {
			$listings_ids = array_pop($product_info['listings_ids']);
			foreach ($listings_ids as $listing_id)
			{
				SJB_ListingManager::activateListingBySID($listing_id);
			}
		}

		$payment->SetStatus(PAYMENT_STATUS_COMPLETED);

		//user info 
		SJB_PaymentManager::savePayment($payment);	
		$user_info = SJB_UserManager::getUserInfoBySID($payment_info['user_sid']);
		
		//payment info
		$payment_info = SJB_PaymentManager::getPaymentInfoBySID($payment_id);
		
		//listings info
		if (isset($product_info['listing_id'])) {
			$listings[] = SJB_ListingManager::getListingInfoBySID($product_info['listing_id']);
		} elseif(isset($product_info['listings_ids'])) {
			foreach($listing_ids as $listing_id) {
				$listings[] = SJB_ListingManager::getListingInfoBySID($listing_id);
			}
		}
		print_r($listings);
		
		$send_email = SJB_Notifications:: sendInvoice($user_info, $listings, $payment_info);
		//$tp->assign("send_email", $send_email);
	
	}
	else {
		if ($payment_status == PAYMENT_STATUS_COMPLETED)

			$errors['PAYMENT_IS_COMPLETED'] = 1;

		else

			$errors['PAYMENT_IS_NOT_VERIFIED'] = 1;

	}

}
else {

	$errors['INVALID_PAYMENT_ID'] = 1;

}

$tp = SJB_System::getTemplateProcessor();
$tp->assign("errors", $errors);
$tp->display("activate_listing.tpl");

