<?php

class SJB_ImportedCSVFile
{
	var $filename;
	var $fields_delimiter = ',';
	
	function setFileName($filename)
	{
		$this->filename = $filename;
	}
	
	function setFieldsDelimiter($fields_delimiter)
	{
		$this->fields_delimiter = $fields_delimiter;
	}
	
	function getTable()
	{
		$file = @fopen($this->filename, "r");
		if (!$file) {
			return null;
		}
		
		$table = array();
		while (!feof ($file)) {
			$row = fgetcsv($file, 1024, $this->fields_delimiter);
			$table[] = $row;
		}
		fclose ($file);
		return $table;
	}
}
