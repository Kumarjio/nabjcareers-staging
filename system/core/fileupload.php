<?php

class SJB_fileupload {
 var $upload_tmp_dir = "/tmp/";  // leading and trailing slash required
 var $file_upload_flag = "off"; 
 var $upload_max_filesize = "100";
 var $allowable_upload_base_dirs = array("/tmp/", "/web/dynawolf/uploads/");
 var $allowable_upload_tmp_dirs = array( "/tmp/");
 var $upload_dir= "/tmp/";  // leading and trailing slash required
 var $upload_file_name;
 var $imgInfo = array();
 
 function SJB_fileupload($name) {
     if( is_null($_FILES[$name]) )  {
        echo "Specified file <strong> ".$name." </strong> does not exist in the FILES array. Please check if it exists";
        echo "Exiting...";
        exit;
     }
     $this->getConfigurationSettings();
     if( $this->file_upload_flag == "off" ) {
       echo "File upload capability in the configuration file is turned <strong> off </strong> . Please update the php.ini file.";
       exit;
     }
     $this->upload_file_name = $name;
 }
 
 function getConfigurationSettings() {
     $this->file_upload_flag = ini_get('file_uploads');
     $this->upload_tmp_dir = ini_get('upload_tmp_dir');
     $this->upload_max_filesize = ini_get('upload_max_filesize');
     $this->upload_max_filesize = preg_replace('/M/u', '000000', $this->upload_max_filesize);
 }
 
 function getErrors() {
     return $_FILES[$this->upload_file_name]['error'];
 }
 
 function getFileSize() {
     return $_FILES[$this->upload_file_name]['size'];
 }
 
 function getFileName() {
     return $_FILES[$this->upload_file_name]['name'];
 }
 
 function getTmpName() {
     return $_FILES[$this->upload_file_name]['tmp_name'];
 }
 
 function setUploadDir($upload_dir) {
   trim($upload_dir);
   if( $upload_dir[strlen($upload_dir)-1] != "/" ) $upload_dir .= "/"; // add trailing slash
   $can_upload = false;
   foreach( $this->allowable_upload_base_dirs as $dir ) {
      if( $dir == $upload_dir ) {
		$can_upload = true;
        break;
      }
   }
   if( !$can_upload ) {
      echo "Cannot upload to the dir ->".$upload_dir;
      return;
   }else{
      $this->upload_dir = $upload_dir;
      echo $this->upload_dir;
   }
 }
 
 function setTmpUploadDir($upload_tmp_dir) {
   trim($upload_tmp_dir);
   if( $upload_tmp_dir[strlen($upload_tmp_dir)-1] != "/" ) $upload_tmp_dir .= "/"; // add trailing slash
   $can_upload = false;
   foreach( $this->allowable_upload_base_dirs as $dir ) {
      if( $dir == $upload_tmp_dir ) {
		$can_upload = true;
		return;
      }
   }
   if( !$can_upload ) {
      echo "Cannot upload to the dir ->".$uplaod_tmp_dir;
      return;
   }
   $this->upload_tmp_dir = $upload_dir;
 }
 
 function uploadFile() {
   if( $this->checkMaxMemorySizeLimit() ) {
      echo "File size of ".$this->getFileSize()." greater than allowable limit of ".$this->upload_max_filesize."Please change the configuration setting.";
      return;
   }else{
   	echo $this->getTmpName();
     if( !move_uploaded_file($this->getTmpName(), $this->upload_dir.$this->getFileName()) ) {
        echo "Failed to upload file ".$this->getTmpName();
     }
   }
 }
 
 function readFile()
 {
 	//$this->uploadFile();	
 	return base64_encode(file_get_contents($this->getTmpName()));
 }
 
 function checkMaxMemorySizeLimit() {
   if( $this->getFileSize() >  $this->upload_max_filesize ) {
     return true;
   }else{
     return false;
   }
 }
 
	function isSupportedImageType() {
 		
 		$this->imgInfo = getimagesize($this->getTmpName());
 		
 		if ( $this->imgInfo['2'] >= 1 && $this->imgInfo['2'] <= 3 ) {
 			
 			return true;
 			
 		}
 		return false;
 	
	}
	
	function readFileResized($WIDTH_MAX, $HEIGHT_MAX) {
		
		$tmp_name = $this->getTmpName();
		
		if ($this->imgInfo['2'] == 1) {
			
			$imgResource = imagecreatefromgif($tmp_name);
			
		} elseif ($this->imgInfo['2'] == 2) {
			
			$imgResource = imagecreatefromjpeg($tmp_name);
			
		} else {
			
			$imgResource = imagecreatefrompng($tmp_name);
			
		}
		
		$imgW = imagesx($imgResource);
		$imgH = imagesy($imgResource);
		if ( ($imgW > $WIDTH_MAX) || ($imgH > $HEIGHT_MAX) ) {
			$kW = $imgW / $WIDTH_MAX;
			$kH = $imgH / $HEIGHT_MAX;
			$k = max($kW, $kH);
			$picW = round($imgW / $k);
			$picH = round($imgH / $k);
		} else {
			$picW = $imgW;
			$picH = $imgH;
		}
		
		$picResource = imagecreatetruecolor($picW, $picH);
		imagecopyresampled($picResource, $imgResource, 0, 0, 0, 0, $picW, $picH, $imgW, $imgH);
		imagedestroy($imgResource);

		$picFilePath = tempnam("/tmp", "PIC");
		imagejpeg($picResource, $picFilePath);
		imagedestroy($picResource);
				
		$file_content =  base64_encode(file_get_contents($picFilePath));
		unlink($picFilePath);
		
		return $file_content;	
		
	}
	
}