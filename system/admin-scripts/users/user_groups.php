<?php


require_once("users/UserGroup/UserGroupManager.php");

$template_processor = SJB_System::getTemplateProcessor();

$user_groups_structure = SJB_UserGroupManager::createTemplateStructureForUserGroups();

$template_processor->assign("user_groups", $user_groups_structure);
$template_processor->display("user_groups.tpl");

