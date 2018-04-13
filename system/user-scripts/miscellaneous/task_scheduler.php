<?php

set_time_limit(0);
$template_processor = SJB_System::getTemplateProcessor();

require_once('miscellaneous/Notifications.php');
require_once('miscellaneous/AdminNotifications.php');
require_once('miscellaneous/UserNotifications.php');

$last_executed_date = SJB_Settings::getSettingByName('task_scheduler_last_executed_date');
$i18n = SJB_I18N::getInstance();
$lang = $i18n->getLanguageData($i18n->getCurrentLanguage());
$current_date = strftime("%Y", time());

// Deactivate Expired Listings & Send Notifications
require_once('classifieds/Listing/ListingManager.php');
$expired_listings_id = SJB_ListingManager::getExpiredListingsSID();

foreach ($expired_listings_id as $expired_listing_id) {
	SJB_ListingManager::deactivateListingBySID($expired_listing_id, true);
	$listing = SJB_ListingManager::getObjectBySID($expired_listing_id);
	$listing_info = SJB_ListingManager::createTemplateStructureForListing($listing);

	if (SJB_UserNotifications::isUserNotifiedOnListingExpiration($listing->getUserSID()))
		SJB_Notifications::sendUserListingExpiredLetter($listing->getUserSID(), $listing_info);

	if (SJB_AdminNotifications::isAdminNotifiedOnListingExpiration())
		SJB_AdminNotifications::sendAdminListingExpiredLetter($listing_info);

	// notify subadmins

	$subAdminsToNotify = SJB_AdminNotifications::isSubAdminNotifiedOnListingExpiration();

	if (is_array($subAdminsToNotify) && !empty($subAdminsToNotify))

		SJB_AdminNotifications::sendAdminListingExpiredLetter($listing_info, $subAdminsToNotify);

}



if (SJB_Settings::getSettingByName('automatically_delete_expired_listings')) {

	// Deleted jobs mod - put expired jobs in deleted section
	$period_delete_expired_listings= SJB_Settings::getSettingByName('period_delete_expired_listings');
	
	// 2017/10 resumes
	$period_delete_expired_resumes= SJB_Settings::getSettingByName('period_delete_expired_resumes');
	/// END resumes
	
	$deactivated_listings_id = SJB_ListingManager::getDeactivatedListingsSID();

	foreach ($deactivated_listings_id as $listing_id) {
// 2017		
		$deactiv_listing_info = SJB_ListingManager::getListingInfoBySID($listing_id);
		$deactiv_listing_expir_time = $deactiv_listing_info['expiration_date'];
		$deactiv_listing_expir_date = new DateTime($deactiv_listing_expir_time);
		$deactiv_listing_expir_date = $deactiv_listing_expir_date->format('Y-m-d');
		
//	 2017	$current_date = strftime($lang['date_format'], time());
		$curr_date_format = new DateTime($current_date);
		$curr_date_format = $curr_date_format->format('Y-d-m');
		$expired_listing_type_sid = SJB_ListingManager::getListingTypeByListingSID($listing_id);
// 10/2017		
		if ($expired_listing_type_sid == 6) {
			$listing_delete_date = $period_delete_expired_listings + $deactiv_listing_expir_date;
			if ($listing_delete_date == $curr_date_format) {
				SJB_ListingManager::deletedListingBySID($listing_id);
			}
		}
			
			// 10/2017 delete resumes date
		if ($expired_listing_type_sid == 7) {

			$listing_delete_date = $period_delete_expired_listings + $deactiv_listing_expir_date;
			if ($listing_delete_date == $curr_date_format) {
				SJB_ListingManager::deletedListingBySID($listing_id);
			}	
			// END 10/2017 delete resumes date						
		}		
	}

}

/////////////////////////// Send remind notifications about expiration of LISTINGS
// 1. get user sids and days count of 'remind listing notification' setting = 1 from user_notifications table
// 2. foreach user:
//   - get listings with that expiration remind date
//   - check every listing sid in DB table of sended. If sended - remove from send list
//   - send notification with listings to user
//   - write listings sid in DB table of sended notifications

$notificationData = SJB_UserNotifications::getUsersAndDaysOnListingExpirationRemind();

foreach ($notificationData as $elem) {
	$userSID = $elem['user_sid'];
	$days    = $elem['days'];
	
	$listingSIDs = SJB_ListingManager::getListingsIDByDaysLeftToExpired($userSID, $days);

	if ( empty($listingSIDs) ) {
		continue;
	}

	$listingsInfo = array();
	// check listings remind sended
	foreach ($listingSIDs as $key => $sid) {

		if (SJB_ListingManager::isListingNotificationSended($sid)) {
			unset($listingSIDs[$key]);
			continue;
		}
		$info = SJB_ListingManager::getListingInfoBySID($sid);
		$listingsInfo[$sid] = $info;
	}

	if (!empty($listingsInfo)) {
		// now only unsended listings we have in array
		// send listing notification
		foreach ($listingSIDs as $sid) {
			SJB_Notifications::sendRemindListingExpirationLetter($userSID, $listingsInfo[$sid], $days);
		}

		// write listing id in DB table of sended notifications
		SJB_ListingManager::saveListingIDAsSendedNotificationsTable($listingSIDs);
	}
}

// Send Notifications for Expired Contracts
require_once 'membership_plan/ContractManager.php';

$expired_contracts_id = SJB_ContractManager::getExpiredContractsID();
foreach ($expired_contracts_id as $expired_contract_id) {
	$contractInfo = SJB_ContractManager::getInfo($expired_contract_id);
	$planInfo = SJB_ContractManager::getExtraInfoByID($expired_contract_id);
	$userInfo = SJB_UserManager::getUserInfoBySID($contractInfo['user_sid']);
	if (SJB_UserNotifications::isUserNotifiedOnContractExpiration($contractInfo['user_sid']))
		SJB_Notifications::sendUserContractExpiredLetter($userInfo, $contractInfo, $planInfo);
	if (SJB_AdminNotifications::isAdminNotifiedOnUserContractExpiration())
		SJB_AdminNotifications::sendAdminUserContractExpiredLetter($userInfo, $contractInfo, $planInfo);
    // notify subadmins
	$subAdminsToNotify = SJB_AdminNotifications::isSubAdminNotifiedOnUserContractExpiration();
	if (  is_array($subAdminsToNotify) && !empty($subAdminsToNotify))
		SJB_AdminNotifications::sendAdminUserContractExpiredLetter($userInfo, $contractInfo, $planInfo, $subAdminsToNotify);
	SJB_ContractManager::deleteContract($expired_contract_id, $contractInfo['user_sid']);
}

//////////////////////// Send remind notifications about expiration of contracts
// 1. get user sids and days count of 'remind subscription notification' setting = 1 from user_notifications table
// 2. foreach user:
//   - get contracts with that expiration remind date
//   - check every contract sid in DB table of sended. If sended - remove from send list
//   - send notification with contracts to user
//   - write contract sid in DB table of sended contract notifications

$notificationData = SJB_UserNotifications::getUsersAndDaysOnSubscriptionExpirationRemind();

foreach ($notificationData as $elem) {
	$userSID = $elem['user_sid'];
	$days    = $elem['days'];

	$contractSIDs = SJB_ContractManager::getContractsIDByDaysLeftToExpired($userSID, $days);

	if ( empty($contractSIDs) ) {
		continue;
	}

	$contractsInfo = array();

	// check contracts sended

	foreach ($contractSIDs as $key => $sid) {

		if (SJB_ContractManager::isContractNotificationSended($sid)) {

			unset($contractSIDs[$key]);

			continue;

		}

		$info = SJB_ContractManager::getInfo($sid);

		$info['extra_info'] = !empty($info['serialized_extra_info']) ? unserialize($info['serialized_extra_info']) : '';

		

		$contractsInfo[$sid] = $info;

	}



	if (!empty($contractsInfo)) {
		// now only unsended contracts we have in array
		// send contract notification

		foreach ($contractSIDs as $sid) {
			SJB_Notifications::sendRemindSubscriptionExpirationLetter($userSID, $contractsInfo[$sid], $days);
		}
		// write contract id in DB table of sended contract notifications
		SJB_ContractManager::saveContractIDAsSendedNotificationsTable($contractSIDs);
	}
}



// delete applications with no employer and job seeker

require_once('applications/Applications.php');

$emptyApplications = SJB_DB::query('SELECT `id` FROM `applications` WHERE `show_js` = 0 AND `show_emp` = 0');

foreach ( $emptyApplications as $application)

	SJB_Applications::remove($application['id']);



// Send Search Notifications

require_once('classifieds/SavedSearches.php');

require_once 'classifieds/Listing/ListingSearcher.php';

require_once 'classifieds/SearchEngine/SearchFormBuilder.php';

require_once 'classifieds/SearchEngine/PropertyAliases.php';



$saved_searches = SJB_SavedSearches::getAutoNotifySavedSearches();

$listing = new SJB_Listing();

$notified_saved_searches_sid = array();

foreach ($saved_searches as $saved_search) {

	$searcher = new SJB_ListingSearcher();

	$listing->addActivationDateProperty();

	$search_data = unserialize($saved_search['data']);

	$search_data['active']['equal'] = 1;

	$datearr = explode('-', $saved_search['last_send']);

	$saved_search['last_send'] = strftime($lang['date_format'], mktime(0, 0, 0, $datearr[1], $datearr[2], $datearr[0]));

	$search_data['activation_date']['not_less'] = $saved_search['last_send'];

	$search_data['activation_date']['not_more'] = $current_date;

	if ($search_data['listing_type']['equal']) {

		$listing_type_id = $search_data['listing_type']['equal'];

		$listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id);

		if(SJB_ListingTypeManager::getWaitApproveSettingByListingType($listing_type_sid))

			$search_data['status']['equal'] = 'approved';

	}

	$id_alias_info = $listing->addIDProperty();

	$username_alias_info = $listing->addUsernameProperty();

	$listing_type_id_info = $listing->addListingTypeIDProperty();

	$aliases = new SJB_PropertyAliases();

	$aliases->addAlias($id_alias_info);

	$aliases->addAlias($username_alias_info);

	$aliases->addAlias($listing_type_id_info);



	$search_data['access_type'] = array(

					'accessible' => $saved_search['user_sid'],

				);



	$criteria = SJB_SearchFormBuilder::extractCriteriaFromRequestData($search_data, $listing);

	$searcher->found_object_sids = array();

	$found_listings_ids = $searcher->getObjectsSIDsByCriteria($criteria, $aliases);



	if (count($found_listings_ids)) {

		$saved_search['activation_date'] = $saved_search['last_send'];

		foreach ($found_listings_ids as $key => $sid) {

			$listing_info = SJB_ListingManager::getListingInfoBySID($sid);

			$newArr[$key]['title'] = $listing_info['Title'];

			$newArr[$key]['posted'] = $listing_info['activation_date'];

			$newArr[$key]['sid'] = $sid;

			$newArr[$key]['listing_type_sid'] = $search_data['listing_type']['equal'];

		}

		$found_listings_ids = $newArr;

		if(SJB_Notifications::sendUserNewListingsFoundLetter($found_listings_ids, $saved_search['user_sid'], $saved_search))

			SJB_DB::query('UPDATE `saved_searches` SET `last_send` = CURDATE() WHERE `sid` = ?n', $saved_search['sid']);

		$notified_saved_searches_sid[] = $saved_search['sid'];
	}
}



// NEWS

require_once 'news/NewsManager.php';
$expiredNews = SJB_NewsManager::getExpiredNews();
foreach ($expiredNews as $article) {
	SJB_NewsManager::deactivateItemBySID($article['sid']);
}


// LISTING XML IMPORT
require_once('listing_import/function.php');
runImport();


// ******************************* Activate pending jobs and invoice employers  
require_once ("users/User/UserManager.php");
require_once ("classifieds/Listing/ListingManager.php");
require_once("payment/Payment/PaymentManager.php");
require_once ("miscellaneous/Notifications.php");

require_once 'payment/OpenInvoice/OpenInvoice.php';
require_once 'payment/OpenInvoice/OpenInvoiceManager.php';

$todays_pending_payments_names = SJB_PaymentManager::getTodaysPendingPaymentsSID();
$Array_ids = array();

printf('2'.$todays_pending_payments_names);
echo json_encode($todays_pending_payments_names);

	$activated_listings_ids = array();

foreach ($todays_pending_payments_names as $pname) {
	$pname_start = substr($pname['name'], 0, 20);
echo '<p>4'.$pname_start.'</p>';
	if ($pname_start =='Payment for listing ') {
		$listing_id = substr($pname['name'], 23, 5);
		array_push($Array_ids, $listing_id);
		
		/*** 01 - 03-2018 ***/
		SJB_ListingManager::activateListingBySID($listing_id);
		$activated_listings_ids[$listing_id] = $listing_id;

//echo '<p>5'.json_encode($activated_listings_ids[$listing_id]).'</p>';
		// send invoice by email

		$payment_sid = $pname['sid'];
		$payment = SJB_PaymentManager::getObjectBySID($payment_sid);
		if (!empty($payment)) {
			$payment_info = SJB_PaymentManager::getPaymentInfoBySID($payment_sid);
			$user_info = SJB_UserManager::getUserInfoBySID($payment_info['user_sid']);

			$product_info = !empty($payment_info) ? unserialize($payment_info['product_info']) : array();
			$listings = array();
			if (isset($product_info['listing_id'])) {
				$listings[] = SJB_ListingManager::getListingInfoBySID($product_info['listing_id']);
			} elseif(isset($product_info['listings_ids'])) {
				$listing_ids = array_pop($product_info['listings_ids']);
				foreach($listing_ids as $listing_id) {
					$listings[] = SJB_ListingManager::getListingInfoBySID($listing_id);
				}
			}
		}
		$send_email = SJB_Notifications::sendEmployerListingInvoice($user_info, $listings, $payment_info);

		// set payment status "unpaid"
		$verifyPaymentJobAutoActivate = SJB_PaymentManager::verifyPaymentJobAutoActivate($payment_sid);


		//create "open invoice"
		$payment_info_auto_activate = SJB_PaymentManager::getPaymentInfoBySID($payment_sid);
		$currentUserInfo = SJB_UserManager::getCurrentUserInfo();
		$product_info_auto_activate = !empty($payment_info_auto_activate) ? unserialize($payment_info_auto_activate['product_info']) : array();
		$openInvoiceInfo = array(
				'amount'      => $payment_info['price'],
				'user_sid'    => $payment_info['user_sid'],
				'payment_sid' => $payment_sid,
				'is_opened'   => true
		);
		$openInvoice = new SJB_OpenInvoice($openInvoiceInfo);
		SJB_OpenInvoiceManager::saveOpenInvoice($openInvoice, $payment_sid);
	}

	else if ($pname_start =='Payment for listings') {
		$pnamelength = strlen($pname['name'])-23;
		$listing_id = substr($pname['name'], 23, $pnamelength);
		$listing_ids = explode (',', $listing_id);

		/// $mailSent_flag = false;
		$n = 0; $m = 0;

		foreach ($listing_ids as $listing_id) {
			$listing_in_payment = SJB_ListingManager::getObjectBySID($listing_id);
			if ($listing_in_payment->isDeleted()) {
				$deleted_listings_in_payment[$n] = $listing_id;
				$n++;
			}
			else {
				$existing_listings_in_payment[$m]= $listing_id;
				$m++;
			}
		}// end of Foreach

		if ($deleted_listings_in_payment) {
			// delete payment
			$payment_sid = $pname['sid'];
			SJB_PaymentManager::deletePaymentBySID($payment_sid);

			// create new payment for the rest listing(s)
			SJB_PaymentManager::createPaymentAfterListingExclude($existing_listings_in_payment);
		}

		// array_push($Array_ids, $listing_id);
		// activate all the existing listings in the payment
		foreach ($existing_listings_in_payment as $existing_listing_id) {
			SJB_ListingManager::activateListingBySID($existing_listing_id);
		}// end of Foreach

		// send invoice by email
		$payment_sid = $pname['sid'];
		$payment = SJB_PaymentManager::getObjectBySID($payment_sid);
		if (!empty($payment)) {
			$payment_info = SJB_PaymentManager::getPaymentInfoBySID($payment_sid);
			$user_info = SJB_UserManager::getUserInfoBySID($payment_info['user_sid']);

			$product_info = !empty($payment_info) ? unserialize($payment_info['product_info']) : array();
			$listings = array();
			if (isset($product_info['listing_id'])) {
				$listings[] = SJB_ListingManager::getListingInfoBySID($product_info['listing_id']);
			} elseif(isset($product_info['listings_ids'])) {
				$listing_ids = array_pop($product_info['listings_ids']);
				foreach($listing_ids as $listing_id) {
					$listings[] = SJB_ListingManager::getListingInfoBySID($listing_id);
				}
			}
		}
		$send_email = SJB_Notifications:: sendEmployerListingInvoice($user_info, $listings, $payment_info);

		// set payment status "unpaid"
		$verifyPaymentJobAutoActivate = SJB_PaymentManager::verifyPaymentJobAutoActivate($payment_sid);

		//create "open invoice"
		$payment_info_auto_activate = SJB_PaymentManager::getPaymentInfoBySID($payment_sid);
		$currentUserInfo = SJB_UserManager::getCurrentUserInfo();
		$product_info_auto_activate = !empty($payment_info_auto_activate) ? unserialize($payment_info_auto_activate['product_info']) : array();
		$openInvoiceInfo = array(
				'amount'      => $payment_info['price'],
				'user_sid'    => $payment_info['user_sid'],
				'payment_sid' => $payment_sid,
				'is_opened'   => true
		);
		$openInvoice = new SJB_OpenInvoice($openInvoiceInfo);
		SJB_OpenInvoiceManager::saveOpenInvoice($openInvoice, $payment_sid);
	}
}

//-------------------sitemap generator--------------------//
require_once("sitemap_generator.php");
require_once("system/user-scripts/users/sendnewsletter.php");
// CLEAR `error_log` TABLE
$errorLogLifetime = SJB_System::getSettingByName('error_log_lifetime');
$lifetime         = strtotime("-{$errorLogLifetime} days");
if ($lifetime > 0) {
	SJB_DB::query('DELETE FROM `error_log` WHERE `date` < ?t', $lifetime);
}



SJB_Settings::updateSetting('task_scheduler_last_executed_date', $current_date);
$template_processor->assign('expired_listings_id', $expired_listings_id);
$template_processor->assign('expired_contracts_id', $expired_contracts_id);
$template_processor->assign('notified_saved_searches_id', $notified_saved_searches_sid);
/***** 01-03-2018  ***/
$template_processor->assign('activated_listings_ids', $activated_listings_ids);
// echo '<p>6'.json_encode($activated_listings_ids).'</p>';
/******/

$scheduler_log = $template_processor->fetch('task_scheduler_log.tpl');



if ($log_file = @fopen('task_scheduler.log', 'a+')) {
	fwrite($log_file, $scheduler_log);
	fclose($log_file);	
}



SJB_DB::query('INSERT INTO `task_scheduler_log`
			(`last_executed_date`, `notifieds_sent`, `expired_listings`, `expired_contracts`, `activated_listings_ids`, `log_text`) 
			VALUES ( NOW(), ?n, ?n, ?n, ?n, ?s)',
			count($notified_saved_searches_sid), count($expired_listings_id), count($expired_contracts_id), count($activated_listings_ids), $scheduler_log );
/*
 * social sync
 * launch social resumes synchronization
 */
// SJB_System::executeFunction('social', 'linkedin');
SJB_System::executeFunction('social', 'facebook');
/*
 * end of "social sync"
 */

SJB_Event::dispatch('task_scheduler_run');
