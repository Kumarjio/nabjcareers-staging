<?php

require_once "payment/PaymentGateway/PaymentGateway.php";
require_once "TwoCheckOutDetails.php";

class SJB_TwoCheckOut extends SJB_PaymentGateway
{
    function SJB_TwoCheckOut($gateway_info = null)
	{
		parent::SJB_PaymentGateway($gateway_info);
		$this->details = new SJB_TwoCheckOutDetails($gateway_info);
	}

    function isValid()
    {
    	$properties = $this->details->getProperties();
    	$two_co_account_id = $properties['2co_account_id']->getValue();
		return !empty($two_co_account_id);
	}

    function getUrl()
    {
		return 'https://www.2checkout.com/2co/buyer/purchase';
	}

    function buildTransactionForm($payment)
    {
		if ($payment->isValid()) {
			$two_checkout_url = $this->getUrl();
			$form_fields = $this->getFormFields($payment);
            $form_hidden_fields = "";

            foreach ($form_fields as $name => $value) {
				$form_hidden_fields .= "<input type='hidden' name='{$name}' value='{$value}' />\r\n";
			}

           	$gateway['hidden_fields'] 	= $form_hidden_fields;
           	$gateway['url'] 			= $two_checkout_url;
           	$gateway['caption']			= '2Checkout';

			return $gateway;
		}
		return null;
	}

	function getFormFields($payment)
	{
        $form_fields = array();
		$properties  = $this->details->getProperties();

        $product_info = $payment->getProductInfo();

		$form_fields['x_login'] 		= $properties['2co_account_id']->getValue();
		$form_fields['x_amount'] 		= sprintf("%.02f",$product_info['price']);
		$form_fields['x_Invoice_Num'] 	= $payment->getSID();

		$id = $properties['id']->getValue();
		$page = '';
		if (isset($_REQUEST['page'])) 
			$page = $_REQUEST['page']."/";
		$form_fields['return_url'] 		= SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/{$id}/".$page;

		if ($properties['demo']->getValue())
			$form_fields['demo'] = 'Y';
		else
			$form_fields['demo'] = 'N';

		return $form_fields;
	}

    function getPaymentFromCallbackData($callback_data)
    {
		$payment_sid = isset($callback_data['x_invoice_num']) ? $callback_data['x_invoice_num'] : null;

		if (is_null($payment_sid)) {
			$this->errors['PAYMENT_ID_IS_NOT_SET'] = 1;
			return null;
		}

		$payment = SJB_PaymentManager::getObjectBySID($payment_sid);

		if (is_null($payment)) {
			$this->errors['NONEXISTED_PAYMENT_ID_SPECIFIED'] = 1;
			return null;
		}

        if ( $payment->getStatus() != 'Pending' ) {
			$this->errors['PAYMENT_IS_NOT_PENDING'] = $payment->getStatus();
			return null;
		}

		if ($callback_data['x_MD5_Hash'] != $this->getMD5key($payment)) {
			$this->errors['NOT_VERIFIED'] = 1;
			return null;
		}

		$payment->setCallbackData($callback_data);

		if ($callback_data['x_2checked'] != 'Y') {
			$payment->setStatus(PAYMENT_STATUS_FAILED);
		}
		else {
			$payment->setStatus(PAYMENT_STATUS_VERIFIED);
		}

		SJB_PaymentManager::savePayment($payment);
		return $payment;
	}

    function getMD5key($payment)
	{
		$properties  = $this->details->getProperties();

		$secret_word 		= $properties['secret_word']->getValue();
		$twoco_account_id 	= $properties['2co_account_id']->getValue();

		$product_info = $payment->getProductInfo();
		$total = sprintf("%.02f",$product_info['price']);
		$payment_id = '1';

		if ( !$properties['demo']->getValue() ) {
			$payment_id = $_REQUEST['order_number'];
		}

		return strtoupper(md5($secret_word . $twoco_account_id . $payment_id . $total));
	}

}

