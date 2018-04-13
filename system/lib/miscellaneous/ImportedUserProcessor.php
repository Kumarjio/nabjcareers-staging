<?php

require_once('miscellaneous/TreeParser.php');
require_once('miscellaneous/TreeInfoSearcher.php');

class SJB_ImportedUserProcessor
{
	var $properties_names;
	var $properties_values;
	//var $pictures_key;
	var $current_key = 0;
	var $properties_quantity;
	var $tree_columns;
	//var $listing_type;
	
	var $user_group;

	function SJB_ImportedUserProcessor($input_data, $user) 
	{
		$this->user_group = $user->getUserGroupSID();
		$this->properties_names = array_shift($input_data);
		$tree_parser = new SJB_TreeParser($this->properties_names);
		$this->tree_columns = $tree_parser->getTreeColumns();
		$this->_unsetTreeColumnsNames($tree_parser->columns);
		$this->properties_values = $input_data;
		$this->properties_quantity = count($this->properties_values);
	}
	
	function getPropertiesNames()
	{
	    return $this->properties_names;
	}
	
	function getData($non_existed_values_flag) 
	{
		$values = $this->_getPropertiesData();
		$result	= array();
		foreach($this->properties_names as $key => $property_name)
			$result[$property_name] = isset($values[$key]) ? $values[$key] : null;
		
		$result = $result + $this->_getTreeValues($values, $non_existed_values_flag);
		return $result;
	}
	
	function _getTreeValues($values, $non_existed_values_flag) 
	{
		$result = array();
		foreach($this->tree_columns as $tree_column_name => $tree_column_indexes) {
			$tree_captions = $this->_getTreeColumnValue($tree_column_indexes, $values);
			
			if($tree_captions) {
				$tree_sid_searcher = new SJB_TreeUserSearcher($tree_column_name, $tree_captions, $this->user_group);
				$tree_info = $tree_sid_searcher->getInfo();
				
				$result[$tree_column_name] = $tree_info ? $tree_info['sid'] : null;
			}
		}
		return $result;
	}

	function _getTreeColumnValue($columns, $values)
	{
		$result = array();
		foreach($columns as $column)
			if (isset($values[$column]) )$result[] = $values[$column];
		return $result;
	}

	function _unsetTreeColumnsNames($repeated_columns)
	{
		foreach($repeated_columns as $repeated_column)
			if (!is_null (array_search($repeated_column, $this->properties_names) ))
				unset($this->properties_names[array_search($repeated_column, $this->properties_names)]);
	}

	function isEmpty()
	{
	    return $this->current_key >= $this->properties_quantity;
	}

	function _getPropertiesData()
	{
	    return $this->properties_values[$this->current_key++];
	}
}
