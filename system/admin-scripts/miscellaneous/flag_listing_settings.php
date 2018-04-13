<?php
/************************************************************
 * Flag Listing Settings script for admin
 * This script for create and modifications of flag settings
 ************************************************************/


$tp     = SJB_System::getTemplateProcessor();
$errors = array();

$template = 'flag_listing_settings.tpl';

$listingTypeID = SJB_Request::getVar('listing_type_id');



$listingTypeSID = SJB_ListingTypeManager::getListingTypeSIDByID($listingTypeID);

$action  = SJB_Request::getVar('action');
$itemSID = SJB_Request::getVar('item_sid');

switch ($action) {
	case 'save':
		$saveValue = trim(SJB_Request::getVar('new_value'));

		$listingTypesArray = SJB_Request::getVar('flag_listing_types');
		
		$typesForSave = '';
		// make string to save
		if (!empty($listingTypesArray)) {
			$typesForSave = implode(',', $listingTypesArray);
		}
		
		if (!$itemSID) {
			// ADD NEW ITEM
			if ( !empty($saveValue)) {
				$result = SJB_DB::query("SELECT * FROM `flag_listing_settings` WHERE `listing_type_sid` = ?s AND `value` = ?s", $typesForSave, $saveValue);

				if (!empty($result)) {
					$errors['VALUE_ALWAYS_EXISTS'] = true;
				} else {
					$result = SJB_DB::query("INSERT INTO `flag_listing_settings` SET `listing_type_sid` = ?s, `value` = ?s", $typesForSave, $saveValue);
				}
			}
		} else {
			// UPDATE ITEM
			$result = SJB_DB::query("UPDATE `flag_listing_settings` SET `value` = ?s, `listing_type_sid`=?s WHERE `sid` = ?n", $saveValue, $typesForSave, $itemSID);
		}

		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/flag-listing-settings/');
		break;

	case 'delete':
		SJB_DB::query("DELETE FROM `flag_listing_settings` WHERE `sid` = ?n", $itemSID);

		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/flag-listing-settings/');
		break;

	case 'edit':
		$currentItem = SJB_DB::query("SELECT * FROM `flag_listing_settings` WHERE `sid` = ?n", $itemSID);
		$template    = 'flag_listing_settings_edit.tpl';

		if ($currentItem) {
			$currentItem = array_pop($currentItem);
			$typesArray = explode(',', $currentItem['listing_type_sid']);
			$currentItem['listing_type_sid'] = $typesArray;
		}
		$tp->assign('current_setting', $currentItem);
		break;
}




// Need to select listing type
$listingTypes = SJB_ListingTypeManager::getAllListingTypesInfo();
$types = array();
foreach ($listingTypes as $elem) {
	$types[$elem['sid']] = $elem;
}
$listingTypes = $types;
$tp->assign('listing_types', $listingTypes);



// EDIT FLAG SETTINGS VALUES
$settings = SJB_DB::query("SELECT * FROM `flag_listing_settings`");

foreach ($settings as $key=>$elem) {
	$settings[$key]['listing_type_sid'] = explode(',', $elem['listing_type_sid']);
}



$tp->assign('settings', $settings);

$tp->display($template);
