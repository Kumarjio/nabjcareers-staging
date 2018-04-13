<?php

require_once('orm/ObjectDetails.php');
require_once('orm/ObjectProperty.php');
require_once('classifieds/ListingField/ListingFieldManager.php');
require_once('classifieds/ListingType/ListingTypeManager.php');

class SJB_TwitterDetails extends SJB_ObjectDetails
{
	var $properties;
	var $details;
	var $common_fields;

	function SJB_TwitterDetails($info)
	{
		$this->common_fields = self::getCommonFields();
		$details_info = SJB_TwitterDetails::getDetails($this->common_fields);
		
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
			elseif ($detail_info['id'] == 'hash_tags')
				$detail_info['value'] = '#Jobs';
			elseif ($detail_info['id'] == 'post_template')
				$detail_info['value'] = '{$user.CompanyName}: {$listing.Title} ({$listing.City}, {$listing.State})';
			$this->properties[$detail_info['id']] = new SJB_ObjectProperty($detail_info);
		}
	}
	
	public static function getDetails($common_details)
	{
		$listing_info = array();
		foreach (SJB_ListingTypeManager::getAllListingTypesInfo() as $key => $val) {
			$listing_info[$key]['id'] = $val['sid'];
			$listing_info[$key]['caption'] = $val['name'];
		}
		foreach ($common_details as $key => $val) {
			if ($val['id'] == 'Title')
				unset($common_details[$key]);
			else {
				$common_details[$key]['is_required'] = false;
			}
		}
		$system_details = array(
                    array(
						'id'			=> 'username',
						'caption'		=> 'Twitter Username',
						'type'			=> 'unique_string',
                    	'table_name'	=> 'twitter',
						'length'		=> '20',
						'is_required'	=> true,
						'is_system'		=> true,
						'order'			=> -2,
					),
					array(
						'id'			=> 'consumerKey',
						'caption'		=> 'Twitter API Consumer Key',
						'type'			=> 'string',
						'length'		=> '255',
						'is_required'	=> true,
						'is_system'		=> true,
						'order'			=> -1,
					),
					array(
						'id'			=> 'consumerSecret',
						'caption'		=> 'Twitter API Consumer Secret',
						'type'			=> 'string',
						'length'		=> '255',
						'is_required'	=> true,
						'is_system'		=> true,
						'order'			=> -0,
					),
					array(
						'id'			=> 'bitLyUsername',
						'caption'		=> 'bit.ly Username',
						'type'			=> 'string',
						'length'		=> '255',
						'is_required'	=> true,
						'is_system'		=> true,
						'order'			=> 0.25,
					),
					array(
						'id'			=> 'bitLyAPIKey',
						'caption'		=> 'bit.ly API Key',
						'type'			=> 'string',
						'length'		=> '255',
						'is_required'	=> true,
						'is_system'		=> true,
						'order'			=> 0.5,
					),
					array(
						'id'			=> 'listing_type_sid',
						'caption'		=> 'Listing Type', 
						'type'			=> 'list',
						'list_values'	=> $listing_info,
						'is_required'	=> true,
						'is_system'		=> true,
						'order'			=> 1,
					),
					array(
						'id'			=> 'update_every',
						'caption'		=> 'Update every', 
						'type'			=> 'integer',
						'length'		=> '20',
						'is_required'	=> true,
						'is_system'		=> true,
						'order'			=> 100,
					),
					array(
						'id'			=> 'hash_tags',
						'caption'		=> 'Hash tags', 
						'type'			=> 'string',
						'length'		=> '20',
						'is_required'	=> false,
						'is_system'		=> true,
						'order'			=> 1000,
					),
					array(
						'id'			=> 'post_template',
						'caption'		=> 'Twitter post template', 
						'comment'		=> 'Link to listing details page and hash tags will be added automatically to the end of each post.', 
						'type'			=> 'string',
						'length'		=> '20',
						'is_required'	=> true,
						'is_system'		=> true,
						'order'			=> 10000,
					)
		);

		return array_merge($system_details, $common_details);
	}
	
	public static function getCommonFields() 
	{
		$listing_field_manager = new SJB_ListingFieldManager();
		$common_details = $listing_field_manager->getCommonListingFieldsInfo();
		foreach ($common_details as $key => $details) {
			if ($details['type'] == 'video')
				unset($common_details[$key]);
			else
				$common_details[$key]['is_required'] = 0;
		}
		return $common_details;
	}
}