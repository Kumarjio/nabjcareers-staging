<?php


require_once("classifieds/ListingType/ListingTypeManager.php");

require_once("classifieds/ListingType/ListingType.php");

require_once("classifieds/ListingField/ListingFieldManager.php");

require_once("classifieds/ListingField/ListingField.php");

require_once("forms/Form.php");

require_once("forms/FormCollection.php");

$template_processor = SJB_System::getTemplateProcessor();

$listing_type_sid = isset($_REQUEST['sid']) ? $_REQUEST['sid'] : null;

if (!is_null($listing_type_sid))
{
	$form_submitted = (isset($_REQUEST['action']) && $_REQUEST['action'] == 'save_info');
	
	$listing_type_info = SJB_ListingTypeManager::getListingTypeInfoBySID($listing_type_sid);

	$listing_type_info = array_merge($listing_type_info, $_REQUEST);
	

	$listing_type = new SJB_ListingType($listing_type_info);
	$listing_type->setSID($listing_type_sid);
	
	$edit_form = new SJB_Form($listing_type);
	
	
	
	$errors = array();

	if ($form_submitted && $edit_form->isDataValid($errors))
	{
		
		SJB_ListingTypeManager::saveListingType($listing_type);
		
		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL") . "/listing-types/");
	}
	else
	{
		$template_processor->assign("errors", $errors);
		$template_processor->assign("listing_type_sid", $listing_type_sid);
		
		$listing_fields_info = SJB_ListingFieldManager::getListingFieldsInfoByListingType($listing_type_sid);

		$display_forms_content = array();
		
		$listing_fields 	= array();
		$listing_field_sids = array();
		
		foreach ($listing_fields_info as $listing_field_info)
		{
			$listing_field = new SJB_ListingField($listing_field_info);
			$listing_field->setSID($listing_field_info['sid']);
			
			$listing_fields[] = $listing_field;
			$listing_field_sids[] = $listing_field_info['sid'];
		}
		
		$edit_form->registerTags($template_processor);

		$template_processor->assign("listing_type_info", $listing_type_info);
		$template_processor->assign("form_fields", $edit_form->getFormFieldsInfo());
		$template_processor->display("edit_listing_type.tpl");

        $form_collection = new SJB_FormCollection($listing_fields);
		$form_collection->registerTags($template_processor);

		$template_processor->assign("listing_field_sids", $listing_field_sids);
		$template_processor->display("listing_type_fields.tpl");
	}
}


