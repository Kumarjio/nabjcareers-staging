<?php

require_once('users/User/UserManager.php');
require_once('miscellaneous/UserNotifications.php');

$tp = SJB_System::getTemplateProcessor();
if (SJB_UserManager::isUserLoggedIn()) {
	
	$user_sid = SJB_UserManager::getCurrentUserSID();
	if (SJB_Request::getVar('action') === 'save') {
		$tp->assign('isSaved', true);
		SJB_UserNotifications::updateSettings($_REQUEST, $user_sid);
	}
	
	$listingTypes	= SJB_ListingTypeManager::getListingTypeByUserSID($user_sid);
	$approveSetting	= SJB_ListingTypeManager::getWaitApproveSettingByListingType($listingTypes);
	
	$notifications_settings = SJB_UserNotifications::getSettings($user_sid);
	
	$tp->assign('approve_setting', $approveSetting);
	$tp->assign('notifications_settings', $notifications_settings);
}
else {
	$error = 'USER_NOT_LOGGED_IN';
}

$tp->assign('error', isset($error) ? $error : null);
$tp->display('user_notifications.tpl');
