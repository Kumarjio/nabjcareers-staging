<?php

require_once 'forms/Form.php';
require_once 'users/UserProfileField/UserProfileField.php';
require_once 'users/UserProfileField/UserProfileFieldManager.php';
require_once 'users/UserGroup/UserGroupManager.php';

$tp = SJB_System::getTemplateProcessor();
$user_group_sid = SJB_Request::getVar('user_group_sid', null);
$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid);
$user_profile_field_sid = SJB_Request::getVar('sid', null);

if (!is_null($user_profile_field_sid)) {
	$user_profile_field_info = SJB_UserProfileFieldManager::getFieldInfoBySID($user_profile_field_sid);
	$user_profile_field_old_id = $user_profile_field_info['id'];
	$user_profile_field_info = array_merge($user_profile_field_info, $_REQUEST);
	$user_profile_field = new SJB_UserProfileField($user_profile_field_info);
	$user_profile_field->setSID($user_profile_field_sid);
	$user_profile_field->setUserGroupSID($user_group_sid);
	
	if (!in_array($user_profile_field->field_type, array('video', 'picture', 'file'))) {
		$default_value = array
	            (
	                 'id'          => 'default_value',
	            	 'sid'         => isset($user_profile_field_info['sid']) ? $user_profile_field_info['sid'] : '',
	                 'caption'     => 'Default Value', 
	            	 'value'       => isset($user_profile_field_info['default_value']) ? $user_profile_field_info['default_value'] : '',
	                 'type'        => $user_profile_field->field_type,
	                 'length'	   => '',
	                 'is_required' => false,
	                 'is_system'   => false,
	            );

	    $additionalParameters = array();
		switch ($user_profile_field->field_type) {
			case 'list': 
				if (isset($user_profile_field_info['list_values']))
					$additionalParameters = array('list_values' => $user_profile_field_info['list_values']);
				break;
			case 'multilist':
				if (isset($user_profile_field_info['list_values']))
					$additionalParameters = array('list_values' => $user_profile_field_info['list_values']);
				if (!is_array($default_value['value']))
					if (strpos($default_value['value'], ','))
						$default_value['value'] = explode(',', $default_value['value']);
					else 
						$default_value['value'] = array($default_value['value']);
				break;
			case 'tree': 
				if (isset($user_profile_field_info['tree_values']))
					$additionalParameters = array('tree_values' => $user_profile_field_info['tree_values']);
				break;
		}
		$default_value = array_merge($default_value,$additionalParameters);
		$user_profile_field->addProperty($default_value);
	}

	if (in_array($user_profile_field->field_type, array('tree', 'multilist', 'list'))) {
		$sort_by_alphabet = array(
					'id'		=> 'sort_by_alphabet',
					'caption'	=> 'Sort Values By Alphabet',
					'value'		=> (isset($user_profile_field_info['sort_by_alphabet']) ? $user_profile_field_info['sort_by_alphabet'] : ''),
					'type'		=> 'boolean',
					'lenght'	=> '',
					'is_required' => false,
					'is_system'	=> false,
				);
		$user_profile_field->addProperty($sort_by_alphabet);
	}

	$edit_form = new SJB_Form($user_profile_field);
	$form_submitted = SJB_Request::getVar('action', '') == 'save_info';
	
	// infill instructions should be the last element in form
	// no instructions for tree field type
	if ( 'tree' != $user_profile_field->getFieldType() && 'complex' != $user_profile_field->getFieldType() )
	{
		if ( $form_submitted )
		{
			$user_profile_field->addInfillInstructions(SJB_Request::getVar('instructions'));
		}
		else
		{
			$user_profile_field->addInfillInstructions((isset($user_profile_field_info['instructions']) ? $user_profile_field_info['instructions'] : ''));
		}
	}
	
	/**
	 * "Display as" options for TREE TYPE
	 */
	if ('tree' == $user_profile_field->getFieldType())
	{
		$user_profile_field->addProperty(SJB_TreeType::getDisplayAsDetail((isset($user_profile_field_info['display_as_select_boxes']) ? $user_profile_field_info['display_as_select_boxes'] : '')));
		$treeLevelsNumber = SJB_UserProfileFieldTreeManager::getTreeDepthBySID($user_profile_field_sid);
		$tp->assign('tree_levels_number', $treeLevelsNumber);

		// treee levels captions
		for ($i=1; $i<=$treeLevelsNumber; $i++)
		{
			$levelID = 'level_'.$i;
			$user_profile_field->addProperty(
					array(
						'id' => $levelID,
						'caption' => $i . ' Level Name',
						'value' => (isset($user_profile_field_info[$levelID])) ? $user_profile_field_info[$levelID] : '',
						'type' => 'string',
						'length' => '250',
						'is_required' => false,
						'is_system' => false,
					)
			);
		} //	for( $i == 1; $i >= $treeLevelsNumber; $i++ )
	} // 	if ( 'tree' == $listing_field->getFieldType() )
	/*
	 * end of ""Display as" options for TREE TYPE"
	 */

	$edit_form = new SJB_Form($user_profile_field);

	$errors = array();

	if ($form_submitted && $edit_form->isDataValid($errors)) {
		SJB_UserProfileFieldManager::saveUserProfileField($user_profile_field);
		$user_profile_field_new_id = $user_profile_field_info['id'];
		if ($user_profile_field_old_id != $user_profile_field_new_id) {
			SJB_UserProfileFieldManager::changeUserPropertyIDs($user_group_sid, $user_profile_field_old_id, $user_profile_field_new_id);
		}
		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/edit-user-profile/?user_group_sid=' . $user_group_sid);
	}
	else {
		$edit_form->registerTags($tp);
		$edit_form->makeDisabled('type');
		$tp->assign('user_group_sid', $user_group_sid);
		$tp->assign('form_fields', $edit_form->getFormFieldsInfo());
		$tp->assign('errors', $errors);
		$tp->assign('field_type', $user_profile_field->getFieldType());
		$tp->assign('user_profile_field_info', $user_profile_field_info);
		$tp->assign('user_profile_field_sid', $user_profile_field_sid);
		$tp->assign('user_group_info', $user_group_info);
		$tp->display('edit_user_profile_field.tpl');
	}
}

