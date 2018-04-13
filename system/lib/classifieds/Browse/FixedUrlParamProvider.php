<?php

class SJB_FixedUrlParamProvider
{
	function getParams()
	{
		if(!isset($_REQUEST['passed_parameters_via_uri']))
			return array();
		$splitedParts = split("/", $_REQUEST['passed_parameters_via_uri']);
		$parts = array();
		foreach ($splitedParts as $part) {
			if (!in_array($part, array("", "/")))
				$parts[] = urldecode($part);
		}
		return $parts;
	}
}
