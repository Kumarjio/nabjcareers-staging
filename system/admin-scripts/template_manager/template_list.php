<?php

include_once ('template_manager/TemplateEditor.php');
$template_processor = SJB_System::getTemplateProcessor ();

$template_editor = new SJB_TemplateEditor();
$template_processor->assign('ERROR', "OK");
$module_name = empty($_REQUEST['module_name']) ? '' : $_REQUEST['module_name'];
$template_name = isset($_REQUEST['template_name'])?$_REQUEST['template_name']:"";
$template_processor->assign('module_name', $template_editor->doesModuleExists($module_name) ? $module_name : "");
$template_processor->assign('template_name', $template_editor->doesModuleTemplateExists($module_name, $template_name) ? $template_name : "");

if(!$template_editor->doesModuleExists($module_name)) {
	$template_processor->assign('ERROR', "MODULE_DOES_NOT_EXIST");
}
else {
	if( !$template_editor -> copyDefaultModuleThemeIfNotExists($module_name))
		$template_processor->assign('ERROR', "CANNOT_COPY_THEME");
	$modules = $template_editor->getModuleWithTemplatesList();
	
	$template_processor->assign('display_name', $modules[$module_name]['display_name']);
	$template_processor->assign('module_name', $module_name);
	$template_processor->assign('template_list', $template_editor->getTemplateList($module_name, SJB_Settings :: getValue('TEMPLATE_USER_THEME', 'default')));
}
$template_processor->display('template_list.tpl');


