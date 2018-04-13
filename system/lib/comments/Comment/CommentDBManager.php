<?php

require_once 'orm/ObjectDBManager.php';

class SJB_CommentDBManager extends SJB_ObjectDBManager
{
	function saveComment($comment)
	{
		parent::saveObject('comments', $comment);
		
		SJB_DB::query("UPDATE `comments` SET `listing_id` = ". $comment->listing_id .", `added` = NOW() WHERE `sid` = ?n", $comment->getSID());
	}
	
	function deleteComment($comment)
	{
		parent::deleteObject('comments', $comment);
	}
	
	public static function getCommentsNumToListing($listing_sid)
	{
		$result = SJB_DB::query("SELECT COUNT(*) AS `num` FROM `comments` WHERE `listing_id` = ?n", $listing_sid);
		$row = array_shift($result);
		return $row['num'];
	}
	
	function getCommentSIDsByListingSID($listing_sid)
	{
		$ids = SJB_DB::query("SELECT `sid` FROM `comments` WHERE `listing_id` = ?n", $listing_sid);
		$sid_collection = array();
		foreach ($ids as $id)
			$sid_collection[] = $id['sid'];
		return $sid_collection;
	}
	
	function getEnabledCommentSIDsByListingSID($listing_sid, $enabled = false)
	{
		$ids = SJB_DB::query("SELECT `sid` FROM `comments` WHERE `listing_id` = ?n AND `disabled` <> '1' ORDER BY `added` ASC", $listing_sid);
		
		$sid_collection = array();
		foreach ($ids as $id)
			$sid_collection[] = $id['sid'];
		return $sid_collection;
	}
	
	function getCommentsInfoBySIDCollection($sid_collection)
	{
		$comments = array();
		foreach ($sid_collection as $comment_sid) {
			$comment = parent::getObjectInfo("comments", $comment_sid);
			$comment['id'] = $comment['sid'];
			$comments[] = $comment;
		}
		return $comments;
	}
	
	function getCommentsToListing($listing_sid)
	{
		$sid_collection = SJB_CommentDBManager::getCommentSIDsByListingSID($listing_sid);
		return SJB_CommentDBManager::getCommentsInfoBySIDCollection($sid_collection);
	}
	
	function getEnabledCommentsToListing($listing_sid)
	{
		$sid_collection = SJB_CommentDBManager::getEnabledCommentSIDsByListingSID($listing_sid);
		return SJB_CommentDBManager::getCommentsInfoBySIDCollection($sid_collection);
	}
	
	function getListingSIDByCommentSID($comment_sid)
	{
		$result = SJB_DB::query("SELECT `listing_id` FROM `comments` WHERE `sid` = ?n", $comment_sid);
		$row = array_shift($result);
		return $row['listing_id'];
	}
	
	function setDisabled($value, $comment_sid)
	{
		SJB_DB::query("UPDATE `comments` SET `disabled` = ?n WHERE `sid` = ?n", $value, $comment_sid);
	}
	
	function deleteCommentsToListing($listing_sid)
	{
		$comments = SJB_CommentDBManager::getCommentsToListing($listing_sid);
		foreach ($comments as $comment)
			SJB_CommentDBManager::deleteComment($comment);
	}
}
