<?php

require_once("classifieds/MetaType.php");

class MetaFloat extends MetaType
{
	function display($display_type)
	{
		if ($display_type == 'input') {
			$display_object = new _MetaFloatInput();
		} elseif ($display_type == 'display') {
			$display_object = new _MetaFloatDisplay();			
		}
		return $display_object->display($this->meta_info);
	}
}

class _MetaFloatInput
{
	function display($display_info)
	{
		return "<input type=\"text\" name=\"{$display_info['name']}\" value=\"{$display_info['value']}\">";
	}
}

class _MetaFloatDisplay
{
	function display($display_info)
	{
		return $display_info['value'];
	}
}

