<?php

require_once("orm/ObjectDBManager.php");

class SJB_ListingTypeDBManager extends SJB_ObjectDBManager
{
	public static function getAllListingTypesInfo()
	{
		return parent::getObjectsInfoByType("listing_types");
	}
	
	function saveListingType($listing_type)
	{
		return parent::saveObject('listing_types', $listing_type);	
	}
	
	public static function getListingTypeInfoBySID($listing_type_sid)
	{
		return parent::getObjectInfo("listing_types", $listing_type_sid);
	}
	
	function deleteListingTypeBySID($listing_type_sid)
	{
		return parent::deleteObjectInfoFromDB("listing_types", $listing_type_sid);
	}
	
	public static function getListingTypeSIDByID($listing_type_id)
	{
		$sid = SJB_DB::query("SELECT sid FROM listing_types WHERE id = ?s", $listing_type_id);
		if (empty($sid))
			return 0;
		return array_pop(array_pop($sid));
	}
	
	function getListingTypeIDBySID($listing_type_sid)
	{
		$id = SJB_DB::query("SELECT id FROM listing_types WHERE sid = ?s", $listing_type_sid);
		if (empty($id)) {
			return null;
		}
		return array_pop(array_pop($id));
	}
	
}

