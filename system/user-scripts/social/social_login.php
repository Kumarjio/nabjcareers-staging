<?php

//if ( ! SJB_Authorization::isUserLoggedIn() && class_exists('SJB_SocialPlugin') && !SJB_SocialPlugin::getProfileObject() && $aSocPlugins = SJB_SocialPlugin::getAvailablePlugins())
if ( ! SJB_Authorization::isUserLoggedIn() && class_exists('SJB_SocialPlugin') && $aSocPlugins = SJB_SocialPlugin::getAvailablePlugins())
{
	$tp = SJB_System::getTemplateProcessor();
	$tp->assign('aSocPlugins', $aSocPlugins);
	$tp->display('login_buttons.tpl');
}

