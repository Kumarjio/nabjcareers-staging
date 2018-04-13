<?php


require_once "payment/PaymentGateway/PaymentGatewayManager.php";

Require_once "forms/Form.php";

$template_processor = SJB_System::getTemplateProcessor();

$errors = array();

$action 	= isset($_REQUEST['action'])  ? $_REQUEST['action']  : null;
$gateway_id = isset($_REQUEST['gateway']) ? $_REQUEST['gateway'] : null;

$gateway_sid  = SJB_PaymentGatewayManager::getSIDByID($gateway_id);

if ( $_SERVER['REQUEST_METHOD'] == 'GET' && !empty($action) )
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

if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{

	$gateway = SJB_PaymentGatewayManager::createObjectByID($gateway_id, $_REQUEST);

	$gateway->dontSaveProperty('id');
	$gateway->dontSaveProperty('caption');

	$gateway->setSID($gateway_sid);

	if ($gateway->isValid())
	{
		SJB_PaymentGatewayManager::saveGateway($gateway);
	}
	else
	{
		$errors = $gateway->getErrors();
	}
}

$gateway = SJB_PaymentGatewayManager::getObjectByID($gateway_id);

$gateway_form = new SJB_Form($gateway);
$gateway_form->registerTags($template_processor);

$gateway_form->makeDisabled('id');
$gateway_form->makeDisabled('caption');

if ( empty($gateway) )
{
	$errors['GATEWAY_NOT_FOUND'] = 1;

	$template_processor->assign('errors', $errors);
	$template_processor->display('configure_gateway.tpl');

	return;
}

$gateway_info = SJB_PaymentGatewayManager::getInfoBySID($gateway_sid);

$form_fields = $gateway_form->getFormFieldsInfo();

$template_processor->assign('gateway', $gateway_info);
$template_processor->assign('form_fields', $form_fields);
$template_processor->assign('errors', $errors);
$template_processor->display('configure_gateway.tpl');

