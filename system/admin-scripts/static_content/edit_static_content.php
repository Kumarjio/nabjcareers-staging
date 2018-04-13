<?PHP

include_once ('static_content/static_content.php');
require_once('miscellaneous/StaticContentAuxil.php');

$template_processor = SJB_System::getTemplateProcessor ();
$errors = '';

if (!isset ($_REQUEST['name']))
	$_REQUEST['name'] = '';
if (!isset ($_REQUEST['lang']))
	$_REQUEST['lang'] = '';
	
$action = SJB_Request::getVar('action', '');

if ($action == 'add') {
	if ( ($error = SJB_StaticContent::isValidNameID($_REQUEST['name'], $_REQUEST['page_id'])) == '' ) {
		if (!getStaticContentByIdAndLang($_REQUEST['page_id'],$_REQUEST['lang']) ) {
			$contentInfo = array(
				'id'	=>	$_REQUEST['page_id'],
				'name'	=>	$_REQUEST['name'],
				'lang'	=>	$_REQUEST['lang'],
				);
			if (addStaticContent ($contentInfo))
				SJB_HelperFunctions::redirect ('');
			else
				$errors = SJB_StaticContent::warning ("Error", "Cannot add new static page");
		} else
			$errors = SJB_StaticContent::warning ("Error", "Dublicate pare ID and Language. Please specify another ID or/and Language");
	} else
		$errors = SJB_StaticContent::warning ("Error", $error);
}


if ($action == 'change') {
	//if ( ($error = isValidNameID ($_REQUEST['name'], $_REQUEST['page_id'])) == '') {
	
	$staticContent = getStaticContentByIDAndLang ($_REQUEST['page_id'], $_REQUEST['lang']);
	
	if ((!$staticContent) || ($staticContent['sid']==$_REQUEST['page_sid']))
	{
		$contentInfo = array(
			'id'		=> $_REQUEST['page_id'],
			'name'		=> $_REQUEST['name'],
			'content'	=> $_REQUEST['content'],
			'lang'	=>	$_REQUEST['lang'],
			);

		if (changeStaticContent ($contentInfo, $_REQUEST['page_sid']) )
			SJB_HelperFunctions::redirect ('');
		else
			$errors = SJB_StaticContent::warning("Error","Cannot update page");
	} else
		$errors = SJB_StaticContent::warning("Error", "Dublicate pare ID and Language. Please specify another ID or/and Language");

		
	$action = 'edit';
}


if ($action == 'delete') {
	if (deleteStaticContent($_REQUEST['page_sid']))
		SJB_HelperFunctions::redirect ('');
	$errors = SJB_StaticContent::warning ("Error", "Cannot delete static page");
}

$page_title = 'Static Content';
if ($action == 'edit') {
	$page = getStaticContent($_REQUEST['page_sid']);
	
	
	$template_processor->assign ("page", array_map("htmlspecialchars", $page));
	$result = $template_processor->fetch("header_static_content.tpl");

	$pageInfo = array(
		'module'	=> 'static_content',
		'function'	=> 'show_static_content',
		'parameters'	=> array ('pageid' => $_REQUEST['pageid']),
		);
	$result .= SJB_System::executeFunction ('user_pages', 'register_page_link', array ('pageInfo'=>$pageInfo,
			'caption'=>'Content'));

	$template_processor->assign ("page_content", $page["content"]);
	$template_processor->assign ("page_sid", $_REQUEST['page_sid']);
	
	$template_processor->assign ("page", $page);
	
	$template_processor->assign ("error", $errors);
	$result .= $template_processor->fetch ("static_content_change.tpl");
	echo $result;
	return;
}


$pages = getStaticContents ();

$template_processor->assign ("pages", $pages);
$template_processor->assign ("error", $errors);
$template_processor->display ("static_content.tpl");
