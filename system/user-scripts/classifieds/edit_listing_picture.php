<?php


require_once("classifieds/ListingGallery/ListingGallery.php");

$picture_id = isset($_REQUEST['picture_id']) ? $_REQUEST['picture_id'] : null;

$listing_id = isset($_REQUEST['listing_id']) ? $_REQUEST['listing_id'] : null;

$template_processor = SJB_System::getTemplateProcessor();
	
if (!is_null($picture_id) && !is_null($listing_id)) {
	
	$gallery = new SJB_ListingGallery();
	
	$picture_info = $gallery->getPictureInfoBySID($picture_id);
	
	if(isset($_REQUEST['picture_caption'])) {
		
		$picture_info['caption'] = $_REQUEST['picture_caption'];
		
		$gallery->updatePictureCaption($picture_id, $picture_info['caption']);
		
//		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/system/classifieds/manage-pictures/?listing_id=$listing_id");
		
	}
	
	$template_processor->assign("picture", $picture_info);
	
	$template_processor->assign("listing_id", $listing_id);
	
	$template_processor->assign("picture_id", $picture_id);
	
	$template_processor->display("edit_picture.tpl");
	
		
}

