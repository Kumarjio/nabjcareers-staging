<?php

require_once("ListingFieldDBManager.php");
require_once("ListingField.php");
require_once("ListingFieldTreeManager.php");
require_once ("classifieds/PostingPages/PostingPagesManager.php");

class SJB_ListingFieldManager {
	
	var $fields_info;
 
	function getCommonListingFieldsInfo($pageID = 0) {
		return SJB_ListingFieldManager::getListingFieldsInfoByListingType(0, $pageID);
	}
	
	function saveListingField($listing_field, $pages = array()) {
		$result = SJB_ListingFieldDBManager::saveListingField($listing_field, $pages);
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
		return SJB_ListingFieldDBManager::getListingFieldInfoBySID($listing_field_sid);
	}
	
	function deleteListingFieldBySID($listing_field_sid) {
        $field_info = SJB_ListingFieldManager::getFieldBySID($listing_field_sid);  
		return SJB_ListingFieldDBManager::deleteListingFieldBySID($listing_field_sid) &&
                SJB_ListingFieldDBManager::deleteFieldProperties($field_info->getPropertyValue('id'), $field_info->getPropertyValue('listing_type_sid')) && SJB_PostingPagesManager::removeFieldFromPade($field_info->sid, $field_info->listing_type_sid);
	}
	
	function getListingFieldsInfoByListingType($listing_type_sid, $pageID = 0) {
		if (isset($GLOBALS["ListingFieldManagerCache"][$listing_type_sid][$pageID]))
			return $GLOBALS["ListingFieldManagerCache"][$listing_type_sid][$pageID];
			
		$this->fields_info[$listing_type_sid] = SJB_ListingFieldDBManager::getListingFieldsInfoByListingType($listing_type_sid, $pageID);
		$GLOBALS["ListingFieldManagerCache"][$listing_type_sid][$pageID] = $this->fields_info[$listing_type_sid];
		return $this->fields_info[$listing_type_sid];
	}
	
	function deleteListingFieldsByListingTypeSID($listing_type_sid) {
		return SJB_ListingFieldDBManager::deleteListingFieldsByListingTypeSID($listing_type_sid);
	}
	
	function getFieldBySID($listing_field_sid) {
		$listing_field_info = SJB_ListingFieldDBManager::getListingFieldInfoBySID($listing_field_sid);
		
		if (empty($listing_field_info)) {
			return null;
		}
		else {
			$listing_field = new SJB_ListingField($listing_field_info);
			$listing_field->setListingTypeSID($listing_field_info['listing_type_sid']);
			$listing_field->setSID($listing_field_sid);
			return $listing_field;
		}
	}
	
	function getListingFieldIDBySID($listing_field_sid) {
		$listing_field_info = SJB_ListingFieldManager::getFieldInfoBySID($listing_field_sid);
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
	
	function sortTreeItems($field_sid, $node_sid = 0, $sorting_order = 'ASC') {
		return SJB_ListingFieldTreeManager::sortTreeItems($field_sid, $node_sid, $sorting_order);
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
	
	function moveUpFieldBySID($field_sid) {
		return SJB_ListingFieldDBManager::moveUpFieldBySID($field_sid);
	}
	
	function moveDownFieldBySID($field_sid) {
		return SJB_ListingFieldDBManager::moveDownFieldBySID($field_sid);
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

}