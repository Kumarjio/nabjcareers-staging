<?php

require_once('miscellaneous/ImportFile.php');
require_once SJB_System::getSystemSettings('EXTERNAL_COMPONENTS_DIR').'Excel/Classes/PHPExcel/IOFactory.php';

class SJB_ImportFileXLS extends SJB_ImportFile
{
	function parse()
	{
		$objReader = PHPExcel_IOFactory::createReader('Excel5');
		$objReader->setReadDataOnly(true);
		$objPHPExcel =$objReader->load($this->file_info['tmp_name']);
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$result = array();
		foreach ($objWorksheet->getRowIterator() as $row) {
			$cellIterator = $row->getCellIterator();
		  	$cellIterator->setIterateOnlyExistingCells(false); 
		  	$arrayValues = array();
			foreach ($cellIterator as $cell) {
			  	$arrayValues[] = $cell->getValue();
			}
			$result[] = $arrayValues;
		}
		$this->data = $result;
	}
}

