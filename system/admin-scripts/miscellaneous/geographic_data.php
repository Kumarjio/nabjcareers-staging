<?php

require_once("orm/Location/Location.php");
require_once("orm/Location/LocationManager.php");

$tp = SJB_System::getTemplateProcessor();
$errors = array();
$location = new SJB_Location($_REQUEST);

$action_name	= SJB_Request::getVar('action_name', false);
$action			= SJB_Request::getVar('action', false);
$action			= $action_name?$action_name:$action;
$number_per_page = SJB_Request::getVar('zip_codes_per_page', 100);
$sorting_field = SJB_Request::getVar('sorting_field', 'name');
$sorting_order = SJB_Request::getVar('sorting_order', 'ASC');

$search = '';

switch ($action) {
	case 'add':
		if ($location->isDataValid($errors)) 
			$location = new SJB_Location();
		else 
			$errors['Name'] = 'NOT_UNIQUE_VALUE';
	break;
	case 'delete':
		$location_sid = SJB_Request::getVar('location_sid', false);
		if (!$location_sid) {
			$locations_sids	= SJB_Request::getVar('locations', false);
			if ($locations_sids)
				foreach ($locations_sids as $l_sid => $value) 
		            $res = SJB_LocationManager::deleteLocationBySID($l_sid);
		}
		else
			SJB_LocationManager::deleteLocationBySID($location_sid);
		
		SJB_HelperFunctions::redirect("");
	break;
	
	case 'clear_data':
		SJB_LocationManager::deleteAllLocations();
		SJB_HelperFunctions::redirect("");
	break;
	
	case 'search':
		$searchParams = SJB_Request::getVar('search', false);
		$search .= "WHERE 1 ";
		$search .= !empty($searchParams['name'])?" AND `name` LIKE '%{$searchParams['name']}%'":'';
		$search .= !empty($searchParams['longitude'])?" AND `longitude` LIKE '{$searchParams['longitude']}'":'';
		$search .= !empty($searchParams['latitude'])?" AND `latitude` LIKE '{$searchParams['latitude']}'":'';
		$tp->assign("search", $searchParams);
	break;
}

$location_info = $location->getInfo();
$page_number = SJB_Request::getVar('page_number', 1);
$page_count = ceil(SJB_LocationManager::getLocationNumber($search) / $number_per_page);
$page_number = max(1, min($page_number, $page_count));
$location_collection = SJB_LocationManager::getLocationsInfoWithLimit(($page_number - 1) * $number_per_page, $number_per_page, $search, $sorting_field, $sorting_order);
unset($_REQUEST['zip_codes_per_page']);
$tp->assign('query', http_build_query($_REQUEST));
$tp->assign('zip_codes_per_page', $number_per_page);
$tp->assign('sorting_field', $sorting_field);
$tp->assign('sorting_order', $sorting_order);
$tp->assign("errors", $errors);
$tp->assign("location_info", $location_info);
$tp->assign("page_number", $page_number);
$tp->assign("page_count", $page_count);
$tp->assign("location_collection", $location_collection);
$tp->display("geographic_data.tpl");