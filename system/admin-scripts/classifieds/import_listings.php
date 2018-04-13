<?php

require_once 'classifieds/Listing/Listing.php';
require_once 'classifieds/Listing/ListingManager.php';
require_once 'classifieds/ListingType/ListingTypeManager.php';

require_once 'membership_plan/PackagesManager.php';

require_once 'miscellaneous/ImportFileXLS.php';
require_once 'miscellaneous/ImportFileCSV.php';
require_once 'miscellaneous/ImportedDataProcessor.php';

require_once('classifieds/ListingGallery/ListingGallery.php');

$template_processor = SJB_System::getTemplateProcessor();

$file_info = isset($_FILES['import_file']) ? $_FILES['import_file'] : null;

if (empty($file_info) || $file_info['error'] == UPLOAD_ERR_NO_FILE) {
	$errors = array();
	if ($file_info['error'] == UPLOAD_ERR_NO_FILE)
		$errors[] = 'Please choose exl or csv file';
	$packages 		= SJB_PackagesManager::getPackagesByClass('ListingPackage');
	$listing_types 	= SJB_ListingTypeManager::getAllListingTypesInfo();

	$template_processor->assign('packages', $packages);
	$template_processor->assign('listing_types', $listing_types);
	$template_processor->assign('errors', $errors);
	$template_processor->display('import_listings.tpl');
}
else {
	$csv_delimiter 			= SJB_Request::getVar('csv_delimiter', null);
	$listing_type_id 		= SJB_Request::getVar('listing_type_id', null);
	$listing_package_id		= SJB_Request::getVar('listing_package', null);
	$active_status			= SJB_Request::getVar('active', null);
	$activation_date		= isset($_REQUEST['activation_date']) && $_REQUEST['activation_date'] ? $_REQUEST['activation_date'] : date('Y-m-d');
	$package_id				= SJB_Request::getVar('listing_package', null);
	$non_existed_values_flag= SJB_Request::getVar('non_existed_values', null);

	$package_info = SJB_PackagesManager::getPackageInfoByPackageID($package_id);

	$timestamp 		 = strtotime($activation_date.' + '.$package_info['listing_lifetime'].' days');
	$expiration_date = date('Y-m-d', $timestamp);

	$extension = $_REQUEST['file_type'];

	if ($extension == 'xls') 		$import_file = new SJB_ImportFileXLS($file_info);
	elseif ($extension == 'csv') 	$import_file = new SJB_ImportFileCSV($file_info, $csv_delimiter);

	$import_file->parse();

	$listing = CreateListing(array(), $listing_type_id);

	$imported_data_processor = new SJB_ImportedDataProcessor($import_file->getData(), $listing);

	$count = 0;
	while(!$imported_data_processor->isEmpty()) {
		$count++;
		$listing_info = $imported_data_processor->getData($non_existed_values_flag);

		$listing = CreateListing($listing_info, $listing_type_id);

		$listing->addActiveProperty($active_status);
		$listing->addActivationDateProperty($activation_date);
		$listing->addExpirationDateProperty($expiration_date);
		$listing->setListingPackageInfo(SJB_PackagesManager::getPackageInfoByPackageID($package_id));
		$listing->setPropertyValue('access_type', 'everyone');
		$listing->setPropertyValue('status', 'approved');
		foreach ($listing->getProperties() as $property) {
			if ($property->getType() == 'tree' && $property->value !== '' ) {
				$treeValues = explode(",", $property->value);
				$treeSIDs = array();
				foreach ($treeValues as $treeValue) {
					$info = SJB_ListingFieldTreeManager::getItemInfoByCaption($property->sid, trim($treeValue));
					$treeSIDs[] = $info['sid'];
				}
				$listing->setPropertyValue($property->id, implode(',', $treeSIDs));
				$listing->details->properties[$property->id]->type->property_info['value'] = implode(',', $treeSIDs);
			}
			elseif ($property->getType() == 'monetary') {
				require_once "miscellaneous/Currency/Currency.php";
				$currency = SJB_CurrencyManager::getDefaultCurrency();
				$listing->details->properties[$property->id]->type->property_info['value']['add_parameter'] = $currency['sid'];
			}
			// fix for new format of ApplicationSettings
			elseif ($property->id == 'ApplicationSettings' && !empty($listing_info['ApplicationSettings'])) {
				if (ereg("^[a-z0-9\._-]+@[a-z0-9\._-]+\.[a-z]{2,4}\$",  $listing_info['ApplicationSettings'] )) {
					$listing_info['ApplicationSettings'] = array( 'value' => $listing_info['ApplicationSettings'], 'add_parameter' => 1);
					} elseif(ereg("^(http:\/\/)", $listing_info['ApplicationSettings'])) {
					$listing_info['ApplicationSettings'] = array( 'value' => $listing_info['ApplicationSettings'], 'add_parameter' => 2);					
				} else {
					//put empty if not valid email or url
					$listing_info['ApplicationSettings'] = array( 'value' => '', 'add_parameter' => '');
				}
				$listing->details->properties[$property->id]->type->property_info['value'] = $listing_info['ApplicationSettings'];
			}
		}
		if ($non_existed_values_flag == 'add') {
			UpdateListValues($listing);
		}
		
		SJB_ListingManager::saveListing($listing);
		SJB_ListingManager::activateListingBySID($listing->getSID());
		FillGallery($listing, $listing_info);		
	}

	$template_processor->assign('imported_listings_count', $count);
	$template_processor->display('import_listings_result.tpl');
}

function FillGallery($listing, $listing_info)
{
	$gallery = new SJB_ListingGallery();
	$gallery->setListingSID($listing->getSID());

	if (isset($listing_info['pictures'])) {
		foreach($listing_info['pictures'] as $picture)
			$gallery->uploadImage($picture, '');
	}
}

function CreateListing($listing_info, $listing_type_id)
{
	$listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id);
	$listing = new SJB_Listing($listing_info, $listing_type_sid);

	if (!empty($listing_info['username'])) {
		$user_info = SJB_UserManager::getUserInfoByUserName($listing_info['username']);
		$listing->setUserSID($user_info['sid']);
	}
	return $listing;
}

function UpdateListValues($listing)
{
	$list_properties = array();
	
	$details = $listing->getDetails();
	$properties = $details->getProperties();
	
	foreach ($properties as $property) {
		if ($property->getType() == 'list') {
			$list_properties[$property->getID()] = $property;
		}
	}
	
	$listingFieldListItemManager = new SJB_ListingFieldListItemManager();
	
	foreach ($list_properties as $property) {
		$property_sid 	= $property->getSID();
		$property_value = $property->getValue();
		
		if (!empty($property_value)) {
			$list_item = $listingFieldListItemManager->getListItemByValue($property->getSID(), $property->getValue());
			
			if (empty($list_item)) {
				$list_item = new SJB_ListItem();
				$list_item->setFieldSID($property_sid);
				$list_item->setValue($property_value);
				
				$listingFieldListItemManager->saveListItem($list_item);
			}	
		}	
	}
}

