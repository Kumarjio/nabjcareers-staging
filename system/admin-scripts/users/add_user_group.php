<?php

require_once("users/UserGroup/UserGroup.php");
require_once("users/UserGroup/UserGroupManager.php");
require_once("forms/Form.php");

$user_group = new SJB_UserGroup($_REQUEST);
$add_user_group_form = new SJB_Form($user_group);
$form_is_submitted = (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add');
$errors = null;
$tp = SJB_System::getTemplateProcessor();

if ($form_is_submitted && $add_user_group_form->isDataValid($errors)) {
	SJB_UserGroupManager::saveUserGroup($user_group);
	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/user-groups/");
}
else {
	$add_user_group_form->registerTags($tp);
	$tp->assign("form_fields", $add_user_group_form->getFormFieldsInfo());
	$tp->assign("errors", $errors);
	$tp->display("add_user_group.tpl");
}
