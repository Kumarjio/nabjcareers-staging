<?php

require_once("classifieds/Listing/ListingManager.php");
require_once("classifieds/Listing/Listing.php");
require_once("forms/Form.php");
require_once("membership_plan/Contract.php");
require_once("classifieds/PostingPages/PostingPagesManager.php");
require_once("miscellaneous/AdminNotifications.php");

$template_processor = SJB_System::getTemplateProcessor();
$current_user = SJB_UserManager::getCurrentUser();
$currentUserInfo = SJB_UserManager::getCurrentUserInfo();
$template_processor->assign("current_user", $currentUserInfo);

$errors = array();
$listing_id = isset($_REQUEST['listing_id']) ? $_REQUEST['listing_id'] : null;

if (SJB_UserGroupManager::getUserGroupIDBySID($current_user->user_group_sid) == 'Employer') 
	$template = isset($_REQUEST['input_template']) ? $_REQUEST['input_template'] : "copy_listing.tpl";
else 
	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL')."/my-listings/");

//getting $tmp_listing_id from request
$tmp_listing_id_from_request = SJB_Request::getVar('tmp_listing_id', false);

$listing_info = SJB_ListingManager::getListingInfoBySID($listing_id);
$listing_type_id = SJB_ListingTypeManager::getListingTypeIDBySID($listing_info['listing_type_sid']);
if ($listing_packages_info = canCurrentUserAddListing($error, $listing_type_id)) {

	$pages = SJB_PostingPagesManager::getPagesByListingTypeSID($listing_info['listing_type_sid']);
	
	if (!empty($tmp_listing_id_from_request)) {
		$tmp_listing_sid = $tmp_listing_id_from_request;
	} elseif (!$tmp_listing_id_from_request) {
		$tmp_listing_sid = time();
	}

	$gallery = new SJB_ListingGallery();
	$gallery->setListingSID($listing_info['sid']);
	$pictures_info = $gallery->getPicturesInfo();
	$gallery->setListingSID($tmp_listing_sid);
	$pictures_info_new = $gallery->getPicturesInfo();
	//reuploading pictures
	if (!$pictures_info_new) {
		foreach($pictures_info as $k => $v) {
			if (!$gallery->uploadImage($v['picture_url'], $v['caption'])) {					
				$field_errors['Picture'] = $gallery->getError();					
			}
		}
	}
	
	$listing_package_id = SJB_Request::getVar('listing_package_id', false);
	
	if ($listing_package_id) {
		$info = explode("_", $listing_package_id);
		$listing_package_id = $info[0];
		$contract_id = $info[1];
		$contract = new SJB_Contract(array('contract_id' => $contract_id));
	}
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
				$template_processor->assign("tmp_listing_id", $tmp_listing_sid);
				SJB_Session::setValue('listing_package_id', $listing_package_id);
				$contract = new SJB_Contract(array('contract_id' => $contract_id));
			}
		}
		else {
			$template_processor->assign("tmp_listing_id", $tmp_listing_sid);
			$template_processor->assign("listing_packages", $listing_packages_info);
			$template_processor->assign("cloneJob", true);
			$template_processor->assign("listing_id", $listing_id);
			$template_processor->assign("METADATA", array (
														'listing_package' => array (
														'name' => array('domain' => 'Miscellaneous'),
														'description' => array('domain' => 'Miscellaneous'),
														)
													));
			$template_processor->display("listing_package_choice.tpl");
		}
	}
	if ($listing_package_id) {
		$template_processor->assign("tmp_listing_id", $tmp_listing_sid);
		$package_info = SJB_PackagesManager::getPackageInfoByPackageID($listing_package_id);
		$template_processor->assign("pic_limit", $package_info['pic_limit']);
		if ($listing_info['user_sid'] != SJB_UserManager::getCurrentUserSID())
			$errors['NOT_OWNER_OF_LISTING'] = $listing_id;
		elseif (!is_null($listing_info)) {
			$listing_info = array_merge($listing_info, $_REQUEST);
			$listing = new SJB_Listing($listing_info, $listing_info['listing_type_sid']);
			$listing->deleteProperty('featured');
			$listing->deleteProperty('priority');
			$listing->deleteProperty('status');
			$listing->deleteProperty('reject_reason');
			// delete special only JobG8 property
			$listing->deleteProperty('company_name');
			$listing->setSID($listing_id);
			$listing_edit_form = new SJB_Form($listing);
			$listing_edit_form->registerTags($template_processor);
			$form_is_submitted = (isset($_REQUEST['action']) && $_REQUEST['action'] == 'save_info' || isset($_REQUEST['action']) && $_REQUEST['action'] == 'add');
			$listing->addProperty(
				array (	'id'		=> 'contract_id',
						'type'		=> 'integer',
						'value'		=> $contract_id,
						'is_system' => true));
			$delete = (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete');
			$field_errors = null;
			if ($delete && isset($_REQUEST['field_id'])) {
				$field_id = $_REQUEST['field_id'];
				$listing->details->properties[$field_id]->type->property_info['value'] = null;
			}
			elseif ($form_is_submitted && $listing_edit_form->isDataValid($field_errors)) {
				$listing_package_info = $contract->getPackageInfoByPackageID($listing_package_id);
				$listing->addProperty(
				array (	'id'		=> 'complete',
						'type'		=> 'integer',
						'value'		=> 1,
						'is_system' => true));
				$listing->setUserSID($current_user->getSID());
				$listing->setListingPackageInfo($listing_package_info);
				$listing->sid = null;
				if (!empty($listing_info['subuser_sid'])) {
					$listing->addSubuserProperty($listing_info['subuser_sid']);
				}
				SJB_ListingManager::saveListing($listing);

				$new_listing_id = SJB_ListingManager::copyListingBySID($_REQUEST, $listing_id, $listing->getSID(), $tmp_listing_sid);
				
				// is listing featured by default
				if ($listing_package_info['is_featured'])
					SJB_ListingManager::makeFeaturedBySID($new_listing_id);
				if ($listing_package_info['priority_listing'])
					SJB_ListingManager::makePriorityBySID($new_listing_id);
				$is_package_free = ($listing_package_info['price'] == 0);

				$ecommerce_mode = SJB_System::getSettingByName('ecommerce');
				if ($is_package_free && !$ecommerce_mode)
					SJB_ListingManager::activateListingBySID($new_listing_id);
					
				if (SJB_AdminNotifications::isAdminNotifiedOnListingAdded())
					SJB_AdminNotifications::sendAdminListingAddedLetter($new_listing_id, $listing_type_id);

				SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/manage-listing/?listing_id=" . $new_listing_id );
			}
			elseif ($form_is_submitted) {
				$details = $listing->getDetails();
				$field_id = 'video';
				if (!isset($_REQUEST['video_hidden']) &&  $details->properties[$field_id]->value != null) {
					$listing->details->properties[$field_id]->type->property_info['value'] = null;
				}
			}
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
			$metaDataProvider =& SJB_ObjectMother::getMetaDataProvider();
			$template_processor->assign
			(
				"METADATA",  
				array
				( 
					"listing"     => $metaDataProvider->getMetaData("Property_", $listing_structure['METADATA']), 
					"form_fields" => $metaDataProvider->getFormFieldsMetadata("FormFieldCaptions", $form_fields), 
					"form_field" => array('caption' => array('domain' => 'FormFieldCaptions')),
				) 
			);
			$template_processor->assign("countPages", count($listing_fields_by_page));
			$template_processor->assign("copy_listing", 1);
			$template_processor->assign("tmp_listing_id", $tmp_listing_sid);
			$template_processor->assign("listing_id", $listing_id);
			$template_processor->assign("listing_package_id", $listing_package_id);
			$template_processor->assign("contract_id", $contract_id);
			$template_processor->assign("listing", $listing_structure);
			$template_processor->assign("pages", $listing_fields_by_page);
			$template_processor->assign("field_errors", $field_errors);	
		}
		$template_processor->assign("errors", $errors);
		$template_processor->display($template);
	}
}
else {
    
	$listing_type_id = isset($listing_info['listing_type_sid'])?$listing_info['listing_type_sid']:false;
	
    if($error == 'NO_CONTRACT') {
    	if($_GET) {
		$getParam .= '?';
		foreach ($_GET as $key => $val) {
			$getParam .= $key.'='.$val.'&';
		}
		$getParam = substr($getParam, 0, -1);
	}
		$page = base64_encode(SJB_System::getURI().$getParam);
    	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/subscription/?page='.$page);
    }
	$template_processor->assign("clone_job", 1);
	$template_processor->assign("listing_type_id", $listing_type_id);
	$template_processor->assign("error", $error);
	$template_processor->display("add_listing_error.tpl");
}


function canCurrentUserAddListing(& $error, $listing_type_id) {
	$acl = SJB_Acl::getInstance();
	if (SJB_UserManager::isUserLoggedIn()) {
		$current_user = SJB_UserManager::getCurrentUser();
		if ($current_user->hasContract()) {
			$listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id);
			$contracts_id = $current_user->getContractID();
			$contractsSIDs = $contracts_id ? implode(',', $contracts_id) : 0;
			$resultContractInfo = SJB_DB::query("SELECT `id`, `membership_plan_id`, `expired_date` FROM `contracts` WHERE `id` in ({$contractsSIDs}) ORDER BY `expired_date` DESC" );
			$PlanAcces = count($resultContractInfo) > 0 ? true : false;
			if ($PlanAcces && $acl->isAllowed('post_' . $listing_type_id)) {
				$availableListingsAmount = 0;
				$listing_packages_info = array();
				$is_contract = false;
				$i18n =& SJB_ObjectMother::createI18N();
				foreach ($resultContractInfo as $contractInfo) {
					$contract = new SJB_Contract(array('contract_id' => $contractInfo['id']));
					if ($acl->isAllowed('post_' . $listing_type_id)) {
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