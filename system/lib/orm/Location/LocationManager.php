<?php

class SJB_LocationManager
{
	function saveLocation($location)
	{
		$location_sid = $location->getSID();
		if (is_null($location_sid)) {
			return SJB_DB::query("INSERT INTO locations(name, longitude, latitude) VALUES (?s, ?f, ?f)"
			, $location->name, $location->longitude, $location->latitude, false);
		}
		
		return SJB_DB::query("UPDATE locations SET name = ?s, longitude = ?f, latitude = ?f WHERE sid = ?n" 
		, $location->name, $location->longitude, $location->latitude, $location->getSID());
	}
	
	function getLocationsInfo()
	{
		return SJB_DB::query("SELECT * FROM locations ORDER BY sid");
	}
	
	function deleteLocationBySID($location_sid)
	{
		return SJB_DB::query("DELETE FROM locations WHERE sid = ?n", $location_sid);
	}
	
	function addLocation($name, $longitude, $latitude)
	{
		if (SJB_DB::query("INSERT INTO locations SET name = ?s, longitude = ?f, latitude = ?f",	$name, $longitude, $latitude, false))
			return 1;
		SJB_DB::query("UPDATE locations SET longitude = ?f, latitude = ?f WHERE name = ?s", $longitude, $latitude, $name);
		return 0;
	}
	
	function getLocationsInfoWithLimit($offset, $count, $where = '', $sorting_field, $sorting_order)
	{
		return SJB_DB::query("SELECT * FROM locations {$where} ORDER BY {$sorting_field} {$sorting_order} LIMIT $offset, $count");
	}
	
	function getLocationNumber($search = '')
	{
		$number = SJB_DB::query("SELECT count(*) FROM locations {$search}");
		return array_pop(array_pop($number));
	}
	
	function deleteAllLocations()
	{
		return SJB_DB::query("TRUNCATE TABLE locations");
	}
	
	function doesLocationExist($location_name) 
	{
		if (empty($location_name))
		    return false;
		$exists = SJB_DB::query("SELECT * FROM locations WHERE name = ?s", $location_name);
		return !empty($exists);		
	}
	
	function getLocationInfoBySID($location_sid)
	{
		$location_info = SJB_DB::query("SELECT * FROM locations WHERE sid = ?n", $location_sid);
		if (empty($location_info)) {
			return null;
		}
		return array_pop($location_info);
	}
}

