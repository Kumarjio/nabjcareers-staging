<?php

require_once("orm/types/ListItem/ListItemManager.php");

class SJB_ScreeningQuestionnairesListItemManager extends SJB_ListItemManager
{
	function SJB_ScreeningQuestionnairesListItemManager()
	{
		$this->table_prefix = 'questions';
	}
	
	function saveListItem(&$list_item) {

		$item_sid = $list_item->getSID();

		if ( is_null($item_sid) ) {

			$max_order = SJB_DB::query("SELECT MAX(`order`) FROM ".$this->table_prefix."_field_list WHERE field_sid = ?n", $list_item->getFieldSID());
			
			$max_order = empty($max_order) ? 0 : array_pop(array_pop($max_order));

			return SJB_DB::query("INSERT INTO ".$this->table_prefix."_field_list SET field_sid = ?n, value = ?s, `order` = ?n, score = ?s", $list_item->getFieldSID(), $list_item->getValue(), ++$max_order, $list_item->score);

		} else {

			return SJB_DB::query("UPDATE ".$this->table_prefix."_field_list SET value = ?s WHERE sid = ?n", $list_item->getValue(), $item_sid);

		}

	}
	
	function deleteItemsByFieldSID($field_sid) 
	{
		SJB_DB::query("DELETE FROM questions_field_list WHERE field_sid = ?n" . $field_sid);
	}
	
	function getHashedListItemsByFieldSID($listing_field_sid) {

		$items = SJB_DB::query("SELECT * FROM " . $this->table_prefix . "_field_list WHERE field_sid = ?n ORDER BY `order`",  $listing_field_sid);

		$list_items = array();

		foreach ($items as $item) {

			$list_items['answer'][$item['sid']] = $item['value'];
			$list_items['score'][$item['sid']] = $item['score'];

		}

		return $list_items;

	}
	
	function getHashedListItemsByFieldSIDForApply($listing_field_sid) {

		$items = SJB_DB::query("SELECT * FROM " . $this->table_prefix . "_field_list WHERE field_sid = ?n ORDER BY `order`",  $listing_field_sid);

		$list_items = array();

		foreach ($items as $item) {

			$list_items[$item['sid']]['value'] = $item['value'];
			$list_items[$item['sid']]['score'] = $item['score'];

		}

		return $list_items;

	}

}

