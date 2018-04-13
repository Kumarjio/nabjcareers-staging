<?php

class SJB_TemplatePathManager
{
	
	public static function getAbsoluteThemeCachePath($theme)
	{
		return SJB_Path::combine(SJB_System::getSystemSettings('COMPILED_TEMPLATES_DIR'),'user',$theme);
	}

	public static function getAbsoluteTemplatesPath ($access_type = null)
	{
		$up_path = (SJB_System::getSystemSettings('SYSTEM_ACCESS_TYPE') == 'admin') ? '../' : '';
		return $up_path . SJB_System::getSystemSettings('TEMPLATES_DIR');
	}

	public static function getAbsoluteThemePath ($theme, $access_type = null)
	{
		return SJB_TemplatePathManager::getAbsoluteTemplatesPath($access_type) . $theme . '/';
	}

	public static function getAbsoluteModuleTemplatesPath ($theme, $module , $access_type = null)
	{
		return SJB_TemplatePathManager::getAbsoluteThemePath($theme , $access_type).$module.'/';
	}

	public static function getAbsoluteTemplatePath ($theme, $module, $template, $access_type = null)
	{
		return SJB_TemplatePathManager::getAbsoluteModuleTemplatesPath ($theme, $module , $access_type).$template;
	}

	public static function getAbsoluteImagePath ($theme, $module, $image = '')
	{
		return SJB_TemplatePathManager::getAbsoluteModuleTemplatesPath ($theme, $module) . 'images/' . $image;
	}

}
