<?php

class SJB_StaticContent
{
	function isValidNameID($name, $id)
	{
		if (!isset($name) || $name == '') {
			return 'EMPTY_NAME';
		}
		if (!isset($id) || $id == '') {
			return 'EMPTY_ID';
		}
		if (!SJB_StaticContent::isValidID($id)) {
			return 'INVALID_ID';
		}
		return '';
	}
	
	function isValidID ($id)
	{
		return preg_match("(^\w+$)", $id);
	}
	
	function warning($error_code, $error_message)
	{
		echo "<font color='red'>$error_message</font>";
	}
}
