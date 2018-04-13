<?php

require_once('orm/types/Type.php');

class SJB_YouTubeType extends SJB_Type
{
	function SJB_YouTubeType($property_info)
	{
		parent::SJB_Type($property_info);
		
		if (isset($this->property_info['value']))
			$this->property_info['value'] = strip_tags($this->property_info['value']);
			
		$this->default_template = 'youtube.tpl';
	}

	function getPropertyVariablesToAssign()
	{
		return array(	'id' 	=> $this->property_info['id'],
						'value'	=> $this->property_info['value'],
					);
	}

	function isValid()
	{
		$preg1 = preg_match("|http\:\/\/www\.youtube\.com\/watch\?v=|u", $this->property_info['value'], $matches);
		$preg2 = preg_match("|https\:\/\/youtu\.be\/|u", $this->property_info['value'], $matches);
		$preg3 = preg_match("|https\:\/\/www\.youtube\.com\/watch\?v=|u", $this->property_info['value'], $matches);
		
		if ($preg1 || $preg2|| $preg3)
			return true;
		return 'NOT_CORRECT_YOUTUBE_LINK';
	}
	
	function getFieldExtraDetails()
	{
		return array();
	}

	function getSQLValue()
	{
		return "'". mysql_real_escape_string($this->property_info['value']) ."'";
	}

    function getKeywordValue()
    {
		return "";
	}

}