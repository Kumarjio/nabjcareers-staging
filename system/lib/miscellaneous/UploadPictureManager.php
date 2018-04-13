<?php

require_once("UploadFileManager.php");

class SJB_UploadPictureManager extends SJB_UploadFileManager
{
	var $height;
	var $width;
	var $storage_method;
	
	function setWidth($width)
	{
		$this->width = $width;
	}
	
	function setHeight($height)
	{
		$this->height = $height;
	}
	
	function setStorageMethod($storage_method)
	{
		$this->storage_method = $storage_method;
	}
	
	function isValidUploadedPictureFile($file_id)
	{
		if (empty($_FILES[$file_id]['tmp_name']) && empty($_FILES[$file_id]['name'])) {
		    return true;
		}
		else if (empty($_FILES[$file_id]['tmp_name']) && (!empty($_FILES[$file_id]['name']))) {
			$this->error[] = "Please chek image size. Maximum allowed file size is ". ini_get('upload_max_filesize');
		    return false;
		}
		
		$image_info = getimagesize($_FILES[$file_id]['tmp_name']);		// $image_info['2'] = 1 {GIF}, 2 {JPG}, 3 {PNG}, 4 {SWF}, 5 {PSD}, 6 {BMP}, 7 {TIFF}, 8 {TIFF}, 9 {JPC}, 10 {JP2}, 11 {JPX}		
		$image_size = $_FILES[$file_id]['size'];
		$max_filesize = preg_replace('/[a-zA-Z\s]*/', '', ini_get('upload_max_filesize'));
		
		if ($image_size > ($max_filesize * 1024 * 1024)) {
			$this->error = "Image size is greater than it is allowed. upload_max_filesize = $max_filesize";
			return false;
		}
		else if ( $image_info['2'] >= 1 && $image_info['2'] <= 3 ) {
			return true;
		}
		
		$this->error[] = 'NOT_SUPPORTED_IMAGE_FORMAT';
		return false;
	}
	
	function uploadPicture($file_id, $property_info = false)
	{
		if (is_null($this->uploaded_file_id)) {
			return false;
		} elseif (!empty($_FILES[$file_id]['name'])) {
			$this->file_group = "pictures";
			$image_file_name = $_FILES[$file_id]['tmp_name'];
			$image_info = getimagesize($image_file_name);		// $image_info['2'] = 1 {GIF}, 2 {JPG}, 3 {PNG}, 4 {SWF}, 5 {PSD}, 6 {BMP}, 7 {TIFF}, 8 {TIFF}, 9 {JPC}, 10 {JP2}, 11 {JPX}
			if ($image_info['2'] == 1) {
				$image_resource = imagecreatefromgif($image_file_name);
				$iii = imagecolorallocate($image_resource, 255, 255, 255);
				imagecolortransparent($image_resource, $iii);
			} elseif ($image_info['2'] == 2) {
				$image_resource = imagecreatefromjpeg($image_file_name);
			} else {
				$image_resource = imagecreatefrompng($image_file_name);
			}
			
			$picture_max_size['width']  = $this->width;
			$picture_max_size['height'] = $this->height;
			$picture_resource = $this->getResizedImageResource($image_resource, $picture_max_size);
			$second_picture_resource = false;
			if ($property_info) {
				$picture_max_size['width']  = $property_info['second_width'];
				$picture_max_size['height'] = $property_info['second_height'];
				$second_picture_resource = $this->getResizedImageResource($image_resource, $picture_max_size);
			}
			if ($this->storage_method == 'database') {
				$this->_uploadPictureToDB($file_id, $picture_resource, $second_picture_resource);
			} else {
				$this->_uploadPictureToFileSystem($file_id, $picture_resource, $second_picture_resource);
			}
		}
	}
	
	function _uploadPictureToDB($file_id, $picture_resource, $second_picture_resource = false)
	{
		ob_start();
		imagejpeg($picture_resource);
		$picture_content = ob_get_contents();
		ob_end_clean();
		SJB_UploadPictureManager::deleteUploadedFileByID($this->uploaded_file_id);
		SJB_DB::query("INSERT INTO uploaded_files(id, file_name, file_group, file_content, storage_method, mime_type)"
						." VALUES(?s, ?s, ?s, ?b, ?s, ?s)", $this->uploaded_file_id, $_FILES[$file_id]['name'], $this->file_group, $picture_content, $this->storage_method, $_FILES[$file_id]['type']);
		if ($second_picture_resource) {
			ob_start();
			imagejpeg($second_picture_resource);
			$picture_content = ob_get_contents();
			SJB_DB::query("INSERT INTO uploaded_files(id, file_name, file_group, file_content, storage_method, mime_type)"
						." VALUES(?s, ?s, ?s, ?b, ?s, ?s)", $this->uploaded_file_id."_thumb", $_FILES[$file_id]['name'], $this->file_group, $picture_content, $this->storage_method, $_FILES[$file_id]['type']);
		}
	}
	
	function _uploadPictureToFileSystem($file_id, $picture_resource, $second_picture_resource = false)
	{
		$upload_file_directory = SJB_System::getSystemSettings('UPLOAD_FILES_DIRECTORY');
		$file_basename = $_FILES[$file_id]['name']; 
		$file_extension = strrchr($file_basename, ".");
		if (!empty($file_extension)) {
			$file_name_without_ext = substr($file_basename, 0, -strlen($file_extension));
		} else {
			$file_name_without_ext = $file_basename;
		}
		
		$saved_file_name = $file_name_without_ext . ".jpg";
		$file_name = $upload_file_directory . "/" . $this->file_group . "/" . $saved_file_name;
		$i = 0;
		
		while (file_exists($file_name)) {
			$saved_file_name = $file_name_without_ext . "_" . ++$i . ".jpg";
			$file_name = $upload_file_directory . "/" . $this->file_group . "/" . $saved_file_name;
		}

		if (@imagejpeg($picture_resource, $file_name, 100)) {
			SJB_UploadPictureManager::deleteUploadedFileByID($this->uploaded_file_id);
			SJB_DB::query("INSERT INTO uploaded_files(id, file_name, file_group, saved_file_name, mime_type)"
						." VALUES(?s, ?s, ?s, ?s, ?s)", $this->uploaded_file_id, $_FILES[$file_id]['name'], $this->file_group, $saved_file_name, $_FILES[$file_id]['type']);
		}
		if ($second_picture_resource) {
			$file_name = str_replace('.jpg', '', $file_name)."_thumb.jpg";
			if (@imagejpeg($second_picture_resource, $file_name, 100)) {
				$saved_file_name = str_replace('.jpg', '', $saved_file_name)."_thumb.jpg";
				SJB_DB::query("INSERT INTO uploaded_files(id, file_name, file_group, saved_file_name, mime_type)"
							." VALUES(?s, ?s, ?s, ?s, ?s)", $this->uploaded_file_id."_thumb", $_FILES[$file_id]['name'], $this->file_group, $saved_file_name, $_FILES[$file_id]['type']);
			}
		}
	}
	
	function getResizedImageResource($image_resource, $image_max_size)
	{
		$image_width = imagesx($image_resource);
		$image_height = imagesy($image_resource);
			
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
	
	function getUploadedPictureInfo($picture_id)
	{
		if (empty($picture_id)) {
			return null;
		}
		$picture_info = SJB_DB::query("SELECT * FROM uploaded_files WHERE id = ?s", $picture_id);
		return empty($picture_info) ? null : array_pop($picture_info);
	}
	
	function getUploadedFileLink($uploaded_file_id)
	{
		if (!is_string($uploaded_file_id) || empty($uploaded_file_id))
		    return null;
		
		$file_info = SJB_DB::query("SELECT * FROM uploaded_files WHERE id = ?s", $uploaded_file_id);
		
		if (!empty($file_info)) {
			$file_info = array_pop($file_info);
			
			if ($file_info['storage_method'] == 'file_system') {
				$upload_files_directory = SJB_System::getSystemSettings('UPLOAD_FILES_DIRECTORY');
				$file_group = $file_info['file_group'];
				$saved_file_name = $file_info['saved_file_name'];
				$file_name = $upload_files_directory . "/" . $file_group . "/" . $saved_file_name;
			} else {
				$file_name = "system/miscellaneous/uploaded_file/?file_id=$uploaded_file_id";
			}
			$site_url = SJB_System::getSystemSettings("SITE_URL");
			$link = $site_url . "/" . $file_name;
			return $link;
		}
		return null;
	}
	
	function getError()
	{
		return $this->error;
	}
}

