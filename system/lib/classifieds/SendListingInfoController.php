<?php

require_once "classifieds/Listing/ListingManager.php";

class SJB_SendListingInfoController {

	var $listing_id	= null;
	var $submitted_data;

	function SJB_SendListingInfoController($input_data) {
		$this->listing_id = isset($input_data['listing_id']) ? $input_data['listing_id'] : null;
		$this->submitted_data = $input_data;
	}

	function isListingSpecified() {
		$listing = SJB_ListingManager::getObjectBySID($this->listing_id);
		return !empty($this->listing_id) && !empty($listing);
	}

	function isDataSubmitted() {
		return isset($this->submitted_data['is_data_submitted']);
	}

	function getData() {
		$listing 			= SJB_ListingManager::getObjectBySID($this->listing_id);
		$listing_structure 	= SJB_ListingManager::createTemplateStructureForListing($listing);
		return array('listing' => $listing_structure, 'submitted_data' => $this->submitted_data);
	}

	function getListingID() {
		return $this->listing_id;
	}

}
