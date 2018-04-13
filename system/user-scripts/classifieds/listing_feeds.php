<?php

require_once("classifieds/Listing/ListingManager.php");

// xml-feeds table
$feedsTable = 'listing_feeds';
$feed_mimetype = 'text/xml';

$tp = SJB_System::getTemplateProcessor();

$feedId		= SJB_Request::getVar('feedId', '');
$searchSID	= SJB_Request::getVar('searchSID', false);

$feed	= array_pop( SJB_DB::query("SELECT * FROM $feedsTable WHERE `sid`=?n", $feedId) );

if ( empty($feed) && $searchSID === false ) {
	
	$errors[] = 'RSS is not exists';
	$template = 'feed_error.tpl';
	$tp->assign('errors', $errors);

} else {
	
	if ( $searchSID ) {
		
		require_once "SearchResultsTP.php";

		$template		= 'feed_saved_search.tpl';
		$count_listings	= SJB_Request::getVar('count_listings', 10);
		
		if ( $count_user_defined = SJB_Request::getVar('count_listings', false, 'GET') )
			$count_listings = $count_user_defined;
		
		// get saved search results for feed
		$searches	= array_pop( SJB_SavedSearches::getSavedJobAlertFromDBBySearchSID($searchSID) );
		
		$listing_type_id = null;
		foreach ($searches['data']['listing_type'] as $val) {
			$listing_type_id = $val;
			break;
		}
		
		$searches['data']['default_sorting_field'] = 'activation_date';
    	$searches['data']['default_sorting_order'] = 'DESC';
    	$searches['data']['default_listings_per_page'] = $count_listings;
    	
		$searchResultsTP = &new SJB_SearchResultsTP($searches['data'], $listing_type_id);
		$tp = $searchResultsTP->getChargedTemplateProcessor();
		$listings = $tp->_tpl_vars['listings'];
		foreach ($listings as $key => $val) {
			$listings[$key]['formatted_date'] = date('D, d M Y H:i:s', strtotime($listings[$key]['activation_date']));
		}
		
		$tp->assign("listings", $listings);
		$tp->assign('listing_type_id', $listing_type_id);
		$tp->assign("search_name", $searches['name']);
		$tp->assign("feed", $feed);
		$tp->assign("query_string", htmlspecialchars( $_SERVER['QUERY_STRING'] ) );
		$tp->assign("lastBuildDate" ,date('D, d M Y H:i:s'));
		
	} else {
		
		$feed_link		= SJB_System::getSystemSettings('SITE_URL')."/listing-feeds/?".$_SERVER['QUERY_STRING'];
		$template		= $feed['template'];
		$count_listing	= $feed['count'];
		$feed_type		= $feed['type'];
		$feed_mimetype	= $feed['mime_type'];
		
		if ($count_listing == 0) {
			$count_listing = 1000000;
		}
		
		$listing_type	= array_pop( array_pop( SJB_DB::query("SELECT id FROM `listing_types` WHERE `sid`=?n", $feed_type ) ));
		
		$listings = SJB_ListingManager::getLastListings($count_listing, $listing_type);
		
		$listing_structure = array();
		$listings_structure = array();
		$listing_structure_meta_data = array();
		
		foreach ($listings as $listing) {	
			$listing_structure = SJB_ListingManager::createTemplateStructureForListing($listing);
			$listing_structure['activation_date']	= date('Y-M-d',strtotime($listing_structure['activation_date']));
			$listing_structure['expiration_date']	= date('Y-M-d',strtotime($listing_structure['expiration_date']));
			$listing_structure['listing_url']		= SJB_System::getSystemSettings('SITE_URL')."/display_".strtolower($listing_type)."/".$listing->sid."/";
			@$listing_structure['formatted_date'] = date('D, d M Y H:i:s',strtotime($listing_structure['activation_date']));
			
			if (isset($listing->details->properties['EmploymentType'])) {
				$employmentInfo		= $listing->details->properties['EmploymentType']->type->property_info;
				$employmentTypes	= array();
				$employment			= explode(",", $employmentInfo['value']);
				foreach ($employmentInfo['list_values'] as $type) {
					$empType = str_replace(" ", "", $type['id']);
					$employmentTypes[$empType] = 0;
					
					if ( in_array($type['id'], $employment) ) 
						$employmentTypes[$empType] = 1;
				}
				$listing_structure['myEmploymentType'] = $employmentTypes;
			}
			$listings_structure[] = $listing_structure;
			
			if (isset($listing_structure['METADATA'])) {
				$listing_structure_meta_data = array_merge($listing_structure_meta_data, $listing_structure['METADATA']);
			}
		}
		
		$metaDataProvider =& SJB_ObjectMother::getMetaDataProvider();
		$tp->assign (
			'METADATA',  
			array(
				'listing' => $metaDataProvider->getMetaData('Property_', $listing_structure_meta_data), 
			)
		);
		
		$tp->assign('listings', $listings_structure);
		$tp->assign('feed', $feed);
		$tp->assign('count_listing', $count_listing);
		$tp->assign('lastBuildDate' ,date('D, d M Y H:i:s'));
	}
}

header('Content-Type: ' . $feed_mimetype);

$tp->display($template);
exit();