<?php


require_once("classifieds/Listing/Listing.php");

require_once("classifieds/Listing/ListingManager.php");

require_once("classifieds/ListingType/ListingTypeManager.php");

require_once("forms/Form.php");

$template_processor = SJB_System::getTemplateProcessor();

$listing_type_id = isset($_REQUEST['listing_type_id']) ? $_REQUEST['listing_type_id'] : null;

if (is_null($listing_type_id)) {
	
	$listing_types_info = SJB_ListingTypeManager::getAllListingTypesInfo();
	
	if (count($listing_types_info) == 1) {
		
		$listing_type_info = array_pop($listing_types_info);
		
		$listing_type_id = $listing_type_info['id'];
		
		SJB_HelperFunctions::redirect("?listing_type_id=$listing_type_id");
		
	}
	
	$template_processor->assign("listing_types_info", $listing_types_info);
	
	$template_processor->display("add_listing_choose_listing_type.tpl");
	
} else {
	
	$listing_type_sid  = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id);
	$listing_type_info = SJB_ListingTypeManager::getListingTypeInfoBySID($listing_type_sid);
	
	
	
	$listing_info = array_merge($_FILES, $_REQUEST);

	
	
	$listing = new SJB_Listing($listing_info, $listing_type_sid);
	
	// delete special JobG8 property from form
	$listing->deleteProperty('company_name');
	
	$add_listing_form = new SJB_Form($listing);
	
	$add_listing_form->registerTags($template_processor);
	
	$form_submitted = (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add');
		
	$template_processor->assign("listing_type_info", $listing_type_info);
	
	$errors = array();
	
	if ($form_submitted && $add_listing_form->isDataValid($errors)) {
		
		SJB_ListingManager::saveListing($listing);
		
		SJB_Event::dispatch('listingSaved', $listing->getSID());
		
		$template_processor->display("add_listing_success.tpl");

	} else {
		
		$template_processor->assign("errors", $errors);
		$template_processor->assign("object_sid", $listing->getSID());
		
		$template_processor->assign("form_fields", $add_listing_form->getFormFieldsInfo());
		
		$template_processor->assign("listing_type_id", $listing_type_id);
		
		$template_processor->display("input_form.tpl");
		
	}
	
}

