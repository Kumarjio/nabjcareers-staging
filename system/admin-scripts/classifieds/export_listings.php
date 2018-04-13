<?php


require_once SJB_System::getSystemSettings('EXTERNAL_COMPONENTS_DIR').'Excel/Writer.php'; 
   
require_once 'classifieds/Listing/Listing.php';    
require_once 'classifieds/Listing/ListingSearcher.php';
require_once 'classifieds/ListingType/ListingTypeManager.php';   

require_once 'classifieds/SearchEngine/SearchFormBuilder.php';
require_once 'classifieds/SearchEngine/PropertyAliases.php'; 
require_once 'classifieds/ExportController.php'; 

$template_processor = SJB_System::getTemplateProcessor();

$errors = array();

$listing_type_id 	= isset($_REQUEST['listing_type']) ? $_REQUEST['listing_type']['equal'] : 0;
$listing_type_id 	= isset($_REQUEST['listing_type_id']) ? $_REQUEST['listing_type_id'] : $listing_type_id;
$export_properties 	= isset($_REQUEST['export_properties']) ? $_REQUEST['export_properties'] : array();

$listing  = SJB_ExportController::createListing($listing_type_id); 
$criteria = SJB_SearchFormBuilder::extractCriteriaFromRequestData($_REQUEST, $listing);

$search_form_builder = new SJB_SearchFormBuilder($listing);	
$search_form_builder->registerTags($template_processor);
$search_form_builder->setCriteria($criteria);
	
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{	
	if (empty($export_properties)) 
	{
		$errors['EMPTY_EXPORT_PROPERTIES'] = true;		
	}
	else
	{
		$searcher = new SJB_ListingSearcher();
		
		$search_aliases  	= SJB_ExportController::getSearchPropertyAliases();						
		$found_listings_sid = $searcher->getObjectsSIDsByCriteria($criteria, $search_aliases);
				
		if (empty($found_listings_sid)) 
		{
			$errors['EMPTY_EXPORT_DATA'] = true;			
		}
		else
		{
			SJB_ExportController::createExportDirectories();
					
			$export_aliases  = SJB_ExportController::getExportPropertyAliases();
			$export_data 	 = SJB_ExportController::getExportData($found_listings_sid, $export_properties, $export_aliases);

			SJB_ExportController::changeTreeProperties($export_properties, $export_data);
			SJB_ExportController::changePicturesProperties($export_properties, $export_data);
			SJB_ExportController::changeMonetaryProperties($export_properties, $export_data);
			SJB_ExportController::changeFileProperties($export_properties, $export_data, 'file');
			SJB_ExportController::changeFileProperties($export_properties, $export_data, 'video');
			
			SJB_ExportController::makeExportFile($export_properties, $export_data, 'export.xls');	
			
			SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL")."/archive-and-send-export-data");
		}		
	}
}

$listing_properties_id = SJB_ListingManager::getAllListingPropertiesID($listing_type_id);

$template_processor->assign("errors", $errors);
$template_processor->assign("properties_id", $listing_properties_id);
$template_processor->assign("selected_listing_type_id", $listing_type_id);
$template_processor->display("export_listings.tpl");
  
