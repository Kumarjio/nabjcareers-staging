<?php

if (class_exists('SJB_SocialPlugin') && in_array('facebook', SJB_SocialPlugin::getAvailablePlugins()) && SJB_Settings::getSettingByName('fb_likeJobs'))
{
	
	if ( SJB_SocialPlugin::getProfileObject())
	{
		$listing = &$_REQUEST['listing'];

		$tp = SJB_System::getTemplateProcessor();
		$tp->assign('articleUrl', urlencode(SJB_System::getSystemSettings('SITE_URL') . '/display-job/' . $listing['id']));
		$tp->assign('articleTitle', urlencode($listing['Title']));
		$tp->assign('articleSummary', urlencode($listing['JobDescription']));
		$tp->assign('articleSource', urlencode(SJB_System::getSettingByName('site_title')));
		$tp->display('facebook_like_button.tpl');
	}

}