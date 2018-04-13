<?php

require_once('orm/types/Type.php');

class SJB_BooleanType extends SJB_Type
{
    function SJB_BooleanType($property_info)
	{
		parent::SJB_Type($property_info);
		$this->default_template = 'boolean.tpl';
	}

	function getPropertyVariablesToAssign()
	{
		$propertyVariables = parent::getPropertyVariablesToAssign();
		$newPropertyVariables = array(
						'caption' => $this->property_info['caption'],
						'comment' => $this->property_info['comment'],
					);
		return array_merge($newPropertyVariables, $propertyVariables);
	}

	function isValid()
	{
		return true;
	}
	
	function getSQLValue()
	{
		return intval($this->property_info['value']);
	}
	
	function getKeywordValue()
	{
		return $this->property_info['value'] ? $this->property_info['caption'] : "";
	}
 
}

