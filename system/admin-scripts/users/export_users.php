<?php

require_once SJB_System::getSystemSettings('EXTERNAL_COMPONENTS_DIR').'Excel/Writer.php'; 
require_once 'users/User/User.php';    
require_once 'users/UsersExportController.php'; 
require_once 'users/User/UserSearcher.php';
require_once 'classifieds/SearchEngine/SearchFormBuilder.php';
require_once 'classifieds/SearchEngine/PropertyAliases.php';
require_once 'users/User/UserCriteriaSaver.php';

$tp = SJB_System::getTemplateProcessor();
$errors = array();

$exportProperties 	= SJB_Request::getVar('export_properties', array());
$userGroupID = SJB_Request::getVar('user_group_id', 0);

$user  = SJB_UsersExportController::createUser($userGroupID); 
$search_form_builder = new SJB_SearchFormBuilder($user);
$criteria_saver = new SJB_UserCriteriaSaver();
$criteria = $search_form_builder->extractCriteriaFromRequestData($_REQUEST, $user);
$search_form_builder->registerTags($tp);
$search_form_builder->setCriteria($criteria);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{	
	if (empty($exportProperties)) 
	{
		$errors['EMPTY_EXPORT_PROPERTIES'] = true;		
	}
	else
	{
		$inner_join = false;
		if (isset($_REQUEST['membership_plan']['multi_like']) && $_REQUEST['membership_plan']['multi_like'] != '') {
			$inner_join = array( 'contracts' => array( 'join_field' => 'user_sid', 'join_field2' => 'sid', 'join' => 'INNER JOIN' ) );
		}
		$searcher = new SJB_UserSearcher(false, false, false, $inner_join);
		
		$search_aliases  	= SJB_UsersExportController::getSearchPropertyAliases();						
		$found_users_sid = $searcher->getObjectsSIDsByCriteria($criteria, $search_aliases);

		if (empty($found_users_sid)) 
		{
			$errors['EMPTY_EXPORT_DATA'] = true;			
		}
		else
		{
			SJB_UsersExportController::createExportDirectories();
					
			$export_aliases  = SJB_UsersExportController::getExportPropertyAliases();
			$export_data 	 = SJB_UsersExportController::getExportData($found_users_sid, $exportProperties, $export_aliases);

			SJB_UsersExportController::changeTreeProperties($exportProperties, $export_data);
			SJB_UsersExportController::changeMonetaryProperties($exportProperties, $export_data);
			SJB_UsersExportController::changeFileProperties($exportProperties, $export_data, 'file');
			SJB_UsersExportController::changeFileProperties($exportProperties, $export_data, 'video');
			SJB_UsersExportController::changeFileProperties($exportProperties, $export_data, 'Logo');

			SJB_UsersExportController::makeExportFile($exportProperties, $export_data, 'users.xls');	
			
			SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL")."/archive-and-send-export-data");
		}		
	}
}
$userSystemProperties = SJB_UserManager::getAllUserSystemProperties();
$userGroups = SJB_UserGroupManager::getAllUserGroupsInfo();
$userCommonProperties = array();
foreach ($userGroups as $userGroup){
	$userGroupProperties = SJB_UserProfileFieldManager::getFieldsInfoByUserGroupSID($userGroup['sid']);
	$userCommonProperties[$userGroup['id']] = $userGroupProperties;
}

$tp->assign('errors', $errors);
$tp->assign('userSystemProperties', $userSystemProperties);
$tp->assign('userCommonProperties', $userCommonProperties);
$tp->assign('selected_user_group_id', $userGroupID);
$tp->display('export_users.tpl');

