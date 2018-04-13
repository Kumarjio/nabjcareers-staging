<?php

require_once("membership_plan/PackageSQL.php");

class SJB_Package
{
	
	var $id					= null;
	var $class_name			= null;
	var $membership_plan_id = null;
	var $fields				= array();

	function SJB_Package($input_info)
	{
		if ( isset($input_info['id']) ) {
			$this->_getDataBaseValues($input_info['id']);
		} else {
			$this->class_name = $input_info['class_name'];
			$this->_getFields();
			$this->membership_plan_id = $input_info['membership_plan_id'];
		}
		
		$this->_copyInputValues($input_info);
	}
	
	function getFieldsInfo()
	{
		return $this->fields;
	}
	
	function _copyInputValues(&$input_info)
	{
		foreach ($this->fields as $field_name => $field)
			if ( isset($input_info[$field_name]) )
				$this->fields[$field_name]['value'] = $input_info[$field_name];
	}
	
	function _getDataBaseValues($id)
	{
		$db_info = SJB_PackageSQL::getPackageByID($id);
		if ($db_info) {			
			$this->id = $db_info['id'];
			$this->membership_plan_id = $db_info['membership_plan_id'];
			$this->class_name = $db_info['class_name'];			
			$this->_getFields();
			foreach ($this->fields as $field_name => $field_info) {
				if ( isset($db_info['fields'][$field_name]) )
					$this->fields[$field_name]['value'] = $db_info['fields'][$field_name];
			}
		}
		
	}
	
	function _getFields()
	{
		require_once 'classifieds/ListingPackage.php';
		$obj = new SJB_ListingPackage();
		$this->fields = $obj->getFieldsInfo();
	}
	
	function saveInDB()
	{
		if (!is_null($this->id)) {			
			return SJB_PackageSQL::update($this->id, $this->getHashedFields());
		}
		
		return SJB_PackageSQL::insert($this->class_name, $this->membership_plan_id, $this->getHashedFields());
	}
	
	function getHashedFields()
	{
		foreach ($this->fields as $field_name => $field_info) {
			$hashed_fields[$field_name] = $field_info['value'];
		}
		return $hashed_fields;
	}
	
	function getListingQuantity()
	{
		return SJB_PackageSQL::getListingQuantity($this->id);	
	}
	
	function delete()
	{
		return SJB_PackageSQL::delete($this->id);
	}
}
