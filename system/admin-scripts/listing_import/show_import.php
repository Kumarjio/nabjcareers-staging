<?php
require_once ("listing_import/function.php");


$tp = SJB_System::getTemplateProcessor ();

	$action = (isset($_GET['action'])?$_GET['action']:'');
	$id = (isset($_GET['id'])?intval($_GET['id']):0);
	
	if ($id > 0)
	{
		switch ($action)
		{
			case 'activate': activate($id); break;
			case 'deactivate': deactivate($id); break;
			default: break;
		}
	}
	

	$systemParsers = getSystemParsers('', true);

	$tp->assign ( 'systemParsers', $systemParsers );
	
	$tp->display ( 'show_import_list.tpl' );



