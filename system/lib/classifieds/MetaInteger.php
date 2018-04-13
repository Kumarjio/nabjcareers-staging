<?php


require_once("classifieds/MetaType.php");

class MetaInteger extends MetaType {
	
	function display($display_type) {
	
		if ($display_type == 'input') {
			$display_object = new _MetaIntegerInput ();
		} elseif ($display_type == 'display') {
			$display_object = new _MetaIntegerDisplay();			
		}
		return $display_object->display($this->meta_info);
	
	}

}

class _MetaIntegerInput {

	function display($display_info) {
		return "<input type=\"text\" name=\"{$display_info['name']}\" value=\"{$display_info['value']}\">";
	}

}

class _MetaIntegerDisplay {

	function display($display_info) {
		return $display_info['value'];
	}

}

