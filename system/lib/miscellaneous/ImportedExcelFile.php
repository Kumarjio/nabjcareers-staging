<?php

require_once SJB_System::getSystemSettings('EXTERNAL_COMPONENTS_DIR').'Excel/reader.php';

class SJB_ImportedExcelFile
{
	var $filename;	
	var $parse_date = true;
		
	function setFileName($filename)
	{		
		$this->filename = $filename;		
	}
	
	function setParseDate($parse_date)
	{
		$this->parse_date = $parse_date;
	}
	
	function getTable()
	{		
		$excel_reader = &new Spreadsheet_Excel_Reader();
		$excel_reader->setOutputEncoding('utf-8');
		$excel_reader->setRowColOffset(0);		
		// to do not parse cells data as date
		if (!$this->parse_date)
			$excel_reader->dateFormats = array();		
		$excel_reader->read($this->filename);		
		$table = $excel_reader->sheets[0]['cells'];		
		return $table;		
	}
}

