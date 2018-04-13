<?php

require_once "payment/PaymentGateway/PaymentGateway.php";
require_once "PayPalDetails.php";

class SJB_PayPal extends SJB_PaymentGateway
{
    function SJB_PayPal($gateway_info = null)
	{
		parent::SJB_PaymentGateway($gateway_info);
		$this->details = new SJB_PayPalDetails($gateway_info);
	}

    function isValid()
    {
    	$properties = $this->details->getProperties();
		$email 	= $properties['paypal_account_email']->getValue();
		$cc 	= $properties['currency_code']->getValue();

		$errors = array();

		if (empty($email))
			$errors['EMAIL_IS_NOT_SET'] = 1;
		if (empty($cc))
		 	$errors['CURRENCY_CODE_IS_NOT_SET'] = 1;

		if (empty($errors)) {
			return true;
		}

		$this->errors = array_merge($this->errors, $errors);
		return false;
	}

    function getUrl()
    {
    	$properties = $this->details->getProperties();

		if ( $properties['use_sandbox']->getValue() )
			return 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		return 'https://www.paypal.com/cgi-bin/webscr';
	}

    function buildTransactionForm($payment)
    {
		if ( $payment->isValid() ) {
			$form_fields = $this->getFormFields($payment);
			$paypal_url = $this->getUrl();
            $form_hidden_fields = "";

            foreach ($form_fields as $name => $value) {
				$form_hidden_fields .= "<input type='hidden' name='{$name}' value='{$value}' />\r\n";
			}

           	$gateway['hidden_fields'] 	= $form_hidden_fields;
           	$gateway['url'] 			= $paypal_url;
           	$gateway['caption']			= 'PayPal';

			return $gateway;
		}
		return null;
	}

	/**
	 * @param  $payment SJB_Payment
	 * @return array
	 */
    function getFormFields($payment)
	{
		$form_fields = array();
		$properties  = $this->details->getProperties();
		$product_info = $payment->getProductInfo();
		$id = $properties['id']->getValue();

		if ($payment->isRecurring()) {
			// hard-coded fields
			$form_fields['cmd'] 			= '_xclick-subscriptions';
			$form_fields['notify_url'] 		= SJB_System::getSystemSettings('SITE_URL') . "/system/payment/notifications/{$id}/";
			$form_fields['return']			= SJB_System::getSystemSettings('SITE_URL') . '/subscription/?subscriptionComplete=true';
			$form_fields['src'] 			= '1';
			
			$form_fields['a3'] 			= $product_info['price'];
			$form_fields['p3'] 			= $product_info['subscription_period'];
			$form_fields['t3'] 			= 'D';
			
			$form_fields['no_note'] 			= '1';
			$form_fields['no_shipping'] 		= '1';
		}
		else {
			// hard-coded fields
			$form_fields['cmd'] 			= '_xclick';
			$form_fields['amount'] 			= $product_info['price'];
			$form_fields['return'] 			= SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/{$id}/{$payment->getSID()}/";
			$form_fields['notify_url']		= SJB_System::getSystemSettings('SITE_URL') . "/paypal-ipn/";
		}

		$form_fields['cancel_return'] 	= SJB_System::getSystemSettings('SITE_URL') . "/my-account/";
		$form_fields['rm'] 				= 2; // POST method for call back

		// configuration fields
		$form_fields['business'] 		= $properties['paypal_account_email']->getValue();
		$form_fields['currency_code'] 	= $properties['currency_code']->getValue();

		// payment-related fields
		$form_fields['item_name'] 		= $product_info['name'];
		$form_fields['item_number'] 	= $payment->getSID();

		return $form_fields;
	}

    function isPaymentVerified(&$payment)
    {
		$callback_data = $payment->getCallbackData();

		$postdata ='';

		foreach ($callback_data as $key => $value) {
			$postdata .= $key . "=" . urlencode($value) . "&";
		}

		$postdata .= "cmd=_notify-validate";

		@set_time_limit(0);

		$paypal_url = $this->getUrl();

		$curl = curl_init($paypal_url);
		curl_setopt ($curl, CURLOPT_HEADER, 0);
		curl_setopt ($curl, CURLOPT_POST, 1);
		curl_setopt ($curl, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 1);
		$response = curl_exec($curl);

		curl_close($curl);

		$payment->setVerificationResponse($response);
		return $response == "VERIFIED";
	}

    function getPaymentFromCallbackData($callback_data)
    {
		$payment_sid = isset($callback_data['item_number']) ? $callback_data['item_number'] : null;

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

		$payment->setCallbackData($callback_data);

		if ($this->isPaymentVerified($payment) && in_array($callback_data['payment_status'], array('Completed', 'Processed'))) {
			$payment->setStatus(PAYMENT_STATUS_VERIFIED);
		}
		elseif ($callback_data['payment_status'] == 'Pending')
			$payment->setStatus(PAYMENT_STATUS_PENDING);
		else {
			$payment->setStatus(PAYMENT_STATUS_FAILED);
		}

		SJB_PaymentManager::savePayment($payment);
		return $payment;
	}
	
	/**
	 * Recurring notification handlign function
	 * @param $callback_data Notification data
	 */
	function handleRecurringNotification($callback_data)
    {
    	require_once('membership_plan/ContractManager.php');
    	if (SJB_Array::get($callback_data, 'txn_type') == 'subscr_cancel') {
    		SJB_ContractManager::removeSubscriptionId(SJB_Array::get($callback_data, 'subscr_id'));
    		return;
    	}
    	
    	if (SJB_Array::get($callback_data, 'txn_type') != 'subscr_payment') {
    		return;
    	}
    	
    	require_once('payment/Payment/PaymentManager.php');
		require_once('membership_plan/Contract.php');
		require_once('users/User/UserManager.php');

    	$payment_sid = isset($callback_data['item_number']) ? $callback_data['item_number'] : null;

		if (is_null($payment_sid))
			return;

		$payment = SJB_PaymentManager::getObjectBySID($payment_sid);
		if (is_null($payment)) {
			return null;
		}
		
		$reactivation = false;
		if ($payment->getStatus() == PAYMENT_STATUS_COMPLETED) { // Пришёл рекьюринг платёж
			$payment->setSID(null);
			$payment->setStatus('Pending');
			$reactivation = true;
		}

		$payment->setCallbackData($callback_data);

		if ($this->isPaymentVerified($payment) && in_array($callback_data['payment_status'], array('Completed', 'Processed'))) {
			$payment->setStatus(PAYMENT_STATUS_VERIFIED);
			
			$product_info = $payment->getProductInfo();
			$user_sid = $payment->getUserSID();
			$membership_plan_id = $product_info['membership_plan_id'];
			$contract = new SJB_Contract(array(
				'membership_plan_id' => $membership_plan_id,
				'recurring_id' => $callback_data['subscr_id'],
				'gateway_id'	=> 'paypal_standard'
			));
			$contract->setUserSID($user_sid);
			SJB_ContractManager::deleteAllContractsByRecurringId($callback_data['subscr_id']);
			if ($contract->saveInDB()) {
				$payment->SetStatus(PAYMENT_STATUS_COMPLETED);
	            if (SJB_UserNotifications::isUserNotifiedOnSubscriptionActivation($user_sid)) {
	                $membershipPlanInfo = SJB_MembershipPlanManager::getMembershipPlanInfoByID($membership_plan_id);
	                SJB_Notifications::sendSubscriptionActivationLetter($user_sid, $membershipPlanInfo, $reactivation);
	            }
			}
		}
		elseif ($callback_data['payment_status'] == 'Pending')
			$payment->setStatus(PAYMENT_STATUS_PENDING);
		else {
			$payment->setStatus(PAYMENT_STATUS_FAILED);
		}

		SJB_PaymentManager::savePayment($payment);
	}
	
	
	public function cancelSubscription($subscriptionId)
	{
		$properties = $this->details->getProperties();
		SJB_HelperFunctions::redirect($this->getUrl() . '?cmd=_subscr-find&alias=' . $properties['paypal_account_email']->getValue());
	}
	
}

