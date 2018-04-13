<?php

require_once("ListingFieldDBManager.php");
require_once("ListingComplexField.php");
require_once("ListingFieldTreeManager.php");

class SJB_ListingComplexFieldManager {
	 
	var $fields_info;

	function getCommonListingFieldsInfo() {
		return SJB_ListingComplexFieldManager::getListingFieldsInfoByListingType(0);
	}
	
	function saveListingField($listing_field) {
		$result = SJB_ListingFieldDBManager::saveListingComplexField($listing_field);
		if ($result && ($listing_field->field_type == 'list' || $listing_field->field_type == 'multilist' || $listing_field->field_type == 'tree')) {
			$i18n = SJB_ObjectMother::createI18N();
			$domainsData = $i18n->getDomainsData();
			$fieldId = $listing_field->details->properties['id']->value;
			if (!array_search($fieldId, $domainsData)) { // create new domain for listing field
				$i18n->addDomain('Property_'.$fieldId);				
			}
		}
		return $result;
	}
	
	function getFieldInfoBySID($listing_field_sid) {
		return SJB_ListingFieldDBManager::getListingFieldInfoBySID($listing_field_sid, 'listing_complex_fields');
	}
	
	function deleteListingFieldBySID($listing_field_sid) {
        $field_info = SJB_ListingComplexFieldManager::getFieldBySID($listing_field_sid);        
		return SJB_ListingFieldDBManager::deleteComplexListingFieldBySID($field_info) &&
                SJB_ListingFieldDBManager::deleteComplexFieldProperties($listing_field_sid);
	}

	
	
	/* Eldar JF */
	function makeJFVisibleEmpBySID($listing_field_sid) {
		SJB_ListingFieldDBManager::makeFieldVisibleEmpBySID($listing_field_sid); 
	}
	
	function makeJFVisibleJsBySID($listing_field_sid) {
		SJB_ListingFieldDBManager::makeFieldVisibleJsBySID($listing_field_sid);
	}
	
	function makeJFInvisibleEmpBySID($listing_field_sid) {
		SJB_ListingFieldDBManager::makeFieldInvisibleEmpBySID($listing_field_sid);
	}
	
	function makeJFInvisibleJsBySID($listing_field_sid) {
		SJB_ListingFieldDBManager::makeFieldInvisibleJsBySID($listing_field_sid);
	}

	function getJobFairsInfo() {	
		$jfs_temp = SJB_ListingFieldDBManager::getJobFairsInfoDB();
		return $jfs_temp;	
	}
	/* ELDAR JF */
	
	
	
	
	
	function getListingFieldsInfoByListingType($listing_type_sid) {
		if (isset($GLOBALS["ListingFieldManagerCache"][$listing_type_sid]))
			return $GLOBALS["ListingFieldManagerCache"][$listing_type_sid];
			
		$this->fields_info[$listing_type_sid] = SJB_ListingFieldDBManager::getListingFieldsInfoByListingType($listing_type_sid);
		$GLOBALS["ListingFieldManagerCache"][$listing_type_sid] = $this->fields_info[$listing_type_sid];
		return $this->fields_info[$listing_type_sid];
	}
	
	function deleteListingFieldsByListingTypeSID($listing_type_sid) {
		return SJB_ListingFieldDBManager::deleteListingFieldsByListingTypeSID($listing_type_sid);
	}
	
	function getFieldBySID($listing_field_sid) {
		$listing_field_info = SJB_ListingFieldDBManager::getListingFieldInfoBySID($listing_field_sid, 'listing_complex_fields');
		
		if (empty($listing_field_info)) {
			return null;
		}
		else {
			$listing_field = new SJB_ListingField($listing_field_info);
			$listing_field->setSID($listing_field_sid);
			return $listing_field;
		}
	}
	
	function getListingFieldIDBySID($listing_field_sid) {
		$listing_field_info = SJB_ListingComplexFieldManager::getFieldInfoBySID($listing_field_sid);
		if (empty($listing_field_info))
			return null;
		return $listing_field_info['id'];
	}
	
	function getTreeValuesByParentSID($field_sid, $parent_sid) {
		return SJB_ListingFieldTreeManager::getTreeValuesByParentSID($field_sid, $parent_sid);
	}
	
	
	function addTreeItemToBeginByParentSID($field_sid, $parent_sid, $tree_item_value) {
		return SJB_ListingFieldTreeManager::addTreeItemToBeginByParentSID($field_sid, $parent_sid, $tree_item_value);
	}
	
	function addTreeItemToEndByParentSID($field_sid, $parent_sid, $tree_item_value) {
		return SJB_ListingFieldTreeManager::addTreeItemToEndByParentSID($field_sid, $parent_sid, $tree_item_value);
	}
	
	function addTreeItemAfterByParentSID($field_sid, $parent_sid, $tree_item_value, $after_tree_item_sid) {
		return SJB_ListingFieldTreeManager::addTreeItemAfterByParentSID($field_sid, $parent_sid, $tree_item_value, $after_tree_item_sid);
	}
	
	function deleteTreeItemBySID($item_sid) {
		return SJB_ListingFieldTreeManager::deleteTreeItemBySID($item_sid);
	}
	
	function moveUpTreeItem($item_sid) {
		return SJB_ListingFieldTreeManager::moveUpTreeItem($item_sid);
	}
	
	function moveDownTreeItem($item_sid) {
		return SJB_ListingFieldTreeManager::moveDownTreeItem($item_sid);
	}
	
	function saveNewTreeItemsOrder($items_order) {
		return SJB_ListingFieldTreeManager::saveNewTreeItemsOrder($items_order);
	}
	
	function getTreeItemInfoBySID($item_sid) {
		return SJB_ListingFieldTreeManager::getTreeItemInfoBySID($item_sid);
	}
	
	function updateTreeItemBySID($item_sid, $tree_item_value) {
		return SJB_ListingFieldTreeManager::updateTreeItemBySID($item_sid, $tree_item_value);
	}
	
	function getTreeNodePath($node_sid) {
		return SJB_ListingFieldTreeManager::getTreeNodePath($node_sid);
	}

	function changeListingPropertyIDs($new_listing_field_id, $old_listing_field_id) {
		return SJB_DB::query("UPDATE `listings_properties` SET `id` = ?s WHERE `id` = ?s", $new_listing_field_id, $old_listing_field_id);
	}
	
	function moveUpFieldBySID($field_sid) 
	{
		$field_info = SJB_DB::query("SELECT * FROM listing_complex_fields WHERE  sid = ?n", $field_sid);
		if (empty($field_info))
		    return false;
		$field_info = array_pop($field_info);
		$current_order = $field_info['order'];
		$up_order = SJB_DB::query("SELECT MAX(`order`) FROM listing_complex_fields WHERE field_sid = ?n AND `order` < ?n", 
								$field_info['field_sid'], $current_order);
		$up_order = array_pop(array_pop($up_order));
		if ($up_order == 0)
		    return false;

		SJB_DB::query("UPDATE listing_complex_fields SET `order` = ?n WHERE `order` = ?n AND field_sid = ?n", 
					$current_order, $up_order, $field_info['field_sid']);
		SJB_DB::query("UPDATE listing_complex_fields SET `order` = ?n WHERE sid = ?n", $up_order, $field_sid);
		return $field_info['field_sid'];
	}
	
	function moveDownFieldBySID($field_sid) {
		$field_info = SJB_DB::query("SELECT * FROM listing_complex_fields WHERE sid = ?n", $field_sid);
		if (empty($field_info))
		    return false;
		$field_info = array_pop($field_info);
		$current_order = $field_info['order'];
		$less_order = SJB_DB::query("SELECT MIN(`order`) FROM listing_complex_fields WHERE field_sid = ?n AND `order` > ?n", 
								$field_info['field_sid'], $current_order);
		$less_order = array_pop(array_pop($less_order));
		if ($less_order == 0)
		    return false;
		SJB_DB::query("UPDATE listing_complex_fields SET `order` = ?n WHERE `order` = ?n AND field_sid = ?n",
					$current_order, $less_order, $field_info['field_sid']);
		SJB_DB::query("UPDATE listing_complex_fields SET `order` = ?n WHERE sid = ?n", $less_order, $field_sid);
		return $field_info['field_sid'];
	}
	
	function getFieldsInfoByType($type) {
		$type_fields = SJB_DB::query("SELECT `field`.* FROM `listing_fields` as `field`
								  LEFT JOIN `listing_fields_properties` as `property` ON `field`.`sid`=`property`.`object_sid` 
								  WHERE `property`.`id`='type' AND `property`.`value`=?s", 
								  $type);
		return $type_fields;
	}
	
	function getTreeParentSID($item_sid) {
		return SJB_ListingFieldTreeManager::getParentSID($item_sid);
	}
	
	function moveTreeItemToBeginBySID($item_sid) {
		return SJB_ListingFieldTreeManager::moveItemToBeginBySID($item_sid);
	}
	
	function moveTreeItemToEndBySID($item_sid) {
		return SJB_ListingFieldTreeManager::moveItemToEndBySID($item_sid);
	}
	
	function moveTreeItemAfterBySID($item_sid, $after_tree_item_sid) {
		return SJB_ListingFieldTreeManager::moveItemAfterBySID($item_sid, $after_tree_item_sid);
	}
	
	function getListingFieldsInfoByParentSID($field_sid) {
		return  SJB_ListingFieldDBManager::getListingFieldsInfoByParentSID($field_sid);
	}
}