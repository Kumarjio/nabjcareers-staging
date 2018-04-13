<?php

require_once('StringType.php');

class SJB_TextType extends SJB_StringType
{
    function SJB_TextType($property_info)
	{       
		parent::SJB_StringType($property_info);
		$this->default_template = !empty($this->property_info['template']) ? $this->property_info['template'] : 'text.tpl';
	}
	
	function getFieldExtraDetails()
	{
		return array(
			array(
				'id'		=> 'maxlength',
				'caption'	=> 'Maximum Length', 
				'type'		=> 'string',
				'length'	=> '20',
				),
			array(
				'id'		=> 'template',
				'caption'	=> 'Template', 
				'type'		=> 'string',
				'length'	=> '20',
				'value'		=> 'text.tpl',
				),
		);
	}
	
}

