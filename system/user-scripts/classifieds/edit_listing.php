<?php

require_once("classifieds/Listing/ListingManager.php");
require_once("classifieds/Listing/Listing.php");
require_once("applications/ScreeningQuestionnaires.php");
require_once("classifieds/PostingPages/PostingPagesManager.php");
require_once("forms/Form.php");

/* ELDAR JF */
require_once("classifieds/ListingField/ListingFieldDBManager.php");
/* ELDAR JF */

$tp = SJB_System::getTemplateProcessor();

$post_max_size_orig = ini_get("post_max_size");
$server_content_length = isset($_SERVER['CONTENT_LENGTH']) ? $_SERVER['CONTENT_LENGTH'] : null;

$new_contract_package = isset($_REQUEST['listing_package_id']) ? explode("_", $_REQUEST['listing_package_id']) : '';
$new_listing_package_id = 0;
if(!empty($new_contract_package[0])) {
	$new_listing_package_id = $new_contract_package[0];
}
// get post_max_size in bytes
$val = trim($post_max_size_orig);
$tmp = substr($val, strlen($val)-1);
$tmp = strtolower($tmp);
switch ($tmp) {
	case 'g': $val *= 1024; break;
	case 'm': $val *= 1024; break;
	case 'k': $val *= 1024; break;
}
$post_max_size = $val;

$errors = array();
$listing_id	= SJB_Request::getVar('listing_id');
$template	= SJB_Request::getVar('edit_template', 'edit_listing.tpl');
$filename = SJB_Request::getVar('filename', false);
if ($filename) {
	require_once("miscellaneous/UploadFileManager.php");
	$file = SJB_UploadFileManager::openFile($filename, $listing_id);
	$errors['NO_SUCH_FILE'] = true;
}

if ( empty($_POST) && ($server_content_length > $post_max_size) ) {
	$errors['MAX_FILE_SIZE_EXCEEDED'] = 1;
	$listing_id = SJB_Request::getVar('listing_id', null, 'GET');
	$tp->assign('post_max_size', $post_max_size_orig);
}

$current_user = SJB_UserManager::getCurrentUser();
$listing_info = SJB_ListingManager::getListingInfoBySID($listing_id);

if (SJB_UserManager::isUserLoggedIn()) {
	if ($listing_info['user_sid'] != $current_user->getID()) {
		$errors['NOT_OWNER_OF_LISTING'] = $listing_id;
	} elseif (!is_null($listing_info)) {	
		$contract_id = $current_user->getContractID();
		$pages = SJB_PostingPagesManager::getPagesByListingTypeSID($listing_info['listing_type_sid']);
		$listing_packages_info = canCurrentUserAddListing($error, $listing_info);
		
		$form_is_submitted = (SJB_Request::getVar('action', '') == 'save_info' || SJB_Request::getVar('action', '') == 'add');
	
		/*
		 * social plugin
		 * complete listing of data from an array of social data
		 * if is allowed
		 */
		$listing_type_info = SJB_ListingTypeManager::getListingTypeInfoBySID($listing_info['listing_type_sid']);
		$listing_type_id = $listing_type_info['id'];
		$aAutoFillData = array('formSubmitted' => $form_is_submitted, 'listingTypeID' => $listing_type_id);
		SJB_Event::dispatch('SocialSynchronization', $aAutoFillData);
		/*
		 * end of "social plugin"
		 */


		$listing_info = array_merge($listing_info, $_REQUEST);
		$listing = new SJB_Listing($listing_info, $listing_info['listing_type_sid']);
		$listing->deleteProperty('featured');
		$listing->deleteProperty('priority');
		$listing->deleteProperty('reject_reason');
		$listing->deleteProperty('status');
		// delete special only JobG8 property
		$listing->deleteProperty('company_name');
			
		$list_emp_ids = SJB_Request::getVar("list_emp_ids");
		$listing->setSID($listing_id);

		$screening_questionnaires = SJB_ScreeningQuestionnaires::getList($current_user->getSID());
		if (SJB_Acl::getInstance()->isAllowed('use_screening_questionnaires') && $screening_questionnaires) {
			$value = SJB_Request::getVar("screening_questionnaire");
			$value = $value ? $value : isset($listing_info['screening_questionnaire']) ? $listing_info['screening_questionnaire'] : '';
			$listing->addProperty(
			array (	'id'		=> 'screening_questionnaire',
					'type'		=> 'list',
					'caption'   => 'Screening Questionnaire',
					'value'		=> $value,
					'list_values' => SJB_ScreeningQuestionnaires::getListSIDsAndCaptions($current_user->getSID()),
					'is_system' => true));
		}

		/*
		 * social plugin
		 * "synchronization"
		 * if user is not registered using linkedin , delete linkedin sync property
		 * also if sync is turned off in admin part
		 */
		$aAutoFillData = array('oListing' => &$listing, 'userSID' => $current_user->getSID(), 'listingTypeID' => $listing_type_id, 'listing_info' => $listing_info);
		SJB_Event::dispatch('SocialSynchronizationFields', $aAutoFillData);
		/*
		 * end of social plugin "sync"
		 */

		$listing_edit_form = new SJB_Form($listing);
		$listing_edit_form->registerTags($tp);
		$package_info = SJB_ListingPackageManager::getPackageInfoByListingSID($listing_id);
		$listing_package_id = $package_info['id'];
		$tp->assign("pic_limit", $package_info['pic_limit']);
	
		if ($form_is_submitted){
			$listing->addProperty(
				array ( 'id'		=> 'access_list',
						'type'		=> 'multilist',
						'value'		=> SJB_Request::getVar("list_emp_ids"),
						'is_system' => true,
					)
		        );
			}
		$field_errors = null;

		if ( $form_is_submitted && $listing_edit_form->isDataValid($field_errors) ) {
			$listing->addProperty(
					array (	'id'		=> 'complete',
							'type'		=> 'integer',
							'value'		=> 1,
							'is_system' => true));
			if($listing_package_id == $new_listing_package_id) {
				$new_listing_package_id = '';
			}			
			SJB_ListingManager::saveListing($listing, $new_listing_package_id);		
			// Start Event
			SJB_Event::dispatch('listingEdited', $listing->getSID());
			$tp->assign("display_preview", 1);
			

			$globalTemplateVariables = SJB_System::getGlobalTemplateVariables();
			$uri = $globalTemplateVariables['GLOBALS']['user_page_uri'];
			if ($uri=="/edit-job-preview/") {
				SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/manage-listing/?listing_id=".$listing_id);
			}
			else {
				SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/my-listings/");
			}
			
		}
		
		$listing->deleteProperty('access_list');

		$tp->assign("form_is_submitted", $form_is_submitted);
		$tp->assign("listing_packages", $listing_packages_info);
	
		$listing_structure = SJB_ListingManager::createTemplateStructureForListing($listing);
		
		$form_fields = $listing_edit_form->getFormFieldsInfo();
	
		$listing_fields_by_page = array();
		$countPages = count($pages);
		$i = 1;
		foreach ($pages as $page) {
			$listing_fields_by_page[$page['page_name']] = SJB_PostingPagesManager::getAllFieldsByPageSIDForForm($page['sid']);
			if ($i == $countPages && isset($form_fields['screening_questionnaire']))
				$listing_fields_by_page[$page['page_name']]['screening_questionnaire'] = $form_fields['screening_questionnaire'];
			$i++;
		}

		/**
		 * social plugin
		 * delete sync fields from posting pages that are not in array $form_fields
		 */
		$aAutoFillData = array('listing_fields_by_page' => &$listing_fields_by_page, 'pages' => &$pages, 'form_fields' => $form_fields);
		SJB_Event::dispatch('SocialSynchronizationFieldsOnPostingPages', $aAutoFillData);
		/**
		 * end of "social plugin"
		 */

		$metaDataProvider =& SJB_ObjectMother::getMetaDataProvider();
		$tp->assign (
			"METADATA", array ( 
				"listing"     => $metaDataProvider->getMetaData("Property_", $listing_structure['METADATA']), 
				"form_fields" => $metaDataProvider->getFormFieldsMetadata("FormFieldCaptions", $form_fields), 
				"form_field" => array('caption' => array('domain' => 'FormFieldCaptions')),
			) 
		);
		if (!isset($listing_structure['access_type']))
			$listing_structure['access_type'] = 'everyone';
		$listing_access_list= SJB_ListingManager::getListingAccessList($listing_id, $listing_structure['access_type']);
		$tp->assign("listing", $listing_structure);
		$tp->assign("pages", $listing_fields_by_page);
		$tp->assign("countPages", count($listing_fields_by_page));
		$tp->assign("field_errors", $field_errors);
		$tp->assign("listing_access_list", $listing_access_list);
		
		/*
		 * social plugin
		 * only for Resume listing types
		 */
		$aAutoFillData = array('tp' => &$tp, 'listingTypeID' => $listing_type_id, 'userSID' => $current_user->getSID());
		SJB_Event::dispatch('SocialSynchronizationForm', $aAutoFillData);
		/*
		 * social plugin
		 */
	}
} else {
	$errors['NOT_LOGGED_IN'] = 1;
}



/* ELDAR JF */
function getJobFairsInfo() {
	$jfs_temp = SJB_ListingFieldDBManager::getJobFairsInfoDB();
	return $jfs_temp;
}

$jobFairsInfo = getJobFairsInfo();
$tp->assign("jobfairs", $jobFairsInfo);

/* ELDAR JF */

$tp->assign("errors", $errors);
$tp->display($template);

function canCurrentUserAddListing(& $error, $listing_info)
{
    $acl = SJB_Acl::getInstance();

	if (SJB_UserManager::isUserLoggedIn()) {
		$current_user = SJB_UserManager::getCurrentUser();
		if ($current_user->hasContract()) {			
			$listing_type_sid = $listing_info['listing_type_sid'];
			$listing_type_id = SJB_ListingTypeManager::getListingTypeIDBySID($listing_type_sid);			
			$contracts_id = $current_user->getContractID();
			$contractsSIDs = $contracts_id ? implode(',', $contracts_id) : 0;
			$resultContractInfo = SJB_DB::query("SELECT `id`, `membership_plan_id`, `expired_date` FROM `contracts` WHERE `id` in ({$contractsSIDs}) ORDER BY `expired_date` DESC" );			
			$PlanAcces = count($resultContractInfo) > 0 ? true : false;
			if ($PlanAcces && $acl->isAllowed('post_' . $listing_type_id)) {
				$availableListingsAmount = 0;
				$listing_packages_info = array();
				$is_contract = false;
				$i18n = SJB_I18N::getInstance();
				foreach ($resultContractInfo as $contractInfo) {
					$contract = new SJB_Contract(array('contract_id' => $contractInfo['id']));					
					if ($acl->isAllowed('post_' . $listing_type_id, $contractInfo['id'], 'contract')) {
					    $permissionParam = $acl->getPermissionParams('post_' . $listing_type_id, $contractInfo['id'], 'contract');
					    if (empty($permissionParam) || $acl->getPermissionParams('post_' . $listing_type_id, $contractInfo['id'], 'contract') > SJB_ListingManager::getCountListingsByContractID($contractInfo['id'])) {
    						$membership_plan = SJB_MembershipPlanManager::getMembershipPlanInfoByID($contractInfo['membership_plan_id']);
    						$listing_packages_info[$contractInfo['id']]['packages'] = SJB_PackagesManager::getPackagesByClassName("ListingPackage", $contractInfo['membership_plan_id']);
    						$listing_packages_info[$contractInfo['id']]['membership_plan_name'] = $membership_plan['name'];
    						$listing_packages_info[$contractInfo['id']]['expired_date'] = $contractInfo['expired_date'];
					    }
					}
					$is_contract = true;
				}
				if ($is_contract && count($listing_packages_info) > 0) {
					
					return $listing_packages_info;
					
				} else $error = 'LISTINGS_NUMBER_LIMIT_EXCEEDED';
				
			}else $error = 'DO_NOT_MATCH_POST_THIS_TYPE_LISTING';
		
		} else $error = 'NO_CONTRACT';
		
	} else $error = 'NOT_LOGGED_IN';
	
	return false;
	
}