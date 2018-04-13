<?php

require_once 'payment/PaymentGateway/PaymentGateway.php';
require_once 'TwoCheckOutDetails.php';

class SJB_TwoCheckOutPNP extends SJB_PaymentGateway
{
    function SJB_TwoCheckOutPNP($gateway_info = null)
	{
		parent::SJB_PaymentGateway($gateway_info);
		$this->details = new SJB_TwoCheckOutDetails($gateway_info);
	}

    function isValid()
    {
    	$properties = $this->getProperties();
    	$two_co_account_id = $properties['2co_account_id']->getValue();
		return !empty($two_co_account_id);
	}

    function getUrl()
    {
		return 'https://www.2checkout.com/checkout/spurchase';
	}

    function buildTransactionForm($payment)
    {
		if ($payment->isValid()) {
			$two_checkout_url = $this->getUrl();
			$form_fields = $this->getFormFields($payment);
            $form_hidden_fields = '';

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
		$properties  = $this->getProperties();
        $product_info = $payment->getProductInfo();

		$form_fields['sid'] 		= $properties['2co_account_id']->getValue();
		$form_fields['product_id'] 	= $this->getPropertyValue('membership_plan_' . $product_info['membership_plan_id']);
		$form_fields['quantity'] 	= '1';
		$form_fields['merchant_order_id'] 	= $payment->getSID();
		$form_fields['fixed'] 	= 'Y';	
		$form_fields['demo'] = 'N';	

        $user_details = SJB_UserManager::getCurrentUserInfo();
        $form_fields['first_name']        = isset($user_details['FirstName'])?$user_details['FirstName']:'';
		$form_fields['last_name']         = isset($user_details['LastName'])?$user_details['LastName']:'';
		$form_fields['street_address']    = isset($user_details['Address'])?$user_details['Address']:'';
		$form_fields['city']              = isset($user_details['City'])?$user_details['City']:'';
		$form_fields['state']             = isset($user_details['State'])?$user_details['State']:'';
		$form_fields['zip']               = isset($user_details['ZipCode'])?$user_details['ZipCode']:'';
		$form_fields['country']           = isset($user_details['Country'])?$user_details['Country']:'';
		$form_fields['email']             = isset($user_details['email'])?$user_details['email']:'';
		$form_fields['phone']             = isset($user_details['PhoneNumber'])?$user_details['PhoneNumber']:'';

		$id = $properties['id']->getValue();
		$page = '';
		if (isset($_REQUEST['page'])) 
			$page = $_REQUEST['page'] . '/';
		$form_fields['return_url'] 		= SJB_System::getSystemSettings('SITE_URL') . "/system/payment/callback/{$id}/" . $page;

		if ($properties['demo']->getValue())
			$form_fields['demo'] = 'Y';

		return $form_fields;
	}

    function handleRecurringNotification($callback_data)
    {
        $properties		= $this->getProperties();
		$secret_word	= $properties['secret_word']->getValue();
		$expected_md5	= strtoupper(md5($callback_data['sale_id'] . $callback_data['vendor_id'] . $callback_data['invoice_id'] . $secret_word));

        if ($callback_data['md5_hash'] != $expected_md5)
			return;//платеж не от 2Checkout

		require_once('payment/Payment/PaymentManager.php');
		require_once('membership_plan/Contract.php');
		require_once('membership_plan/ContractManager.php');
		require_once('users/User/UserManager.php');
		
		switch ($callback_data['message_type']) {
			case 'RECURRING_INSTALLMENT_SUCCESS':
			case 'RECURRING_RESTARTED':
			case 'ORDER_CREATED':

				if (empty($callback_data['recurring']))
					return;
								
		    	$payment_sid = null;
		    	if (isset($callback_data['vendor_order_id']))
		    		$payment_sid = $callback_data['vendor_order_id'];
		
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
				$payment->setStatus(PAYMENT_STATUS_COMPLETED);
					
				$product_info = $payment->getProductInfo();
				$user_sid = $payment->getUserSID();
				$membership_plan_id = $product_info['membership_plan_id'];
				$contract = new SJB_Contract(array(
					'membership_plan_id' => $membership_plan_id,
					'recurring_id' => $callback_data['sale_id'],
					'gateway_id' => '2checkout'
				));
				$contract->setUserSID($user_sid);
				SJB_ContractManager::deleteAllContractsByRecurringId($callback_data['sale_id']);
				if ($contract->saveInDB()) {
					SJB_PaymentManager::savePayment($payment);
		            if (SJB_UserNotifications::isUserNotifiedOnSubscriptionActivation($user_sid)) {
		                $membershipPlanInfo = SJB_MembershipPlanManager::getMembershipPlanInfoByID($membership_plan_id);
		                SJB_Notifications::sendSubscriptionActivationLetter($user_sid, $membershipPlanInfo, $reactivation);
		            }
				}
				break;
				
			case 'RECURRING_INSTALLMENT_FAILED':
				$payment_sid = null;
				if (isset($callback_data['vendor_order_id']))
					$payment_sid = $callback_data['vendor_order_id'];
		
				if (is_null($payment_sid))
					return;
		
				$payment = SJB_PaymentManager::getObjectBySID($payment_sid);
				if (is_null($payment)) {
					return null;
				}
				
				$payment->setStatus(PAYMENT_STATUS_FAILED);
				SJB_PaymentManager::savePayment($payment);
				break;
				
			case 'RECURRING_STOPPED':
			case 'RECURRING_COMPLETE':
			default:
				break;
		}
	}

    function getPaymentFromCallbackData($callback_data)
    {
		$payment_sid = isset($callback_data['merchant_order_id']) ? $callback_data['merchant_order_id'] : null;

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

		if ($callback_data['key'] != $this->getMD5key($payment)) {
			$this->errors['NOT_VERIFIED'] = 1;
			return null;
		}

		$payment->setCallbackData($callback_data);

		if ($callback_data['credit_card_processed'] != 'Y') {
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
		$properties  = $this->getProperties();

		$secret_word 		= $properties['secret_word']->getValue();
		$twoco_account_id 	= $properties['2co_account_id']->getValue();

		$product_info = $payment->getProductInfo();

		$total = sprintf('%.02f',$product_info['total']);

		$payment_id = '1';

		if (!$properties['demo']->getValue()) {
			$payment_id = $_REQUEST['order_number'];
		}

		return strtoupper(md5($secret_word . $twoco_account_id . $payment_id . $total));
	}

    function cancelSubscription($subscriptionId)
    {
        $properties  = $this->getProperties();
		$api_url = 'https://www.2checkout.com/api/';
        $api_username = $properties['2co_api_user_login']->getValue();
		$api_password = $properties['2co_api_user_password']->getValue();

        require_once('Payment/TwoCheckoutVendorAPI.php');

        $vendorApi = new TwoCheckoutVendorAPI($api_url, $api_username, $api_password);

        $result = $vendorApi->detailSale(array('sale_id' => $subscriptionId));
        if (!$result['success']) {
            return $result['response'];
        }

        $response = $result['response'];
        if ($response->response_code != 'OK') {
            return $response->response_message;
        }

        if (!isset($response->sale->invoices[0]->lineitems[0]->lineitem_id)) {
            return 'lineitem_id was not found in response';
        }

        $lineitem_id = $response->sale->invoices[0]->lineitems[0]->lineitem_id;
        $result = $vendorApi->stopLineitemRecurring(array('lineitem_id' => $lineitem_id));
        if (!$result['success']) {
            return $result['response'];
        }

        $response = $result['response'];
        if ($response->response_code != 'OK') {
            return $response->response_message;
        }

        return true;
    }

}

