<?php

require_once("ObjectMother.php");
require_once "users/Authorization.php";
require_once("users/User/UserManager.php");

$tp = SJB_System::getTemplateProcessor();
$error = null;
//if (SJB_UserManager::isUserLoggedIn()) {

	$user_id_encoded = $_REQUEST['param'];
	$user_id = 	base64_decode($user_id_encoded);
	SJB_DB::query("update users set sendmail=0 where sid='".$user_id."'");

//	echo ($user_id);

//	$current_user = SJB_UserManager::getCurrentUser();
//	SJB_DB::query("update users set sendmail=0 where sid='". $current_user->getID() ."'");
	$tp->display('unsubscribe.tpl');
//} else {
	
	//$tp->assign('error', 'NOT_LOGGED_IN');
	//$tp->display('add_listing_error.tpl');
//}