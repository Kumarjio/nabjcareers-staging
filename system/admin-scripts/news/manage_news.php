<?php

require_once 'news/NewsManager.php';

$errors = array();
$action = SJB_Request::getVar('action', false);

$tp = SJB_System::getTemplateProcessor();

$categorySid = SJB_Request::getVar('category_sid');
$category    = SJB_NewsManager::getCategoryBySid($categorySid);

$tp->assign('category_sid', $categorySid);
$tp->assign('category', $category);

$allCategories = SJB_NewsManager::getCategories();
$tp->assign('all_categories', $allCategories);


$i18n        = SJB_I18N::getInstance();
$lang        = $i18n->getLanguageData($i18n->getCurrentLanguage());
$dateFormat  = $lang['date_format'];
$currentDate = strftime($dateFormat, time());

$currentTimestamp = time();


/****************** ACTIONS ***************************/

switch ($action) {
	
	case 'add':
		$articleTitle   = SJB_Request::getVar('article_title');
		$articleBrief   = SJB_Request::getVar('article_brief');
		$articleText    = SJB_Request::getVar('article_text');
		$articleLink    = SJB_Request::getVar('article_link');
		$articlePubDate = SJB_Request::getVar('article_publication_date');
		$articleExpDate = SJB_Request::getVar('article_expiration_date');
		$articleLanguage = SJB_Request::getVar('article_language');
		
		$formSubmitted  = SJB_Request::getVar('form_submit', false);
		
		if ($formSubmitted) {
			if (empty($articleTitle)) {
				$errors['ARTICLE_TITLE_IS_EMPTY'] = 1;
			}
			if (empty($articleBrief)) {
				$errors['ARTICLE_BRIEF_IS_EMPTY'] = 1;
			}
		}
		
		if (empty($errors) && $formSubmitted) {
			
			$articleSID = SJB_NewsManager::addArticle($_REQUEST);
			
			if ($articleSID) {
				
				$uploadFileID = 'article_image';
				if (!empty($_FILES[$uploadFileID]['name'])) {
					$uploadFileID = 'article_image';
					$file_id = 'article_' .$articleSID;
					
					$upload_manager = new SJB_UploadFileManager();
					$upload_manager->setFileGroup("pictures");
					$upload_manager->setUploadedFileID($file_id);
					$uploaded = $upload_manager->uploadFile($uploadFileID);
					
					if ($uploaded === false){
						$errors[$upload_manager->getError()] = 1;
					}
					
					if (SJB_UploadFileManager::doesFileExistByID($file_id)) {
						SJB_NewsManager::setNewsImageFileID($articleSID, $file_id);
					} else {
						$errors['ERROR_UPLOADING_FILE'] = 1;
					}
				}

				if (empty($errors)) {
					SJB_HelperFunctions::redirect( SJB_System::getSystemSettings('SITE_URL') . "/news-categories/?action=edit&category_sid={$categorySid}");
					exit;
				}
				$errors['UNABLE_TO_ADD_ARTICLE'] = 1;
			}
			
		} else {
			if (empty($articlePubDate)) {
				$articlePubDate = $currentDate;
			}
			
			$tp->assign('article_title', $articleTitle);
			$tp->assign('article_brief', $articleBrief);
			$tp->assign('article_text', $articleText);
			$tp->assign('article_link', $articleLink);
			$tp->assign('article_publication_date', $articlePubDate);
			$tp->assign('article_expiration_date', $articleExpDate);
			$tp->assign('article_language', $articleLanguage);
		}
		
		$tp->assign('errors', $errors);
		$tp->assign('category', $category);
		
		$tp->display('add_article.tpl');
		break;

		
	case 'edit':
		$upload_manager = new SJB_UploadFileManager();
		$itemSID        = SJB_Request::getVar('article_sid', false);
		$formSubmitted  = SJB_Request::getVar('form_submit', false);
		
		if (!$itemSID) {
			$errors['NO_ITEM_SID_PRESENT'] = 1;
		} else {
			$newsItem = SJB_NewsManager::getItemBySID($itemSID);
			if (!$newsItem) {
				$errors['NEWS_ITEM_NOT_EXISTS'] = 1;
			}
		}
		
		if (empty($errors)) {
			$articleTitle   = $newsItem['title'];
			$articleBrief   = $newsItem['brief'];
			$articleText    = $newsItem['text'];
			$articleLink    = $newsItem['link'];
			$articlePubDate = $newsItem['date'];
			$articleExpDate = $newsItem['expiration_date'];
			$articleLanguage = $newsItem['lang'];
			
			
			$tp->assign('article_title', $articleTitle);
			$tp->assign('article_brief', $articleBrief);
			$tp->assign('article_text', $articleText);
			$tp->assign('article_link', $articleLink);
			$tp->assign('article_publication_date', $articlePubDate);
			$tp->assign('article_expiration_date', $articleExpDate);
			$tp->assign('article_language', $articleLanguage);
			
			if (isset($newsItem['image'])) {
				$tp->assign('article_image', $upload_manager->getUploadedFileLink( $newsItem['image']) );
			}
			$tp->assign('article_sid', $itemSID);
		}
		
		if ($formSubmitted) {
			$articleTitle   = SJB_Request::getVar('article_title');
			$articleBrief   = SJB_Request::getVar('article_brief');
			$articleText    = SJB_Request::getVar('article_text');
			$articleLink    = SJB_Request::getVar('article_link');
			$articlePubDate = SJB_Request::getVar('article_publication_date');
			$articleExpDate = SJB_Request::getVar('article_expiration_date');
			$articleLanguage = SJB_Request::getVar('article_language');
			
			$formSubmitted  = SJB_Request::getVar('form_submit', false);
			
			if ($formSubmitted) {
				if (empty($articleTitle)) {
					$errors['ARTICLE_TITLE_IS_EMPTY'] = 1;
				}
				if (empty($articleBrief)) {
					$errors['ARTICLE_BRIEF_IS_EMPTY'] = 1;
				}
			}
			
			$uploadFileID = 'article_image';
			if (!empty($_FILES[$uploadFileID]['name'])) {
				
				$file_id = 'article_'.$newsItem['sid'];
				if (empty($file_id)) {
					$file_id = 'article_' . $itemSID;
				} else {
					// delete old file
					$upload_manager->deleteUploadedFileByID($file_id);
				}
				
				$upload_manager->setFileGroup("pictures");
				$upload_manager->setUploadedFileID($file_id);
				$uploaded = $upload_manager->uploadFile($uploadFileID);
				
				if ($uploaded === false){
					$errors[$upload_manager->getError()] = 1;
				}
				if (SJB_UploadFileManager::doesFileExistByID($file_id)) {
					SJB_NewsManager::setNewsImageFileID($itemSID, $file_id);
				} else {
					$errors['ERROR_UPLOADING_FILE'] = 1;
				}
			}
			
			if (empty($errors)) {
				$result = SJB_NewsManager::updateArticle($_REQUEST);
				if ($result) {
					SJB_HelperFunctions::redirect( SJB_System::getSystemSettings('SITE_URL') . "/news-categories/?action=edit&category_sid={$categorySid}");
					exit;
				}
				$errors['UNABLE_TO_UPDATE_ARTICLE'] = 1;
			}
		}
		
		$tp->assign('errors', $errors);
		$tp->assign('category', $category);
		
		$tp->display('edit_article.tpl');
		break;
		
		
	case 'delete':
		$itemSIDs       = SJB_Request::getVar('news');
		$upload_manager = new SJB_UploadFileManager();
		
		foreach ($itemSIDs as $sid=>$item) {
			// delete picture
			$image = SJB_NewsManager::getImageFileIDByArticleSID($sid);
			if ($image) {
				$upload_manager->deleteUploadedFileByID($image);
			}
			// delete article
			SJB_NewsManager::deleteItemBySID($sid);
		}
		SJB_HelperFunctions::redirect( SJB_System::getSystemSettings('SITE_URL') . "/news-categories/?action=edit&category_sid={$categorySid}");
		break;
		
		
	case 'delete_image':
		$articleSID     = SJB_Request::getVar('article_sid');
		$upload_manager = new SJB_UploadFileManager();
		
		$fileID = SJB_NewsManager::getImageFileIDByArticleSID($articleSID);
		if ($fileID) {
			$upload_manager->deleteUploadedFileByID($fileID);
		}
		SJB_HelperFunctions::redirect( SJB_System::getSystemSettings('SITE_URL') . "/manage-news/?action=edit&article_sid={$articleSID}&category_sid={$categorySid}");
		break;
		
		
	case 'activate':
		$itemSIDs = SJB_Request::getVar('news');
		foreach ($itemSIDs as $sid=>$item) {
			SJB_NewsManager::activateItemBySID($sid);
		}
		SJB_HelperFunctions::redirect( SJB_System::getSystemSettings('SITE_URL') . "/news-categories/?action=edit&category_sid={$categorySid}");
		break;
		
		
	case 'deactivate':
		$itemSIDs = SJB_Request::getVar('news');
		foreach ($itemSIDs as $sid=>$item) {
			SJB_NewsManager::deactivateItemBySID($sid);
		}
		SJB_HelperFunctions::redirect( SJB_System::getSystemSettings('SITE_URL') . "/news-categories/?action=edit&category_sid={$categorySid}");
		break;
		
		
	case 'archive':
		$itemSIDs = SJB_Request::getVar('news');
		foreach ($itemSIDs as $sid=>$item) {
			SJB_NewsManager::moveArticleToArchiveBySid($sid);
		}
		SJB_HelperFunctions::redirect( SJB_System::getSystemSettings('SITE_URL') . "/news-categories/?action=edit&category_sid={$categorySid}");
		break;
		

	default:
		$page           = SJB_Request::getVar('page', 1);
		$itemsPerPage   = SJB_Request::getVar('items_per_page', 10);
		$totalNewsCount = SJB_NewsManager::getAllNewsCount();
		
		$pages = ceil( $totalNewsCount / $itemsPerPage);
		
		// get news for current page
		//$news = NewsManager::getAllNews();
		$news = SJB_NewsManager::getNewsByPage($page, $itemsPerPage);
		
		$tp->assign('news', $news);
		$tp->assign('pages', $pages);
		$tp->assign('items_per_page', $itemsPerPage);
		$tp->assign('current_page', $page);
		
		$tp->display('manage_news.tpl');
		break;
}
