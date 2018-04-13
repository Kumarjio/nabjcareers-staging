<?php


require_once("classifieds/ListingField/ListingFieldManager.php");

require_once("classifieds/ListingField/ListingField.php");

require_once("forms/FormCollection.php");

$template_processor = SJB_System::getTemplateProcessor();

if (isset($_REQUEST['action'], $_REQUEST['field_sid']))
{
	if ($_REQUEST['action'] == 'move_up')
	{
		SJB_ListingFieldManager::moveUpFieldBySID($_REQUEST['field_sid']);
	}
	elseif ($_REQUEST['action'] == 'move_down')
	{
		SJB_ListingFieldManager::moveDownFieldBySID($_REQUEST['field_sid']);
	}
}

$listing_fields_info = SJB_ListingFieldManager::getCommonListingFieldsInfo();
$listing_fields 	= array();
$listing_field_sids = array();

foreach ($listing_fields_info as $listing_field_info)
{
	$listing_field = new SJB_ListingField($listing_field_info);
	$listing_field->setSID($listing_field_info['sid']);
	
	$listing_fields[] = $listing_field;
	$listing_field_sids[] = $listing_field_info['sid'];
}

$form_collection = new SJB_FormCollection($listing_fields);
$form_collection->registerTags($template_processor);

$template_processor->assign("listing_field_sids", $listing_field_sids);
$template_processor->display("listing_fields.tpl");

