<?php

$tp = SJB_System::getTemplateProcessor();
$theme = SJB_Settings::getValue('TEMPLATE_USER_THEME', 'default');
$tp->assign('theme', $theme);
$errors = array();

switch (SJB_Request::getVar('action', '')) {

	case 'save':
		if ($_FILES['logo']['error'] == UPLOAD_ERR_OK) {
			if (SJB_System::getSystemSettings('isDemo')) {
				$errors[] = 'NOT_ALLOWED_IN_DEMO';
			}
			else {
				$themePath = SJB_TemplatePathManager::getAbsoluteThemePath($theme, 'user');
				move_uploaded_file($_FILES['logo']['tmp_name'], "{$themePath}main/images/logo.png");
			}
		}
		else {
			switch ($_FILES['logo']['error']) {
				case UPLOAD_ERR_INI_SIZE:
					$errors[] = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
					break;
				case UPLOAD_ERR_FORM_SIZE:
					$errors[] = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
					break;
				case UPLOAD_ERR_PARTIAL:
					$errors[] = 'The uploaded file was only partially uploaded';
					break;
				case UPLOAD_ERR_NO_FILE:
					// Разрешим изменять текст без аплоада лого
					break;
				case UPLOAD_ERR_NO_TMP_DIR:
					$errors[] = 'Missing a temporary folder';
					break;
				case UPLOAD_ERR_CANT_WRITE:
					$errors[] = 'Failed to write file to disk';
					break;
				default:
					$errors[] = 'File upload error';
			}
		}

		if (SJB_Settings::getSettingByName('logoAlternativeText') === false)
			SJB_Settings::addSetting('logoAlternativeText', SJB_Request::getVar('logoAlternativeText', ''));
		else
			SJB_Settings::updateSetting('logoAlternativeText', SJB_Request::getVar('logoAlternativeText', ''));
		
		break;
}

$tp->assign('errors', $errors);
$tp->assign('logoAlternativeText', SJB_Request::getVar('logoAlternativeText', SJB_Settings::getSettingByName('logoAlternativeText')));
$tp->display('upload_logo.tpl');