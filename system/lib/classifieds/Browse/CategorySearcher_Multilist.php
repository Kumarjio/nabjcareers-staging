<?php

require_once("classifieds/Browse/AbstractCategorySearcher.php");
require_once("ObjectMother.php");

class SJB_CategorySearcher_MultiList extends SJB_AbstractCategorySearcher 
{
	function SJB_CategorySearcher_MultiList($field)
	{
		$this->field = $field;
		parent::SJB_AbstractCategorySearcher($field);
	}

	function _decorateItems($items)
	{
		$counts = $this->_getCountsByItems($items);

		$listingFieldListItemManager = SJB_ObjectMother::createListingFieldListItemManager();
		$values = $listingFieldListItemManager->getHashedListItemsByFieldSID($this->field['sid']);

		$listData = array();
		foreach ($values as $value) {
			$count = isset($counts[$value]) ? $counts[$value] : 0;
			$listData[] = array('caption' => $value, 'count' => $count);
		}
		return $listData;
	}

	public static function _getCountsByItems($items)
	{
		$res = array();
		foreach ($items as $item) {
			if (strstr($item['caption'], ',')) {
				$item['caption'] = explode(',', $item['caption']);
				foreach ($item['caption'] as $val) {
					if (isset($res[$val])) {
						$res[$val] = $res[$val] + $item['count'];
					}
					else { 
						$res[$val] = $item['count'];
					}
				}
			}
			else {
				if (isset($res[$item['caption']])) {
					$res[$item['caption']] = $item['count'] + $res[$item['caption']];
				}
				else { 
					$res[$item['caption']] = $item['count'];
				}
			}
		}
		return $res;
	}

}
