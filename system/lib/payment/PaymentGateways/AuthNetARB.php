<?php

require_once "payment/PaymentGateway/PaymentGateway.php";
require_once "AuthNetSIMDetails.php";

class SJB_AuthNetARB extends SJB_PaymentGateway
{
    function SJB_AuthNetARB($gateway_info = null)
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

		if (empty($errors)) {
			return true;
		}
		$this->errors = array_merge($this->errors, $errors);
		return false;
	}

    function getUrl()
    {
        return $_SERVER['REQUEST_URI']; //TODO: заменить
	}

	function buildTransactionForm($payment)
	{
        if( $payment->isValid() ) {
			$form_fields = $this->getFormFields($payment);
			$authnet_url = $this->getUrl();
            $form_hidden_fields = "";

            foreach ($form_fields as $name => $value) {
				$form_hidden_fields .= "<input type='hidden' name='{$name}' value='{$value}' />\r\n";
			}

           	$gateway['hidden_fields'] 	= $form_hidden_fields;
           	$gateway['url'] 			= $authnet_url;
           	$gateway['caption']			= 'Authorize.Net';

			return $gateway;
		}
		return null;
	}

	function getFormFields($payment)
	{
        $form_fields = array();
        $properties  = $this->details->getProperties();

        $product_info = $payment->getProductInfo();

        $form_fields['gw'] 		    = $properties['id']->getValue();

        // payment-related fields
        $form_fields['item_number'] 		= $payment->getSID();
        $form_fields['item_name'] 			= $product_info['name'];
        $form_fields['x_description']       = $product_info['name'];
        $form_fields['x_amount'] 			= $product_info['price'];
        $form_fields['x_currency_code'] 	= $properties['currency_code']->getValue();

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

    function isNotificationFromGateway(&$notification_data)
	{
        /*The MD5 Hash value is a random value configured by the merchant in the Merchant Interface. It
        should be stored securely separately from the merchant’s Web server. For more information on how
        to configure this value, see the Merchant Integration Guide
        at http://www.authorize.net/support/merchant/.
        For example, if the MD5 Hash value configured by the merchant in the Merchant Interface is
        “wilson,” and the transaction ID is “9876543210” with an amount of $1.00, then the field order
        used by the payment gateway to generate the MD5 Hash would be as follows:

        wilson98765432101.00

        Note:
        The value passed back for x_amount is formatted with the correct number of decimal
        places used in the transaction. For transaction types that do not include a transaction
        amount, mainly Voids, the amount used by the payment gateway to calculate the MD5
        Hash is “0.00.*/

        $properties  = $this->details->getProperties();
		$local_md5_hash = md5(
			$properties['authnet_api_md5_hash_value']->getValue() .
			$notification_data['x_trans_id'] .
			$notification_data['x_amount']
		);

		return strtoupper($notification_data['x_MD5_Hash']) == strtoupper($local_md5_hash);
	}

    function isNotificationSuccessfull(&$notification_data)
	{
		return $notification_data['x_response_code'] == 1 && $notification_data['x_response_reason_code'] == 1;
	}

    function handleRecurringNotification($notification_data)
    {
        //набор полей такой же как и при callback с Authorize.NET
        //плюс два поля x_subscription_id и x_subscription_paynum
        if (!$this->isNotificationFromGateway($notification_data)){
            return; //уведомление не от Authorize.NET
        }
        else if ($this->isNotificationSuccessfull($notification_data)){
        	$payment_sid = null;
	    	if (isset($notification_data['x_invoice_num']))
	    		$payment_sid = $notification_data['x_invoice_num'];
	
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

			$payment->setCallbackData($notification_data);
			$payment->setStatus(PAYMENT_STATUS_COMPLETED);
				
			$product_info = $payment->getProductInfo();
			$user_sid = $payment->getUserSID();
			$membership_plan_id = $product_info['membership_plan_id'];
			$contract = new SJB_Contract(array(
				'membership_plan_id' => $membership_plan_id,
				'recurring_id' => $notification_data['x_subscription_id'],
				'gateway_id' => 'authnet_sim'
			));
			$contract->setUserSID($user_sid);
			SJB_ContractManager::deleteAllContractsByRecurringId($notification_data['x_subscription_id']);
			if ($contract->saveInDB()) {
				SJB_PaymentManager::savePayment($payment);
	            if (SJB_UserNotifications::isUserNotifiedOnSubscriptionActivation($user_sid)) {
	                $membershipPlanInfo = SJB_MembershipPlanManager::getMembershipPlanInfoByID($membership_plan_id);
	                SJB_Notifications::sendSubscriptionActivationLetter($user_sid, $membershipPlanInfo, $reactivation);
	            }
			}
        }
        else {
            //уведомление о неуспешном платеже
        }
	}

    function isNullOrEmpty($value)
    {
        return empty($value);
    }

    function validatePayment($payment_data)
    {
        $errors = array();

        if ($this->isNullOrEmpty(trim($payment_data['x_card_num']))) {
            $errors[] = "Card number is empty";
        }

        if ($this->isNullOrEmpty(trim($payment_data['x_exp_date']))) {
            $errors[] = "Expiration date is empty";
        }

        if ($this->isNullOrEmpty(trim($payment_data['x_first_name']))) {
            $errors[] = "First name is empty";
        }

        if ($this->isNullOrEmpty(trim($payment_data['x_last_name']))) {
            $errors[] = "Last name empty";
        }

        return count($errors) == 0 ? true : $errors;
    }

    function createSubscription($payment_data)
    {
        $validation_result = $this->validatePayment($payment_data);
        if ($validation_result !== true) {
            return $validation_result;
        }
        
        $properties  	    = $this->details->getProperties();
        $api_login_id       = $properties['authnet_api_login_id']->getValue();
        $transaction_key    = $properties['authnet_api_transaction_key']->getValue();
        $use_test_account   = $properties['authnet_use_test_account']->getValue();

        require_once('Payment/AuthNetAIMProcessor.php');
        $aimProcessor = new AuthnetAIMProcessor($api_login_id, $transaction_key, $use_test_account);
        $aimProcessor->setTransactionType('AUTH_CAPTURE');
        $aimProcessor->setParameter('x_login', $api_login_id);
        $aimProcessor->setParameter('x_tran_key', $transaction_key);
        $aimProcessor->setParameter('x_card_num', $payment_data['x_card_num']);
        $aimProcessor->setParameter('x_amount', $payment_data['x_amount']);
        $aimProcessor->setParameter('x_exp_date', $payment_data['x_exp_date']);

        $aimProcessor->process();
        if (!$aimProcessor->isApproved()) {
            return array($aimProcessor->getResponseMessage());
        }

		$payment = SJB_PaymentManager::getObjectBySID($payment_data['item_number']);
		if (empty($payment)) {
			return;
		}
		
   		$product_info = $payment->getProductInfo();
		$membershipPlanInfo = SJB_MembershipPlanManager::getMembershipPlanInfoByID($product_info['membership_plan_id']);
		$membershipPlan = new SJB_MembershipPlan($membershipPlanInfo);
		
        require_once('Payment/AuthNetARBProcessor.php');
        $arbProcessor = new AuthnetARBProcessor($api_login_id, $transaction_key, $use_test_account);
        $arbProcessor->setParameter('refID', $payment_data['item_number']);
        $arbProcessor->setParameter('subscrName', $payment_data['x_description']);
        $arbProcessor->setParameter('interval_length', $membershipPlan->getSubscriptionPeriod());
        $arbProcessor->setParameter('interval_unit', 'days');
        $arbProcessor->setParameter('startDate', date("Y-m-d", strtotime("+ {$membershipPlan->getSubscriptionPeriod()} days")));
        $arbProcessor->setParameter('totalOccurrences', 9999);
        $arbProcessor->setParameter('trialOccurrences', 0);
        $arbProcessor->setParameter('amount', $payment_data['x_amount']);
        $arbProcessor->setParameter('trialAmount', 0.00);
        $arbProcessor->setParameter('cardNumber', $payment_data['x_card_num']);
        $arbProcessor->setParameter('expirationDate', $payment_data['x_exp_date']);
        $arbProcessor->setParameter('orderInvoiceNumber', $payment_data['item_number']);
        $arbProcessor->setParameter('orderDescription', $payment_data['x_description']);
        $arbProcessor->setParameter('firstName', $payment_data['x_first_name']);
        $arbProcessor->setParameter('lastName', $payment_data['x_last_name']);
        $arbProcessor->setParameter('company', $payment_data['x_company']);
        $arbProcessor->setParameter('address', $payment_data['x_address']);
        $arbProcessor->setParameter('city', $payment_data['x_city']);
        $arbProcessor->setParameter('state', $payment_data['x_state']);
        $arbProcessor->setParameter('zip', $payment_data['x_zip']);

        $arbProcessor->createAccount();
        if (!$arbProcessor->isSuccessful()) {
            return array($arbProcessor->getResponse());
        }
        
        require_once('payment/Payment/PaymentManager.php');
		require_once('membership_plan/Contract.php');
		require_once('membership_plan/ContractManager.php');
		require_once('users/User/UserManager.php');

		$payment = SJB_PaymentManager::getObjectBySID($payment_data['item_number']);
		if (is_null($payment)) {
			return null;
		}
		$payment->setCallbackData($payment_data);
		$payment->setStatus(PAYMENT_STATUS_COMPLETED);
		$product_info = $payment->getProductInfo();
		$user_sid = $payment->getUserSID();
		$contract = new SJB_Contract(array(
			'membership_plan_id' => $product_info['membership_plan_id'],
			'recurring_id' => $arbProcessor->getSubscriberID(),
			'gateway_id' => 'authnet_sim'
		));
		$contract->setUserSID($user_sid);
		if ($contract->saveInDB()) {
            if (SJB_UserNotifications::isUserNotifiedOnSubscriptionActivation($user_sid)) {
                $membershipPlanInfo = SJB_MembershipPlanManager::getMembershipPlanInfoByID($product_info['membership_plan_id']);
                SJB_Notifications::sendSubscriptionActivationLetter($user_sid, $membershipPlanInfo);
            }
		}

		SJB_PaymentManager::savePayment($payment);
        return true;
    }

    function cancelSubscription($subscriptionId)
    {
        $properties  	    = $this->details->getProperties();
        $api_login_id       = $properties['authnet_api_login_id']->getValue();
        $transaction_key    = $properties['authnet_api_transaction_key']->getValue();
        $use_test_account   = $properties['authnet_use_test_account']->getValue();
        
        require_once('Payment/AuthNetARBProcessor.php');
        $arbProcessor = new AuthnetARBProcessor($api_login_id, $transaction_key, $use_test_account);
        $arbProcessor->setParameter('refID', $subscriptionId);
        $arbProcessor->setParameter('subscrId', $subscriptionId);

        $arbProcessor->deleteAccount();
        if(!$arbProcessor->isSuccessful()){
            return array($arbProcessor->getResponse());
        }

        return true;
    }
}