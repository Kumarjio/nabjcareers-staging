<?php


require_once("miscellaneous/ImportedCSVFile.php");

require_once("miscellaneous/ImportedExcelFile.php");

require_once("orm/Location/LocationManager.php");

$template_processor = SJB_System::getTemplateProcessor();

$errors = null;

$start_line			= isset($_REQUEST['start_line']) ? $_REQUEST['start_line'] : null;
$name_column		= isset($_REQUEST['name_column']) ? $_REQUEST['name_column'] : null;
$longitude_column	= isset($_REQUEST['longitude_column']) ? $_REQUEST['longitude_column'] : null;
$latitude_column	= isset($_REQUEST['latitude_column']) ? $_REQUEST['latitude_column'] : null;
$file_format		= isset($_REQUEST['file_format']) ? $_REQUEST['file_format'] : null;
$fields_delimiter	= isset($_REQUEST['fields_delimiter']) ? $_REQUEST['fields_delimiter'] : null;


$imported_file_config['start_line'] = $start_line;
$imported_file_config['name_column'] = $name_column;
$imported_file_config['longitude_column'] = $longitude_column;
$imported_file_config['latitude_column'] = $latitude_column;
$imported_file_config['file_format'] = $file_format;
$imported_file_config['fields_delimiter'] = $fields_delimiter;

$imported_location_count = null;

if (isset($_FILES['imported_geo_file']) && !$_FILES['imported_geo_file']['error']) {
	
	if (empty($_FILES['imported_geo_file']['name'])) $errors['File'] = 'EMPTY_VALUE';
	
	if (empty($start_line))	$errors['Start Line'] = 'EMPTY_VALUE';
	elseif (!is_numeric($start_line) || !is_int($start_line + 0))	$errors['Start Line'] = 'NOT_INT_VALUE';
	
	if (empty($name_column))	$errors['Name Column'] = 'EMPTY_VALUE';
	elseif (!is_numeric($name_column) || !is_int($name_column + 0))	$errors['Name Column'] = 'NOT_INT_VALUE';
	
	if (empty($longitude_column))	$errors['Longitude Column'] = 'EMPTY_VALUE';
	elseif (!is_numeric($longitude_column) || !is_int($longitude_column + 0))	$errors['Longitude Column'] = 'NOT_INT_VALUE';
	
	if (empty($latitude_column))	$errors['Latitude Column'] = 'EMPTY_VALUE';
	elseif (!is_numeric($latitude_column) || !is_int($latitude_column + 0))	$errors['Latitude Column'] = 'NOT_INT_VALUE';
	
	if (is_null($errors)) {
	
		set_time_limit(0);
		
		if (!strcasecmp($file_format, 'excel')) {
			
			$imported_file = new SJB_ImportedExcelFile();
			
			$imported_file->setParseDate(false);
			
		} else {
		
			$imported_file = new SJB_ImportedCSVFile();
			
			if ($fields_delimiter == "semicolumn") {
				
				$fields_delimiter = ";";
				
			} elseif ($fields_delimiter == "tab") {
				
				$fields_delimiter = "\t";
				
			} else {
				
				$fields_delimiter = ",";
				
			}
			
			$imported_file->setFieldsDelimiter($fields_delimiter);
		}
		
		$imported_file->setFileName($_FILES['imported_geo_file']['tmp_name']);
		
		$imported_data = $imported_file->getTable();
		
		$imported_location_count = 0;
		
		for ($i = $start_line - 1; $i < count($imported_data); $i++) {
			
			if (!isset($imported_data[$i][$name_column - 1], $imported_data[$i][$longitude_column - 1], $imported_data[$i][$latitude_column - 1]))	continue;
			
			$name = $imported_data[$i][$name_column - 1];
			
			$longitude = $imported_data[$i][$longitude_column - 1];
			
			$latitude = $imported_data[$i][$latitude_column - 1];
			
			$imported_location_count += SJB_LocationManager::addLocation($name, $longitude, $latitude);
			
		}
		
	}	
	
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$errors['File'] = 'FILE_NOT_UPLOADED';
	
}

$template_processor->assign("errors", $errors);

$template_processor->assign("imported_location_count", $imported_location_count);
	
$template_processor->assign("imported_file_config", $imported_file_config);

$template_processor->display("import_geographic_data_form.tpl");

