<?php

require_once("ObjectMother.php");
require_once("users/User/UserManager.php");
require_once("users/UserGroup/UserGroupManager.php");
require_once("membership_plan/MembershipPlan.php");
require_once("membership_plan/MembershipPlanManager.php");
require_once("membership_plan/Contract.php");
require_once("miscellaneous/Notifications.php");
require_once("miscellaneous/UserNotifications.php");

$tp = SJB_System::getTemplateProcessor();
$tp->assign("terms_of_use_check", SJB_System::getSettingByName("terms_of_use_check"));

$user_group_id = SJB_Request::getVar('user_group_id', null);

if (isset($_POST["password"])) {
	$passwords= $_POST["password"];
	
	echo '<script type="text/javascript">var xtemp= "'.$passwords['original']. '";var ytemp= "'.$passwords['confirmed']. '";
	$("document").ready(function() {
	$("input[name=password\\[original\\]]").val(xtemp);
	$("input[name=password\\[confirmed\\]]").val(ytemp);
	})
	</script>';
}

if (!is_null($user_group_id)) {
	$user_group_sid  = SJB_UserGroupManager::getUserGroupSIDByID($user_group_id);
	$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid);

	$user = SJB_ObjectMother::createUser($_REQUEST, $user_group_sid);

        /*
         * ajax username and email checking
         */
        if ( SJB_Request::isAjax() || 'true' == SJB_Request::getVar( 'isajaxrequest' ) )
        {
            $field = SJB_Request::getVar( 'type' );
            if ( 'email' == $field )
            {
                $user->getProperty($field)->type->disableEmailConfirmation();
            }
            echo $user->getProperty( $field )->isValid();
            exit;            
        }   //         if ( SJB_Request::isAjax() || 'true' == SJB_Request::getVar( 'isajaxrequest' ) )

	$user->deleteProperty("active");
	$user->deleteProperty("featured");
	
	$form_submitted = SJB_Request::getVar('action', false) == 'register';
	
	$registration_form = SJB_ObjectMother::createForm($user);
	$registration_form->registerTags($tp);

	if (SJB_UserGroupManager::isUserEmailAsUsernameInUserGroup($user_group_sid) && $form_submitted ) {
		$email = $user->getPropertyValue('email');
		if (is_array($email))
			$email = $email['original'];
		$user->setPropertyValue('username', $email);
	}

	$errors = array();

	if ($form_submitted && $registration_form->isDataValid($errors))
        {
		$user->deleteProperty("captcha");
		$defaultPlan = SJB_UserGroupManager::getDefaultPlan($user_group_sid);
		SJB_UserManager::saveUser($user);

		$available_membership_plan_ids = SJB_MembershipPlanManager::getPlansIDByGroupSID($user_group_sid);
		
		if ($defaultPlan && in_array($defaultPlan, $available_membership_plan_ids)) {
			$membership_plan = new SJB_MembershipPlan(array('id' => $defaultPlan));
			//price is not required for default membership plan
			//if ($membership_plan->getPrice() == 0) {
				$contract = new SJB_Contract(array('membership_plan_id' => $defaultPlan));
				$contract->setUserSID($user->getSID());
				$contract->saveInDB();
			//}
		}
		// notifying administrator
		
		require_once("miscellaneous/AdminNotifications.php");
		
        if (SJB_AdminNotifications::isAdminNotifiedOnUserRegistration()) {
			SJB_AdminNotifications::sendAdminUserRegistrationLetter($user->getSID());
	  	}
		// notify subadmins
		$subAdminsToNotify = SJB_AdminNotifications::isSubAdminNotifiedOnUserRegistration();
		if ( is_array($subAdminsToNotify) && !empty($subAdminsToNotify))
			SJB_AdminNotifications::sendAdminUserRegistrationLetter($user->getSID(),$subAdminsToNotify);
	  
		// add defoult user notification
		$userNotifications = SJB_UserGroupManager::getDefaultNotificationByGroupSID($user_group_sid);

		if ($userNotifications) {
			SJB_UserNotifications::updateSettings($userNotifications, $user->getSID());
		}
		
		// Activation
		$isSendActivationEmail 	= SJB_UserGroupManager::isSendActivationEmail($user_group_sid);
		$isApproveByAdmin 		= SJB_UserGroupManager::isApproveByAdmin($user_group_sid);
		if ($isSendActivationEmail) {
			$isSended = SJB_Notifications::sendUserActivationLetter($user->getSID());
			if ($isSended) {
				$tp->display("registration_confirm.tpl");
			} else {
				$tp->display("registration_failed_to_send_activation_email.tpl");
			}			
		}
		else if ((!$isSendActivationEmail) && $isApproveByAdmin) {
			SJB_UserManager::setApprovalStatusByUserName($user->getUserName(), 'Pending');
			$tp->display("registration_pending.tpl");			
		}
		else {
			SJB_UserManager::activateUserByUserName($user->getUserName());
			
			$errors = array();
			SJB_Authorization::login($user->getUserName(), $_REQUEST['password']['original'], false, $errors);
			SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL"). "/my-account/");
			$tp->display("registration_success.tpl");
		}
	}
	else
        {
		if (SJB_UserGroupManager::isUserEmailAsUsernameInUserGroup($user_group_sid))
			$user->deleteProperty("username");
		$registration_form = SJB_ObjectMother::createForm($user);
		if ($form_submitted)
			$registration_form->isDataValid($errors);
		$registration_form->registerTags($tp);
		$registration_form_template = "registration_form.tpl";
		
		if (isset($_REQUEST['reg_form_template'])) {
			$registration_form_template = $_REQUEST['reg_form_template'];
		}
		elseif (!empty($user_group_info['reg_form_template'])) {
			$registration_form_template = $user_group_info['reg_form_template'];
		}
		
		$form_fields = $registration_form->getFormFieldsInfo();

                /*
                 * define default template with ajax checking
                 */
                $registration_form->setDefaultTemplateByFieldName( 'email', 'email_ajaxchecking.tpl' );
                $registration_form->setDefaultTemplateByFieldName( 'username', 'unique_string.tpl' );

		$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid);
		
		$tp->assign("user_group_info", $user_group_info);
		$tp->assign("errors", $errors);
		$tp->assign("form_fields", $form_fields);
		
		$metaDataProvider =& SJB_ObjectMother::getMetaDataProvider();
		$tp->assign
		(
			"METADATA",  
			array
			( 
				"form_fields" => $metaDataProvider->getFormFieldsMetadata("FormFieldCaptions", $form_fields), 
				"form_field" => array('caption' => array('domain' => 'FormFieldCaptions')),
			) 
		);

		$tp->display($registration_form_template);
	}
}
else {
	$user_groups_info = SJB_UserGroupManager::getAllUserGroupsInfo();
	
	$tp->assign("user_groups_info", $user_groups_info);
	$tp->assign("METADATA",	array("user_group_info" => array('name' => array('domain' => 'Miscellaneous'))));

	$tp->display("registration_choose_user_group.tpl");
}

