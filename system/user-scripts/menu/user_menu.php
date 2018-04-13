<?php

require_once "users/Authorization.php";
require_once "users/UserGroup/UserGroupManager.php";



/* Resumes access expire. Eldar Dec 2013  */
require_once("membership_plan/MembershipPlan.php");
require_once("membership_plan/MembershipPlanManager.php");
require_once("users/User/User.php");
require_once("users/User/UserManager.php");
require_once("membership_plan/Contract.php");

/* END */



$tp = SJB_System::getTemplateProcessor();
$user_menu_template = 'user_menu.tpl';
if (SJB_UserManager::isUserLoggedIn()) {	
	$user_info = SJB_Authorization::getCurrentUserInfo();
	if (!empty($user_info)) {
		$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_info['user_group_sid']);
		$user_menu_template = !empty($user_group_info['user_menu_template']) ? $user_group_info['user_menu_template'] : $user_menu_template;
		$tp->assign("user_group_info", $user_group_info);

		
			
		/* Resumes access expire. Eldar Dec 2013 */
		$user				= SJB_UserManager::getCurrentUser();
		$contractsInfo		= SJB_ContractManager::getAllContractsInfoByUserSID($user->sid);
		
		foreach ($contractsInfo as $key => $contractInfo) {
			$contractInfo['extra_info'] 	= unserialize($contractInfo['serialized_extra_info']);
			$contractInfo['countListings']	= SJB_ListingManager::getListingsNumberByUserSID($user->sid);
			$contractInfo['avalaibleViews']	= '';
			if (isset($contractInfo['extra_info']['page_access']))
				$contractInfo['avalaibleViews']	= array_sum($contractInfo['extra_info']['page_access']);
			// подсчитаем количество просмотров, уже имеющихся у пользователя
			$contractInfo['numOfViews']		= array_pop( SJB_DB::query("SELECT count(*) as `count` FROM `page_view` WHERE `id_user` = ?n GROUP BY `id_user`", $user->sid) );
			if (is_array($contractInfo['numOfViews'])) {
				$contractInfo['numOfViews'] = $contractInfo['numOfViews']['count'];
			}
			$contractsInfo[$key] = $contractInfo;
		}
		
		$tp->assign("contractsInfo", $contractsInfo);
		/* END */
		
	}
}

$tp->display($user_menu_template);
