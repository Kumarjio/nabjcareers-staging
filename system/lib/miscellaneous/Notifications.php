<?php

require_once "Email.php";
require_once("users/User/UserManager.php");

class SJB_Notifications
{
	
	/**
	 * 
	 * @param SJB_User $user
	 * @param array $request
	 */
	public static function sendSubuserRegistrationLetter($user, $request)
	{
		$email = $request['email'];
		if (is_array($email))
			$email = array_pop($email);
			
		$email = new SJB_Email($email, '../email_templates/subuser_registration.tpl',
			array(	'request'		=> $request,
					'user'			=> $user));
		return $email->send();
	}

	/**
	 *
	 */
	public static function sendSubAdminRegistrationLetter($user, $request, $permissions)
	{
		$email = $request['email'];
		if (is_array($email))
			$email = array_pop($email);

		$email = new SJB_Email($email, '../email_templates/subadmin_registration.tpl',
			array(	'request'		=> $request,
					'user'			=> $user,
					'permissions'	=> $permissions,
					'admin_email'	=> SJB_Settings::getSettingByName('notification_email'),
			)
		);

		return $email->send( );
	}
	
	function sendUserActivationLetter($user_sid)
	{
		$user_info = SJB_UserManager::getUserInfoBySID($user_sid);
		$email = new SJB_Email($user_info['email'], '../email_templates/activation_email.tpl',
			array(	'user' => $user_info));
		return $email->send();
	}
	
	function sendUserApprovedLetter($user_sid)
	{
		$user_info = SJB_UserManager::getUserInfoBySID($user_sid);
		$email = new SJB_Email($user_info['email'], '../email_templates/user_approved_email.tpl',
			array(	'user' => $user_info));
		return $email->send();
	}
	
	function sendUserRejectedLetter($user_sid)
	{
		$user_info = SJB_UserManager::getUserInfoBySID($user_sid);
		$email = new SJB_Email($user_info['email'], '../email_templates/user_rejected_email.tpl',
			array(	'user' => $user_info));
		return $email->send();
	}
	
	function sendUserPasswordChangeLetter($user_sid)
	{
		$user_info = SJB_UserManager::getUserInfoBySID($user_sid);
		$email = new SJB_Email($user_info['email'], '../email_templates/password_change_email.tpl', array('user' => $user_info));
		return $email->send();
	}
	
	function sendUserListingExpiredLetter($user_sid, $listing_info)
	{
		$user_info = SJB_UserManager::getUserInfoBySID($user_sid);
		$email = new SJB_Email($user_info['email'], '../email_templates/listing_expired.tpl', array('user' => $user_info, 'listing' => $listing_info));
		return $email->send();
	}
	
	function sendUserContractExpiredLetter($userInfo, $contractInfo, $planInfo)
	{
		$email = new SJB_Email($userInfo['email'], '../email_templates/contract_expired.tpl',
			array(
				'user' => $userInfo,
				'plan' => $planInfo,
				'contract' => $contractInfo));
		return $email->send();
	}
	
	function sendUserListingActivatedLetter($listing, $user_sid)
	{
		$user_info = SJB_UserManager::getUserInfoBySID($user_sid);
		$email = new SJB_Email($user_info['email'], '../email_templates/listing_activation.tpl',
		array(
			'listing' => $listing,
			'user' => $user_info
		));
		return $email->send();
	}
	
	function sendUserListingApproveOrRejectLetter($listing_sid, $user_sid, $mode = 'approve')
	{
		$user_info = SJB_UserManager::getUserInfoBySID($user_sid);
		$listingInfo	= SJB_ListingManager::getListingInfoBySID($listing_sid);
		$listingTypeId	= SJB_ListingTypeManager::getListingTypeIDBySID($listingInfo['listing_type_sid']);
		$emailTemplate = 'listing_approved.tpl';
		if ($mode == 'reject')
			$emailTemplate = 'listing_rejected.tpl';
		$email = new SJB_Email($user_info['email'], '../email_templates/' . $emailTemplate,
		array(
			'user' => $user_info,
			'listing'	=> $listingInfo,
			'listingTypeId' => $listingTypeId,
		));

		return $email->send();
	}
	
	function sendUserNewListingsFoundLetter($listings_id, $user_sid, $saved_search_info)
	{
		$user_info = SJB_UserManager::getUserInfoBySID($user_sid);
		$email = new SJB_Email($user_info['email'], '../email_templates/new_listings_found.tpl', array('listings_id' => $listings_id, 'user' => $user_info, 'saved_search' => $saved_search_info));
		return $email->send();
	}
	
    function sendApplyNow($info, $file = '', $data_resume = array(), $current_user_sid = false, $notRegisterUserData = false, $score = false)
    {
    	if ($current_user_sid) {
    		$user_info = SJB_UserManager::getUserInfoBySID($current_user_sid);
    		$sender_email_address = $user_info['email'];
    	} else {
    		$sender_email_address = $notRegisterUserData['email'];
    	}
    	
    	$application_email = SJB_Applications::getApplicationEmailbyListingId($info['listing']['id']);
		$email_address = !empty($application_email) ? $application_email : $info['listing']['user']['email'];
		$questionnaire = !empty($info['submitted_data']['questionnaire'])?unserialize($info['submitted_data']['questionnaire']):'';
		$questionnaireInfo = array();
		if ($questionnaire) {
			require_once 'applications/ScreeningQuestionnaires.php';
			$listingInfo = SJB_ListingManager::getListingInfoBySID($info['listing']['id']);
			$questSID = isset($listingInfo['screening_questionnaire'])?$listingInfo['screening_questionnaire']:0;
			$questionnaireInfo = SJB_ScreeningQuestionnaires::getInfoBySID($questSID);
			$passing_score = 0;
				switch ($questionnaireInfo['passing_score']) {
					case 'acceptable':
						$passing_score = 1;
						break;
					case 'good':
						$passing_score = 2;
						break;
					case 'very_good':
						$passing_score = 3;
						break;
					case 'excellent':
						$passing_score = 4;
						break;
				}
				if ($score >= $passing_score)
					$questionnaireInfo['passing_score'] = 'Passed';
				else 	
					$questionnaireInfo['passing_score'] = 'Not passed';
		}

		if (!empty($info['listing']['subuser']['sid'])) {
			$subuserInfo = SJB_UserManager::getUserInfoBySID($info['listing']['subuser']['sid']);
			if (!empty($subuserInfo)) {
				$email_address = $subuserInfo['email'];
			}
		}
		$email = new SJB_Email( $email_address, '../email_templates/apply_now.tpl',
								array('listing' => $info['listing'], 'seller_request'=>$info['submitted_data'], 'data_resume' => $data_resume, 'questionnaire'=>$questionnaire, 'score'=>$score, 'questionnaireInfo'=>$questionnaireInfo) );
		$email->setReplyTo($sender_email_address);
		if ($file != '')
			$email->setFile($file);

		return $email->send();
	}

    function sendContactSellerLetter($info)
    {
		$email_address = $info['listing']['user']['email'];
		$sender_email_address = $info['submitted_data']['email'];
		$email = new SJB_Email( $email_address, '../email_templates/contact_seller.tpl',
								array('listing' => $info['listing'], 'seller_request'=>$info['submitted_data']) );
		
		$email->setReplyTo($sender_email_address);
		return $email->send();
	}


    function sendTellFriendLetter($info)
    {
		$email_address = $info['submitted_data']['friend_email'];
		$email = new SJB_Email( $email_address, '../email_templates/tell_friend.tpl',
								array('listing' => $info['listing'], 'submitted_data' => $info['submitted_data']));
		return $email->send();
	}
	
	function sendNewPrivateMessageLetter($user_id, $sender_id, $message, $cc = false)
	{
	    $user_info = SJB_UserManager::getUserInfoBySID($user_id);
		$sender_info = SJB_UserManager::getUserInfoBySID($sender_id);
		$email = new SJB_Email( $user_info['email'], '../email_templates/new_private_message.tpl',
		    array('target' => $user_info, 'sender'=>$sender_info, 'message'=>$message) );
		if (!empty($cc)) {
			$cc = SJB_UserManager::getUserInfoBySID($cc);
			if (!empty($cc)) {
				$email->addCC($cc['email']);
			}
		}

		return $email->send();
	}

    public static function sendSubscriptionActivationLetter($userSID, $membershipPlanInfo, $reactivation = false)
	{
		$user_info = SJB_UserManager::getUserInfoBySID($userSID);

		$email = new SJB_Email( $user_info['email'], '../email_templates/subscription_activation_letter.tpl',
		    array(
		    	'user' => $user_info,
		    	'membershipPlanInfo' => $membershipPlanInfo,
		    	'reactivation' => $reactivation)
		     );
		return $email->send();
	}

	function sendRemindSubscriptionExpirationLetter($userSID, $contractInfo, $days)
	{
		$user_info   = SJB_UserManager::getUserInfoBySID($userSID);
		
		$email       = new SJB_Email( $user_info['email'], '../email_templates/remind_expiration_letter.tpl',
		    array('type'=>'contract', 'user' => $user_info, 'contractInfo'=>$contractInfo, 'days'=>$days) );
		return $email->send();
	}
	
	function sendRemindListingExpirationLetter($userSID, $listingInfo, $days)
	{
		$user_info   = SJB_UserManager::getUserInfoBySID($userSID);
		
		$email       = new SJB_Email( $user_info['email'], '../email_templates/remind_expiration_letter.tpl',
		    array('type'=>'listing', 'user' => $user_info, 'listingInfo'=>$listingInfo, 'days'=>$days) );
		return $email->send();
	}
	
	function userAutoReply($listing_info, $user_sid, $questionnaire, $notRegisteredUserData = array())
    {
		$user_info   = SJB_UserManager::getUserInfoBySID($user_sid);
		if (empty($user_info)) {
			$user_info = $notRegisteredUserData;
		}
		$email       = new SJB_Email( $user_info['email'], '../email_templates/user_auto_reply.tpl',
		    array('user' => $user_info, 'listingInfo'=>$listing_info, 'text'=>$questionnaire) );
		return $email->send();
	}

	function sendInvoice($user_info, $listings, $payment_info)
	{
		$email = new SJB_Email( $user_info['billingEmail'], '../email_templates/print_invoice.tpl',
			array('user_info' => $user_info, 'listings'=>$listings, 'payment_info'=>$payment_info) );
		$email->addCC(SJB_Settings::getSettingByName('system_email'));
		return $email->send();
}



/***** 26-12-2015 mod activate listings and invoice empl ******/
function sendEmployerListingInvoice($user_info, $listings, $payment_info)
{
	$email = new SJB_Email( $user_info['billingEmail'], '../payment/listing_activate_and_invoice.tpl',
			array('user_info' => $user_info, 'listings'=>$listings, 'payment_info'=>$payment_info) );
		$email->addCC(SJB_Settings::getSettingByName('system_email'));
	return $email->send();
}
/****** end *********/






}
