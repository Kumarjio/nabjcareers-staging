<?php
error_reporting(0);
print_r($_POST);
require_once('payment/Payment/Payment.php');
require_once('payment/Payment/PaymentManager.php');
require_once("payment/Payment/PaymentFactory.php");
require_once("classifieds/MetaDataProvider.php");

//{* ELDAR *}
require_once "classifieds/SearchEngine/SearchFormBuilder.php";
require_once "classifieds/SearchEngine/PropertyAliases.php";
require_once "classifieds/Listing/ListingSearcher.php";
require_once "classifieds/Listing/ListingCriteriaSaver.php";
require_once "classifieds/Listing/ListingRequestCreator.php";
require_once "classifieds/ListingType/ListingTypeManager.php";
require_once "users/User/UserManager.php";
require_once "applications/Applications.php";
//{* ELDAR *}

require_once 'anet_php_sdk/AuthorizeNet.php';
$METHOD_TO_USE = "AIM";
define("AUTHORIZENET_API_LOGIN_ID","7982WkYCcSns");    // Add your API LOGIN ID
define("AUTHORIZENET_TRANSACTION_KEY","7922jKy7s8WCn5s9"); // Add your API transaction key
define("AUTHORIZENET_SANDBOX",false);       // Set to false to test against production
define("TEST_REQUEST", "TRUE");           // You may want to set to true if testing against production

//define("AUTHORIZENET_MD5_SETTING","");                // Add your MD5 Setting.

if (AUTHORIZENET_API_LOGIN_ID == "") {
    die('Enter your merchant credentials in config.php before running the sample app.');
}

/*$payment_id = SJB_Request::getVar('payment_id', null);
$checkPaymentErrors = array();
$tp = SJB_System::getTemplateProcessor();
$tp->assign('subscriptionComplete', SJB_Request::getVar('subscriptionComplete', false, SJB_Request::METHOD_GET));*/
//parent::SJB_PaymentGateway($gateway_info);
//$this->details = new SJB_AuthNetAIMDetails($gateway_info);

//$properties 		= $this->details->getProperties();
//$cc 				= $properties['currency_code']->getValue();
//$api_login_id 		= $properties['authnet_api_login_id']->getValue();
//$transaction_key 	= $properties['authnet_api_transaction_key']->getValue();
//require_once 'config.php';
print_r($_POST);
$transaction = new AuthorizeNetAIM;
$transaction->setSandbox(AUTHORIZENET_SANDBOX);
		$price	= 1.99;
		$transaction->setFields(
        array(
        'amount' => number_format($price), 
        'card_num' => $_POST['x_card_num'], 
        'exp_date' => $_POST['x_exp_date'],
        'first_name' => $_POST['x_first_name'],
        'last_name' => $_POST['x_last_name'],
        'address' => $_POST['x_address'],
        'city' => $_POST['x_city'],
        'state' => $_POST['x_state'],
        'country' => $_POST['x_country'],
        'zip' => $_POST['x_zip'],
        'email' => $_POST['x_email'],
        'card_code' => $_POST['x_card_code'],
        )
    );
	
	echo $_POST['x_card_num'];
	die("hello");
    $response = $transaction->authorizeAndCapture();
    if ($response->approved) {
        	echo "Approved";
		// Transaction approved! Do your logic here.
        //header('Location: thank_you_page.php?transaction_id=' . $response->transaction_id);
    } else {
        //header('Location: payment-error/?response_reason_code='.$response->response_reason_code.'&response_code='.$response->response_code.'&response_reason_text=' .$response->response_reason_text);
		
		echo "error";
		echo $response->response_reason_code;
		echo $response->response_reason_text;
    }