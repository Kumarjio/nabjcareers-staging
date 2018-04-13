<?php
require_once ("private_message/private_message.php");

	$tp = SJB_System::getTemplateProcessor ();

	$user = SJB_UserManager::getUserInfoByUserName($_REQUEST["username"]);
	$user_id = $user['sid'];
	
	$total_in = SJB_PrivateMessage::getTotalInbox($user_id);
	$total_out = SJB_PrivateMessage::getTotalOutbox($user_id);
	
	$tp->assign("username", $_REQUEST["username"]);
	$tp->assign("user_group_id", $_REQUEST["user_group_id"]);
	$tp->assign("user_sid", $_REQUEST["user_sid"]);
	$tp->assign("total_in", $total_in);
	$tp->assign("total_out", $total_out);

	$tp->display ( 'main.tpl' );


