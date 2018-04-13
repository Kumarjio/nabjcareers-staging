<?php

require_once "classifieds/SearchEngine/SearchFormBuilder.php";
require_once "classifieds/Listing/Listing.php";
require_once "classifieds/Listing/ListingSearcher.php";
require_once "classifieds/ListingType/ListingTypeManager.php";
require_once("classifieds/Listing/ListingCriteriaSaver.php");

$tp = SJB_System::getTemplateProcessor();

if (isset($_REQUEST['listing_type_id'])) {
	$listing_type_id = $_REQUEST['listing_type_id'];
	SJB_Session::setValue('listing_type_id', $listing_type_id);
}
elseif (isset($_REQUEST['restore'])) {
	$listing_type_id = SJB_Session::getValue('listing_type_id');
}
else {
	SJB_Session::setValue('listing_type_id', null);
}

$listing_type_sid = 0;
if (!empty($listing_type_id))
	$listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id);

if(!isset($_REQUEST['listing_type']['equal']) && isset($listing_type_id))
	$_REQUEST['listing_type']['equal'] = $listing_type_id;

if (isset($_REQUEST['searchId'])) {
	$criteria_saver = new SJB_ListingCriteriaSaver($_REQUEST['searchId']);
	$_REQUEST = array_merge($_REQUEST, $criteria_saver->getCriteria());
}


$empty_listing = new SJB_Listing(array(), $listing_type_sid);
$empty_listing->addIDProperty();
$empty_listing->addActivationDateProperty();
$empty_listing->addUsernameProperty();
$empty_listing->addKeywordsProperty();
$empty_listing->addPicturesProperty();
$empty_listing->addListingTypeIDProperty();
$empty_listing->addPostedWithinProperty();

$search_form_builder = new SJB_SearchFormBuilder($empty_listing);

$criteria = SJB_SearchFormBuilder::extractCriteriaFromRequestData($_REQUEST);

$search_form_builder->setCriteria($criteria);
$search_form_builder->registerTags($tp);

$form_fields = $search_form_builder->getFormFieldsInfo();

$tp->assign('form_fields', $form_fields);

$metaDataProvider = SJB_ObjectMother::getMetaDataProvider();
$tp->assign(
	"METADATA",  
	array( 
		"form_fields" => $metaDataProvider->getFormFieldsMetadata("FormFieldCaptions", $form_fields), 
		"form_field" => array('caption' => array('domain' => 'FormFieldCaptions')),
	) 
);

$tp->display(SJB_Request::getVar('form_template', 'search_form.tpl'));

