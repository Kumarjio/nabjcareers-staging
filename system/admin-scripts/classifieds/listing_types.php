<?php


require_once("classifieds/ListingType/ListingTypeManager.php");

$template_processor = SJB_System::getTemplateProcessor();

$listing_types_structure = SJB_ListingTypeManager::createTemplateStructureForListingTypes();

$template_processor->assign("listing_types", $listing_types_structure);
$template_processor->display("listing_types.tpl");

