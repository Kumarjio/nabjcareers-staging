<?php

require_once ("private_message/private_message.php");

$tp = SJB_System::getTemplateProcessor ();

if ( SJB_UserManager::isUserLoggedIn() ) {
	
	$user_id = SJB_UserManager::getCurrentUserSID();
	
	$unread  = SJB_PrivateMessage::getCountUnreadMessages ($user_id);
	
	$tp->assign ( 'unread', $unread );
	$tp->assign ( 'include', '' );
}

$tp->display ( 'main.tpl' );
