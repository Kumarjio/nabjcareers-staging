<?php

 class SJB_NewsManager
 {
 	
 	/**
 	 * Insert news in database
 	 *
 	 * @param string $header
 	 * @param string $text
 	 * @param integer $active
 	 * @return boolean
 	 */
 	/*
 	function addItem($header, $text, $expirationDate = '', $active = 0)
 	{
 		if (empty($expirationDate)) {
 			$result = DB::query("INSERT INTO `news` (`date`, `expiration_date`, `title`, `text`, `active`) VALUES ( NOW(), NOW() + INTERVAL 2 WEEK, ?s, ?s, ?n)", $header, $text, $active);
 		} else {
 			$i18n       = SJB_I18N::getInstance();
			$lang       = $i18n->getLanguageData($i18n->getCurrentLanguage());
			$dateFormat = $lang['date_format'];
 			
 			$result = SJB_DB::query("INSERT INTO `news` (`date`, `expiration_date`, `title`, `text`, `active`) VALUES ( NOW(), STR_TO_DATE(?s, '{$dateFormat}'), ?s, ?s, ?n)", $expirationDate, $header, $text, $active);
 		}
 		return $result;
 	}
 	*/
 	
 	/**
 	 * update news item in database
 	 *
 	 * @param integer $itemSID
 	 * @param string $header
 	 * @param string $text
 	 * @param integer $active
 	 * @return boolean
 	 */
 	/*
 	function updateItem($itemSID, $header, $text, $expirationDate = '', $active = 0)
 	{
 		$i18n = SJB_I18N::getInstance();
		$lang = $i18n->getLanguageData($i18n->getCurrentLanguage());
		$dateFormat = $lang['date_format'];
			
 		$result = SJB_DB::query("UPDATE `news` SET `title` = ?s, `text` = ?s, `expiration_date` = STR_TO_DATE(?s, '{$dateFormat}'), `active` = ?n WHERE `sid` = ?n", $header, $text, $expirationDate, $active, $itemSID);
 		
 		return $result;
 	}
 	*/
 	
 	
 	
 	/**
 	 * get count of all news
 	 *
 	 * @param integer $categorySid
 	 * @return integer
 	 */
 	function getAllNewsCount($categorySid = null, $lang = 'en', $active = false)
 	{
 		$activeParam = '';
 		if ($active) {
 			if (empty($categorySid) && ($lang === null || $lang = 'all') ) {
 				$activeParam = ' WHERE active = 1 ';
 			} else {
 				$activeParam = ' AND active = 1 ';
 			}
 		}
 		if (empty($categorySid)) {
 			if ($lang === null || $lang = 'all') {
 				$result = array_pop( SJB_DB::query("SELECT count(*) as count FROM `news` {$activeParam} ORDER BY `date`", $lang) );
 			} else {
 				$result = array_pop( SJB_DB::query("SELECT count(*) as count FROM `news` WHERE `lang` = ?s {$activeParam} ORDER BY `date`", $lang) );
 			}
 		} else {
 			if ($lang === null || $lang = 'all') {
 				$result = array_pop( SJB_DB::query("SELECT count(*) as count FROM `news` WHERE `category_id` = ?n {$activeParam} ORDER BY `date`", $categorySid) );
 			} else {
 				$result = array_pop( SJB_DB::query("SELECT count(*) as count FROM `news` WHERE `category_id` = ?n AND `lang` = ?s {$activeParam} ORDER BY `date`", $categorySid, $lang) );
 			}
 		}
 		return $result['count'];
 	}
 	
 	
 	/**
 	 * get news by current page
 	 *
 	 * @param integer $page
 	 * @param integer $itemsPerPage
 	 * @param integer $categorySid
 	 */
 	function getNewsByPage($page = 1, $itemsPerPage = 10, $categorySid = null, $lang = 'en', $active = false)
 	{
 		$start  = ($page - 1) * $itemsPerPage;
 		
 		$activeParam = '';
 		if ($active) {
 			$activeParam = ' AND `active` = 1 ';
 		}
 		
 		if (empty($categorySid)) {
 			$result = SJB_DB::query("SELECT * FROM `news` WHERE `lang` = ?s {$activeParam} ORDER BY `date` DESC LIMIT ?n,?n", $lang, $start, $itemsPerPage);
 		} else {
 			$result = SJB_DB::query("SELECT * FROM `news` WHERE `category_id` = ?n AND `lang` = ?s {$activeParam} ORDER BY `date` DESC LIMIT ?n,?n", $categorySid, $lang, $start, $itemsPerPage);
 		}
 		
 		$upload_manager = new SJB_UploadFileManager();
 		
 		foreach ($result as $key => $value) {
 			$result[$key]['image_link'] = '';
 			if (!empty($value['image'])) {
 				$result[$key]['image_link'] = $upload_manager->getUploadedFileLink($value['image']);
 			}
 		}
 		return $result;
 	}
 	
 	
 	
 	function getAllNews($lang = 'en', $active = false)
 	{
 		if ($active) {
 			$result = SJB_DB::query("SELECT * FROM `news` WHERE `lang` = ?s AND active = 1 ORDER BY `date` DESC", $lang);
 		} else {
 			$result = SJB_DB::query("SELECT * FROM `news` WHERE `lang` = ?s ORDER BY `date` DESC", $lang);
 		}
 		
 		$upload_manager = new SJB_UploadFileManager();
 		
 		foreach ($result as $key => $value) {
 			$result[$key]['image_link'] = '';
 			if (!empty($value['image'])) {
 				$result[$key]['image_link'] = $upload_manager->getUploadedFileLink($value['image']);
 			}
 		}
 		return $result;
 	}
 	
 	
 	/**
 	 * delete news item by SID
 	 *
 	 * @param integer $itemSID
 	 */
 	function deleteItemBySID($itemSID)
 	{
 		$result = SJB_DB::query("DELETE FROM `news` WHERE `sid` = ?n", $itemSID);
 	}
 	
 	
 	/**
 	 * activate news item by SID
 	 *
 	 * @param integer $itemSID
 	 */
 	function activateItemBySID($itemSID)
 	{
 		$result = SJB_DB::query("UPDATE `news` SET `active` = 1 WHERE `sid` = ?n", $itemSID);
 	}
 	
 	
 	/**
 	 * deactivate news item by SID
 	 *
 	 * @param integer $itemSID
 	 */
 	function deactivateItemBySID($itemSID)
 	{
 		$result = SJB_DB::query("UPDATE `news` SET `active` = 0 WHERE `sid` = ?n", $itemSID);
 	}
 	
 	
 	/**
 	 * Set image ID to news
 	 *
 	 * @param integer $newsSID
 	 * @param string  $fileID
 	 * @return unknown
 	 */
 	function setNewsImageFileID($newsSID, $fileID)
 	{
 		return SJB_DB::query("UPDATE `news` SET `image` = ?s WHERE `sid` = ?n", $fileID, $newsSID);
 	}
 	
 	

 	
 	
 	
 	
 	/************************* FRONTEND NEWS METHODS **********************/
 	
 	 /**
 	 * get latest news by count
 	 *
 	 * @param integer $count
 	 * @return array
 	 */
 	function getLatestNews($count = 4, $lang = 'en')
 	{
 		$result = SJB_DB::query("SELECT * FROM `news` WHERE `active` = 1 AND `lang` = ?s ORDER BY `date` DESC LIMIT ?n", $lang, $count);
 		
 		$upload_manager = new SJB_UploadFileManager();
 		
 		foreach ($result as $key => $value) {
 			$result[$key]['image_link'] = '';
 			if (!empty($value['image'])) {
 				$result[$key]['image_link'] = $upload_manager->getUploadedFileLink($value['image']);
 			}
 		}
 		return $result;
 	}
 	
 	
 	
 	
 	
 	/**
 	 * get expired news
 	 *
 	 * @return array
 	 */
 	function getExpiredNews()
 	{
 		$result = SJB_DB::query("SELECT * FROM `news` WHERE `expiration_date` < NOW() ORDER BY `date`");
 		return $result;
 	}
 	
 	
 	/**
 	 * get active news item by SID
 	 *
 	 * @param integer $itemSID
 	 * @return boolean|array
 	 */
 	function getActiveItemBySID($itemSID)
 	{
 		$result = array_pop( SJB_DB::query("SELECT * FROM `news` WHERE `active` = 1 AND `sid` = ?n", $itemSID) );
 		if (empty($result)) {
 			return false;
 		}
 		
 		$upload_manager = new SJB_UploadFileManager();
 		
 		$result['image_link'] = '';
 		if (!empty($result['image'])) {
 			$result['image_link'] = $upload_manager->getUploadedFileLink($result['image']);
 		}
 			
 		return $result;
 	}
 	
 	
 	
 	//--------------  CATEGORIES METHODS ---------------//
 	
 	/**
 	 * Get all news categories list
 	 *
 	 */
 	public static function getCategories($langId = 'en')
 	{
 		$result     = SJB_DB::query("SELECT * FROM `news_categories` ORDER BY `order`");
 		$categories = array();
 		
 		if (empty($result)) {
 			return $categories;
 		}
 		
 		foreach ($result as $item) {
 			$articles = self::getActiveArticlesByCategorySid($item['id'], 'id', 'ASC', $langId);
 			$counter  = count($articles);
 			$categories[] = array(
 				'sid'  => $item['id'],
 				'name' => $item['name'],
 				'count' => $counter,
 			);
 		}
 		return $categories;
 	}
 	
 	
 	/**
 	 * Add new category in News Category list
 	 *
 	 * @param string $name
 	 * @return integer|false
 	 */
 	public static function addCategory($name)
 	{
 		$maxOrder = SJB_DB::query("SELECT MAX(`order`) FROM `news_categories`");
		$maxOrder = empty($max_order) ? 0 : array_pop(array_pop($max_order));
 		return SJB_DB::query("INSERT INTO `news_categories` SET `name` = ?s, `order` = ?n", $name, $maxOrder);
 	}
 	
 	/**
 	 * Rename category in News Category list
 	 *
 	 * @param integer $sid
 	 * @param string $name
 	 * @return unknown
 	 */
	public static function updateCategory($sid, $name)
 	{
 		return SJB_DB::query("UPDATE `news_categories` SET `name` = ?s WHERE `id` = ?n", $name, $sid);
 	}
 	
 	
 	/**
 	 * check exists category by name
 	 *
 	 * @param string $name
 	 * @return boolean
 	 */
 	public static function checkExistsCategoryName($name)
 	{
 		$result = SJB_DB::query("SELECT * FROM `news_categories` WHERE `name` = ?s LIMIT 1", $name);
 		if (empty($result)) {
 			return false;
 		}
 		return true;
 	}
 	
 	
 	/**
 	 * Delete category by SID
 	 *
 	 * @param integer $sid
 	 * @return unknown
 	 */
 	public static function deleteCategoryBySid($sid)
 	{
 		$category = self::getCategoryBySid($sid);
 		// DO NOT DELETE ARCHIVE!!!
 		if (!empty($category) && strtolower($category['name']) == 'archive') {
 			return false;
 		}
 		
 		// DELETE ALL NEWS BY THIS CATEGORY
 		SJB_DB::query("DELETE FROM `news` WHERE `category_id` = ?n", $sid);
 		
 		return SJB_DB::query("DELETE FROM `news_categories` WHERE `id` = ?n LIMIT 1", $sid);
 	}
 	
 	
 	/**
 	 * Get category data by SID
 	 *
 	 * @param integer $sid
 	 * @return array
 	 */
 	public static function getCategoryBySid($sid)
 	{
 		$result = SJB_DB::query("SELECT * FROM `news_categories` WHERE `id` = ?n LIMIT 1", $sid);
 		if (empty($result)) {
 			return false;
 		}
 		$result        = array_pop($result);
 		$result['sid'] = $result['id'];
 		
 		return $result;
 	}
 	
 	
 	/**
 	 * Get category data by category name
 	 *
 	 * @param string $name
 	 * @return array
 	 */
  	public static function getCategoryByName($name)
 	{
 		$result = SJB_DB::query("SELECT * FROM `news_categories` WHERE `name` = ?s LIMIT 1", $name);
 		if (empty($result)) {
 			return false;
 		}
 		$result        = array_pop($result);
 		$result['sid'] = $result['id'];
 		
 		return $result;
 	}
 	
 	
 	//-------------- ARTICLE METHODS -------------//
 	
  	 /**
 	 * get news item by SID
 	 *
 	 * @param integer $itemSID
 	 * @return boolean|array
 	 */
 	function getItemBySID($itemSID)
 	{
 		$result = array_pop( SJB_DB::query("SELECT * FROM `news` WHERE `sid` = ?n", $itemSID) );
 		if (empty($result)) {
 			return false;
 		}
 		return $result;
 	}
 	
 	
 	/**
 	 * Add new article.
 	 * Returns SID of posted article
 	 *
 	 * @param array $request
 	 * @return integer
 	 */
 	public static function addArticle($request)
 	{
 		$categorySid = SJB_Array::get($request, 'category_sid');
 		
		$title   = SJB_Array::get($request, 'article_title');
		$brief   = SJB_Array::get($request, 'article_brief');
		$text    = SJB_Array::get($request, 'article_text');
		$link    = SJB_Array::get($request, 'article_link');
		$pubDate = SJB_Array::get($request, 'article_publication_date');
		$expDate = SJB_Array::get($request, 'article_expiration_date');
		$active  = SJB_Array::get($request, 'article_active', 0);
		
		$articleLang = SJB_Array::get($request, 'article_language');
		if (empty($articleLang)) {
			$articleLang = 'en';
		}
		
		$i18n       = SJB_I18N::getInstance();
		$lang       = $i18n->getLanguageData($i18n->getCurrentLanguage());
		$dateFormat = $lang['date_format'];
		
		$active = self::needActivate($pubDate, $dateFormat);
		
		$link = self::prepareURL($link);
		
		$expDate = trim($expDate);
		if (empty($expDate)) {
			if (empty($pubDate)) {
	 			$result = SJB_DB::query("INSERT INTO `news` (`category_id`,`date`, `expiration_date`, `title`, `brief`,`text`, `active`, `link`, `lang`) 
	 					VALUES ( ?n, NOW(), NULL, ?s, ?s, ?s, ?n, ?s, ?s)", 
	 					$categorySid, $title, $brief, $text, $active, $link, $articleLang);
			} else {
				$result = SJB_DB::query("INSERT INTO `news` (`category_id`,`date`, `expiration_date`, `title`, `brief`,`text`, `active`, `link`, `lang`) 
	 					VALUES ( ?n, STR_TO_DATE(?s, '{$dateFormat}'), NULL, ?s, ?s, ?s, ?n, ?s, ?s)", 
	 					$categorySid, $pubDate, $title, $brief, $text, $active, $link, $articleLang);
			}
 		} else {
 			if (empty($pubDate)) {
	 			$result = SJB_DB::query("INSERT INTO `news` (`category_id`, `date`, `expiration_date`, `title`, `brief`, `text`, `active`, `link`, `lang`) 
	 					VALUES ( ?n, NOW(), STR_TO_DATE(?s, '{$dateFormat}'), ?s, ?s, ?s, ?n, ?s, ?s)", 
	 					$categorySid, $expDate, $title, $brief, $text, $active, $link, $articleLang);
 			} else {
 				$result = SJB_DB::query("INSERT INTO `news` (`category_id`, `date`, `expiration_date`, `title`, `brief`, `text`, `active`, `link`, `lang`) 
	 					VALUES ( ?n, STR_TO_DATE(?s, '{$dateFormat}'), STR_TO_DATE(?s, '{$dateFormat}'), ?s, ?s, ?s, ?n, ?s, ?s)", 
	 					$categorySid, $pubDate, $expDate, $title, $brief, $text, $active, $link, $articleLang);
 			}
 		}
 		return $result;
 	}
 	
 	
 	
  	/**
 	 * Update article.
 	 * Returns SID of posted article
 	 *
 	 * @param array $request
 	 * @return integer
 	 */
 	public static function updateArticle($request)
 	{
 		$categorySid = SJB_Array::get($request, 'category_sid');
 		$articleSid  = SJB_Array::get($request, 'article_sid');
 		
 		// selected category for article
 		$articleCategory = SJB_Array::get($request, 'article_category');
 		if (!empty($articleCategory) && is_numeric($articleCategory)) {
 			$categorySid = $articleCategory;
 		}
 		
			
		$title   = SJB_Array::get($request, 'article_title');
		$brief   = SJB_Array::get($request, 'article_brief');
		$text    = SJB_Array::get($request, 'article_text');
		$link    = SJB_Array::get($request, 'article_link');
		$pubDate = SJB_Array::get($request, 'article_publication_date');
		$expDate = SJB_Array::get($request, 'article_expiration_date');
		$active  = SJB_Array::get($request, 'article_active', 0);
		
 		$articleLang = SJB_Array::get($request, 'article_language');
		if (empty($articleLang)) {
			$articleLang = 'en';
		}
		
		$i18n       = SJB_I18N::getInstance();
		$lang       = $i18n->getLanguageData($i18n->getCurrentLanguage());
		$dateFormat = $lang['date_format'];
		
 		// if moved to archive - deactiveate it
 		$archive = self::getCategoryByName('Archive');
 		if ($archive['sid'] == $categorySid) {
 			$active = 0;
 		} else {
 			$active = self::needActivate($pubDate, $dateFormat);
 		}
		
		$link = self::prepareURL($link);
		
		$expDate = trim($expDate);
		if (empty($expDate)) {
			if (empty($pubDate)) {
	 			$result = SJB_DB::query("UPDATE `news` 
	 					SET `category_id`= ?n, `date` = NOW(), `expiration_date` = NULL, `title` = ?s, `brief` = ?s,`text` = ?s, `active` = ?n, `link` = ?s, `lang` = ?s 
	 					WHERE `sid` = ?n", 
	 					$categorySid, $title, $brief, $text, $active, $link, $articleLang, $articleSid);
			} else {
				$result = SJB_DB::query("UPDATE `news` 
						SET `category_id` = ?n, `date` = STR_TO_DATE(?s, '{$dateFormat}'), `expiration_date` = NULL, `title` = ?s, `brief` = ?s,`text` = ?s, `active` = ?n, `link` = ?s, `lang` = ?s 
						WHERE `sid` = ?n", 
	 					$categorySid, $pubDate, $title, $brief, $text, $active, $link, $articleLang, $articleSid);
			}
 		} else {
 			if (empty($pubDate)) {
	 			$result = SJB_DB::query("UPDATE `news` 
	 					SET `category_id` = ?n, `date` = NOW(), `expiration_date` = STR_TO_DATE(?s, '{$dateFormat}'), `title` = ?s, `brief` = ?s, `text` = ?s, `active` = ?n, `link` = ?s, `lang` = ?s 
	 					WHERE `sid` = ?n", 
	 					$categorySid, $expDate, $title, $brief, $text, $active, $link, $articleLang, $articleSid);
 			} else {
 				$result = SJB_DB::query("UPDATE `news` 
 						SET `category_id` = ?n, `date` = STR_TO_DATE(?s, '{$dateFormat}'), `expiration_date` = STR_TO_DATE(?s, '{$dateFormat}'), `title` = ?s, `brief` = ?s, `text` = ?s, `active` = ?n, `link` = ?s, `lang` = ?s 
 						WHERE `sid` = ?n", 
	 					$categorySid, $pubDate, $expDate, $title, $brief, $text, $active, $link, $articleLang, $articleSid);
 			}
 		}
 		return $result;
 	}
 	
 	
 	
 	/**
 	 * Move article to archive category
 	 *
 	 * @param integer $articleSid
 	 */
 	public static function moveArticleToArchiveBySid($articleSid)
 	{
 		$archiveCategory = self::getCategoryByName('Archive');
 		return SJB_DB::query("UPDATE `news` SET `category_id` = ?n, active = 0 WHERE `sid` = ?n", $archiveCategory['sid'], $articleSid);
 	}
 	
 	
 	/**
 	 * Move article to category
 	 *
 	 * @param integer $articleSid
 	 * @param integer $categorySid
 	 */
 	public static function moveArticleToCategoryBySid($articleSid, $categorySid)
 	{
 		return SJB_DB::query("UPDATE `news` SET `category_id` = ?n WHERE `sid` = ?n", $categorySid, $articleSid);
 	}
 	
 	
 	/**
 	 * Get all articles by category ID
 	 *
 	 * @param integer $categorySid
 	 * @return null|array
 	 */
 	public static function getArticlesByCategorySid($categorySid, $sortingField = 'id', $sortingOrder = 'ASC', $lang = 'en')
 	{
 		if ($sortingField == 'id') {
 			$sortingField = 'sid';
 		}
 		if ($sortingOrder != 'ASC' && $sortingOrder != 'DESC') {
 			$sortingOrder = 'ASC';
 		}
 		
 		$result = SJB_DB::query("SELECT * FROM `news` WHERE `category_id` = ?n ORDER BY `{$sortingField}` {$sortingOrder}", $categorySid);
 		if (empty($result)) {
 			return null;
 		}
 		
 		return $result;
 	}
 	
 	
  	/**
 	 * Get all active articles by category ID
 	 *
 	 * @param integer $categorySid
 	 * @return null|array
 	 */
 	public static function getActiveArticlesByCategorySid($categorySid, $sortingField = 'id', $sortingOrder = 'ASC', $lang = 'en')
 	{
 		if ($sortingField == 'id') {
 			$sortingField = 'sid';
 		}
 		if ($sortingOrder != 'ASC' && $sortingOrder != 'DESC') {
 			$sortingOrder = 'ASC';
 		}
 		
 		$result = SJB_DB::query("SELECT * FROM `news` WHERE `category_id` = ?n AND `active` = 1 AND `lang` = ?s ORDER BY `{$sortingField}` {$sortingOrder}", $categorySid, $lang);
 		if (empty($result)) {
 			return null;
 		}
 		
 		return $result;
 	}
 	
 	
 	/**
 	 * Check URL, and add http, if need
 	 *
 	 * @param string $link
 	 */
 	public static function prepareURL($link)
 	{
 		if (empty($link)) {
 			return '';
 		}
 		
 		$regex = "|http://(.*)|";
 		if ( preg_match($regex, $link) ) {
 			return $link;
 		}
 		return 'http://' . $link;
 	}
 	
 	
 	
  	/**
 	 * Get image ID by news sid
 	 *
 	 * @param integer $newsSID
 	 * @return string|false
 	 */
 	public static function getImageFileIDByArticleSID($articleSID)
 	{
 		$result = SJB_DB::query("SELECT `image` FROM `news` WHERE `sid` = ?n", $articleSID);
 		if (empty($result)) {
 			return false;
 		}
 		return $result[0]['image'];
 	}
 	
 	
 	
 	/**
 	 * Count articles found by text
 	 *
 	 * @param string $text
 	 * @param string $lang
 	 * @return integer
 	 */
 	public static function getAllNewsCountBySearchText($text, $lang = 'en', $active = false)
 	{
 		$text   = SJB_DB::quote($text);
 		if ($active) {
 			$result = SJB_DB::query("SELECT count(*) as count FROM `news` WHERE (`brief` LIKE '%{$text}%' OR `text` LIKE '%{$text}%') AND `lang` = ?s AND `active` = 1 ORDER BY `date` ASC", $lang);
 		} else {
 			$result = SJB_DB::query("SELECT count(*) as count FROM `news` WHERE (`brief` LIKE '%{$text}%' OR `text` LIKE '%{$text}%') AND `lang` = ?s ORDER BY `date` ASC", $lang);
 		}
 		
 		if (empty($result)) {
 			return 0;
 		}
 		
 		$result = array_pop($result);
 		return $result['count'];
 	}
 	
 	
 	
 	/**
 	 * Get articles by search text
 	 *
 	 * @param string $text
 	 * @return array
 	 */
 	public static function searchArticles($text, $lang = 'en', $active = false)
 	{
 		$text   = SJB_DB::quote($text);
 		if ($active) {
 			$result = SJB_DB::query("SELECT * FROM `news` WHERE (`brief` LIKE '%{$text}%' OR `text` LIKE '%{$text}%') AND `lang` = ?s AND `active` = 1 ORDER BY `date` ASC", $lang);
 		} else {
 			$result = SJB_DB::query("SELECT * FROM `news` WHERE (`brief` LIKE '%{$text}%' OR `text` LIKE '%{$text}%') AND `lang` = ?s ORDER BY `date` ASC", $lang);
 		}
 		if (empty($result)) {
 			return array();
 		}
 		return $result;
 	}
 	
 	
 	
 	/**
 	 * check date.
 	 * If date in past (relative to current time) - return true
 	 * Otherwise - return false
 	 *
 	 * @param string $date
 	 * @param string $dateFormat
 	 * @return boolean
 	 */
 	public static function needActivate($date, $dateFormat)
 	{
 		$currentTimestamp = time();
 		
 		$parseDate = strptime($date, $dateFormat);
		$timestamp = mktime($parseDate['tm_hour'], $parseDate['tm_min'], $parseDate['tm_sec'], ($parseDate['tm_mon'] + 1), $parseDate['tm_mday'], ($parseDate['tm_year'] + 1900) );
		
		if ($currentTimestamp > $timestamp) {
			return true;
		}
		return false;
 	}
 	
 	
 	
 	function moveUpCategoryBySID($sid)
 	{
		$category_info = SJB_DB::query("SELECT * FROM `news_categories` WHERE  id = ?n", $sid);
		if (empty($category_info))
		    return false;
		$category_info = array_pop($category_info);
		$current_order = $category_info['order'];
		$up_order = SJB_DB::query("SELECT MAX(`order`) FROM `news_categories` WHERE `order` < ?n", 
								$current_order);
		$up_order = array_pop(array_pop($up_order));
		if ($up_order == 0)
		    return false;
		SJB_DB::query("UPDATE `news_categories` SET `order` = ?n WHERE `order` = ?n", 
					$current_order, $up_order);
		SJB_DB::query("UPDATE `news_categories` SET `order` = ?n WHERE id = ?n", $up_order, $sid);
		return true;
	}
	
	function moveDownCategoryBySID($sid)
	{
		$category_info = SJB_DB::query("SELECT * FROM `news_categories` WHERE id = ?n", $sid);
		if (empty($category_info))
		    return false;
		$category_info = array_pop($category_info);
		$current_order = $category_info['order'];
		$less_order = SJB_DB::query("SELECT MIN(`order`) FROM `news_categories` WHERE `order` > ?n", 
								$current_order);
		$less_order = array_pop(array_pop($less_order));
		if ($less_order == 0)
		    return false;
		SJB_DB::query("UPDATE `news_categories` SET `order` = ?n WHERE `order` = ?n",
					$current_order, $less_order);
		SJB_DB::query("UPDATE `news_categories` SET `order` = ?n WHERE id = ?n", $less_order, $sid);
		return true;
	}
	
 }