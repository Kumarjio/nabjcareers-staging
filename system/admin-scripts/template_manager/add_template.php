<?php

include_once ('template_manager/TemplateEditor.php');

$template_processor = SJB_System::getTemplateProcessor ();

$template_editor = new SJB_TemplateEditor();
$template_processor->assign('module_name', $module_name);

$modules = $template_editor->getModuleWithTemplatesList();
ksort($modules);

global $error;

$template_processor->assign('module_name', SJB_Request::getVar( 'module_name', '', 'GET' ) );
$template_processor->assign('template_name', SJB_Request::getVar( 'template_name', '', 'GET') );
$template_processor->assign('tpl_error', $error );
$template_processor->assign('module_list', $modules);
$template_processor->display('add_template.tpl');