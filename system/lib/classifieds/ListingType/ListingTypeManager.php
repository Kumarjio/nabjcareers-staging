<?php

require_once("ListingTypeDBManager.php");
require_once("classifieds/Listing/ListingManager.php");
require_once("classifieds/ListingField/ListingFieldManager.php");

class SJB_ListingTypeManager
{
	
	public static function getAllListingTypesInfo()
	{
		return SJB_ListingTypeDBManager::getAllListingTypesInfo();
	}
	
	function saveListingType($listing_type)
	{
		return SJB_ListingTypeDBManager::saveListingType($listing_type);	
	}
	
	public static function getListingTypeInfoBySID($listing_type_sid)
	{
		return SJB_ListingTypeDBManager::getListingTypeInfoBySID($listing_type_sid);
	}
	
	function deleteListingTypeBySID($listing_type_sid)
	{
		SJB_ListingFieldManager::deleteListingFieldsByListingTypeSID($listing_type_sid);
		return SJB_ListingTypeDBManager::deleteListingTypeBySID($listing_type_sid);
	}
	
	public static function getListingTypeSIDByID($listing_type_id)
	{
		return SJB_ListingTypeDBManager::getListingTypeSIDByID($listing_type_id);
	}
	
	function getListingTypeIDBySID($listing_type_sid)
	{
		return SJB_ListingTypeDBManager::getListingTypeIDBySID($listing_type_sid);
	}

	function createTemplateStructureForListingTypes()
	{
		$listing_types_info = SJB_ListingTypeManager::getAllListingTypesInfo();
		$structure = array();
		foreach ($listing_types_info as $listing_type_info) {
			$structure[$listing_type_info['id']] = array(
				'sid'				=> $listing_type_info['sid'],
				'id'				=> $listing_type_info['id'],
				'caption'			=> $listing_type_info['name'],
				'listing_number'	=> SJB_ListingManager::getListingsNumberByListingTypeSID($listing_type_info['sid']),
			);
		}

		return $structure;
	}
	
	public static function getWaitApproveSettingByListingType($listing_type_sids)
	{
		if (empty($listing_type_sids) )
			return false;
		$waitApproveSetting = false;
		if (is_array($listing_type_sids)) {
			foreach ($listing_type_sids as $listing_type_sid) {
				$typeInfo			= SJB_ListingTypeManager::getListingTypeInfoBySID($listing_type_sid);
				if (!$waitApproveSetting || $waitApproveSetting == 0)
					$waitApproveSetting	= $typeInfo['waitApprove'];
			}
		}
		else {
			$typeInfo = SJB_ListingTypeManager::getListingTypeInfoBySID($listing_type_sids);
			$waitApproveSetting	= $typeInfo['waitApprove'];
		}

		return $waitApproveSetting;
	}
	
	function getListingTypeByUserSID($sid)
	{
		if ( empty($sid) )
			return false;
	    $types = array();
		$listingTypes = SJB_ListingTypeManager::getAllListingTypesInfo();
		foreach ($listingTypes as $listingType) {
		    if (SJB_Acl::getInstance()->isAllowed('post_' . $listingType['id'], $sid))
		        $types[] = $listingType['sid'];
		}
			
		return $types;
	}
	
}

