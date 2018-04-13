<?php

require_once('orm/ObjectDetails.php');
require_once('orm/ObjectProperty.php');
require_once('classifieds/ListingField/ListingFieldManager.php');
require_once('classifieds/ListingType/ListingTypeManager.php');

class SJB_FacebookDetails extends SJB_ObjectDetails
{
	var $properties;
	var $details;
	var $common_fields;

	function __construct()
	{
		$details_info = self::getDetails();
		
		foreach ($details_info as $index => $property_info) {
			$sort_array[$index] = $property_info['order'];
		}

		$sort_array = SJB_HelperFunctions::array_sort($sort_array);

        foreach ($sort_array as $index => $value) {
			$sorted_details_info[$index] = $details_info[$index];
		}

		foreach ($sorted_details_info as $detail_info) {
		    $detail_info['value'] = '';
			if (isset($info[$detail_info['id']]))
				$detail_info['value'] = $info[$detail_info['id']];
			$this->properties[$detail_info['id']] = new SJB_ObjectProperty($detail_info);
		}
	}
	
	public static function getDetails()
	{
		$listing_info = array();
		
		foreach (SJB_UserGroupManager::getAllUserGroupsInfo() as $key => $val) {
			array_push($listing_info, array('id' => $val['sid'], 'caption' => $val['name']));
		}
		
		$system_details = array(
					array(
						'id'			=> 'fb_appID',
						'caption'		=> 'Facebook appID Key',
						'type'			=> 'string',
						'length'		=> '255',
						'is_required'	=> true,
						'is_system'		=> true,
						'order'			=> -1,
					),
					array(
						'id'			=> 'fb_appSecret',
						'caption'		=> 'App Secret Key',
						'type'			=> 'string',
						'length'		=> '255',
						'is_required'	=> true,
						'is_system'		=> true,
						'order'			=> -0,
						'comment'		=> 'To get the Facebook appID Key and App Secret Key, go to http://www.facebook.com/developers/createapp.php, sign in and Create a New App. After that you will be given the appID Key and App Secret Key which you need to insert in the appropriate fields above.'
					),
					array(
						'id'			=> 'facebook_userGroup',
						'caption'		=> 'User Group', 
						'type'			=> 'multilist',
						'list_values'	=> $listing_info,
						'is_required'	=> false,
						'is_system'		=> true,
						'order'			=> 1,
						'comment'		=> 'Please select user groups which will use Facebook connect',
					),
					array(
						'id'			=> 'facebook_resumeAutoFillSync',
						'caption'		=> 'Allow Resume auto filling/synchronizing for Job Seekers', 
						'type'			=> 'boolean',
						'is_required'	=> false,
						'is_system'		=> true,
						'order'			=> 1,
//						'comment'		=> 'Please select user groups which will use LinkedIn login/registration',
					),
//					array(
//						'id'			=> 'fb_shareJob',
//						'caption'		=> 'Allow Job sharing on FaceBook', 
//						'type'			=> 'boolean',
//						'is_required'	=> false,
//						'is_system'		=> true,
//						'order'			=> 1,
//					),
//					array(
//						'id'			=> 'fb_shareResume',
//						'caption'		=> 'Allow Resume sharing on FaceBook', 
//						'type'			=> 'boolean',
//						'is_required'	=> false,
//						'is_system'		=> true,
//						'order'			=> 1,
//					),
					array(
						'id'			=> 'fb_likeJob',
						'caption'		=> 'Display “Like” FaceBook icon for Jobs', 
						'type'			=> 'boolean',
						'is_required'	=> false,
						'is_system'		=> true,
						'order'			=> 1,
					),
					array(
						'id'			=> 'fb_likeResume',
						'caption'		=> 'Display “Like” FaceBook icon for Resumes', 
						'type'			=> 'boolean',
						'is_required'	=> false,
						'is_system'		=> true,
						'order'			=> 1,
					),
		);

		return $system_details;
	}
	
}

