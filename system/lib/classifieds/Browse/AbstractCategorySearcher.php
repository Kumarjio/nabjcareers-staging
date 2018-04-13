<?php

require_once('classifieds/Listing/ListingManager.php');
require_once("classifieds/ListingField/ListingFieldTreeManager.php");
require_once('classifieds/SearchEngine/SearchFormBuilder.php');
require_once('ObjectMother.php');

class SJB_AbstractCategorySearcher{
    
	var $field;

	function SJB_AbstractCategorySearcher($field){
		$this->field = $field;
	}

	function getFieldSID($field){
		$property = &SJB_ListingManager::getPropertyByPropertyName($field);
		return $property->getSID();
	}

	function getItems($request_data){
		$items = $this->_get_Captions_with_Counts_Grouped_by_Captions($request_data);
		$decoratedItems = $this->_decorateItems($items, $request_data);
		return $decoratedItems;
	}
	
	function _get_Captions_with_Counts_Grouped_by_Captions($request_data){
		$sql = "select value as caption, count(*) as count from listings_properties where id=?s and object_sid in (?l) and `value` != '' group by value";
		$request_data['access_type'] = array(
			'accessible' => SJB_UserManager::getCurrentUserSID(),
		);
		$criteria = SJB_SearchFormBuilder::extractCriteriaFromRequestData($request_data);
		$searcher = SJB_ObjectMother::createListingSearcher();
		$ids = $searcher->getObjectsSIDsByCriteria($criteria);
		$res = array();
		if (count($ids) > 0) 
			$res = SJB_DB::query($sql, $this->field['field'], $ids);
		
		return $res;
	}
	
}

