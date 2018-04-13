<?php

require_once 'news/NewsManager.php';

$errors = array();
$action = SJB_Request::getVar('action', false);

$tp = SJB_System::getTemplateProcessor();

$archiveCategory = SJB_NewsManager::getCategoryByName('Archive');
$tp->assign('archive_category', $archiveCategory);

$sortingField = SJB_Request::getVar('sorting_field', 'id');
$sortingOrder = SJB_Request::getVar('sorting_order', 'ASC');

$tp->assign('sorting_field', $sortingField);
$tp->assign('sorting_order', $sortingOrder);

/****************** ACTIONS ***************************/

switch ($action) {
	
	case 'save_display_setting':
		// save setting 'show_news_on_main_page'
		$settings = SJB_Request::getVar('settings');

		SJB_Settings::updateSettings($settings);
		
		SJB_HelperFunctions::redirect( SJB_System::getSystemSettings('ADMIN_SITE_URL') . "/news-categories/");
		break;
		
		
	case 'add':
		$categoryName = SJB_Request::getVar('category_name');
		if (empty($categoryName)) {
			$errors[] = 'CATEGORY_NAME_IS_EMPTY';
			break;
		}
		$isExists = SJB_NewsManager::checkExistsCategoryName($categoryName);
		if ($isExists) {
			$errors[] = 'CATEGORY_NAME_ALREADY_EXISTS';
			break;
		}
		SJB_NewsManager::addCategory($categoryName);
		
		SJB_HelperFunctions::redirect( SJB_System::getSystemSettings('ADMIN_SITE_URL') . "/news-categories/");
		break;

		
	case 'edit':
		$categorySid = SJB_Request::getVar('category_sid');
		
		$formSubmitted = SJB_Request::getVar('submit');
		if ($formSubmitted) {
			$newCategoryName = SJB_Request::getVar('category_name');
			if (!empty($newCategoryName)) {
				$isExists = SJB_NewsManager::checkExistsCategoryName($newCategoryName);
				if (!$isExists) {
					SJB_NewsManager::updateCategory($categorySid, $newCategoryName);
				} else {
					$errors[] = 'CATEGORY_NAME_ALREADY_EXISTS';
				}
			} else {
				$errors[] = 'CATEGORY_NAME_IS_EMPTY';
			}
		}
		
		$category    = SJB_NewsManager::getCategoryBySid($categorySid);
		$articles    = SJB_NewsManager::getArticlesByCategorySid($categorySid, $sortingField, $sortingOrder);
		
		$tp->assign('errors', $errors);
		$tp->assign('category', $category);
		$tp->assign('articles', $articles);
		
		$tp->display('edit_category.tpl');
		break;
		
		
	case 'delete':
		$sids = SJB_Request::getVar('categories');
		if (!empty($sids)) {
			foreach ($sids as $categorySid=>$value) {
				SJB_NewsManager::deleteCategoryBySid($categorySid);
			}
		}
		SJB_HelperFunctions::redirect( SJB_System::getSystemSettings('ADMIN_SITE_URL') . "/news-categories/");
		break;
		
		
	case 'move_up':
		$categorySid = SJB_Request::getVar('category_sid');
		SJB_NewsManager::moveUpCategoryBySID($categorySid);
		SJB_HelperFunctions::redirect( SJB_System::getSystemSettings('ADMIN_SITE_URL') . "/news-categories/");
		break;
		
		
	case 'move_down':
		$categorySid = SJB_Request::getVar('category_sid');
		SJB_NewsManager::moveDownCategoryBySID($categorySid);
		SJB_HelperFunctions::redirect( SJB_System::getSystemSettings('ADMIN_SITE_URL') . "/news-categories/");
		break;

		
	default:
		$categories         = SJB_NewsManager::getCategories();
		$showNewsOnMainPage = SJB_Settings::getSettingByName('show_news_on_main_page');
		
		// get number of news for categories
		foreach ($categories as $key=>$category) {
			// remove archive from categories list
			if ($category['name'] == 'Archive') {
				unset($categories[$key]);
				continue;
			}
			$counter = SJB_NewsManager::getAllNewsCount($category['sid'], null);
			$categories[$key]['count'] = $counter;
		}
		
		$tp->assign('categories', $categories);
		$tp->assign('show_news_on_main_page', $showNewsOnMainPage);
		$tp->assign('number_news_on_main_page', SJB_Settings::getSettingByName('number_news_on_main_page'));
		$tp->assign('errors', $errors);
		
		$tp->display('categories_list.tpl');
		break;
}



