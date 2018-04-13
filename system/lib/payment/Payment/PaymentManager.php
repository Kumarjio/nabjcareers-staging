<?php

require_once ('orm/ObjectManager.php');
require_once ('payment/Payment/Payment.php');
require_once ('payment/PaymentGateway/PaymentGatewayManager.php');

/* 09-09-2016 */
require_once "users/User/UserManager.php";
require_once "membership_plan/ListingPackageManager.php";
require_once("payment/Payment/PaymentFactory.php");

/* 22-02-2018 */
require_once ('payment/OpenInvoice/OpenInvoiceManager.php');

class SJB_PaymentManager extends SJB_ObjectManager
{
    var $db_table_name 	= null;
	var $object_name	= null;

	function PaymentGateway()
	{
		$this->db_table_name 	= 'payments';
		$this->object_name 		= 'Payment';
	}


	/* 14/12/2015 inactive-jobs-activate-and-invoice MOD */
	function getTodaysPendingPaymentsSID() {
		$todaysPendingPaymentsArray = SJB_DB::query("select name, sid from payments where (status = 'Pending')
				AND SUBSTRING(creation_date, 1, 10) = CURDATE()
				AND SUBSTRING(name, 1, 19) = 'Payment for listing'");
	
		return $todaysPendingPaymentsArray;
	}
	
	function verifyPaymentJobAutoActivate($payment_sid)
	{
		$payment = SJB_DB::query('SELECT * FROM `payments` WHERE `sid`=?n', $payment_sid);
		$payment = array_pop($payment);
		$unserialized_extra_info = unserialize($payment['product_info']);
		$user = SJB_UserManager::getObjectBySID($payment['user_sid']);
		if (isset($unserialized_extra_info['membership_plan_id']))
			$user->updateSubscribeOnceUsersProperties($unserialized_extra_info['membership_plan_id'], $payment['user_sid']);
	
		SJB_DB::query('UPDATE `payments` SET `status`=?s WHERE `sid`=?n', PAYMENT_STATUS_VERIFIED, $payment_sid);
	}
	
	/* END**/
	
	
	function getPaymentSID_By_UserID_and_ProductInfo_and_Status($user_sid, $product_info, $status)
	{
		$sql = 'select sid from payments where status = ?s AND product_info = ?s AND user_sid = ?n';
		$rows = SJB_DB::query($sql, $status, $product_info, $user_sid);
		$sid = null;
		if (count($rows) > 0)
			$sid = $rows[0]['sid'];
		return $sid; 
	}

	/**
	 * @param  $payment SJB_Payment
	 * @return void
	 */
	function savePayment(&$payment)
	{
		$current_user = SJB_UserManager::getCurrentUser();
		if (!empty($current_user) && $current_user->isSubuser()) {
			$subuserInfo = $current_user->getSubuserInfo();
			$payment->addSubuserProperty($subuserInfo['sid']);
		}
		parent::saveObject('payments', $payment);
		SJB_DB::query('UPDATE `payments` SET `creation_date`= NOW() WHERE `sid`=?n', $payment->getSID());
	}
	
	
    function getPaymentInfoBySID($payment_sid)
	{
    	return parent::getObjectInfoBySID('payments', $payment_sid);
    }
    
    function getObjectBySID($payment_sid)
	{
    	$payment_info = SJB_PaymentManager::getPaymentInfoBySID($payment_sid);
    	
    	if (is_null($payment_info))
    		return null;
    	$payment = new SJB_Payment($payment_info);
		$payment->setSID($payment_sid);
		return $payment;
    }

	/**
	 * @param  $payment SJB_Payment
	 * @return array
	 */
	function getPaymentForms($payment)
	{
    	$active_gateways = SJB_PaymentGatewayManager::getActivePaymentGatewaysList();
    	$gateways_form_info = array();
    	foreach ($active_gateways as $gateway_info) {
			if ($payment->isRecurring() && empty($gateway_info['recurrable']))
				continue;
    		$gateway = SJB_PaymentGatewayManager::getObjectByID($gateway_info['id'], $payment->isRecurring());
    		$gateways_form_info[$gateway->getPropertyValue('id')] = $gateway->buildTransactionForm($payment);
    	}

    	return $gateways_form_info;
    }

function endorsePayment($payment_sid, $verified = false)
//    function endorsePayment($payment_sid, $verified)
	{
		$payment = SJB_DB::query('SELECT * FROM `payments` WHERE `sid`=?n', $payment_sid);
		$payment = array_pop($payment);
		$unserialized_extra_info = unserialize($payment['product_info']);
		$user = SJB_UserManager::getObjectBySID($payment['user_sid']);
		if (isset($unserialized_extra_info['membership_plan_id']))
			$user->updateSubscribeOnceUsersProperties($unserialized_extra_info['membership_plan_id'], $payment['user_sid']);

		return $verified ? SJB_DB::query('UPDATE `payments` SET `status`=?s WHERE `sid`=?n', PAYMENT_STATUS_COMPLETED, $payment_sid) :
			SJB_DB::query('UPDATE `payments` SET `status`=?s WHERE `sid`=?n', PAYMENT_STATUS_COMPLETED, $payment_sid);
    }
    
    
    
    function setSuccessPageURL($payment_sid, $url)
    {
    	SJB_DB::query('UPDATE `payments` SET `success_page_url`=?s WHERE `sid`=?n', $url, $payment_sid);
    }
    
    
    function setCallBackData($payment_sid, $featur_flag)
    {
    	SJB_DB::query('UPDATE `payments` SET `callback_data`=?s WHERE `sid`=?n', $featur_flag, $payment_sid);
    }
    
/*****  21 feb 2018  ****/    

    function getOpenInvoiceSIDbyPaymentSID($paymentSid)
    {
    	$openInvoiceSid = SJB_DB::query('SELECT `sid` FROM `open_invoices` WHERE `payment_sid`=?n', $paymentSid);
    	return $openInvoiceSid;
    }
    
    function deletePaymentBySIDandInvoice($payment_sid, $open_invoice_sid)
    {
    	$res = SJB_OpenInvoiceManager::deleteOpenInvoice($open_invoice_sid); // delete Invoice from admin/Open Invoices
    	//print_r($res);
    	return SJB_PaymentManager::deleteObject('payments', $payment_sid);	// delete payment from admin/Invoice Log
    }
    
/*****  END of 21 feb 2018  ****/    

	function deletePaymentBySID($payment_sid)
	{
    	return SJB_PaymentManager::deleteObject('payments', $payment_sid);
    }
    
    function getPaymentSIDByID($id)
	{
    	return $id;
    }
    
	/**
	 * Paiments info
	 * @return array
	 */
	function getPaymentsInfo()
	{
		$periods = array(
			'Today' => 'YEAR(CURDATE()) = YEAR(p.creation_date) AND DAYOFYEAR(CURDATE()) = DAYOFYEAR(p.creation_date)',
			'This Week' => 'YEARWEEK(CURDATE()) = YEARWEEK(p.creation_date)',
			'This Month' => 'YEAR(CURDATE()) = YEAR(p.creation_date) AND MONTH(CURDATE()) = MONTH(p.creation_date)');

		foreach ($periods as $key => $value) {
			$res[$key]['completed'] = SJB_DB::query("select ifnull(sum(p.price), 0) as `payment` from payments p WHERE $value and status = 'Completed'");
			$res[$key]['pending'] = SJB_DB::query("select ifnull(sum(p.price), 0) as `payment` from payments p WHERE $value and status = 'Pending'");
		}
		return $res;
	}

	/**
	 * Get's total sum of all completed payments
	 *
	 * @return unknown
	 */
	function getTotalPayments()
	{
		$res = SJB_DB::query("select ifnull(sum(p.price), 0) as `payment` from payments p where status = 'Completed'");
		if (count($res) == 0)
			return '0';

		$res = array_shift($res);
		return number_format($res['payment'], 2, '.', '');
	}
	
	function getTotalPendingPayments()
	{
		$res = SJB_DB::query("select ifnull(sum(p.price), 0) as `payment` from payments p where status = 'Pending'");
		if (count($res) == 0)
			return '0';

		$res = array_shift($res);
		return number_format($res['payment'], 2, '.', '');
	}
	
	/**
	 * Get's membership plan SIDs of user's Pending payments
	 *
	 * @return array of membership plan SIDs
	 */
	function getPendingPaymentMembershipPlanIDsByUserID($user_id) 
	{
		$res = SJB_DB::query("SELECT `product_info` FROM payments WHERE `status` = 'Pending' AND `user_sid` = ?n", $user_id);
		
		$sids = array();
		if (!empty($res)) {
			foreach ($res as $product_info) {
				$unserialized_product_info = unserialize($product_info['product_info']);
				if (isset($unserialized_product_info['membership_plan_id']))
					$sids[] = $unserialized_product_info['membership_plan_id'];
			}
		}
		return $sids;
	}

	/* credits mod 24-march-2016 */
	function setPriceMinusCredits($payment_sid, $price)
	{
		SJB_DB::query('UPDATE `payments` SET `price`=?s WHERE `sid`=?n', $price, $payment_sid);
	}
	
	function setCreditsFlag($payment_sid)
	{
		SJB_DB::query('UPDATE `payments` SET `subuser_sid`=-1 WHERE `sid`=?n', $payment_sid);
	}
	
	function getCreditsFlag($payment_sid)
	{
		$res = SJB_DB::query('SELECT `subuser_sid` FROM payments WHERE `sid`=?n', $payment_sid);
		if ($res[0]['subuser_sid'] == -1) {
			return 1;
		}
		else {
			return 0;
		}
	
	}
	

	
	/* 09-09-2016 */
	function createPaymentAfterListingExclude($listingSids) {
		$currentUser = SJB_UserManager::getCurrentUser();
		$current_user_sid = $currentUser->getSID();
	
		$payment_amount = 0;
		$listings_ids_arr = array();
		$ecommerce_mode = SJB_System::getSettingByName('ecommerce');
		foreach ($listingSids as $listing_id){
			$listing_info = SJB_ListingPackageManager::getPackageInfoByListingSID($listing_id);
			if ($listing_info['price'] > 0 && $ecommerce_mode ) {
				$payment_amount += $listing_info['price'];
				$listings_ids_arr[] = $listing_id;
			}
		}
		if (!empty($listings_ids_arr)) {
			$product_info = serialize( array( 'listings_ids' => array($listings_ids_arr)) );
			$status = 'Pending';
			$payment_id = getPaymentSID_By_UserID_and_ProductInfo_and_Status($current_user_sid, $product_info, $status);
			$listings_ids_str = implode(',',$listings_ids_arr);
			if (empty($payment_id)) {
				$payment_info = array(
						'user_sid' => $current_user_sid,
						'product_info' => $product_info,
						'price' => $payment_amount,
						'name' => 'Payment for listings # ' . $listings_ids_str,
						'success_page_url' => SJB_System::getSystemSettings( 'SITE_URL' ) . "/activate-listing/",
						'status' => $status
				);
				SJB_Event::dispatch('BeforePaymentSave', $payment_info, true);
				$payment = SJB_PaymentFactory::createPayment($payment_info);
				savePayment($payment);
				$payment_id = $payment->getSID();
			}
			$payment_page_url = SJB_System::getSystemSettings('SITE_URL') . "/payment-page/?payment_id=" . $payment_id;
	//		SJB_HelperFunctions::redirect($payment_page_url);
			exit;
		}
	}
	
	/* end 09-09-2016*/

/* 11-03-2017
	function get_listing_duration_by_sid($listing_sid)	{
		$sql = 'select number_of_days from listings_active_period where listing_sid = ?s';
		$duration = SJB_DB::query($sql, $listing_sid);
		return $duration;
	}
	
	/* END of 11-03-2017*/	
}