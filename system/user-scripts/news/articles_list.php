<?php

require_once("classifieds/Browse/UrlParamProvider.php");
require_once 'news/NewsManager.php';

$errors = array();
$tp     = SJB_System::getTemplateProcessor();

$i18n   = SJB_I18N::getInstance();
$lang   = $i18n->getLanguageData($i18n->getCurrentLanguage());
$langId = $lang['id'];
		
// params

// Category SID incoming as part of URL.
$categorySid = SJB_Request::getVar("category_sid");

if (isset($_REQUEST['passed_parameters_via_uri'])) {
	$passed_parameters_via_uri = SJB_UrlParamProvider::getParams();
	$categorySid = isset($passed_parameters_via_uri[0]) ? $passed_parameters_via_uri[0] : null;
}

// other params in query string
$current_page = SJB_Request::getVar('page', 1);
$itemsPerPage = 10;

$action = SJB_Request::getVar('action');
if ( $action == 'search') {
	// COUNT FOR SEARCH ACTION
	$searchText = SJB_Request::getVar('search_text');
	$totalNews  = SJB_NewsManager::getAllNewsCountBySearchText($searchText, $langId, true);
} else {
	$totalNews  = SJB_NewsManager::getAllNewsCount($categorySid, $langId, true);
}


$pages = ceil( $totalNews / $itemsPerPage);
if ($pages == 0) {
	$pages = 1;
}
if ($current_page > $pages) {
	$current_page = $pages;
}

if ( $action == 'search') {
	// GET ARTICLES FOR SEARCH ACTION
	if ($totalNews == 0) {
		$articles = array();
	} else {
		$articles = SJB_NewsManager::searchArticles($searchText, $langId, true);
	}
} else {
	$articles = SJB_NewsManager::getNewsByPage($current_page, $itemsPerPage, $categorySid, $langId, true);
}


$tp->assign('current_page', $current_page);
$tp->assign('pages', $pages);
$tp->assign('articles', $articles);

$categories = SJB_NewsManager::getCategories($langId);

$countOfNotEmptyCategories = 0;
foreach ($categories as $category) {
	if ($category['count'] > 0) {
		$countOfNotEmptyCategories++;
	}
}
$showCategoriesBlock = false;
if ($countOfNotEmptyCategories > 1) {
	$showCategoriesBlock = true;
}

$tp->assign('show_categories_block', $showCategoriesBlock);
$tp->assign('categories', $categories);
$tp->assign('current_category_sid', $categorySid);

$tp->display('articles_list.tpl');