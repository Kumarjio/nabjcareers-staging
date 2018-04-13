<?php

require_once('orm/types/Type.php');
require_once("miscellaneous/UploadFileManager.php");

class SJB_UploadFileType extends SJB_Type
{
	function SJB_UploadFileType($property_info)
	{
		parent::SJB_Type($property_info);
		$this->default_template = 'file.tpl';
	}

	function isEmpty() 
	{
		if ($this->getComplexParent()) {
			return SJB_UploadFileManager::isFileReadyForUpload($this->getComplexParent());
		}
		return parent::isEmpty() && !SJB_UploadFileManager::isFileReadyForUpload($this->property_info['id']);
	}
	
	function getPropertyVariablesToAssign()
	{
		$upload_manager = new SJB_UploadFileManager();
		$upload_manager->setFileGroup("files");

		if (is_array($this->property_info['value'])) {
			$value = array();
			foreach ($this->property_info['value'] as $key => $fileId) {
				$value[$key] = array(
							'file_url' => $upload_manager->getUploadedFileLink($fileId),
							'file_name' => $upload_manager->getUploadedFileName($fileId),
							'saved_file_name' => $upload_manager->getUploadedSavedFileName($fileId),
							'file_id' => $fileId
						);
			}
			return array(
				'id' 	=> $this->property_info['id'],
				'filesInfo' => $value,
				'value' => $value
			);
		}

		return array(
						'id' 	=> $this->property_info['id'],
						'value'	=> array(
							'file_url' => $upload_manager->getUploadedFileLink($this->property_info['value']),
							'file_name' => $upload_manager->getUploadedFileName($this->property_info['value']),
							'saved_file_name' => $upload_manager->getUploadedSavedFileName($this->property_info['value']),
							'file_id' => $this->property_info['value'],
						),
					);
	}

	function getValue()
	{
        $upload_manager = new SJB_UploadFileManager();
		if (is_array($this->property_info['value'])) {
			$value = array();
			foreach ($this->property_info['value'] as $key => $fileId) {
				$value[$key] = array(
							'file_url' => $upload_manager->getUploadedFileLink($fileId),
							'file_name' => $upload_manager->getUploadedFileName($fileId),
							'saved_file_name' => $upload_manager->getUploadedSavedFileName($fileId),
							'file_id' => $fileId,
						);
			}
			return $value;
		}
		return array(
			'file_url' 	=> $upload_manager->getUploadedFileLink($this->property_info['value']),
			'file_name' => $upload_manager->getUploadedFileName($this->property_info['value']),
			'saved_file_name' => $upload_manager->getUploadedSavedFileName($this->property_info['value']),
			'file_id' => $this->property_info['value'],
		);
	}

	function isValid()
	{
		$upload_manager = new SJB_UploadFileManager();
		if (!empty($this->property_info['max_file_size'])) 
			$upload_manager->setMaxFileSize($this->property_info['max_file_size']);

		if ($this->getComplexParent()) {
			$upload_manager->isValidUploadedFile($this->getComplexParent(), $this->property_info['id']);
		} else if ($upload_manager->isValidUploadedFile($this->property_info['id'])) {
			return true;
		}
		
		return $upload_manager->getError();
	}
	
	function getSQLValue()
	{
		$file_id = $this->property_info['id'] . "_" .$this->object_sid;
		$this->property_info['value'] = $file_id;
		$upload_manager = new SJB_UploadFileManager();
		$upload_manager->setFileGroup("files");
		$upload_manager->setUploadedFileID($file_id);
		$upload_manager->uploadFile($this->property_info['id']);
		if (SJB_UploadFileManager::doesFileExistByID($file_id)) {
			return "'".$file_id."'";
		}
		
		return "''";
	}
	
	function getFieldExtraDetails()
	{
		return array(
			array(
				'id'		=> 'max_file_size',
				'caption'	=> 'Maximum File Size', 
				'comment'   => 'Server configuration upload max filesize '.ini_get('upload_max_filesize'),
				'type'		=> 'float',
				'length'	=> '20',
				'minimum'	=> '0',
				'signs_num' => '2',
				),
		);
	}
}
