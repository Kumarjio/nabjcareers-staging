<?php
require_once("users/Authorization.php");

$username = $_GET['username'];

$password = $_GET['password'];

$user_exists_by_username = SJB_DB::query("SELECT count(*) FROM `users` WHERE `username` = ?s", $username);
$user_exists_by_username = array_pop(array_pop($user_exists_by_username));
if ($user_exists_by_username) {
	$user_exists_by_password = SJB_DB::query("SELECT count(*) FROM `users` WHERE `username` = ?s AND `password` = ?s", $username, $password);
	$user_exists_by_password = array_pop(array_pop($user_exists_by_password));
	
	if ($user_exists_by_password){
		$user_info = SJB_UserManager::getUserInfoByUserName($username);
		
		if (!$user_info['active']) {
			echo '<br>'.$username.'<br><br><font color="red">Your account is not active</font>';
			exit;
		}else{
			exit;
		}
	}else
	{
		echo '<br><font color="red">Incorrect username or/and password</font>';
		exit;
	}

}else{
	echo '<br><font color="red">Incorrect username or/and password</font>';
	exit;
}


