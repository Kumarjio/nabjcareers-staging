<?php

require_once("classifieds/MetaType.php");

class MetaList extends MetaType
{
	function display($display_type)
	{
		if ($display_type == 'input') {
			$display_object = new _MetaListInput ();
		} elseif ($display_type == 'display') {
			$display_object = new _MetaListDisplay();			
		}
		return $display_object->display($this->meta_info);
	}
}

class _MetaListInput
{
	function display($display_info)
	{
		$html = "<select name=\"{$display_info['name']}\">";
		foreach ($display_info['available_values'] as $key => $value) {
			$value = htmlspecialchars($value);
			if ($value == $display_info['value']) {
				$html .= "<option value=\"$value\" selected>$value</option>";
			} else {
				$html .= "<option value=\"$value\">$value</option>";
			}
		}
		$html .= "</select>";
		return $html;
	}
}

class _MetaListDisplay
{
	function display($display_info)
	{
		return $display_info['value'];
	}
}

