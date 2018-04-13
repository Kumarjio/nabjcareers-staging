<?php
require_once("payment/Payment/PaymentManager.php");
require_once("classifieds/Listing/ListingManager.php");
error_reporting(0);
$listing_id="";

$errors = null;
$payment_id = SJB_Request::getVar("payment_id", null);
			if (is_null($payment_id)) {
					$payment_id	=	$_GET['payment_id'];
			}
$payment = SJB_PaymentManager::getObjectBySID($payment_id);

if (!is_null($payment)) {
	$payment_status = $payment->getStatus();
	if ($payment_status == PAYMENT_STATUS_VERIFIED || $payment_status == PAYMENT_STATUS_COMPLETED ) {	// added 22-01-2018 || $payment_status == PAYMENT_STATUS_COMPLETED	
	//	print_r('777'); 
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
		SJB_PaymentManager::savePayment($payment);		
	}
	else /* {
		if ($payment_status == PAYMENT_STATUS_COMPLETED) {
			$errors['PAYMENT_IS_COMPLETED'] = 1;
//		print_r('55555');
		}*/
//		else
			$errors['PAYMENT_IS_NOT_VERIFIED'] = 1;
//	}
}
else {
	$errors['INVALID_PAYMENT_ID'] = 1;
}

// Array ( [listings_ids] => Array ( [0] => Array ( [0] => 54506 ) ) )
//$product_info = $payment->getProductInfo();
//$listing	=	unserialize($payment->details);

//print_r($payment);
$tp = SJB_System::getTemplateProcessor();
$tp->assign("errors", $errors);
$tp->display("activate_listing.tpl");