<?php
/*
 * $Id: ListingManager.php 4465 2011-02-17 07:19:47Z kloto $
 */

require_once("classifieds/ListingField/ListingFieldDBManager.php");
require_once("orm/ObjectManager.php");
require_once("classifieds/Listing/Listing.php");
require_once("classifieds/Listing/ListingDBManager.php");
require_once("classifieds/ListingPackage.php");
require_once("classifieds/ListingType/ListingTypeManager.php");
require_once('membership_plan/ListingPackageManager.php');
require_once("comments/Comment/CommentManager.php");
require_once("ObjectMother.php");

class SJB_ListingManager extends SJB_ObjectManager
{
    
    private static $systemProperties = array();
	
	function saveListing(&$listing, $new_listing_package_id = 0)
	{
		return SJB_ListingDBManager::saveListing($listing, $new_listing_package_id);
	}
	
	function getListingsNumberByListingTypeSID($listing_type_sid)
	{
		return SJB_ListingDBManager::getListingsNumberByListingTypeSID($listing_type_sid);
	}
	
	function getListingsNumberByUserSID($user_sid)
	{
		return SJB_ListingDBManager::getListingsNumberByUserSID($user_sid);
	}
	
	function getListingsNumberByUserSIDAndContractID($user_sid, $contractID)
	{
		return SJB_ListingDBManager::getListingsNumberByUserSIDAndContractID($user_sid, $contractID);
	}

	function getAllListingSIDs()
	{
		return SJB_ListingDBManager::getAllListingSIDs();
	}

	public static function getListingInfoBySID($listing_sid)
	{
		$listing_info = SJB_ListingDBManager::getListingInfoBySID($listing_sid);
		if (empty($listing_info))
			return null;
		$listing_info['id'] = $listing_info['sid'];
		/* 12-03-2017 */
		$listing_info['duration'] = SJB_ListingManager::get_listing_duration_by_sid($listing_sid);
		/* END  12-03-2017 */
		return $listing_info;
	}  

	
	
	/* 11-06-2017*/
	function get_listing_duration_by_sid($listingSid)	{
		$package_info = SJB_ListingPackageManager::getPackageInfoByListingSID($listingSid);
		$duration = $package_info['listing_lifetime'];
		return $duration; 
	}
	
	/* END of 11-06-2017*/
	
	
	
	/**
	 * Returns Listing object by id 
	 *
	 * @param unknown_type $listing_sid
	 * @return SJB_Listing
	 */
	public static function getObjectBySID($listing_sid)
	{
		$listing_info = SJB_ListingManager::getListingInfoBySID($listing_sid);
		$listing = null;
		if (!is_null($listing_info)) {
			$listing = new SJB_Listing($listing_info, $listing_info['listing_type_sid']);
			$listing->setSID($listing_sid);
			$listing->setUserSID($listing_info['user_sid']);
			$package_info = SJB_ListingPackageManager::getPackageInfoByListingSID($listing_sid);
            $listing->setListingPackageInfo($package_info);
		}
		return $listing;
	}

	function getActiveListingsByUserSID($user_sid, $count = false)
	{
		$active_listings_sid = SJB_ListingDBManager::getActiveListingsSIDByUserSID($user_sid);
		if ($count) {
			return count($active_listings_sid);
		}
		$active_listings = array();
		foreach ($active_listings_sid as $active_listing_sid)
			$active_listings[] = SJB_ListingManager::getObjectBySID($active_listing_sid);
		return $active_listings;
	}

	function getActiveListingNumberByUserSID($user_sid)
	{
		return SJB_ListingManager::getActiveListingsByUserSID($user_sid, true);
	}

	function getListingsByUserSID($user_sid)
	{
		$listings_sid = SJB_ListingDBManager::getListingsSIDByUserSID($user_sid);
		$listings = array();
		foreach ($listings_sid as $listing_sid)
			$listings[] = SJB_ListingManager::getObjectBySID($listing_sid);
		return $listings;
	}
	
	function getListingsInfoByUserSID($user_sid, $subuser = false)
	{
		$listings_sid = SJB_ListingDBManager::getListingsSIDByUserSID($user_sid, $subuser);
		$listings = array();
		foreach ($listings_sid as $listing_sid)
			$listings[] = SJB_ListingManager::getListingInfoBySID($listing_sid);
		return $listings;
	}
	
	function activateListingBySID($listing_sid)
	{
		if (SJB_ListingDBManager::activateListingBySID($listing_sid))
			if (SJB_ListingManager::setListingExpirationDateBySid($listing_sid)) {
				SJB_ListingManager::deleteListingIDFromSendedNotificationsTable($listing_sid);
				SJB_DB::query("UPDATE `listings` SET `is_new` = 0 WHERE `sid` = ?n", $listing_sid);
				SJB_Event::dispatch('listingActivated', $listing_sid);
				return true;
			}
		return false;
	}
	
	
	function setListingExpirationDateBySid($listing_sid)
	{
		return SJB_ListingDBManager::setListingExpirationDateBySid($listing_sid);
	}
	
	function deleteListingBySID($listing_sid)
	{
		SJB_Event::dispatch('beforeListingDelete', $listing_sid);
				
		$gallery = &SJB_ObjectMother::createListingGallery();
		$gallery->setListingSID($listing_sid);
		$gallery->deleteImages();
		SJB_ListingPackageManager::deleteListingPackageByListingSID($listing_sid);
		SJB_CommentManager::deleteCommentsToListing($listing_sid);
		SJB_ListingManager::deleteListingIDFromSendedNotificationsTable($listing_sid);
		return SJB_ListingDBManager::deleteListingBySID($listing_sid);
	}
	
	
	/**** DELETED jobs MOD */
	
					function deletedListingBySID($listing_sid)
					{
						return SJB_ListingDBManager::deletedListingBySID($listing_sid);
					}
					
					function restoreDeletedListingBySID($listing_sid)
					{
						return SJB_ListingDBManager::restoreDeletedListingBySID($listing_sid);
					}

					function getListingTypeByListingSID($listing_sid)
					{
						return SJB_ListingDBManager::getListingTypeByListingSID($listing_sid);
					}
						
					
	/**** END deleted jobs mod ***/

	
	function deactivateListingBySID($listing_sid, $deleteRecordFromActivePeriod = false)
	{
		$result = SJB_ListingDBManager::deactivateListingBySID($listing_sid, $deleteRecordFromActivePeriod);
		SJB_Event::dispatch('listingDeactivated', $listing_sid);
		return $result;
	}
	
	public static function getPropertyByPropertyName($property_name, $listing_type_sid = 0)
	{
		$property_info = SJB_ListingFieldDBManager::getListingFieldInfoByID($property_name);
		if (empty($property_info)) {
			$listing_details = SJB_ListingDetails::getDetails($listing_type_sid);
			if (isset($listing_details[$property_name])) {
				$property_info = $listing_details[$property_name];
			}
			else {
				return null;
            }
		}

		return new SJB_ObjectProperty($property_info);
	}

	public static function propertyIsCommon($property_name)
	{
		$common_property = SJB_ListingManager::getPropertyByPropertyName($property_name);
		return !empty($common_property);
	}

	public static function propertyIsSystem($property_name)
	{
	    if (empty(self::$systemProperties)) {
	        self::$systemProperties = SJB_DB::query("SHOW COLUMNS FROM `listings`");
	    }
		foreach (self::$systemProperties as $property)
			if ($property['Field'] == $property_name)
				return true;
		return false;
	}
	
	function getAllListingPropertiesID($listing_type_id = null)
	{		
		$common_properties = SJB_ListingFieldManager::getCommonListingFieldsInfo();

		$extra_properties  = array();
		if (!empty($listing_type_id)) {
			$listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id);		
			if (!empty($listing_type_sid))
				$extra_properties  = SJB_ListingFieldManager::getListingFieldsInfoByListingType($listing_type_sid);
		}
		
		$system_properties = array('id','listing_type','username','active','keywords','featured','views','pictures','activation_date','expiration_date');		
				
		return array(
			'system' => $system_properties,
			'common' => $common_properties,
			'extra'  => $extra_properties,
		); 
	}
	
	function getExpiredListingsSID()
	{
		return SJB_ListingDBManager::getExpiredListingsSID();
	}
	
	function getDeactivatedListingsSID() 
	{
		return SJB_ListingDBManager::getDeactivatedListingsSID();
	}

        /**
         *
         * @param int $sid
         * @return int | boolean | null
         */
	public static function getIfListingHasExpiredBySID( $sid )
	{
		return SJB_ListingDBManager::getIfListingHasExpiredBySID( $sid );
	}


	
	public static function getListingsIDByDaysLeftToExpired($user_sid, $days = 0)
	{
		$listings = SJB_DB::query("SELECT sid FROM listings WHERE expiration_date < DATE_ADD( NOW(), INTERVAL ?w DAY ) AND expiration_date != '0000-00-00' AND `user_sid` = ?n", $days, $user_sid);
		$listings_id = array();
		foreach ($listings as $listing) {			
			$listings_id[] = $listing['sid'];			
		}
		return $listings_id;
	}
	
	
	public static function isListingNotificationSended($listingSID)
	{
		$result = SJB_DB::query("SELECT * FROM `notifications_sended` WHERE `object_type` = 'listing' AND `object_sid` = ?n", $listingSID);
		
		if (empty($result)) {
			return false;
		}
		return true;
	}
	
	
	public static function saveListingIDAsSendedNotificationsTable($listingSID)
	{
		$result = false;
		
		if (is_integer($listingSID)) {
			$result = SJB_DB::query("INSERT INTO `notifications_sended` SET `object_sid` = ?n, `object_type` = 'listing'", $listingSID);
		} elseif ( is_array($listingSID)) {
			$insertValues = array();
			foreach ($listingSID as $value) {
				if (!is_numeric($value)) {
					continue;
				}
				$insertValues[] = "('listing', $value)";
			}
			
			$insert = implode(",", $insertValues);
			$result = SJB_DB::query("INSERT INTO `notifications_sended` (`object_type`, `object_sid`) VALUES $insert");
		}
		
		if ($result === false) {
			return false;
		}
		return true;
	}
	
	
	public static function deleteListingIDFromSendedNotificationsTable($listingSID)
	{
		return SJB_DB::query("DELETE FROM `notifications_sended` WHERE `object_type` = 'listing' AND `object_sid` = ?n", $listingSID);
	}
	
	
	function getUserSIDByListingSID($listing_sid)
	{
		return SJB_ListingDBManager::getUserSIDByListingSID($listing_sid);
	}

	/**
	 * 
	 * @param SJB_Listing $listing
	 */
	public static function createTemplateStructureForListing($listing)
	{
		$listing_info = parent::getObjectInfo($listing);
		$listing_type_info = SJB_ListingTypeManager::getListingTypeInfoBySID($listing_info['system']['listing_type_sid']);
		foreach ($listing->getProperties() as $property) {
			if ($property->isComplex()) {
				$isPropertyEmpty = true;
				$properties = $property->type->complex->getProperties();
				$properties = is_array($properties)?$properties:array();
				foreach ($properties as $subProperty) {
					if (!empty($listing_info['user_defined'][$property->getID()][$subProperty->getID()]) && is_array($listing_info['user_defined'][$property->getID()][$subProperty->getID()])) {
						foreach ($listing_info['user_defined'][$property->getID()][$subProperty->getID()] as $subValue) {
							if (!empty($subValue))
								$isPropertyEmpty = false;
						}
					}
				}
				if ($isPropertyEmpty) {
					$listing_info['user_defined'][$property->getID()] = '';
				}
			}
		}
		$user = SJB_UserManager::getObjectBySID($listing_info['system']['user_sid']);
		$user_info	= !empty($user) ? SJB_UserManager::createTemplateStructureForUser($user) : null;
		$package_info = SJB_ListingPackageManager::createTemplateStructureForPackage($listing);
		require_once 'comments/Comment/CommentManager.php';
		require_once 'rating/Rating.php';
		
		$structure = array
        (
			'id'				=> $listing_info['system']['id'],
			'type'				=> array
									(
										'id' 		=> $listing_type_info['id'],
										'caption' 	=> $listing_type_info['name']
									),
			'user'				=> $user_info,
			'activation_date'	=> $listing_info['system']['activation_date'],
			'expiration_date'	=> $listing_info['system']['expiration_date'],
			'featured'			=> $listing_info['system']['featured'],
			'views'				=> $listing_info['system']['views'],
			'active'			=> $listing_info['system']['active'],
			'package'			=> $package_info,
			'contract_id'       => $listing_info['system']['contract_id'],
			'number_of_pictures'=> isset($listing_info['user_defined']['pictures']) ? count($listing_info['user_defined']['pictures']) : 0,
			'comments_num' 		=> SJB_CommentManager::getCommentsNumToListing($listing_info['system']['id']), 
			'rating_num' 		=> SJB_Rating::getRatingNumToListing($listing_info['system']['id']), 
			'rating' 		=> SJB_Rating::getRatingToListing($listing_info['system']['id']), 
			'rating_array' 		=> SJB_Rating::getRatingTplToListing($listing_info['system']['id']),
			'approveStatus'		=> $listing_info['system']['status'],
			'complete'		=> $listing_info['system']['complete'],
			'is_new'		=> $listing_info['system']['is_new'],
        );
        
        if (!empty($listing_info['system']['subuser_sid'])) {
        	$structure['subuser'] = SJB_UserManager::getUserInfoBySID($listing_info['system']['subuser_sid']);
        }
      
        $structure['METADATA'] = array 
		( 
			'activation_date'	=> array('type' => 'date'), 
			'expiration_date'	=> array('type' => 'date'), 
			'views'				=> array('type' => 'integer'), 
			'number_of_pictures'=> array('type' => 'integer'),
			'approveStatus'		=> array('type'	=> 'string'),
			'rejectReason'		=> array('type'	=> 'string'),
		); 

		$structure = array_merge($structure, $listing_info['user_defined']); 
		$structure['METADATA'] = array_merge($structure['METADATA'], parent::getObjectMetaData($listing)); 
		
		$listing_user_meta_data = array();
		if (isset($user_info['METADATA'])) {
			$listing_user_meta_data = $user_info['METADATA'];
			unset($user_info['METADATA']);
		}
		
		$listing_package_meta_data = array();
		if (isset($package_info['METADATA'])) {
			$listing_package_meta_data = $package_info['METADATA'];
			unset($package_info['METADATA']);
		}
		
		$listing_type_meta_data = array('caption' => array('type' => 'string', 'propertyID' => 'listing_type'));
		
		$structure['METADATA'] = array_merge($structure['METADATA'], array ('user' 		=> $listing_user_meta_data,
																			'package' 	=> $listing_package_meta_data,
																			'type' 		=> $listing_type_meta_data));

        return array_merge($structure, $listing_info['user_defined']);
	}
	
	function updateListingPropertyValue($property_id, $old_value, $new_value)
	{
		SJB_DB::query("UPDATE listings_properties SET value = ?s WHERE id = ?n AND value = ?s", $new_value, $property_id, $old_value);
	}
	
	public static function getFeaturedListings($number_of_listings,$listing_type)
	{
		$listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type);
		$wait_approve = SJB_ListingTypeManager::getWaitApproveSettingByListingType($listing_type_sid);
		
		$approve_status = '';
		if ($wait_approve)
			$approve_status = "AND l.status = 'approved'";
		
		if ($listing_type != '')
			$listing_type = "lt.id='".$listing_type."' AND ";
			
		$userSID = SJB_UserManager::getCurrentUserSID();
		$sqlAccess = " AND (
			(l.`access_type` = 'everyone') OR 
			(l.`access_type`  = 'only' AND FIND_IN_SET('{$userSID}',l.`access_list`) ) OR 
			(l.`access_type` = 'except' AND (FIND_IN_SET('{$userSID}', l.`access_list`) = 0 OR FIND_IN_SET('{$userSID}', l.`access_list`) IS NULL) )
			)";
			
		
/* "featured_last_showed ASC" changed to  "activation_date DESC" */
		$listings_info = SJB_DB::query("SELECT l.*, lt.id FROM listings as l
				LEFT JOIN listing_types as lt ON (lt.sid = l.listing_type_sid)
				WHERE ".$listing_type." l.featured = 1 AND l.active = 1 $approve_status $sqlAccess ORDER BY l.activation_date DESC LIMIT 0, ?n", $number_of_listings);
		$listings = array();
		
		foreach ($listings_info as $listing_info) {
			$listing = SJB_ListingManager::getObjectBySID($listing_info['sid']);
			$listing->addPicturesProperty();
			$listings[] = $listing;
			SJB_DB::query("UPDATE listings SET featured_last_showed = NOW() WHERE sid = ?n", $listing_info['sid']);
		}
		return $listings;
	}
	
	public static function getLastListings($number_of_listings, $listing_type)
	{
		$listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type);
		$wait_approve = SJB_ListingTypeManager::getWaitApproveSettingByListingType($listing_type_sid);
		
		$approve_status = '';
		if ($wait_approve)
			$approve_status = "AND l.status = 'approved'";
			
		$userSID = SJB_UserManager::getCurrentUserSID();
		$sqlAccess = " AND (
			(l.`access_type` = 'everyone') OR 
			(l.`access_type`  = 'only' AND FIND_IN_SET('{$userSID}',l.`access_list`) ) OR 
			(l.`access_type` = 'except' AND (FIND_IN_SET('{$userSID}', l.`access_list`) = 0 OR FIND_IN_SET('{$userSID}', l.`access_list`) IS NULL) )
			)";
		$listings_info = SJB_DB::query("SELECT l.*, lt.id FROM listings as l
				LEFT JOIN listing_types as lt ON (lt.sid = l.listing_type_sid)
				WHERE lt.id='".$listing_type."' AND l.active = 1 $approve_status $sqlAccess ORDER BY  l.activation_date DESC LIMIT 0, ?n", $number_of_listings);
		
		$listings = array();
		foreach ($listings_info as $listing_info) {
			$listing = SJB_ListingManager::getObjectBySID($listing_info['sid']);
			$listing->addPicturesProperty();
			$listings[] = $listing;
		}
		
		return $listings;
	}

	public static function getPropertyValueByObjectSID($sid, $property_name)
	{
		return parent::getPropertyValueByObjectSID('listings', $sid, $property_name);
	}

    function getSystemPropertyValueByObjectSID($sid, $property_name)
    {
		return parent::getSystemPropertyValueByObjectSID('listings', $sid, $property_name);
	}

	function filterListingSIDByActiveAndType($found_listings_sids, $listing_type_sid)
	{
		$sids_string = join("', '", $found_listings_sids);
		$and_listing_type_sid = '';
		
		if (!empty($listing_type_sid))
			$and_listing_type_sid = ' AND `listing_type_sid`=?n';
		
		$sids = SJB_DB::query("SELECT `sid` FROM `listings` WHERE `sid` IN ('?w') AND `active`=1" . $and_listing_type_sid, $sids_string, $listing_type_sid);
		$result_sids = array();
		foreach ($sids as $sid)
			$result_sids[] = $sid['sid'];

		return $result_sids;
	}

	function incrementViewsCounterForListing($listing_id)
	{
		$listing_info = SJB_DB::query("SELECT `views` FROM `listings` WHERE `sid`=?n", $listing_id);
		if (!empty($listing_info)) {
			$listing_views = array_pop(array_pop($listing_info));
		}
		else {
			return false;
		}

		return SJB_DB::query("UPDATE `listings` SET `views`=?n WHERE `sid`=?n", $listing_views+1, $listing_id);
	}
	
	function getListingSIDByID($id)
	{
		return $id;
	}
	
	function makeFeaturedBySID($listing_sid)
	{
		return SJB_DB::query("UPDATE listings SET featured = 1 WHERE sid = ?n", $listing_sid);
	}

	function unmakeFeaturedBySID($listing_sid)
	{
		return SJB_DB::query("UPDATE listings SET featured = 0 WHERE sid = ?n", $listing_sid);
	}

	// ------------------------- ELDAR ----------------------

	function makePriorityBySID($listing_sid)
	{
		return SJB_DB::query("UPDATE listings SET priority = 1 WHERE sid = ?n", $listing_sid);
	}

	function unmakePriorityBySID($listing_sid)
	{
		return SJB_DB::query("UPDATE listings SET priority = 0 WHERE sid = ?n", $listing_sid);
	}
	// ------------------------- end ELDAR ----------------------
	
	
	/**
	 * Uploaded resumes and jobs statistics
	 * @return array
	 */
	function getListingsInfo()
	{
		$res = array();

		// условие запроса сформируем в зависимости от требуемого периода
		$periods = array(
			"Today" => "YEAR(CURDATE()) = YEAR(l.activation_date) AND DAYOFYEAR(CURDATE()) = DAYOFYEAR(l.activation_date)",
			"This Week" => "YEARWEEK(CURDATE()) = YEARWEEK(l.activation_date)",
			"This Month" => "YEAR(CURDATE()) = YEAR(l.activation_date) AND MONTH(CURDATE()) = MONTH(l.activation_date)");
		
		$listingTypes = SJB_ListingTypeManager::createTemplateStructureForListingTypes();

		// условие в запрос будем подставлять заранее заготовленное из массива
		foreach ($listingTypes as $listingType) {
			foreach ($periods as $key => $value) {
				$res[$listingType["id"]]["periods"][$key] = array_shift(SJB_DB::query("
					select	ifnull(count(l.listing_type_sid), 0) as `count`,
							ifnull(sum(l.active), 0) as `active`
					from listings l
					where $value and l.listing_type_sid = {$listingType["sid"]}"));
			}
			$res[$listingType["id"]]["total"] = array_shift(SJB_DB::query("
				select	ifnull(count(l.listing_type_sid), 0) as `count`,
						ifnull(sum(l.active), 0) as `active`
				from listings l
				where l.listing_type_sid = {$listingType["sid"]}"));
			$res[$listingType["id"]]["approveInfo"] = SJB_ListingManager::getListingsApproveInfo($listingType["sid"]);
		}
		return $res;
	}
	
	// получим информацию о соотношении одобренных и неодобренных листингов
	function getListingsApproveInfo ($listing_type_sid = false)
	{		
		if ($listing_type_sid != false) {
			$listingTypeInfo = SJB_ListingTypeManager::getListingTypeInfoBySID($listing_type_sid);
			if ($listingTypeInfo['waitApprove'] == false ) {
				return false;
			}
			$res = SJB_DB::query("
				SELECT count(*) as `count`, `status`, `listing_type_sid` 
				FROM `listings` 
				WHERE `listing_type_sid` = ?n 
				GROUP BY `status`", $listing_type_sid);
			
			
			$statusInfo = array();
			foreach ($res as $arr) {
				$statusInfo[$arr['status']] = $arr['count'];
			}
			$statusInfo['listing_type_sid'] = $listing_type_sid;
			$statusInfo['listing_type_id'] = SJB_ListingTypeManager::getListingTypeIDBySID($listing_type_sid);

			return $statusInfo;
		}
		
		$res = SJB_DB::query("
				SELECT count(*) as `count`, `listing_type_sid`, `status` 
				FROM `listings` 
				GROUP BY `listing_type_sid`, `status`");
		
		$aprove = array();
		foreach ($res as $arr) {
			$aprove[$arr['listing_type_sid']][$arr['status']] = $arr['count'];
		}
		return $aprove;
	}
	
	function getListingApprovalStatusBySID ($sid)
	{		
		if (!$sid) {
			return false;
		}
		$status = SJB_DB::query("SELECT `status` FROM `listings` WHERE `sid` = ?n", $sid);
		return array_pop(array_pop( $status ));
	}
	
	function copyListingBySID($request, $copy_listing_sid, $listing_sid, $tmp_listing_sid)
	{
		return SJB_ListingDBManager::copyListingBySID($request, $copy_listing_sid, $listing_sid, $tmp_listing_sid);
	}
	
	function setListingApprovalStatus($listing_sid, $status)
	{
		$statusValues = array('pending', 'approved', 'rejected');
		if (in_array($status, $statusValues)) {
			switch($status) {
				case 'pending':
					// set status to 'pending' and clear reject reason
					$result = SJB_DB::query("UPDATE `listings` SET `status`=?s WHERE `sid`=?n", $status, $listing_sid);
					$result = SJB_DB::query("DELETE FROM `listings_properties` WHERE `id`='reject_reason' AND `object_sid`=?n LIMIT 1", $listing_sid);
					break;
					
				case 'approved':
					$result = SJB_DB::query("UPDATE `listings` SET `status`=?s WHERE `sid`=?n", $status, $listing_sid);
					break;
					
				case 'rejected':
					$rejectReason = ($_REQUEST['rejectReason'] != '' ? $_REQUEST['rejectReason'] : 'rejected with no reason');

					$result = SJB_DB::query("UPDATE `listings` SET `status`=?s WHERE `sid`=?n", $status, $listing_sid);
					$result = SJB_DB::query("UPDATE `listings_properties` SET `value`=?s WHERE `object_sid`=?n AND `id`='reject_reason'", $rejectReason, $listing_sid);
					if ( !mysql_affected_rows() ) {
						$result = SJB_DB::query("INSERT INTO `listings_properties` SET `object_sid`=?n, `id`='reject_reason', `value`=?s", $listing_sid, $rejectReason);
					}
					break;
			}
			
			return true;
		}
		
		return false;
	}
	
	function getListingAccessList($listing_id, $access_type)
	{
		$result = SJB_DB::query("SELECT `access_list` FROM `listings` WHERE `access_type` = ?s AND `sid` =?n ", $access_type, $listing_id);
		$result = $result?explode(',',array_pop(array_pop($result))):false;
		$employers = '';
		if (is_array($result)) {
			foreach ($result as $emp){
				$currEmp	 = SJB_UserManager::getUserInfoBySID($emp);
				$employers[] = array('user_id' => $emp, 'value' => $currEmp['CompanyName'] );
			}
			sort($employers);
		}
		return $employers;
	}
	
	function isListingAccessableByUser($listing_id, $user_id)
	{
		$access_type = array_pop(array_pop(SJB_DB::query("SELECT `access_type` FROM `listings` WHERE `sid` = ?n", $listing_id)));
		$access = false;
		switch ($access_type) {
			case 'everyone': 
				$access = true;
				break;
			case 'no_one':
				$access = false;
				break;
			case 'only':
				$result = array_pop(array_pop(SJB_DB::query("SELECT FIND_IN_SET(?s,`access_list`) FROM `listings` WHERE `sid` = ?n", $user_id, $listing_id)));
				if ($result != 0) 
					$access = true;
				break;
			case 'except':
				$result = array_pop(array_pop(SJB_DB::query("SELECT FIND_IN_SET(?s,`access_list`) FROM `listings` WHERE `sid` = ?n", $user_id, $listing_id)));
				if ($result == 0) 
					$access = true;
				break;	
		}
		return $access;
	}
	
	
	function setListingAccessibleToUser($listing_id, $user_id)
	{
		$accessData = array_pop(SJB_DB::query("SELECT `access_type`, `access_list` FROM `listings` WHERE `sid` = ?n", $listing_id));
		switch ($accessData['access_type']) {
			case 'no_one':
				SJB_DB::query("UPDATE `listings` SET `access_type`='only', `access_list`=?s WHERE `sid`=?n",$user_id, $listing_id);
				break;
			case 'only':
				$access_list = $accessData['access_list']!=''?$accessData['access_list'].",".$user_id:$user_id;
				SJB_DB::query("UPDATE `listings` SET `access_list`=?s WHERE `sid`=?n",$access_list, $listing_id);
				break;
			case 'except':
				$access_list = $accessData['access_list']!=''?explode(',',$accessData['access_list']):array();
				if (in_array($user_id,$access_list)) {
					$access_list = array_flip($access_list);
					unset($access_list[$user_id]);
					$access_list = implode(",",array_flip($access_list));
					SJB_DB::query("UPDATE `listings` SET `access_list`=?s WHERE `sid`=?n",$access_list, $listing_id);
				}
				break;	
		}
	}
	
	public static function newValueFromSearchCriteria($listing_structure, $search_criteria_structure)
	{
		require_once "miscellaneous/Currency/Currency.php";
		foreach ($search_criteria_structure as $key => $criteria) {
			if (isset($criteria['monetary']) && array_key_exists($key, $listing_structure)) {
				$currency = isset($criteria['monetary']['currency'])?SJB_CurrencyManager::getCurrencyByCurrCode($criteria['monetary']['currency']):false;
				if (is_array($listing_structure[$key]) && isset($listing_structure[$key]['add_parameter']) && !empty($currency) && $currency['sid'] != $listing_structure[$key]['add_parameter'] && is_numeric($listing_structure[$key]['value'])) {
					$listing_structure[$key]['value'] = round(($listing_structure[$key]['value']/$listing_structure[$key]['course'])*$currency['course']);
					$listing_structure[$key]['currency_sign'] = $currency['currency_sign'];
				}
			}
		}
		return $listing_structure;
	}
	
	function getCountListingsByContractID($contract_id)
	{
		$count = SJB_DB::query("SELECT count(*) FROM `listings` WHERE `contract_id` = ?n", $contract_id);
		return array_pop(array_pop($count));
	}
	
	
	/**
	 * Flag listing by listing SID
	 * 
	 * Set flag marker to listing with some reason and comment.
	 *
	 * @param integer $listingSID
	 * @param integer $reason
	 * @param string $comment
	 * @return integer|boolean
	 */
	public static function flagListingBySID($listingSID, $reason, $comment)
	{
		$result = SJB_DB::query("SELECT * FROM `flag_listing_settings` WHERE `sid` = ?n", $reason);
		$reasonText = '';
		if (!empty($result)) {
			$reasonText = $result[0]['value'];
		}
		$userSID     = SJB_UserManager::getCurrentUserSID();
		$listingInfo = self::getListingInfoBySID($listingSID);
		
		return SJB_DB::query("INSERT INTO `flagged_listings` SET `listing_sid` = ?n, `user_sid` = ?n, `comment` = ?s, `flag_reason` = ?s, `date` = NOW(), `listing_type_sid` = ?n", $listingSID, $userSID, $comment, $reasonText, $listingInfo['listing_type_sid']);
	}
	
	
	/**
	 * Get and sort flagged listings by listing type
	 * 
	 * Get sorted and filtered array of flagged listings by listing type, page number and 
	 * listings per page value
	 *
	 * @param integer $listingTypeSID
	 * @param integer $page
	 * @param integer $perPage
	 * @return array
	 */
	public static function getFlaggedListings($listingTypeSID = null, $page = 1, $perPage = 10, $sortingField = 'sid', $sortingOrder = 'DESC', $filters = null)
	{
		// PREPARE FILTERS
		$filterFlag  = '';
		$filterUser  = '';
		$filterTitle = '';
		if ($filters !== null) {
			$filterFlag = isset($filters['flag_reason']) ? $filters['flag_reason'] : '';
			$filterUser = isset($filters['username']) ? $filters['username'] : '';
			$filterTitle = isset($filters['title']) ? $filters['title'] : '';
		}
		
		$joinUsers = '';
		$joinListingProperties = '';
		if ( !empty($filterFlag)) {
			$filterFlag = SJB_DB::quote($filterFlag);
			$filterFlag = " AND fl.flag_reason LIKE '%{$filterFlag}%' ";
		}
		if (!empty($filterUser)) {
			$filterUser = SJB_DB::quote($filterUser);
			$joinUsers  = " LEFT JOIN `users` u ON (u.sid = l.user_sid) ";
			$filterUser = " AND u.username LIKE '%{$filterUser}%' ";
		}
		if (!empty($filterTitle)) {
			$filterTitle = SJB_DB::quote($filterTitle);
			$joinListingProperties = "LEFT JOIN `listings_properties` lp ON (lp.object_sid = fl.listing_sid)";
			$filterTitle = " AND lp.id = 'Title' AND lp.value LIKE '%{$filterTitle}%' ";
		}
		
		// SET LISTING TYPE FILTER
		if (empty($listingTypeSID)) {
			$listingTypeFilter = ' fl.`listing_type_sid` <> 0 ';
		} elseif ( is_numeric($listingTypeSID)) {
			$listingTypeFilter = " fl.`listing_type_sid` = {$listingTypeSID} ";
		}
		
		// check sorting and set defaults
		$allowSortBy = array('sid', 'active', 'title', 'flag_user', 'username', 'flag_reason', 'comment', 'date');
		if (!in_array($sortingField, $allowSortBy)) {
			$sortingField = 'sid';
			$sortingOrder = 'DESC';
		} else if ($sortingOrder != 'ASC' && $sortingOrder != 'DESC') {
			$sortingOrder = 'DESC';
		}
		
		if ($listingTypeSID === null) {
			$listingTypeSID = SJB_ListingTypeManager::getListingTypeSIDByID('Job');
		}
		$totalPages = self::getFlaggedTotalPagesNum($listingTypeSID, $perPage, $filters);
		
		if ($totalPages == 0) {
			return array();
		}
		
		if ($page > $totalPages) {
			$page = $totalPages;
		} else if ($page < 1) {
			$page = 1; 
		}
		
		$startNum = ($page - 1) * $perPage;
		
		switch ($sortingField) {
			case 'sid':
			case 'date':
			case 'flag_reason':
			case 'comment':
				$sortingField = "fl." . $sortingField;
				$flaggedListings = SJB_DB::query("
						SELECT fl.*
							FROM `flagged_listings` fl
						LEFT JOIN `listings` l ON (l.sid = fl.listing_sid) 
						{$joinListingProperties}
						{$joinUsers}
							WHERE {$listingTypeFilter} {$filterFlag} {$filterUser} {$filterTitle}
						GROUP BY fl.sid ORDER BY ?w ?w LIMIT ?n, ?n", 
						$sortingField, $sortingOrder, $startNum, $perPage);
				break;
				
			case 'active':
				$sortingField = "l." . $sortingField;
				$flaggedListings = SJB_DB::query("
						SELECT fl.*
							FROM `flagged_listings` fl
						LEFT JOIN `listings` l ON (fl.listing_sid = l.sid)
						{$joinUsers}
						{$joinListingProperties}
							WHERE {$listingTypeFilter} {$filterFlag} {$filterUser} {$filterTitle}
						ORDER BY ?w ?w LIMIT ?n, ?n", 
						$sortingField, $sortingOrder, $startNum, $perPage);
				break;
				
			case 'username':
				$sortingField = "u." . $sortingField;
				$flaggedListings = SJB_DB::query("
						SELECT fl.*
							FROM `flagged_listings` fl
						LEFT JOIN `listings` l ON (fl.listing_sid = l.sid)
						LEFT JOIN `users` u ON (u.sid = l.user_sid)
						{$joinListingProperties}
							WHERE {$listingTypeFilter} {$filterFlag} {$filterUser} {$filterTitle}
						ORDER BY ?w ?w LIMIT ?n, ?n",
						$sortingField, $sortingOrder, $startNum, $perPage);
				break;
				
			case 'flag_user':
				$flaggedListings = SJB_DB::query("
						SELECT fl.* 
							FROM `flagged_listings` fl
						LEFT JOIN `listings` l ON (fl.listing_sid = l.sid)
						{$joinUsers}
						LEFT JOIN `users` u_sort ON (fl.user_sid = u_sort.sid)
						{$joinListingProperties}
							WHERE {$listingTypeFilter} {$filterFlag} {$filterUser} {$filterTitle}
						ORDER BY u_sort.username ?w LIMIT ?n, ?n",
						$sortingOrder, $startNum, $perPage);
				break;
				
			case 'title':
				// при сортировке по Title из списка результатов пропадают листинги, которые были удалены
				// но всё еще находятся в таблице flagged_listings
				$flaggedListings = SJB_DB::query("
						SELECT fl.* 
							FROM `flagged_listings` fl
						LEFT JOIN `listings` l ON (fl.listing_sid = l.sid)
						{$joinUsers}
						LEFT JOIN `listings_properties` lp_sort ON (lp_sort.object_sid = fl.listing_sid)
						{$joinListingProperties}
							WHERE {$listingTypeFilter} AND lp_sort.id = 'Title' {$filterFlag} {$filterUser} {$filterTitle}
						ORDER BY lp_sort.value ?w LIMIT ?n, ?n",
						$sortingOrder, $startNum, $perPage);
				break;
				
			default:
				break;
		}
		
		return $flaggedListings;
	}
	
	
	/**
	 * Get total pages number of flags
	 *
	 * @param integer $listingTypeSID
	 * @param integer $perPage
	 * @return integer
	 */
	public static function getFlaggedTotalPagesNum($listingTypeSID, $perPage = 10, $filters = null)
	{
		$listingsNum = self::getFlagsNumberByListingTypeSID($listingTypeSID, $filters);
		if ($listingsNum == 0) {
			return 0;
		}
		return ceil( $listingsNum / $perPage );
	}
	
	
	
	// ------------------------------------------ ELDAR -------------------------------------------
	public static function getListingSummaryForPayment($listingSIDforSummary)
	{
		return SJB_DB::query("SELECT * FROM `listings` WHERE `sid` = ?n", $listingSIDforSummary);
		//SJB_DB::query("SELECT * FROM `listings_properties` WHERE `object_sid` = ?n", $listingSIDforTitle);
	}
	
	// ------------------------------------------- END  -------------------------------------------
		
	
	
	/**
	 * Get flag reasons list by listing type SID
	 *
	 * @param integer $listingTypeSID
	 * @return array
	 */
	public static function getAllFlags($listingTypeSID = null)
	{
		if (empty($listingTypeSID)) {
			return SJB_DB::query("SELECT * FROM `flag_listing_settings`");
		}
		return SJB_DB::query("SELECT * FROM `flag_listing_settings` WHERE `listing_type_sid` = ?n", $listingTypeSID);
	}
	
	
	/**
	 * Get total flags number by listing type SID
	 * 
	 * Count and return total numbers of flag
	 *
	 * @param integer $listingTypeSID
	 * @param array   $filters
	 * @param boolean $groupByListing
	 * @return integer
	 */
	public static function getFlagsNumberByListingTypeSID($listingTypeSID, $filters = null, $groupByListing = false)
	{
		$filterFlag  = '';
		$filterUser  = '';
		$filterTitle = '';
		if ($filters !== null) {
			$filterFlag  = isset($filters['flag_reason']) ? $filters['flag_reason'] : '';
			$filterUser  = isset($filters['username']) ? $filters['username'] : '';
			$filterTitle = isset($filters['title']) ? $filters['title'] : '';
		}
		
		$joinUsers = '';
		$joinListingProperties = '';
		
		if ( !empty($filterFlag)) {
			$filterFlag = mysql_real_escape_string($filterFlag);
			$filterFlag = " AND fl.flag_reason LIKE '%{$filterFlag}%' ";
		}
		
		if (!empty($filterUser)) {
			$filterUser = mysql_real_escape_string($filterUser);
			$joinUsers  = " LEFT JOIN `users` u ON (u.sid = l.user_sid) ";
			$filterUser = " AND u.username LIKE '%{$filterUser}%' ";
		}
		
		if (!empty($filterTitle)) {
			$filterTitle = mysql_real_escape_string($filterTitle);
			$joinListingProperties = "LEFT JOIN `listings_properties` lp ON (lp.object_sid = fl.listing_sid)";
			$filterTitle = " AND lp.id = 'Title' AND lp.value LIKE '%{$filterTitle}%' ";
		}
		
		// SET GROUP PARAM
		$groupOption = '';
		if ($groupByListing) {
			$groupOption = " GROUP BY fl.listing_sid";
		}
		
		
		// SET LISTING TYPE FILTER
		if (empty($listingTypeSID)) {
			$listingTypeFilter = ' fl.`listing_type_sid` <> 0 ';
		} elseif (is_numeric($listingTypeSID)) {
			$listingTypeFilter = " fl.`listing_type_sid` = {$listingTypeSID} ";
		}
		
		
		$listingsNum = SJB_DB::query("
			SELECT count(*) count 
				FROM `flagged_listings` fl 
			LEFT JOIN `listings` l ON (l.sid = fl.listing_sid) 
			{$joinListingProperties}
			{$joinUsers}
			WHERE {$listingTypeFilter} {$filterFlag} {$filterUser} {$filterTitle}
			{$groupOption}");

		
		// if group option - get number of flagged LISTINGs
		if ($groupByListing) {
			return count($listingsNum);
		}
		// if no group option - return number of flags
		return $listingsNum[0]['count'];
	}
	
	
	/**
	 * Remove flag by flag SID
	 *
	 * @param integer $flagSID
	 * @return integer|boolean
	 */
	public static function removeFlagBySID($flagSID)
	{
		if (!is_numeric($flagSID)) {
			return false;
		}
		return SJB_DB::query("DELETE FROM `flagged_listings` WHERE `sid` = ?n LIMIT 1", $flagSID);
	}
	
	
	/**
	 * Deactivate listing by flag SID
	 *
	 * @param integer $flagSID
	 * @return unknown
	 */
	public static function deactivateListingByFlagSID($flagSID)
	{
		if (!is_numeric($flagSID)) {
			return false;
		}
		$listingSID = self::getListingSIDByFlagSID($flagSID);
		return self::deactivateListingBySID($listingSID);
	}
	
	
	/**
	 *  Function delete listing by flag SID, if listing exists
	 *
	 * @param integer $flagSID
	 * @return integer|boolean
	 */
	public static function deleteListingByFlagSID($flagSID)
	{
		if (!is_numeric($flagSID)) {
			return false;
		}
		$listingSID = self::getListingSIDByFlagSID($flagSID);
		if ($listingSID === false) {
			return false;
		}
		return self::deleteListingBySID($listingSID);
	}
	
	
	/**
	 * Get listing SID from flags table by flag SID
	 *
	 * @param integer $flagSID
	 * @return integer|boolean
	 */
	public static function getListingSIDByFlagSID($flagSID)
	{
		if (!is_numeric($flagSID)) {
			return false;
		}
		$result = SJB_DB::query("SELECT `listing_sid` FROM `flagged_listings` WHERE `sid` = ?n LIMIT 1", $flagSID);
		if (empty($result)) {
			return false;
		}
		return $result[0]['listing_sid'];
	}
	
	public static function updateKeywords($keywords, $listingSID)
	{
		return SJB_DB::query("UPDATE `listings` SET `keywords` = ?s WHERE `sid`=?n", $keywords, $listingSID);
	}

	/**
	 * Checks if listng with specified external_id exists
	 *
	 * @param string $ext_id
	 * @return boolean
	 */
	public function isListingExistsByExternalId($ext_id)
	{
		$is_listing_exist = false;
		if (!empty($ext_id)) {
			$is_listing_exist = array_pop(SJB_DB::query("SELECT `external_id` FROM `listings` WHERE `external_id` = ?s", $ext_id));
		}
		return $is_listing_exist;
	}
	
	
}

