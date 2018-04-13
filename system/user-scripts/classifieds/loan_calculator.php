<?php


require_once "classifieds/Listing/ListingManager.php";

$amount = 50000;

if (isset ($_REQUEST['listing_id']))
{
	$listing 			= SJB_ListingManager::getObjectBySID($_REQUEST['listing_id']);
	$listing_structure 	= SJB_ListingManager::createTemplateStructureForListing($listing);

	if (!empty($listing))
	{
		$amount = $listing_structure['Price'];
	}
}

$template_processor = SJB_System::getTemplateProcessor();
$template_processor->assign('amount', $amount);
$template_processor->display('loan_calculator.tpl');

