<?php

require_once('orm/types/Type.php');

class SJB_ListType extends SJB_Type
{
	var $list_values;

	function SJB_ListType($property_info)
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

		$this->default_template = 'list.tpl';
	}

	function getPropertyVariablesToAssign()
	{
		$propertyVariables = parent::getPropertyVariablesToAssign();
		$newPropertyVariables = array(
						'list_values' => $this->list_values,
						'caption'	  => $this->property_info['caption'],
					);
		return array_merge($newPropertyVariables, $propertyVariables);
	}

	function isValid()
	{
		return true;
	}
	
	function getSQLValue()
	{
		return "'". SJB_DB::quote($this->property_info['value']) ."'";
	}

    function getKeywordValue()
	{
		return $this->property_info['value'];
	}
	
}

