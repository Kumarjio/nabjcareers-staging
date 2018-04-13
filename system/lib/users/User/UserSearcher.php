<?php

require_once("classifieds/SearchEngine/Searcher.php");
require_once("users/UserInfoSearcher.php");
require_once("users/User/UserManager.php");

class SJB_UserSearcher extends SJB_Searcher
{
	var $infoSearcher = null;
	
	function SJB_UserSearcher($limit = false, $sorting_field = false, $sorting_order = false, $inner_join = false, $limitByPHP = false)
	{
		$this->infoSearcher = new SJB_UserInfoSearcher($limit, $sorting_field, $sorting_order, $inner_join, $limitByPHP);
		parent::SJB_Searcher($this->infoSearcher, new SJB_UserManager);
	}
	
	function getAffectedRows()
	{
		return $this->infoSearcher->affectedRows;
	}
}
