<?php

require_once "Archive/Tar.php";

class SJB_ExportController
{
	function createListing($listing_type_id)
	{
		$listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id);
		$listing = new SJB_Listing(array(), $listing_type_sid);
		$listing->addUsernameProperty();
		$listing->addListingTypeIDProperty();	
		$listing->addActivationDateProperty();
		$listing->addExpirationDateProperty();
		return $listing;
	}

	function getSearchPropertyAliases()
	{
		$property_aliases = new SJB_PropertyAliases();
		
		$property_aliases->addAlias(array
		(
			'id' 				 => 'listing_type',
			'real_id' 			 => 'listing_type_sid',
			'transform_function' => 'SJB_ListingTypeManager::getListingTypeSIDByID',
		));
		$property_aliases->addAlias(array
		(
			'id' 				 => 'username',
			'real_id' 			 => 'user_sid',
			'transform_function' => 'SJB_ExportController::getUserSIDByUsername',
		));
		
		return $property_aliases;
	}

	function getUserSIDByUsername($raw_value)
	{
		$sid = SJB_UserManager::getUserSIDByUsername($raw_value);
		if (empty($sid) && !empty($raw_value))
		    $sid = -1;
		return $sid;
	}
	
	function getExportPropertyAliases()
	{
		$property_aliases = new SJB_PropertyAliases();
		$property_aliases->addAlias(array
		(
			'id' 				 => 'listing_type',
			'real_id' 			 => 'listing_type_sid',
			'transform_function' => 'SJB_ListingTypeManager::getListingTypeIDBySID',
		));
		$property_aliases->addAlias(array
		(
			'id' 				 => 'username',
			'real_id' 			 => 'user_sid',
			'transform_function' => 'SJB_UserManager::getUserNameByUserSID',
		));
		return $property_aliases;
	}

	function getExportData($listings_sid, &$export_properties, &$aliases)
	{
		$export_data = array();
		foreach ($listings_sid as $listing_sid)	{
			$listing_info = SJB_ListingManager::getListingInfoBySID($listing_sid); 
			$listing_info = $aliases->changePropertiesInfo($listing_info);
			
			foreach ($export_properties as $property_id => $value) {
				$export_data[$listing_sid][$property_id] = isset($listing_info[$property_id]) ? $listing_info[$property_id] : null;
				$export_properties[$property_id] = $property_id;
			}		
		}
		
		return $export_data;
	}

	function makeExportFile(&$export_properties, &$export_data, $export_file_name)
	{
		$export_files_dir = SJB_System::getSystemSettings("EXPORT_FILES_DIRECTORY");
		
		$xls    =& new Spreadsheet_Excel_Writer($export_files_dir.'/'.$export_file_name);    
		$sheet  =& $xls->addWorksheet('Listings'); 	
		$head_format =& $xls->addFormat();
		
		$xls->setCustomColor(10, 120, 170, 220);
		$head_format->setAlign('center');	
		$head_format->setFgColor(10);	
		$head_format->setBold();		
		$head_format->setBorder(1);			
		
		$sheet->freezePanes(array(1,0,1,0));
		
		$index = 1;
		
		$sheet->writeRow(0,0,$export_properties,$head_format);

		foreach ($export_data as $property_info)
		{
			$sheet->writeRow($index,0,$property_info);
			$index++;
		}
		
		$xls->close();
	}

	function changeTreeProperties(&$export_properties, &$export_data)
	{
		$tree_fields_info = SJB_ListingFieldManager::getFieldsInfoByType('tree'); 
		
		foreach ($tree_fields_info as $field_info) {
			$field_info = SJB_ListingFieldManager::getFieldInfoBySID($field_info['sid']);			
				
			if (isset($export_properties[$field_info['id']])) {
				foreach ($export_data as $listing_sid => $property) {			
					$tree_values = explode(',', $export_data[$listing_sid][$field_info['id']]); 
					$tree_display_value = array();
					foreach ($tree_values as $value) {
						$display_value = SJB_ListingFieldTreeManager::getTreeDisplayValueBySID($value);
						$tree_display_value = array_unique(array_merge($tree_display_value, $display_value));
					}
					$export_data[$listing_sid][$field_info['id']] = implode(',', $tree_display_value);
				}
			}
		}
	}
	function changeMonetaryProperties(&$export_properties, &$export_data)
	{
		$fieldsInfo = SJB_ListingFieldManager::getFieldsInfoByType('monetary');	
		
		foreach ($fieldsInfo as $fieldInfo) {
			if (isset($export_properties[$fieldInfo['id']])) {
				foreach ($export_data as $listing_sid => $property) {	
					$export_data[$listing_sid][$fieldInfo['id']] = isset($property[$fieldInfo['id']]['value'])?$property[$fieldInfo['id']]['value']:'';
				}
			}
		}
	}
	
	function changePicturesProperties(&$export_properties, &$export_data)
	{
		if (isset($export_properties['pictures']))
		{
			// listings walkthrough
			foreach ($export_data as $listing_sid => $property)
			{			
				$pictures = &$export_data[$listing_sid]['pictures'];
				$pictures = null;
				
				$gallery = new SJB_ListingGallery();
				$gallery->setListingSID($listing_sid);
				
				$pictures_info = $gallery->getPicturesInfo();
				
				foreach ($pictures_info as $picture_info)
				{		
					$picture_export_url = SJB_ExportController::_getPictureExportURL($picture_info);									
					
					if ($picture_info['storage_method'] == 'database')
					{
						$image_resourse = imagecreatefromstring($picture_info['picture']);
						imagejpeg($image_resourse, $picture_export_url);									
					}
					elseif ($picture_info['storage_method'] == 'file-system')
					{
						$uploaded_picture_url = SJB_ExportController::_getUploadedPictureURL($picture_info);	
						if (!@copy($uploaded_picture_url,$picture_export_url)) continue;
					}
					
					$export_files_dir = SJB_System::getSystemSettings("EXPORT_FILES_DIRECTORY");
					
					$picture_export_url = str_replace($export_files_dir,'',$picture_export_url);
					$pictures .= ltrim($picture_export_url, '/').";";
				}
			}				
		}			
	}
	
	function changeFileProperties(&$export_properties, &$export_data, $file_type)
	{
		$file_properties_info = SJB_ListingFieldManager::getFieldsInfoByType($file_type);		
		
		foreach ($file_properties_info as $property_info)
		{			
			if (isset($export_properties[$property_info['id']]))
			{
				// listings walkthrough
				foreach ($export_data as $listing_sid => $property)
				{						
					$file_value = $export_data[$listing_sid][$property_info['id']];
					
					$file = &$export_data[$listing_sid][$property_info['id']];
					$file = null;				
											
					if(!empty($file_value))
					{									
						$file_name 		  = SJB_UploadFileManager::getUploadedFileName($file_value);	
						$file_group 	  = SJB_UploadFileManager::getUploadedFileGroup($file_value);						
						$file_path 		  = SJB_ExportController::_getUploadedFileURL($file_name,$file_group);						
						$file_export_path = SJB_ExportController::_getFileExportURL($file_name,$file_group,$listing_sid);
												
						@copy($file_path,$file_export_path);
						
						$export_files_dir = SJB_System::getSystemSettings("EXPORT_FILES_DIRECTORY");		
									
						$file_export_path = str_replace($export_files_dir,'',$file_export_path);
						$file = ltrim($file_export_path, '/');
					}
				}				
			}
		}		
	}
	
	function _getUserSiteURL()
	{
		if ( $user_config_file_path = SJB_System::getSystemSettings('USER_CONFIG_FILE') ) 
			return SJB_System::getSettingsFromFile($user_config_file_path, 'SITE_URL');
		return SJB_System::getSystemSettings('SITE_URL');
	}
	
	function _getPictureExportURL($picture_info)
	{		
		$export_files_dir = SJB_System::getSystemSettings("EXPORT_FILES_DIRECTORY");							
		return "{$export_files_dir}/pictures/{$picture_info['listing_sid']}_{$picture_info['order']}.jpeg";					
	}
	
	function _getUploadedPictureURL($picture_info)
	{				
		$uploaded_files_dir = SJB_System::getSystemSettings("UPLOAD_FILES_DIRECTORY");
		return "{$uploaded_files_dir}/pictures/{$picture_info['picture_saved_name']}";
	}
	
	function _getFileExportURL($file_name,$file_group,$listing_sid)
	{		
		$export_files_dir = SJB_System::getSystemSettings("EXPORT_FILES_DIRECTORY");	
		$file_name_parsed = explode(".",$file_name);						
		$file_extension   = end($file_name_parsed);						
		$file_export_name = $listing_sid.".".$file_extension; 
		return "{$export_files_dir}/{$file_group}/{$file_export_name}";					
	}
	
	function _getUploadedFileURL($file_name,$file_group)
	{				
		$uploaded_files_dir = SJB_System::getSystemSettings("UPLOAD_FILES_DIRECTORY");
		return "{$uploaded_files_dir}/{$file_group}/{$file_name}";
	}
	
	function createExportDirectories()
	{		
		$export_files_dir = SJB_System::getSystemSettings("EXPORT_FILES_DIRECTORY");
		if (empty($export_files_dir)) return;
		if (!is_dir($export_files_dir)) 			mkdir($export_files_dir, 0777);
		if (!is_dir($export_files_dir.'/pictures')) mkdir($export_files_dir.'/pictures', 0777);
		if (!is_dir($export_files_dir.'/files')) 	mkdir($export_files_dir.'/files', 0777);
		if (!is_dir($export_files_dir.'/video')) 	mkdir($export_files_dir.'/video', 0777);
	}
	
	function createExportDirectoriesForExample()
	{		
		$export_files_dir = SJB_System::getSystemSettings("EXPORT_FILES_DIRECTORY");
		if (empty($export_files_dir)) return;
		if (!is_dir($export_files_dir)) 			mkdir($export_files_dir, 0777);
	}
	
	function archiveAndSendExportFile()
	{
		$export_files_dir = SJB_System::getSystemSettings("EXPORT_FILES_DIRECTORY");
		
		if (empty($export_files_dir)) return;
		
		$export_files_dir_name = preg_replace('/[.\/]/u', '', $export_files_dir);
				
		$script_path 	= array_shift(explode(SJB_System::getSystemSettings("SYSTEM_URL_BASE"),__FILE__));		
		$dir_separator 	= DIRECTORY_SEPARATOR;
		
		$directory_to_archive = $export_files_dir;
		$archive_file_path 	  = SJB_Path::combine($directory_to_archive,"export.tar.gz");		
		
		$old_path = getcwd();						
		chdir($directory_to_archive);
		
		$tar = new Archive_Tar('export.tar.gz', 'gz');
		$tar->create("files video pictures export.xls");
		
		chdir($old_path);
				
		header("Content-type: application/octet-stream");  
		header("Content-disposition: attachment; filename=export.tar.gz");  
		header("Content-Length: " . filesize($archive_file_path));
		
		$fp = fopen($archive_file_path,"rb");
		fpassthru($fp);	
		fclose($fp);
		
		SJB_Filesystem::delete($directory_to_archive);		
	}
		
}
