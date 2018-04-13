<?php
require_once 'classifieds/Listing/ListingManager.php';
require_once 'comments/Comment/CommentManager.php';
require_once ('rating/Rating.php');

$action = (isset ( $_POST ['action'] ) ? $_POST ['action'] : '');

switch ($action) {
	case 'rate' :
		jsRate ();
		break;
	case 'comment' :
		add_comment ();
		break;
	case 'email' :
		send_mail ();
		break;
	default :
		exit ();
}
exit ();

function add_comment() {
	$last = 1;
	$message = (isset ( $_POST ['message'] ) ? htmlspecialchars ( $_POST ['message'] ) : '');
	$listing_id = (isset ( $_POST ['listing'] ) ? intval ( $_POST ['listing'] ) : 0);
	
	$template_processor = SJB_System::getTemplateProcessor ();
	$user_id = 0;
	
	if (SJB_UserManager::isUserLoggedIn ()) {
		$user_info = SJB_UserManager::getCurrentUserInfo ();
		$user_id = $user_info ['sid'];
	}
	
	if (isset ( $_REQUEST ['post_id'] ))
		$_REQUEST ['post_id'] = intval ( $_REQUEST ['post_id'] );
		else $_REQUEST ['post_id'] = 0;
	
	$comment = new SJB_Comment ( array_merge ( array ('message' => $message ), array ('user_id' => $user_id ) ), $listing_id );
	
	SJB_CommentManager::saveComment ( $comment );
	
	$comment_id = $comment->getSID ();
	
	$comment_array = array ('id' => $comment_id, 'message' => $message, 'user' => array ('email' => $user_info ['email'], 'user_name' => $user_info ['username'] ), 'added' => date ( 'd.m.Y H:M' ) );
	
	/*require_once 'miscellaneous/Notifications.php';
	Notifications::sendNewCommentAddedLetter($id, $comment_id);
	*/
	
	$template_processor->assign ( 'iteration_last', $last );
	$template_processor->assign ( 'comment', $comment_array );
	ob_start ();
	
	$template_processor->display ( '../classifieds/listing_comments_item.tpl' );
	$form = ob_get_clean ();
	
	echo $form;
}

function jsRate() {
	
	$template_processor = SJB_System::getTemplateProcessor ();
	$listing_sid = (isset ( $_POST ['listing'] ) ? intval ( $_POST ['listing'] ) : 0);
	$rate = (isset ( $_POST ['rate'] ) ? intval ( $_POST ['rate'] ) : 0);
	
	if (! SJB_UserManager::isUserLoggedIn ())
		exit ();
	
	$user_info = SJB_UserManager::getCurrentUserInfo ();
	$user_id = $user_info ['sid'];
	
	$new_rating = SJB_Rating::setRaiting ( $rate, $listing_sid, $user_id );
	
	if (isset ( $new_rating ['rating'] )) {
		echo $new_rating ['rating'];
	}

}

function send_mail() {
	$count = isset ( $_GET ['count'] ) ? $_GET ['count'] : 10;
	$mail_list = SJB_DB::query ( "SELECT * FROM mailing" );
	foreach ( $mail_list as $key => $var ) {
		$c = 0;
		foreach ( $mail_list [$key] ['mail_arr'] as $i => $val ) {
			$mail = new PHPMailer ( );
			$mail->MsgHTML ( $mail_list [$key] ['text'] );
			$mail->From = $from_email;
			$mail->Subject = $mail_list [$key] ['subject'];
			
			$email_res = SJB_DB::query ( 'SELECT email FROM users WHERE sid=' . $mail_list [$key] ['mail_arr'] [$i] );
			
			$mail->AddAddress ( $email_res [0] ['email'] );
			
			if ($mail_list [$key] ['file'])
				$mail->AddAttachment ( $mail_list [$key] ['file'] );
			
			if ($mail->Send ())
				unset ( $mail_list [$key] ['mail_arr'] [$i] );
		
		}
		if (count ( $mail_list [$key] ['mail_arr'] ) == 0) {
			SJB_DB::query ( 'DELETE FROM mailing WHERE id=' . $mail_list [$key] ['id'] );
		} else {
			SJB_DB::query ( "UPDATE mailing SET email = '" . serialize ( $mail_list [$key] ['mail_arr'] ) . "' WHERE id =" . $mail_list [$key] ['id'] . "  LIMIT 1 " );
		}
	}
	exit ();
}

