<?php

require_once 'miscellaneous/ImportFileXLS.php';
require_once 'miscellaneous/ImportFileCSV.php';
require_once 'miscellaneous/ImportedDataProcessor.php';

require_once 'membership_plan/PackagesManager.php';
require_once 'users/UserGroup/UserGroupManager.php';
require_once 'users/User/UserManager.php';

require_once 'miscellaneous/ImportFileXLS.php';
require_once 'miscellaneous/ImportFileCSV.php';
require_once 'miscellaneous/ImportedUserProcessor.php';

$template_processor = SJB_System::getTemplateProcessor();

$file_info = isset($_FILES['import_file']) ? $_FILES['import_file'] : null;

if (empty($file_info) || $file_info['error'] == UPLOAD_ERR_NO_FILE) {
	$errors = array();
	if ($file_info['error'] == UPLOAD_ERR_NO_FILE)
		$errors[] = 'Please choose exl or csv file';

	$packages 		= SJB_PackagesManager::getPackagesByClass('UserPackage');
	$user_groups 	= SJB_UserGroupManager::getAllUserGroupsInfo();

	$template_processor->assign('packages', $packages);
	$template_processor->assign('user_groups', $user_groups);
	$template_processor->assign('errors', $errors);
	$template_processor->display('import_users.tpl');
}
else {
	$csv_delimiter 			= SJB_Request::getVar('csv_delimiter', null);
	$user_group_id 			= SJB_Request::getVar('user_group_id', null);
	$non_existed_values_flag= SJB_Request::getVar('non_existed_values', null);
	$extension = $_REQUEST['file_type'];

	if ($extension == 'xls')
		$import_file = new SJB_ImportFileXLS($file_info);
	elseif ($extension == 'csv')
		$import_file = new SJB_ImportFileCSV($file_info, $csv_delimiter);

	$import_file->parse();
	$user = CreateUser(array(), $user_group_id);
	$imported_user_processor = new SJB_ImportedUserProcessor($import_file->getData(), $user);

	$count = 0;
	$errors = array();
	$usernames = array();

	while(!$imported_user_processor->isEmpty()) {
		$user_info = $imported_user_processor->getData($non_existed_values_flag);
		$user = CreateUser($user_info, $user_group_id);
		if ($user_info['username'] == '') {
			$errors[] = 'Empty username is not allowed, record ignored.';
		}
		elseif (!is_null(SJB_UserManager::getUserSIDbyUsername($user_info['username']))) {
			$errors[] = '\'' . $user_info['username'] . '\' - this user name already exists, record ignored.';
		}
		else {
			SJB_UserManager::saveUser($user);
			$count++;
		}
	}

	$template_processor->assign('imported_users_count', $count);
	$template_processor->assign('errors', $errors);
	$template_processor->display('import_users_result.tpl');
}

function CreateUser($user_info, $user_group_id)
{
	$user_group_sid = SJB_UserGroupManager::getUserGroupSIDByID($user_group_id);
	return new SJB_User($user_info, $user_group_sid);
}
