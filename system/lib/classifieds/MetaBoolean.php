<?php

require_once("classifieds/MetaType.php");

class MetaBoolean extends MetaType
{
	function display($display_type)
    {
		if ($display_type == 'input') {
			$display_object = new _MetaBooleanInput();
		} elseif ($display_type == 'display') {
			$display_object = new _MetaBooleanDisplay();			
		}
		return $display_object->display($this->meta_info);
	}
}

class _MetaBooleanInput
{
	function display($display_info)
	{
		$checked = $display_info['value'];
        $disabled = empty($display_info['disabled']) ? '' : 'disabled="disabled"';
		return "<input type=\"hidden\" name=\"{$display_info['name']}\" value=\"0\" />"
				."<input type=\"checkbox\" name=\"{$display_info['name']}\" value=\"1\" {$disabled}" . ($checked ? ' checked="chacked"' : '') . ' />';
	}
}

class _MetaBooleanDisplay
{
	function display($display_info)
	{
		return $display_info['value'] ? 'yes' : 'no';
	}
}

