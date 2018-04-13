<?php

require_once('classifieds/MetaType.php');

class MetaString extends MetaType
{
	function display($display_type)
    {
		if ($display_type == 'input') {
			$display_object = new _MetaStringInput ();
		} elseif ($display_type == 'display') {
			$display_object = new _MetaStringDisplay();			
		}
		return $display_object->display($this->meta_info);
	}
}

class _MetaStringInput
{
	function display($display_info)
    {
        $disabled = empty($this->meta_info['disabled']) ? '' : 'disabled="disabled"';
		return "<input {$disabled} type=\"text\" name=\"{$display_info['name']}\" value=\"{$display_info['value']}\" />";
	}
}

class _MetaStringDisplay
{
	function display($display_info)
    {
		return $display_info['value'];
	}
}

