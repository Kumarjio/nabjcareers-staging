<?php
require_once ("private_message/private_message.php");

$tp = SJB_System::getTemplateProcessor ();

$action = (isset ( $_GET ['action'] ) ? $_GET ['action'] : '');
$mess_id = (isset ( $_GET ['mess'] ) ? intval ( $_GET ['mess'] ) : 0);
$return_to = (isset ( $_GET ['from'] ) ? $_GET ['from'] : 'in');
$page = (isset ( $_GET ['page'] ) ? $_GET ['page'] : 1);


$user = SJB_UserManager::getUserInfoByUserName ( $_REQUEST ["username"] );
$user_id = $user ['sid'];

if ($action == 'delete') {
	SJB_DB::query ( "DELETE FROM private_message WHERE id='{$mess_id}'" );
	
	$per_page = 10;
	if ($return_to == 'in') $total = SJB_PrivateMessage::getTotalInbox($user_id);
	else $total = SJB_PrivateMessage::getTotalOutbox($user_id);
	$max_pages = ceil($total / $per_page);
	if ($max_pages == 0) $max_pages = 1;
	if ($max_pages < $page) $page = $max_pages;
	
	$site_url = SJB_System::getSystemSettings ( "SITE_URL" );
	SJB_HelperFunctions::redirect ( $site_url . "/private-messages/pm-".($return_to=='in'?'inbox':'outbox')."/?username={$_REQUEST['username']}&user_group_id={$_REQUEST['user_group_id']}&user_sid={$_REQUEST['user_sid']}&page={$page}" );
}

$message = SJB_PrivateMessage::ReadMessage ( $mess_id, true );

$tp->assign ( "returt_to", $return_to );
$tp->assign ( "username", $_REQUEST ["username"] );
$tp->assign ( "message", $message );
$tp->assign ( "page", $page );
$tp->assign("user_group_id", $_REQUEST["user_group_id"]);
$tp->assign("user_sid", $_REQUEST["user_sid"]);

$tp->display ( 'pm_read.tpl' );

