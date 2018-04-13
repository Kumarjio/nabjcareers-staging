<?php

require_once('classifieds/Listing/ListingManager.php');
require_once("classifieds/Browse/AbstractCategorySearcher.php");
require_once("classifieds/ListingField/ListingFieldTreeManager.php");


class SJB_CategorySearcher_Tree extends SJB_AbstractCategorySearcher{
	function SJB_CategorySearcher_Tree($field){
		parent::SJB_AbstractCategorySearcher($field);
		$this->field = $field;
	}

	function _decorateItems($items, $request_data = Array()){
		$this->fieldSid = $this->getFieldSID($this->field['field']);

		$counts = $this->_getCountsByItems($items);
		$result = Array();
		$parentSid = $this->_getParentSid($request_data);
		$values = SJB_ListingFieldTreeManager::getTreeValuesByParentSID($this->fieldSid, $parentSid);
		
		foreach($values as $sid => $caption){
			$count = $this->_getCountBySid($sid, $counts);
			$result[] = array('caption' => $caption, 'count' => $count);
		}
		return $result;
	}

	function _getCountsByItems($items){
		$res = Array();
		foreach($items as $item)
			$res[$item['caption']] = $item['count'];
		return $res;
	}

	function _getParentSid($request_data){
		$level = $this->field['treeLevel'];
		if($level === 1)
			return 0;
		else
			return $request_data[$this->field['field']]['tree'][$level - 1];
	}
	
	function _getCountBySid($sid, $counts){
		$children = SJB_ListingFieldTreeManager::getTreeValuesByParentSID($this->fieldSid, $sid);
		$count = 0;
		if(isset($counts[$sid]))
			$count += $counts[$sid];

		foreach($children as $childSid => $childCaption){
			if(isset($counts[$childSid]))
				$count += $counts[$childSid];
		}
		return $count;
	}
}
