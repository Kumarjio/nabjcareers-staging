<?php

if ( ! SJB_Authorization::isUserLoggedIn() && class_exists('SJB_SocialPlugin') && '/registration-social/' != SJB_Navigator::getUri() && $aPlugins = SJB_SocialPlugin::getAvailablePlugins())
{
	$tp = SJB_System::getTemplateProcessor();
	
	$userGroupID = SJB_Request::getVar('user_group_id', null);
	
	/**
	 * delete from pluginsArray plugins that are not allowed 
	 * for this userGroup registration
	 */
	SJB_SocialPlugin::preparePluginsThatAreAvailableForRegistration($aPlugins, $userGroupID);

	if(empty($aPlugins))
	{
		return null;
	}

	if ($userGroupID)
	{
		$tp->assign('user_group_id', $userGroupID);
	}
	
	$tp->assign('social_plugins', $aPlugins);
	$tp->display('social_plugins.tpl');
	
}

