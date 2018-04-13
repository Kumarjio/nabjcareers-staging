<?php

if ( class_exists('SJB_SocialPlugin') && in_array('linkedin', SJB_SocialPlugin::getAvailablePlugins()) && SJB_Settings::getSettingByName('li_companyWidget'))
{
	$tp = SJB_System::getTemplateProcessor();
	
	if (empty($_REQUEST['companyName']))
	{
		return null;
	}
	
	$tp->assign('companyName', $_REQUEST['companyName']);
	$tp->display('company_insider_widget.tpl');
}

