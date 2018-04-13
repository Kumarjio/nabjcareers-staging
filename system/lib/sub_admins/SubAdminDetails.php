<?php

require_once("orm/ObjectDetails.php");
require_once("orm/ObjectProperty.php");
require_once("users/UserProfileField/UserProfileFieldManager.php");

class SJB_SubAdminDetails extends SJB_ObjectDetails
{

	var $properties;
	var $details;

	function __construct($user_info)
	{
		$details_info = self::getDetails();

		foreach ($details_info as $detail_info)
		{
			$detail_info['value'] = '';
			if (isset($user_info[$detail_info['id']]))
				$detail_info['value'] = $user_info[$detail_info['id']];

			$this->properties[$detail_info['id']] = new SJB_ObjectProperty($detail_info);
		}
	}

	public static function getDetails()
	{
		// TODO: change email and username types to unique
		$details = array(
			array(
				'id' => 'username',
				'caption' => 'Username',
				'type' => 'unique_string',
				'table_name' => 'subadmins',
				'length' => '20',
				'is_required' => true,
				'is_system' => true,
				'order' => 0,
			),
			array(
				'id' => 'email',
				'caption' => 'E-mail',
				'type' => 'unique_email',
				'table_name' => 'subadmins',
				'length' => '20',
				'is_required' => true,
				'is_system' => true,
				'order' => 1,
			),
			array(
				'id' => 'password',
				'caption' => 'Password',
				'type' => 'password',
				'length' => '20',
				'is_required' => true,
				'is_system' => true,
				'order' => 2,
			)
		);

//		$user_profile_field_manager = new SJB_UserProfileFieldManager();
//		$extra_details = $user_profile_field_manager->getFieldsInfoByUserGroupSID($user_group_sid);
//
//		foreach ($extra_details as $key => $extra_detail)
//		{
//			$extra_details[$key]['is_system'] = false;
//		}
//		$details = array_merge($details, $extra_details);

		return $details;
	}

}
