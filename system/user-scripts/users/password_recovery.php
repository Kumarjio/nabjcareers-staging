<?php


require_once "users/User/UserManager.php";

require_once "miscellaneous/Notifications.php";

$template_processor = SJB_System::getTemplateProcessor();

$ERRORS = array();

$message_was_sent = false;

if (!empty($_REQUEST['email']))
{
	$user_sid = SJB_UserManager::getUserSIDbyEmail( $_REQUEST['email'] );

	if (!empty($user_sid))
	{
		$message_was_sent = SJB_Notifications::sendUserPasswordChangeLetter($user_sid);
	}
	else
	{
		$ERRORS['WRONG_EMAIL'] = 1;
	}
}

if (!$message_was_sent)
{
	$template_processor->assign('errors',$ERRORS);
	$template_processor->assign('email', isset($_REQUEST['email']) ? $_REQUEST['email'] : '');
	$template_processor->display('password_recovery.tpl');
}
else
{
	$template_processor->display('password_change_email_successfully_sent.tpl');
}

