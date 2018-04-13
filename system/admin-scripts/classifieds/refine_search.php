<?php

require_once("classifieds/ListingType/ListingTypeManager.php");
require_once("classifieds/ListingField/ListingField.php");
require_once("classifieds/RefineSearch.php");

$tp = SJB_System::getTemplateProcessor();
$action = SJB_Request::getVar('action');
$field_id = SJB_Request::getVar('field_id', false);

if ($field_id || $action == 'save_setting') {
	switch ($action) {
		case 'save':
			$listing_type_sid = SJB_Request::getVar('listing_type_sid', false);
			$userField = 0;
			if ($listing_type_sid) {
				if (strstr($field_id, 'user_')) {
					$field_id = str_replace('user_', '', $field_id);
					$userField = 1;
				}
				if (!SJB_RefineSearch::getFieldByFieldSIDListingTypeSID($field_id, $listing_type_sid, $userField))
					SJB_RefineSearch::addField($field_id, $listing_type_sid, $userField);
			}
			break;
		case 'save_setting':
			$listing_type_id = SJB_Request::getVar('listing_type_id', false);
			$refine_search_items_limit = SJB_Request::getVar('refine_search_items_limit', false);
			if ($listing_type_id) {
				$settingValue = SJB_Request::getVar('turn_on_refine_search_'.$listing_type_id, 0);
				if (SJB_Settings::getSettingByName('turn_on_refine_search_'.$listing_type_id) === false)
					SJB_Settings::addSetting('turn_on_refine_search_'.$listing_type_id, $settingValue);
				else 	
					SJB_Settings::updateSetting('turn_on_refine_search_'.$listing_type_id, $settingValue);
			}
			elseif ($refine_search_items_limit) {
				if (SJB_Settings::getSettingByName('refine_search_items_limit') === false)
					SJB_Settings::addSetting('refine_search_items_limit', $refine_search_items_limit);
				else 	
					SJB_Settings::updateSetting('refine_search_items_limit', $refine_search_items_limit);
			}
			break;
		case 'delete':
			SJB_RefineSearch::removeField($field_id);
			break;
		case 'move_up':
			$listing_type_sid = SJB_Request::getVar('listing_type_sid', false);
			if ($listing_type_sid) 
				SJB_RefineSearch::moveUpFieldBySID($field_id,$listing_type_sid);
			break;
		case 'move_down':
			$listing_type_sid = SJB_Request::getVar('listing_type_sid', false);
			if ($listing_type_sid) 
				SJB_RefineSearch::moveDownFieldBySID($field_id,$listing_type_sid);
			break;
	}
}

$listingTypes = SJB_ListingTypeManager::getAllListingTypesInfo();
foreach ($listingTypes as $key => $listingType) {
	$fields = array_merge(SJB_ListingFieldManager::getCommonListingFieldsInfo(),SJB_ListingFieldManager::getListingFieldsInfoByListingType($listingType['sid']));
	foreach ($fields as $field_key => $field) {
		if (!in_array($field['type'], array('list', 'multilist', 'string', 'boolean', 'tree')) || in_array($field['id'], array('ApplicationSettings', 'access_type', 'anonymous', 'screening_questionnaire')))
			unset($fields[$field_key]);
	}
	$listingTypes[$key]['fields'] = $fields;
	if ($key == 'Job') {
		$userFieldSID = SJB_DB::query("SELECT `object_sid` FROM `user_profile_fields_properties` WHERE `id`='id' AND `value`='CompanyName'");
		$userFieldSID = $userFieldSID?array_pop(array_pop($userFieldSID)):false;
		if ($userFieldSID)
			$listingTypes[$key]['user_fields'] = SJB_UserProfileFieldManager::getFieldInfoBySID($userFieldSID);
	}
	$listingTypes[$key]['saved_fields'] = SJB_RefineSearch::getFieldsByListingTypeSID($listingType['sid']);
	$listingTypes[$key]['setting'] = SJB_Settings::getSettingByName('turn_on_refine_search_'.$listingType['id']);
}

$tp->assign('refine_search_items_limit', SJB_Settings::getSettingByName('refine_search_items_limit'));
$tp->assign('listingTypes', $listingTypes);
$tp->display('refine_search.tpl');