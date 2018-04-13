<?php


require_once("classifieds/ListingField/ListingFieldManager.php");

class SJB_ListingGallery {
	
	var $listing_sid;
	
	var $error;
	
	var $upload_files_directory;
	
	function SJB_ListingGallery() {
		
		$this->upload_files_directory = SJB_System::getSystemSettings("UPLOAD_FILES_DIRECTORY");
		
	}
	
	function setListingSID($listing_sid) {
		
		$this->listing_sid = $listing_sid;
		
	}
	
	function getPicturesInfo() {
		
		$pictures_info = SJB_DB::query("SELECT *, sid AS id FROM listings_pictures WHERE listing_sid = ?n ORDER BY `order`", $this->listing_sid);
		
		foreach ($pictures_info as $key => $picture_info) {
			
			$pictures_info[$key]['picture_url'] = $this->getPictureURLByInfo($picture_info);
			
			$pictures_info[$key]['thumbnail_url'] = $this->getThumbURLByInfo($picture_info);
			
		}
		
		return $pictures_info;
		
	}
	
	function copyFile($id, $new_id, $type, $file = false) {
		
		$dir = '';
		switch ($type) {
			case 'Photo':     $dir = '/pictures/'; break;
			case 'video':     $dir = '/video/';    break;
			case 'Logo' :     $dir = '/pictures/'; break;
			case 'pictures' : $dir = '/pictures/'; break;
		}
		
		if(!$file) {
			$uploadFile = SJB_DB::query("SELECT * FROM uploaded_files WHERE `id`= ?s", $id);
			$uploadFile = array_pop($uploadFile);
		}
		else {
			$uploadFile = $file;
		}
		$uploadDir = $this->upload_files_directory.$dir;
		if(copy($uploadDir.$uploadFile['saved_file_name'], $uploadDir.$new_id."_".$uploadFile['saved_file_name'])) {
			$uploadFile['saved_file_name'] = $new_id."_".$uploadFile['saved_file_name'];
			if($file) {
				copy($uploadDir.$uploadFile['thumb_saved_name'], $uploadDir.$new_id."_".$uploadFile['thumb_saved_name']);
				if(isset($file['return']) && $file['return'] == 'name') {
					$copyFileData= array_pop(SJB_DB::query("SELECT * FROM uploaded_files WHERE `id`= ?s", $id));
					$copyFileData['sid'] = '';
					$copyFileData['id'] = $type."_".$new_id;
					$copyFileData['file_name'] = $uploadFile['saved_file_name'] ;
					$copyFileData['saved_file_name'] = $uploadFile['saved_file_name'];
					$keys = "`".implode("`,`", array_keys($copyFileData))."`";
					$info = "'".implode("','", array_values($copyFileData))."'";
					SJB_DB::query("INSERT INTO uploaded_files (".$keys.") VALUES (".$info.")");
					$new_id = $type."_".$new_id;
				}
				return $new_id;
			}
			else {
				$uploadFile['sid'] = '';
				$uploadFile['id'] = $type."_".$new_id;
				$keys = "`".implode("`,`", array_keys($uploadFile))."`";
				$info = "'".implode("','", array_values($uploadFile))."'";
				
				SJB_DB::query("INSERT INTO uploaded_files (".$keys.") VALUES (".$info.")");
				return $uploadFile['id'];
			}
		}
		return false;
	}
	function updatePictureCaption($picture_sid, $picture_caption) {
		
		SJB_DB::query("UPDATE listings_pictures SET caption = ?s WHERE sid = ?n", $picture_caption, $picture_sid);
		
	}
	
	function getPictureInfoBySID($picture_sid) {
		
		$pictures_info = SJB_DB::query("SELECT * FROM listings_pictures WHERE sid = ?n ORDER BY `order`", $picture_sid);
		
		if (empty($pictures_info)) {
			
			return null;
			
		} else {
			
			$picture_info = array_pop($pictures_info);
			
			$picture_info['picture_url'] = $this->getPictureURLByInfo($picture_info);
			
			$picture_info['thumbnail_url'] = $this->getThumbURLByInfo($picture_info);
			
			return $picture_info;
			
		}
		
		
	}
	
	function moveUpImageBySID($image_sid) {
		
		$image_info = $this->getPictureInfoBySID($image_sid);
		
		$less_order = SJB_DB::query("SELECT * FROM listings_pictures WHERE `order` < ?n AND listing_sid = ?n ORDER BY `order` DESC LIMIT 1", $image_info['order'], $this->listing_sid);
		
		if (!empty($less_order)) {
			
			$less_order = array_pop($less_order);
			
			SJB_DB::query("UPDATE listings_pictures SET `order` = ?n WHERE sid = ?n", $image_info['order'], $less_order['sid']);
			
			SJB_DB::query("UPDATE listings_pictures SET `order` = ?n WHERE sid = ?n", $less_order['order'], $image_sid);
			
		}
		
	}
	
	function moveDownImageBySID($image_sid) {
		
		$image_info = $this->getPictureInfoBySID($image_sid);
		
		$more_order = SJB_DB::query("SELECT * FROM listings_pictures WHERE `order` > ?n AND listing_sid = ?n ORDER BY `order` ASC LIMIT 1", $image_info['order'], $this->listing_sid);
		
		if (!empty($more_order)) {
			
			$more_order = array_pop($more_order);
			
			SJB_DB::query("UPDATE listings_pictures SET `order` = ?n WHERE sid = ?n", $image_info['order'], $more_order['sid']);
			
			SJB_DB::query("UPDATE listings_pictures SET `order` = ?n WHERE sid = ?n", $more_order['order'], $image_sid);
			
		}
		
	}
	
	function getPicturesAmount() {
		
		$count = SJB_DB::query("SELECT COUNT(*) FROM listings_pictures WHERE listing_sid = ?n", $this->listing_sid);
		
		if (empty($count)) {
			
			return 0;
			
		} else {
			
			return array_pop(array_pop($count));
			
		}
		
	}
	
	function deleteImageBySID($image_sid) {
		
		$image_info = $this->getPictureInfoBySID($image_sid);
		
		if ($image_info['storage_method'] == 'file_system') {
			
			@unlink($this->upload_files_directory . "/pictures/" . $image_info['picture_saved_name']);
			
			@unlink($this->upload_files_directory . "/pictures/" . $image_info['thumb_saved_name']);
			
		}
		
		SJB_DB::query("DELETE FROM listings_pictures WHERE sid = ?n", $image_sid);
		
		$this->setListingPictureAmount($this->getPicturesAmount());
		
	}
	
	function setListingPictureAmount($pictures_amount) {
		
		SJB_DB::query("UPDATE listings SET pictures = ?n WHERE sid = ?n", $pictures_amount, $this->listing_sid);
		
	}
	
	function deleteImages() {
		
		$images_info = SJB_DB::query("SELECT sid FROM listings_pictures WHERE listing_sid = ?n", $this->listing_sid);
		
		foreach ($images_info as $image_info) {
			
			$this->deleteImageBySID($image_info['sid']);
			
		}
        
        return true;
		
	}
	
	function getPictureURLByInfo($picture_info) {
		
		if ($picture_info['storage_method'] == 'file_system') {
			
			$picture_url = SJB_System::getSystemSettings("SITE_URL") . "/" . $this->upload_files_directory . "/pictures/" . $picture_info['picture_saved_name'];
			
		} else {
			
			$picture_url = SJB_System::getSystemSettings("SITE_URL") 
				. "/listing-picture/?type=pic&picture_id=" . $picture_info['sid'];
			
		}
		
		return $picture_url;
		
	}
	
	function getThumbURLByInfo($thumb_info) {
		
		if ($thumb_info['storage_method'] == 'file_system') {
			
			$thumb_url = SJB_System::getSystemSettings("SITE_URL") . "/" . $this->upload_files_directory . "/pictures/" . $thumb_info['thumb_saved_name'];
			
		} else {
			
			$thumb_url = SJB_System::getSystemSettings("SITE_URL") 
				. "/listing-picture/?type=thumb&amp;picture_id=" . $thumb_info['sid'];
			
		}
		
		return $thumb_url;
		
	}
	
	function uploadImage($image_file_name, $image_caption) {
		
		$image_info = getimagesize($image_file_name);		// $image_info['2'] = 1 {GIF}, 2 {JPG}, 3 {PNG}, 4 {SWF}, 5 {PSD}, 6 {BMP}, 7 {TIFF}, 8 {TIFF}, 9 {JPC}, 10 {JP2}, 11 {JPX}
		
		if ( $image_info['2'] >= 1 && $image_info['2'] <= 3 ) {
			
			if ($image_info['2'] == 1) {
			
				$image_resource = imagecreatefromgif($image_file_name);
			
			} elseif ($image_info['2'] == 2) {
			
				$image_resource = imagecreatefromjpeg($image_file_name);
			
			} else {
			
				$image_resource = imagecreatefrompng($image_file_name);
			
			}
			
			$picture_max_size['width']  = SJB_System::getSettingByName('listing_picture_width');
			
			$picture_max_size['height'] = SJB_System::getSettingByName('listing_picture_height');
			
			$picture_resource = $this->getResizedImageResource($image_resource, $picture_max_size);
			
			$thumb_max_size['width']  = SJB_System::getSettingByName('listing_thumbnail_width');
			
			$thumb_max_size['height'] = SJB_System::getSettingByName('listing_thumbnail_height');
			
			$thumb_resource = $this->getResizedImageResource($image_resource, $thumb_max_size);
			
			$max_order = SJB_DB::query("SELECT MAX(`order`) FROM listings_pictures WHERE `listing_sid` = ?n", $this->listing_sid);
			
			$max_order = (empty($max_order) ? 0 : array_pop(array_pop($max_order)));
			
			$order = $max_order + 1;
				
			$storage_method = SJB_System::getSettingByName('listing_picture_storage_method');
			
			if ($storage_method == 'database') {
				
				$picture_content = $this->getImageResourceContent($picture_resource);
				
				$thumb_content = $this->getImageResourceContent($thumb_resource);
				
				SJB_DB::query("INSERT INTO listings_pictures"
				
					. " SET `listing_sid` = ?n, `storage_method` = ?s, `picture` = ?b, `thumbnail` = ?b, `caption` = ?s, `order` = ?n"
					
					,	$this->listing_sid, "database", $picture_content, $thumb_content, $image_caption, $order);
							
			} else {
				
				$upload_file_directory = SJB_System::getSystemSettings('UPLOAD_FILES_DIRECTORY');
				
				$picture_sid = SJB_DB::query("INSERT INTO listings_pictures"
				
					. " SET `listing_sid` = ?n, `storage_method` = ?s, `caption` = ?s, `order` = ?n"
					
					,	$this->listing_sid, "file_system", $image_caption, $order);
				
				$picture_file_basename = 'picture_'.$picture_sid.'.jpg';
				
				$thumb_file_basename = 'thumb_'.$picture_sid.'.jpg';
				
				$picture_name = $upload_file_directory . "/pictures/" . $picture_file_basename;
				
				$thumb_name = $upload_file_directory . "/pictures/" . $thumb_file_basename;
				
				imagejpeg($picture_resource, $picture_name);
				
				imagejpeg($thumb_resource, $thumb_name);
				
				SJB_DB::query("UPDATE listings_pictures SET `picture_saved_name` = ?s, `thumb_saved_name` = ?s WHERE sid = ?n",
							
							$picture_file_basename, $thumb_file_basename, $picture_sid);
			}
			
			$this->setListingPictureAmount($this->getPicturesAmount());
		
		} else {
			
			$this->error = 'NOT_SUPPORTED_IMAGE_FORMAT';
		
			return false;
			
		}
		
	}
	
	
	function getImageResourceContent($image_resource) {
		
		ob_start();
				
		imagejpeg($image_resource);
		
		$image_content = ob_get_contents();
		
		ob_end_clean();
		
		return $image_content;
		
	}
	
	function getResizedImageResource($image_resource, $image_max_size) {
		
		$image_width = imagesx($image_resource);	$image_height = imagesy($image_resource);
			
		if (($image_width > $image_max_size['width']) || ($image_height > $image_max_size['height'])) {
				
			$k_w = $image_width / $image_max_size['width'];
			
			$k_h = $image_height / $image_max_size['height'];
			
			$k = max($k_w, $k_h);
			
			$picture_width = round($image_width / $k);
			
			$picture_height = round($image_height / $k);
		
		} else {
			
			$picture_width = $image_width;
			
			$picture_height = $image_height;
			
		}
		
		$resized_image_resource = imagecreatetruecolor($picture_width, $picture_height);
		
		imagecopyresampled($resized_image_resource, $image_resource, 0, 0, 0, 0, $picture_width, $picture_height, $image_width, $image_height);
		
		return $resized_image_resource;
		
	}
	
	function getError() {
		
		return $this->error;
		
	}
	
	
}

