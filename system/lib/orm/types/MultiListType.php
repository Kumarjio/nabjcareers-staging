<?php

/*
 * $Id: MultiListType.php 3453 2010-07-02 12:48:59Z nwy $
 */

require_once('orm/types/Type.php');

class SJB_MultiListType extends SJB_Type
{
	
	var $list_values;

	function SJB_MultiListType($property_info)
	{
		parent::SJB_Type($property_info);
		$this->list_values = isset($property_info['list_values']) ? $property_info['list_values'] : array();
		
		$sort_alphabet_property = isset($property_info['sort_by_alphabet']) ? $property_info['sort_by_alphabet'] : 0;
		if ( $sort_alphabet_property == 1 ) { // sorting array by alphabet order
			$i18n = SJB_I18N::getInstance();
			$domain = 'Property_'. $property_info['id'];
			$captions = array();
			foreach($this->list_values as $tmp) {
				$captions[] = $i18n->gettext($domain, $tmp['caption'], 'default');
			}
			array_multisort(array_map('strtolower', $captions), SORT_ASC, SORT_STRING, $this->list_values);
		}
		
		$this->default_template = 'multilist.tpl';
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
				if(strpos($arrValue, ','))
					$value[$key] = explode(',', $arrValue);
				else
					$value[$key] = $arrValue;
			}
		}

		$newPropertyVariables = array(	
						'value'		 		  => $value['value'],
						'default_value'		  => $value['default_value'],
						'profile_field_as_dv' => $value['profile_field_as_dv'],
						'list_values' 		  => $this->list_values,
						'caption'	  		  => $this->property_info['caption'],
						'no_first_option'	  => $this->property_info['no_first_option'],
						'comment' => $this->property_info['comment']);

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
		$result = '';
		if (is_array($this->property_info['value']))
		foreach ($this->property_info['value'] as $value)
			$result .= " $value ";
		return $result;
	}
}

