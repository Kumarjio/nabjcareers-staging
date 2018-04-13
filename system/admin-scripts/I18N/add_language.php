<?php


require_once "ObjectMother.php";
require_once "template_manager/TemplateEditor.php";
require_once "I18N/LanguageActionFactory.php";

$errors = array();
$params = array();

if (isset($_REQUEST['action']))
{
	$action_name = $_REQUEST['action']; 
	$params = $_REQUEST;
	$action = SJB_LanguageActionFactory::get($action_name, $params);
	
	if ($action->canPerform())
	{
		$action->perform();
		SJB_WrappedFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/manage-languages/');
	}	
	else
	{
		$errors = $action->getErrors();
	}
}

$template_editor =& SJB_ObjectMother::createTemplateEditor();
$themes = $template_editor->getThemeList();

$template_processor = SJB_System::getTemplateProcessor();
$template_processor->assign('themes', $themes);
$template_processor->assign('request_data', $params);
$template_processor->assign('errors', $errors);
$template_processor->display('add_language.tpl');

