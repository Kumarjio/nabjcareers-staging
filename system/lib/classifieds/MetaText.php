<?php


require_once("classifieds/MetaType.php");

class MetaText extends MetaType {
	
	function display($display_type) {
	
		if ($display_type == 'input') {
			$display_object = new _MetaTextInput();
		} elseif ($display_type == 'display') {
			$display_object = new _MetaTextDisplay();			
		}
		return $display_object->display($this->meta_info);
	
	}

}

class _MetaTextInput {

	function display($display_info) {
		return "<textarea name=\"{$display_info['name']}\">{$display_info['value']}</textarea>";
	}

}

class _MetaTextDisplay {

	function display($display_info) {
		return $display_info['value'];
	}

}

