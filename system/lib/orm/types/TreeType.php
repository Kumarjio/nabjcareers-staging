<?php

require_once 'orm/types/Type.php';
require_once 'classifieds/ListingField/ListingFieldTreeManager.php';

class SJB_TreeType extends SJB_Type
{
	var $tree_values;
	var $assoc_display = array();
	var $sel_count;
	
	function SJB_TreeType($property_info)
	{
		parent::SJB_Type($property_info);
		$this->tree_values = isset($property_info['tree_values']) ? $property_info['tree_values'] : array();
		$this->default_template = 'tree.tpl';
		if ( !empty($property_info['display_as_select_boxes'] ) )
		{
			$this->default_template = 'tree_select_bexes.tpl';
		}

		$value = isset($this->property_info['value']) ? $this->property_info['value'] : null;
		$this->setValue($value);
	}
	
	function setValue($value)
	{
		if (!is_array($value))
			$this->display_value = explode(',', $value);
		else
			$this->display_value = $value;
		
		$this->assoc_display = $this->makeAssociateArrayToOutput();
		$this->sel_count = $this->getSelectedCount();
	}
	
	function getSelectedCount()
	{
		$count = 0;
		if (is_array($this->display_value)) {
			foreach ($this->display_value as $one) {
				if (empty($one))
				    continue;
				if (!key_exists($one, $this->tree_values))
				    $count++;
			}
		}
		return $count;
	}
	
	function getPropertyVariablesToAssign()
	{
		$propertyVariables = parent::getPropertyVariablesToAssign();
		$arrValues = array(
			'value' => $this->property_info['value'],
			'default_value' => $this->property_info['default_value'],
			'profile_field_as_dv' => $this->property_info['profile_field_as_dv']);

		foreach ($arrValues as $key => $arrValue) {
			if (is_array($arrValue)) {
				$value[$key] = $arrValue;
			}
			else {
				if (strpos($arrValue, ',')) {
					$value_str = $arrValue;
					// delete ',' at the end of string, if that exists
					$value_str = preg_replace("|,\s*$|", '', $value_str );
					$value[$key] = explode(',', $value_str);
				}
				else {
					$value[$key] = $arrValue;
				}
			}
		}
		$newPropertyVariables =  array (
			'sid'		=> $this->property_info['sid'],
			'value'		=> $value['value'], 
			'default_value'		  => $value['default_value'],
			'profile_field_as_dv' => $value['profile_field_as_dv'],
			'tree_values'		=> $this->tree_values, 
			'display_value' 	=> $this->display_value,
			'assoc_display'		=> $this->assoc_display,
			'count'				=> $this->sel_count,
			'assoc_array'		=> $this->makeAssociateArrayToOutput(true),
		);
		return array_merge($propertyVariables, $newPropertyVariables);
	}
	
	function isValid()
	{
		return true;
	}
	
	function getSQLValue()
	{
		$str = '';
		if (is_array($this->property_info['value']))
			$str = implode(',', $this->property_info['value']);
		else
			$str = (string) $this->property_info['value'];
		return "'" . SJB_DB::quote($str) . "'";
	}
	
	function getKeywordValue()
	{
		if (is_array($this->display_value)) {
			$tmp = '';
			foreach ($this->display_value as $val) {
				if (!empty($val)) {
					$parents = array();
					$items = SJB_DB::Query("SELECT * FROM `listing_field_tree` WHERE `sid` IN ({$val})");
					if (count($items) > 0) { 
						foreach ($items as $item) {
							if ($item['parent_sid'] != 0 && !isset($parents[$item['parent_sid']])) {
								$tmp .= $this->getTreeStringValueById($item['parent_sid']) . ' ';
								$parents[$item['parent_sid']] = 1;
							}
							$tmp .= $this->getTreeStringValueById($item['sid']) . ' ';
						}
					}
				}
			}
			return $tmp;
		}
		return $this->display_value;
	}
		
	function displayChild($id, $asArray = false)
	{
		$tmp = '';
		if ($asArray)
			$tmp = array();
		if (is_array($this->tree_values)) {
			foreach ($this->tree_values[$id] as $one) {
				if (in_array($one['sid'], $this->display_value)) {
					if ($asArray) {
						if (!empty($one['caption']))
							$tmp[] = $one['caption'];
					}
					else {
						$tmp .= (!empty($tmp) ? ', ' : '') . $one['caption'];
					}
				}
				if (key_exists($one['sid'], $this->tree_values)) {
					if ($asArray) {
						$child = $this->displayChild($one['sid']);
						if (!empty($child))
							$tmp[] = $child;
					}
					else {
						$tmp .= (!empty($tmp) ? ', ' : '') . $this->displayChild($one['sid']);
					}
				}
			}
		}
		return $tmp;
	}
	
	function makeAssociateArrayToOutput($asArray = false)
	{
		$tmp = array();
		if (isset($this->tree_values[0])) {
			foreach ($this->tree_values[0] as $root_item) { // root item
				if (key_exists($root_item['sid'], $this->tree_values)) {
					$child = $this->displayChild($root_item['sid'], $asArray);
					if (!empty($child))
						$tmp[$root_item['caption']] = $child;
				}
                if (in_array($root_item['sid'], $this->display_value) && !empty($tmp[$root_item['caption']])) {
					unset($tmp[$root_item['caption']]);
                }
			}
		}
		return $tmp;
	}
	
	function getValue()
	{
		$tmp = ''; 
		foreach ($this->assoc_display as $key => $val) {
		 	$tmp .= "<b>{$key}</b> : {$val}<br/>";	
		}
		return $tmp;
	}
	
	function getTreeStringValueById($id)
	{
		$res = SJB_DB::query("SELECT `caption` FROM `listing_field_tree` WHERE `sid` = ?s", $id);
		return (count($res) > 0 ? array_pop(array_pop($res)) : '');
	}
	
	function getDisplayValue()
	{
		if (is_array($this->display_value))
			return implode (', ', $this->display_value);
		return $this->display_value;
	}
	
	function getFieldExtraDetails()
	{
		return array();
	}

	function getDisplayAsDetail($value){
		return array(
					'id' => 'display_as_select_boxes',
					'caption' => 'Display as',
					'type' => 'boolean',
					'table_name' => 'listing_fields',
					'length' => '20',
					'is_required' => false,
					'is_system' => false,
					'value' => $value,
		);
	}
	function isEmpty()
	{
		$value_is_empty = false;
	    if (is_array($this->property_info['value'])) {
	        foreach ($this->property_info['value'] as $field_value) {
	        	$field_value = trim($field_value);
	            if ($field_value == '') {
	                $value_is_empty = true;
	                break;
	            }
	        }
	    } else {
	    	$this->property_info['value'] = trim($this->property_info['value']);
	        $value_is_empty = ($this->property_info['value'] == '');
	    }
	    return $value_is_empty;
	}

	public function displayAsSelect()
	{
		return isset($this->property_info['display_as_select_boxes']) ? $this->property_info['display_as_select_boxes'] : null;
	}
}

