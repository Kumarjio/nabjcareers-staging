<?php


require_once("miscellaneous/ImportedCSVFile.php");

require_once("miscellaneous/ImportedExcelFile.php");

require_once("classifieds/ListingField/ListingFieldManager.php");

require_once("classifieds/ListingType/ListingTypeManager.php");

$template_processor = SJB_System::getTemplateProcessor();

$field_sid = isset($_REQUEST['field_sid']) ? $_REQUEST['field_sid'] : null;

$field_info = SJB_ListingFieldManager::getFieldInfoBySID($field_sid);

$template_processor->assign("field", $field_info);

$template_processor->assign("field_sid", $field_sid);

$listing_type_info = SJB_ListingTypeManager::getListingTypeInfoBySID($field_info['listing_type_sid']);

$template_processor->assign("type_info", $listing_type_info);

if (!strcasecmp("tree", $field_info['type'])) {
	
	if (empty($_FILES['imported_tree_file']['name'])) $errors['File'] = 'EMPTY_VALUE';
	
	$start_line = isset($_REQUEST['start_line']) ? $_REQUEST['start_line'] : null;
	
	if (empty($start_line))	$errors['Start Line'] = 'EMPTY_VALUE';
	elseif (!is_numeric($start_line) || !is_int($start_line + 0))	$errors['Start Line'] = 'NOT_INT_VALUE';
	
	$form_submitted = ($_SERVER['REQUEST_METHOD'] == 'POST');
	
	$is_data_valid = empty($errors);
	
	if ($form_submitted && $is_data_valid) {
		
		if (!strcasecmp($_REQUEST['file_format'], 'excel')) {
			
			$imported_file = new SJB_ImportedExcelFile();
			
		} else {
		
			$imported_file = new SJB_ImportedCSVFile();
			
		}
		
		$imported_file->setFileName($_FILES['imported_tree_file']['tmp_name']);
		
		$imported_data = $imported_file->getTable();
		
		$count = 0;
		
		for ($i = ($start_line - 1); $i < count($imported_data); $i++) {
			
			if (SJB_ListingFieldTreeManager::importTreeItem($field_sid, $imported_data[$i])) {
				
				$count++;
				
			}
			
		}
		
		$template_processor->assign("count", $count);
		
		$template_processor->display("import_tree_data_statistics.tpl");
		
	} else {
		
		if (!$form_submitted) {
			
			$errors = null;
			
		}
		
		$template_processor->assign("errors", isset($errors) ? $errors : null);
		
		$template_processor->display("import_tree_data.tpl");
		
	}

} else {
	
	echo 'invalid Tree SID is specified';
	
}

