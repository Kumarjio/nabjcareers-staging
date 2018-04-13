<?php

require_once "orm/ObjectDBManager.php";
require_once 'membership_plan/ListingPackageManager.php';
require_once('payment/Payment/PaymentManager.php');

class SJB_ListingDBManager extends SJB_ObjectDBManager
{
	
	function saveListing(&$listing, $new_listing_package_id = 0)
	{
		$listing_type_sid = $listing->getListingTypeSID();
		
		if (!is_null($listing_type_sid)) {
			parent::saveObject("listings", $listing);

			if (!SJB_ListingPackageManager::hasListingPackage($listing->getSID()))
				SJB_ListingPackageManager::insertPackage($listing->getSID(), $listing->getListingPackageInfo());
			if($new_listing_package_id) {
				SJB_ListingPackageManager::modifyPackage($listing->getSID(), $new_listing_package_id);
				$product_info = serialize( array( 'listings_ids' => array(array((int)$listing->getSID()))));
				$status = 'Pending';
				$payment_id = SJB_PaymentManager::getPaymentSID_By_UserID_and_ProductInfo_and_Status(SJB_UserManager::getCurrentUserSID(), $product_info, $status);
				if ($payment_id) {
					SJB_PaymentManager::deletePaymentBySID($payment_id);
				}
			}
			
			if (SJB_Request::getVar('action') == 'save_info')
				return SJB_DB::query("UPDATE `?w` SET `listing_type_sid` = ?n, `user_sid` = ?n, `keywords` = ?s WHERE `sid` = ?n",
							 "listings", $listing_type_sid, $listing->getUserSID(), $listing->getKeywords(), $listing->getSID());
			else
				return SJB_DB::query("UPDATE `?w` SET `listing_type_sid` = ?n, `user_sid` = ?n, `keywords` = ?s, activation_date = NOW() WHERE `sid` = ?n",
							 "listings", $listing_type_sid, $listing->getUserSID(), $listing->getKeywords(), $listing->getSID());
		}
		return false;
	}
	
	function getListingsNumberByListingTypeSID($listing_type_sid)
	{
		$listing_number = SJB_DB::query("SELECT COUNT(*) FROM `?w` WHERE `listing_type_sid`=?n", 'listings', $listing_type_sid);
		return array_pop(array_pop($listing_number));
	}
	
	function getListingsNumberByUserSID($user_sid)
	{
		$userContractsSIDs = SJB_ContractManager::getAllContractsSIDsByUserSID($user_sid);
		$userContractsSIDs = $userContractsSIDs?implode(",", $userContractsSIDs):0;
		$listing_number = SJB_DB::query("SELECT COUNT(*) FROM listings WHERE `user_sid` = ?n AND `contract_id` in ({$userContractsSIDs})", $user_sid);
		return array_pop(array_pop($listing_number));
	}
	
	function getListingsNumberByUserSIDAndContractID($user_sid, $contractID)
	{
		$listing_number = SJB_DB::query("SELECT COUNT(*) FROM listings l WHERE `user_sid` = ?n AND `contract_id` = ?n", $user_sid, $contractID);
		return array_pop(array_pop($listing_number));
	}

	function getActiveAndApproveListingsNumberByUserSID ($user_sid)
	{
		$approved = '';
		$listingTypes = SJB_ListingTypeManager::getAllListingTypesInfo();
		foreach ($listingTypes as $listingType) {
		    if (!empty($approved))
		        $approved .= ' OR ';
		    if ($listingType['waitApprove']) {
		        $approved .= "(`listing_type_sid` = {$listingType['sid']} AND `status` = 'approved')";
		    }
		    else {
		        $approved .= "(`listing_type_sid` = {$listingType['sid']})";
		    }
		}
		$listing_number = SJB_DB::query("SELECT COUNT(*) FROM `listings` WHERE `active` = 1 AND ({$approved}) AND `user_sid` = ?n", $user_sid);
		return array_pop(array_pop($listing_number));
	}
	
				
				
				/* 12-06-2014 */
				function getActiveAndApproveListingsNumberByCompanyName ($user_companyName) {
					$approved = '';
					$listingTypes = SJB_ListingTypeManager::getAllListingTypesInfo();
					 foreach ($listingTypes as $listingType) {
						if (!empty($approved))
							$approved .= ' OR ';
						if ($listingType['waitApprove']) {
							$approved .= "(`listing_type_sid` = {$listingType['sid']} AND `status` = 'approved')";
						}
						else {
							$approved .= "(`listing_type_sid` = {$listingType['sid']})";
						}
					}  //listings approval - not used
					
					$listing_number = 0;
					$array_companyNames_user_sids = SJB_DB::query("SELECT `object_sid` FROM `users_properties` WHERE id='CompanyName' AND `value` = ?s", $user_companyName);				
					
					foreach ($array_companyNames_user_sids as $companyName_user_sid) {
						$companyName_user_sid = array_pop($companyName_user_sid);
						$listing_number_current = SJB_DB::query("SELECT COUNT(*) FROM `listings` WHERE `active` = 1 AND ({$approved}) AND `user_sid` = ?n", $companyName_user_sid);
						$listing_number_current_pop = array_pop(array_pop($listing_number_current));
						$listing_number = $listing_number + $listing_number_current_pop;
					}

					return $listing_number;
				}
				/* END */
				
	
	
	
	
	function getAllListingSIDs()
	{
		return SJB_DB::query("SELECT `sid`, `sid` as id FROM `listings`");
	}

	public static function getListingInfoBySID($listing_sid)
	{
    	return parent::getObjectInfo("listings", $listing_sid);
	}
	
	function getActiveListingsSIDByUserSID($user_sid)
	{
		$listings_info = SJB_DB::query("SELECT * FROM listings WHERE active=1 AND user_sid=?n", $user_sid);
		$listings_sid = array();
		foreach ($listings_info as $listing_info)
			$listings_sid[] = $listing_info['sid'];
		
		return $listings_sid;
	}
	
	function getListingsSIDByUserSID($user_sid, $subuser = false)
	{
		$subuserFilter = '';
		if ($subuser !== false) {
			$subuserFilter = " AND `subuser_sid` = '" . SJB_DB::quote($subuser) . "'";
		}
		$listings_info = SJB_DB::query('SELECT * FROM `listings` WHERE `user_sid` = ?n ' . $subuserFilter, $user_sid);
		$listings_sid = array();
		foreach ($listings_info as $listing_info)
			$listings_sid[] = $listing_info['sid'];
		
		return $listings_sid;
	}
	
	function activateListingBySID($listing_sid) {
          if (SJB_DB::query("UPDATE listings SET active = 1, activation_date = NOW() WHERE sid = ?n", $listing_sid)) {
               $numberOfDays = SJB_DB::query("SELECT `number_of_days` FROM `listings_active_period` WHERE `listing_sid` = ?n", $listing_sid);
               $numberOfDays = $numberOfDays?array_pop(array_pop($numberOfDays)):0;
               if ($numberOfDays) {
                    SJB_DB::query("UPDATE `listings` SET `expiration_date`=NOW()+INTERVAL ?n DAY WHERE `sid` = ?n", $numberOfDays, $listing_sid);
               }
               return true;
          }
          return false;
     }
		
	function setListingExpirationDateBySid($listing_sid)
	{
		$package_info = SJB_DB::query("SELECT package_info FROM listing_packages WHERE listing_sid = ?n", $listing_sid);
		$package_info = empty($package_info) ? null : unserialize(array_pop(array_pop($package_info)));
		if (!empty($package_info['listing_lifetime']))
			SJB_DB::query("UPDATE listings SET expiration_date = NOW() + INTERVAL ?n DAY WHERE sid = ?n", $package_info['listing_lifetime'],  $listing_sid);
		
		return true;
	}
	
	function deleteListingBySID($listing_sid)
	{
		parent::deleteObjectInfoFromDB('listings', $listing_sid);
	}

	/**** DELETED jobs MOD */
			function deletedListingBySID($listing_sid) 	{
				parent::deletedJobsDB('listings_properties', $listing_sid);
			}
			
			function restoreDeletedListingBySID($listing_sid) {
				parent::restore_deletedJobsDB('listings_properties', $listing_sid);
			}
			
			function getListingTypeByListingSID($listing_sid) {
				$type_of_listing = array_pop(array_pop(SJB_DB::query("SELECT `listing_type_sid` FROM `listings` WHERE `sid`=?n", $listing_sid)));
				return $type_of_listing;
			}
	/**** END deleted jobs mod ***/
	
	
	
	function deactivateListingBySID($listing_sid, $deleteRecordFromActivePeriod = false) {
          if (SJB_DB::query("UPDATE listings SET active = 0 WHERE sid = ?n", $listing_sid)) {
               if ($deleteRecordFromActivePeriod) {
                    SJB_DB::query("DELETE FROM  `listings_active_period` WHERE `listing_sid`=?n", $listing_sid);
               }
               else {
                    $numberOfDays = SJB_DB::query("SELECT `number_of_days` FROM `listings_active_period` WHERE `listing_sid` = ?n", $listing_sid);
                    $expirationDate = array_pop(array_pop(SJB_DB::query("SELECT `expiration_date` FROM `listings` WHERE `sid` = ?n", $listing_sid)));
                    if ($expirationDate) {
                         if ($numberOfDays)
                              SJB_DB::query("UPDATE `listings_active_period` SET `number_of_days` = DATEDIFF(?s, NOW()) WHERE `listing_sid`=?n", $expirationDate, $listing_sid);
                         else 
                              SJB_DB::query("INSERT INTO `listings_active_period` (`listing_sid`, `number_of_days`) VALUES (?n, DATEDIFF(?s, NOW()))", $listing_sid, $expirationDate);
                    }
               }
               return true;
          }
          return false;
     }
	
	function getExpiredListingsSID()
	{
		$listings = SJB_DB::query("SELECT sid FROM listings WHERE expiration_date < NOW() AND active = 1");
		
		if (empty($listings))
			return array();
		
		$listings_sid = array();
		foreach ($listings as $listing)
			$listings_sid[] = $listing['sid'];
		
		return $listings_sid;
	}
	
	function getDeactivatedListingsSID() // !!!! ATTN   '+' replaced to '-' 
	{	
		$period = SJB_Settings::getSettingByName('period_delete_expired_listings');
		$listings = SJB_DB::query("SELECT l.sid FROM listings l
			LEFT JOIN `listings_active_period` lap ON lap.`listing_sid`=l.`sid` 
			WHERE l.expiration_date < NOW() - INTERVAL ?n DAY AND l.active = 0 
			AND (lap.`number_of_days` is NULL OR lap.`number_of_days`=0)", $period);
		
		// print_r($listings);
		
		if (empty($listings))
			return array();
		
		$listings_sid = array();
		foreach ($listings as $listing)
			$listings_sid[] = $listing['sid'];
		
		return $listings_sid;
	}

	function getIfListingHasExpiredBySID( $listingSID )
	{
		$listing = SJB_DB::query("SELECT sid FROM listings WHERE expiration_date < NOW() AND `listings`.`sid` = ?n LIMIT 1", $listingSID );
		if (!empty($listing))
			return true;
		return false;
	}

	function getUserSIDByListingSID($listing_sid)
	{
		$user_sid = SJB_DB::query("SELECT user_sid FROM listings WHERE sid = ?n", $listing_sid);
		return empty($user_sid) ? null : array_pop(array_pop($user_sid));
	}
	
	function copyListingBySID($request, $listing_sid, $listing_id, $tmp_listing_sid)
	{
		$in = '';
		$gallery = new SJB_ListingGallery();
		$gallery->setListingSID($listing_sid);
		$listings_new = SJB_DB::query("SELECT * FROM listings_properties WHERE id in ('video', 'Photo', 'Logo')  AND object_sid = ?n", $listing_id);
		foreach ($listings_new as $key => $val) {
			if(isset($request['video_hidden']) && $val['id'] == 'video' && $val['value'] == '')
				$in .= "'video', ";
			if(isset($request['Photo_hidden']) && $val['id'] == 'Photo' && $val['value'] == '') 
				$in .= "'Photo', ";
			if(isset($request['Logo_hidden']) && $val['id'] == 'Logo' && $val['value'] == '') 
				$in .= "'Logo', ";
		}

		if ($in != '') {
			$in = substr($in, 0, -2);
			$listings_properties = SJB_DB::query("SELECT * FROM listings_properties WHERE id in (".$in.") AND object_sid = ?n", $listing_sid);
			$file_name = false;
			foreach ($listings_properties as $key => $val) {
				$val['sid'] = '';
				$val['object_sid'] = $listing_id;
				if (($val['id'] == "Photo" || $val['id'] == "video" || $val['id'] == "Logo") && !empty($val['value'])) {
					if ($val['id'] == "video") {
						$saved_file_name = array_pop(array_pop(SJB_DB::query("SELECT `saved_file_name` FROM uploaded_files WHERE `id`= ?s", $val['value'])));
						$base_name = substr($saved_file_name,0, strrpos($saved_file_name, "."));
						$file_name = array('saved_file_name'=>$saved_file_name, 'thumb_saved_name'=>$base_name.".png", 'return' => 'name');
					}
					$val['value'] = $gallery->copyFile($val['value'], $val['object_sid'], $val['id'], $file_name);
				}
				SJB_DB::query("UPDATE listings_properties SET value ='".$val['value']."' WHERE id = '".$val['id']."' AND object_sid=".$listing_id);
			}
		}
		$gallery->setListingSID($tmp_listing_sid);
		$number_of_picture = $gallery->getPicturesAmount();
		if ($number_of_picture != 0) {
			foreach ($_SESSION['tmp_file_storage'] as $picture_info) {
				$storage_method = $picture_info['storage_method'];
				if ($storage_method == 'database') {
					SJB_DB::query("INSERT INTO listings_pictures SET `listing_sid` = ?n, `storage_method` = ?s, `picture` = ?b, `thumbnail` = ?b, `caption` = ?s, `order` = ?n",	$listing_id, "database", $picture_info['picture'], $picture_info['thumbnail'], $picture_info['caption'], $picture_info['order']);
				} else {
					SJB_DB::query("UPDATE `listings_pictures` SET `listing_sid` = ?n WHERE `picture_saved_name` = ?s", $listing_id, $picture_info['picture_saved_name']);
					SJB_DB::query("UPDATE `listings_pictures` SET `listing_sid` = ?n WHERE `thumb_saved_name` = ?s", $listing_id, $picture_info['thumb_saved_name']);
				}
			}
		}
		SJB_Session::unsetValue('tmp_file_storage');
		SJB_ListingDBManager::setListingExpirationDateBySid($listing_id);
		return $listing_id;
	}
	
}
