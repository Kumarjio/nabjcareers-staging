<?php

require_once 'listing_import/function.php';

$errors = array();
$tp = SJB_System::getTemplateProcessor ();
$id = (isset( $_GET ['id'] ) ? intval($_GET['id']) : 0);

if ($id > 0 ) {
	$result = runImport($id);
	$tp->assign('id', $id);
	$tp->assign('result', $result);
}
else {
	$errors[] = 'Undefined ID parser';
}

$tp->assign('errors', $errors);
$tp->display('run_import.tpl');