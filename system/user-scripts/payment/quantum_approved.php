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
$trans_qgw_sid			=	$_GET['transID'];
$md5_response_hash		=	$_GET['md5_hash'];
$response_amount		=	$_GET['Amount'];
$payment_sid 		=	$_GET['CustomerID'];
 
$payment 				= 	SJB_PaymentManager::getObjectBySID($payment_sid);
//echo $md5_response_hash.'222';
//$payment_amount 		= $payment->details->properties['price']->value;

/*if (isset($_POST['md5_hash']) ) {
	$payment_md5hash			= $_POST['md5_hash'];
	$qwtransID = $_POST['transID'];
}
*/
$str ='123nabjca1114'.$trans_qgw_sid.$response_amount;
$keyFromDB = md5($str);

if ($md5_response_hash == $keyFromDB) {
$succes_url =  $payment->details->properties['success_page_url']->value;
$succes_url =  $succes_url.'?payment_id='.$payment_sid.'&gw=quantum_ver';
$payment->SetStatus(PAYMENT_STATUS_VERIFIED);
SJB_PaymentManager::savePayment($payment);

$tp = SJB_System::getTemplateProcessor();
$tp->assign('payment_id', $payment_sid);
$tp->assign('succes_url', $succes_url);
//$tp->assign('payment_amount', $keyFromDB);
//$tp->assign('payment_md5hash', $payment_md5hash);
$tp->display('reload_parent_approvedpayment.tpl');
}
 else {
	$succes_url = '/quantum_declined';
	$tp = SJB_System::getTemplateProcessor();
	$tp->assign('payment_id', $payment_sid);
	$tp->assign('succes_url', $succes_url);
	
	$tp->display('reload_parent_declinedpayment.tpl');	
}
