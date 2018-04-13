<?php

class SJB_ListingFieldTreeManager
{
	public static function getTreeValuesBySID($field_sid)
	{
		$tree_values = SJB_DB::query("SELECT *, sid AS id FROM listing_field_tree WHERE field_sid = ?n ORDER BY `order`", $field_sid);
		$result = array();
		foreach ($tree_values as $tree_value) {
			$result[$tree_value['parent_sid']][] = $tree_value;
		}
		return $result;
	}
	
	function getSIDByCaption($field_sid, $parent_sids, $filterValue)
	{
		$join_sql = "";
		$and_sql = "";
		$main = 'main';
		foreach($parent_sids as $i => $sid) {
			if ($sid > 0) {
				$join_sql .= "
							INNER join listing_field_tree parent_"  . $i . "
							ON parent_"  . $i . ".sid = " . $main . ".parent_sid
				";						
				$and_sql .= "
							AND parent_"  . $i . ".sid = " . $sid;
				$main = "parent_"  . $i;
			}
		};
		
		if (empty($parent_sids))
			$and_sql .= "AND main.parent_sid = 0 ";

		$sql= "
						SELECT 
							main.sid 
						FROM 
							listing_field_tree main 
							$join_sql
						WHERE 
							main.field_sid = ?n 
							AND main.caption = ?s 
							$and_sql
		";
		$data = SJB_DB::query($sql, $field_sid, $filterValue);
		if(empty($data))
			return -1;
		return $data[0]['sid'];
	}
	
	function getItemInfoByCaption($field_sid, $filterValue) {
		$sql= "SELECT * FROM `listing_field_tree` WHERE `field_sid` = ?n AND `caption` = ?s";
		$data = SJB_DB::query($sql, $field_sid, $filterValue);
		if(empty($data))
			return -1;
		return $data[0];
	}

	function getTreeValuesByParentSID($field_sid, $parent_sid)
	{
		$tree_node_values = SJB_DB::query("SELECT *, sid AS id FROM listing_field_tree WHERE field_sid = ?n AND parent_sid = ?n ORDER BY `order`", $field_sid, $parent_sid);
		$result_values = array();
		if (!empty($tree_node_values)) {
			foreach ($tree_node_values as $tree_node_value) {
				$result_values[$tree_node_value['sid']] = $tree_node_value['caption'];
			}
		}
		return $result_values;
	}
	
	function getTreeItemLevelBySID($item_sid)
	{
		$level = SJB_DB::query("SELECT level FROM listing_field_tree WHERE sid = ?n", $item_sid);
		return empty($level) ? 0 : array_pop(array_pop($level));
	}
	
	
	function getTreeItemsCountByLevel($tree_sid, $level = 1)
	{
		$count = array_pop( SJB_DB::query("SELECT count(*) as count FROM `listing_field_tree` WHERE `field_sid` = ?n AND `level` = ?n", $tree_sid, $level) );
		return array_pop($count);
	}
	
	
	function addTreeItemToEndByParentSID($field_sid, $parent_sid, $tree_item_value)
	{
		$parent_level = SJB_ListingFieldTreeManager::getTreeItemLevelBySID($parent_sid);
		$level = $parent_level + 1;
		$max_order = SJB_DB::query("SELECT MAX(`order`) FROM listing_field_tree WHERE field_sid = ?n AND parent_sid = ?n", $field_sid, $parent_sid);
		$max_order = empty($max_order) ? 0 : array_pop(array_pop($max_order));
		$new_order = $max_order + 1;
		return SJB_DB::query("INSERT INTO listing_field_tree SET field_sid = ?n, parent_sid = ?n, level = ?n, caption = ?s, `order` = ?n", 
					$field_sid, $parent_sid, $level, $tree_item_value, $new_order);
	}
	
	function addTreeItemToBeginByParentSID($field_sid, $parent_sid, $tree_item_value) 
	{
		$parent_level = SJB_ListingFieldTreeManager::getTreeItemLevelBySID($parent_sid);
		$level = $parent_level + 1;
		$min_order = SJB_DB::query("SELECT MIN(`order`) FROM listing_field_tree WHERE field_sid = ?n AND parent_sid = ?n", $field_sid, $parent_sid);
		$min_order = empty($min_order) ? 0 : array_pop(array_pop($min_order));
		$new_order = $min_order;
		SJB_DB::query("UPDATE listing_field_tree SET `order` = `order` + 1 WHERE parent_sid = ?n", $parent_sid);
		return SJB_DB::query("INSERT INTO listing_field_tree SET field_sid = ?n, parent_sid = ?n, level = ?n, caption = ?s, `order` = ?n", 
					$field_sid, $parent_sid, $level, $tree_item_value, $new_order);
	}
	
	function addTreeItemAfterByParentSID($field_sid, $parent_sid, $tree_item_value, $after_tree_item_sid) 
	{
		$parent_level = SJB_ListingFieldTreeManager::getTreeItemLevelBySID($parent_sid);
		$level = $parent_level + 1;
		$after_order = SJB_DB::query("SELECT `order` FROM listing_field_tree WHERE field_sid = ?n AND parent_sid = ?n AND sid = ?n", $field_sid, $parent_sid, $after_tree_item_sid);
		$after_order = empty($after_order) ? 0 : array_pop(array_pop($after_order));
		$new_order = $after_order + 1;
		SJB_DB::query("UPDATE listing_field_tree SET `order` = `order` + 1 WHERE parent_sid = ?n AND `order` > ?n", $parent_sid, $after_order);
		return SJB_DB::query("INSERT INTO listing_field_tree SET field_sid = ?n, parent_sid = ?n, level = ?n, caption = ?s, `order` = ?n", 
					$field_sid, $parent_sid, $level, $tree_item_value, $new_order);
	}
	
	function deleteTreeItemBySID($item_sid)
	{
		$children = SJB_DB::query("SELECT sid FROM listing_field_tree WHERE parent_sid = ?n", $item_sid);
		foreach ($children as $child) {
			SJB_ListingFieldTreeManager::deleteTreeItemBySID($child['sid']);
		}
		return SJB_DB::query("DELETE FROM listing_field_tree WHERE sid = ?n", $item_sid);
	}
	
	function moveUpTreeItem($item_sid)
	{
		$item_info = SJB_DB::query("SELECT * FROM listing_field_tree WHERE sid = ?n", $item_sid);
		if (empty($item_info)) {
			return false;
		} else {
			$item_info = array_pop($item_info);
			$current_order = $item_info['order'];
			$up_order = SJB_DB::query("SELECT MAX(`order`) FROM listing_field_tree WHERE field_sid = ?n AND parent_sid = ?n AND `order` < ?n", 
									$item_info['field_sid'], $item_info['parent_sid'], $current_order);
			$up_order = array_pop(array_pop($up_order));
			if ($up_order > 0) {
				SJB_DB::query("UPDATE listing_field_tree SET `order` = ?n WHERE `order` = ?n AND parent_sid = ?n", $current_order, $up_order, $item_info['parent_sid']);
				SJB_DB::query("UPDATE listing_field_tree SET `order` = ?n WHERE sid = ?n", $up_order, $item_sid);
				return true;
			}
			return false;
		}
	}
	
	function moveDownTreeItem($item_sid)
	{
		$item_info = SJB_DB::query("SELECT * FROM listing_field_tree WHERE sid = ?n", $item_sid);
		if (empty($item_info)) {
			return false;
		} else {
			$item_info = array_pop($item_info);
			$current_order = $item_info['order'];
			$down_order = SJB_DB::query("SELECT MIN(`order`) FROM listing_field_tree WHERE field_sid = ?n AND parent_sid = ?n AND `order` > ?n", 
									$item_info['field_sid'], $item_info['parent_sid'], $current_order);
			$down_order = array_pop(array_pop($down_order));
			if ($down_order) {
				SJB_DB::query("UPDATE listing_field_tree SET `order` = ?n WHERE `order` = ?n AND parent_sid = ?n", $current_order, $down_order, $item_info['parent_sid']);
				SJB_DB::query("UPDATE listing_field_tree SET `order` = ?n WHERE sid = ?n", $down_order, $item_sid);
				return true;
			}
			return false;
		}
	}
	
	function sortTreeItems($field_sid, $node_sid = 0, $sorting_order = 'ASC') 
	{
		if ((strtolower($sorting_order) <> 'asc') && (strtolower($sorting_order) <> 'desc'))
			$sorting_order = 'ASC';
		
		$items_info = SJB_DB::query("SELECT * FROM listing_field_tree WHERE field_sid = ?n AND parent_sid = ?n ORDER BY `caption` ". $sorting_order, $field_sid, $node_sid);
		
		if (empty($items_info))	
			return false;
		
		$i = 1;
		foreach ($items_info as $item) {
			SJB_DB::query("UPDATE listing_field_tree SET `order` = ?n WHERE sid = ?n", $i, $item['sid']);
			$i++;
		}
		
		return true;		
	} 
	
	function saveNewTreeItemsOrder($item_sids)
	{
		$count = 1;
		foreach ($item_sids as $item_sid=>$val) {
			SJB_DB::query("UPDATE listing_field_tree SET `order` = ?n WHERE sid = ?n", $count, $item_sid);
			$count++;
		}
		return true;
	}
	
	function getTreeItemInfoBySID($item_sid)
	{
		$item_info = SJB_DB::query("SELECT *, sid AS id FROM listing_field_tree WHERE sid = ?n", $item_sid);
		return empty($item_info) ? null : array_pop($item_info);
	}
	
	function updateTreeItemBySID($item_sid, $tree_item_value)
	{
		return SJB_DB::query("UPDATE listing_field_tree SET caption = ?s WHERE sid = ?n", $tree_item_value, $item_sid);
	}
	
	function getTreeNodePath($node_sid)
	{
		$node_info = SJB_ListingFieldTreeManager::getTreeItemInfoBySID($node_sid);
		$path = array($node_info);
		$parent_sid = $node_info['parent_sid'];
		while (!is_null($parent_sid)) {
			$parent_node_info = SJB_ListingFieldTreeManager::getTreeItemInfoBySID($parent_sid);
			array_unshift($path, $parent_node_info);
			$parent_sid = $parent_node_info['parent_sid'];
		}
		return $path;
	}
	
	function getParentSID($item_sid)
	{
		$parent_sid = SJB_DB::query("SELECT parent_sid FROM listing_field_tree WHERE sid = ?n", $item_sid);
		return empty($parent_sid) ? null : array_pop(array_pop($parent_sid));
	}
	
	function getTreeDisplayValueBySID($item_sid)
	{
		$item_info = SJB_ListingFieldTreeManager::getTreeItemInfoBySID($item_sid);
		$values = array();
		while (!is_null($item_info)) {
			array_unshift($values, $item_info['caption']);
			$item_info = SJB_ListingFieldTreeManager::getTreeItemInfoBySID($item_info['parent_sid']);
		}
		return $values;
	}
	
	function getChildrenSIDBySID($item_sid, $field_sid = null)
	{
		$children_sids = array();
		
		if ($field_sid)
		{
			$children = SJB_DB::query('SELECT sid FROM listing_field_tree WHERE parent_sid = ?n AND	`field_sid` = ?n', $item_sid);
		}
		else
		{
			$children = SJB_DB::query("SELECT sid FROM listing_field_tree WHERE parent_sid = ?n", $item_sid);
		}

		if (!empty($children)) {
			foreach ($children as $child) {
				$children_sids[] = $child['sid'];
				$children_sids = array_merge($children_sids, SJB_ListingFieldTreeManager::getChildrenSIDBySID($child['sid']));
			}
		}
		return $children_sids;
	}

	/**
	 *
	 * @param int $fieldSID
	 * @param int $parentSID
	 * @return array
	 */
	public static function getTreeItemsByParentSIDAndFieldSID($fieldSID, $parentSID = 0)
	{
		$tree_values = SJB_DB::query('SELECT *, `sid` AS id FROM `listing_field_tree` WHERE `field_sid` = ?n AND `parent_sid` = ?n ORDER BY `order`', $fieldSID, $parentSID);

		$result = array();

		foreach ($tree_values as $tree_value)
		{
			$result[$tree_value['parent_sid']][] = $tree_value;
		}
		return $result;
	}
	
	public static function getTreeDepthBySID($field_sid)
	{
		$tree_depth = SJB_DB::query("SELECT MAX(level) FROM listing_field_tree WHERE field_sid = ?n", $field_sid);
		return empty($tree_depth) ? 0 : array_pop(array_pop($tree_depth));
	}
	
	function importTreeItem($field_sid, $imported_row)
	{
		if (!is_array($imported_row))
		    return false;
		
		$parent_sid = 0;
		$inserted =  false;
		foreach ($imported_row as $item_level => $item_caption) {
			if (empty($item_caption))
			    break;
			$item_sid = SJB_DB::query("SELECT sid FROM listing_field_tree WHERE field_sid = ?n AND parent_sid = ?n AND caption = ?s", 
										$field_sid, $parent_sid, $item_caption);
			if (!empty($item_sid)) {
				$item_sid = array_pop(array_pop($item_sid));
			} elseif ($item_sid = SJB_ListingFieldTreeManager::addTreeItemToEndByParentSID($field_sid, $parent_sid, $item_caption)) {
				$inserted =  true;
			} else {
				break;
			}
			$parent_sid = $item_sid;
		}
		
		return $inserted;
	}

	function getRequestToRoot($property)
	{
		$tree_browser = new SJB_TreeBrowser($property);
		$tree_browser->getRequestForAllNodes();
	}
	
	function moveItemToBeginBySID($item_sid)
	{
		$item_info = SJB_DB::query("SELECT * FROM listing_field_tree WHERE sid = ?n", $item_sid);
		if (empty($item_info)) {
			return false;
		} 
		else {
			$item_info = array_pop($item_info);
			$current_order = $item_info['order'];
			$min_order = SJB_DB::query("SELECT MIN(`order`) FROM listing_field_tree WHERE field_sid = ?n AND parent_sid = ?n", 
									$item_info['field_sid'], $item_info['parent_sid']);
			$min_order = array_pop(array_pop($min_order));
			SJB_DB::query("UPDATE listing_field_tree SET `order` = `order` + 1 WHERE `order` < ?n AND parent_sid = ?n", $current_order, $item_info['parent_sid']);
			SJB_DB::query("UPDATE listing_field_tree SET `order` = ?n WHERE sid = ?n", $min_order, $item_sid);
			return true;
		}	
	}
	
	function moveItemToEndBySID($item_sid)
	{
		$item_info = SJB_DB::query("SELECT * FROM listing_field_tree WHERE sid = ?n", $item_sid);
		if (empty($item_info)) {
			return false;
		} 
		else {
			$item_info = array_pop($item_info);
			$current_order = $item_info['order'];
			$max_order = SJB_DB::query("SELECT MAX(`order`) FROM listing_field_tree WHERE field_sid = ?n AND parent_sid = ?n", 
									$item_info['field_sid'], $item_info['parent_sid']);
			$max_order = array_pop(array_pop($max_order));
			SJB_DB::query("UPDATE listing_field_tree SET `order` = `order` - 1 WHERE `order` > ?n AND parent_sid = ?n", $current_order, $item_info['parent_sid']);
			SJB_DB::query("UPDATE listing_field_tree SET `order` = ?n WHERE sid = ?n", $max_order, $item_sid);
			return true;
		}	
	}
	
	function moveItemAfterBySID($item_sid, $after_tree_item_sid)
	{
		if ($item_sid == $after_tree_item_sid)
		    return false;
		
		$item_info = SJB_DB::query("SELECT * FROM listing_field_tree WHERE sid = ?n", $item_sid);
		if (empty($item_info)) {
			return false;
		} 
		else {
			$item_info = array_pop($item_info);
			$current_order = $item_info['order'];
			SJB_DB::query("UPDATE listing_field_tree SET `order` = `order` - 1 WHERE `order` > ?n AND parent_sid = ?n", $current_order, $item_info['parent_sid']);
			$after_order = SJB_DB::query("SELECT `order` FROM listing_field_tree WHERE sid = ?n", $after_tree_item_sid);
			$after_order = array_pop(array_pop($after_order));
			$new_order = $after_order + 1;
			SJB_DB::query("UPDATE listing_field_tree SET `order` = `order` + 1 WHERE `order` > ?n AND parent_sid = ?n", $after_order, $item_info['parent_sid']);
			SJB_DB::query("UPDATE listing_field_tree SET `order` = ?n WHERE sid = ?n", $new_order, $item_sid);
			return true;
		}	
	}
	
	function getTreePropertyByNameAndTreeSID($property_name, $tree_sid)
	{
		return array_pop( SJB_DB::query("SELECT * FROM `listing_fields_properties` WHERE `object_sid` = ?n AND `id` = ?s", $tree_sid, $property_name) );
	}
	
	/**
	 * Adding Multiple Tree Values
	 *
	 * @param int $item_sid
	 * @param int $node_sid
	 * @param int $tree_item_value
	 * @param int $order
	 * @param int $after_tree_item_sid
	 * @return bool
	 */
	public function addMultupleTreeItem($item_sid, $node_sid, $tree_item_value, $order, $after_tree_item_sid = '')
	{
		$tree_item_value = str_replace("\r", " ", $tree_item_value);
		$tree_item_value = explode("\n", $tree_item_value);
		$result = true;
		foreach ($tree_item_value as $tree_item) {
			$tree_item = trim($tree_item);
			if ($tree_item != "") {
				if ($order == 'begin') {
					if (!SJB_ListingFieldManager::addTreeItemToBeginByParentSID($item_sid, $node_sid, $tree_item) ) 
						$result = false;					
				}
				elseif ($order == 'end') {
					if (!SJB_ListingFieldManager::addTreeItemToEndByParentSID($item_sid, $node_sid, $tree_item) )
						$result = false;	
				}
				elseif ($order == 'after') {
					$after_tree_item_sid = $_REQUEST['after_tree_item_sid'];
					if (!SJB_ListingFieldManager::addTreeItemAfterByParentSID($item_sid, $node_sid, $tree_item, $after_tree_item_sid) )
						$result = false;	
				}
			}
		}
		return $result;
	}

}