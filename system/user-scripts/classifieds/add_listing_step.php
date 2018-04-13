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

$tp = SJB_System::getTemplateProcessor();
$template = isset($_REQUEST['input_template']) ? $_REQUEST['input_template'] : "input_form.tpl";
$error = null;

if (SJB_UserManager::isUserLoggedIn()) {
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
		$listing_id = isset($passed_parameters_via_uri[2])?$passed_parameters_via_uri[2]:false;
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
		$tp->assign('post_max_size', $post_max_size_orig);
	}
	
	$tmp_listing_id_from_request = SJB_Request::getVar('listing_id', false);
	
	$listing_info = SJB_ListingManager::getListingInfoBySID($listing_id);
	$current_user = SJB_UserManager::getCurrentUser();
	$contract_id = $current_user->getContractID();
	if ($listing_info['user_sid'] != SJB_UserManager::getCurrentUserSID())
	{
		$errors['NOT_OWNER_OF_LISTING'] = $listing_id;
	}
	else {
		$listing_type_sid  = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id);
		$pages = SJB_PostingPagesManager::getPagesByListingTypeSID($listing_type_sid);
	
		if (!$pageID) {
			$pageID = $pages[0]['page_id'];
		}
		$pageSID = SJB_PostingPagesManager::getPostingPageSIDByID($pageID, $listing_type_sid);
		$isPageLast = SJB_PostingPagesManager::isLastPageByID($pageSID, $listing_type_sid);
		$currentPageInfo = SJB_PostingPagesManager::getPageInfoBySID($pageSID);
		$listing_package_info = SJB_ListingPackageManager::getPackageInfoByListingSID($listing_id);
		$listingInfo = SJB_ListingManager::getListingInfoBySID($listing_id);
		
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
		
		$listingInfo = array_merge($listingInfo, $_REQUEST);
		$listing = new SJB_Listing($listingInfo, $listing_type_sid, $pageSID);
		$listing->deleteProperty('featured');
		$listing->deleteProperty('priority');
		$listing->deleteProperty('status');
		$listing->deleteProperty('reject_reason');
		// delete special only JobG8 property
		$listing->deleteProperty('company_name');
		$listing->setSID($listing_id);
		
		$access_type = $listing->getProperty('access_type');
		if ($form_submitted && !empty($access_type)) {
		$listing->addProperty(
			array (	'id'		=> 'access_list',
					'type'		=> 'multilist',
					'value'		=> SJB_Request::getVar("list_emp_ids"),
					'is_system' => true));
		}
		if ($isPageLast) {
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
			}

			/*
			 * social plugin
			 * "synchronization"
			 * if user is not registered using linkedin , delete linkedin sync property
			 * also deletes it if sync is turned off in admin part
			 */
			if ($pages[0]['page_id'] == $pageID)
			{
				$aAutoFillData = array('oListing' => &$listing, 'userSID' => $current_user->getSID(), 'listingTypeID' => $listing_type_id, 'listing_info' => $listingInfo);
				SJB_Event::dispatch('SocialSynchronizationFields', $aAutoFillData);
			}
			/*
			 * end of social plugin "sync"
			 */
			
			$add_listing_form = new SJB_Form($listing);
			$add_listing_form->registerTags($tp);
			$package_info = SJB_ListingPackageManager::getPackageInfoByListingSID($listing_id);		
	
			$field_errors = array();
	
			if ($form_submitted && $add_listing_form->isDataValid($field_errors)) {
				if ($isPageLast) {
					$listing->addProperty(
							array (	'id'		=> 'complete',
								'type'		=> 'integer',
								'value'		=> 1,
								'is_system' => true));
				}
				$listing->setUserSID($current_user->getSID());
				
				if (empty($access_type->value))
					$listing->setPropertyValue('access_type', 'everyone');
	
				SJB_ListingManager::saveListing($listing);
				if (isset($_SESSION['tmp_file_storage'])) {
						foreach ($_SESSION['tmp_file_storage'] as $k => $v) {
							SJB_DB::query("UPDATE `listings_pictures` SET `listing_sid` = ?n WHERE `picture_saved_name` = ?s", $listing->getSID(), $v['picture_saved_name']);
							SJB_DB::query("UPDATE `listings_pictures` SET `listing_sid` = ?n WHERE `thumb_saved_name` = ?s", $listing->getSID(), $v['thumb_saved_name']);
						}
						SJB_Session::unsetValue('tmp_file_storage');
				}
			
				if ($isPageLast) {
					$listingSID = $listing->getSID();
					$listing = SJB_ListingManager::getObjectBySID($listingSID);
					$listing->setSID($listingSID);

					$keywords = $listing->getKeywords();
					SJB_ListingManager::updateKeywords($keywords, $listing->getSID());

					// Start Event
					SJB_Event::dispatch('listingSaved', $listing->getSID());
					
					SJB_Session::unsetValue('listing_package_id');
					
					// is listing featured by default
					if ($listing_package_info['is_featured'])
						SJB_ListingManager::makeFeaturedBySID($listing->getSID());
					if ($listing_package_info['priority_listing'])
						SJB_ListingManager::makePriorityBySID($listing->getSID());
					$is_package_free = ($listing_package_info['price'] == 0);
					
					if ($is_package_free) {
						SJB_ListingManager::activateListingBySID($listing->getSID());
					}
					
					// notify administrator
					
					if (SJB_AdminNotifications::isAdminNotifiedOnListingAdded())
						SJB_AdminNotifications::sendAdminListingAddedLetter($listing->getSID(), $listing_type_id);
					// notify subadmins
					$subAdminsToNotify = SJB_AdminNotifications::isSubAdminNotifiedOnListingAdded();
					if ( is_array($subAdminsToNotify) && !empty($subAdminsToNotify))
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
				else {
					$access_type = $listing->getPropertyValue('access_type');
					$employers = SJB_ListingManager::getListingAccessList($listing_id, $access_type);
				}
				
				$tp->assign("pic_limit", $package_info['pic_limit']);
				$tp->assign("listing_sid", $listing_id);
				$tp->assign("listingSID", $listing->getSID());
				$tp->assign("listing_access_list", $employers);
				$tp->assign("listing_type_id", $listing_type_id);
				$tp->assign("contract_id", $contract_id);
				$tp->assign("field_errors", $field_errors);
				$tp->assign("form_fields", $form_fields);
				$tp->assign("pages", $pages);
				$tp->assign("package", $listing_package_info);
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
				$aAutoFillData = array('tp' => &$tp, 'listingTypeID' => $listing_type_id, 'userSID' => $current_user->getSID());
				SJB_Event::dispatch('SocialSynchronizationForm', $aAutoFillData);
				/*
				 * social plugin
				 */

				$tp->display($template);
			}
	}
}
else {
	$tp->assign("error", 'NOT_LOGGED_IN');
	$tp->display("add_listing_error.tpl");
}
	

