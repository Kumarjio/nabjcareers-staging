<?php


require_once("classifieds/ListingGallery/ListingGallery.php");

$picture_sid = isset($_REQUEST['picture_sid']) ? $_REQUEST['picture_sid'] : null;

$listing_id = isset($_REQUEST['listing_id']) ? $_REQUEST['listing_id'] : null;

$template_processor = SJB_System::getTemplateProcessor();
	
if (!is_null($picture_sid) && !is_null($listing_id)) {
	
	$gallery = new SJB_ListingGallery();
	
	$picture_info = $gallery->getPictureInfoBySID($picture_sid);
	
	if(isset($_REQUEST['picture_caption'])) {
		
		$picture_info['caption'] = $_REQUEST['picture_caption'];
		
		$gallery->updatePictureCaption($picture_sid, $picture_info['caption']);
		
		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . "/manage-pictures/?listing_id=$listing_id");
		
	}
	
	$template_processor->assign("picture", $picture_info);
	
	$template_processor->assign("listing_id", $listing_id);
	
	$template_processor->assign("picture_sid", $picture_sid);
	
	$template_processor->display("edit_picture.tpl");
	
		
}

