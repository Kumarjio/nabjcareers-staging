<?php
require_once ("private_message/private_message.php");

	$tp = SJB_System::getTemplateProcessor ();

	$user = SJB_UserManager::getUserInfoByUserName($_GET["username"]);
	$user_id = $user['sid'];
	
	if (isset($_POST['pm_action']) && $_POST['pm_action'] == 'delete'){
		$checked = (isset ( $_POST ['pm_check'] ) ? $_POST ['pm_check'] : array ());
		SJB_PrivateMessage::delete($checked);
	}
	
	$page = (isset($_GET['page'])?intval($_GET['page']):1);
	$per_page = 10;
	$total = SJB_PrivateMessage::getTotalOutbox($user_id);
	$max_pages = ceil($total / $per_page);
	if ($max_pages == 0) $max_pages = 1;
	if ($max_pages < $page) SJB_HelperFunctions::redirect("?username={$_GET["username"]}&user_group_id={$_GET["user_group_id"]}&user_sid={$_GET["user_sid"]}&page={$max_pages}");
	$navigate = SJB_PrivateMessage::getNavigate ($page, $total ,$per_page);
	
	$list = SJB_PrivateMessage::getListOutbox($user_id, $page, $per_page);
	
	$tp->assign("username", $_GET["username"]);
	$tp->assign("message", $list);
	$tp->assign("navigate", $navigate);
	$tp->assign("page", $page);
	$tp->assign("user_group_id", $_GET["user_group_id"]);
	$tp->assign("user_sid", $_GET["user_sid"]);
	$tp->display ( 'pm_outbox.tpl' );


