<?php

require_once 'news/NewsManager.php';

$errors = array();
$tp     = SJB_System::getTemplateProcessor();

$i18n   = SJB_I18N::getInstance();
$lang   = $i18n->getLanguageData($i18n->getCurrentLanguage());
$langId = $lang['id'];


// params
$count    = SJB_Settings::getSettingByName('number_news_on_main_page');
$articles = SJB_NewsManager::getLatestNews($count, $langId);

$tp->assign('count', $count);
$tp->assign('articles_count', count($articles));
$tp->assign('articles', $articles);

$tp->display('news.tpl');