<?php

require_once('orm/types/IntegerType.php');
require_once('ObjectMother.php');

class SJB_FloatType extends SJB_IntegerType
{	
	function SJB_FloatType($property_info)
	{
		parent::SJB_IntegerType($property_info);
		$this->sql_type 		= 'DECIMAL';
		$this->default_template = 'float.tpl';
	}
	
	function isValid()
	{	
		$value = $this->property_info['value'];
		
		$i18n =& SJB_ObjectMother::createI18N();
		if ($i18n->isValidFloat($value)) {
			$value = $i18n->getInput('float', $value);
		}
		else {
			return 'NOT_FLOAT_VALUE';
		}

		if (!is_null($this->minimum) && is_numeric($this->minimum) && $value < $this->minimum)
			return 'OUT_OF_RANGE';

		if (!is_null($this->maximum) && is_numeric($this->maximum) && $value > $this->maximum)
			return 'OUT_OF_RANGE';
		
		return true;
	}
	
	function getSQLValue()
	{
		return "'" . $this->_format_value_with_signs_num() . "'";
	}

    function getKeywordValue()
    {
		return $this->_format_value_with_signs_num();
	}
	
	function _format_value_with_signs_num()
	{
		$i18n =& SJB_ObjectMother::createI18N();
		$value = $i18n->getInput('float', $this->property_info['value']);
			
		if (isset($this->property_info['signs_num']) && is_numeric($this->property_info['signs_num'])) {			
			return sprintf("%0." . $this->property_info['signs_num'] . "f", $value);
		}
		
		return $value;
	}

	function getFieldExtraDetails()
	{
		return array(
			array(
				'id'		=> 'minimum',
				'caption'	=> 'Minimum Value', 
				'type'		=> 'float',
				'minimum'	=> '',
				),
			array(
				'id'		=> 'maximum',
				'caption'	=> 'Maximum Value', 
				'type'		=> 'float',
				'minimum'	=> '',
				),
			array(
				'id'		=> 'signs_num',
				'caption'	=> 'Signs number after comma', 
				'type'		=> 'integer',
				'minimum'	=> 0,
				),
		);
	}
}

