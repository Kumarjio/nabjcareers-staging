<?php

define('URI_PART', 'passed_parameters_via_uri');

class SJB_UrlParamProvider{
	function getParams(){
		if(!isset($_REQUEST[URI_PART]))
			return Array();
		$uri_part = $_REQUEST[URI_PART];
		$uri_part = preg_replace("/\/*\?.*$/u", "", $uri_part);
		$uri_part = preg_replace("/\/*$/u", "", $uri_part);
		$uri_part = preg_replace("/^\/+/u", "", $uri_part);
		$uri_part = preg_replace("/\/+/u", "/", $uri_part);
		$parts = array_map('urldecode', split("/", $uri_part));
		return $parts[0]?$parts:Array();
	}
}
