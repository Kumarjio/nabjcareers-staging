<?php

require_once ('orm/ObjectManager.php');

class SJB_OpenInvoiceManager extends SJB_ObjectManager
{
    function saveOpenInvoice(&$open_invoice, $payment_sid)
	{
		parent::saveObject('open_invoices', $open_invoice);
		SJB_DB::query('UPDATE `open_invoices` SET `creation_date`= NOW() WHERE `sid`=?n', $open_invoice->getSID());
	}

	function getObjectBySID($open_invoice_sid)
	{
		$open_invoice_info = SJB_OpenInvoiceManager::getOpenInvoiceBySID($open_invoice_sid);

		if (is_null($open_invoice_info))
			return null;
		$open_invoice = new SJB_OpenInvoice($open_invoice_info);
		$open_invoice->setSID($open_invoice_sid);
		return $open_invoice;
	}

	function getOpenInvoiceBySID($open_invoice_sid)
	{
		return parent::getObjectInfoBySID('open_invoices', $open_invoice_sid);
    }

	/***** 19-04-2017 ****/
    function getPaymentSIDbyOpenInvoiceSID($open_invoice_sid)
    {
    	$paymSId = SJB_DB::query('SELECT `payment_sid` FROM `open_invoices` WHERE `sid`=?n', $open_invoice_sid);
    	return $paymSId;
    }    
    

    /***** 11-06-2017 ****/
    
    function getOpenInvoiceByPaymentSID($payment_sid)
    {
    	$invoiceSid = SJB_DB::query('SELECT `sid` FROM `open_invoices` WHERE `payment_sid`=?n', $payment_sid);
    	return $invoiceSid;
    }
    
    /****** END **********/
	
	
	function closeOpenInvoice($open_invoice_sid)
	{
		SJB_DB::query('UPDATE `open_invoices` SET `is_opened`= false WHERE `sid`=?n', $open_invoice_sid);
	}

	function deleteOpenInvoice($open_invoice_sid)
	{
		return parent::deleteObject('open_invoices', $open_invoice_sid);
	}

	function applyCredit($open_invoice_sid, $amount)
	{
		$open_invoice_info = SJB_OpenInvoiceManager::getOpenInvoiceBySID($open_invoice_sid);
		$amount_outstanding = $open_invoice_info['amount'] - $amount;
		SJB_DB::query('UPDATE `open_invoices` SET `amount`= ?f WHERE `sid`=?n', $amount_outstanding, $open_invoice_sid);

		$payment_info = array(
			'user_sid' => $open_invoice_info['user_sid'],
			'product_info' => null,
			'price' => 0,
			'credit' => $amount,
			'name' => 'Credit / Payment',
			'success_page_url' => null,
			'status' => 'Pending',
			'planName' => null,
			'subuser_sid' => 0
		);
		$payment = new SJB_Payment($payment_info);
		SJB_PaymentManager::savePayment($payment);

		if ($amount_outstanding <= 0){
			SJB_PaymentManager::endorsePayment($open_invoice_info['payment_sid']);
			SJB_OpenInvoiceManager::closeOpenInvoice($open_invoice_sid);
			
			// added 01-apr-2015
			SJB_DB::query('UPDATE `payments` SET `status`=?s WHERE `sid`=?n', PAYMENT_STATUS_COMPLETED, $open_invoice_info['payment_sid']);
		}
	}


	/* 18-06-2017 */
	function changeAmount($open_invoice_sid, $new_amount)
	{
		$open_invoice_info = SJB_OpenInvoiceManager::getOpenInvoiceBySID($open_invoice_sid);
		SJB_DB::query('UPDATE `open_invoices` SET `amount`= ?f WHERE `sid`=?n', $new_amount, $open_invoice_sid);
			
		/* 14 april 2015 */
		SJB_DB::query('UPDATE `payments` SET `credit`=?s WHERE `sid`=?n', $new_amount, $open_invoice_info['payment_sid']);
		/* END*/
	
		/* END 18-06-2017*/
	
	}
	
	

}

