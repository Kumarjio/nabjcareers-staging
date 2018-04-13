<?php

class SJB_PackageSQL
{
	function getPackages($membership_plan_id)
	{
		$results = SJB_DB::query("SELECT * FROM packages WHERE membership_plan_id=?n  ORDER BY `order`", $membership_plan_id);
		if ($results && sizeof($results)) {
			foreach ($results as $key => $package)
				$results[$key]['fields'] = unserialize(stripslashes($package['fields']));				
		}
		return $results;
	}
	
	function getPackageByID($id)
	{		
		$result = SJB_DB::query("SELECT * FROM packages WHERE id=?n", $id);	
		if ($result) {		
			$result = array_pop($result);
			$result['fields'] = unserialize(stripslashes($result['fields']));
		}
		return $result;
	}
	
	function update($id, $fields)
	{		
		$details = serialize($fields);		
		$result = SJB_DB::query("UPDATE `packages` SET `fields`=?s WHERE `id`=?n", $details, $id);
	}
	
	function insert($class_name, $membership_plan_id, $fields)
	{		
		$details = serialize($fields);
		return SJB_DB::query("INSERT INTO packages(`fields`, class_name, membership_plan_id) VALUES(?s, ?s, ?n)", 
				$details, $class_name, $membership_plan_id);
	}
	
	function getListingQuantity($package_id)
	{
		$result = SJB_DB::query("SELECT COUNT(listing_sid) FROM listing_packages WHERE package_id=?n", $package_id);
		if ($result)
		    return array_pop(array_pop($result));
	}
	
	function delete($id)
	{
		return SJB_DB::query("DELETE FROM packages WHERE id=?n", $id);
	}
}

