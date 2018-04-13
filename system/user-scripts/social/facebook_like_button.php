<?php

$listingTypeID = $_REQUEST['type'];

if (class_exists('SJB_SocialPlugin') && in_array('facebook', SJB_SocialPlugin::getAvailablePlugins()) && SJB_Settings::getSettingByName('fb_like' . $listingTypeID))
{
	
//	if ( SJB_SocialPlugin::getProfileObject())
//	{
		$listing = &$_REQUEST['listing'];

		$tp = SJB_System::getTemplateProcessor();
		
		switch($listingTypeID)
		{
			case 'Job':
				$tp->assign('url', urlencode(SJB_System::getSystemSettings('SITE_URL') . '/display-job/' . $listing['id']));
				break;
			case 'Resume':
				$tp->assign('url', urlencode(SJB_System::getSystemSettings('SITE_URL') . '/display-resume/' . $listing['id']));
				break;
			default:
				$tp->assign('url', urlencode(SJB_System::getSystemSettings('SITE_URL') . '/display-listing/' . $listing['id']));
				break;
		}
		
//		$tp->assign('articleTitle', urlencode($listing['Title']));
//		$tp->assign('articleSummary', urlencode($listing['JobDescription']));
//		$tp->assign('articleSource', urlencode(SJB_System::getSettingByName('site_title')));
		$tp->display('facebook_like_button.tpl');
//	}

}