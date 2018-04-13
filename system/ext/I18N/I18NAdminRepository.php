<?php

require_once 'Translation2/Admin/Container/xml.php';
class I18NAdminRepository
{
	var $adminFactory;
	var $fileHelper;
	var $repository = array();

	function setAdminFactory(&$adminFactory)
	{
		$this->adminFactory =& $adminFactory;
	}

	function setFileHelper(&$fileHelper)
	{
		$this->fileHelper =& $fileHelper;
	}
	
	function load()
	{
		$language_ids = $this->fileHelper->getLanguageIDs();
		
		foreach($language_ids as $language_id)
		{
			$this->repository[$language_id] = null;
		}
	}
	
	function &create($language_id)
	{
		$file_path = $this->fileHelper->getFilePathToLangFile($language_id);
		
		$this->fileHelper->createFile($file_path);
		
		$trAdmin =& $this->adminFactory->createTrAdmin(realpath($file_path), true);
		
		$this->repository[$language_id] =& $trAdmin;
		
		return $trAdmin;
	}
	
	function &get($language_id)
	{		
		if (!isset($this->repository[$language_id]))
		{		
			$file_path = $this->fileHelper->getFilePathToLangFile($language_id);
			$cache_path = $file_path . ".cache";
			
			if (SJB_System::getSystemSettings('SYSTEM_ACCESS_TYPE') === "admin" || !file_exists($cache_path) || filemtime($file_path) >= filemtime($cache_path)) {
				$trAdmin =& $this->adminFactory->createTrAdmin($file_path);
				$h = fopen($cache_path, "w+");
				flock($h, LOCK_EX);
				fwrite($h, serialize($trAdmin));
				flock($h, LOCK_UN);
				fclose($h);
			}
			else {
				$h = fopen($cache_path, "r");
				$trAdmin = unserialize(fread($h, filesize($cache_path)));
				fclose($h);
			}
			
			$this->repository[$language_id] =& $trAdmin;
		}
		else
			$trAdmin =& $this->repository[$language_id];
		
		return $trAdmin;
	}
	
	function remove($language_id)
	{
		$file_path = $this->fileHelper->getFilePathToLangFile($language_id);
		
		unset($this->repository[$language_id]);
				
		return $this->fileHelper->deleteFile($file_path);
	}
	
	function getLangList()
	{		
		return array_keys($this->repository);
	}
}
