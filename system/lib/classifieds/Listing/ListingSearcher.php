<?php

require_once("classifieds/SearchEngine/Searcher.php");
require_once("classifieds/SearchEngine/ObjectInfoSearcher.php");

require_once("classifieds/Listing/ListingManager.php");

class SJB_ListingSearcher extends SJB_Searcher
{
	function SJB_ListingSearcher()
	{
		parent::SJB_Searcher(new SJB_ObjectInfoSearcher('listings'), new SJB_ListingManager);
	}
}
