<?php

require_once 'forms/Form.php';
require_once 'applications/ScreeningQuestionnaires.php';
require_once 'applications/ScreeningQuestionnairesField.php';
require_once 'applications/ScreeningQuestionnairesFieldManager.php';
require_once 'applications/ScreeningQuestionnairesListController.php';
require_once("classifieds/Browse/UrlParamProvider.php");

$questionnaire_field = new SJB_ScreeningQuestionnairesField($_REQUEST);
$tp = SJB_System::getTemplateProcessor();
$sid = SJB_Request::getVar('sid', null);
if (isset($_REQUEST['passed_parameters_via_uri'])) {
	$passed_parameters_via_uri = SJB_UrlParamProvider::getParams();
	$sid = isset($passed_parameters_via_uri[0]) ? $passed_parameters_via_uri[0] : null;
}
$add_questionnaire_field_form = new SJB_Form($questionnaire_field);
$add_questionnaire_field_form->registerTags($tp);
$form_is_submitted = (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add');
$errors = null;
$answers = SJB_Request::getVar('answer', false);
$score = SJB_Request::getVar('score', false);
$answer_boolean = SJB_Request::getVar('answer_boolean', false);
$score_boolean = SJB_Request::getVar('score_boolean', false);
$type = SJB_Request::getVar('type', false);

if ($form_is_submitted && $add_questionnaire_field_form->isDataValid($errors)) {
	$questionnaire_field->addProperty(
				array (	'id'		=> 'questionnaire_sid',
						'type'		=> 'integer',
						'value'		=> $sid,
						'is_system' => true)
	);
	$id = $questionnaire_field->getProperty('caption');
	$questionnaire_field->addProperty(
				array (	'id'		=> 'id',
						'type'		=> 'string',
						'value'		=> str_replace(" ", "_", strip_tags($id->value)),
						'is_system' => true)
	);
	
	SJB_ScreeningQuestionnairesFieldManager::saveQuestion($questionnaire_field);
	if($type == 'boolean') {
		$request['list_multiItem_value'] = $answer_boolean;
		$request['field_sid'] = $questionnaire_field->sid;
		$request['score'] = $score_boolean;
		$edit_list_controller = new SJB_ScreeningQuestionnairesListController($request);
		if ($edit_list_controller->isvalidFieldSID()) {
			$edit_list_controller->saveItem(true);
		}
	}
	elseif($type != 'text') {
		$request['list_multiItem_value'] = $answers;
		$request['field_sid'] = $questionnaire_field->sid;
		$request['score'] = $score;
		$edit_list_controller = new SJB_ScreeningQuestionnairesListController($request);
		if ($edit_list_controller->isvalidFieldSID()) {
			$edit_list_controller->saveItem(true);
		}
	}
	$questionnaire_sid = $questionnaire_field->getSID();
	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL')."/edit-questions/".$sid);
		
} else {
	switch ($type) {
		case 'boolean': 
			$tp->assign("answer_boolean", $answer_boolean);
			$tp->assign("score_boolean", $score_boolean);
			break;
		case 'multilist':
		case 'list':
			$tp->assign("answers", $answers);
			$tp->assign("score", $score);
			break;
	}
	$tp->assign("errors", $errors);
	$add_questionnaire_field_form->registerTags($tp);
	$tp->assign("form_fields", $add_questionnaire_field_form->getFormFieldsInfo());
	$tp->display("add_questions.tpl");
}