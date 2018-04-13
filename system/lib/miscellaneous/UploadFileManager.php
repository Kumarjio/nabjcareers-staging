<?php

class SJB_UploadFileManager
{
	var $file_group;
	var $max_file_size;
	var $uploaded_file_id;
	var $error;
	
	function setFileGroup($file_group)
	{
		$this->file_group = $file_group;
	}
	
	function setMaxFileSize($max_file_size)
	{
		$this->max_file_size = $max_file_size;
	}
	
	function isValidUploadedFile($fileId, $subField = false)
	{
		if (!empty($this->max_file_size) && floatval($this->max_file_size) > 0) {
			if (!$subField && $_FILES[$fileId]['size'] > ($this->max_file_size * 1024 * 1024)) {
				$this->error = 'MAX_FILE_SIZE_EXCEEDED';
				return false;
			}
			else if ($subField) {
				foreach ($_FILES[$fileId]['size'][$subField] as $size) {
					if ($size > ($this->max_file_size * 1024 * 1024)) {
						$this->error = 'MAX_FILE_SIZE_EXCEEDED';
						return false;
					}
				}
			}
		}
		return true;
	}
	
	function isValidUploadedVideoFile($file_id)
	{
		if ($this->isValidUploadedFile($file_id)) {
			$fileInfo = pathinfo($_FILES[$file_id]['name']);
			if (in_array($fileInfo['extension'], array('avi','xvid','asf','dv','mkv','flv','gif','mov','mp4','m4a','3gp','3gpp','3g2','mpeg','mpg','wav','wmv','rm')))
				return true;
			else
				$this->error = 'NOT_SUPPORTED_VIDEO_FORMAT';
		}
		return false;
	}
	
	function setUploadedFileID($uploaded_file_id)
	{
		$this->uploaded_file_id = $uploaded_file_id;
	}

	function isFileReadyForUpload($file_id)
	{
		return !empty($_FILES[$file_id]['name']);
	}

	function uploadFile($file_id)
	{
		if (is_null($this->uploaded_file_id)) {
			return false;
		}
		elseif (!empty($_FILES[$file_id]['name'])) {
			
			if ($_FILES[$file_id]['error']) {
				switch ($_FILES[$file_id]['error']) {
					case '1':
						$this->error = 'UPLOAD_ERR_INI_SIZE';
						break;
					case '2':
						$this->error = 'UPLOAD_ERR_FORM_SIZE';
						break;
					case '3':
						$this->error = 'UPLOAD_ERR_PARTIAL';
						break;
					case '4':
						$this->error = 'UPLOAD_ERR_NO_FILE';
						break;
					default:
						break;
				}
				return false;
			}
			
			$file_basename = $_FILES[$file_id]['name'];
			
			$ext = substr($file_basename,1 + strrpos($file_basename, "."));
 			$file_valid_types = explode(',',SJB_System::getSettingByName('file_valid_types'));
			if( !in_array(strtolower($ext), $file_valid_types))
				return false;
			
			$upload_file_directory = SJB_System::getSystemSettings("UPLOAD_FILES_DIRECTORY");
			$file_extension = strrchr($file_basename, ".");
			if (!empty($file_extension))
				$file_name_without_ext = substr($file_basename, 0, -strlen($file_extension));
			else
				$file_name_without_ext = $file_basename;
			
			$saved_file_name = str_replace(' ','_',$file_basename);
			$saved_file_name = str_replace("\\",'_',(str_replace('/','_', str_replace('"','',str_replace("'",'',$saved_file_name)))));
			$file_name = $upload_file_directory . "/" . $this->file_group . "/" . $saved_file_name;
			$i = 0;
			$tmp_avi = str_replace($file_extension,'.flv',$file_name);
			
			while (file_exists($tmp_avi) || file_exists($file_name)) {
				$saved_file_name = $file_name_without_ext . "_" . ++$i . $file_extension;
				$saved_file_name = str_replace(' ','_',$saved_file_name);
				$saved_file_name = str_replace("\\",'_',(str_replace('/','_', str_replace('"','',str_replace("'",'',$saved_file_name)))));
				$file_name = $upload_file_directory . "/" . $this->file_group . "/" . $saved_file_name;
				$tmp_avi = str_replace($file_extension,'.flv',$file_name);
			}

			if (move_uploaded_file($_FILES[$file_id]['tmp_name'], $file_name)) {
				SJB_UploadFileManager::deleteUploadedFileByID($this->uploaded_file_id);
				SJB_DB::query("INSERT INTO uploaded_files(id, file_name, file_group, saved_file_name, mime_type)"
							." VALUES(?s, ?s, ?s, ?s, ?s)", $this->uploaded_file_id, $_FILES[$file_id]['name'], $this->file_group, $saved_file_name, $_FILES[$file_id]['type']);
				return $saved_file_name;
			}
		}
	}

	function uploadFiles($file_id, $subField)
	{
		if (is_null($this->uploaded_file_id)) {
			return false;
		}
		else {

			if (!empty($_FILES[$file_id]['name'])) {

				$results = array();
				foreach ($_FILES[$file_id]['name'][$subField] as $key => $subFile) {

					if ($_FILES[$file_id]['error'][$subField][$key]) {
						switch ($_FILES[$file_id]['error'][$subField][$key]) {
							case '1':
								$this->error = 'UPLOAD_ERR_INI_SIZE';
								break;
							case '2':
								$this->error = 'UPLOAD_ERR_FORM_SIZE';
								break;
							case '3':
								$this->error = 'UPLOAD_ERR_PARTIAL';
								break;
							case '4':
								$this->error = 'UPLOAD_ERR_NO_FILE';
								break;
							default:
								break;
						}
						$results[$key] = '';
						continue;
					}

					$file_basename = $subFile;

					$ext = substr($file_basename,1 + strrpos($file_basename, "."));
					$file_valid_types = explode(',',SJB_System::getSettingByName('file_valid_types'));
					if( !in_array(strtolower($ext), $file_valid_types))
						return false;

					$upload_file_directory = SJB_System::getSystemSettings("UPLOAD_FILES_DIRECTORY");
					$file_extension = strrchr($file_basename, ".");
					if (!empty($file_extension))
						$file_name_without_ext = substr($file_basename, 0, -strlen($file_extension));
					else
						$file_name_without_ext = $file_basename;

					$saved_file_name = str_replace(' ','_',$file_basename);
					$saved_file_name = str_replace("\\",'_',(str_replace('/','_', str_replace('"','',str_replace("'",'',$saved_file_name)))));
					$file_name = $upload_file_directory . "/" . $this->file_group . "/" . $saved_file_name;
					$i = 0;
					$tmp_avi = str_replace($file_extension,'.flv',$file_name);

					while (file_exists($tmp_avi) || file_exists($file_name)) {
						$saved_file_name = $file_name_without_ext . "_" . ++$i . $file_extension;
						$saved_file_name = str_replace(' ','_',$saved_file_name);
						$saved_file_name = str_replace("\\",'_',(str_replace('/','_', str_replace('"','',str_replace("'",'',$saved_file_name)))));
						$file_name = $upload_file_directory . "/" . $this->file_group . "/" . $saved_file_name;
						$tmp_avi = str_replace($file_extension,'.flv',$file_name);
					}

					if (move_uploaded_file($_FILES[$file_id]['tmp_name'][$subField][$key], $file_name)) {
						SJB_UploadFileManager::deleteUploadedFileByID($this->uploaded_file_id . '_' . $key);
						SJB_DB::query("INSERT INTO uploaded_files(id, file_name, file_group, saved_file_name, mime_type)"
									." VALUES(?s, ?s, ?s, ?s, ?s)", $this->uploaded_file_id . '_' . $key, $subFile, $this->file_group, $saved_file_name, $_FILES[$file_id]['type'][$subField][$key]);
						$results[$key] = $this->uploaded_file_id . '_' . $key;
					}
				}
			}
			return $results;
		}

	}
	
	function fileExists($file_name, $out_error = false)
	{
		$upload_file_directory = SJB_System::getSystemSettings("UPLOAD_FILES_DIRECTORY");
		$file_name = $upload_file_directory . "/" . $this->file_group . "/" . $file_name;
		
		if (file_exists($file_name) && filesize($file_name)) {
			return true;
		}
    	else if ($out_error) {
				$this->error = 'NOT_CONVERT_VIDEO';
    	}
			
		return false;
	}
	
	function registNewFile($file_id,$name)
	{
		SJB_DB::query("	INSERT INTO uploaded_files(id, file_name, file_group, saved_file_name)
					VALUES(?s, ?s, ?s, ?s)", $file_id, $name, $this->file_group, $name);
	}
	
	function deleteUploadedFileByID($file_id, $type = false)
	{
		$file_info = SJB_DB::query("SELECT * FROM uploaded_files WHERE id = ?s", $file_id);
		if (!empty($file_info)) {
			$file_info = array_pop($file_info);
			if ($file_info['storage_method'] == 'file_system')	{
				$upload_file_directory = SJB_System::getSystemSettings("UPLOAD_FILES_DIRECTORY");
				$file_name = SJB_Path::combine($upload_file_directory, $file_info['file_group'], $file_info['saved_file_name']);
			
				if (SJB_WrappedFunctions::file_exists($file_name))
					SJB_WrappedFunctions::unlink($file_name);
				
				$ext = substr($file_name,1 + strrpos($file_name, "."));
				if ($ext == 'flv') {
					$base_name = substr($file_name,0, strrpos($file_name, "."));
					$file_name_img = $base_name.'.png';
					if (SJB_WrappedFunctions::file_exists($file_name_img))
						SJB_WrappedFunctions::unlink($file_name_img);
				}
			}
			SJB_DB::query("DELETE FROM uploaded_files WHERE id = ?s", $file_id);
		}
		if ($type = 'logo') {
			$file_id = $file_id."_thumb";
			$file_info = SJB_DB::query("SELECT * FROM uploaded_files WHERE id = ?s", $file_id);
			if (!empty($file_info)) {
				$file_info = array_pop($file_info);
				if ($file_info['storage_method'] == 'file_system')	{
					$upload_file_directory = SJB_System::getSystemSettings("UPLOAD_FILES_DIRECTORY");
					$file_name = SJB_Path::combine($upload_file_directory, $file_info['file_group'], $file_info['saved_file_name']);
				
					if (SJB_WrappedFunctions::file_exists($file_name))
						SJB_WrappedFunctions::unlink($file_name);
				}
				SJB_DB::query("DELETE FROM uploaded_files WHERE id = ?s", $file_id);
			}
		}
	}
	
	function getError()
	{
		return $this->error;
	}
	
	function getUploadedFileLink($uploaded_file_id, $noHost = false)
	{
		if (!is_string($uploaded_file_id) || empty($uploaded_file_id)) {
			return null;
		}
		
		$file_info = SJB_DB::query("SELECT * FROM uploaded_files WHERE id = ?s", $uploaded_file_id);
		
		if (!empty($file_info))
		{
			$file_info = array_pop($file_info);
			$upload_files_directory = SJB_System::getSystemSettings('UPLOAD_FILES_DIRECTORY');
			$file_group = $file_info['file_group'];
			$saved_file_name = $file_info['saved_file_name'];
			$file_name = $upload_files_directory . "/" . $file_group . "/" . $saved_file_name;
			$site_url = SJB_System::getSystemSettings("SITE_URL");
			if ($noHost) 
				$link = $file_name;
			else
				$link = $site_url . "/" . $file_name;
			if (!file_exists($file_name)) 
				$link = null;
			return $link;
		}
		return null;
	}
	
	function getUploadedFileInfo($uploaded_file_id)
	{
		if (!is_string($uploaded_file_id) || empty($uploaded_file_id)) {
			return null;
		}
		$file_info = SJB_DB::query("SELECT * FROM uploaded_files WHERE id = ?s", $uploaded_file_id);
		if (!empty($file_info))
			return array_pop($file_info);			
		return null;
	}
	
	function getUploadedFileName($uploaded_file_id)
	{
		$file_info = SJB_UploadFileManager::getUploadedFileInfo($uploaded_file_id);
		if (!empty($file_info))
			return $file_info['file_name'];
		return null;
	}
	
	function getUploadedSavedFileName($uploaded_file_id)
	{
		$file_info = SJB_UploadFileManager::getUploadedFileInfo($uploaded_file_id);
		if (!empty($file_info))
			return $file_info['saved_file_name'];
		return null;
	}
	
	function getUploadedFileGroup($uploaded_file_id)
	{
		$file_info = SJB_UploadFileManager::getUploadedFileInfo($uploaded_file_id);
		if (!empty($file_info))
			return $file_info['file_group'];
		return null;
	}
	
	function doesFileExistByID($uploaded_file_id)
	{
		if ( empty($uploaded_file_id)) {
			return false;
		}
		$file_info = SJB_DB::query("SELECT * FROM uploaded_files WHERE id = ?s", $uploaded_file_id);
		return !empty($file_info);
	}
	
	function getMimeTypeByFilename($filename, $listingID)
	{
		$mime_type = SJB_DB::query("SELECT up.`mime_type`, up.`sid`, up.`id` FROM `uploaded_files` up
								INNER JOIN `listings_properties` lp ON up.`id`=lp.`value` WHERE lp.`object_sid`= ?s AND up.`saved_file_name` = ?s", $listingID, $filename);
		if (empty($mime_type) && !empty($listingID)) {
			$listing = SJB_ListingManager::getObjectBySID($listingID);
			foreach ($listing->getProperties() as $property) {
				if ($property->isComplex()) {
					foreach ($property->type->complex->getProperties() as $complexProperty) {
						if ($complexProperty->getType() == 'file') {
							$fileIds = $complexProperty->type->property_info['value'];
							if (is_array($fileIds)) {
								foreach (array_keys($fileIds) as $key) {
									if (empty($fileIds[$key]['saved_file_name']))
										unset($fileIds[$key]);
								}
								$mime_type = SJB_DB::query('SELECT up.`mime_type`, up.`sid`, up.`id` FROM `uploaded_files` up
									WHERE up.`id` IN (?l) AND up.`saved_file_name` = ?s', $fileIds, $filename);
							}
						}
					}
				}
			}
		}
		return $mime_type ? array_pop($mime_type) : false;
	}
	
	function getMimeTypeAppsByFilename($filename, $appsID) {
		$mime_type = SJB_DB::query("SELECT up.`mime_type`, up.`sid`, up.`id` FROM `uploaded_files` up
								INNER JOIN `applications` apps ON up.`id`=apps.`file_id` WHERE apps.`id`= ?s AND up.`saved_file_name` = ?s", $appsID, $filename);
		return $mime_type ? array_pop($mime_type) : false;
	}
	
	function openFile($filename, $listing_id)
	{
	    $file_info = SJB_UploadFileManager::getMimeTypeByFilename($filename, $listing_id);
		 if ($file_info) {
		 	  $file_link = SJB_UploadFileManager::getUploadedFileLink($file_info['id'], true);
		 	  header("Content-Length:".filesize("{$file_link}"));
              header('Content-Disposition: attachment; filename="'.$filename.'"');
              header("Content-type: ".$file_info['mime_type']);
      		  $file = fread(fopen("$file_link", "rb"), filesize("$file_link"));
      		  echo $file; exit(); 
		 }
		 return false;
	}
	
	function openApplicationFile($filename, $appsID)
	{
		$file_info = SJB_UploadFileManager::getMimeTypeAppsByFilename($filename, $appsID);
		 if($file_info) {
		 	  $file_link = SJB_UploadFileManager::getUploadedFileLink($file_info['id'], true);
		 	  header("Content-Length:".filesize("{$file_link}"));
              header('Content-Disposition: attachment; filename="'.$filename.'"');
              header("Content-type: ".$file_info['mime_type']);
      		  $file = fread(fopen("$file_link", "rb"), filesize("$file_link"));
      		  echo $file; exit(); 
		 }
		 return false;
	}
}
