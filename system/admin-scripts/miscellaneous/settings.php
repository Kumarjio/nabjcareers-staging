<?php

$tp = SJB_System::getTemplateProcessor();
$errors = array();
require_once('sub_admins/SubAdminManager.php');

if (SJB_Request::getVar('action') == 'save') {
	if (SJB_System::getSystemSettings("isDemo")) {
		$errors[] = "You don't have permissions for it. This is a Demo version of the software.";
	}
	else {
		if (!empty($_REQUEST['bad_words'])) {
			$_REQUEST['bad_words'] = trim($_REQUEST['bad_words']);
		}
		SJB_Settings::updateSettings($_REQUEST);
	}
}

$i18n = SJB_I18N::getInstance();
$tp->assign("settings", SJB_Settings::getSettings());
$ds = DIRECTORY_SEPARATOR;
$path = SJB_BASE_DIR."system{$ds}cache{$ds}agents_bots.txt";
$disable_bots = file_get_contents($path);
$tp->assign("disable_bots", $disable_bots);

if ( !SJB_SubAdmin::getSubAdminSID())
{
	$tp->assign("subadmins", SJB_SubAdminManager::getAllSubAdminsInfo());
}

$tp->assign("errors", $errors);
$tp->assign("i18n_domains", $i18n->getDomainsData());
$tp->assign("i18n_languages", $i18n->getActiveLanguagesData());
$tp->display("settings.tpl");
