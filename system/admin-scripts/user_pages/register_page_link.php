<?php


function array2String($params) {
	if (empty ($params))
		return false;
	$result = false;
	foreach ($params as $key => $value)
		$result .= $key.'='.$value."\r\n";
	return substr ($result, 0, strlen($result) - 2);
}

if (isset($_REQUEST['pageInfo'])) {
	$_REQUEST['pageInfo']['parameters'] = array2String($_REQUEST['pageInfo']['parameters']);
	$template_processor = SJB_System::getTemplateProcessor();
	$template_processor->assign('pageInfo', $_REQUEST['pageInfo']);
	$template_processor->assign('caption', $_REQUEST['caption']);
	$template_processor->display('register_page_link.tpl');
}

