<?php

require_once("orm/Controllers/EditListController.php");
require_once("classifieds/ListingField/ListingFieldListItemManager.php");
require_once("classifieds/ListingField/ListingComplexFieldManager.php");

class SJB_ListingComplexEditListController extends SJB_EditListController{

	function SJB_ListingComplexEditListController($input_data) {
		parent::SJB_EditListController($input_data, new SJB_ListingComplexFieldManager, new SJB_ListingFieldListItemManager);
	}

}
