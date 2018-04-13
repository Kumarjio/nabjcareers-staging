<?php

require_once("users/User/UserManager.php");
require_once("classifieds/Listing/ListingManager.php");
require_once("classifieds/SavedListings.php");

$tp = SJB_System::getTemplateProcessor();
$errors = array();
$listingTypeID = SJB_Request::getVar('listing_type_id', '');

if (SJB_UserManager::isUserLoggedIn()) {
	
	if(!SJB_Acl::getInstance()->isAllowed('save_' . trim($listingTypeID))) {
		$errors[] = 'DENIED_VIEW_SAVED_LISTING';
	}
	if (!$errors) {
	    $userSid = SJB_UserManager::getCurrentUserSID();
		if (SJB_Request::getVar('action', '') == 'delete') {
			$listing_id = SJB_Request::getVar('listing_id', null);
			if (!is_null($listing_id)) {
	    	    
				foreach ($listing_id as $key => $value) {
					SJB_SavedListings::deleteListingFromDBBySID($key, $userSid);
				}
				SJB_HelperFunctions::redirect('');
			}
		}
		
		$saved_listings_id = SJB_SavedListings::getSavedListingsFromDB($userSid);		
		
		$listing_structure = array();
		$listings_structure = array();
		$listing_structure_meta_data = array();
		
		foreach ($saved_listings_id as $saved_listing) {
			$saved_listing_id = $saved_listing['listing_sid'];
			$listing = SJB_ListingManager::getObjectBySID($saved_listing_id);
			
			if (is_null($listing))
			    continue;
			
			$listing->addPicturesProperty();
		
			$listing_structure = SJB_ListingManager::createTemplateStructureForListing($listing);
			$listings_structure[$listing->getID()] = $listing_structure;
			$listings_structure[$listing->getID()]['saved_listing'] = $saved_listing;
			if (isset($listing_structure['METADATA'])) {
				$listing_structure_meta_data = array_merge($listing_structure_meta_data, $listing_structure['METADATA']);
			}
		}
		
		$metaDataProvider = SJB_ObjectMother::getMetaDataProvider();
		$tp->assign(
			"METADATA",  
			array( 
				"listing" => $metaDataProvider->getMetaData("Property_", $listing_structure_meta_data), 
			) 
		);
		
		$tp->assign("listings", $listings_structure);
		$tp->assign("listing_type_id", $listingTypeID);
		$tp->display("saved_listings.tpl");
	}
	else {
		$tp->assign("errors", $errors);
		$tp->display("save_search_failed.tpl");
	}
}
else {
	$url = base64_encode(SJB_System::getSystemSettings("SITE_URL")."/system/classifieds".  SJB_System::getURI());
	switch ($listingTypeID) {
		case 'job':
			$url = base64_encode(SJB_System::getSystemSettings("SITE_URL")."/saved-jobs/");
			break;
		case 'resume':
			$url = base64_encode(SJB_System::getSystemSettings("SITE_URL")."/saved-resumes/");
			break; 
	}
	$tp->assign("return_url", $url);
	$tp->display("../users/login.tpl");
}
