<?php

require_once('orm/types/StringType.php');

class SJB_IdStringType extends SJB_StringType
{
	function isValid()
	{
		if (preg_match("/[^_\w\d]/", $this->property_info['value'])) {
			return 'NOT_VALID_ID_VALUE';
		}
		return true;
	}
}
