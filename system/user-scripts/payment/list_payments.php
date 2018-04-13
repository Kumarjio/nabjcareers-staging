<?php
require_once "payment/Payment/Payment.php";
require_once "payment/Payment/PaymentManager.php";
require_once "payment/Payment/PaymentSearcher.php";
require_once "payment/Payment/PaymentCriteriaSaver.php";

require_once "classifieds/SearchEngine/SearchFormBuilder.php";
require_once "classifieds/SearchEngine/PropertyAliases.php";

require_once "forms/FormCollection.php";

require_once "classifieds/Listing/ListingManager.php";

require_once "users/User/UserManager.php";

$template_processor = SJB_System::getTemplateProcessor();

$user_info = SJB_Authorization::getCurrentUserInfo();

if (empty($user_info))
{
    $template_processor->assign("ERROR", "NOT_LOGIN");
    $template_processor->display("../miscellaneous/error.tpl");
    return;
}
/********** A C T I O N S   W I T H   P A Y M E N T S **********/

if (isset($_REQUEST['action'], $_REQUEST['payments']))
{
    $payments_sids = $_REQUEST['payments'];

    $_REQUEST['restore'] = 1;

    if (!strcasecmp('Complete', $_REQUEST['action']))					// ENDORSE

    {
        foreach ($payments_sids as $payment_id => $value)
        {
            SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL") . "/payment-page/?payment_id=" . $payment_id);
        }
    }
    else
    {
        unset($_REQUEST['restore']);
    }
}

/**********  D E F A U L T   V A L U E S   F O R   S E A R C H  **********/

$_REQUEST['action'] = 'filter';
$_REQUEST['username']['equal'] = $user_info['username'];

if (!isset($_REQUEST['creation_date']))
{
    $i18n =& SJB_ObjectMother::createI18N();

    $_REQUEST['creation_date']['not_less'] = $i18n->getDate(date('Y-m-d', time() - 30*24*60*60));
    $_REQUEST['creation_date']['not_more'] = $i18n->getDate(date('Y-m-d'));
}

/************************ S E A R C H   F O R M ***************************/

$payment = new SJB_Payment();

$payment->addProperty(array
        (
        'id'		=> 'username',
        'type'		=> 'string',
        'value'		=> '',
        'is_system' => true,
        )
);

$payment->addProperty(array
        (
        'id'		=> 'id',
        'type'		=> 'string',
        'value'		=> '',
        'is_system' => true,
        )
);

$aliases = new SJB_PropertyAliases();

$aliases->addAlias(array
        (
        'id' 					=> 'username',
        'real_id' 				=> 'user_sid',
        'transform_function'	=> 'SJB_UserManager::getUserSIDByUsername',
        )
);

$aliases->addAlias(array
        (
        'id' 					=> 'id',
        'real_id' 				=> 'sid',
        'transform_function'	=> 'SJB_PaymentManager::getPaymentSIDByID',
        )
);

$search_form_builder = new SJB_SearchFormBuilder($payment);
$criteria_saver = new SJB_PaymentCriteriaSaver();

if (isset($_REQUEST['restore']))
{
    $_REQUEST = array_merge($_REQUEST, $criteria_saver->getCriteria());
}

$criteria = $search_form_builder->extractCriteriaFromRequestData($_REQUEST, $payment);

$search_form_builder->setCriteria($criteria);
$search_form_builder->registerTags($template_processor);

$template_processor->display("payment_form.tpl");

/********************  S E A R C H  ************************/

$searcher = new SJB_PaymentSearcher();

// for dividing the usecase
// $criteria = SearchFormBuilder::extractCriteriaFromRequestData($_REQUEST, $payment);

$found_payments 	 = array();
$found_payments_sids = array();

if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'filter'))
{
    $found_payments = $searcher->getObjectsByCriteria($criteria, $aliases);
    $criteria_saver->setSession($_REQUEST, $searcher->getFoundObjectSIDs());
}
elseif (isset($_REQUEST['restore']))
{
    $found_payments = $criteria_saver->getObjectsFromSession();
}

$total_debit_price = 0;
$total_credit_price = 0;
$subuser = 0;

foreach($found_payments as $id => $payment)
{
    $total_debit_price += $payment->getPropertyValue('price');
	$total_credit_price += $payment->getPropertyValue('credit');
    $payment->addProperty(array(
            'id'	=> 'id',
            'type'	=> 'string',
            'value'	=> $payment->getSID(),
    ));

    // get sub-user id
    $subusername = '';
    $subuser_sid = $payment->getPropertyValue('subuser_sid');

    if ( $subuser_sid )
    {
        $subusername = SJB_UserManager::getUserNameByUserSID($subuser_sid);
        $subuser++;
    }
    else
    {
        $user_sid = $payment->getPropertyValue('user_sid');
        $subusername = SJB_UserManager::getUserNameByUserSID($user_sid);
    }

    $payment->addProperty( array(
        'id'	=> 'subusername',
        'type'	=> 'string',
        'value'	=> $subusername,
    ));
    // get subuser
    $found_payments_sids[$payment->getSID()] = $payment->getSID();

    $found_payments[$id] = $payment;
}

/*********************** S O R T I N G **************************/

$sorting_field = isset($_REQUEST['sorting_field']) ? $_REQUEST['sorting_field'] : 'creation_date';
$sorting_order = isset($_REQUEST['sorting_order']) ? $_REQUEST['sorting_order'] : 'DESC';

if ($payment->propertyIsSet($sorting_field))
{
    $sort_array 			 	= array();
    $sorted_found_payments_sids = array();

    foreach ($found_payments as $id => $payment)
    {
        $sort_array[$id] = $payment->getPropertyValue($sorting_field);
    }

    if ($sorting_order == 'ASC')
    {
        asort($sort_array);
    }
    elseif ($sorting_order == 'DESC')
    {
        arsort($sort_array);
    }

    foreach ($sort_array as $id => $value)
    {
        $sorted_found_payments_sids[$id] = $found_payments_sids[$id];
    }
}
else
{
    $sorted_found_payments_sids = $found_payments_sids;
}

/****************************************************************/

$form_collection = new SJB_FormCollection($found_payments);
$form_collection->registerTags($template_processor);

$subUsers = SJB_UserManager::getSubUsers($user_info['sid']);
$subuserExists = ( !empty($subUsers) ) ? true : false;


$template_processor->assign("subuser", $subuserExists);

$template_processor->assign("sorting_field", $sorting_field);
$template_processor->assign("sorting_order", $sorting_order);
$template_processor->assign("found_payments_ids", $sorted_found_payments_sids);
$template_processor->assign("total_debit_price", $total_debit_price);
$template_processor->assign("total_credit_price", $total_credit_price);
$template_processor->display('payments.tpl');

