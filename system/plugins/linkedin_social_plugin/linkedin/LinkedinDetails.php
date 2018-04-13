<?php

require_once('orm/ObjectDetails.php');
require_once('orm/ObjectProperty.php');
require_once('classifieds/ListingField/ListingFieldManager.php');
require_once('classifieds/ListingType/ListingTypeManager.php');

class SJB_LinkedinDetails extends SJB_ObjectDetails
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
						'id'			=> 'li_apiKey',
						'caption'		=> 'Linkedin API Key',
						'type'			=> 'string',
						'length'		=> '255',
						'is_required'	=> true,
						'is_system'		=> true,
						'order'			=> -1,
					),
					array(
						'id'			=> 'li_secKey',
						'caption'		=> 'Linkedin Secret Key',
						'type'			=> 'string',
						'length'		=> '255',
						'is_required'	=> true,
						'is_system'		=> true,
						'order'			=> -0,
						'comment'		=> 'To get the LinkedIn API Key and Secret Key, go to https://www.linkedin.com/secure/developer, sign in and Add a New Application. After that you will be given the API Key and Secret Key which you need to insert in the appropriate fields above.',
					),
					array(
						'id'			=> 'linkedin_userGroup',
						'caption'		=> 'User Group', 
						'type'			=> 'multilist',
						'list_values'	=> $listing_info,
						'is_required'	=> false,
						'is_system'		=> true,
						'order'			=> 1,
						'comment'		=> 'Please select user groups which will use LinkedIn login/registration',
					),
					array(
						'id'			=> 'linkedin_resumeAutoFillSync',
						'caption'		=> 'Allow Resume auto filling/synchronizing for Job Seekers', 
						'type'			=> 'boolean',
						'is_required'	=> false,
						'is_system'		=> true,
						'order'			=> 1,
//						'comment'		=> 'Please select user groups which will use LinkedIn login/registration',
					),
					array(
						'id'			=> 'li_companyWidget',
						'caption'		=> 'Display Company Insider widget in company info block', 
						'type'			=> 'boolean',
						'is_required'	=> false,
						'is_system'		=> true,
						'order'			=> 1,
//						'comment'		=> 'Display Company Insider widget in company info block',
					),
					array(
						'id'			=> 'li_resumeWidget',
						'caption'		=> 'Display LinkedIn user profile widget on Resume page ', 
						'type'			=> 'boolean',
						'is_required'	=> false,
						'is_system'		=> true,
						'order'			=> 1,
//						'comment'		=> 'Display Company Insider widget in company info block',
					),
					array(
						'id'			=> 'li_allowPeopleSearch',
						'caption'		=> 'Allow LinkedIn People Search for Employers', 
						'type'			=> 'boolean',
						'is_required'	=> false,
						'is_system'		=> true,
						'order'			=> 1,
						'comment'		=> 'If this setting is turned on, Employers will have the option to include LinkedIn people search results into regular Resume search results',
					),
					array(
						'id'			=> 'li_allowShareJobs',
						'caption'		=> 'Allow Job Seekers to share Jobs on LinkedIn  ', 
						'type'			=> 'boolean',
						'is_required'	=> false,
						'is_system'		=> true,
						'order'			=> 1,
//						'comment'		=> 'If this setting is turned on, employers will have the option to include LinkedIn people search results into regular resume search results',
					),
		);

		return $system_details;
	}
	
}

