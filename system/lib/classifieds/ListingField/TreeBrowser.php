<?php

class SJB_TreeBrowser {

	var $property_id;
	var $property_sid;
	var $tree_depth;

	function SJB_TreeBrowser($property_id) {
		$this->property_id = $property_id;
		$this->_setPropertySID();
		$this->_setDepth();
	}

	function _setDepth() {
		$result = array_pop(SJB_DB::query("SELECT MAX(`level`) FROM `listing_field_tree` WHERE `field_sid`=?n", $this->property_sid));
		$this->tree_depth = $result ? array_pop($result) - 1 : null;
	}

	function _setPropertySID() {
		$result = array_pop(SJB_DB::query("SELECT sid FROM `listing_fields` WHERE `id`=?s", $this->property_id));
		$this->property_sid = $result ? $result['sid'] : null;
	}

	function getWhatPart() {
		$field_names = array();
		for($i = 0; $i <= $this->tree_depth; $i++)
			$field_names[] = "{$this->property_id}_{$i}.caption AS {$this->property_id}_{$i}";
		return join(", ", $field_names);
	}

	function getJoinPart() {
		$result = null;
		for($i = $this->tree_depth; $i--; $i >= 0)
			$result .= "LEFT JOIN listing_field_tree {$this->property_id}_$i ON ({$this->property_id}_".($i+1).".parent_sid={$this->property_id}_{$i}.sid) ";
		return "LEFT JOIN listing_field_tree {$this->property_id}_{$this->tree_depth} ON ({$this->property_id}.value={$this->property_id}_{$this->tree_depth}.sid)" .
				$result;
	}

	function getOrderPart($order) {
		$field_names = array();
		for($i = 0; $i <= $this->tree_depth; $i++)
			$field_names[] = "{$this->property_id}_{$i} $order";
		return "ORDER BY " . join(", ", $field_names);
	}

}
