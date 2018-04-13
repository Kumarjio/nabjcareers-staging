<?php

require_once ("private_message/private_message.php");

$tp = SJB_System::getTemplateProcessor ();

if (SJB_UserManager::isUserLoggedIn ()) {
	
	$user_id = SJB_UserManager::getCurrentUserSID();
	
	if (isset ( $_POST ['pm_action'] ) && ! empty ( $_POST ['pm_action'] )) {
		$checked = (isset ( $_POST ['pm_check'] ) ? $_POST ['pm_check'] : array ());
		
		switch ($_POST ['pm_action']) {
			case 'mark':
				SJB_PrivateMessage::markAsRead ( $checked );
				break;
			
			case 'delete':
				SJB_PrivateMessage::delete( $checked );
				break;
			
			default :
				break;
		}
	}
	
	$page      = SJB_Request::getInt('page', 1, 'GET');
	$per_page  = 10;
	$total     = SJB_PrivateMessage::getTotalInbox($user_id);
	$max_pages = ceil($total / $per_page);
	
	if ($max_pages == 0) {
		$max_pages = 1;
	}
	if ($max_pages < $page) {
		SJB_HelperFunctions::redirect("?page={$max_pages}");
	}
	$navigate = SJB_PrivateMessage::getNavigate ($page, $total ,$per_page);

	$tp->assign ( 'message_list', SJB_PrivateMessage::getListInbox ($user_id, $page, $per_page) );
	$tp->assign ( 'navigate', $navigate );
	$tp->assign ( 'include', 'list_inbox.tpl' );
	
	$tp->assign ( 'unread', SJB_PrivateMessage::getCountUnreadMessages ($user_id) );
}

$tp->display ( 'main.tpl' );
