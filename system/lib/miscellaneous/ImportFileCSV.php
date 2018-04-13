<?php

require_once('miscellaneous/ImportFile.php');

class SJB_ImportFileCSV extends SJB_ImportFile
{
	protected $csv_delimiter;

	public function SJB_ImportFileCSV($file_info, $csv_delimiter = ';')
	{
		$this->data = array();
		parent::SJB_ImportFile($file_info);
		
		switch ($csv_delimiter) {
			case 'comma':
			case ',':
				$this->csv_delimiter = ",";
				break;
			
			case 'tab':
				$this->csv_delimiter = "\t";
				break;
				
			default:
				$this->csv_delimiter = ';';
				break;
		}
	}

	public function parse()
	{
        if ( !$file_resource = fopen($this->file_info['tmp_name'], "r") ) {
			$this->errors["CANNOT_OPEN_FILE"] = $this->file_info['tmp_name'];
			return false;
		}

		while ( $csv_string = fgetcsv($file_resource, 4048, $this->csv_delimiter) ) {
			if ( count($csv_string) == 1 && $csv_string[0] == null)
			    continue;
			array_push($this->data, $csv_string);
		}
	}
}

