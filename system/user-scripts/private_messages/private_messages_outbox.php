<?php
require_once ("private_message/private_message.php");

$tp = SJB_System::getTemplateProcessor ();

if (SJB_UserManager::isUserLoggedIn ()) {
	
	$user_id = SJB_UserManager::getCurrentUserSID();
	
	if (isset ( $_POST ['pm_action'] ) && $_POST ['pm_action'] == 'delete') {
		$checked = (isset ( $_POST ['pm_check'] ) ? $_POST ['pm_check'] : array ());
		SJB_PrivateMessage::delete ( $checked );
	}
	
	$page      = (isset ( $_GET ['page'] ) ? intval ( $_GET ['page'] ) : 1);
	$per_page  = 10;
	$total     = SJB_PrivateMessage::getTotalOutbox($user_id);
	$max_pages = ceil($total / $per_page);
	
	if ($max_pages == 0) {
		$max_pages = 1;
	}
	if ($max_pages < $page) {
		SJB_HelperFunctions::redirect("?page={$max_pages}");
	}
	$navigate = SJB_PrivateMessage::getNavigate ($page, $total ,$per_page);
	
	$list = SJB_PrivateMessage::getListOutbox ($user_id, $page, $per_page);
	
	$tp->assign ( "message_list", $list );
	$tp->assign ( "navigate", $navigate );
	$tp->assign ( "include", 'list_outbox.tpl' );
	
	$tp->assign ( "unread", SJB_PrivateMessage::getCountUnreadMessages ($user_id) );
}

$tp->display ( 'main.tpl' );
