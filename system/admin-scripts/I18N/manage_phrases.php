<?php


require_once('ObjectMother.php');
require_once('I18N/PhraseActionFactory.php');

$errors = array();
$result = '';

$template_processor = SJB_System::getTemplateProcessor();

if (isset($_REQUEST['action']))
{
	$action_name = $_REQUEST['action'];
	$params = $_REQUEST;
	
	$action = SJB_PhraseActionFactory::get($action_name, $params, $template_processor);
	if ($action->canPerform())
	{
		$action->perform();
		$result = isset($_REQUEST['result']) ? $_REQUEST['result'] : $action->result;
	}
	else
	{
		$errors = $action->getErrors();
	}
}
else
{
	$template_processor->assign('criteria', $_REQUEST);
}

$i18n =& SJB_ObjectMother::createI18N();

$domains = $i18n->getDomainsData();
$languages = $i18n->getLanguagesData();

$template_processor->assign('result', $result);
$template_processor->assign('domains', $domains);
$template_processor->assign('languages', $languages);
$template_processor->assign('errors', $errors);
$template_processor->display('manage_phrases.tpl');

