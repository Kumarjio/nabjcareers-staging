<?php

require_once('orm/Object.php');
require_once('PaymentGatewayDetails.php');

class SJB_PaymentGateway extends SJB_Object
{
	function SJB_PaymentGateway($gateway_info = array())
	{
		$this->details = new SJB_PaymentGatewayDetails($gateway_info);
	}

	function isValid()
	{
		return true;
	}

    function isPaymentVerified(&$payment)
    {
    	return true;
	}

    function getPaymentFromCallbackData($callback_data)
    {
		return null;
	}
    
    function getTemplate() {}
}

