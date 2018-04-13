<?php

require_once("ObjectMother.php");
require_once("users/User/UserManager.php");
require_once("users/UserGroup/UserGroupManager.php");
require_once("membership_plan/MembershipPlan.php");
require_once("membership_plan/MembershipPlanManager.php");
require_once("membership_plan/Contract.php");
require_once("miscellaneous/Notifications.php");
require_once("miscellaneous/UserNotifications.php");

$template_processor = SJB_System::getTemplateProcessor();

$template_processor->assign("terms_of_use_check", SJB_System::getSettingByName("terms_of_use_check"));

$user_group_id = isset($_REQUEST['user_group_id']) ? $_REQUEST['user_group_id'] : null;

$form_submitted = (isset($_REQUEST['action']) && $_REQUEST['action'] == 'register');



if (!is_null($user_group_id))
{
	$user_group_sid = SJB_UserGroupManager::getUserGroupSIDByID($user_group_id);
	
	/**
	 * check if registration is allowed for this UserGroup
	 */
	if (!SJB_SocialPlugin::ifRegistrationIsAllowedByUserGroupSID($user_group_sid))
	{
		return null;
	}
	
	$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid);

	$user = &SJB_ObjectMother::createUser($_REQUEST, $user_group_sid);
	$user->deleteProperty("active");
	$user->deleteProperty("featured");

	$errors = array();

	/**
	 * social plugin
	 */
	if ($form_submitted)
	{
		SJB_Event::dispatch('SocialPlugin_AddListingFieldsIntoRegistration', $user, true);
		SJB_Event::dispatch('MakeRegistrationFieldsNotRequired_SocialPlugin', $user, true);
	}
	else
	{
		SJB_Event::dispatch('PrepareRegistrationFields_SocialPlugin', $user, true);
		SJB_Event::dispatch('SocialPlugin_AddListingFieldsIntoRegistration', $user, true);
		SJB_Event::dispatch('FillRegistrationData_Plugin', $user, true);
	}
	/*
	 * end "social plugin"
	 */

	$registration_form = &SJB_ObjectMother::createForm($user);
	$registration_form->registerTags($template_processor);

	if ($form_submitted && $registration_form->isDataValid($errors))
	{
		/**
		 * social plugin
		 */
		SJB_Event::dispatch('FillRegistrationData_Plugin', $user, true);
		SJB_Event::dispatch('AddReferencePluginDetails', $user, true);
		/*
		 * end "social plugin"
		 */

//		$available_membership_plan_ids = SJB_MembershipPlanManager::getPlansIDByGroupSID($user_group_sid);
//
//		if (count($available_membership_plan_ids) == 1)
//		{
//			$membership_plan_id = array_pop($available_membership_plan_ids);
//
//			$membership_plan = new SJB_MembershipPlan(array('id' => $membership_plan_id));
//
//			if ($membership_plan->getPrice() == 0)
//			{
//				$contract = new SJB_Contract(array('membership_plan_id' => $membership_plan_id));
//
//				if ($contract->saveInDB())
//				{
//					$user->setContractID($contract->id);
//				}
//			}
//		}

		$user->deleteProperty("captcha");

		SJB_UserManager::saveUser($user);
		
		/**
		 * subscribe user on default membership plan
		 */
		$defaultPlan = SJB_UserGroupManager::getDefaultPlan($user_group_sid);
		$available_membership_plan_ids = SJB_MembershipPlanManager::getPlansIDByGroupSID($user_group_sid);

		if ($defaultPlan && in_array($defaultPlan, $available_membership_plan_ids))
		{
//			$membership_plan = new SJB_MembershipPlan(array('id' => $defaultPlan));
			//price is not required for default membership plan
			//if ($membership_plan->getPrice() == 0) {
			$contract = new SJB_Contract(array('membership_plan_id' => $defaultPlan));
			$contract->setUserSID($user->getSID());
			$contract->saveInDB();
			//}
		}

		/**
		 * social plugin
		 */
		SJB_SocialPlugin::sendUserSocialRegistrationLetter($user);
//		$listingSID = SJB_SocialPlugin::createListing($user);
		/*
		 * end "social plugin"
		 */

		// notifying administrator
		require_once("miscellaneous/AdminNotifications.php");
		if (SJB_AdminNotifications::isAdminNotifiedOnUserRegistration())
		{
			SJB_AdminNotifications::sendAdminUserRegistrationLetter($user->getSID());
		}


		// add defoult user notification
		$userNotifications = SJB_UserGroupManager::getDefaultNotificationByGroupSID($user_group_sid);
		$userNotifications['notify_subscription_activation'] = '1';

		if ($userNotifications)
		{
			SJB_UserNotifications::updateSettings($userNotifications, $user->getSID());
		}


		SJB_UserManager::activateUserByUserName($user->getUserName());

		$errors = array();
		SJB_Authorization::login($user->getUserName(), $user->getPropertyValue('password'), false, $errors, false);

//		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL"). "/post-registration/");

		/*
		 * save access token, profile info
		 * for synchronization
		 */
		SJB_SocialPlugin::postRegistration();

		if (!empty($listingSID))
		{
			$template_processor->assign('listingID', $listingSID);
		}
		$template_processor->assign('socialNetwork', SJB_SocialPlugin::getNetwork());
		$template_processor->display("registration_success_social.tpl");
	}
	else
	{

		/**
		 * social plugin
		 */
		SJB_Event::dispatch('PrepareRegistrationFields_SocialPlugin', $user, true);
//		SJB_Event::dispatch('FillRegistrationDataReqest_Plugin', , true);
		/*
		 * end "social plugin"
		 */

		if (SJB_UserGroupManager::isUserEmailAsUsernameInUserGroup($user_group_sid))
			$user->deleteProperty("username");
		$registration_form = &SJB_ObjectMother::createForm($user);
		if ($form_submitted)
			$registration_form->isDataValid($errors);
		$registration_form->registerTags($template_processor);
		$registration_form_template = "../users/registration_form.tpl";

		if (isset($_REQUEST['reg_form_template']))
		{
			$registration_form_template = $_REQUEST['reg_form_template'];
		}
		elseif (!empty($user_group_info['reg_form_template']))
		{
			$registration_form_template = $user_group_info['reg_form_template'];
		}

		$form_fields = $registration_form->getFormFieldsInfo();
		$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid);

		$template_processor->assign("user_group_info", $user_group_info);
		$template_processor->assign("errors", $errors);
		$template_processor->assign("user_group_id", $user_group_id);
		$template_processor->assign("form_fields", $form_fields);

		$metaDataProvider = & SJB_ObjectMother::getMetaDataProvider();
		$template_processor->assign('METADATA', array(
				'form_fields' => $metaDataProvider->getFormFieldsMetadata('FormFieldCaptions', $form_fields),
				'form_field' => array('caption' => array('domain' => 'FormFieldCaptions')),
			)
		);
		$template_processor->assign('socialRegistration', true);
		$template_processor->display($registration_form_template);
	}
}
else
{
	$userGroupsSIDs = SJB_SocialPlugin::getResolvedUserGroupsByNetwork();
	$user_groups_info = array();

	foreach ($userGroupsSIDs as $groupSID)
	{
		array_push($user_groups_info, SJB_UserGroupManager::getUserGroupInfoBySID($groupSID));
	}

	/*
	 * if there is only one group available for registration 
	 * redirect user directly on Registration Fields page
	 */
	if (count($user_groups_info) === 1 && !empty($user_groups_info[0]['id']))
	{
		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL'). '/registration-social/?user_group_id=' . $user_groups_info[0]['id']);
	}

	$template_processor->assign("user_groups_info", $user_groups_info);
	$template_processor->assign("METADATA", array("user_group_info" => array('name' => array('domain' => 'Miscellaneous'))));

	$template_processor->display("registration_choose_user_group_social.tpl");
}

