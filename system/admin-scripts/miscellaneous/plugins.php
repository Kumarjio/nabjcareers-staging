<?php

require_once 'forms/Form.php';
require_once 'classifieds/Listing/ListingCriteriaSaver.php';
require_once 'classifieds/SearchEngine/SearchFormBuilder.php';

$tp = SJB_System::getTemplateProcessor();

$saved = 0;
$action = SJB_Request::getVar('action');
$template = 'plugins.tpl';
$errors = array();
if (SJB_Request::getVar('error', false)) {
	$errors[] = SJB_Request::getVar('error', false);
}
$messages = array();
if (SJB_Request::getVar('message', false)) {
	$messages[] = SJB_Request::getVar('message', false);
}

switch ($action) {
	case 'grant_twitter_permission':
		$feedInfo = SJB_Twitter::getFeedInfoBySID(SJB_Request::getVar('sid'));
		require_once 'Zend/Oauth.php';
		require_once 'Zend/Oauth/Consumer.php';
		$config = array(
			'callbackUrl' => SJB_System::getSystemSettings('SITE_URL') . '/system/miscellaneous/plugins/?action=grant_twitter_permission&sid=' . SJB_Request::getVar('sid', '') . '&plugin=TwitterIntegrationPlugin&process_token=1',
			'siteUrl' => 'http://twitter.com/oauth',
			'consumerKey' => $feedInfo['consumerKey'],
			'consumerSecret' => $feedInfo['consumerSecret']
		);

		$consumer = new Zend_Oauth_Consumer($config);
		if (SJB_Request::getVar('process_token', false) && isset($_SESSION['TWITTER_REQUEST_TOKEN'])) {
			try {
				$token = $consumer->getAccessToken(
						 $_GET,
						 unserialize($_SESSION['TWITTER_REQUEST_TOKEN'])
					 );
				require_once 'Zend/Service/Twitter.php';
				$twitter = new Zend_Service_Twitter(
					array(
						'username' => $feedInfo['username'],
						'accessToken' => $token,
						'siteUrl' => 'http://twitter.com/oauth',
						'consumerKey' => $feedInfo['consumerKey'],
						'consumerSecret' => $feedInfo['consumerSecret']
					));

				$resp = $twitter->account->verifyCredentials();
				if (!empty($resp->user->screen_name) && $resp->user->screen_name == $feedInfo['username']) {
					SJB_Twitter::updateFeedToken(SJB_Request::getVar('sid'), $token);
					SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/system/miscellaneous/plugins/?action=settings&plugin=TwitterIntegrationPlugin&message=' . urlencode('Twitter account successfully updated'));
				}
				else {
					SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/system/miscellaneous/plugins/?action=settings&plugin=TwitterIntegrationPlugin&error=' . urlencode('Twitter account verification failed'));
				}
			} catch (Exception $ex) {
				$errors[] = 'Twitter account update failed';
			};
		}
		else {
			try {
				$token = $consumer->getRequestToken();
				$_SESSION['TWITTER_REQUEST_TOKEN'] = serialize($token);
				$consumer->redirect();
			} catch (Exception $ex) {
				SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/system/miscellaneous/plugins/?action=settings&plugin=TwitterIntegrationPlugin&error=' . urlencode('Could not retrieve a valid Token. Please check "Consumer Key" and "Consumer secret"'));
			}
		}
		break;
	case 'save':
		$paths	= SJB_Request::getVar('path');
		$active	= SJB_Request::getVar('active');

		$subAdminSID = SJB_SubAdmin::getSubAdminSID();

		foreach ($paths as $key => $path) {
			$config = SJB_PluginManager::getPluginConfigFromIniFile($path);
			// check subadmins permissions
			if ( $subAdminSID ) {
				switch ($path){
					case '../system/plugins\phpbb_bridge_plugin\config.ini':
						if ( !$subAdminAcl->isAllowed('set_phpbb_plug-in', $subAdminSID) ) {
							continue(2);
						}
						break;
					case '../system/plugins\twitter_integration_plugin\config.ini':
						if ( !$subAdminAcl->isAllowed('set_twitter_plug-in', $subAdminSID) ) {
							continue(2);
						}
						break;
					case '../system/plugins\wordpress_bridge_plugin\config.ini':
						if ( !$subAdminAcl->isAllowed('set_wordpress_plug-in', $subAdminSID) ) {
							continue(2);
						}
						break;
				}
			}
			$config['active'] = $active[$key];
			$result = SJB_PluginManager::savePluginConfigIntoIniFile($path, $config);
		}
		SJB_PluginManager::reloadPlugins();
		$saved = 1;
		break;

	case 'settings':
		$pluginName = SJB_Request::getVar('plugin');
		$plugin = SJB_PluginManager::getPluginByName($pluginName);
		$pluginObj = new $plugin['name'];
		$settings = $pluginObj->pluginSettings();
		$template = 'plugin_settings.tpl';
		$tp->assign('plugin', $plugin);
		SJB_Event::dispatch('RedefineTemplateName', $template, true);
		$tp->assign('settings', $settings);
		if ($pluginName != 'TwitterIntegrationPlugin') {
			$savedSettings = SJB_Settings::getSettings();
			SJB_Event::dispatch('RedefineSavedSetting', $savedSettings, true);
			$tp->assign('savedSettings', $savedSettings);
		}
		break;

	case 'save_settings':
		$request = $_REQUEST;
		SJB_Event::dispatch('SaveSettings', $request, true);
		SJB_Settings::updateSettings($request);
		break;

	case 'add_feed':
		$pluginName = SJB_Request::getVar('plugin');
		$plugin = SJB_PluginManager::getPluginByName($pluginName);
		$pluginObj = new $plugin['name'];
		$feed = $pluginObj->twitterFeed();
		$add_form = new SJB_Form($feed);
		$add_form->registerTags($tp);
		$form_fields = $add_form->getFormFieldsInfo();
		$search_form_builder = new SJB_SearchFormBuilder($feed);
		$criteria = SJB_SearchFormBuilder::extractCriteriaFromRequestData($_REQUEST);
		$search_form_builder->setCriteria($criteria);
		$search_form_builder->registerTags($tp);
		$listingFields = $feed->common_fields;
		
		$tp->assign('plugin', $plugin);
		$tp->assign('form_fields', $form_fields);
		$tp->assign('listingFields', $listingFields);
		$template = 'twitter_input_form.tpl';
		break;

	case 'edit_feed':
		$sid = SJB_Request::getVar('sid');
		if ($sid) {
			$pluginName = SJB_Request::getVar('plugin');
			$plugin = SJB_PluginManager::getPluginByName($pluginName);
			$pluginObj = new $plugin['name'];
			$feed_info = $pluginObj->getFeedInfoBySID($sid);
			$feed_info = array_merge($feed_info, $_REQUEST);
			$criteriaInfo = $feed_info['search_data']?unserialize($feed_info['search_data']):'';
			$feed = $pluginObj->twitterFeed($feed_info);
			$add_form = new SJB_Form($feed);
			$add_form->registerTags($tp);
			$form_fields = $add_form->getFormFieldsInfo();
			$search_form_builder = new SJB_SearchFormBuilder($feed);
			$criteria = SJB_SearchFormBuilder::extractCriteriaFromRequestData($criteriaInfo);
			$search_form_builder->setCriteria($criteria);
			$search_form_builder->registerTags($tp);
			$listingFields = $feed->common_fields;
			$tp->assign('plugin', $plugin);
			$tp->assign('feed_sid', $sid);
			$tp->assign('form_fields', $form_fields);
			$tp->assign('listingFields', $listingFields);
			$template = 'twitter_input_form.tpl';
		}
		break;

	case 'save_feed':
		$sid = SJB_Request::getVar('sid');
		$field_errors = array();
		$pluginName = SJB_Request::getVar('plugin');
		$plugin = SJB_PluginManager::getPluginByName($pluginName);
		$pluginObj = new $plugin['name'];
		$feed = $pluginObj->twitterFeed($_REQUEST);
		if ($sid) {
			$feed->setSID($sid);
			$tp->assign('feed_sid', $sid);
		}
		$criteria_saver = new SJB_ListingCriteriaSaver();
		$criteria_saver->setSessionForCriteria($_REQUEST);
		$requested_data = $criteria_saver->getCriteria();
		
		$search_form_builder = new SJB_SearchFormBuilder($feed);
		$criteria = SJB_SearchFormBuilder::extractCriteriaFromRequestData($_REQUEST);
		$search_form_builder->setCriteria($criteria);
		$search_form_builder->registerTags($tp);
		
		$properties = $feed->getProperties();

		foreach ($properties as $key => $property) {
			if (!$property->isSystem())
				$feed->deleteProperty($key);
		}
		$add_form = new SJB_Form($feed);
		$add_form->registerTags($tp);
	
		if ($add_form->isDataValid($field_errors)) {
			$feed->addProperty(					
				array (	'id'		=> 'search_data',
						'type'		=> 'text',
						'value'		=> serialize($requested_data),
						'is_system' => true)
				);
			$pluginObj->saveFeed($feed);
			if (empty($sid))
				SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/system/miscellaneous/plugins/?action=grant_twitter_permission&sid=' . $feed->getSID() . '&plugin=TwitterIntegrationPlugin');
			SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL').'/system/miscellaneous/plugins/?action=settings&plugin='.$plugin['name']);
		}
		else {
			$feed = $pluginObj->twitterFeed($_REQUEST);
			if ($sid) {
				$feed->setSID($sid);
				$tp->assign('feed_sid', $sid);
			}
			$add_form = new SJB_Form($feed);
			$add_form->registerTags($tp);
			$form_fields = $add_form->getFormFieldsInfo();
		
			$tp->assign('plugin', $plugin);
			$tp->assign('field_errors', $field_errors);
			$tp->assign('form_fields', $form_fields);
			$template = 'twitter_input_form.tpl';
		}
		break;

	case 'delete_feed':
		$sid = SJB_Request::getVar('sid');
		if ($sid) {
			$pluginName = SJB_Request::getVar('plugin');
			$plugin = SJB_PluginManager::getPluginByName($pluginName);
			$pluginObj = new $plugin['name'];
			$pluginObj->deleteFeed($sid);
			SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL').'/system/miscellaneous/plugins/?action=settings&plugin='.$plugin['name']);
		}
		break;
		
	case 'editCaptcha':
		$info = $_REQUEST;
		SJB_Event::dispatch('editCaptcha', $info, true);
		foreach ($info as $key => $val) {
			$tp->assign($key, $val);
		}
		$template = $info['template'];
		break;
}

$plugins = SJB_PluginManager::getAllPluginsList();
foreach ($plugins as $key => $plugin) {
	if ($plugin['active']) {
		$pluginObj = new $plugin['name'];
		$plugins[$key]['settings']= $pluginObj->pluginSettings();
	}
}

$tp->assign('saved', $saved);
$tp->assign('plugins', $plugins);
$tp->assign('errors', $errors);
$tp->assign('messages', $messages);
$tp->display($template);