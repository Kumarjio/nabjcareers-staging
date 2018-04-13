<?php

require_once('plugins/PluginAbstract.php');
require_once('Twitter/Twitter.php');

class TwitterIntegrationPlugin extends SJB_PluginAbstract
{

	function pluginSettings()
	{
		return SJB_DB::query('SELECT * FROM `twitter`');
	}
	
	public static function twitterFeed($info = array())
    {
		return new SJB_Twitter($info);
	}
	
	public static function saveFeed($info) 
	{
		SJB_Twitter::saveFeed($info);
	}
	
	public static function getFeedInfoBySID($sid)
	{
		return SJB_Twitter::getFeedInfoBySID($sid);
	}
	
	public static function getAllFeeds()
	{
		return SJB_Twitter::getAllFeeds();
	}
	
	public static function deleteFeed($sid)
	{
		return SJB_Twitter::deleteFeed($sid);
	}
}
