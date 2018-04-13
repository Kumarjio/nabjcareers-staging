<?php

require_once("orm/ObjectDBManager.php");
require_once("ListingFieldListItemManager.php");
require_once("classifieds/ListingField/ListingFieldRequestCreator.php");

class SJB_ListingFieldDBManager extends SJB_ObjectDBManager
{
	
	public static function getListingFields($pageID)
	{
		if ($pageID)
			$GLOBALS['listing_fields'][$pageID] = SJB_DB::query('SELECT lf.*, rlfpp.`order` FROM listing_fields lf INNER JOIN `relations_listing_fields_posting_pages` rlfpp ON rlfpp.`field_sid`=lf.`sid` WHERE rlfpp.`page_sid`=?n  ORDER BY rlfpp.`order`', $pageID);
		else 
			$GLOBALS['listing_fields'][$pageID] = SJB_DB::query('SELECT * FROM listing_fields ORDER BY `order`');
	}
	
	public static function getListingFieldsValue($value,$key='sid', $pageID = 0)
	{
		if (!isset($GLOBALS['listing_fields'][$pageID]))
			SJB_ListingFieldDBManager::getListingFields($pageID);
		$result = array();
		foreach ($GLOBALS['listing_fields'][$pageID] as $row) {
			if ($row[$key] == $value )
				$result[] =  $row;
		}
		if (count($result) == 0)	{
			return array();	
		}
		
		return $result;
	}
	
	public static function getListingComplexFieldsValue($field_sid)
	{
		return SJB_DB::query('SELECT * FROM `listing_complex_fields` WHERE `field_sid`=?n  ORDER BY `order` ', $field_sid);
	}
	
	function getCommonListingFieldsInfo()
	{
		return SJB_ListingFieldDBManager::getListingFieldsInfoByListingType(0);
	}
	
	function saveListingField($listing_field, $pages = array())
	{
		parent::saveObject('listing_fields', $listing_field);
		if ($listing_field->getOrder())
		    return true;
		$max_order = SJB_DB::query("SELECT MAX(`order`) FROM listing_fields WHERE listing_type_sid = ?n", $listing_field->getListingTypeSID());
		$max_order = empty($max_order) ? 0 : array_pop(array_pop($max_order));
		
		foreach ($pages as $page) {
			SJB_PostingPagesManager::addListingFieldOnPage($listing_field->getSID(), $page['sid'],  $page['listing_type_sid']);
		}

		return SJB_DB::query("UPDATE listing_fields SET listing_type_sid = ?n, `order` = ?n WHERE sid = ?n", 
							$listing_field->getListingTypeSID(), ++$max_order, $listing_field->getSID());
	}
	
	public static function saveListingComplexField($listing_field)
	{
		$parentSID = $listing_field->getProperty('field_sid')->value;
		parent::saveObject('listing_complex_fields', $listing_field, time());
		if ($listing_field->getOrder())
		    return true;
		$max_order = SJB_DB::query("SELECT MAX(`order`) FROM listing_complex_fields WHERE field_sid = ?n", $parentSID);
		$max_order = empty($max_order) ? 0 : array_pop(array_pop($max_order));
		return SJB_DB::query("UPDATE listing_complex_fields SET `order` = ?n, `visible_emp` = ?n WHERE sid = ?n", 
							++$max_order, $listing_field->getEmpVisible(), $listing_field->getSID());
	}
	
	public static function getListingFieldInfoBySID($listing_field_sid, $table = 'listing_fields')
	{
		$listing_field_info = parent::getObjectInfo($table, $listing_field_sid);
		SJB_ListingFieldDBManager::setComplexFields($listing_field_info);
		return $listing_field_info;
	}
	
	public static function getListingComplexFieldInfoBySID($listing_field_sid)
	{
		$listing_field_info = parent::getObjectInfo("listing_complex_fields", $listing_field_sid);
		SJB_ListingFieldDBManager::setComplexFields($listing_field_info);
		return $listing_field_info;
	}
	
	function getListingFieldCollectionBySIDs($sids)
	{
		$request_creator = new SJB_ListingFieldRequestCreator($sids);
		$request = $request_creator->getRequest();
		$listing_collection_field_info = SJB_DB::query($request);		
		foreach($listing_collection_field_info as $key => $listing_field_info)			
			SJB_ListingFieldDBManager::setComplexFields($listing_collection_field_info[$key]);
		return $listing_collection_field_info;
	}
	
	public static function setComplexFields(&$listing_field_info)
	{
		
		if ($listing_field_info['type'] == 'list' || $listing_field_info['type'] == 'multilist') {
			$listing_field_info['list_values'] = SJB_ListingFieldDBManager::getListValuesBySID($listing_field_info['sid']);
		} 
		elseif ($listing_field_info['type'] == 'tree') {
			$listing_field_info['tree_values'] = SJB_ListingFieldDBManager::getTreeValuesBySID($listing_field_info['sid']);
			$listing_field_info['tree_depth'] = SJB_ListingFieldDBManager::getTreeDepthBySID($listing_field_info['sid']);
		}
		elseif ($listing_field_info['type'] == 'monetary') {
			require_once "miscellaneous/Currency/Currency.php";
			$listing_field_info['currency_values'] = SJB_CurrencyManager::getActiveCurrencyList();
		}
		elseif ($listing_field_info['type'] == 'complex') {
			$listing_field_info['fields'] = SJB_ListingFieldDBManager::getListingFieldsInfoByParentSID($listing_field_info['sid']);
			$listing_field_info['table_name'] = 'listings'; 
		}
	}
	
	public static function getTreeValuesBySID($field_sid)
	{
		return SJB_ListingFieldTreeManager::getTreeValuesBySID($field_sid);
	}
	
	public static function getTreeDepthBySID($field_sid)
	{
		return SJB_ListingFieldTreeManager::getTreeDepthBySID($field_sid);
	}
	
	public static function getListValuesBySID($listing_field_sid)
	{
		$ListingFieldListItemManager = new SJB_ListingFieldListItemManager;
		$values = $ListingFieldListItemManager->getHashedListItemsByFieldSID($listing_field_sid);
		$field_values = array();
		foreach ($values as $key => $value) {
			$field_values[] = array('id' => $value, 'caption' => $value);
		}
		return $field_values;
	}

	public static function getListingFieldInfoByID($listing_field_id)
	{
		$sid = SJB_ListingFieldDBManager::getListingFieldsValue($listing_field_id,'id');
		if (empty($sid))
			return null;
		$listing_field_sid = $sid[0]['sid'];
		return parent::getObjectInfo("listing_fields", $listing_field_sid);
	}
	
	function deleteListingFieldBySID($listing_field_sid)
	{
		$listing_field_info = SJB_ListingFieldDBManager::getListingFieldInfoBySID($listing_field_sid);
		if (!strcasecmp("list", $listing_field_info['type'])) {
			SJB_DB::query("DELETE FROM listing_field_list WHERE field_sid = ?n" . $listing_field_sid);
		} elseif (!strcasecmp("tree", $listing_field_info['type'])) {
			SJB_DB::query("DELETE FROM listing_field_tree WHERE field_sid = ?n", $listing_field_sid);
		}
		return parent::deleteObjectInfoFromDB("listing_fields", $listing_field_sid);
	}
	
	public static function deleteComplexListingFieldBySID($listing_field_info) 
	{
		if (!strcasecmp("list", $listing_field_info->field_type)) {
			SJB_DB::query("DELETE FROM listing_field_list WHERE field_sid = ?n" . $listing_field_info->sid);
		} elseif (!strcasecmp("tree", $listing_field_info->field_type)) {
			SJB_DB::query("DELETE FROM listing_field_tree WHERE field_sid = ?n", $listing_field_info->sid);
		}
		return parent::deleteObjectInfoFromDB("listing_complex_fields", $listing_field_info->sid);
	}

	
	
/* ELDAR JF
 * 
 */
	public static function makeFieldVisibleEmpBySID($field_id)
	{
		SJB_DB::query("UPDATE listing_complex_fields SET visible_emp = ?n WHERE sid = ?n", 
			1, $field_id);
	}
	
	public static function makeFieldVisibleJsBySID($field_id)
	{
		SJB_DB::query("UPDATE listing_complex_fields SET visible_js = ?n WHERE sid = ?n",
				1, $field_id);
	}
	
	public static function makeFieldInvisibleEmpBySID($field_id)
	{
		SJB_DB::query("UPDATE listing_complex_fields SET visible_emp = ?n WHERE sid = ?n",
				0, $field_id);
	}
	
	public static function makeFieldInvisibleJsBySID($field_id)
	{
		SJB_DB::query("UPDATE listing_complex_fields SET visible_js = ?n WHERE sid = ?n",
				0, $field_id);
	}
	
	
	
	public static function getJobFairsInfoDB()
	{
		$el_result = SJB_DB::query("SELECT `sid`, `id`, `visible_emp`,`visible_js`  FROM `listing_complex_fields` ");
		$el_result2  = SJB_DB::query("SELECT `object_sid`, `id`, `value`  FROM `listing_complex_fields_properties` ");
	
		$el_jobFairs = array();
	
		foreach ($el_result2 as $val2) {
			if($val2['value'] == "boolean" ) {
				$el_jobFairs[$val2['object_sid']]['sid'] = $val2['object_sid'];
	
				foreach ($el_result2 as $val3) {
					if ($val3['id']== 'caption' && $val3['object_sid'] == $val2['object_sid']) {
						$el_jobFairs[$val2['object_sid']]['caption'] = $val3['value'];
					}
					if ($val3['id']== 'instructions' && $val3['object_sid'] == $val2['object_sid']) {
						$el_jobFairs[$val2['object_sid']]['instructions'] = $val3['value'];
					}
				}
	
				foreach ($el_result as $val4) {
					if ($val4['sid']== $val2['object_sid']) {
						$el_jobFairs[$val2['object_sid']]['fieldid'] = $val4['id'];
						$el_jobFairs[$val2['object_sid']]['visible_emp'] = $val4['visible_emp'];
						$el_jobFairs[$val2['object_sid']]['visible_js'] = $val4['visible_js'];
					}
				}
	
			}
		}
		return $el_jobFairs;
	}
/* ELDAR JF */	
	
	
	
	
	
	public static function getListingFieldsInfoByListingType($listing_type_sid, $pageID = 0)
	{
		$sids = SJB_ListingFieldDBManager::getListingFieldsValue($listing_type_sid,'listing_type_sid', $pageID);
		$listing_fields_info = array();
		$i = 0;
		foreach ($sids as $sid) {
			$listing_fields_info[$i] = SJB_ListingFieldDBManager::getListingFieldInfoBySID($sid['sid']);
			$listing_fields_info[$i]['order'] = isset($sid['order'])?$sid['order']:$listing_fields_info[$i]['order'];
			$i++;
		}
		
		return $listing_fields_info;
	}
	
	public static function getListingFieldsInfoByParentSID($field_id)
	{
		$sids = SJB_ListingFieldDBManager::getListingComplexFieldsValue($field_id,'field_sid');
		$listing_fields_info = array();
		
		foreach ($sids as $sid) {
			$listing_fields_info[] = SJB_ListingFieldDBManager::getListingComplexFieldInfoBySID($sid['sid']);
		}
		
		return $listing_fields_info;
	}
	
	function deleteListingFieldsByListingTypeSID($listing_type_sid)
	{
		$fields = SJB_DB::query("SELECT sid FROM listing_fields WHERE listing_type_sid = ?n", $listing_type_sid);
		foreach ($fields as $field) {
			SJB_ListingFieldDBManager::deleteListingFieldBySID($field['sid']);
		}
		return true;
	}

	function moveUpFieldBySID($field_sid)
	{
		$field_info = SJB_DB::query("SELECT * FROM listing_fields WHERE  sid = ?n", $field_sid);
		if (empty($field_info))
		    return false;
		$field_info = array_pop($field_info);
		$current_order = $field_info['order'];
		$up_order = SJB_DB::query("SELECT MAX(`order`) FROM listing_fields WHERE listing_type_sid = ?n AND `order` < ?n", 
								$field_info['listing_type_sid'], $current_order);
		$up_order = array_pop(array_pop($up_order));
		if ($up_order == 0)
		    return false;
		SJB_DB::query("UPDATE listing_fields SET `order` = ?n WHERE `order` = ?n AND listing_type_sid = ?n", 
					$current_order, $up_order, $field_info['listing_type_sid']);
		SJB_DB::query("UPDATE listing_fields SET `order` = ?n WHERE sid = ?n", $up_order, $field_sid);
		return true;
	}
	
	function moveDownFieldBySID($field_sid)
	{
		$field_info = SJB_DB::query("SELECT * FROM listing_fields WHERE sid = ?n", $field_sid);
		if (empty($field_info))
		    return false;
		$field_info = array_pop($field_info);
		$current_order = $field_info['order'];
		$less_order = SJB_DB::query("SELECT MIN(`order`) FROM listing_fields WHERE listing_type_sid = ?n AND `order` > ?n", 
								$field_info['listing_type_sid'], $current_order);
		$less_order = array_pop(array_pop($less_order));
		if ($less_order == 0)
		    return false;
		SJB_DB::query("UPDATE listing_fields SET `order` = ?n WHERE `order` = ?n AND listing_type_sid = ?n",
					$current_order, $less_order, $field_info['listing_type_sid']);
		SJB_DB::query("UPDATE listing_fields SET `order` = ?n WHERE sid = ?n", $less_order, $field_sid);
		return true;
	}
    
    function deleteFieldProperties($field_id, $listing_type_sid)
    {
        if ($listing_type_sid) {
            return SJB_DB::query("DELETE FROM listings_properties WHERE `id`=?s AND object_sid IN (SELECT sid FROM listings WHERE listing_type_sid=?n)", $field_id, $listing_type_sid);
        }
        return SJB_DB::query("DELETE FROM listings_properties WHERE `id`=?s", $field_id);
    }
	
    public static function deleteComplexFieldProperties($field_id)
    {
        return SJB_DB::query("DELETE FROM listings_properties WHERE `id`=?s", $field_id);
    }
}

