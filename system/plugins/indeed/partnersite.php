<?php
require_once 'Zend/Http/Client.php';

$tp = SJB_System::getTemplateProcessor();
$action = SJB_Request::getVar('action');
$request = $_REQUEST;
unset($request['action']);
switch ($action) {
	case 'header':
		$test = $tp->fetch("../../../system/plugins/indeed/header.tpl");
		echo $test;exit();
		break;
	default:
		$tp->assign('query', http_build_query($request));
		$tp->display("../../../system/plugins/indeed/partnersite.tpl");
		break;
}



