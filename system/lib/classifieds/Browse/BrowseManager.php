<?php

require_once("ObjectMother.php");
require_once('classifieds/Listing/ListingManager.php');
require_once('classifieds/ListingType/ListingTypeManager.php');
require_once("classifieds/ListingField/ListingFieldTreeManager.php");

class SJB_BrowseManager
{
	function SJB_BrowseManager($listing_type_id)
	{
		$this->listing_type_id = $listing_type_id;
		$this->tree_memory_fields = Array();
		$this->schema = $this->_createSchema();
		$this->params = $this->_createParams();
		$this->searcherFactory = SJB_ObjectMother::createCategorySearcherFactory();
		$this->requestdata = $this->_getRequestdata();
	}

	function _createParams()
	{
		require_once("classifieds/Browse/FixedUrlParamProvider.php");
		$paramProvider = new SJB_FixedUrlParamProvider();
		$params = $paramProvider->getParams();
		return array_slice($params, 0, count($this->schema));
	}

	function getParams()
	{
		return $this->params;
	}
	
	function canBrowse()
	{
		return $this->getLevel() <= $this->_getMaxLevel();
	}
	
	function getRequestDataForSearchResults()
	{
		return $this->requestdata;
	}
	
	function getItems()
	{
 		if ($this->getLevel() > $this->_getMaxLevel()) {
 			trigger_error("Requested browse level is more than max level", 256);
 			return;
		}
		
		$searcherFactory = $this->searcherFactory;
		$categorySearcher = $searcherFactory->getCategorySearcher($this->_getField());
		$items = $categorySearcher->getItems($this->requestdata);
		$this->_putUrl($items);

		return $items;
	}

	function _putUrl(&$items)
	{
		foreach($items as $index => $item) {
			$items[$index]['url'] = $item['caption'];
		}
	}

	function _createSchema()
	{
		$res = array();
		$i = 1;
		while(isset($_REQUEST['level' . $i . 'Field'])) {
			$field = $_REQUEST['level' . $i . 'Field'];
			$property = SJB_ListingManager::getPropertyByPropertyName($field);

            if (empty($property))
				return $res;

			$type = $property->getType();
			$treeLevel = $this->_getTreeLevel($type, $field);
			$res[] = Array(
				'field' => $field,
				'treeLevel' => $treeLevel,
				'type' => $type,
				'sid' => $property->getSID()
			);
			
			$i++;
		}

		return $res;
	}

	function _getTreeLevel($type, $field)
	{
		$res = 0;
		if ($type == 'tree') {
			if(!isset($this->tree_memory_fields[$field]))
				$this->tree_memory_fields[$field] = 0;
			$this->tree_memory_fields[$field]++;
			$res = $this->tree_memory_fields[$field];
		}
		return $res;
	}

	function _getRequestdata()
	{
		$res = array();
		for ($i = 0; $i < $this->getLevel(); $i++ ) {
			$value = $this->_getValue($i);
			$filterItem = $this->schema[$i];
			$field = $filterItem['field'];
			switch ($filterItem['type']) {
				case 'tree' :
					$res[$field]['tree'][] = $value;
					break;/* //@todo господи, что это ?
					$parent_sids = $this->_get_parent_sids_from_request_data($res, $field, $filterItem['treeLevel']);
					$sid = ListingFieldTreeManager::getSIDByCaption($filterItem['sid'], $parent_sids, $value);
					$res[$field]['tree'][$filterItem['treeLevel']] = $sid;
					break;*/
				case 'string' :
				case 'list' :
				case 'integer' :
					$res[$field]['equal'] = $value;
				case 'multilist' :
					$res[$field]['multi_like'][] = $value;
					break;
			}
		}
		$res['active']['equal'] = 1;
		
		if (!empty($this->listing_type_id)) {
			$listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID($this->listing_type_id);
			if (!$listing_type_sid)
				trigger_error("Can't set filter by listing type for unknown type: '" . $this->listing_type_id . "'.", E_USER_WARNING);
			$res['listing_type_sid']['equal'] = $listing_type_sid;
			if (SJB_ListingTypeManager::getWaitApproveSettingByListingType($listing_type_sid))
				$res['status']['equal'] = 'approved';
		}
		
		return $res;
	}

	function _get_parent_sids_from_request_data($request_data, $field, $treeLevel)
	{
		$res = array();
		for ($i = $treeLevel - 1; $i > 0; $i--) {
			$res[] = isset($request_data[$field]['tree'][$i])?$request_data[$field]['tree'][$i]:0;
		}
		return $res;
	}

	function _getField()
	{
		return isset($this->schema[$this->getLevel()]) ? $this->schema[$this->getLevel()] : array();
	}

	function getFieldID()
	{
		$field = $this->_getField();
		return isset($field['field']) ? $field['field'] : null;
	}

	function _getFieldByLevel($level)
	{
		return isset($this->schema[$level]) ? $this->schema[$level] : array();
	}
	
	function _getValue($i)
	{
		$params = $this->_getParams();
		return $params[$i];
	}

	function getLevel()
	{
		return count($this->_getParams());
	}
	
	function _getMaxLevel()
	{
		return count($this->schema) - 1;
	}
	
	function _getParams()
	{
		return $this->params;
	}
	
	function getNavigationElements($user_page_uri) 
	{
		$page_uri = $user_page_uri;
		$elements = array();
		
		foreach ($this->params as $level => $param) {
			$field = $this->_getFieldByLevel($level);
			$metadata = $this->_getMetaDataByFieldData($field);
			
			$page_uri = SJB_Path::combineURL($page_uri, $param);
			$element = array('caption' => $param, 'uri' => $page_uri, 'metadata' => $metadata);
			$elements[] = $element;
		}
		return $elements;
	}
	
	function getBrowsingMetaData()
	{
		$field = $this->_getField();
		$metadata = $this->_getMetaDataByFieldData($field); 
		
		return array
		(
			'browseItem' => array
			(
				'caption' => $metadata,
			),
		);
	}
	
	function _getMetaDataByFieldData($field)
	{
		$metadata = null;
		
		if ($field['type'] == 'list' || $field['type'] == 'tree') {
			$metadata['domain'] = 'Property_' . $field['field'];
		}
		else {
			$metadata['type'] = $field['type'];
		}
		
		return $metadata;
	}	
}

