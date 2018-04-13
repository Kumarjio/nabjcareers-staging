<?php

require_once("users/User/UserManager.php");

$template = isset($_REQUEST['featured_profiles_template']) ? $_REQUEST['featured_profiles_template'] : 'featured_profiles.tpl';
$number_of_rows = isset($_REQUEST['number_of_rows']) ? $_REQUEST['number_of_rows'] : 1;
$number_of_cols = isset($_REQUEST['number_of_cols']) ? $_REQUEST['number_of_cols'] : 1;
$number_of_profiles = $number_of_rows * $number_of_cols;

$profiles = SJB_UserManager::getFeaturedProfiles($number_of_profiles);

$tp = SJB_System::getTemplateProcessor();
$tp->assign("profiles", $profiles);
$tp->assign("number_of_rows", $number_of_rows);
$tp->assign("number_of_cols", $number_of_cols);
$tp->display($template);
