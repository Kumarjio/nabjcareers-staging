<?php

require_once 'orm/types/Type.php';
require_once 'miscellaneous/Currency/Currency.php';

class SJB_MonetaryType extends SJB_Type
{
	var $currency_values;
	
	function SJB_MonetaryType($property_info)
	{
		parent::SJB_Type($property_info);
		$this->sql_type = 'DECIMAL';
		$this->currency_values = isset ( $property_info ['currency_values'] ) ? $property_info ['currency_values'] : array ();
		if (isset($this->property_info['value']) && !is_array($this->property_info['value'])){
			$value = $this->property_info['value'];
			unset($this->property_info['value']);
			$this->property_info['value']['value'] = $value;
		}
		$currency = isset($this->property_info['value']['add_parameter']) ? SJB_CurrencyManager::getCurrencyBySID($this->property_info['value']['add_parameter']) : '';
		$this->property_info['value']['currency_sign'] = (isset($currency['currency_sign']) && is_numeric($this->property_info['value']['value'])) ? $currency['currency_sign'] : '';
		$this->property_info['value']['course']        = isset($currency['course']) ? $currency['course'] : 1;
		$this->property_info['value']['currency_code'] = isset($currency['currency_code']) ? $currency['currency_code'] : '';
		$this->default_template = 'monetary.tpl';
	}
	
	function getPropertyVariablesToAssign()
	{
		$value = '';
		$numeric = 0;
		if ($this->property_info['value'] != '')
			$value = array('value'=>$this->property_info['value']['value'], 'currency' => $this->property_info['value']['add_parameter']);
		if (is_numeric($value))
			$numeric = 1;
		return array(	'id' 	=> $this->property_info['id'],
						'value'	=> $value,
						'numeric'	=> $numeric,
						'default_value' => $this->property_info['default_value'],
						'list_currency' => $this->currency_values,
					);
	}
	
	function isValid()
	{
		$i18n =& SJB_ObjectMother::createI18N();
		$value = $this->property_info['value']['value'];
		if ($i18n->isValidFloat($value)) {
			if (!empty($this->property_info['value']['add_parameter']))
				return true;
			else 
				return 'CURRENCY_SIGN_IS_EMPTY';
		}
		if (is_string($this->property_info['value']['value'])) {
			if (!preg_match('/[^\p{L}\d ]/u', $this->property_info['value']['value'])) {
				if ($this->hasBadWords()) {
					return 'HAS_BAD_WORDS';
				}
				return true;
			}
			else
				return 'NOT_VALID_ID_VALUE';
		}
		return 'NOT_VALID_ID_VALUE';
	}
	
	function getFieldExtraDetails()
	{
		return array();
	}

	function getSQLValue()
	{
		$i18n =& SJB_ObjectMother::createI18N();
		$value = $this->property_info['value']['value'];
		if ($i18n->isValidFloat($value)) 
			return "'". $i18n->getInput('float', $this->property_info['value']['value']) . "'";
		
		return "'". mysql_real_escape_string($this->property_info['value']['value']) ."'";
	}
	
	function getAddParameter()
	{
		if (isset($this->property_info['value']['add_parameter']))
			return mysql_real_escape_string($this->property_info['value']['add_parameter']);
		return '';
	}
	
    function getKeywordValue()
    {
		return '';
	}
	
	function isEmpty()
	{
		$value_is_empty = false;
	    if (is_array($this->property_info['value'])) {
	    	if (trim($this->property_info['value']['value']) == '')
 				$value_is_empty = true;
	    } else {
	    	$value_is_empty = true; 
	    }
	    return $value_is_empty;
	}
	
	function hasBadWords() 
	{
		$badWords = explode(' ', SJB_Settings::getSettingByName('bad_words'));
		
		if (empty($this->property_info['value']['value']))
			return false;
		
		$words = preg_split('/[^\w\d]+/iu', $this->property_info['value']['value']);
		foreach ($badWords as $badWord) {
		    if (in_array($badWord, $words))
		        return true;
		}
		
		return false;
	}
	
}