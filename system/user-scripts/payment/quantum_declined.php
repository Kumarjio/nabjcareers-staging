<!-- --><?php

require_once('payment/Payment/Payment.php');
require_once('payment/Payment/PaymentManager.php');
require_once("payment/Payment/PaymentFactory.php");
require_once("classifieds/MetaDataProvider.php");

require_once "classifieds/SearchEngine/SearchFormBuilder.php";
require_once "classifieds/SearchEngine/PropertyAliases.php";
require_once "classifieds/Listing/ListingSearcher.php";
require_once "classifieds/Listing/ListingCriteriaSaver.php";
require_once "classifieds/Listing/ListingRequestCreator.php";
require_once "classifieds/ListingType/ListingTypeManager.php";
require_once "users/User/UserManager.php";
require_once "applications/Applications.php";
require_once('membership_plan/Contract.php');

require_once("payment/PaymentGateway/PaymentGateway.php");

require_once "classifieds/ListingType/ListingTypeManager.php";
require_once 'membership_plan/PackagesManager.php';
require_once "users/Authorization.php";
				
$user_info = SJB_Authorization::getCurrentUserInfo();
$payment_sid			=	$_GET['payment_sid'];
//$payment 				= 	SJB_PaymentManager::getObjectBySID($payment_sid);
//$payment_amount 		= $payment->details->properties['price']->value;



	$succes_url = '/quantum_declined/'.'?payment_id='.$payment_sid;
	$tp = SJB_System::getTemplateProcessor();
	$tp->assign('payment_id', $payment_sid);
	$tp->assign('succes_url', $succes_url);
	
	$tp->display('reload_parent_declinedpayment.tpl');
