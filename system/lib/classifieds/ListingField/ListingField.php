<?php

require_once 'orm/Object.php';
require_once 'ListingFieldDetails.php';

class SJB_ListingField extends SJB_Object
{
	var $listing_type_sid;
	var $field_type;
	var $order; 
	
	function SJB_ListingField($listing_field_info, $listing_type_sid = 0, $pages_list = array())
	{
		$this->db_table_name = 'listing_fields';
		$this->details = new SJB_ListingFieldDetails($listing_field_info, $pages_list);
		$this->setListingTypeSID($listing_type_sid);
		$this->field_type = isset($listing_field_info['type']) ? $listing_field_info['type'] : null;
		$this->order = isset($listing_field_info['order']) ? $listing_field_info['order'] : null;
	}
	
	function setListingTypeSID($listing_type_sid)
	{
		$this->listing_type_sid = $listing_type_sid;
	}
	
	function getOrder()
	{
		return $this->order;
	}
	
	function getListingTypeSID()
	{
		return $this->listing_type_sid;
	}
	
	function getFieldType()
	{
		return $this->field_type;
	}
	
	function addInfillInstructions($value='')
	{
		$this->addProperty($this->details->getInfillInstructions($value));
	}

}