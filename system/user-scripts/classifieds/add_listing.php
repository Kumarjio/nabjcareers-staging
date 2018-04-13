<?php

require_once("users/User/UserManager.php");
require_once("membership_plan/Contract.php");
require_once("classifieds/ListingType/ListingTypeManager.php");
require_once("classifieds/Listing/Listing.php");
require_once("classifieds/Listing/ListingManager.php");
require_once("forms/Form.php");
require_once("classifieds/Browse/UrlParamProvider.php");
require_once("miscellaneous/AdminNotifications.php");
require_once("applications/ScreeningQuestionnaires.php");
require_once("classifieds/PostingPages/PostingPagesManager.php");

/* ELDAR JF */
require_once("classifieds/ListingField/ListingFieldDBManager.php");
/* ELDAR JF */

$tp = SJB_System::getTemplateProcessor();
$error = null;

$post_max_size_orig = ini_get("post_max_size");
$session_maxlifetime = ini_get("session.gc_maxlifetime");
$server_content_length = isset($_SERVER['CONTENT_LENGTH']) ? $_SERVER['CONTENT_LENGTH'] : null;
$listing_type_id = SJB_Request::getVar('listing_type_id', false);
$passed_parameters_via_uri = SJB_Request::getVar('passed_parameters_via_uri', false);
$pageID = false;
if ($passed_parameters_via_uri) {
	$passed_parameters_via_uri = SJB_UrlParamProvider::getParams();
	$listing_type_id = isset($passed_parameters_via_uri[0]) ? $passed_parameters_via_uri[0] : $listing_type_id;
	$pageID = isset($passed_parameters_via_uri[1])?$passed_parameters_via_uri[1]:false;
}
// get post_max_size in bytes
$val = trim($post_max_size_orig);
$tmp = substr($val, strlen($val)-1);
$tmp = strtolower($tmp);
/* 
 * if ini value is K - then multiply to 1024
 * if ini value is M - then multiply twice: in case 'm', and case 'k'
 * if ini value is G - then multiply tree times: in 'g', 'm', 'k'
 * 
 * out value - in bytes!
 */
switch ($tmp) {
	case 'g':
		$val *= 1024;
	case 'm':
		$val *= 1024;
	case 'k':
		$val *= 1024;
}
$post_max_size = $val;

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

$tmp_listing_id_from_request = SJB_Request::getVar('listing_id', false);

if ($listing_packages_info = canCurrentUserAddListing($error)) {

	$listing_type_sid  = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id);
	$current_user = SJB_UserManager::getCurrentUser();
	$pages = SJB_PostingPagesManager::getPagesByListingTypeSID($listing_type_sid);
	if (!empty($tmp_listing_id_from_request)) {
		$tmp_listing_sid = $tmp_listing_id_from_request;
	} elseif (!$tmp_listing_id_from_request) {
		$tmp_listing_sid = time();
	}

	if (!$pageID) {
		$pageID = $pages[0]['page_id'];
	}
	$pageSID = SJB_PostingPagesManager::getPostingPageSIDByID($pageID, $listing_type_sid);
	$isPageLast = SJB_PostingPagesManager::isLastPageByID($pageSID, $listing_type_sid);
	$listing_package_id = SJB_Request::getVar('listing_package_id', false);

	if ($listing_package_id) {
		$info = explode("_", $listing_package_id);
		$listing_package_id = $info[0];
				
		if (isset($_POST['listing_package_id'])) {
				$listing_package_id = $_POST['listing_package_id'];
		}
		
		$contract_id = $info[1];
		$contract = new SJB_Contract(array('contract_id' => $contract_id));
	}

	if (!$listing_package_id) {
		$count_packages = 0;
		foreach ($listing_packages_info as $contract) {
			if (isset($contract['packages']))
				$count_packages += count($contract['packages']);
		}	
			foreach ($listing_packages_info as $contract_id => $listing_package_info) {
				$listingPackageInfo = array_pop($listing_package_info['packages']);
				$listing_package_id = $listingPackageInfo['id'];				
				$tp->assign("listing_id", $tmp_listing_sid);
				
			//	if (isset($_POST['listing_package_id'])) {
			//	SJB_Session::setValue('listing_package_id', $_POST['listing_package_id']);
			//	}
			//	else {
				SJB_Session::setValue('listing_package_id', $listing_package_id);
			//	}
				
				$$listing_package_id = SJB_PackagesManager::getPackageInfoByPackageID($listing_package_id);
				$contract = new SJB_Contract(array('contract_id' => $contract_id));
			}
			if ($_SERVER['REMOTE_ADDR'] == "77.235.8.164") {
				$ecommerce_mode = SJB_System::getSettingByName('ecommerce');
//				if(!$ecommerce_mode) {						
//					}
//					$listing_package_infop[]
			}
			
		// cust 2 }		else { 
		
		$tp->assign("listing_id", $tmp_listing_sid);
		$tp->assign("listing_packages", $listing_packages_info);
		$tp->assign("METADATA", array (	'listing_package' => array (
										'name' => array('domain' => 'Miscellaneous'),
										'description' => array('domain' => 'Miscellaneous'))));
		$tp->assign("listing_type_id", $listing_type_id);

	}
	
	
	if ($listing_package_id) {
		$tp->assign("listing_id", $tmp_listing_sid);
		$package_info = SJB_PackagesManager::getPackageInfoByPackageID($listing_package_id);
		$tp->assign("pic_limit", $package_info['pic_limit']);
		$tp->assign("listing_package_id", $listing_package_id);
		$listing_types_info = SJB_ListingTypeManager::getAllListingTypesInfo();
		if (!$listing_type_id && count($listing_types_info) == 1) {
			$listing_type_info = array_pop($listing_types_info);
			$listing_type_id = $listing_type_info['id'];
		} 
	}

	if ($listing_package_id && $listing_type_id) {
		$form_submitted = isset($_REQUEST['action_add']) || isset($_REQUEST['action_add_pictures']);
		
		/*
		 * social plugin
		 * complete listing of data from an array of social data
		 * if is allowed
		 */
		$aAutoFillData = array('formSubmitted' => &$form_submitted, 'listingTypeID' => &$listing_type_id);
		SJB_Event::dispatch('SocialSynchronization', $aAutoFillData);
		/*
		 * end of "social plugin"
		 */
		
		$listing = new SJB_Listing($_REQUEST, $listing_type_sid, $pageSID);
		$listing->deleteProperty('featured');
		$listing->deleteProperty('priority');
		$listing->deleteProperty('status');
		$listing->deleteProperty('reject_reason');
		// delete special only JobG8 property
		$listing->deleteProperty('company_name');
		
		$access_type = $listing->getProperty('access_type');
		if ($form_submitted) {
			if (!empty($access_type)) {
				$listing->addProperty(
					array (	'id'		=> 'access_list',
							'type'		=> 'multilist',
							'value'		=> SJB_Request::getVar("list_emp_ids"),
							'is_system' => true));
			}
			$listing->addProperty(
				array (	'id'		=> 'contract_id',
						'type'		=> 'integer',
						'value'		=> $contract_id,
						'is_system' => true));
		}

		$screening_questionnaires = SJB_ScreeningQuestionnaires::getList($current_user->getSID());
		if (SJB_Acl::getInstance()->isAllowed('use_screening_questionnaires') && $screening_questionnaires) {
			$issetQuestionnairyField = $listing->getProperty('screening_questionnaire');
			if ($issetQuestionnairyField) {
				$value = SJB_Request::getVar("screening_questionnaire");
				$listing_info = $_REQUEST;
				$value = $value?$value:isset($listing_info['screening_questionnaire'])?$listing_info['screening_questionnaire']:'';
					$listing->addProperty(
						array (	'id'		=> 'screening_questionnaire',
								'type'		=> 'list',
								'caption'   => 'Screening Questionnaire',
								'value'		=> $value,
								'list_values' => SJB_ScreeningQuestionnaires::getListSIDsAndCaptions($current_user->getSID()),
								'is_system' => true));
			}
		}
		
		/*
		 * social plugin
		 * "synchronization"
		 * if user is not registered using linkedin , delete linkedin sync property
		 * also if sync is turned off in admin part
		 */
		$aAutoFillData = array('oListing' => &$listing, 'userSID' => $current_user->getSID(), 'listingTypeID' => $listing_type_id, 'listing_info' => $_REQUEST);
		SJB_Event::dispatch('SocialSynchronizationFields', $aAutoFillData);
		/*
		 * end of social plugin "sync"
		 */
		
		$add_listing_form = new SJB_Form($listing);
		$add_listing_form->registerTags($tp);
					
		$field_errors = array();
		$listing_package_info = $contract->getPackageInfoByPackageID($listing_package_id);

		if ($form_submitted && $add_listing_form->isDataValid($field_errors)) {
			if ($isPageLast) {
				$listing->addProperty(
					array (	'id'		=> 'complete',
							'type'		=> 'integer',
							'value'		=> 1,
							'is_system' => true));
				$listing->addProperty(
					array (	'id'		=> 'is_new',
							'type'		=> 'integer',
							'value'		=> 1,
							'is_system' => true)
						);
			}
			$listing->setUserSID($current_user->getSID());
			$listing->setListingPackageInfo($listing_package_info);
			
			if (empty($access_type->value))
				$listing->setPropertyValue('access_type', 'everyone');
				
			if ($current_user->isSubuser()) {
				$subuserInfo = $current_user->getSubuserInfo();
				$listing->addSubuserProperty($subuserInfo['sid']);
			}

			SJB_ListingManager::saveListing($listing);
			if (isset($_SESSION['tmp_file_storage'])) {
				foreach ($_SESSION['tmp_file_storage'] as $k => $v) {
					SJB_DB::query("UPDATE `listings_pictures` SET `listing_sid` = ?n WHERE `picture_saved_name` = ?s", $listing->getSID(), $v['picture_saved_name']);
					SJB_DB::query("UPDATE `listings_pictures` SET `listing_sid` = ?n WHERE `thumb_saved_name` = ?s", $listing->getSID(), $v['thumb_saved_name']);
				}
				SJB_Session::unsetValue('tmp_file_storage');
			}
			if ($isPageLast) {
				// Start Event
				SJB_Event::dispatch('listingSaved', $listing->getSID());
				SJB_Session::unsetValue('listing_package_id');
				
				// is listing featured by default
				if ($listing_package_info['is_featured'])
					SJB_ListingManager::makeFeaturedBySID($listing->getSID());
				if ($listing_package_info['priority_listing'])
					SJB_ListingManager::makePriorityBySID($listing->getSID());
				$is_package_free = ($listing_package_info['price'] == 0);

				$ecommerce_mode = SJB_System::getSettingByName('ecommerce');
				if ($is_package_free && !$ecommerce_mode) {
					SJB_ListingManager::activateListingBySID($listing->getSID());
				}
				
				// notify administrator
				
				if (SJB_AdminNotifications::isAdminNotifiedOnListingAdded())
					SJB_AdminNotifications::sendAdminListingAddedLetter($listing->getSID(), $listing_type_id);
				// notify subadmins
				$subAdminsToNotify = SJB_AdminNotifications::isSubAdminNotifiedOnListingAdded();
				if (  is_array($subAdminsToNotify) && !empty($subAdminsToNotify))
					SJB_AdminNotifications::sendAdminListingAddedLetter($listing->getSID(), $listing_type_id, $subAdminsToNotify);

				if (isset($_REQUEST['action_add_pictures']))
					SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/manage-pictures/?listing_id=" . $listing->getSID() );
				else
					SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/manage-listing/?listing_id=" . $listing->getSID() );
			}
			else {
				SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL')."/add-listing/{$listing_type_id}/".SJB_PostingPagesManager::getNextPage($pageSID)."/".$listing->getSID());
			}
		}
		else {
			$listing->deleteProperty('access_list');
			$listing->deleteProperty('contract_id');
			$add_listing_form = new SJB_Form($listing);
			if ($form_submitted) 
				 $add_listing_form->isDataValid($field_errors);
			$add_listing_form->registerTags($tp);
			$template = isset($_REQUEST['input_template']) ? $_REQUEST['input_template'] : "input_form.tpl";
			$form_fields = $add_listing_form->getFormFieldsInfo();
			$employers_list = SJB_Request::getVar('list_emp_ids', false);
			$employers = array();
			if (is_array($employers_list)) {
				foreach ($employers_list as $emp){
					$currEmp	 = SJB_UserManager::getUserInfoBySID($emp);
					$employers[] = array('user_id' => $emp, 'value' => $currEmp['CompanyName'] );
				}
				sort($employers);
			}
			$tp->assign("listing_id", $tmp_listing_sid);
			$tp->assign("listing_access_list", $employers);
			$tp->assign("package", $listing_package_info);
			$tp->assign("listing_type_id", $listing_type_id);
			$tp->assign("contract_id", $contract_id);
			$tp->assign("field_errors", $field_errors);
			$tp->assign("form_fields", $form_fields);
			$tp->assign("pages", $pages);
			$tp->assign("pageSID", $pageSID);
			$tp->assign("currentPage", SJB_PostingPagesManager::getPageInfoBySID($pageSID));
			$tp->assign("isPageLast", $isPageLast );
			$tp->assign("nextPage", SJB_PostingPagesManager::getNextPage($pageSID));
			$tp->assign("prevPage", SJB_PostingPagesManager::getPrevPage($pageSID) );
			
			$metaDataProvider =& SJB_ObjectMother::getMetaDataProvider();
			$tp->assign(
				"METADATA",  
				array ( 
					"form_fields" => $metaDataProvider->getFormFieldsMetadata("FormFieldCaptions", $form_fields), 
					"form_field" => array('caption' => array('domain' => 'FormFieldCaptions')),
				)
			);

			/*
			 * social plugin
			 * only for Resume listing types
			 */
			$aAutoFillData = array('tp' => &$tp, 'listingTypeID' => &$listing_type_id, 'userSID' => $current_user->getSID());
			SJB_Event::dispatch('SocialSynchronizationForm', $aAutoFillData);
			/*
			 * social plugin
			 */

			
			
			/* ELDAR JF */
			function getJobFairsInfo() {
				$jfs_temp = SJB_ListingFieldDBManager::getJobFairsInfoDB();
				return $jfs_temp;
			}
			
			$jobFairsInfo = getJobFairsInfo();
			$tp->assign("jobfairs", $jobFairsInfo);
			
			/* ELDAR JF */			
			$tp->display($template);
		}
	}
}
else {
    
    if ($error == 'NO_CONTRACT') {
    	if (!isset($getParam)) {
    		$getParam = '';
    	}
    	if ($_GET) {
			$getParam .= '?';
			foreach ($_GET as $key => $val)
				$getParam .= $key.'='.$val.'&';
			$getParam = substr($getParam, 0, -1);
		}
		$page = base64_encode(SJB_System::getURI().$getParam);
    	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/subscription/?page='.$page);
    }

    
    
    if ($error == 'NOT_LOGGED_IN') {
    	if (!isset($getParam)) {
    		$getParam = '';
    	}
    	if ($_GET) {
    		$getParam .= '?';
    		foreach ($_GET as $key => $val)
    			$getParam .= $key.'='.$val.'&';
    		$getParam = substr($getParam, 0, -1);
    	}
    	$return_uri = SJB_System::getURI().$getParam;
    	$return_url = base64_encode(SJB_System::getSystemSettings('SITE_URL').$return_uri);
    	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') .'/login/?return_url='.$return_url);
    }

	$tp->assign("listing_type_id", $listing_type_id);
//	$tp->assign("return_url", $return_url);
	$tp->assign("error", $error);
	$tp->display("add_listing_error.tpl");
}

function canCurrentUserAddListing(& $error)
{
    $acl = SJB_Acl::getInstance();

	if (SJB_UserManager::isUserLoggedIn()) {
		$current_user = SJB_UserManager::getCurrentUser();
		if ($current_user->hasContract()) {
			$listing_type_id = SJB_Request::getVar('listing_type_id', false);
			$listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id);
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
