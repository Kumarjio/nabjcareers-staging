<?php

require_once("classifieds/ListingField/ListingField.php");
require_once("classifieds/ListingField/ListingFieldManager.php");
require_once("classifieds/ListingType/ListingTypeManager.php");
require_once("forms/Form.php");

$tp = SJB_System::getTemplateProcessor();
$listing_field_sid = SJB_Request::getVar('sid', null);
 
if (!is_null($listing_field_sid)) {
	
	$listing_field_info = SJB_ListingFieldManager::getFieldInfoBySID($listing_field_sid);
	$old_listing_field_id = $listing_field_info['id'];
	$listing_field_info = array_merge($listing_field_info, $_REQUEST);
	$listing_field = new SJB_ListingField($listing_field_info, $listing_field_info['listing_type_sid']);
	$listing_field->setSID($listing_field_sid);
	if (!in_array($listing_field->field_type, array('video', 'picture', 'file', 'complex'))) {
		$default_value = array
	            (
	                 'id'          => 'default_value',
	            	 'sid'         => isset($listing_field_info['sid'])?$listing_field_info['sid']:'',
	                 'caption'     => 'Default Value',
	            	 'value'       => isset($listing_field_info['default_value'])?$listing_field_info['default_value']:'',
	                 'type'        => $listing_field->field_type,
	                 'length'	   => '',
	                 'is_required' => false,
	                 'is_system'   => false,
	            );
	    $additionalParameters = array();
		switch ($listing_field->field_type) {
			case 'list': 
				if (isset($listing_field_info['list_values']))
					$additionalParameters = array('list_values' => $listing_field_info['list_values']);
				break;

			case 'multilist':
				if (isset($listing_field_info['list_values']))
					$additionalParameters = array('list_values' => $listing_field_info['list_values']);
				if (!is_array($default_value['value']))
					if (strpos($default_value['value'],','))
						$default_value['value'] = explode(',',$default_value['value']);
					else 
						$default_value['value'] = array($default_value['value']);
				break;

			case 'tree': 
				if (isset($listing_field_info['tree_values']))
					$additionalParameters = array('tree_values' => $listing_field_info['tree_values']);
				break;

			case 'monetary': 
				if (isset($listing_field_info['currency_values']))
					$default_value['currency_values'] = $listing_field_info['currency_values'];
				break;
		}
		$default_value = array_merge($default_value,$additionalParameters);
		$listing_field->addProperty($default_value);
		
		$user_groups = SJB_UserGroupManager::getAllUserGroupsInfo();
		$list_values = array();
		foreach ($user_groups as $user_group) {
			$list_values = array_merge($list_values, SJB_UserProfileFieldManager::getFieldsInfoByUserGroupSID($user_group['sid']));
		}
		
		$profile_field_as_dv = array
	            (
	                 'id'          => 'profile_field_as_dv',
	            	 'caption'     => 'Default Value', 
	            	 'value'       => (isset($listing_field_info['profile_field_as_dv']))?$listing_field_info['profile_field_as_dv']:'',
	                 'type'        => 'list',
	            	 'list_values' => $list_values,
	                 'length'	   => '',
	                 'is_required' => false,
	                 'is_system'   => false,
	            );
	   $listing_field->addProperty($profile_field_as_dv);
	   if (isset($listing_field_info['profile_field_as_dv']) && $listing_field_info['profile_field_as_dv'] != '')
	   		$tp->assign('profileFieldAsDV', true);
	}
	$form_submitted = SJB_Request::getVar('action', '') == 'save_info';

	// infil instructions should be the last element in form
	if ( 'tree' != $listing_field->getFieldType() && 'complex' != $listing_field->getFieldType() && 'ApplicationSettings' != $listing_field->getPropertyValue('id'))
	{
		if ( $form_submitted )
		{
			$listing_field->addInfillInstructions(SJB_Request::getVar('instructions'));
		}
		else
		{
			$listing_field->addInfillInstructions((isset($listing_field_info['instructions']) ? $listing_field_info['instructions'] : ''));
		}
	}
	
	$edit_form = new SJB_Form($listing_field);
	$edit_form->makeDisabled("type");
	
	$errors = array();
	
	if ($form_submitted && $edit_form->isDataValid($errors)) {
		SJB_ListingFieldManager::saveListingField($listing_field);
		SJB_ListingFieldManager::changeListingPropertyIDs($listing_field_info['id'], $old_listing_field_id);
		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings("SITE_URL") . "/edit-listing-type/?sid=" . $listing_field->getListingTypeSID());
	} else {
		$edit_form->registerTags($tp);
		$tp->assign("form_fields", $edit_form->getFormFieldsInfo());
		$tp->assign("errors", $errors);
		$tp->assign("listing_type_sid", $listing_field->getListingTypeSID());
		$tp->assign("field_type", $listing_field->getFieldType());
		$tp->assign("field_sid", $listing_field->getSID());
		$listing_type_info = SJB_ListingTypeManager::getListingTypeInfoBySID($listing_field->getListingTypeSID());
		$tp->assign("listing_type_info", $listing_type_info);
		$tp->assign("listing_field_info", $listing_field_info);
		$tp->display("edit_listing_type_field.tpl");
	}
}


