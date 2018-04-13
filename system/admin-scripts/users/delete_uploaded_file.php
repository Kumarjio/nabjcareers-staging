<?php


require_once("users/User/UserManager.php");

require_once("miscellaneous/UploadFileManager.php");

$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : null;

$field_id = isset($_REQUEST['field_id']) ? $_REQUEST['field_id'] : null;

$user_info = SJB_UserManager::getUserInfoByUserName($username);

if (is_null($field_id) || is_null($username)) {
	
	$errors['PARAMETERS_MISSED'] = 1;
	
} elseif (!isset($user_info[$field_id])) {
	
	$errors['WRONG_PARAMETERS_SPECIFIED'] = 1;
	
} else {
	
	$uploaded_file_id = $user_info[$field_id];
	
	SJB_UploadFileManager::deleteUploadedFileByID($uploaded_file_id);
	
	$user_info[$field_id] = "";
	
	$user = new SJB_User($user_info, $user_info['user_group_sid']);
	
	$user->deleteProperty("active");
	
	$user->deleteProperty('password');

	$user->setSID($user_info['sid']);
	
	SJB_UserManager::saveUser($user);
	
}


$template_processor = SJB_System::getTemplateProcessor();

$template_processor->assign("errors", isset($errors) ? $errors : null);

$template_processor->assign("username", $username);

$template_processor->display("delete_uploaded_picture.tpl");

