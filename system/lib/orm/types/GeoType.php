<?php

require_once('orm/types/Type.php');
require_once("orm/Location/LocationManager.php");

class SJB_GeoType extends SJB_Type
{
	function SJB_GeoType($property_info)
	{
		parent::SJB_Type($property_info);
		$this->default_template = 'geo.tpl';
	}

	function isValid()
	{
		if (SJB_LocationManager::doesLocationExist($this->property_info['value'])) {
			return true;
		}
		return 'LOCATION_NOT_EXISTS';
	}

    function getKeywordValue()
	{
		return $this->property_info['value'];
	}
	
	function getSQLValue()
	{
		return "'". SJB_WrappedFunctions::mysql_real_escape_string($this->property_info['value']) ."'";
	}
}
