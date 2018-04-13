<?php


require_once("classifieds/ListingGallery/ListingGallery.php");

$picture_sid = isset($_REQUEST['picture_id']) ? $_REQUEST['picture_id'] : null;

$picture_type = isset($_REQUEST['type']) ? $_REQUEST['type'] : null;

if (!is_null($picture_sid)) {
	
	$gallery = new SJB_ListingGallery();

	$pictures_info = $gallery->getPictureInfoBySID($picture_sid);

	if (!empty($pictures_info)) {
		
		if ($picture_type == 'thumb') {
			
			header("Content-Type: image/jpeg");

			echo $pictures_info['thumbnail']; 
		
		} else {

			header("Content-Type: image/jpeg");
			
			echo $pictures_info['picture'];
			
		}
		
	}
	
}


