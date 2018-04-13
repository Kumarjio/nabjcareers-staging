<?php

require_once("classifieds/ListingType/ListingType.php");
require_once("classifieds/ListingType/ListingTypeManager.php");
require_once ("classifieds/PostingPages/PostingPages.php");
require_once("forms/Form.php");

$listing_type = new SJB_ListingType($_REQUEST);

$add_listing_type_form = new SJB_Form($listing_type);

$form_is_submitted = (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add');

$errors = null;

if ($form_is_submitted && $add_listing_type_form->isDataValid($errors)) {
	
	SJB_ListingTypeManager::saveListingType($listing_type);
	$pageInfo = array('page_id'=> 'Post'.$listing_type->getID(),'page_name' => 'Post '.$listing_type->getID());
	$page = new SJB_PostingPages($pageInfo, $listing_type->getSID());
	SJB_PostingPagesManager::savePage($page);
	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/listing-types/");
	
} else {
	
	$template_processor = SJB_System::getTemplateProcessor();
	
	$template_processor->assign("errors", $errors);
	
	$add_listing_type_form->registerTags($template_processor);
	
	$template_processor->assign("form_fields", $add_listing_type_form->getFormFieldsInfo());
	
	$template_processor->display("add_listing_type.tpl");
	
}

