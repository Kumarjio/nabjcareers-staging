<?php

require_once("ObjectMother.php");
require_once "users/Authorization.php";
require_once("miscellaneous/AdminNotifications.php");
require_once "forms/Form.php";

$tp = SJB_System::getTemplateProcessor();
$user_info = SJB_Authorization::getCurrentUserInfo();

if (!empty($user_info)) {
	$user_info = array_merge($user_info, $_REQUEST);

	$username = $user_info['username'];
	$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_info['user_group_sid']);
	$delete_profile = SJB_Request::getVar('action', '') == 'delete_profile';
	
	if ($delete_profile && SJB_Acl::getInstance()->isAllowed('delete_user_profile')) {
		$errors = array();
		
		if( !SJB_UserManager::deleteUserByUserName($username) ) {			
			$tp->assign('errors', $errors);
		}
		else {
			if (SJB_AdminNotifications::isAdminNotifiedOnDeletingUserProfile()) {
				SJB_AdminNotifications::sendAdminDeletingUserProfile($user_info);
			}
			// notify subadmins
			$subAdminsToNotify = SJB_AdminNotifications::isSubAdminNotifiedOnDeletingUserProfile();
			if (  is_array($subAdminsToNotify) && !empty($subAdminsToNotify))
				SJB_AdminNotifications::sendAdminDeletingUserProfile($user_info,$subAdminsToNotify);
			
			SJB_Authorization::logout();
			$user_info = array();
			SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL')."/edit-profile/?profile_deleted=true");
		}
	}
	
	$user = new SJB_User($user_info, $user_info['user_group_sid']);
	$user->setSID($user_info['sid']);

	$user->deleteProperty("active");
	$user->deleteProperty("featured");
	$user->makePropertyNotRequired("password");

	$edit_profile_form = new SJB_Form($user);
	$edit_profile_form->registerTags($tp);

	$edit_profile_form->makeDisabled("username");

	$form_submitted = (isset($_REQUEST['action']) && $_REQUEST['action'] == 'save_info');

	$errors = array();

	if ($form_submitted && $edit_profile_form->isDataValid($errors)) {
	    $password_value = $user->getPropertyValue('password');

		if (empty($password_value['original'])) {
			$user->deleteProperty('password');
		}

		SJB_UserManager::saveUser($user);
		SJB_Authorization::updateCurrentUserSession();

		$tp->assign("form_is_submitted", true);
	}
	else {
		$tp->assign("errors", $errors);
	}
	
	$form_fields = $edit_profile_form->getFormFieldsInfo();
	
	$metaDataProvider =& SJB_ObjectMother::getMetaDataProvider();
	$tp->assign(
		"METADATA",  
		array
		( 
			"form_fields" => $metaDataProvider->getFormFieldsMetadata("FormFieldCaptions", $form_fields), 
			"form_field" => array('caption' => array('domain' => 'FormFieldCaptions')),
		) 
	);
	
	$tp->assign("show_mailing_flag", $user_group_info['show_mailing_flag']);
	$tp->assign("form_fields", $form_fields);
	$tp->display('edit_profile.tpl');
}
else {
	$tp->assign("ERROR", "NOT_LOGIN");
	$tp->display("../miscellaneous/error.tpl");
	return;
}
