<?php
// ELDAR: mod "make-priority"
require_once("classifieds/Listing/ListingManager.php");
require_once("payment/Payment/Payment.php");
require_once("payment/Payment/PaymentManager.php");
require_once("payment/Payment/PaymentFactory.php");

if (isset($_REQUEST['payment_id'])) {
	
	$payment_id = SJB_Request::getVar("payment_id", null);
	$payment = SJB_PaymentManager::getObjectBySID($payment_id);
	
	if (!is_null($payment)) {
		
		$payment_status = $payment->getStatus();
		if ($payment_status == PAYMENT_STATUS_VERIFIED) {
			$product_info = $payment->getProductInfo();
			$listing_id = $product_info['priority_listing_id'];
			SJB_ListingManager::makePriorityBySID($_REQUEST['listing_id']);
			$payment->SetStatus(PAYMENT_STATUS_COMPLETED);
			SJB_PaymentManager::savePayment($payment);
		}
		else {
			if ($payment_status == PAYMENT_STATUS_COMPLETED)
				$errors['PAYMENT_IS_COMPLETED'] = 1;
			else
				$errors['PAYMENT_IS_NOT_VERIFIED'] = 1;
		}
		
	}
	else
		$errors['INVALID_PAYMENT_ID'] = 1;
		
}
else
if (isset($_REQUEST['listing_id'])) {
	
	$listing_id = $_REQUEST['listing_id'];
	$listing = SJB_ListingManager::getObjectBySID($listing_id);
	if (!is_null($listing) && !$listing->isPriority()) {
		
		$package_info = $listing->getListingPackageInfo();
		$ecommerce_mode = SJB_System::getSettingByName('ecommerce');
		if ($package_info['priority_listing'] || !$package_info['priority_price'] || !$ecommerce_mode) {
			SJB_ListingManager::makePriorityBySID($_REQUEST['listing_id']);
		}
		else {
			
			$user_sid = $listing->getUserSID();
			$product_info = serialize(array('priority_listing_id' => $listing_id)); 
			$status = 'Pending';
			$i18n = SJB_I18N::getInstance();


			$payment_id = SJB_PaymentManager::getPaymentSID_By_UserID_and_ProductInfo_and_Status($user_sid, $product_info, $status);
			if (empty($payment_id)){
				
				$payment_info = array(
					'user_sid' => $user_sid,			
					'product_info' => $product_info,			
					'price' => $package_info['priority_price'],	
					'name' => $i18n->gettext(null, 'Payment for upgrade listing ID', 'default') . " $listing_id " . $i18n->gettext(null, 'to priority', 'default'), 
					'success_page_url' => SJB_System::getSystemSettings('SITE_URL') . "/make-priority/",
					'status' => $status);
				$payment = &SJB_PaymentFactory::createPayment($payment_info);
				SJB_PaymentManager::savePayment($payment);
				$payment_id = $payment->getSID();
				
				/* fix for endorsement of featured/prioroty payments 31-05-2013 */
				$prior_success_url = SJB_System::getSystemSettings('SITE_URL') . "/make-priority/?listing_id=".$listing_id."&payment_id=".$payment_id;
				$prior_flag = 'priority';
				SJB_PaymentManager::setSuccessPageURL($payment_id, $prior_success_url);
				SJB_PaymentManager::setCallBackData($payment_id, $prior_flag);		
			}
			$payment_page_url = SJB_System::getSystemSettings('SITE_URL') . "/payment-page/?payment_id=" . $payment_id;
			SJB_HelperFunctions::redirect($payment_page_url);
			return;
			
		}
	} elseif (is_null($listing)) {
		$errors['INVALID_LISTING_ID'] = 1;
	} else {
		$errors['LISTING_ALREADY_PRIORITY'] = 1; // ??? DONE  
	}
	
} else {
	$errors['PARAMETERS_MISSED'] = 1;
}

$tp = SJB_System::getTemplateProcessor();
$tp->assign("errors", (isset($errors) ? $errors : null));
$tp->display("make_listing_priority.tpl"); 



