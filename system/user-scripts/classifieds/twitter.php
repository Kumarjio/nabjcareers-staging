<?php

require_once("classifieds/ListingType/ListingTypeManager.php");
require_once("classifieds/Listing/ListingManager.php");
require_once("Zend/Service/Twitter.php");
require_once "SearchResultsTP.php";

$tp = SJB_System::getTemplateProcessor();
$plugin = SJB_PluginManager::getPluginByName('TwitterIntegrationPlugin');
$action = SJB_Request::getVar('action', false);
$sid = SJB_Request::getVar('sid', false);;
$pluginObj = new $plugin['name'];

switch ($action) {
	case 'run_manually_check':
		if ($sid) {
			$feed = $pluginObj->getFeedInfoBySID($sid);
			$listing_type_id = SJB_ListingTypeManager::getListingTypeIDBySID($feed['listing_type_sid']);
			$request = unserialize($feed['search_data']);
			$request['action'] = 'search';
			$request['listing_type']['equal'] = $listing_type_id;
			$request['post_to_twitter']['equal'] = 0;
			$request['default_listings_per_page'] = 100;
			$request['default_sorting_field'] = "activation_date";
			$request['default_sorting_order'] = "DESC";
			$searchResultsTP = &new SJB_SearchResultsTP($request, $listing_type_id);
			$searchResultsTP->getChargedTemplateProcessor();
			$sids = $searchResultsTP->found_listings_sids;
			$result = count($sids);
			if ($result == 0)
				echo "{$result} {$listing_type_id}(s) meeting the selected criteria were found.";
			else
				echo "{$result} {$listing_type_id}(s) meeting the selected criteria were found.<br /> To post these {$listing_type_id}(s) to Twitter now press “Ok”";
			exit();
		}
		else {
			echo "Error";exit();
		}
		break;
	case 'run_manually':
		if ($sid) {
			$feed = $pluginObj->getFeedInfoBySID($sid);
			$listing_type_id = SJB_ListingTypeManager::getListingTypeIDBySID($feed['listing_type_sid']);
			$request = unserialize($feed['search_data']);
			$request['action'] = 'search';
			$request['listing_type']['equal'] = $listing_type_id;
			$request['post_to_twitter']['equal'] = 0;
			$request['default_listings_per_page'] = 100;
			$request['default_sorting_field'] = "activation_date";
			$request['default_sorting_order'] = "DESC";
			$searchResultsTP = &new SJB_SearchResultsTP($request, $listing_type_id);
			$searchResultsTP->getChargedTemplateProcessor();
			$sids = $searchResultsTP->found_listings_sids;
			$count = 0;
			if ($sids) {
				$template = 'post_to_twitter.tpl';
			try {
				foreach ($sids as $sid) {
					$listingInfo = SJB_ListingManager::getListingInfoBySID($sid);
					$userInfo = SJB_UserManager::getUserInfoBySID($listingInfo['user_sid']);
					$title = preg_replace("/[\\/\\\:*?\"<>|%#$\s]/","_", $listingInfo['Title']).".html";
					if ($listing_type_id == 'Job')
						$listingUrl = SJB_System::getSystemSettings('SITE_URL')."/display-job/{$listingInfo['sid']}/{$title}";
					else
						$listingUrl = SJB_System::getSystemSettings('SITE_URL')."/display-resume/{$listingInfo['sid']}/{$title}";
					$curl = curl_init("http://api.bit.ly/v3/shorten?login={$feed['bitLyUsername']}&apiKey={$feed['bitLyAPIKey']}&longUrl={$listingUrl}&format=txt");
					curl_setopt ($curl, CURLOPT_HEADER, 0);
					curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
					$link = curl_exec($curl);
					$tp->assign('post_template', $feed['post_template']);
					$tp->assign('listing', $listingInfo);
					$tp->assign('user', $userInfo);
					$text = $tp->fetch($template);
					$link = " {$link} {$feed['hash_tags']}";
					$post = $text.$link;
					if (strlen($post) > 140) {
						$countStrCut = 140 - strlen($post) - 3;
						$text = substr($text, 0, $countStrCut)."...";
						$post = $text.$link;
					}

						$twitter = new Zend_Service_Twitter(
							array(
								'username' => $feed['username'],
								'accessToken' => !empty($feed['access_token']) ? unserialize($feed['access_token']) : '',
								'consumerKey' => $feed['consumerKey'],
								'consumerSecret' => $feed['consumerSecret']
							));
						$response  = $twitter->status->update($post);


						if (empty($response->error)) {
							SJB_DB::query("update `listings` SET `post_to_twitter`='1' WHERE `sid`=?n",$sid);
							$count++;
						}
						else {
							throw new Exception('Error: ' . $response->error . '<br/>');
						}
						sleep(5);
					} // foreach
				}	// try
				catch (Exception $ex) {
					echo $ex->getMessage();
				}
			}
			echo "{$count} {$listing_type_id}(s) were successfully posted to Twitter!";exit();
		}
		break;
	default:
	$feeds = $pluginObj->getAllFeeds();
	if ($feeds) {
		foreach ($feeds as $feed) {
			$request = array();
			$sids = array();
			$listing_type_id = SJB_ListingTypeManager::getListingTypeIDBySID($feed['listing_type_sid']);
			$request = unserialize($feed['search_data']);
			$request['action'] = 'search';
			$request['listing_type']['equal'] = $listing_type_id;
			$request['post_to_twitter']['equal'] = 0;
			$request['default_listings_per_page'] = 100;
			$request['default_sorting_field'] = "activation_date";
			$request['default_sorting_order'] = "DESC";
			$searchResultsTP = &new SJB_SearchResultsTP($request, $listing_type_id);
			$searchResultsTP->getChargedTemplateProcessor();
			$sids = $searchResultsTP->found_listings_sids;
			if ($sids && count($sids) >= $feed['update_every']) {
				$template = 'post_to_twitter.tpl';
				foreach ($sids as $sid) {
					$listingInfo = SJB_ListingManager::getListingInfoBySID($sid);
					$userInfo = SJB_UserManager::getUserInfoBySID($listingInfo['user_sid']);
					$title = preg_replace("/[\\/\\\:*?\"<>|%#$\s]/","_", $listingInfo['Title']).".html";
					if ($listing_type_id == 'Job')
						$listingUrl = SJB_System::getSystemSettings('SITE_URL')."/display-job/{$listingInfo['sid']}/{$title}";
					else
						$listingUrl = SJB_System::getSystemSettings('SITE_URL')."/display-resume/{$listingInfo['sid']}/{$title}";
					$curl = curl_init("http://api.bit.ly/v3/shorten?login={$feed['bitLyUsername']}&apiKey={$feed['bitLyAPIKey']}&longUrl={$listingUrl}&format=txt");
					curl_setopt ($curl, CURLOPT_HEADER, 0);
					curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
					$link = curl_exec($curl);
					$tp->assign('post_template', $feed['post_template']);
					$tp->assign('listing', $listingInfo);
					$tp->assign('user', $userInfo);
					$text = $tp->fetch($template);
					$link = " {$link} {$feed['hash_tags']}";
					$post = $text.$link;
					if (strlen($post) > 140) {
						$countStrCut = 140 - strlen($post) - 3;
						$text = substr($text, 0, $countStrCut)."...";
						$post = $text.$link;
					}

					try {
						$twitter = new Zend_Service_Twitter(
							array(
								'username' => $feed['username'],
								'accessToken' => !empty($feed['access_token']) ? unserialize($feed['access_token']) : '',
								'consumerKey' => $feed['consumerKey'],
								'consumerSecret' => $feed['consumerSecret']
							));
						$response  = $twitter->status->update($post);
						if ($response)
							SJB_DB::query("update `listings` SET `post_to_twitter` = '1' WHERE `sid` = ?n", $sid);
					}
					catch (Exception $ex) {}
				}
			}
		}
	}
	break;
}