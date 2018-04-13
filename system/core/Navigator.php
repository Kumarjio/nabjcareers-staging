<?php

class SJB_Navigator
{

	public static function getURI()
	{
		$site_url = parse_url(SJB_System::getSystemSettings('SITE_URL'));
		$request_uri = parse_url($_SERVER['REQUEST_URI']);

		if (isset ($site_url['path'])) 
			return substr($request_uri['path'], strlen($site_url['path']));
		
		return $request_uri['path'];
	}
	
	function getURIThis()
	{
		$request_uri = $_SERVER['REQUEST_URI'];
		return $request_uri;
	}

	function isRequestedUnderLegalURI()
	{
		$site_url = parse_url(SJB_System::getSystemSettings('SITE_URL'));
		$request_uri = parse_url($_SERVER['REQUEST_URI']);
		$isUnderOurHost = $site_url['host'] === $_SERVER['HTTP_HOST'];
		$isInOurPath = isset($site_url['path']) ? strpos($request_uri['path'], $site_url['path']) === 0 : true;
		return $isUnderOurHost && $isInOurPath;
	}
}