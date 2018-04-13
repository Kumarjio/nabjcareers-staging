<?php

require_once 'users/User/UserManager.php';
require_once 'users/Authorization.php';
require_once 'private_message/private_message.php';

$current_user_info = array('logged_in' => false);

if (SJB_UserManager::isUserLoggedIn()) {
	SJB_Authorization::updateCurrentUserSession();
	$current_user_info = SJB_UserManager::createTemplateStructureForCurrentUser();
	$current_user_info['logged_in'] = true;
	$current_user_info['new_messages'] = SJB_PrivateMessage::getCountUnreadMessages($current_user_info['id']);
} 
/*
 * social plugin
 */
elseif (class_exists ('SJB_SocialPlugin') && SJB_SocialPlugin::getProfileObject())
{
	SJB_Event::dispatch('Login_Plugin');
}
/*
 * end of "social plugin"
 */

SJB_System::setCurrentUserInfo($current_user_info);
