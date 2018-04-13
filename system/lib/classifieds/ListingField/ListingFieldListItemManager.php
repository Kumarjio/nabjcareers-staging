<?php

require_once("orm/types/ListItem/ListItemManager.php");

class SJB_ListingFieldListItemManager extends SJB_ListItemManager
{
	function SJB_ListingFieldListItemManager()
	{
		$this->table_prefix = 'listing';
	}

}

