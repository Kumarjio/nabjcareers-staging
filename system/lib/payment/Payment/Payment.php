<?php

define('PAYMENT_STATUS_COMPLETED', 'Paid');
define('PAYMENT_STATUS_FAILED', 'Failed');
define('PAYMENT_STATUS_VERIFIED', 'Unpaid');
define('PAYMENT_STATUS_PENDING', 'Pending');

require_once('orm/Object.php');
// ------------------------------------------- added by ELDAR ------------------------------------------- 
require_once("classifieds/Listing/ListingManager.php");
// ------------------------------------------- END ELDAR ------------------------------------------- 
require_once('PaymentDetails.php');

class SJB_Payment extends SJB_Object
{
	function SJB_Payment($payment_info = array())
	{
		$this->details = new SJB_PaymentDetails($payment_info);
	}

	function getProductInfo()
	{
		$info = @unserialize($this->details->properties['product_info']->value);
		$info['name']  = $this->getPropertyValue('name');
		$info['price'] = $this->getPropertyValue('price');
		
		
		// ------------------------------------------- added by ELDAR ------------------------------------------- 
			$info['listing_id'] = $this->getPropertyValue('featured_listing_id');
			
			$info['listing_id'] = $this->getPropertyValue('priority_listing_id');
					
		$listingTitle = SJB_ListingManager::getListingSummaryForPayment($info['listing_id']);
		$info['paymentSummary']  = $listingTitle;
		// ------------------------------------------- END ELDAR ------------------------------------------- 
		return $info;
	}
	
	function getStatus() 			{ return $this->getPropertyValue('status'); }
	function getUserSID() 			{ return $this->getPropertyValue('user_sid'); }
	function getSuccessPageURL()	{ return $this->getPropertyValue('success_page_url'); }
	function getCallbackData()		{ return unserialize($this->getPropertyValue('callback_data')); }
	
	function setStatus($status)					{ $this->setPropertyValue('status', $status); }
	
	/* 20 may 2015 */
	function setPrice($price)					{ $this->setPropertyValue('price', $price); }	
	function setCreditsDiscountedInSubUserSid($creditsDiscounted) { $this->setPropertyValue('subuser_sid', $creditsDiscounted); }	
	/* END */
	
	function setCallbackData($callback_data)	{ $this->setPropertyValue('callback_data', serialize($callback_data)); }
	
	function setVerificationResponse($response)	{ $this->setPropertyValue('verification_response', $response); }
    function addSubuserProperty($sid = 0)		{ return $this->details->addSubuserProperty($sid); }

	function isRecurring() {
		$isRecurring = $this->getPropertyValue('is_recurring');
		return !empty($isRecurring);
	}

    function isValid()
    {
		$errors = array();
		$properties = $this->details->getProperties();
		$product_info = $properties['product_info']->getValue();
		if ( !isset($product_info['price']) || empty($product_info['price']) ) {
			array_push ($errors, array('PRODUCT_PRICE_IS_NOT_SET', 1));
		}
		if ( !isset($product_info['name']) || empty($product_info['name']) ) {
			array_push ($errors, array('PRODUCT_NAME_IS_NOT_SET', 1));
		}

		if (empty($errors)) {
			return true;
		}
		$this->errors = array_merge($this->errors, $errors);
		return false;
	}
}
