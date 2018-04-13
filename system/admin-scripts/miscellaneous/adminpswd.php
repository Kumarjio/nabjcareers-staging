<?php

$action = SJB_Request::getVar('action', '');
$message = "";
$form_items = array (
	'old_name' => array ('type' => 'static', 'caption' => 'Current Username', 'value' => $_SESSION['username']),
	'new_name' => array ('type' => 'text', 'caption' => 'New Username', 'value' => $_SESSION['username']),
	'old_password' => array ('type' => 'password', 'caption' => 'Current Password', 'value' => ''),
	'new_password' => array ('type' => 'password', 'caption' => 'New Password', 'value' => ''),
	'new_password_confirm' => array ('type' => 'password', 'caption' => 'Confirm Password', 'value' => ''),
);

switch ($action) {
	case 'change_admin_account':
		if (SJB_System::getSystemSettings("isDemo")) {
			$message = "You don't have permissions for it. This is a Demo version of the software.";
		}
		else {
			foreach ($form_items as $item_name => $item_params) {
				if (isset ($_REQUEST[$item_name]))
					$$item_name = mysql_real_escape_string ($_REQUEST[$item_name]);
			}
			$old_name = $_SESSION['username'];
			if (($old_name == $new_name) && ($old_password == $new_password))
				break;
				
			if ($new_password != $new_password_confirm) {
				$message = 'Passwords Don\'t Match';
				break;
			}
			
			$new_password = md5($new_password);
			$old_password = md5($old_password);
			$sql = "UPDATE `administrator` SET `username` = '$new_name', `password` = '{$new_password}' ".
				"WHERE `username`='{$old_name}' AND `password` = '{$old_password}'";
			
			if (!mysql_query ($sql))
				$message = 'Cannot Execute SQL Query';
			elseif (mysql_affected_rows () != 1)
				$message = 'Administrator Current Password is Incorrect';
			else {
				$message = "Administrator Username and Password are Changed";
				$_SESSION['username'] = $new_name;
				$form_items['old_name']['value'] = $_SESSION['username'];
				$form_items['new_name']['value'] = $_SESSION['username'];
				unset ($_REQUEST);
			}
		}
		break;
	default:
		break;
}

foreach ($form_items as $item_name => $item_params) {
	if (($item_params['type'] != 'password') && (isset ($_REQUEST[$item_name])))
		$item_params['value'] = $_REQUEST[$item_name];
}

$template_processor = SJB_System::getTemplateProcessor();
$template_processor->assign ("message", $message);
$template_processor->assign ("form_items", $form_items);
$template_processor->display ("adminpswd.tpl");