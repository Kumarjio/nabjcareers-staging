<?php

class SJB_ImportFile
{
	var $file_info 	= null;
	var $data		= null;

	function SJB_ImportFile($file_info)
	{
		$this->file_info = $file_info;
	}

	function getData()
	{
		return $this->data;
	}
}
