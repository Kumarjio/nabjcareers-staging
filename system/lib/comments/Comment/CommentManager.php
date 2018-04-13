<?php

require_once 'orm/ObjectManager.php';
require_once 'comments/Comment/Comment.php';
require_once 'comments/Comment/CommentDBManager.php';
require_once 'comments/CommentsTree.php';
require_once 'users/User/UserManager.php';

class SJB_CommentManager extends SJB_ObjectManager
{
	function saveComment($comment)
	{
		return SJB_CommentDBManager::saveComment($comment);
	}
	
	function deleteComment($comment)
	{
		return SJB_CommentDBManager::deleteComment($comment);
	}
	
	public static function getCommentsNumToListing($listing_sid)
	{
		return SJB_CommentDBManager::getCommentsNumToListing($listing_sid);
	}
	
	function getEnabledCommentsToListing($listing_sid)
	{
		$comments_raw = SJB_CommentDBManager::getEnabledCommentsToListing($listing_sid);
		return SJB_CommentManager::getCommentsInfo($comments_raw);
	}
	
	function getCommentsToListing($listing_sid)
	{
		$comments_raw = SJB_CommentDBManager::getCommentsToListing($listing_sid);
		return SJB_CommentManager::getCommentsInfo($comments_raw);
	}	
	
	function getCommentsInfo($raw_comments)
	{
		$comments_tree = new SJB_CommentsTree($raw_comments);
		$comments_tree->build();
		$comments_to_listing = $comments_tree->toArray();
		$comments = array();
		foreach ($comments_to_listing as $comment)
		{
			if (intval($comment['user_id']) > 0)
			{
				$user = SJB_UserManager::getObjectBySID($comment['user_id']);
				$comment['user'] = SJB_UserManager::createTemplateStructureForUser($user);
			}
			$comment['added'] = strtotime($comment['added']);
			$comments[] = $comment;
		} 
		return $comments;
	}
	
	function getListingSIDByCommentSID($comment_sid)
	{
		return SJB_CommentDBManager::getListingSIDByCommentSID($comment_sid);
	}
	
	function enableComment($comment_id)
	{
		SJB_CommentDBManager::setDisabled(false, $comment_id);
	}
	
	function disableComment($comment_id)
	{
		SJB_CommentDBManager::setDisabled(true, $comment_id);
	}
	
	function deleteCommentsToListing($listing_sid)
	{
		SJB_CommentDBManager::deleteCommentsToListing($listing_sid);
	}  
}
