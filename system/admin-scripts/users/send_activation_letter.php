<?php

require_once("users/User/UserManager.php");
require_once("miscellaneous/Notifications.php");

$tp = SJB_System::getTemplateProcessor();

if ( isset( $_REQUEST['ajax'] ) ){
	$send = 0;
	$notsend = 0;
	
	if ( isset ($_REQUEST['userids']) ) {
		$ids = $_REQUEST['userids'];
		foreach ( $ids as $user_sid ){
			if ( $user_sid != '' && $user_sid != null ) {
				if ( SJB_Notifications::sendUserActivationLetter($user_sid) ) {
					$send++;
				} else {
					$notsend++;
				}
			}
		}
	}
	
	echo $send .' activation leter(s) successfull send<br>';
	echo $notsend .' activation leter(s) not send';
	exit;
}

$user_sid = SJB_Request::getVar('usersid', null);

$error = null;
if (!SJB_UserManager::getObjectBySID($user_sid)) {
	$error = "USER_DOES_NOT_EXIST";
} elseif(!SJB_Notifications::sendUserActivationLetter($user_sid)) {
	$error = "CANNOT_SEND_EMAIL";
}

$tp->assign("error", $error);
$tp->display("send_activation_letter.tpl");
