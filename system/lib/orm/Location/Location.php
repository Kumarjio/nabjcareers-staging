<?php

class SJB_Location
{
	public $sid;
	public $name;
	public $longitude;
	public $latitude;
	
	public function __construct($location_info = null)
	{
		$this->name = isset($location_info['name']) ? $location_info['name'] : null;
		$this->longitude = isset($location_info['longitude']) ? $location_info['longitude'] : null;
		$this->latitude = isset($location_info['latitude']) ? $location_info['latitude'] : null;
	}
	
	function getInfo()
	{
	    return array(
	        'name' => $this->name,
	        'longitude' => $this->longitude,
	        'latitude' => $this->latitude
	    );
	}
	
	function isDataValid(&$errors)
	{
		
		$errors = array();
		
		if ($this->name == '')
		    $errors['Name'] = 'EMPTY_VALUE';
		
		if ($this->longitude == '') {
			$errors['Longitude'] = 'EMPTY_VALUE';
		} else if (!is_numeric($this->longitude)) {
			$errors['Longitude'] = 'NOT_FLOAT_VALUE';
		}
		
		if ($this->latitude == '') {
			$errors['Latitude'] = 'EMPTY_VALUE';
		} elseif (!is_numeric($this->latitude)) {
			$errors['Latitude'] = 'NOT_FLOAT_VALUE';
		}
		
		return count($errors) == 0;
	}
	
	function setSID($location_sid)
	{
		$this->sid = $location_sid;
	}
	
	function getSID()
	{
		return $this->sid;
	}
}
