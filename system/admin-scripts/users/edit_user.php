<?php

require_once("users/User/UserManager.php");
require_once("users/User/User.php");
require_once("forms/Form.php");


/* 25-07-2016*/
require_once('membership_plan/Contract.php');
/* end 25/07/2016 */



$tp = SJB_System::getTemplateProcessor();

$user_sid = SJB_Request::getVar('user_sid', false);
if($user_sid=="")
	$user_sid = SJB_Request::getVar('sid', false);
	
$user_group_id = SJB_Request::getVar('user_group_id', null);
$tp->assign("user_group_id", $user_group_id);



if (!is_null($user_sid)) {
	$user_info = SJB_UserManager::getUserInfoBySID($user_sid);
	$user_info = array_merge($user_info, $_REQUEST);
	$form_submitted = SJB_Request::getVar('action', '') == 'save_info';
	
	$user = new SJB_User($user_info, $user_info['user_group_sid']);
	if (!empty($user_info['parent_sid'])) {
		$props = $user->getProperties();
		$allowedProperties = array('username', 'email', 'password');
		foreach ($props as $prop) {
			if (!in_array($prop->getID(), $allowedProperties))
				$user->deleteProperty($prop->getID());
		}
	}
	$user->setSID($user_info['sid']);

	$user->deleteProperty("active");
	$user->makePropertyNotRequired("password");
	if (SJB_UserGroupManager::isUserEmailAsUsernameInUserGroup($user_info['user_group_sid'])) {
		if ($form_submitted) {
			$email = $user->getPropertyValue('email');
			if (is_array($email))
				$email = $email['original'];
			$user->setPropertyValue('username', $email);
		}
	}

	$edit_user_form = new SJB_Form($user);
	$errors = array();

	


	
	if ($form_submitted && $edit_user_form->isDataValid($errors)) {
				
		if (($user_info['resume_bonus_days']) !=0) {
			// 15-07-2016 Resume access bonus
			$bonus_days = $user_info['resume_bonus_days'];
			$notSubscribed= true;
			$contrs =	$user->getContracts(); // get all plans
			foreach ($contrs as $contr) { // check if subscribed for resume accees
				$contr_membership_plan_id = $contr["membership_plan_id"];
				if ($contr_membership_plan_id  == 40 ||$contr_membership_plan_id == 39 ||$contr_membership_plan_id == 33 ||$contr_membership_plan_id == 37 ||
				$contr_membership_plan_id == 51 ||$contr_membership_plan_id == 52 ||$contr_membership_plan_id == 53)
				{ // if already subscribed for resumes access - extend subscription for X days
					$notSubscribed = false;
					$prev_exp_date = $contr['expired_date'];
					list($y,$m,$d)=explode('-',$prev_exp_date);
					$expiration_date_new = Date("Y-m-d", mktime(0,0,0,$m,$d+$bonus_days,$y));
					$changed_contr = $user->setContractsExpiredDate($expiration_date_new, $user_sid, $contr_membership_plan_id);
					break;
				}
			}
			// if not subscrubed
			if ($notSubscribed) {
				// 1. subscribe
				$contract = new SJB_Contract(array('membership_plan_id' => '37'));
				$contract->setUserSID($user_sid);
				$contract->saveInDB();
			
				// 2. chng expiration date
				$today = getdate();
				$y = $today['year'];
				$m = $today['mon'];
				$d = $today['mday'];
				$expiration_date_new = Date("Y-m-d", mktime(0,0,0,$m,$d+$bonus_days,$y));
				$changed_contr = $user->setContractsExpiredDate($expiration_date_new, $user_sid, '37');
			}
			// FIX : reset bonus days to 0
			$user->resetBonusResumesValueByUserSID($user_sid);
			/* END */
				
		}		
		
        $password_value = $user->getPropertyValue('password');
		if (empty($password_value['original']))
			$user->deleteProperty('password');

		SJB_UserManager::saveUser($user);
		
		if (SJB_Request::isAjax()) {
			echo "<p class=\"green\">User Saved</p>";
			exit;
		}
		
		$user_group_id = SJB_UserGroupManager::getUserGroupNameBySID($user_info['user_group_sid']);
		$user_group_id = str_replace(" ","",$user_group_id);
		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL") . "/users/?restore=1&user_group_id=$user_group_id");		
	}
	else {
		if (SJB_UserGroupManager::isUserEmailAsUsernameInUserGroup($user_info['user_group_sid']))
			$user->deleteProperty("username");
		$edit_user_form = SJB_ObjectMother::createForm($user);
		$edit_user_form->registerTags($tp);
		
		$tp->assign("form_fields", $edit_user_form->getFormFieldsInfo());
		$tp->assign("errors", $errors);
		$tp->assign("user_info", $user_info);
		$tp->display("edit_user.tpl");
	}
}