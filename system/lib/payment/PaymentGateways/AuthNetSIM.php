<?php


require_once "payment/PaymentGateway/PaymentGateway.php";

require_once "AuthNetSIMDetails.php";

class SJB_AuthNetSIM extends SJB_PaymentGateway
{
    function SJB_AuthNetSIM($gateway_info = null)
	{
		parent::SJB_PaymentGateway($gateway_info);

		$this->details = new SJB_AuthNetSIMDetails($gateway_info);
	}

	function isValid()
	{
		$properties = $this->details->getProperties();

		$cc 				= $properties['currency_code']->getValue();
		$md5_hash 			= $properties['authnet_api_md5_hash_value']->getValue();
        $api_login_id 		= $properties['authnet_api_login_id']->getValue();
		$transaction_key 	= $properties['authnet_api_transaction_key']->getValue();

		$errors = array();

		if ( empty($api_login_id) )		$errors['API_LOGIN_ID_IS_NOT_SET'] = 1;
		if ( empty($transaction_key) )	$errors['TRANSACTION_KEY_IS_NOT_SET'] = 1;
		if ( empty($md5_hash) )			$errors['MD5_HASH_IS_NOT_SET'] = 1;
		if ( empty($cc) )				$errors['CURRENCY_CODE_IS_NOT_SET'] = 1;

		if (empty($errors))
		{
			return true;
		}
		else
		{
			if (!empty($this->errors))
				$errors = array_merge($this->errors, $errors);
			$this->errors = $errors;
			return false;
		}
	}

    function getUrl()
    {
    	$properties = $this->details->getProperties();
    	
    	$use_test_account = $properties['authnet_use_test_account']->getValue();

    	if ($use_test_account)
			return 'https://test.authorize.net/gateway/transact.dll';
		else
			return 'https://secure.authorize.net/gateway/transact.dll';
	}

	function buildTransactionForm($payment)
	{
        if( $payment->isValid() )
        {
			$form_fields = $this->getFormFields($payment);

			$authnet_url = $this->getUrl();

            $form_hidden_fields = "";

            foreach ($form_fields as $name => $value)
            {
				$form_hidden_fields .= "<input type='hidden' name='{$name}' value='{$value}' />\r\n";
			}

           	$gateway['hidden_fields'] 	= $form_hidden_fields;
           	$gateway['url'] 			= $authnet_url;
           	$gateway['caption']			= 'Authorize.Net';

			return $gateway;
		}
		else
			return null;
	}

	function getFormFields($payment)
	{
		$form_fields = array();
		$properties  = $this->details->getProperties();

		$product_info = $payment->getProductInfo();

        $x_fp_sequence = rand(1, 1000);
		$x_fp_timestamp = time ();

		$fingerprint = $this->hmac
		(
			$properties['authnet_api_transaction_key']->getValue(),

			$properties['authnet_api_login_id']->getValue()."^".$x_fp_sequence."^".$x_fp_timestamp."^".
			$product_info['price']."^".$properties['currency_code']->getValue()
		);

		$id = $properties['id']->getValue();

		// hard-coded fields
		$form_fields['x_show_form'] 		= 'PAYMENT_FORM';

		// configuration fields
		$form_fields['x_login'] 			= $properties['authnet_api_login_id']->getValue();
		$form_fields['x_fp_hash'] 			= $fingerprint;
		$form_fields['x_fp_sequence'] 		= $x_fp_sequence;
		$form_fields['x_fp_timestamp'] 		= $x_fp_timestamp;
		$form_fields['x_currency_code'] 	= $properties['currency_code']->getValue();
		$page = '';
		if(isset($_REQUEST['page']))
			$page = $_REQUEST['page']."/";

		$form_fields['x_receipt_link_method'] = 'POST';
		$form_fields['x_receipt_link_text'] = 'Return to the merchant';
		// return page field (response)
		$form_fields['x_receipt_link_url']	= SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/{$id}/".$page;

		// payment-related fields
		$form_fields['x_description']       = $product_info['name'];
		$form_fields['item_name'] 			= $product_info['name'];
		$form_fields['x_amount'] 			= $product_info['price'];
		$form_fields['item_number'] 		= $payment->getSID();
		
		$current_user = SJB_UserManager::getCurrentUser();
		$user_details = SJB_UserManager::getCurrentUserInfo();
		
		$form_fields['x_first_name']        = isset($user_details['FirstName'])?$user_details['FirstName']:'';
		$form_fields['x_last_name']         = isset($user_details['LastName'])?$user_details['LastName']:'';
		$form_fields['x_company']           = isset($user_details['CompanyName'])?$user_details['CompanyName']:'';
		$form_fields['x_address']           = isset($user_details['Address'])?$user_details['Address']:'';
		$form_fields['x_city']              = isset($user_details['City'])?$user_details['City']:'';
		$form_fields['x_state']             = isset($user_details['State'])?$user_details['State']:'';
		$form_fields['x_zip']               = isset($user_details['ZipCode'])?$user_details['ZipCode']:'';
		$form_fields['x_country']           = isset($user_details['Country'])?$user_details['Country']:'';
		$form_fields['x_email']             = isset($user_details['email'])?$user_details['email']:'';
		$form_fields['x_phone']             = isset($user_details['PhoneNumber'])?$user_details['PhoneNumber']:'';
		
		return $form_fields;
	}

    function hmac ($key, $data)
    {
	   $b = 64; // byte length for md5

	   if (strlen($key) > $b) $key = pack("H*",md5($key));

	   $key  = str_pad($key, $b, chr(0x00));
	   $ipad = str_pad('', $b, chr(0x36));
	   $opad = str_pad('', $b, chr(0x5c));

	   $k_ipad = $key ^ $ipad ;
	   $k_opad = $key ^ $opad;

	   return md5($k_opad . pack("H*",md5($k_ipad . $data)));
	}

    function isPaymentVerified(&$payment)
	{
		$properties  	= $this->details->getProperties();
		$callback_data 	= $payment->getCallbackData();

		$local_md5_hash = md5
		(
			$properties['authnet_api_md5_hash_value']->getValue() .
			$properties['authnet_api_login_id']->getValue() .
			$callback_data['x_trans_id'] .
			$callback_data['x_amount']
		);

		// checking if response from Autnorize.Net
		if ( strtoupper($callback_data['x_MD5_Hash']) != strtoupper($local_md5_hash) ) return false;

		// verifying if transaction has been approved
		if ($callback_data['x_response_code'] != 1 || $callback_data['x_response_reason_code'] != 1) return false;

		return true;
	}

    function getPaymentFromCallbackData($callback_data)
    {
		$payment_sid = isset($callback_data['item_number']) ? $callback_data['item_number'] : null;

		if (is_null($payment_sid))
		{
			$this->errors['PAYMENT_ID_IS_NOT_SET'] = 1;
			return null;
		}

		$payment = SJB_PaymentManager::getObjectBySID($payment_sid);

		if (is_null($payment))
		{
			$this->errors['NONEXISTED_PAYMENT_ID_SPECIFIED'] = 1;
			return null;
		}

		if ( $payment->getStatus() != 'Pending' )
		{
			$this->errors['PAYMENT_IS_NOT_PENDING'] = $payment->getStatus();
			return null;
		}

		$payment->setCallbackData($callback_data);

		if ($this->isPaymentVerified($payment))
		{
			$payment->setStatus(PAYMENT_STATUS_VERIFIED);
		}
		else
		{
			$payment->setStatus(PAYMENT_STATUS_FAILED);
		}

		SJB_PaymentManager::savePayment($payment);

		return $payment;
	}
}

