<?php

require_once("ObjectMother.php");
require_once('sub_admins/SubAdminAcl.php');
require_once('sub_admins/SubAdminManager.php');

$tp = SJB_System::getTemplateProcessor();

$subAdminSID = SJB_SubAdmin::getSubAdminSID();

// if subAdminSID is not defined - control is passed back to the calling file
//if (empty($subAdminSID))
//{
//	return;
//}


if (!empty($subAdminSID) && $adminInfo = SJB_SubAdmin::getSubAdminInfo())
{
	// save sub admin notifications via ajax;
	SJB_SubAdminManager::SaveSubAdminNotifications($subAdminSID, SJB_Request::getVar('name',''), SJB_Request::getVar('value'));

	$message = '';
	$editedSubAdminInfo = $_REQUEST;
	$subAdminNewInfo = array_merge($adminInfo, $editedSubAdminInfo);

	// create subAdmin object
	$oSubAdmin = SJB_ObjectMother::createSubAdmin($subAdminNewInfo);
	$oSubAdmin->setSID($adminInfo['sid']);
	$oSubAdmin->makePropertyNotRequired("username");
	$oSubAdmin->makePropertyNotRequired("email");
	$oSubAdmin->makePropertyNotRequired("password");

	$oSubAdmin->addProperty(array(
		'id' => 'password_cur',
		'caption' => 'Current Password',
		'type' => 'password',
		'length' => '20',
//				'is_required' => true,
		'is_system' => true,
		'order' => 1,
	));
	$oSubAdmin->setPropertyValue('password_cur', SJB_Request::getVar('password_cur', ''));

	// permissions
	$acl = SJB_SubAdminAcl::getInstance();

	$type = 'subadmin';
	$resources = $acl->getResources();
	$perms = SJB_SubAdminAcl::getAllPermissions($type, $oSubAdmin->getSID());
	// /permissions

	SJB_SubAdminAcl::mergePermissionsWithResources($resources, $perms);

	$errors = array();
	$action = SJB_Request::getVar('action', '');

	if ('save' == $action)
	{
		$registration_form = SJB_ObjectMother::createForm($oSubAdmin);
		$registration_form->registerTags($tp);

//		$oSubAdmin->deleteProperty('username');

		if ($adminInfo['email'] == $subAdminNewInfo['email'])
		{
			$oSubAdmin->deleteProperty('email');
		}
//		$oSubAdmin->makePropertyNotRequired("email");
//		$oSubAdmin->makePropertyNotRequired("username");

		$password_value = $oSubAdmin->getPropertyValue('password');

		if (!empty($password_value['original']))
		{
			$currentPass = $oSubAdmin->getPropertyValue('password_cur');

			if (!empty($currentPass))
			{
				if (!SJB_SubAdmin::checkCurrentPassword($currentPass))
				{
					$oSubAdmin->deleteProperty('password');
					$errors['CurrentPassword'] = 'Administrator Current Password is Incorrect';
				}
			}
			else
			{
				$oSubAdmin->deleteProperty('password');
				$errors['CurrentPassword'] = 'Administrator Current Password is Required';
			}
		}
		else
		{
			$oSubAdmin->deleteProperty('password');
		}
		$oSubAdmin->deleteProperty('password_cur');
		
		if (empty($errors) && $registration_form->isDataValid($errors))
		{
			require_once('sub_admins/SubAdminManager.php');

			// save subAdmin
//			if (SJB_SubAdminManager::saveSubAdmin($oSubAdmin))
//			{
//			}
			SJB_SubAdminManager::saveSubAdmin($oSubAdmin);
			SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/edit-profile/?saved=1');
			
		}	// if ($registration_form->isDataValid($errors))
	}

	$oSubAdmin->deleteProperty('password');
	$oSubAdmin->deleteProperty('password_cur');
	$oSubAdmin->addProperty(array(
		'id' => 'password_cur',
		'caption' => 'Current Password',
		'type' => 'password_cur',
		'length' => '20',
//				'is_required' => true,
		'is_system' => true,
		'order' => 1,
	));
	$oSubAdmin->addProperty(array(
		'id' => 'password',
		'caption' => 'New Password',
		'type' => 'password',
		'length' => '20',
//				'is_required' => true,
		'is_system' => true,
		'order' => 1,
	));
	
	$registration_form = SJB_ObjectMother::createForm($oSubAdmin);
	$registration_form->registerTags($tp);
	$registration_form->makeDisabled('username');

	$tp->assign("saved", SJB_Request::getVar('saved', false));
	$tp->assign("errors", $errors);
	$tp->assign("form_fields", $registration_form->getFormFieldsInfo());
	$tp->assign('groups', SJB_SubAdminAcl::getPermissionGroups($resources));
	
//	SJB_SubAdminAcl::prepareSubPermissions($resources);
	$tp->assign('notifications', SJB_SubAdminAcl::getSubAdminNotifications($resources, $perms));
	$tp->assign('resources', $resources);
	$tp->assign('type', $type);
	$tp->assign('sid', $subAdminNewInfo['sid']);
	$tp->assign('message', $message);

	$tp->display("edit_subadmin_profile.tpl");
}

