<?php

require_once "payment/Payment/Payment.php";
require_once "payment/Payment/PaymentManager.php";
require_once "payment/Payment/PaymentSearcher.php";
require_once "payment/Payment/PaymentCriteriaSaver.php";

require_once "classifieds/SearchEngine/SearchFormBuilder.php";
require_once "classifieds/SearchEngine/PropertyAliases.php";
require_once "classifieds/Listing/ListingManager.php";

require_once "forms/FormCollection.php";
require_once "users/User/UserManager.php";

require_once("membership_plan/Contract.php");
require_once("ObjectMother.php");

$tp = SJB_System::getTemplateProcessor();
$errors = array();
$page = 1;
if (!empty($_REQUEST["page"]))
    $page = intval($_REQUEST["page"]);
$items_per_page = 100;

/********** A C T I O N S   W I T H   P A Y M E N T S **********/
$action_name	= SJB_Request::getVar('action_name', false);
$action			= SJB_Request::getVar('action', false);
if ( $action_name ) {
    $action = $action_name;
}
$payments_sids	= SJB_Request::getVar('payments', false);

if ( $action && $payments_sids ) {
    $payments_sids = $_REQUEST['payments'];
    $_REQUEST['restore'] = 1;

    if ( $action == 'endorse' ) {				// ENDORSE
        foreach ($payments_sids as $payment_sid => $value) {
			SJB_PaymentManager::endorsePayment($payment_sid, true);
            $payment_info = SJB_PaymentManager::getPaymentInfoBySID($payment_sid);
            $product_info = !empty($payment_info) ? unserialize($payment_info['product_info']) : array();

            /* if current payment NOT pending - skip it!
            if ($payment_info['status'] != 'Pending') {
                $errors[] = 'PAYMENT_IS_NOT_PENDING';
                continue;
            }
*/
            if (isset($product_info['listing_id'])) {
                SJB_ListingManager::activateListingBySID($product_info['listing_id']);
                SJB_PaymentManager::endorsePayment($payment_sid);
            }
            elseif (isset($product_info['listings_ids'])) {
                $listings_ids = array_pop($product_info['listings_ids']);
                foreach ($listings_ids as $listing_id) {
                    SJB_ListingManager::activateListingBySID($listing_id);
                }
                SJB_PaymentManager::endorsePayment($payment_sid, true);
            }
            elseif (isset($product_info['membership_plan_id'])) {
                $user_sid = $payment_info['user_sid'];
                $user = SJB_UserManager::getObjectBySID($user_sid);
                if ($user) {
                    $contract = new SJB_Contract(array('membership_plan_id' => $product_info['membership_plan_id']));
                    $contract->setUserSID($user_sid);
                    $contract->saveInDB();

					require_once("miscellaneous/UserNotifications.php");
					require_once("miscellaneous/Notifications.php");
                    if (SJB_UserNotifications::isUserNotifiedOnSubscriptionActivation($user_sid)) {
                        $membershipPlanInfo = SJB_MembershipPlanManager::getMembershipPlanInfoByID($product_info['membership_plan_id']);
                        SJB_Notifications::sendSubscriptionActivationLetter($user_sid, $membershipPlanInfo);
                    }
                }
                SJB_PaymentManager::endorsePayment($payment_sid);
            }
            elseif (isset($product_info['featured_listing_id'])) {
                SJB_ListingManager::makeFeaturedBySID($product_info['featured_listing_id']);
                SJB_PaymentManager::endorsePayment($payment_sid);
            }
			
			// ----------------- ELDAR ----------------
			elseif (isset($product_info['priority_listing_id'])) {
                SJB_ListingManager::makePriorityBySID($product_info['priority_listing_id']);
                SJB_PaymentManager::endorsePayment($payment_sid);
            }
			// ----------------- end ELDAR ----------------
        }
    }
    elseif ( $action == 'delete') {			// DELETE
        foreach ($payments_sids as $payment_sid => $value) {

/// 26-02-2018 delete open invoice + invoice log
//          $res = SJB_PaymentManager::deletePaymentBySID($payment_sid);
        	$open_invoice_sidss = SJB_PaymentManager::getOpenInvoiceSIDbyPaymentSID($payment_sid);
        	foreach ($open_invoice_sidss as $open_invoice_sids) {
    	        foreach ($open_invoice_sids as $open_invoice_sid) {
	            	if($open_invoice_sid) {
		            	$res = SJB_PaymentManager::deletePaymentBySIDandInvoice($payment_sid, $open_invoice_sid);
	            	} else {
	            		$res = SJB_PaymentManager::deletePaymentBySID($payment_sid);
	            	}
    	        }
        	}
        }
    }
    else {
        unset($_REQUEST['restore']);
    }
}

/**********  D E F A U L T   V A L U E S   F O R   S E A R C H  **********/

$_REQUEST['action'] = 'filter';

$i18n =& SJB_ObjectMother::createI18N();
if (!isset($_REQUEST['creation_date'])) {
    $_REQUEST['creation_date']['not_less'] = $i18n->getDate(date('Y-m-d', time() - 30*24*60*60));
    $_REQUEST['creation_date']['not_more'] = $i18n->getDate(date('Y-m-d', time() + 24*60*60));
}
else {
    if(!$i18n->isValidDate($_REQUEST['creation_date']['not_less']) && !empty($_REQUEST['creation_date']['not_less'])) {
        $errors[] = "INVALID_PERIOD_FROM";
    }
    if(!$i18n->isValidDate($_REQUEST['creation_date']['not_more']) && !empty($_REQUEST['creation_date']['not_more'])) {
        $errors[] = "INVALID_PERIOD_TO";
    }
}

if (!isset($_REQUEST['credit'])) {
	$_REQUEST['credit']['equal'] = 0;
}

/************************ S E A R C H   F O R M ***************************/

$payment = new SJB_Payment();

$payment->addProperty(array(
        'id'		=> 'username',
        'type'		=> 'string',
        'value'		=> '',
        'is_system' => true,
        )
);

$payment->addProperty( array(
		'id'	=> 'compname',
		'type'	=> 'string',
        'value'		=> '',
        'is_system' => true,
));


$aliases = new SJB_PropertyAliases();

$aliases->addAlias(array(
        'id' 					=> 'username',
        'real_id' 				=> 'user_sid',
        'transform_function'	=> 'SJB_UserManager::getUserSIDsLikeUsername',
        )
);

$search_form_builder = new SJB_SearchFormBuilder($payment);
$criteria_saver = new SJB_PaymentCriteriaSaver();

if (isset($_REQUEST['restore'])) {
    $_REQUEST = array_merge($_REQUEST, $criteria_saver->getCriteria());
}

$criteria = $search_form_builder->extractCriteriaFromRequestData($_REQUEST, $payment);

$search_form_builder->setCriteria($criteria);
$search_form_builder->registerTags($tp);

$tp->display("payment_form.tpl");

/********************  S E A R C H  ************************/
$sorting_field = isset($_REQUEST['sorting_field']) ? $_REQUEST['sorting_field'] : 'creation_date';
$sorting_order = isset($_REQUEST['sorting_order']) ? $_REQUEST['sorting_order'] : 'DESC';
$inner_join = false;
if ($sorting_field == 'username')
    $inner_join = array('users' => array('sort_field'=>'username', 'join_field' => 'sid', 'join_field2' => 'user_sid', 'join'=>'LEFT JOIN'));

$searcher = new SJB_PaymentSearcher(($page - 1) * $items_per_page, $sorting_field, $sorting_order, $inner_join);

// for dividing the usecase
// $criteria = SearchFormBuilder::extractCriteriaFromRequestData($_REQUEST, $payment);
$found_payments 	 = array();
$found_payments_sids = array();
$found_payments_titles = array();



// 21 janv Listings Titles - Eldar
$listings_titles = array();



if ( SJB_Request::getVar('action', '') === 'filter') {
    $found_payments = $searcher->getObjectsByCriteria($criteria, $aliases);
    $criteria_saver->setSession($_REQUEST, $searcher->getFoundObjectSIDs());
}
elseif ( isset( $_REQUEST['restore'])) {
    $found_payments = $criteria_saver->getObjectsFromSession();
}

$total_price = 0;

foreach($found_payments as $id => $payment) {
    $total_price += $payment->getPropertyValue('price');
    $user_sid = $payment->getPropertyValue('user_sid');
    $username = SJB_UserManager::getUserNameByUserSID($user_sid);
    
    
    
    //Titles - Eldar
    $payment_sid_title = $payment->getSID();
    $payment_info_title = SJB_PaymentManager::getPaymentInfoBySID($payment_sid_title);
    $product_info_title = !empty($payment_info_title) ? unserialize($payment_info_title['product_info']) : array();
    
    if (isset($product_info_title['listing_id'])) {
    	$listing_title = SJB_ListingManager::getListingInfoBySID($product_info_title['listing_id']);
    	$listings_titles[$payment->getSID()]['sid'][] = $payment->getSID();
    	$listings_titles[$payment->getSID()]['title'][] = $listing_title['Title'];
    } elseif(isset($product_info_title['listings_ids'])) {
    	$listing_ids_title = array_pop($product_info_title['listings_ids']);
    	foreach($listing_ids_title as $listing_id_title) {
    		$listing_title = SJB_ListingManager::getListingInfoBySID($listing_id_title);
    		
    		
    		
    		$listings_titles[$payment->getSID()]['sid'][] = $payment->getSID();
    		$listings_titles[$payment->getSID()]['title'][] = $listing_title['Title']." ";
    	}
    }
    
    
/* CompanyName property added by Eldar */
    $compname = SJB_UserManager::getCompanyNameByUserSID($user_sid);
/* END CompanyName property added by Eldar */
    
    
    $payment->addProperty( array(
            'id'	=> 'sid',
            'type'	=> 'string',
            'value'	=> $payment->getSID(),
    ));

    $payment->addProperty( array(
            'id'	=> 'username',
            'type'	=> 'string',
            'value'	=> $username,
    ));

    /* CompanyName property added by Eldar */
    $payment->addProperty( array(
    		'id'	=> 'compname',
    		'type'	=> 'string',
    		'value'	=> $compname,
    ));
    /* END CompanyName property added by Eldar */    
    
    $found_payments_sids[$payment->getSID()] = $payment->getSID();
    $found_payments[$id] = $payment;
 //   $found_payments_titles[$payment->getSID()][sid] = $payment->getSID();
//    $found_payments_titles[$payment->getSID()][title] = $listings_titles[$payment->getSID()][];
}

/*********************** S O R T I N G **************************/
$listingsCount = $searcher->getAffectedRows();
$sorted_found_payments_sids = $found_payments_sids;
/****************************************************************/

$pages = array();

for ($i = $page - 3; $i < $page + 3; $i++) {
    if ($i > 0)
        $pages[] = $i;
    if ($i * $items_per_page > $listingsCount)
        break;
}

$totalPages = ceil($listingsCount / $items_per_page);
if (empty($totalPages))
	$totalPages = 1;

if (array_search(1, $pages) === false)
	array_unshift($pages, 1);
if (array_search($totalPages, $pages) === false)
	array_push($pages, $totalPages);

$tp->assign("currentPage", $page);
$tp->assign("totalPages", $totalPages);
$tp->assign("pages", $pages);
$tp->assign("listingsCount", $listingsCount);

$form_collection = new SJB_FormCollection($found_payments);
$form_collection->registerTags($tp);

$tp->assign("errors", $errors);
$tp->assign("sorting_field", $sorting_field);
$tp->assign("sorting_order", $sorting_order);
$tp->assign("found_payments_sids", $sorted_found_payments_sids);
$tp->assign("total_price", $total_price);


$tp->assign("listings_titles", $listings_titles);
/*
$tp->assign("compname", $compname);
/**/
$tp->display('payments.tpl');
