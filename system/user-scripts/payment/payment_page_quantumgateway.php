<!-- --><?php
error_reporting(0);
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

					require_once("payment/PaymentGateways/QuantumGateway.php");
					
$user_info = SJB_Authorization::getCurrentUserInfo();

$payment_sid			=	$_GET['payment_sid'];
$payment 				= 	SJB_PaymentManager::getObjectBySID($payment_sid);
$user_sid				= 	$payment->details->properties['user_sid']->value;
$amount					= 	$payment->details->properties['price']->value;
$product_info 			= 	$payment->getProductInfo();
$payment->setStatus(PAYMENT_STATUS_VERIFIED);
$description =	"Payment for ";
$listings_ids = array_pop($product_info['listings_ids']);

if(isset($product_info['priority_listing_id']))
{
	$listing_id	=	$product_info['priority_listing_id'];
	$listing		= 	SJB_ListingManager::getListingInfoBySID($listing_id); 
	$description	.= "upgrading job posting(s): ".$listing['Title'] ." to priority "; 	
}

if(isset($product_info['featured_listing_id']))
{
	$listing_id	=	$product_info['featured_listing_id'];
	$listing		= 	SJB_ListingManager::getListingInfoBySID($listing_id); 
	$description	.= "upgrading job posting(s) : ".$listing['Title'] ." to featured" ; 	
}

else if($listings_ids) {
	$description	.= " job posting(s): ";
	foreach ($listings_ids as $listing_id)	{
		$listing		= 	SJB_ListingManager::getListingInfoBySID($listing_id);
		$description 		.=	$listing['Title'].",";
	}
}

else if(isset($product_info['membership_plan_id'])) {
	 $description	=	"Payment for resume database access: ". $product_info['subscription_period'] . " days";	
}

else if(!isset($listings_ids) && !isset($product_info['priority_listing_id']) && !isset($product_info['priority_listing_id'])  )
{
	$description	.= " job posting(s): ";
	$listings		=	unserialize($payment->details->properties['product_info']->value);
	$listing_id		=	 $listings['listing_id'];	
	$listing		= 	SJB_ListingManager::getListingInfoBySID($listing_id);
	$description 		 .=	$listing['Title'].",";
	
}
$description	=	rtrim($description,",");
// $succes_url =  $payment->details->properties['success_page_url']->value;
$errors = array();

$checkPaymentErrors = array();
$tp = SJB_System::getTemplateProcessor();
$tp->assign('errors', $errors);
$tp->assign('payment_amount', $amount);
		$tp->assign('payment_id', $payment->getSID());
		$tp->assign('succes_url', $succes_url);


include_once("quantum_iframe.php");

$apiUnamesDb = SJB_DB::query("SELECT `value` FROM `payment_gateways_properties` WHERE `sid` = 48");
foreach ($apiUnamesDb as $apiUnameDb) {
	$API_UNAME = $apiUnameDb['value'];
}

$apiKeysDb = SJB_DB::query("SELECT `value` FROM `payment_gateways_properties` WHERE `sid` = 49");
foreach ($apiKeysDb as $apiKeyDb) {
	$API_KEY = $apiKeyDb['value'];
}

	##(API username, API Key, Width, Height, Amount, ID, CustomerID, METHOD , AddToVault, SkipShipping)
$quantum = quantumilf_getCode($API_UNAME, $API_KEY, '800', '500', $amount, '10', $payment->getSID(), '0', 'N', 'Y');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php echo $quantum['script'];?>
</head>

<body>
<?php echo $quantum['iframe'];?>
</body>
</html>





