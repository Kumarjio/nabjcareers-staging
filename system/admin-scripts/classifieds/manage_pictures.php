<?php


require_once("classifieds/Listing/ListingManager.php");

require_once("classifieds/ListingGallery/ListingGallery.php");

$listing_id = isset($_REQUEST['listing_id']) ? $_REQUEST['listing_id'] : null;

$errors = null;

$field_errors = null;
		
if (is_null($listing_id)) {
	
	$errors['PARAMETERS_MISSED'] = 1;
	
} else {
	
	$listing = SJB_ListingManager::getObjectBySID($listing_id);

	if (is_null($listing)) {
		
		$errors['WRONG_PARAMETERS_SPECIFIED'] = 1;
		
	} else {
		
		$gallery = new SJB_ListingGallery();
		
		$gallery->setListingSID($listing_id);
		
		if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add') {
			
			if (!isset($_FILES['picture']) || $_FILES['picture']['error']) {
				
				$field_errors['Picture'] = 'FILE_NOT_SPECIFIED';
				
			} else {
				
				$image_caption = isset($_REQUEST['caption']) ? $_REQUEST['caption'] : '';
				
				if (!$gallery->uploadImage($_FILES['picture']['tmp_name'], $image_caption)) {
					
					$field_errors['Picture'] = $gallery->getError();
					
				}
				
			}
			
		} elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete') {
			
			if (isset($_REQUEST['picture_sid'])) {
				
				$gallery->deleteImageBySID($_REQUEST['picture_sid']);
				
			}
			
		} elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'move_up') {
			
			if (isset($_REQUEST['picture_sid'])) {
				
				$gallery->moveUpImageBySID($_REQUEST['picture_sid']);
				
			}
			
		} elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'move_down') {
			
			if (isset($_REQUEST['picture_sid'])) {
				
				$gallery->moveDownImageBySID($_REQUEST['picture_sid']);
				
			}
			
		}
		
		$pictures_info = $gallery->getPicturesInfo();
		
		$template_processor = SJB_System::getTemplateProcessor();
		
		$template_processor->assign("errors", $errors);
		
		$template_processor->assign("field_errors", $field_errors);
		
		$template_processor->assign("pictures_info", $pictures_info);
		
		$template_processor->assign("listing_id", $listing_id);
		
		$template_processor->display("manage_pictures.tpl");
		
	}
	
}


