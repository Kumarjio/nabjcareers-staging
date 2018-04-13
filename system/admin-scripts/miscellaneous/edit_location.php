<?php


require_once("orm/Location/LocationManager.php");

require_once("orm/Location/Location.php");

$template_processor = SJB_System::getTemplateProcessor();

$location_sid = isset($_REQUEST['sid']) ? $_REQUEST['sid'] : null;

$errors = null;

$field_errors = null;
	
$location_info = SJB_LocationManager::getLocationInfoBySID($location_sid);

if (!is_null($location_info)) {
	
	$form_is_submitted = (isset($_REQUEST['action']) && $_REQUEST['action'] == 'save_info');
	
	$location_info = array_merge($location_info, $_REQUEST);
			
	$location = new SJB_Location($location_info);
			
	$location->setSID($location_sid);
		
	if ($form_is_submitted && $location->isDataValid($field_errors)) {
		
		if (SJB_LocationManager::saveLocation($location)) {
			
			$redirect_url = SJB_System::getSystemSettings('SITE_URL') . '/geographic-data/';
			
			SJB_HelperFunctions::redirect($redirect_url);
			
		} else {
			
			$field_errors['Name'] = 'NOT_UNIQUE_VALUE';
			
		}
	
	}
	
} elseif (is_null($location_sid)) {
	
	$errors['LOCATION_SID_IS_NOT_SPECIFIED'] = 1;

} else {
	
	$errors['WORNG_LOCATION_SID_IS_SPECIFIED'] = 1;
	
}

$template_processor->assign("location_info", $location_info);

$template_processor->assign("errors", $errors);

$template_processor->assign("field_errors", $field_errors);

$template_processor->assign("location_sid", $location_sid);

$template_processor->display("edit_location.tpl");

