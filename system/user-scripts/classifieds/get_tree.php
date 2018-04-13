<?php

require_once('miscellaneous/TreeHelper.php');

$oTreeHelper = new SJB_TreeHelper('listing');
$oTreeHelper->init();

/**
 * @author still
 * DISPLAY AS SELECT BOXES
 */
if ( $oTreeHelper->get_displayAsSelectBoxes() )
{
	$oTreeHelper->getDisplayAsSelectBoxes();
}
/*
 * DISPLAY AS TREE
 * OLD VARIANT
 */
else
{
	//	$tree_values = SJB_ListingFieldTreeManager::getTreeValuesBySID($fieldSID);
	$oTreeHelper->getDisplayAsTree();
}

exit();