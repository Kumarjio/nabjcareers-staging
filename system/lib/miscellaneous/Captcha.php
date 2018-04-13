<?php
require_once 'orm/Object.php';
require_once 'orm/ObjectDetails.php';
require_once 'orm/ObjectProperty.php';

class SJB_Captcha extends SJB_Object
{
	public $details = null;
	
	function SJB_Captcha($info = array(), $type = false)
	{
		$this->details = new SJB_CaptchaDetails($info, $type);
	}
}

class SJB_CaptchaDetails extends SJB_ObjectDetails
{
	var $properties;
	var $details;

	function SJB_CaptchaDetails($info, $type = false)
	{
		$details_info = self::getDetails($type);

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
	
	public static function getDetails($type = false)
	{
		$details =  array
			   (
					array
					(
						'id'		=> 'captcha',
						'caption'	=> 'Enter code from image', 
						'type'		=> 'captcha',
						'length'	=> '20',
						'windowType'=> $type,
						'is_required'=> true,
						'is_system'=> true,
						'order'			=> 1,
					),
				);
				
		return $details;
	}
}
	