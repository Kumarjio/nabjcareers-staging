<?php


require_once("users/User/UserManager.php");

$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : null;

if (!is_null($username)) {

	SJB_UserManager::activateUserByUserName($username);
	
	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/users/");
	
} else {
	
	echo 'The system  cannot proceed as Username is not set';
	
}

