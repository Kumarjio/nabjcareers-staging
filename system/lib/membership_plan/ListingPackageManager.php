<?php

class SJB_ListingPackageManager
{
	function hasListingPackage($listing_sid)
	{
		$result = SJB_DB::query("SELECT * FROM `listing_packages` WHERE `listing_sid`=?n", $listing_sid);
		return !empty($result);
	}
	
	function insertPackage($listing_sid, $package_info)
	{
		$package_id = $package_info['id'];
		$package_info = serialize($package_info);
		return SJB_DB::query("INSERT INTO listing_packages SET listing_sid = ?n, package_id = ?n, package_info = ?s", $listing_sid,$package_id, $package_info);
	}
	
	function modifyPackage($listing_sid, $package_id)
	{
		$package_info = SJB_PackagesManager::getPackageInfoByPackageID($package_id);
		$package_id = $package_info['id'];
		$package_info = serialize($package_info);
		return SJB_DB::query("UPDATE `listing_packages` SET package_id = ?n, package_info = ?s WHERE `listing_sid` = ?n", $package_id, $package_info, $listing_sid);
	}
	
	public static function getPackageInfoByListingSID($listing_sid)
	{
		$package_info = SJB_DB::query("SELECT package_info FROM listing_packages WHERE listing_sid = ?n", $listing_sid);
		if ($package_info)
		    return unserialize(array_pop(array_pop($package_info)));
	}
    
    function deleteListingPackageByListingSID($listing_sid)
    {
        return SJB_DB::query("DELETE FROM listing_packages WHERE listing_sid=?n", $listing_sid);
    }

    /**
     * 
     * @param SJB_Listing $listing
     */
	public static function createTemplateStructureForPackage($listing)
	{
	    $package_info = $listing->getListingPackageInfo();
	    if (empty($package_info)) {
    		$package_info = SJB_ListingPackageManager::getPackageInfoByListingSID($listing->getSID());
	    }
		
		// ------------------------------------------ ELDAR -------------------------------------------
		return array (
            'id'				=> $package_info['id'],
			'caption'			=> $package_info['name'],
			'description'		=> $package_info['description'],
			'price'				=> $package_info['price'],
			'listing_lifetime'	=> $package_info['listing_lifetime'],
			'featured'			=> $package_info['is_featured'],
			'featured_price'	=> $package_info['featured_price'],
			
			
			'priority'			=> $package_info['priority_listing'],
			'priority_price'	=> $package_info['priority_price'],
			
			
			'pictures_allowed'	=> $package_info['pic_limit'],
			'video_allowed'		=> $package_info['video_allowed'],
		    'METADATA'			=> array(
    			'caption'			=> array('type' => 'string', 'propertyID' => 'caption'),
    			'description'		=> array('type' => 'text', 'propertyID' => 'description'),
    			'price'				=> array('type' => 'float'),
    			'listing_lifetime'	=> array('type' => 'integer'),
    			'featured'			=> array('type' => 'boolean'),
    			'featured_price'	=> array('type' => 'float'),
				
				'priority'			=> array('type' => 'boolean'),
				'priority_price'	=> array('type' => 'float'),
				
				
    			'pictures_allowed'	=> array('type' => 'integer'),
    			'video_allowed'		=> array('type' => 'boolean'),
    		)
		);
		
		// ------------------------------------------ END  ELDAR -------------------------------------------
	}
}

