<?php

require_once('orm/types/UploadFileType.php');

class SJB_UploadVideoFileType extends SJB_UploadFileType
{
	private $fieldID;
	
	function SJB_UploadVideoFileType($property_info)
	{
		parent::SJB_UploadFileType($property_info);
		$this->default_template = 'video.tpl';
	}

	function isValid()
	{

		$this->fieldID = $this->property_info['id'];

		if (!isset($_FILES[$this->fieldID]['name']) || $_FILES[$this->fieldID]['name'] == '')
			return true;

		$file_id = $this->fieldID . "_tmp";
		SJB_DB::query('DELETE FROM uploaded_files WHERE id=?s', $file_id);
		
		$this->property_info['value'] = $file_id;
		$upload_manager = new SJB_UploadFileManager();
		$upload_manager->setFileGroup("video");
		$upload_manager->setUploadedFileID($file_id);
		
		// CHECK FILE BEFORE UPLOAD
		if (!empty($this->property_info['max_file_size'])) {
			$upload_manager->setMaxFileSize($this->property_info['max_file_size']);
		}
		if (!$upload_manager->isValidUploadedVideoFile($this->fieldID)) {
			return $upload_manager->getError();
		}
		
		
		$saved_file_name = $upload_manager->uploadFile($this->fieldID);
		
		if ($saved_file_name === false) {
			return $upload_manager->getError();
		}
		
		global $PATH_BASE;
		
		$filename = $PATH_BASE.'/files/video/'.$saved_file_name;
		$base_name = substr($saved_file_name,0, strrpos($saved_file_name, "."));
		
		$ext = substr($saved_file_name,1 + strrpos($saved_file_name, "."));
		
		if ($ext == 'flv') {
			$t_outfile = $PATH_BASE.'/files/video/'.$base_name.'.flv_';
			$outfile = $PATH_BASE.'/files/video/'.$base_name.'.flv';
			$result = $this->convert_media($filename, $t_outfile, 320, 240, 32, 22050);
		
			if(!$upload_manager->fileExists($base_name.'.flv_',true)) {
				$upload_manager->deleteUploadedFileByID($file_id);
				return $upload_manager->getError();
			}
						
			$upload_manager->deleteUploadedFileByID($file_id);
			rename($t_outfile,$outfile);
		}
		else 
		{
			$outfile = $PATH_BASE.'/files/video/'.$base_name.'.flv';
			$result = $this->convert_media($filename, $outfile, 320, 240, 32, 22050);
		
			if(!$upload_manager->fileExists($base_name.'.flv',true)) {
				$upload_manager->deleteUploadedFileByID($file_id);
				return $upload_manager->getError();
			}
		
			$upload_manager->deleteUploadedFileByID($file_id);
		}
		
		$filename = $PATH_BASE.'/files/video/'.$base_name.'.flv';
		$img = $PATH_BASE.'/files/video/'.$base_name.'.png';
		$this->grab_image($filename,$img,'',"00:00:03",'png',320,240);
		
		$upload_manager->registNewFile($file_id,$base_name.'.flv');
			
		return true;
	}
	
	function getSQLValue()
	{
		
		$file_id = $this->property_info['id'] . "_" .$this->object_sid;
		$this->property_info['value'] = $file_id;
		SJB_DB::query("UPDATE uploaded_files SET id = ?s WHERE  id = ?s LIMIT 1", $file_id, $this->property_info['id'] . "_tmp");
		if (SJB_UploadFileManager::doesFileExistByID($file_id))
			return "'{$file_id}'";
		return "''";
	}
	
	function convert_media($filename, $outfile, $width, $height, $bitrate, $samplingrate)
	{
		$size = $width . "x" . $height;
		$cmd = "ffmpeg -i \"{$filename}\" -ar {$samplingrate} -ab {$bitrate} -f flv -s {$size} \"{$outfile}\" 2>&1";
		
		$ret = array();
		exec($cmd, $ret);
		
		if(isset($_GET['debug']) && $_GET['debug'] == 1) {
			global $DEBUG;
			$DEBUG[] = array('media'=>print_r($cmd,1));
			$DEBUG[] = array('result'=>print_r($ret,1));
		}
		
		return $ret;
	}

	function grab_image($filename, $outfile, $no_of_thumbs, $frame_number = "00:00:03", $image_format, $width, $height)
	{
		$size = $width . "x" . $height;
		$cmd = "ffmpeg -i \"{$filename}\" -vframes 1 -ss {$frame_number} -an -vcodec {$image_format} -f rawvideo -s {$size} \"$outfile\"  2>&1 ";
		exec($cmd, $ret);
		
		if (isset($_GET['debug']) && $_GET['debug'] == 1) {
			global $DEBUG;
			$DEBUG[] = array('media' => print_r($cmd,1));
			$DEBUG[] = array('result' => print_r($ret,1));
		}
		return $ret;
	}
	
	function getFieldExtraDetails()
	{
		return array( array(	'id'		=> 'max_file_size',
								'caption'	=> 'Maximum File Size', 
								'comment'   => 'Server configuration upload max filesize '.ini_get('upload_max_filesize'),
								'type'		=> 'float',
								'length'	=> '20',
								'minimum'	=> '0',
								'signs_num' => '2'));
	}
}

