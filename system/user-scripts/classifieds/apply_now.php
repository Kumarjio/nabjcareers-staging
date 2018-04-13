<?php

require_once 'miscellaneous/Notifications.php';
require_once 'classifieds/SendListingInfoController.php';
require_once 'miscellaneous/UploadFileManager.php';
require_once 'applications/Applications.php';
require_once 'classifieds/ListingType/ListingTypeManager.php';
require_once 'miscellaneous/Captcha.php';

$errors = array();
$field_errors = array();
$tp = SJB_System::getTemplateProcessor();
$loggedIn = SJB_UserManager::isUserLoggedIn();
$current_user_sid = SJB_UserManager::getCurrentUserSID();

$controller = new SJB_SendListingInfoController($_REQUEST);
$isDataSubmitted = false;
$isCaptcha = SJB_System::getSettingByName('contactUserCaptcha') == 1;

if ($isCaptcha) {
	$captcha = new SJB_Captcha($_REQUEST, 'modal');
	$captcha_form = SJB_ObjectMother::createForm($captcha);
	$captcha_form->registerTags($tp);
	$tp->assign('captcha', array_pop($captcha_form->form_fields));
	$tp->assign('captchaObject', $captcha);
}
$jobInfo = SJB_ListingManager::getListingInfoBySID($controller->listing_id);
if ($controller->isListingSpecified()) {
	if ($controller->isDataSubmitted()) {
		$captcha_errors = array();
		if ($isCaptcha && !$captcha_form->isDataValid($captcha_errors)) {
			foreach ($captcha_errors as $error)
				$errors[$error] = true;
		}
		else {
			// получим уникальный id для файла в uploaded_files

			$file_id_current = 'application_' . md5(microtime());
			$upload_manager = new SJB_UploadFileManager();
			$upload_manager->setFileGroup('files');
			$upload_manager->setUploadedFileID($file_id_current);
			$file_name = $upload_manager->uploadFile('file_tmp');
			$id_file = mysql_insert_id();

			$post = $controller->getData();
			$listingId = 0;		
			$post['submitted_data']['questionnaire'] = '';
			if (isset($post['submitted_data']['id_resume']))
				$listingId = $post['submitted_data']['id_resume'];
			$mimeType = '';
						
			$mimeType = isset($_FILES['file_tmp']['type'])?$_FILES['file_tmp']['type']:'';
			
			if (isset($_FILES['file_tmp']['size']) && $file_name != '' && $_FILES['file_tmp']['size'] == 0) {
				$errors['FILE_IS_EMPTY'] = 'The uploaded file should not be blank';
			}
			
			if ($file_name == '' && $listingId == 0) {
				$canAppplyWithoutResume = false;
				SJB_Event::dispatch('CanApplyWithoutResume', $canAppplyWithoutResume);
				if (!$canAppplyWithoutResume) {
					$errors['APPLY_INPUT_ERROR'] = 'Please select file or resume';
				}
			}
			else if (SJB_Applications::isApplied($post['submitted_data']['listing_id'], $current_user_sid) && !is_null($current_user_sid)) {
				$errors['APPLY_APPLIED_ERROR'] = 'You already applied';
			}
			
			$res = false;
			$listing_info = '';
			$notRegisterUserData = $_POST;
			$score = 0;
			// для зарегестрированного пользователя получим поля email и name
			// для незарегестрированных - поля name и email приходят с формы
			if ($loggedIn === true) {
				$userData = SJB_UserManager::getCurrentUserInfo();
				$post['submitted_data']['username'] = isset($userData['username']) ? $userData['username'] : '';
				$post['submitted_data']['LastName'] = isset($userData['LastName']) ? $userData['LastName'] : '';
				$post['submitted_data']['FirstName'] = isset($userData['FirstName'])? $userData['FirstName'] : '';
				$post['submitted_data']['name'] = $post['submitted_data']['FirstName'].' '.$post['submitted_data']['LastName'];
				$post['submitted_data']['email'] = $userData['email'];
			}
			
			if (!empty($jobInfo['screening_questionnaire'])) {
				require_once('applications/Questions.php');
				require_once('forms/Form.php');
				$questions = new SJB_Questions($_REQUEST, $jobInfo['screening_questionnaire']);
				$add_form = new SJB_Form($questions);
				$add_form->registerTags($tp);
				$add_form->isDataValid($field_errors);
				$tp->assign('field_errors', $field_errors);
				if (!$field_errors) {
					$result = array();
					$properties = $questions->getProperties();
					$countAnswers = 0;
					foreach ($properties as $key => $val) {
						if ($val->type->property_info['type'] == 'boolean'){
							switch ($val->value) {
								case 0: $val->value = 'No';
									break;
								case 1: $val->value = 'Yes';
									break;
							}
						}
						$result[$key] = $val->value;
						if (isset($val->type->property_info['list_values'])) {
							foreach ($val->type->property_info['list_values'] as $list_values) {
								if (is_array($val->value)) {
									foreach ($val->value as $value) {
										if ($value== $list_values['id'] && $list_values['score'] != 'no'){
											$score += $list_values['score'];
											$countAnswers++;
										}
									}
								}
								else {
									if ($val->value == $list_values['id'] && $list_values['score'] != 'no'){
										$score += $list_values['score'];
										$countAnswers++;
									}
								}
							}
						}
					}
					$score = round($score/$countAnswers, 2);
					$post['submitted_data']['questionnaire'] = serialize($result);
				}
			}
			
			if (count($errors) == 0 && count($field_errors) == 0) {
				$res = SJB_Applications::create(
					$post['submitted_data']['listing_id'],
					$current_user_sid,
					(isset($post['submitted_data']['id_resume'])) ? $post['submitted_data']['id_resume'] : '',
					$post['submitted_data']['comments'],
					$file_name,
					$mimeType,
					$id_file,
					(isset($post['submitted_data']['anonymous'])) ? $post['submitted_data']['anonymous'] : '0',
					$notRegisterUserData, 
					$post['submitted_data']['questionnaire'],
					$score
				);
				
				if (isset($post['submitted_data']['id_resume']) && $post['submitted_data']['id_resume'] != 0 ){
					$listing_info = SJB_ListingManager::getListingInfoBySID($post['submitted_data']['id_resume']);
					$emp_sid	= SJB_ListingManager::getUserSIDByListingSID($post['submitted_data']['listing_id']);
					$accessible	= SJB_ListingManager::isListingAccessableByUser($post['submitted_data']['id_resume'], $emp_sid);
					if (!$accessible)
						SJB_ListingManager::setListingAccessibleToUser($post['submitted_data']['id_resume'], $emp_sid);
				}
				if ( !SJB_Notifications::sendApplyNow($post, 'files/files/' . $file_name, $listing_info, $current_user_sid, $notRegisterUserData, $score) )
					$errors['SEND_ERROR'] = true;
				else {
					if (!empty($jobInfo['screening_questionnaire'])) {
						require_once 'applications/ScreeningQuestionnaires.php';
						$questionnaire = SJB_ScreeningQuestionnaires::getInfoBySID($jobInfo['screening_questionnaire']);
						if ($questionnaire) {
							$passing_score = 0;
							switch ($questionnaire['passing_score']) {
								case 'acceptable':
									$passing_score = 1;
									break;
								case 'good':
									$passing_score = 2;
									break;
								case 'very_good':
									$passing_score = 3;
									break;
								case 'excellent':
									$passing_score = 4;
									break;
							}
						}
						if ($score >= $passing_score && $questionnaire['send_auto_reply_more'] == 1) {
							if (!empty($questionnaire['email_text_more'])) {
								SJB_Notifications::userAutoReply($jobInfo, $current_user_sid, $questionnaire['email_text_more'], $notRegisterUserData);
							}
						}
						elseif($score < $passing_score && $questionnaire['send_auto_reply_less'] == 1) {
							if (!empty($questionnaire['email_text_less'])) {
								SJB_Notifications::userAutoReply($jobInfo, $current_user_sid, $questionnaire['email_text_less'], $notRegisterUserData);
							}
						}
					}
				}
			}
			
			if ($res === false)
				$errors['APPLY_ERROR'] = 'Cannot apply';
			
			$isDataSubmitted = true;
		}
	}

	if (!empty($jobInfo['screening_questionnaire'])) {
		require_once('applications/Questions.php');
		require_once('forms/Form.php');
		$questions = new SJB_Questions($_REQUEST, $jobInfo['screening_questionnaire']);
		$add_form = new SJB_Form($questions);
		$add_form->registerTags($tp);
		$form_fields = $add_form->getFormFieldsInfo();

		$tp->assign('form_fields', $form_fields);
		$tp->assign('questionsObject', $questions);
	}

	if ($loggedIn) {
		$listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID('Resume');
		$wait_approve = SJB_ListingTypeManager::getWaitApproveSettingByListingType($listing_type_sid);
		$approve_status = '';
		if ($wait_approve)
			$approve_status = "AND `l`.`status` = 'approved'";
			
		$result = SJB_DB::query("SELECT `l`.`sid` , `lp`.`id` , `lp`.`value` FROM `listings` as `l`
			LEFT JOIN `listings_properties` as `lp` ON `lp`.`object_sid` = `l`.`sid`
			LEFT JOIN `listing_types` as `lt` ON (`lt`.`sid` = `l`.`listing_type_sid`)
			WHERE `lt`.`id` = 'Resume' {$approve_status} AND `lp`.`id` = 'Title' AND `l`.`user_sid` = {$current_user_sid}");

		$resume = array();
		foreach ($result as $val)
			$resume[$val['sid']] = $val['value'];
		$tp->assign('resume', $resume);
	}
}
else {
	$errors['UNDEFINED_LISTING_ID'] = true;
}

$tp->assign('request', $_REQUEST);
$tp->assign('isCaptcha', $isCaptcha);
$tp->assign('errors', $errors);
$tp->assign('listing_id', $controller->getListingID());
$tp->assign('is_data_submitted', $isDataSubmitted);
$tp->display('apply_now.tpl');
