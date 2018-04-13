<?php

if (class_exists('SJB_SocialPlugin') && in_array('linkedin', SJB_SocialPlugin::getAvailablePlugins()) && SJB_Settings::getSettingByName('li_resumeWidget'))
{
	$userSID =  !empty($_REQUEST['profileSID']) ? (int)$_REQUEST['profileSID'] : '';
	
	if ( $userSID && $profilePublicUrl = SJB_SocialPlugin::getProfilePublicUrlByProfileID($userSID))
	{
		$tp = SJB_System::getTemplateProcessor();
		$tp->assign('inPublicUrl', $profilePublicUrl);
		$tp->display('linkedin_profile_widget.tpl');
	}

}