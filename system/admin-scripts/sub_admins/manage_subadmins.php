<?php
require_once('sub_admins/SubAdminManager.php');

$tp = SJB_System::getTemplateProcessor();
$errors = array();

$tp->assign("subadmins", SJB_SubAdminManager::getAllSubAdminsInfo());

$tp->assign("errors", $errors);
$tp->display("manage_subadmins.tpl");
