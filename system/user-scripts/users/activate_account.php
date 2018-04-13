<?php

require_once("users/User/UserManager.php");

$tp = SJB_System::getTemplateProcessor();

$info = array();
$errors = array();
$approv_status = '';
$approval_status = '';

if (SJB_Request::getVar('account_activated', '') == 'yes'){
	$info['ACCOUNT_ACTIVATED'] = 1;
	$approv_status = SJB_Request::getVar('approval_status', '');
} elseif (SJB_Request::getVar('approval_status', '') == 'Rejected') {
	$info['ACCOUNT_ACTIVATED'] = 0;
	$approv_status = 'Rejected';
} elseif ( !isset($_REQUEST['username'], $_REQUEST['activation_key']) ) {
	$errors['PARAMETERS_MISSED'] = 1;
} elseif ( !$user_info = SJB_UserManager::getUserInfoByUserName($_REQUEST['username']) ) {
	$errors['USER_NOT_FOUND'] = 1;
} elseif ($user_info['activation_key'] != $_REQUEST['activation_key']) {
	$errors['INVALID_ACTIVATION_KEY'] = true;
} elseif ( !isset($user_info['user_group_sid']) ) {
	$errors['PARAMETERS_MISSED'] = 1;
} elseif ($user_info['approval'] == 'Rejected') {
	SJB_UserDBManager::deleteActivationKeyByUsername($_REQUEST['username']);
	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL"). "/system/users/activate_account/?account_activated=not&approval_status=Rejected");
} else {
	$approval_status = (isset($user_info['approval']))? $user_info['approval'] : '';
	$user_activated = (isset($user_info['active']))? $user_info['active'] : false;
	
	$isApproveByAdmin = SJB_UserGroupManager::isApproveByAdmin($user_info['user_group_sid']);
	
	if ($isApproveByAdmin) {
		echo "approval_status: $approval_status<br>username: ".$_REQUEST['username']."<br>";
		SJB_HelperFunctions::dd($user_info);
		if ( ($approval_status == 'Pending') && $user_activated && (SJB_UserManager::setApprovalStatusByUserName($_REQUEST['username'], 'Approved')) ) {
			$add_param = 'Approved';
			SJB_Notifications::sendUserApprovedLetter($user_info['sid']);
			SJB_UserDBManager::deleteActivationKeyByUsername($_REQUEST['username']);
		}
		else if ( ($approval_status == 'Pending') && (SJB_UserManager::setApprovalStatusByUserName($_REQUEST['username'], 'Approved')) ) {
			$add_param = 'Pending';
			SJB_UserDBManager::deleteActivationKeyByUsername($_REQUEST['username']);
		}
		else if ( ($approval_status == 'Approved') && (SJB_UserManager::activateUserByUserName($_REQUEST['username'])) ) {
			$add_param = 'Approved';
			SJB_UserDBManager::deleteActivationKeyByUsername($_REQUEST['username']);
			SJB_Notifications::sendUserApprovedLetter($user_info['sid']);
		}
		else
			$errors['CANNOT_ACTIVATE'] = TRUE;
			
		if ( (!$errors['CANNOT_ACTIVATE']) && (!SJB_Authorization::isUserLoggedIn()) ) {
			SJB_Authorization::login($_REQUEST['username'], false, false, $errors, true);
			SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL"). "/system/users/activate_account/?account_activated=yes&approval_status=$add_param");
		}
		else if (!$errors['CANNOT_ACTIVATE']) {
			$approv_status = $add_param;
			$info['ACCOUNT_ACTIVATED'] = 1;
		}
	}
	elseif ( SJB_UserManager::activateUserByUserName($_REQUEST['username']) ) {	
		SJB_UserDBManager::deleteActivationKeyByUsername($_REQUEST['username']);
		$approv_status = 'Approved';
		if(!SJB_Authorization::isUserLoggedIn()) {
			SJB_Authorization::login($_REQUEST['username'], false, false, $errors, true);
			SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL"). "/system/users/activate_account/?account_activated=yes&approval_status=$approv_status");
		}
		$info['ACCOUNT_ACTIVATED'] = 1;
	}
	else
		$errors['CANNOT_ACTIVATE'] = TRUE;
	
}

$tp->assign("info", $info);
$tp->assign("errors", $errors);
$tp->assign("approval_status", $approv_status);
$tp->assign("is_login", SJB_Authorization::isUserLoggedIn());
$tp->display("activate_account.tpl");
