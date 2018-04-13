<?php

require_once 'users/User/UserManager.php';
require_once 'comments/Comment/CommentManager.php';

$listing_id = SJB_Request::getVar('listing_id', null);
$tp = SJB_System::getTemplateProcessor();

if (isset($_REQUEST['action'])) {
	$action = strtolower($_REQUEST['action']);
	
	$comment_id = SJB_Request::getVar('comment_id', null);
	if (is_null($listing_id) && !is_null($comment_id))
		$listing_id = SJB_CommentManager::getListingSIDByCommentSID($comment_id);

	$comment_ids = array();
	if (isset($_REQUEST['comment']) && is_array($_REQUEST['comment']))
		$comment_ids = array_keys($_REQUEST['comment']);
	else
		$comment_ids = array($comment_id);

	switch ($action) {
    	case 'delete':
    		foreach ($comment_ids as $comment_id)
    			SJB_CommentManager::deleteComment($comment_id);
    		break;
    	case 'disable':
    		foreach ($comment_ids as $comment_id)
    			SJB_CommentManager::disableComment($comment_id);
    		break;
    	case 'enable':
    		foreach ($comment_ids as $comment_id)
    			SJB_CommentManager::enableComment($comment_id);
    		break;
    	case 'edit':
    		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    			SJB_DB::query("UPDATE `comments` SET `message` = ?s WHERE `sid` = ?n", $_REQUEST['message'], $comment_id);
    		}
    		else {
    			$tp->assign('comment', SJB_CommentManager::getObjectInfoBySID('comments', $comment_id));
    			$tp->display('edit_comment.tpl');
    			return;
    		}
    		break;
	}
	
	header('Location: ' . SJB_System::getSystemSettings('SITE_URL') . '/listing-comments/?listing_id=' . $listing_id);
	exit;
}

if (!is_null($listing_id) && SJB_Settings::getSettingByName('show_comments') == 1) {
	$comments = SJB_CommentManager::getCommentsToListing($listing_id);
	
	$tp->assign('comments', $comments);
	$tp->assign('comments_num', count($comments));
	$tp->assign('listing_id', $listing_id);
	
	$tp->display('listing_comments.tpl');
}
