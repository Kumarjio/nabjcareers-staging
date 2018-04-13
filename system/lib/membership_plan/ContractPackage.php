<?php

class SJB_ContractPackage
{
	var $id					= null;
	var $class_name			= null;
	var $contract_id 		= null;
	var $hashed_fields		= array();
	
	function SJB_ContractPackage($input_info)
	{
		$this->class_name = $input_info['class_name'];
		$this->contract_id = $input_info['contract_id'];
		$this->hashed_fields = $input_info['fields'];
	}
	
	function saveInDB()
	{
		return SJB_DB::query("INSERT INTO contract_packages(`class_name`, `contract_id`, `fields`)"
					. "VALUES(?s, ?n, ?s)", $this->class_name, $this->contract_id, serialize($this->hashed_fields));
	}
	
	function getHashedFields()
	{
		foreach ($this->fields as $field_name => $field_info) {
			$hashed_fields[$field_name] = $field_info['value'];
		}
		return $hashed_fields;
	}
}

