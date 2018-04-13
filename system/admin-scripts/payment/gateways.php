<?php


require_once "payment/PaymentGateway/PaymentGatewayManager.php";

$template_processor = SJB_System::getTemplateProcessor();

$errors = array();

$action 	= isset($_REQUEST['action'])  ? $_REQUEST['action']  : null;
$gateway_id = isset($_REQUEST['gateway']) ? $_REQUEST['gateway'] : null;

if ( !empty($action) && !empty($gateway_id) )
{
	if ( $action == 'deactivate' )
	{
		SJB_PaymentGatewayManager::deactivateByID($gateway_id);
	}
	elseif ( $action == 'activate' )
	{
		SJB_PaymentGatewayManager::activateByID($gateway_id);
	}
}

$list_of_gateways = SJB_PaymentGatewayManager::getPaymentGatewaysList();

$template_processor->assign('gateways', $list_of_gateways);
$template_processor->assign('errors', $errors);
$template_processor->display('payment_gateways_list.tpl');

