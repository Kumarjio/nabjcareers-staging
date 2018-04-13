<?PHP
/**
 * @package ContentManagement
 * @subpackage StaticPages
 */

/**
 * getting information about static pages
 *
 * Function gets information about static pages and returns it as array
 *
 * @return mixed it can be array (information about pages) or bool (only 'false' if operation has fallen)
 */
function getStaticContents() {
	$sql = "SELECT * FROM `stat_pages`";
	if (!$res = mysql_query ($sql))
		return false;
	$pages = array ();
	while ($row = mysql_fetch_assoc ($res))
		$pages[$row['sid']] = $row;
	return $pages;
}
/**
 * getting information about static page
 *
 * Function gets information about static page and retunrs it as array
 *
 * @param integer $page_id ID of page
 * @return mixed it can be array (information about page) or bool (only 'false' if operation has fallen)
 */
function getStaticContent($page_sid) {
	
	$sql = "SELECT * FROM `stat_pages` WHERE `sid` = '".mysql_real_escape_string ($page_sid)."'" ;
	if (!$res = mysql_query ($sql))
		return false;
	$page = mysql_fetch_assoc ($res);
	return $page;
}

function getStaticContentByIDAndLang($page_id, $lang) {
	
	$sql = "SELECT * FROM `stat_pages` WHERE `id` = '".mysql_real_escape_string ($page_id)."' AND `lang` = '".mysql_real_escape_string ($lang)."'" ;
	if (!$res = mysql_query ($sql))
		return false;
	$page = mysql_fetch_assoc ($res);
	return $page;
}
/**
 * adding new static page
 *
 * Function creates static pages
 *
 * @param string $name name of page
 * @param string $url URL of page
 * @return bool 'true' if operation succeeded or 'false' otherwise
 */
function addStaticContent($contentInfo) {
	$page_id= $contentInfo['id'];
	$name 	= $contentInfo['name'];
	$lang   = $contentInfo['lang'];
	if (empty ($name))
		return false;
	$sql = SJB_DB::query ("INSERT INTO `stat_pages` (`name`, `id`, `lang`) VALUES (?s, ?s, ?s)",
			$name, $page_id, $lang);
	return $sql;
}

/**
 * deleting static page
 *
 * Function removes static page by ID of it
 *
 * @param integer $page_id ID of page
 * @return bool 'true' if operation succeeded or 'false' otherwise
 */
function deleteStaticContent($page_sid) {
	$sql = "DELETE FROM `stat_pages` WHERE `sid`='".mysql_real_escape_string ($page_sid)."'" ;
	if (!mysql_query ($sql))
		return false;
	return true;
}

/**
 * changing information about static page
 *
 * Function changes information about static page by ID of it
 *
 * @param integer $page_id ID of page
 * @param string $name name of page
 * @param string $url URL of page
 * @return bool 'true' if operation succeeded or 'false' otherwise
 */
function changeStaticContent($contentInfo, $page_sid) {
	$page_id  = $contentInfo['id'];
	$name	  = $contentInfo['name'];
	$content  = $contentInfo['content'];
	$lang     = $contentInfo['lang'];
	
	return SJB_DB::query ("UPDATE `stat_pages` SET `name`=?s, `id`=?s, `content`=?s, `lang`=?s WHERE `sid`=?s",
			$name, $page_id, $content, $lang, $page_sid);
}

