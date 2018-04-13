<?php


require_once("users/UserGroup/UserGroupManager.php");

$user_group_sid = isset($_REQUEST['sid']) ? $_REQUEST['sid'] : null;

if (!is_null($user_group_sid)) {
	
	SJB_UserGroupManager::deleteUserGroupBySID($user_group_sid);
	
	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/user-groups/");
	
} else {
	
	echo 'The system  cannot proceed as User Group SID is not set';
	
}

