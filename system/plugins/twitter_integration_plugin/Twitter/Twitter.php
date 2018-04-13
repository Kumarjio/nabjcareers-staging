<?php

require_once('orm/Object.php');
require_once('orm/ObjectDBManager.php');
require_once('TwitterDetails.php');

class SJB_Twitter extends SJB_Object
{
	public $details = null;
	public $common_fields;
	
	function SJB_Twitter($info = array()) 
	{
		$this->db_table_name = 'twitter';
		$this->details = new SJB_TwitterDetails($info);
		$this->common_fields =  SJB_TwitterDetails::getCommonFields();
	}
	
	public static function saveFeed($feed)
	{
		SJB_ObjectDBManager::saveObject('twitter', $feed);
	}
	
	public static function getFeedInfoBySID($sid)
	{
		$feed_info = SJB_ObjectDBManager::getObjectInfo('twitter', $sid);
		if (empty($feed_info))
			return null;
		$feed_info['id'] = $feed_info['sid'];
		return $feed_info;
	}

	public static function getAllFeeds()
    {
		return SJB_DB::query('SELECT `t`.*, `lt`.`id` as `listing_type` FROM `twitter` `t` INNER JOIN `listing_types` `lt` ON `lt`.`sid` = `t`.`listing_type_sid`');
	}
	
	public static function deleteFeed($sid)
    {
		return SJB_ObjectDBManager::deleteObject('twitter', $sid);
	}

	public static function updateFeedToken($sid, $token)
	{
		SJB_DB::query('UPDATE `twitter` SET `access_token` = ?s WHERE `sid` = ?n', serialize($token), $sid);
	}
}