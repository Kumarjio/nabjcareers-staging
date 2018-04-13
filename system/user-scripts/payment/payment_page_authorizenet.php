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
require_once ("payment/PaymentGateways/AuthNetAIMDetails.php");
require_once "classifieds/ListingType/ListingTypeManager.php";
require_once 'membership_plan/PackagesManager.php';
require_once 'anet_php_sdk/AuthorizeNet.php';
require_once "users/Authorization.php";
$METHOD_TO_USE = "AIM";
define("AUTHORIZENET_API_LOGIN_ID",$_SESSION['api_login_id']);    	// Add your API LOGIN ID
define("AUTHORIZENET_TRANSACTION_KEY",$_SESSION['transaction_key']); // Add your API transaction key
define("AUTHORIZENET_SANDBOX",false);      							// Set to false to test against production
define("TEST_REQUEST", "FALSE");           							// You may want to set to true if testing against production
$user_info = SJB_Authorization::getCurrentUserInfo();
$payment_sid			=	$_GET['payment_sid'];
$payment 				= 	SJB_PaymentManager::getObjectBySID($payment_sid);
$user_sid				= 	$payment->details->properties['user_sid']->value;
$amount					= 	$payment->details->properties['price']->value;
$product_info 			= 	$payment->getProductInfo();

//print_r($product_info);
//die;
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

else if($listings_ids)
{
	$description	.= " job posting(s): ";
	foreach ($listings_ids as $listing_id)
	{
		$listing		= 	SJB_ListingManager::getListingInfoBySID($listing_id);
		$description 		.=	$listing['Title'].",";
	}
}

else if(isset($product_info['membership_plan_id']))
{
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

$errors = array();

if(isset($_POST['Submit']))
{
	if ( empty($_POST['x_card_num']) )			
		$errors['card_num'] = 1;
	elseif ( empty($_POST['x_exp_date']) )		
		$errors['exp_date'] = 1;
	elseif ( empty($_POST['x_card_code']) )		
		$errors['card_code'] = 1;
	else
	{
		$transaction = new AuthorizeNetAIM;
		$transaction->setSandbox(AUTHORIZENET_SANDBOX);
		$price	= $amount;
		$transaction->setFields(
		array(
			'amount' => number_format($price, 2, '.', ''), 
			'card_num' => $_POST['x_card_num'], 
			'exp_date' => $_POST['x_exp_date'],
			'first_name' => $user_info['CompanyName'],
			'address' => $user_info['Address'],
			'city' => $user_info['City'],
			'state' => $user_info['State'],
			'country' => $user_info['Country'],
			'zip' => $user_info['ZipCode'],
			'email' => $user_info['email'],
			'card_code' => $_POST['x_card_code'],
			'invoice_num' =>$payment_sid,
			'description' =>$description,			
			)
		);
		$transaction->setCustomField("Item Name", "Listings123");
		$transaction->setCustomField("transaction id", "45565465");
		
				$response = $transaction->authorizeAndCapture();
			if ($response->approved) {
				SJB_PaymentManager::endorsePayment($payment->getSID(),false);
			 	$succes_url =  $payment->details->properties['success_page_url']->value;
				SJB_HelperFunctions::redirect($succes_url . '?payment_id=' . $payment->getSID());
				unset($_SESSION['api_login_id']);
				unset($_SESSION['transaction_key']);
			} else {
				//echo $response->response_reason_text;
				SJB_HelperFunctions::redirect('/payments-error/?payment_sid=' . $payment->getSID());
			}
	}
}
$checkPaymentErrors = array();
$tp = SJB_System::getTemplateProcessor();
$tp->assign('errors', $errors);
$user_info = SJB_Authorization::getCurrentUserInfo();
if(isset($user_info))
$tp->display('checkout_form_authorize.tpl');
else 
SJB_HelperFunctions::redirect('/login/');
