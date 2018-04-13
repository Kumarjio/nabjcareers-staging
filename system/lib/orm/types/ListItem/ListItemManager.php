<?php


require_once("orm/types/ListItem/ListItem.php");

class SJB_ListItemManager {

	var $table_prefix = null;

	function saveListItem(&$list_item) {

		$item_sid = $list_item->getSID();

		if ( is_null($item_sid) ) {

			$max_order = SJB_DB::query("SELECT MAX(`order`) FROM ".$this->table_prefix."_field_list WHERE field_sid = ?n", $list_item->getFieldSID());
			
			$max_order = empty($max_order) ? 0 : array_pop(array_pop($max_order));

			return SJB_DB::query("INSERT INTO ".$this->table_prefix."_field_list SET field_sid = ?n, value = ?s, `order` = ?n", $list_item->getFieldSID(), $list_item->getValue(), ++$max_order);

		} else {

			return SJB_DB::query("UPDATE ".$this->table_prefix."_field_list SET value = ?s WHERE sid = ?n", $list_item->getValue(), $item_sid);

		}

	}

	function getHashedListItemsByFieldSID($listing_field_sid) {

		$items = SJB_DB::query("SELECT * FROM " . $this->table_prefix . "_field_list WHERE field_sid = ?n ORDER BY `order`",  $listing_field_sid);

		$list_items = array();

		foreach ($items as $item) {

			$list_items[$item['sid']] = $item['value'];

		}

		return $list_items;

	}

	function deleteListItemBySID($list_item_sid) {

		return SJB_DB::query("DELETE FROM " . $this->table_prefix."_field_list WHERE sid = ?n", $list_item_sid);

	}
	
	function moveUpItem($item_sid) {
		
		$item_info = SJB_DB::query("SELECT * FROM " . $this->table_prefix."_field_list WHERE sid = ?n", $item_sid);
		
		if (empty($item_info))	return false;
		
		$item_info = array_pop($item_info);
		
		$current_order = $item_info['order'];	$field_sid = $item_info['field_sid'];
		
		$up_order = SJB_DB::query("SELECT MAX(`order`) FROM " . $this->table_prefix."_field_list WHERE field_sid = ?n AND `order` < ?n", $field_sid, $current_order);
		
		if (empty($up_order))	return false;
		
		$up_order = array_pop(array_pop($up_order));
		
		SJB_DB::query("UPDATE " . $this->table_prefix."_field_list SET `order` = ?n WHERE field_sid = ?n AND `order` = ?n", $current_order, $field_sid, $up_order);
		
		SJB_DB::query("UPDATE " . $this->table_prefix."_field_list SET `order` = ?n WHERE sid = ?n", $up_order, $item_sid);
		
		return true;
		
	}
	
	function moveDownItem($item_sid) {
		
		$item_info = SJB_DB::query("SELECT * FROM " . $this->table_prefix."_field_list WHERE sid = ?n", $item_sid);
		
		if (empty($item_info))	return false;
		
		$item_info = array_pop($item_info);
		
		$current_order = $item_info['order'];	$field_sid = $item_info['field_sid'];
		
		$less_order = SJB_DB::query("SELECT MIN(`order`) FROM " . $this->table_prefix."_field_list WHERE field_sid = ?n AND `order` > ?n", $field_sid, $current_order);
		
		if (empty($less_order))	return false;
		
		$less_order = array_pop(array_pop($less_order));
		
		SJB_DB::query("UPDATE " . $this->table_prefix."_field_list SET `order` = ?n WHERE field_sid = ?n AND `order` = ?n", $current_order, $field_sid, $less_order);
		
		SJB_DB::query("UPDATE " . $this->table_prefix."_field_list SET `order` = ?n WHERE sid = ?n", $less_order, $item_sid);
		
		return true;
		
		
		
	} 
	
	function sortItems($field_sid, $sorting_order = 'ASC') 
	{
		if ((strtolower($sorting_order) <> 'asc') && (strtolower($sorting_order) <> 'desc'))
			$sorting_order = 'ASC';
		
		$items_info = SJB_DB::query("SELECT * FROM " . $this->table_prefix."_field_list WHERE field_sid = ?n ORDER BY `value` ". $sorting_order, $field_sid);
		
		if (empty($items_info))	
			return false;
		
		$i = 1;
		foreach ($items_info as $item) {
			SJB_DB::query("UPDATE " . $this->table_prefix."_field_list SET `order` = ?n WHERE sid = ?n", $i, $item['sid']);
			$i++;
		}
		
		return true;		
	} 
	
	function getListItemBySID($list_item_sid) {

		$item_info = SJB_DB::query("SELECT * FROM ".$this->table_prefix."_field_list WHERE sid = ?n", $list_item_sid);

		if (!empty($item_info))
		{
			$item_info = array_pop($item_info);
			
			$list_item = new SJB_ListItem();			
			$list_item->setValue($item_info['value']);
			$list_item->setFieldSID($item_info['field_sid']);
			$list_item->setSID($list_item_sid);
			
			return $list_item;
		}
		else
			return null;
	}
	
	function getListItemByValue($field_sid, $value)
	{
		$item_info = SJB_DB::query("SELECT * FROM `{$this->table_prefix}_field_list` WHERE `field_sid`=?n AND `value`=?s", $field_sid, $value);
		
		if (!empty($item_info))
		{
			$item_info = array_pop($item_info);
			
			$list_item = new SJB_ListItem();			
			$list_item->setValue($item_info['value']);
			$list_item->setFieldSID($item_info['field_sid']);
			$list_item->setSID($item_info['sid']);
			
			return $list_item;
		}
		else
			return null;
	}
	
	
	function saveNewItemsOrder($item_sids) {
		$count = 1;
		foreach ($item_sids as $item_sid=>$val) {
			SJB_DB::query("UPDATE " . $this->table_prefix."_field_list SET `order` = ?n WHERE sid = ?n", $count, $item_sid);
			$count++;
		}
		
		return true;
	}
}

