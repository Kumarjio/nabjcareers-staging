<?php

require_once 'I18N/LanguageActionFactory.php';
$tp = SJB_System::getTemplateProcessor();
$errors = array();
$action = SJB_Request::getVar('action', false);

if ($action) {
	$params = $_REQUEST + $_FILES['lang_file'];
	$action = SJB_LanguageActionFactory::get($action, $params);
	if ($action->canPerform()) {
		$action->perform();
		SJB_WrappedFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/manage-languages/');
	}	
	else {
		$errors = $action->getErrors();
	}	
}

$tp->assign('errors', $errors);
$tp->display('import_language.tpl');

