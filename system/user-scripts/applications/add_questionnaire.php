<?php

require_once 'forms/Form.php';
require_once 'applications/ScreeningQuestionnaires.php';
require_once("classifieds/Browse/UrlParamProvider.php");

$tp = SJB_System::getTemplateProcessor();
$action = SJB_Request::getVar('action','add');
$submit = SJB_Request::getVar('submit', false);
$template = SJB_Request::getVar('template_name', 'add_questionnaire.tpl');
$sid = SJB_Request::getVar('sid', null);
$edit = SJB_Request::getVar('edit', false);
if (isset($_REQUEST['passed_parameters_via_uri'])) {
	$passed_parameters_via_uri = SJB_UrlParamProvider::getParams();
	$sid = isset($passed_parameters_via_uri[0]) ? $passed_parameters_via_uri[0] : null;
}
$errors = array();
if (SJB_Acl::getInstance()->isAllowed('use_screening_questionnaires')) {
	$questionnaireInfo = SJB_ScreeningQuestionnaires::getInfoBySID($sid);
	$questionnaireInfo = $questionnaireInfo?$questionnaireInfo:array();
	$questionnaireInfo = array_merge($questionnaireInfo, $_REQUEST);
	$questionnaire= new SJB_ScreeningQuestionnaires($questionnaireInfo);
	if($submit) {
		$questionnaire->addProperty(
					array (	'id'		=> 'user_sid',
							'type'		=> 'integer',
							'value'		=> SJB_UserManager::getCurrentUserSID(),
							'is_system' => true)
					);
	}
	if(isset($sid) && !is_null($sid)) {
		$questionnaire->setSID($sid);
	}
	$addForm = new SJB_Form($questionnaire);
	$addForm->registerTags($tp);
	switch ($submit) {
		case 'add':
			if ($addForm->isDataValid($errors)) {
				SJB_ScreeningQuestionnaires::save($questionnaire);
				SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL')."/screening-questionnaires/add-questions/".$questionnaire->sid);
			}
			else {
				$action = 'add';
				$questionnaire->deleteProperty('user_sid');
				$addForm = new SJB_Form($questionnaire);
				$addForm->registerTags($tp);
			}
			break;
		case 'edit':
			if ($addForm->isDataValid($errors)) {
				SJB_ScreeningQuestionnaires::save($questionnaire);
				SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL')."/screening-questionnaires/edit/".$questionnaire->sid."?edit=1");
			}
			else {
				$tp->assign('sid', $_REQUEST['sid']);
				$questionnaire->deleteProperty('user_sid');
				$addForm = new SJB_Form($questionnaire);
				$addForm->registerTags($tp);
				$action = 'edit';
			}
			break;
	}
	$form_fields = $addForm->getFormFieldsInfo();
	$tp->assign("form_fields", $form_fields);
	$metaDataProvider =& SJB_ObjectMother::getMetaDataProvider();
	$tp->assign
	(
		"METADATA",  
		array
		( 
			"form_fields" => $metaDataProvider->getFormFieldsMetadata("FormFieldCaptions", $form_fields), 
			"form_field" => array('caption' => array('domain' => 'FormFieldCaptions')),
		) 
	);
	
	$tp->assign('edit', $edit);
	$tp->assign('request', $questionnaireInfo);
	$tp->assign('sid', $sid);
	$tp->assign('action', $action);
	$tp->assign('errors', $errors);
	$tp->display($template);
}
else {
	$tp->display("add_questionnaire_error.tpl");
}
