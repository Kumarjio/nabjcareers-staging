<?php

require_once("classifieds/Listing/ListingManager.php");

require_once("classifieds/ListingGallery/ListingGallery.php");

require_once("users/User/UserManager.php");

require_once("membership_plan/PackagesManager.php");

$template_processor = SJB_System::getTemplateProcessor();
		
$listing_id = isset($_REQUEST['listing_sid']) ? $_REQUEST['listing_sid'] : null;

$package_id = isset($_REQUEST['listing_package_id']) ? $_REQUEST['listing_package_id'] : null;

$errors = null;

$field_errors = null;

if(empty($listing_id)) {
	$errors['WRONG_PARAMETERS_SPECIFIED'] = 1;
}elseif (!empty($listing_id) && strlen($listing_id) == strlen(time()) ) {
	if( $package_id ) {
		SJB_Session::setValue('listing_package_id', $_REQUEST['listing_package_id']);
	} else {
		$package_id = SJB_Session::getValue('listing_package_id');
	}

	if( empty( $_SESSION['tmp_file_storage'] ) ) {
		SJB_Session::setValue('tmp_file_storage', array());
	}

	$package_info = SJB_PackagesManager::getPackageInfoByPackageID($package_id);
	
	$gallery = new SJB_ListingGallery();
	$gallery->setListingSID($listing_id);	
	$template_processor->assign("package", $package_info);
		if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add') {
			
			if (!isset($_FILES['picture']) ) {
				
				$field_errors['Picture'] = 'FILE_NOT_SPECIFIED';
				
			} elseif ( $_FILES['picture']['error'] ) {
				
				switch ($_FILES['picture']['error']) {
					case '1':
						$field_errors['Picture'] = 'UPLOAD_ERR_INI_SIZE';
						break;
					case '2':
						$field_errors['Picture'] = 'UPLOAD_ERR_FORM_SIZE';
						break;
					case '3':
						$field_errors['Picture'] = 'UPLOAD_ERR_PARTIAL';
						break;
					case '4':
						$field_errors['Picture'] = 'UPLOAD_ERR_NO_FILE';
						break;
					default:
						break;
				}
			} else {
			
				$image_caption = isset($_REQUEST['caption']) ? $_REQUEST['caption'] : '';
				$_FILES['picture']['caption'] = $image_caption;
				
				if (!$gallery->uploadImage($_FILES['picture']['tmp_name'], $image_caption)) {
					
					$field_errors['Picture'] = $gallery->getError();
					
				}
		}
	}
	elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete') {
			
			if (isset($_REQUEST['picture_id'])) {
			$picture_id = $_REQUEST['picture_id'];
			$gallery->deleteImageBySID($picture_id);
		}
	}
	$number_of_picture_allowed = $package_info['pic_limit'];
	$number_of_picture = $gallery->getPicturesAmount();
	$pictures_info = $gallery->getPicturesInfo();
	$_SESSION['tmp_file_storage'] = $pictures_info;

	$template_processor->assign("listing", array('id' => "$listing_id"));
	$template_processor->assign("number_of_picture_allowed", $number_of_picture_allowed);
	$template_processor->assign("number_of_picture", $number_of_picture);
	$template_processor->assign('pictures', $_SESSION['tmp_file_storage']);

} else {

	$listing = SJB_ListingManager::getObjectBySID($listing_id);
	
	if (is_null($listing)) {
		
		$errors['WRONG_PARAMETERS_SPECIFIED'] = 1;
		
	} elseif ($listing->getUserSID() != SJB_UserManager::getCurrentUserSID()) {
		
		$errors['NOT_OWNER'] = 1;
		
	} else {
		
		$gallery = new SJB_ListingGallery();
		
		$gallery->setListingSID($listing_id);
		
		$package_info = $listing->getListingPackageInfo();
	
		if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add') {
			
			if (!isset($_FILES['picture']) ) {
				
				$field_errors['Picture'] = 'FILE_NOT_SPECIFIED';
				
			} elseif ( $_FILES['picture']['error'] ) {
				
				switch ($_FILES['picture']['error']) {
					case '1':
						$field_errors['Picture'] = 'UPLOAD_ERR_INI_SIZE';
						break;
					case '2':
						$field_errors['Picture'] = 'UPLOAD_ERR_FORM_SIZE';
						break;
					case '3':
						$field_errors['Picture'] = 'UPLOAD_ERR_PARTIAL';
						break;
					case '4':
						$field_errors['Picture'] = 'UPLOAD_ERR_NO_FILE';
						break;
					default:
						break;
				}
				
			} else {
				
				$image_caption = isset($_REQUEST['caption']) ? $_REQUEST['caption'] : '';
				
				if (!$gallery->uploadImage($_FILES['picture']['tmp_name'], $image_caption)) {
					
					$field_errors['Picture'] = $gallery->getError();
					
				}
				
			}
			
		} elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete') {
			
			if (isset($_REQUEST['picture_id'])) {
				
				$gallery->deleteImageBySID($_REQUEST['picture_id']);
				
			}
			
		} elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'move_up') {
			
			if (isset($_REQUEST['picture_id'])) {
				
				$gallery->moveUpImageBySID($_REQUEST['picture_id']);
				
			}
			
		} elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'move_down') {
			
			if (isset($_REQUEST['picture_id'])) {
				
				$gallery->moveDownImageBySID($_REQUEST['picture_id']);
				
			}
			
		}
		
		$number_of_picture_allowed = $package_info['pic_limit'];
		
		$number_of_picture = $gallery->getPicturesAmount();
		
		$listing_info['id'] = $listing_id;
		
		$template_processor->assign("listing", $listing_info);
		
		$pictures_info = $gallery->getPicturesInfo();
		
		$template_processor->assign("pictures", $pictures_info);
		
		$template_processor->assign("number_of_picture", $number_of_picture);
	
		$template_processor->assign("number_of_picture_allowed", $number_of_picture_allowed);
		
	}
}
$template_processor->assign("errors", $errors);
$template_processor->assign("field_errors", $field_errors);			
$template_processor->display("manage_pictures.tpl");