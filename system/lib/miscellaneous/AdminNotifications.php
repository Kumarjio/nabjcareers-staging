<?php

require_once 'Email.php';
require_once 'sub_admins/SubAdminManager.php';

class SJB_AdminNotifications
{
	function isAdminNotifiedOnListingAdded()
	{
		return SJB_Settings::getSettingByName('notify_on_listing_added');
	}

	function isSubAdminNotifiedOnListingAdded()
	{
		return SJB_SubAdminManager::getIfSubAdminsNotifiedOn('get_notifications_on_listing_added');
	}

	function isAdminNotifiedOnDeletingUserProfile()
	{
		return SJB_Settings::getSettingByName('notify_admin_on_deleting_user_profile');
	}

	function isSubAdminNotifiedOnDeletingUserProfile()
	{
		return SJB_SubAdminManager::getIfSubAdminsNotifiedOn('get_notifications_on_deleting_user_profile');
	}
	
	function sendAdminListingAddedLetter($listingSid, $listingTypeId, $aSubAdminEmails = null)
	{
		$template = '../email_templates/admin_add_listing_email.tpl';
		$params = array(
			'listing_sid' => $listingSid,
			'listingTypeId' => $listingTypeId,
			'listingInfo' => SJB_ListingManager::getListingInfoBySID($listingSid));
		
		if (empty($aSubAdminEmails)) {
			$admin_email = SJB_Settings::getSettingByName('notification_email');
			$email = new SJB_Email($admin_email, $template , $params);
			return $email->send();
		}
		SJB_AdminNotifications::sendSubAdminNotificationLetter( $aSubAdminEmails, $template, $params);
	}
	
	function sendSubAdminNotificationLetter($emails, $template, $params)
	{
		if (is_array($emails) && $template && $params) {
			foreach ( $emails as $admin_email) {
				$email = new SJB_Email($admin_email, $template, $params);
				$email->send();
			}
		}
	}
	
	function sendAdminDeletingUserProfile($user_info, $aSubAdminEmails = null)
	{
		$template = '../email_templates/admin_delete_user_profile.tpl';
		$params = array('user_info' => $user_info);

		if  (empty($aSubAdminEmails)) {
			$admin_email = SJB_Settings::getSettingByName('notification_email');
			$email = new SJB_Email($admin_email, $template , $params);
			return $email->send();
		}
		SJB_AdminNotifications::sendSubAdminNotificationLetter( $aSubAdminEmails, $template, $params);
	}
	
	function isAdminNotifiedOnUserRegistration()
	{
		return SJB_Settings::getSettingByName('notify_on_user_registration');
	}

	function isSubAdminNotifiedOnUserRegistration()
	{
		return SJB_SubAdminManager::getIfSubAdminsNotifiedOn('get_notifications_on_user_registration');
	}
	
	function sendAdminUserRegistrationLetter($user_id, $aSubAdminEmails = null)
	{
	  	$userInfo = SJB_UserManager::getUserInfoBySID($user_id);
	  	$userInfo['user_group_name'] = SJB_UserGroupManager::getUserGroupNameBySID($userInfo['user_group_sid']);
	  	
	  	$otherInfo = $userInfo;
	  	unset($otherInfo['sid']);
	  	unset($otherInfo['registration_date']);
	  	unset($otherInfo['password']);
	  	unset($otherInfo['sendmail']);
	  	unset($otherInfo['user_group_sid']);
	  	unset($otherInfo['activation_key']);
	  	unset($otherInfo['verification_key']);
	  	unset($otherInfo['active']);
	  	unset($otherInfo['featured']);
	  	unset($otherInfo['ip']);
	  	unset($otherInfo['parent_sid']);
	  	unset($otherInfo['user_group_name']);
		unset($otherInfo['video']);
		unset($otherInfo['Logo']);
		unset($otherInfo['language']);

		$template = '../email_templates/admin_user_registration_email.tpl';
		$params = array('user' => $userInfo, 'otherInfo' => $otherInfo);
		
		if (empty($aSubAdminEmails)) {
			$admin_email = SJB_Settings::getSettingByName('notification_email');
			$email = new SJB_Email($admin_email, $template , $params);
			return $email->send();
		}
		SJB_AdminNotifications::sendSubAdminNotificationLetter( $aSubAdminEmails, $template, $params);
	}
	
	function isAdminNotifiedOnListingExpiration()
	{
		return SJB_Settings::getSettingByName('notify_on_listing_expiration');
	}

	function isSubAdminNotifiedOnListingExpiration()
	{
		return SJB_SubAdminManager::getIfSubAdminsNotifiedOn('get_notifications_on_listing_expiration');
	}
	
	function isAdminNotifiedOnListingFlagged()
	{
		return SJB_Settings::getSettingByName('notify_admin_on_listing_flagged');
	}

	function isSubAdminNotifiedOnListingFlagged()
	{
		return SJB_SubAdminManager::getIfSubAdminsNotifiedOn('get_notifications_on_listing_flagged');
	}
	
	function sendAdminListingExpiredLetter($listing_info, $aSubAdminEmails = null)
	{
		$template = '../email_templates/admin_listing_expired.tpl';
		$params = array('listing' => $listing_info);

		if (empty($aSubAdminEmails)) {
			$admin_email = SJB_Settings::getSettingByName('notification_email');
			$email = new SJB_Email($admin_email, $template , $params);
			return $email->send();
		}
		SJB_AdminNotifications::sendSubAdminNotificationLetter($aSubAdminEmails, $template, $params);
	}
	
	function isAdminNotifiedOnUserContractExpiration()
	{
		return SJB_Settings::getSettingByName('notify_on_user_contract_expiration');
	}

	function isSubAdminNotifiedOnUserContractExpiration()
	{
		return SJB_SubAdminManager::getIfSubAdminsNotifiedOn('get_notifications_on_user_subscription_expiration');
	}
	
	function sendAdminUserContractExpiredLetter($userInfo, $contractInfo, $planInfo, $aSubAdminEmails = null)
	{
		$template = '../email_templates/admin_user_contract_expired.tpl';
		$params = array(
			'user' => $userInfo,
			'contract' => $contractInfo,
			'plan' => $planInfo);

		if (empty($aSubAdminEmails)) {
			$admin_email = SJB_Settings::getSettingByName('notification_email');
			$email = new SJB_Email($admin_email, $template , $params);
			return $email->send();
		}
		SJB_AdminNotifications::sendSubAdminNotificationLetter( $aSubAdminEmails, $template, $params);
	}
	
	function sendContactFormMessage($name, $email, $comments)
	{
		$contact_form_email = SJB_Settings::getSettingByName('notification_email');
		$parameters = array('name' => $name, 'email' => $email, 'comments' => $comments);
		$message = new SJB_Email($contact_form_email, '../email_templates/admin_contact_form_message.tpl', $parameters);
		$message->setReplyTo($email);
		return $message->send();
	}
	
	function sendAdminListingFlaggedLetter($listingInfo, $aSubAdminEmails = null)
	{
		$template = '../email_templates/admin_listing_flagged.tpl';
		$params = array('listing' => $listingInfo);
		
		if (empty($aSubAdminEmails)) {
			$admin_email = SJB_Settings::getSettingByName('notification_email');
			$email = new SJB_Email($admin_email, $template , $params);
			return $email->send();
		}
		SJB_AdminNotifications::sendSubAdminNotificationLetter( $aSubAdminEmails, $template, $params);
	}
}

