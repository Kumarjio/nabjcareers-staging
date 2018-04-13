<?php

require_once ('static_content/static_content.php');

$tp = SJB_System::getTemplateProcessor();
$page_id = SJB_Request::getVar('pageid', null);
$i18n = SJB_I18N::getInstance();
$lang = SJB_Request::getVar('lang', $i18n->getCurrentLanguage());

if ($page_id) {
	$i18n = SJB_I18N::getInstance();
	$def_lang = SJB_System::getSettingByName('i18n_default_language');
	
	$staticContent = getStaticContentByIDAndLang ($page_id, $lang);

	if ( empty($staticContent))
	{
		/*
		 * trying to get static content by defaul language
		 */
		$staticContent = getStaticContentByIDAndLang ($page_id, $def_lang);

	}
	
	if ( !empty($staticContent))
	{
		$tp->assign('staticContent', $staticContent["content"]);
		$tp->display('static_content.tpl');
	}
}
