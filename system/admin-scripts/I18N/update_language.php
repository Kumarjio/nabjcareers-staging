<?php


require_once "ObjectMother.php";
require_once "template_manager/TemplateEditor.php";
require_once "I18N/LanguageActionFactory.php";

$errors = array();
$params = array();
$lang_id = isset($_REQUEST['languageId']) ? $_REQUEST['languageId'] : null;

$i18n =& SJB_ObjectMother::createI18N();
if ($i18n->languageExists($lang_id))
{
	$params = $i18n->getLanguageData($lang_id);
	$params['languageId'] = $lang_id;
	if (isset($_REQUEST['action']))
	{
		$action_name = $_REQUEST['action']; 
		
		$params = array_merge($params, $_REQUEST);		
		
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
}
else $errors[] = 'LANGUAGE_DOES_NOT_EXIST';

$template_editor =& SJB_ObjectMother::createTemplateEditor();
$themes = $template_editor->getThemeList();

$template_processor = SJB_System::getTemplateProcessor();
$template_processor->assign('themes', $themes);
$template_processor->assign('lang', $params);
$template_processor->assign('errors', $errors);
$template_processor->display('update_language.tpl');

