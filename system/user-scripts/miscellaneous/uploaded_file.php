<?php


require_once("miscellaneous/UploadPictureManager.php");

$picture_id = isset($_REQUEST['file_id']) ? $_REQUEST['file_id'] : null;

$picture_info = SJB_UploadPictureManager::getUploadedPictureInfo($picture_id);

if (!is_null($picture_id) && (!is_null($picture_info))) {
	
	if (!empty($picture_info['file_content'])) {
		
		header("Content-Type: image/jpeg");
			
		echo $picture_info['file_content'];
		
	}
	
}

