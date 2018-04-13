<?php

require_once "payment/OpenInvoice/OpenInvoice.php";
require_once "payment/OpenInvoice/OpenInvoiceManager.php";
require_once "payment/OpenInvoice/OpenInvoiceSearcher.php";
require_once "payment/OpenInvoice/OpenInvoiceCriteriaSaver.php";

require_once "payment/Payment/PaymentManager.php";

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
$action = SJB_Request::getVar('action', false);
$open_invoice_sid = SJB_Request::getVar('open_invoice_sid', false);
$i18n =& SJB_ObjectMother::createI18N();
if ( $action && $open_invoice_sid ) {
	$_REQUEST['restore'] = 1;
	if ( $action == 'close' ) {
		$res = SJB_OpenInvoiceManager::closeOpenInvoice($open_invoice_sid);
	} elseif ( $action == 'delete') {
		
		/******* 19-04-2017 */
		$deLPayment_sid = SJB_OpenInvoiceManager::getPaymentSIDbyOpenInvoiceSID($open_invoice_sid);
		SJB_PaymentManager::deletePaymentBySID($deLPayment_sid[0]['payment_sid']);
		/****** 19-04-2017 END ***/
		
		$res = SJB_OpenInvoiceManager::deleteOpenInvoice($open_invoice_sid);
				
	} elseif ( $action == 'apply_credit') {
		$amount = isset($_REQUEST['amount'])?$_REQUEST['amount']:null;
		if(!$i18n->isValidFloat($amount) || !isset($amount) || $amount <= 0) {
			$errors[] = "INVALID_AMOUNT";
		} else
			$res = SJB_OpenInvoiceManager::applyCredit($open_invoice_sid, $amount);

	
				/***** 18-06-2017 ***/
				} elseif ( $action == 'change_amount') {
					$new_amount = isset($_REQUEST['new_amount'])?$_REQUEST['new_amount']:null;
					if(!$i18n->isValidFloat($new_amount) || !isset($new_amount) || $new_amount <= 0) {
						$errors[] = "INVALID_AMOUNT";
					} else
						$res = SJB_OpenInvoiceManager::changeAmount($open_invoice_sid, $new_amount);
				
				/***** END 18-06-2017 ***/
	
	
	} else {
		unset($_REQUEST['restore']);
	}
}

/**********  D E F A U L T   V A L U E S   F O R   S E A R C H  **********/

$_REQUEST['action'] = 'filter';
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

if (!isset($_REQUEST['is_opened'])) {
	$_REQUEST['is_opened']['equal'] = true;
}
/************************ S E A R C H   F O R M ***************************/

$open_invoice = new SJB_OpenInvoice();

$open_invoice->addProperty(array(
		'id'		=> 'username',
		'type'		=> 'string',
		'value'		=> '',
		'is_system' => true,
	)
);

$aliases = new SJB_PropertyAliases();

$aliases->addAlias(array(
		'id' 					=> 'username',
		'real_id' 				=> 'user_sid',
		'transform_function'	=> 'SJB_UserManager::getUserSIDsLikeUsername',
	)
);

$search_form_builder = new SJB_SearchFormBuilder($open_invoice);
$criteria_saver = new SJB_OpenInvoiceCriteriaSaver();

if (isset($_REQUEST['restore'])) {
	$_REQUEST = array_merge($_REQUEST, $criteria_saver->getCriteria());
}

$criteria = $search_form_builder->extractCriteriaFromRequestData($_REQUEST, $open_invoice);

$search_form_builder->setCriteria($criteria);
$search_form_builder->registerTags($tp);

$tp->display("open_invoices_form.tpl");

/********************  S E A R C H  ************************/
$sorting_field = isset($_REQUEST['sorting_field']) ? $_REQUEST['sorting_field'] : 'creation_date';
$sorting_order = isset($_REQUEST['sorting_order']) ? $_REQUEST['sorting_order'] : 'DESC';

$searcher = new SJB_OpenInvoiceSearcher(($page - 1) * $items_per_page, $sorting_field, $sorting_order);

$found_invoices 	 = array();
$found_invoices_sids = array();

if ( SJB_Request::getVar('action', '') === 'filter') {
	$found_invoices = $searcher->getObjectsByCriteria($criteria, $aliases);
	$criteria_saver->setSession($_REQUEST, $searcher->getFoundObjectSIDs());
}
elseif ( isset( $_REQUEST['restore'])) {
	$found_invoices = $criteria_saver->getObjectsFromSession();
}

$total_price = 0;
$listings_titles = array();
foreach($found_invoices as $id => $open_invoice) {
	$total_price += $open_invoice->getPropertyValue('price');
	$user_sid = $open_invoice->getPropertyValue('user_sid');
	$username = SJB_UserManager::getUserNameByUserSID($user_sid);
	$compname = SJB_UserManager::getCompanyNameByUserSID($user_sid);

	$open_invoice->addProperty( array(
		'id'	=> 'sid',
		'type'	=> 'string',
		'value'	=> $open_invoice->getSID(),
	));

	$open_invoice->addProperty( array(
		'id'	=> 'username',
		'type'	=> 'string',
		'value'	=> $username,
	));

	$open_invoice->addProperty( array(
			'id'	=> 'compname',
			'type'	=> 'string',
			'value'	=> $compname,
	));



	$payment_sid = $open_invoice->getPropertyValue('payment_sid');
	$payment_info = SJB_PaymentManager::getPaymentInfoBySID($payment_sid);
	$product_info = !empty($payment_info) ? unserialize($payment_info['product_info']) : array();
	if (isset($product_info['listing_id'])) {
		$listing = SJB_ListingManager::getListingInfoBySID($product_info['listing_id']);
		$listings_titles[$open_invoice->getSID()][] = $listing['Title'];
	} elseif(isset($product_info['listings_ids'])) {
		$listing_ids = array_pop($product_info['listings_ids']);
		foreach($listing_ids as $listing_id) {
			$listing = SJB_ListingManager::getListingInfoBySID($listing_id);
			$listings_titles[$open_invoice->getSID()][] = $listing['Title'];
		}
	}

	$open_invoice->addProperty( array(
		'id'	=> 'name',
		'type'	=> 'string',
		'value'	=> $payment_info['name'],
	));


	$found_invoices_sids[$open_invoice->getSID()] = $open_invoice->getSID();
	$found_invoices[$id] = $open_invoice;
}

/*********************** S O R T I N G **************************/
$rowsCount = $searcher->getAffectedRows();
$sorted_found_invoices_sids = $found_invoices_sids;
/****************************************************************/

$pages = array();

for ($i = $page - 3; $i < $page + 3; $i++) {
	if ($i > 0)
		$pages[] = $i;
	if ($i * $items_per_page > $rowsCount)
		break;
}

$totalPages = ceil($rowsCount / $items_per_page);
if (empty($totalPages))
	$totalPages = 1;

if (array_search(1, $pages) === false)
	array_unshift($pages, 1);
if (array_search($totalPages, $pages) === false)
	array_push($pages, $totalPages);

$tp->assign("currentPage", $page);
$tp->assign("totalPages", $totalPages);
$tp->assign("pages", $pages);
$tp->assign("listingsCount", $rowsCount);

$form_collection = new SJB_FormCollection($found_invoices);
$form_collection->registerTags($tp);

$tp->assign("errors", $errors);
$tp->assign("sorting_field", $sorting_field);
$tp->assign("sorting_order", $sorting_order);
$tp->assign("found_open_invoices_sids", $sorted_found_invoices_sids);
$tp->assign("total_price", $total_price);
$tp->assign("listings_titles", $listings_titles);
$tp->display('open_invoices.tpl');
