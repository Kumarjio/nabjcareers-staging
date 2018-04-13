<?php

require_once('orm/types/Type.php');

class SJB_StringType extends SJB_Type
{
	function SJB_StringType($property_info)
	{
		parent::SJB_Type($property_info);
		$this->default_template = 'string.tpl';
		if ($this->property_info['id'] == 'ApplicationSettings') {
			$ApplicationSettings = true;
			$value = $this->property_info['value'];
			$this->property_info['value'] = $value;
		}
	}

	function isValid()
	{
		if ($this->hasBadWords()) {
			return 'HAS_BAD_WORDS';
		}
		if (empty($this->property_info['maxlength'])) {
			return true;
		}
		if ($this->property_info['id'] == 'ApplicationSettings') {
			if ($this->property_info['value']['add_parameter'] == 1) {
				if(!ereg("^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-zA-Z]{2,4}\$",  $this->property_info['value']['value'] ))
    				return 'NOT_VALID_EMAIL_FORMAT';
			}
			if (strlen($this->property_info['value']['value']) <= $this->property_info['maxlength']) {
				return true;
			}
		} else{
			if (strlen($this->property_info['value']) <= $this->property_info['maxlength']) {
				return true;
			}
		}
		return 'DATA_LENGTH_IS_EXCEEDED';
	}
	
	function getFieldExtraDetails()
	{
		return array(
			array(
				'id'		=> 'maxlength',
				'caption'	=> 'Maximum Length', 
				'type'		=> 'string',
				'length'	=> '20',
				'value'		=> '256',
				),	
		);
	}

	function getSQLValue()
	{
		if (SJB_Settings::getValue("escape_html_tags") === "htmlpurifier") {
			$filters = str_replace(',', '', SJB_Settings::getSettingByName('htmlFilter')); // выбираем заданные админом тэги для конвертации
			if ($this->property_info['id'] == 'ApplicationSettings') {
				$value = $this->property_info['value'];
				$this->property_info['value'] = $value;
			} else {
				$this->property_info['value'] = strip_tags($this->property_info['value'], $filters);
			}			
		}
		if ($this->property_info['id'] == 'ApplicationSettings' && !empty($this->property_info['value']['add_parameter'])) {
			return "'". mysql_real_escape_string($this->property_info['value']['value']) ."'";
		}
		return "'". mysql_real_escape_string($this->property_info['value']) ."'";
	}

	function getAddParameter()
	{
		if (isset($this->property_info['value']['add_parameter']) && $this->property_info['id'] == 'ApplicationSettings')
			return mysql_real_escape_string($this->property_info['value']['add_parameter']);
		return "";
	}
    function getKeywordValue()
	{
		return $this->property_info['value'];
	}
	
    function htmlspecialchars_decode($string,$style=ENT_COMPAT)
    {
        $translation = array_flip(get_html_translation_table(HTML_SPECIALCHARS,$style));
        return strtr($string, $translation);
    }
    
	function hasBadWords() 
	{
		$badWords = strtolower(SJB_Settings::getSettingByName('bad_words'));
		if (empty($badWords))
			return false;
			
		$badWords = explode(' ', $badWords);
		
		if (empty($this->property_info['value']))
			return false;
		
		if ($this->property_info['id'] == 'ApplicationSettings') {
			$words = preg_split('/[^\w\d]+/iu', strtolower($this->property_info['value']['value']));
		} else {
			$words = preg_split('/[^\w\d]+/iu', strtolower($this->property_info['value']));
		}
		foreach ($badWords as $badWord) {
		    if (in_array($badWord, $words))
		        return true;
		}
		
		return false;
	}
}