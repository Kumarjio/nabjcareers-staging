<?php

class SJB_RefineSearch {
	
	public static function addField($field_id, $listing_type_sid, $userField=0)
	{
		$max_order = SJB_DB::query("SELECT MAX(`order`) FROM `refine_search` WHERE listing_type_sid = ?n", $listing_type_sid);
		$max_order = empty($max_order) ? 0 : array_pop(array_pop($max_order));
		return SJB_DB::query("INSERT INTO `refine_search` (`field_id`,`listing_type_sid`,`order`, `user_field`) VALUES (?n,?n,?n,?n)",$field_id, $listing_type_sid, ++$max_order, $userField);
	}
	
	public static function removeField($field_sid)
	{
		return SJB_DB::query("DELETE FROM `refine_search` WHERE `id`=?n", $field_sid);
	}
	
	public static function  moveUpFieldBySID($field_sid, $listing_type_sid) 
	{
		$field_info = SJB_DB::query("SELECT * FROM `refine_search` WHERE  `id` = ?n", $field_sid);
		if (empty($field_info)) return false;
		
		$field_info = array_pop($field_info);
		$current_order = $field_info['order'];
		
		$up_order = SJB_DB::query("SELECT MAX(`order`) FROM `refine_search` WHERE `listing_type_sid` = ?n AND `order` < ?n", $listing_type_sid, $current_order);
		$up_order = array_pop(array_pop($up_order));
		if ($up_order == 0) return false;
		
		SJB_DB::query("UPDATE `refine_search` SET `order` = ?n WHERE `order` = ?n AND `listing_type_sid` = ?n", $current_order, $up_order, $listing_type_sid);
		SJB_DB::query("UPDATE `refine_search` SET `order` = ?n WHERE id = ?n", $up_order, $field_sid);
		return true;
	}
	
	public static function moveDownFieldBySID($field_sid, $listing_type_sid) 
	{
		$field_info = SJB_DB::query("SELECT * FROM `refine_search` WHERE id = ?n", $field_sid);
		if (empty($field_info)) return false;
		
		$field_info = array_pop($field_info);
		$current_order = $field_info['order'];
		
		$less_order = SJB_DB::query("SELECT MIN(`order`) FROM `refine_search` WHERE `listing_type_sid` = ?n AND `order` > ?n", $listing_type_sid, $current_order);
		$less_order = array_pop(array_pop($less_order));
		if ($less_order == 0) return false;
		
		SJB_DB::query("UPDATE `refine_search` SET `order` = ?n WHERE `order` = ?n AND `listing_type_sid` = ?n",$current_order, $less_order, $listing_type_sid);
		SJB_DB::query("UPDATE `refine_search` SET `order` = ?n WHERE `id` = ?n", $less_order, $field_sid);
		
		return true;
	}
	
	public static function getFieldsByListingTypeSID($listing_type_sid)
	{
		$listingFields = SJB_DB::query("SELECT rs.*, lf.`id` as field_name FROM `refine_search` rs INNER JOIN `listing_fields` lf ON rs.`field_id`=lf.`sid` WHERE rs.`listing_type_sid`=?n  AND rs.`user_field`=0 ORDER BY `order` ASC", $listing_type_sid);
		$userFields = SJB_DB::query("SELECT rs.*, uf.`value` as field_name FROM `refine_search` rs INNER JOIN `user_profile_fields_properties` uf ON rs.`field_id`=uf.`object_sid` WHERE rs.`listing_type_sid`=?n  AND rs.`user_field`=1 AND uf.`id`='id' ORDER BY `order` ASC", $listing_type_sid);
		$fields = array_merge($listingFields, $userFields);
		$result = array();
		foreach ($fields as $field) {
			$result[$field['order']] = $field;
		}
		ksort($result);
		return $result;
	}
	
	public static function getFieldByFieldSIDListingTypeSID($field_id, $listing_type_sid, $userField=0) 
	{
		return SJB_DB::query("SELECT * FROM `refine_search` WHERE `listing_type_sid`=?n AND `field_id`=?n AND `user_field`=?n", $listing_type_sid, $field_id, $userField);
	}
	
	public static function countListingsByFieldName($fieldName, $fieldID, $objectSids, $userField) {
		
		$limit = SJB_Settings::getSettingByName('refine_search_items_limit');
		$limit = $limit?' LIMIT 0, '.$limit:'';
		$objectSids = implode(',', $objectSids);
		if ($userField == 1)
			$field = SJB_UserProfileFieldManager::getFieldInfoBySID($fieldID);
		else
			$field = SJB_ListingFieldDBManager::getListingFieldInfoByID($fieldName);
		$result = array();
		switch ($field['type']) {
			case 'multilist':
				if ($userField == 1)
					$result = SJB_DB::query("SELECT up.`value` as caption, count(l.`sid`) as count 
											 FROM `listings` l
											 INNER JOIN `users_properties` up ON l.`user_sid`=up.`object_sid`
											 WHERE up.`id`='{$fieldName}' 
											 AND up.`value` != '' 
											 AND l.`sid` in ({$objectSids}) 
											 GROUP BY up.`value` ORDER BY count DESC {$limit}");
				else
					$result = SJB_DB::query("SELECT `value` as caption, count(`value`) as count FROM `listings_properties` WHERE `id`='{$fieldName}' AND `value` != '' AND `object_sid` in ({$objectSids}) GROUP BY `value` ORDER BY count DESC {$limit}");
				self::breakMultiCategory($result);
				$newResult = array();
				foreach ($result as $key => $val) {
					$newResult[$key]['count'] = $val['count'];
					$newResult[$key]['value'] = $val['caption'];
				}
				arsort($newResult);
				$result = $newResult;
				break;
			case 'tree':
				$propertyValue = SJB_DB::query("select `lt`.`sid` as `sid`, `lt`.`caption` as `value`, count(`lp`.`sid`) as `count` from `listings_properties` `lp` left join `listing_field_tree` `lt` on `lt`.`field_sid` = {$field['sid']} and find_in_set(`lt`.`sid`, `lp`.`value`) where `lp`.`id` = '{$fieldName}' AND `lp`.`object_sid` in ({$objectSids}) group by `lt`.`sid` having `lt`.`sid` is not null {$limit}");
				foreach ($propertyValue as $value) {
					$result[$value['sid']] = $value;
				}
				break;
			default:
				if ($userField == 1) {
					$result = SJB_DB::query("SELECT up.`value`, count(l.`sid`) as count 
											 FROM `listings` l
											 INNER JOIN `users_properties` up ON l.`user_sid`=up.`object_sid`
											 WHERE up.`id`='{$fieldName}' 
											 AND up.`value` != '' AND up.`value` != 'nocompany'
											 AND l.`sid` in ({$objectSids}) 
											 GROUP BY up.`value` ORDER BY count DESC {$limit}");
					
					$resultListings = array();
					
					// JobG8 PATCH BLOCK
					if ($fieldName == 'CompanyName') {
						// for JobG8 listings - search by company_name listings field
						$resultListings = SJB_DB::query("SELECT lp.`value`, count(l.`sid`) as count, count(*) as listing 
											 FROM `listings` l
											 INNER JOIN `listings_properties` lp ON l.`sid`=lp.`object_sid`
											 WHERE lp.`id`='company_name' 
											 AND lp.`value` != '' 
											 AND l.`sid` in ({$objectSids}) 
											 GROUP BY lp.`value` ORDER BY count DESC {$limit}");
					}
					// END OF // JobG8 PATCH BLOCK
					
					$result = array_merge($result, $resultListings);
				} else {
					$result = SJB_DB::query("SELECT `value`, count(`value`) as count FROM `listings_properties` WHERE `id`='{$fieldName}' AND `value` != '' AND `object_sid` in ({$objectSids}) GROUP BY `value` ORDER BY count DESC {$limit}");
				}
				break;
		}
		$returnArr['caption'] = $field['caption'];
		$returnArr['values'] = $result;
		return $returnArr;
	}
	
	public static function getCurrentSearchByCriteria($criteria)
	{
		$returnArray = array();
		foreach ($criteria as $fieldName => $field) {
			if (!in_array($fieldName, array('listing_type', 'active', 'username', 'status', 'CompanyName', 'keywords', 'PostedWithin'))) {
				$result = array();
				$fieldInfo = SJB_ListingFieldDBManager::getListingFieldInfoByID($fieldName);
				foreach ($field as $fieldType => $fieldValue) {
					switch ($fieldType) {
						case 'geo':
							if ($fieldValue['location'] !== '')
								$result[$fieldName][$fieldType][$fieldValue['location']] = $fieldValue['location'];
							break;
						case 'monetary':
							if ($fieldValue['not_less'] !== '')
								$result[$fieldName][$fieldType][$fieldValue['not_less']] = $fieldValue['not_less'];
							if ($fieldValue['not_more'] !== '')
								$result[$fieldName][$fieldType][$fieldValue['not_more']] = $fieldValue['not_more'];
							break;
						case 'tree':
							$fieldValue = $fieldValue?explode(',', $fieldValue):"";
							if (is_array($fieldValue)) {
								foreach ($fieldValue as $key => $value) {
									if ($value !== '') {
										$name = SJB_DB::query("SELECT `caption` FROM `listing_field_tree` WHERE `sid` = '{$value}'");
										$name = $name?array_pop(array_pop($name)):'';
										$result[$fieldName][$fieldType][$value] = $name;
									}
								}
							}
							break;
						case 'multi_like_and':
							if (is_array($fieldValue)) {
								foreach ($fieldValue as $key => $value) {
									if ($value !== '') {
										if ($fieldInfo['type'] == 'tree') {
											$name = SJB_DB::query("SELECT `caption` FROM `listing_field_tree` WHERE `sid` = '{$value}'");
											$name = $name?array_pop(array_pop($name)):'';
											$result[$fieldName][$fieldType][$value] = $name;
										}
										else 
											$result[$fieldName][$fieldType][$value] = $value;
									}
								}
							}
							elseif ($fieldValue !== '')	
								$result[$fieldName][$fieldType][$fieldValue] = $fieldValue;
							break;
						default:
							if (is_array($fieldValue)) {
								foreach ($fieldValue as $key => $value) {
									if ($value !== '') 
										$result[$fieldName][$fieldType][$value] = $value;
								}
							}
							elseif ($fieldValue !== '')	
								$result[$fieldName][$fieldType][$fieldValue] = $fieldValue;
							break;
					}
				}
				if ($result && !empty($fieldInfo)) {
					$returnArray[$fieldInfo['id']]['name'] = $fieldInfo['caption'];
					$returnArray[$fieldInfo['id']]['field'] = $result[$fieldInfo['id']];
				}
			}
			elseif ($fieldName == 'CompanyName') {
				$result = array();
				$userFieldSID = SJB_DB::query("SELECT `object_sid` FROM `user_profile_fields_properties` WHERE `id`='id' AND `value`='CompanyName'");
				$userFieldSID = $userFieldSID?array_pop(array_pop($userFieldSID)):false;
				if ($userFieldSID) {
					$fieldInfo = SJB_UserProfileFieldManager::getFieldInfoBySID($userFieldSID);
					foreach ($field as $fieldType => $fieldValue) {
						switch ($fieldType) {
							case 'multi_like_and':
								if (is_array($fieldValue)) {
									foreach ($fieldValue as $key => $value) {
										if ($value !== '') {
											$result[$fieldName][$fieldType][$value] = $value;
										}
									}
								}
								elseif ($fieldValue !== '')	
									$result[$fieldName][$fieldType][$fieldValue] = $fieldValue;
								break;
						}
					}
				}
				if ($result && !empty($fieldInfo)) {
					$returnArray[$fieldInfo['id']]['name'] = $fieldInfo['caption'];
					$returnArray[$fieldInfo['id']]['field'] = $result[$fieldInfo['id']];
				}
			}
			elseif ( $fieldName == 'keywords') {
				foreach ($field as $key => $val) {
					if ($val) {
						$returnArray['keywords']['field'][$key][$val] = $val;
					}
				}
				if (isset($returnArray['keywords']))
					$returnArray['keywords']['name'] = 'Keywords';
			}
		}

		return $returnArray;
	}
	
	private static function breakMultiCategory(&$catArray) 
	{
		$keys = array_keys($catArray);
		foreach ($keys as $key) {
			if ( strpos($catArray[$key]['caption'], ",") !== false ) {
				$categories = explode(",", $catArray[$key]['caption']);
				$counter = $catArray[$key]['count'];
				foreach ($categories as $category) {
					self::updateCountCategory($catArray, trim($category), $counter);
				}
				unset($catArray[$key]);
			}
		}
	}
	
	private static function updateCountCategory(&$catArray, $category, $counter) 
	{
		$inc = 0;
		foreach ($catArray as $key => $elem) {
			if ($elem['caption'] == $category) {
				$elem['count'] += $counter;
				$catArray[$key] = $elem;
				$inc	= 1;
			}
		}
		if ($inc == 0) {
			$catArray[] = array('caption' => $category, 'count' => $counter);
		}
	}	
}
