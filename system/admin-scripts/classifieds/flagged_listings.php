<?php

$tp     = SJB_System::getTemplateProcessor();
$errors = array();

$listingTypeID  = SJB_Request::getVar('listing_type_id');
$listingTypeSID = SJB_Request::getVar('listing_type');

if ($listingTypeID !== null) {
	$listingTypeSID = SJB_ListingTypeManager::getListingTypeSIDByID($listingTypeID);
}



// SET PAGINATION AND SORTING VALUES
$page    = SJB_Request::getVar('page', 1);
$perPage = SJB_Request::getVar('per_page', 20);

// SORTING
$sortingField = SJB_Request::getVar('sorting_field');
$sortingOrder = SJB_Request::getVar('sorting_order');
$restore      = SJB_Request::getVar('restore', false);

// FILTERS
$filters = array();
$filters['title']    = SJB_Request::getVar('filter_title');
$filters['username'] = SJB_Request::getVar('filter_user');
$filters['flag']     = SJB_Request::getVar('filter_flag');




// check session for pagination settings
$sessionFlaggedSettings = isset($_SESSION['flagged_settings']) ? $_SESSION['flagged_settings'] : false;
if ($sessionFlaggedSettings !== false) {
	// if we have new value
	if ( SJB_Request::getVar('per_page', false) ) {
		$_SESSION['flagged_settings']['per_page'] = $perPage;
	} else {
		$perPage = $_SESSION['flagged_settings']['per_page'];
	}
	
	if (!$restore) {
		$_SESSION['flagged_settings']['sorting_field']    = $sortingField;
		$_SESSION['flagged_settings']['sorting_order']    = $sortingOrder;
		$_SESSION['flagged_settings']['listing_type_sid'] = $listingTypeSID;
		$_SESSION['flagged_settings']['filters']          = $filters;
		$_SESSION['flagged_settings']['listing_type_sid'] = $listingTypeSID;
	} else {
		if (!$sortingField) {
			$sortingField = $_SESSION['flagged_settings']['sorting_field'];
		} else {
			$_SESSION['flagged_settings']['sorting_field'] = $sortingField;
		}
		if (!$sortingOrder) {
			$sortingOrder = $_SESSION['flagged_settings']['sorting_order'];
		} else {
			$_SESSION['flagged_settings']['sorting_order'] = $sortingOrder;
		}
	
		if (!$listingTypeSID) {
			$listingTypeSID = $_SESSION['flagged_settings']['listing_type_sid'];
		}
	
		$filters = $_SESSION['flagged_settings']['filters'];
	}
} else {
	$_SESSION['flagged_settings']['per_page']      = $perPage;
	$_SESSION['flagged_settings']['sorting_field'] = $sortingField;
	$_SESSION['flagged_settings']['sorting_order'] = $sortingOrder;
	$_SESSION['flagged_settings']['listing_type_sid'] = $listingTypeSID;
	$_SESSION['flagged_settings']['filters']       = $filters;
}

// DEFAULT SORTING
if (!$sortingField) {
	$sortingField = 'date';
	$sortingOrder = 'DESC';
}

// resolve flag to it text value for search
$filterFlag = $filters['flag'];
if (!empty($filterFlag) && is_numeric($filterFlag)) {
	$result = SJB_DB::query("SELECT * FROM `flag_listing_settings` WHERE `sid` = ?n LIMIT 1", $filterFlag);
	if (!empty($result)) {
		$filters['flag_reason'] = $result[0]['value'];
	}
}



//////////////////////  ACTIONS

$action   = SJB_Request::getVar('action_name');
$flagSIDs = SJB_Request::getVar('flagged');

if (!empty($flagSIDs)) {
	switch ($action) {
		case 'remove':
			foreach ($flagSIDs as $sid => $val) {
				SJB_ListingManager::removeFlagBySID($sid);
			}
			break;
		case 'deactivate':
			foreach ($flagSIDs as $sid => $val) {
				SJB_ListingManager::deactivateListingByFlagSID($sid);
			}
			break;
		case 'delete':
			foreach ($flagSIDs as $sid => $val) {
				SJB_ListingManager::deleteListingByFlagSID($sid);
			}
			break;
		default:
			break;
	}
}





//////////////////////// OUTPUT 

$allListingTypes = SJB_ListingTypeManager::getAllListingTypesInfo();

$allFlags   = SJB_ListingManager::getAllFlags();
$totalPages = SJB_ListingManager::getFlaggedTotalPagesNum($listingTypeSID, $perPage, $filters);

$totalFlagsNum   = SJB_ListingManager::getFlagsNumberByListingTypeSID($listingTypeSID, $filters);
$flaggedListings = SJB_ListingManager::getFlaggedListings($listingTypeSID, $page, $perPage, $sortingField, $sortingOrder, $filters);

foreach ($flaggedListings as $key=>$val) {
	$listingInfo = SJB_ListingManager::getListingInfoBySID($val['listing_sid']);
	$listingUser = SJB_UserManager::getUserInfoBySID($listingInfo['user_sid']);
	$flaggedUser = SJB_UserManager::getUserInfoBySID($val['user_sid']);
	$flaggedListings[$key]['listing_info'] = $listingInfo;
	$flaggedListings[$key]['user_info']    = $listingUser;
	$flaggedListings[$key]['flagged_user'] = $flaggedUser;
}


$tp->assign('listing_types', $allListingTypes);

$tp->assign('listings', $flaggedListings);
$tp->assign('listing_type_sid', $listingTypeSID);
$tp->assign('all_flags', $allFlags);

$tp->assign('total_flags_number', $totalFlagsNum);

// pagination
$tp->assign('pages', $totalPages);
$tp->assign('current_page', $page);
$tp->assign('per_page', $perPage);

// sorting fields to filter form
$tp->assign('sorting_field', $sortingField);
$tp->assign('sorting_order', $sortingOrder);

$tp->assign('filters', $filters);

$tp->display('flagged_listings.tpl');
