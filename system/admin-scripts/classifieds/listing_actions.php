<?php

require_once('classifieds/Listing/ListingManager.php');
require_once('miscellaneous/Notifications.php');
require_once('miscellaneous/UserNotifications.php');

$restore = 'restore=';

if (isset($_REQUEST['action_name'], $_REQUEST['listings']))
{
	$listings_ids = $_REQUEST['listings'];

	switch ( strtolower($_REQUEST['action_name']) ) {
		case 'activate':
			foreach ($listings_ids as $listing_id => $value) {
				SJB_ListingManager::activateListingBySID($listing_id);
				$listing = SJB_ListingManager::getObjectBySID($listing_id);
				if (SJB_UserNotifications::isUserNotifiedOnListingActivation($listing->getUserSID())) {
					SJB_Notifications::sendUserListingActivatedLetter(SJB_ListingManager::createTemplateStructureForListing($listing), $listing->getUserSID());
				}
			}
			break;

		case 'deactivate':
			foreach ($listings_ids as $listing_id => $value) {
				SJB_ListingManager::deactivateListingBySID($listing_id);
			}
			break;

		case 'delete':
			foreach ($listings_ids as $listing_id => $value) {
				SJB_ListingManager::deleteListingBySID($listing_id);
			}
			break;

		case 'datemodify':
			if ( isset($_REQUEST['days_to_change']) ) {
				$daysToChange = $_REQUEST['days_to_change'];
				foreach ($listings_ids as $listing_id => $value) {
					$listingInfo = SJB_ListingManager::getListingInfoBySID($listing_id);
					$listingExpiredDate = $listingInfo['expiration_date'];
					$daysToChange 		= trim( $daysToChange );
					// проверим знак числа и по результатам уменьшаем или добавляем дату
					$days = abs($daysToChange);
					$result = ($days == $daysToChange);
					if ($result) 
						$expired_date	= date('Y-m-d H:i:s', strtotime($listingExpiredDate . " + {$days} day"));
					else
						$expired_date	= date('Y-m-d H:i:s', strtotime($listingExpiredDate . " - {$days} day"));
						
					$result = SJB_DB::query('UPDATE `listings` SET `expiration_date` = \'?w\' WHERE `sid` = ?n', $expired_date, $listingInfo['sid']);
				}
			}
			break;
			
		case 'approve':
			foreach ($listings_ids as $listing_id => $value) {
				SJB_ListingManager::setListingApprovalStatus($listing_id, 'approved');
				$user_sid = SJB_ListingManager::getUserSIDByListingSID($listing_id);
				if ( SJB_UserNotifications::isUserNotifiedOnListingApproveOrReject($user_sid) ) {
					SJB_Notifications::sendUserListingApproveOrRejectLetter($listing_id, $user_sid, 'approve');
				}
			}
			break;

		case 'reject':
			foreach ($listings_ids as $listing_id => $value) {
				$res = SJB_ListingManager::setListingApprovalStatus($listing_id, 'rejected');
				$user_sid = SJB_ListingManager::getUserSIDByListingSID($listing_id);
				if (SJB_UserNotifications::isUserNotifiedOnListingApproveOrReject($user_sid))
					SJB_Notifications::sendUserListingApproveOrRejectLetter($listing_id, $user_sid, 'reject');
			}
			break;

		default:
			$restore = '';
			break;		
	}
}

SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/manage-listings/?action=search&' . $restore);