<?php

require_once 'classifieds/Listing/Listing.php';
require_once 'classifieds/Listing/ListingManager.php';
require_once 'classifieds/ListingType/ListingTypeManager.php';
require_once 'classifieds/ListingGallery/ListingGallery.php';

require_once 'membership_plan/PackagesManager.php';

require_once 'miscellaneous/ImportFileXLS.php';
require_once 'miscellaneous/ImportFileCSV.php';
require_once 'miscellaneous/ImportedDataProcessor.php';

$tp = SJB_System::getTemplateProcessor();
$listing_type_id = SJB_Request::getVar('listing_type_id', false);
$action = SJB_Request::getVar('action', false);
$type = SJB_Request::getVar('type', false);
$warning = false;

if ($action  == 'example' && $type) {
	require_once 'classifieds/ExportController.php'; 
	$listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id);
	$listing_field_manager = new SJB_ListingFieldManager();
	$common_details = $listing_field_manager->getCommonListingFieldsInfo();
	$extra_details  = $listing_field_manager->getListingFieldsInfoByListingType($listing_type_sid);
	$listing_fields = array_merge($common_details, $extra_details);
	$directory_to_export = SJB_System::getSystemSettings('EXPORT_FILES_DIRECTORY');
	$export_properties = array();
	$export_data = array();
	foreach ($listing_fields as $listing_field) {
		$export_properties[$listing_field['id']] = $listing_field['id'];
		$export_data[] = '';
	}
	SJB_ExportController::createExportDirectoriesForExample();
	switch ($type) {
		case 'exl':
			require_once 'Excel/Writer.php'; 
			SJB_ExportController::makeExportFile($export_properties, $export_data, 'example.xls');	
			$export_files_dir = SJB_Path::combine($directory_to_export, 'example.xls');
	
			header('Content-type: application/vnd.ms-excel');
			header('Content-disposition: attachment; filename=example.xls');
			header('Content-Length: ' . filesize($export_files_dir));
			$fp = fopen($export_files_dir, 'rb');
			fpassthru($fp);	
			fclose($fp);
			break;
		case 'csv':
			$export_files_dir = SJB_Path::combine($directory_to_export,'example.csv');
			$fp = fopen($export_files_dir, 'w');
			fputcsv($fp, split(',', implode(',', $export_properties)));
			fclose($fp);
			header('Content-type: application/vnd.ms-excel');
			header('Content-disposition: attachment; filename=example.csv');
			header('Content-Length: ' . filesize($export_files_dir));
			$fp = fopen($export_files_dir, 'rb');
			fpassthru($fp);	
			fclose($fp);
			break;
	}
	SJB_Filesystem::delete($directory_to_export);	
	exit();
}

if ($listing_packages_info = canCurrentUserAddListing($error)) {
	
	$fileInfo = null;
	if (isset($_FILES['import_file'])) {
		if (empty($_FILES['import_file']['name'])) {
			$warning = 'Please choose exl or csv file';
		}
		else {
			$fileInfo = $_FILES['import_file'];
		}
	}
	$listing_package_id = SJB_Request::getVar('listing_package_id', false);
	$current_user = SJB_UserManager::getCurrentUser();

	if (!$listing_package_id) {
		$count_packages = 0;
		foreach ($listing_packages_info as $contract) {
			if (isset($contract['packages']))
				$count_packages += count($contract['packages']);
		}
		if ($count_packages == 1) {
			foreach ($listing_packages_info as $contract_id => $listing_package_info) {
				$listingPackageInfo = array_pop($listing_package_info['packages']);
				$listing_package_id = $listingPackageInfo['id'];
				$contract = new SJB_Contract(array('contract_id' => $contract_id));
			}
		}
		else {
			
			$tp->assign('listing_packages', $listing_packages_info);
			$tp->assign('METADATA', array (	'listing_package' => array (
											'name' => array('domain' => 'Miscellaneous'),
											'description' => array('domain' => 'Miscellaneous'))));
			$tp->assign('listing_type_id', $listing_type_id);
			$tp->display('listing_package_choice.tpl');
		}
	}
	else {
		$info = explode('_', $listing_package_id);
		$listing_package_id = $info[0];
		$contract_id = $info[1];
		$contract = new SJB_Contract(array('contract_id' => $contract_id));
		$listing_types_info = SJB_ListingTypeManager::getAllListingTypesInfo();
		if (!$listing_type_id && count($listing_types_info) == 1) {
			$listing_type_info = array_pop($listing_types_info);
			$listing_type_id = $listing_type_info['id'];
		} 
	}
	
	if ($listing_package_id && $listing_type_id) {
		
		$listing_package_info = $contract->getPackageInfoByPackageID($listing_package_id);
		$listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id);
		if ($fileInfo) {
			$extension = strrchr($fileInfo['name'], '.');
			switch ($extension) {
				case '.xls':
				case '.xlsx':
					$import_file = new SJB_ImportFileXLS($fileInfo);
					break;
				case '.csv':
					$import_file = new SJB_ImportFileCSV($fileInfo, ',');
					break;
			}
			$import_file->parse();
			$bulkPermissionParam = $acl->getPermissionParams('post_' . $listing_type_id, $contract->getID(), 'contract');
			if (empty($bulkPermissionParam) || ($bulkPermissionParam - SJB_ListingManager::getCountListingsByContractID($contract->getID())-(count($import_file->data)-1)) >= 0) { 

				$listing = new SJB_Listing(array(), $listing_type_id);
				$imported_data_processor = new SJB_ImportedDataProcessor($import_file->getData(), $listing);
				$count = 0;
				$is_package_free = 0;
				$listingSIDs = array();
				while(!$imported_data_processor->isEmpty()) {
					$count++;
					$listing_info = $imported_data_processor->getData('ignore');
					$listing_package_info = $contract->getPackageInfoByPackageID($listing_package_id);
					$listing = new SJB_Listing($listing_info, $listing_type_sid);

					foreach ($listing->getProperties() as $property) {
						if ($property->getType() == 'tree' && $property->value !== '' ) {
							$treeValues = explode(',', $property->value);
							$treeSIDs = array();
							foreach ($treeValues as $treeValue) {
								$info = SJB_ListingFieldTreeManager::getItemInfoByCaption($property->sid, trim($treeValue));
								$treeSIDs[] = $info['sid'];
							}
							$listing->setPropertyValue($property->id, implode(',', $treeSIDs));
							$listing->details->properties[$property->id]->type->property_info['value'] = implode(',', $treeSIDs);
						}
						elseif ($property->getType() == 'monetary') {
							require_once 'miscellaneous/Currency/Currency.php';
							$currency = SJB_CurrencyManager::getDefaultCurrency();
							$listing->details->properties[$property->id]->type->property_info['value']['add_parameter'] = $currency['sid'];
						}
					}

					$listing->deleteProperty('featured');
					$listing->deleteProperty('priority');
					$listing->deleteProperty('status');
					$listing->deleteProperty('reject_reason');
					$listing->addProperty(
						array (	'id'		=> 'contract_id',
								'type'		=> 'integer',
								'value'		=> $contract->getID(),
								'is_system' => true));
					$listing->setListingPackageInfo($listing_package_info);
					$listing->setPropertyValue('access_type', 'everyone');
					$listing->setUserSID($current_user->sid);
					if ($current_user->isSubuser()) {
						$subuserInfo = $current_user->getSubuserInfo();
						$listing->addSubuserProperty($subuserInfo['sid']);
					}
	
					SJB_ListingManager::saveListing($listing);	
								
					if (!empty($listing_package_info['is_featured']))
						SJB_ListingManager::makeFeaturedBySID($listing->getSID());
					if (!empty($listing_package_info['priority_listing']))
						SJB_ListingManager::makePriorityBySID($listing->getSID());
					$is_package_free = ($listing_package_info['price'] == 0);
					
					if ($is_package_free)
						SJB_ListingManager::activateListingBySID($listing->getSID());
					
					$listingSIDs[] = $listing->getSID();
				}
				if (!$is_package_free) {
					require_once('payment/Payment/Payment.php');
					require_once('payment/Payment/PaymentManager.php');
					require_once('payment/Payment/PaymentFactory.php');
					$product_info = serialize(array('listings_ids' => array($listingSIDs)));
					$status = 'Pending';
					$payment_id = SJB_PaymentManager::getPaymentSID_By_UserID_and_ProductInfo_and_Status($current_user->sid, $product_info, $status);
					$listings_ids = implode(',',$listingSIDs);
					$price = 0;
					if (empty($payment_id)){
						$price = $listing_package_info['price']*count($listingSIDs);
						$payment_info = array(
																		'user_sid' => $current_user->sid,			
																		'product_info' => $product_info,			
																		'price' => $price,			
																		'name' => 'Payment for listings IDs ' . $listings_ids,			
																		'success_page_url' => SJB_System::getSystemSettings('SITE_URL') . "/activate-listing/",			
																		'status' => $status
														);
						
						$payment = SJB_PaymentFactory::createPayment($payment_info);
						SJB_PaymentManager::savePayment($payment);
						$payment_id = $payment->getSID();
					}
					$payment_page_url = SJB_System::getSystemSettings('SITE_URL') . "/payment-page/?payment_id=" . $payment_id;
					$tp->assign('payment_page_url', $payment_page_url);
					$tp->assign('payment_id', $payment_id);
					$tp->assign('price', $price);
				}
				$tp->assign('listingsNum', count($listingSIDs));
				$tp->display('job_import_complete.tpl');
			}
			else {
				$error = 'LISTINGS_NUMBER_LIMIT_EXCEEDED';
				$tp->assign('listing_type_id', $listing_type_id);
				$tp->assign('error', $error);
				$tp->display('job_import.tpl');
			}
		}
		else {
			$tp->assign('warning', $warning);
			$tp->assign('package', $listing_package_info);
			$tp->assign('listing_package_id', $listing_package_id);
			$tp->assign('listing_type_id', $listing_type_id);
			$tp->assign('contract_id', $contract_id);
			$tp->display('job_import.tpl');
		}
	}
}
else {
    
    if ($error == 'NO_CONTRACT') {
    	if ($_GET) {
			$getParam .= '?';
			foreach ($_GET as $key => $val)
				$getParam .= $key . '=' . $val . '&';
			$getParam = substr($getParam, 0, -1);
		}
		$page = base64_encode(SJB_System::getURI().$getParam);
    	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/subscription/?page='.$page);
    }

	$tp->assign('listing_type_id', $listing_type_id);
	$tp->assign('error', $error);
	$tp->display('job_import.tpl');
}


function canCurrentUserAddListing(& $error)
{
    $acl = SJB_Acl::getInstance();

	if (SJB_UserManager::isUserLoggedIn()) {
		$current_user = SJB_UserManager::getCurrentUser();
		if ($current_user->hasContract()) {
			$listing_type_id = SJB_Request::getVar('listing_type_id', false);
			$contracts_id = $current_user->getContractID();
			$contractsSIDs = $contracts_id ? implode(',', $contracts_id) : 0;
			$resultContractInfo = SJB_DB::query("SELECT `id`, `membership_plan_id`, `expired_date` FROM `contracts` WHERE `id` in ({$contractsSIDs}) ORDER BY `expired_date` DESC" );
			$PlanAcces = count($resultContractInfo) > 0 ? true : false;
			if ($PlanAcces && $acl->isAllowed('post_' . $listing_type_id)) {
				if ($acl->isAllowed('bulk_job_import')) {
					$availableListingsAmount = 0;
					$listing_packages_info = array();
					$is_contract = false;
					$i18n = SJB_I18N::getInstance();
					foreach ($resultContractInfo as $contractInfo) {
						$contract = new SJB_Contract(array('contract_id' => $contractInfo['id']));
						if ($acl->isAllowed('post_' . $listing_type_id, $contractInfo['id'], 'contract') && $acl->isAllowed('bulk_job_import', $contractInfo['id'], 'contract')) {
						    $permissionParam = $acl->getPermissionParams('post_' . $listing_type_id, $contractInfo['id'], 'contract');
						    if (empty($permissionParam) || $acl->getPermissionParams('post_' . $listing_type_id, $contractInfo['id'], 'contract') > SJB_ListingManager::getCountListingsByContractID($contractInfo['id'])) {
	    						$membership_plan = SJB_MembershipPlanManager::getMembershipPlanInfoByID($contractInfo['membership_plan_id']);
	    						$listing_packages_info[$contractInfo['id']]['packages'] = SJB_PackagesManager::getPackagesByClassName('ListingPackage', $contractInfo['membership_plan_id']);
	    						$listing_packages_info[$contractInfo['id']]['membership_plan_name'] = $membership_plan['name'];
	    						$listing_packages_info[$contractInfo['id']]['expired_date'] = $contractInfo['expired_date'];
						    }
						}
						$is_contract = true;
					}
					if ($is_contract && count($listing_packages_info) > 0) 
						return $listing_packages_info;
					else 
						$error = 'LISTINGS_NUMBER_LIMIT_EXCEEDED';
				}
				else $error = 'DO_NOT_MATCH_IMPORT_THIS_TYPE_LISTING';	
			}
			else $error = 'DO_NOT_MATCH_POST_THIS_TYPE_LISTING';
		} 
		else $error = 'NO_CONTRACT';
	} 
	else $error = 'NOT_LOGGED_IN';
	
	return false;
}
