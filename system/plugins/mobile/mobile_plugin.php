<?php

require_once("plugins/PluginAbstract.php");

class MobilePlugin extends SJB_PluginAbstract
{
	function pluginSettings()
	{
		return array( 
			array (
				'id'			=> 'mobile_url',
				'caption'		=> 'Mobile version url',
				'type'			=> 'string',
				'comment'		=> '',
				'length'		=> '50',
				'order'			=> null,
			),
			array (
				'id'			=> 'detect_iphone',
				'caption'		=> 'Automatically detect iPhone and switch to mobile version',
				'type'			=> 'boolean',
				'length'		=> '50',
				'order'			=> null,
			),
		);
	}

	/**
	 * @param string $theme Original theme
	 */
	public static function getCurrentTheme($theme)
	{
		if (str_replace('www.', '', $_SERVER['HTTP_HOST']) === SJB_Settings::getValue('mobile_url')
				|| ( 'mobile.trials.smartjobboard.com' == $_SERVER['HTTP_HOST'] && getenv('SJB_APPLICATION_MODE') == 'trial' )
				|| (SJB_Settings::getValue('detect_iphone') && self::isIPhone()) )
			return 'mobile';
		return $theme;
	}
	
	public static function isIPhone()
	{
		$httpUserAgent = SJB_Request::getVar('HTTP_USER_AGENT', null, 'SERVER');
		return strpos(strtolower($httpUserAgent), 'iphone') !== false;
	}
	
	public static function canApplyWithoutResume()
	{
		$theme = SJB_Session::getValue('theme');
		if (self::getCurrentTheme($theme) == 'mobile')
			SJB_Event::$data = true;
		return false;
	}
	
}