<?php
require_once "payment/Payment/Payment.php";
$template_processor = SJB_System::getTemplateProcessor();
if (isset($_GET['payment_sid']) && $_GET['payment_sid'] != "")
{
	$paymentSid = $_GET['payment_sid'];
	$template_processor->assign('paymentSid', $paymentSid);
	$template_processor->display('payment_error_page.tpl');
}

