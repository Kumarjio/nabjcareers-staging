<?php


class I18NFileHelper
{
	var $context;
	var $fileSystem;
	
	function setContext(&$context)
	{
		$this->context =& $context;
	}
	
	function setFileSystem(&$fileSystem)
	{
		$this->fileSystem =& $fileSystem;
	}
	
	function getLanguageIDs()
	{		
		$path = $this->context->getPathToLanguageFiles();		
		$file_names = $this->fileSystem->getFileNames($path);
		
		$lang_ids = array();
		
		foreach($file_names as $file_name)
		{
			$id = $this->_getID($file_name);
			
			if(!empty($id))	$lang_ids[] = $id;
		}
		
		return $lang_ids;
	}

	function getLanguageIDForFile($file_name)
	{
		$id = $this->_getID($file_name);
		
		if(empty($id)) return false;
		
		return $id;
	}

	function _getID($file_name)
	{				
		$template = $this->context->getFileNameTemplateForLanguageFile();
		$template = preg_replace("/\%s/", "([^\/]+)", $template);
		$template = preg_replace("/\./", "\\.", $template);
		$pattern = sprintf("/%s$/", $template);
		
		if(preg_match($pattern, $file_name, $matches))
		{
			return $matches[1];
		}	
		return null;
	}

	function createFile($file_path)
	{
		return $this->fileSystem->createFile($file_path);
	}
	
	function deleteFile($file_path)
	{
		return $this->fileSystem->deleteFile($file_path);
	}
		
	function getFilePathToLangFile($language_id)
	{		
		$path = $this->context->getPathToLanguageFiles();		
		$file_name = sprintf($this->context->getFileNameTemplateForLanguageFile(), $language_id);
		$file_path = $this->fileSystem->pathCombine($path, $file_name);
		
		return $file_path;
	}	
}
