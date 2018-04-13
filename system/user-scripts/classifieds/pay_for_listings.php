<?php


require_once("classifieds/Listing/ListingManager.php");
require_once("payment/Payment/Payment.php");
require_once("payment/Payment/PaymentManager.php");
require_once("payment/Payment/PaymentFactory.php");

$listing_id = isset($_REQUEST['listings_ids']) ? $_REQUEST['listings_ids'] : null;

$listing = SJB_ListingManager::getObjectBySID($listing_id);

if (!is_null($listing)) {
	
	$package_info = $listing->getListingPackageInfo();
	
	if ($package_info['price'] != 0) {
	
		$user_sid = $listing->getUserSID();
		$product_info = serialize(array('listing_id' => $listing_id));
		$status = 'Pending';
		
		$payment_id = SJB_PaymentManager::getPaymentSID_By_UserID_and_ProductInfo_and_Status($user_sid, $product_info, $status);
		if(empty($payment_id)){
		
		
		// ------------------------------------------- modified by ELDAR ------------------------------------------- 
		
		$listingTitle = SJB_ListingManager::getListingTitle($listing_id);
	
		// ------------------------------------------- END ELDAR ------------------------------------------- 
	
			$payment_info = array(
															'user_sid' => $user_sid,			
															'product_info' => $product_info,			
															'price' => $package_info['price'],			
															'name' => 'Payment for listing ID ' . $listing_id,			
															'success_page_url' => SJB_System::getSystemSettings('SITE_URL') . "/activate-listing/",			
															'status' => $status
															
															
															'planName' => $listingTitle
															//ELDAR
											);
			
			$payment = &SJB_PaymentFactory::createPayment($payment_info);
			SJB_PaymentManager::savePayment($payment);
			$payment_id = $payment->getSID();
		}

		$payment_page_url = SJB_System::getSystemSettings('SITE_URL') . "/payment-page/?payment_id=" . $payment_id;
		
		SJB_HelperFunctions::redirect($payment_page_url);
		return;
	
	} else {
		
		SJB_ListingManager::activateListingBySID($listing->getSID());
		
	}
	
} elseif (is_null($listing_id)) {
	
	$errors['LISTING_ID_NOT_SPECIFIED'] = 1;
	
} else {
	
	$errors['WRONG_LISTING_ID'] = 1;
	
}

$template_processor = SJB_System::getTemplateProcessor();

$template_processor->assign("errors", isset($errors) ? $errors : null);

$template_processor->display("pay_for_listing.tpl");

