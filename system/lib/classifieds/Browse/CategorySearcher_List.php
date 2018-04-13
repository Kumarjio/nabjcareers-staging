<?php

require_once("classifieds/Browse/AbstractCategorySearcher.php");
require_once("ObjectMother.php");

class SJB_CategorySearcher_List extends SJB_AbstractCategorySearcher{
	function SJB_CategorySearcher_List($field){
		$this->field = $field;
		parent::SJB_AbstractCategorySearcher($field);
	}

	function _decorateItems($items){
		$counts = $this->_getCountsByItems($items);

		$listingFieldListItemManager = &SJB_ObjectMother::createListingFieldListItemManager();
		$values = $listingFieldListItemManager->getHashedListItemsByFieldSID($this->field['sid']);

		$listData = Array();
		foreach ($values as $value) {
			$count = isset($counts[$value])?$counts[$value]:0;
			$listData[] = Array('caption' => $value, 'count' => $count);
		}
		return $listData;
	}

	function _getCountsByItems($items){
		$res = Array();
		foreach($items as $item)
			$res[$item['caption']] = $item['count'];
		return $res;
	}

}
