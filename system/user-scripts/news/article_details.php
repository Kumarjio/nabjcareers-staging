<?php

require_once("classifieds/Browse/UrlParamProvider.php");
require_once 'news/NewsManager.php';

$errors = array();

// params
$itemSID = SJB_Request::getVar("item");

if (isset($_REQUEST['passed_parameters_via_uri'])) {
	$passed_parameters_via_uri = SJB_UrlParamProvider::getParams();
	$itemSID = isset($passed_parameters_via_uri[0]) ? $passed_parameters_via_uri[0] : null;
}

$article = false;

if (is_null($itemSID)) {
	$errors['ITEM_SID_IS_EMPTY'] = 1;
} else {
	$article = SJB_NewsManager::getActiveItemBySID($itemSID);
}

if (!$article) {
	$errors['ARTICLE_NOT_EXISTS'] = 1;
}


$tp = SJB_System::getTemplateProcessor();

$tp->assign('article', $article);

$tp->display('article_details.tpl');