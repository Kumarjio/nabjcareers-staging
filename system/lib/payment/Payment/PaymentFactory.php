<?php

require_once("payment/Payment/Payment.php");
class SJB_PaymentFactory{
	function &createPayment($payment_info){
		$payment = &new SJB_Payment($payment_info);
		return $payment;
	}
}
