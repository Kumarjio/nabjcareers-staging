<?php

class SJB_PackagesManager
{
	function getPackagesByClassName($class_name, $membership_plan_id)
	{
		$packages = SJB_DB::query("SELECT * FROM packages WHERE class_name = ?s AND membership_plan_id = ?n ORDER BY `order`", $class_name, $membership_plan_id);
		foreach ($packages as $key => $package) {
			$packages[$key] = array_merge($packages[$key], unserialize($packages[$key]['fields']));
		}
		return $packages;
	}
	
	function getPackagesByClassNameAndMembershipPlansID($class_name, $membership_plans_id)
	{
		$packages = SJB_DB::query("SELECT * FROM packages WHERE class_name = ?s AND membership_plan_id in ({$membership_plans_id}) ORDER BY `order`", $class_name);
		foreach ($packages as $key => $package) {
			$packages[$key] = array_merge($packages[$key], unserialize($packages[$key]['fields']));
		}
		return $packages;
	}

	function getPackagesByClass($class_name)
	{
		$packages = SJB_DB::query("SELECT * FROM packages WHERE class_name = ?s  ORDER BY `order`", $class_name);

		foreach ($packages as $key => $package) {
			$package_fields = stripslashes($package['fields']);
			$packages[$key] = array_merge($package, unserialize($package_fields));
		}

		return $packages;
	}

	
	function getPackageInfoByPackageID($package_id)
	{
		$package = SJB_DB::query("SELECT * FROM packages WHERE id = ?n", $package_id);
		$package = array_pop($package);
		$package = array_merge($package, unserialize($package['fields']));
		unset($package['fields']);
		return $package;
	}
	
	function deleteMembershipPlanPackages($mp_id)
	{
		$result = SJB_DB::query("DELETE FROM packages WHERE membership_plan_id=?n", $mp_id);
		if(self::rebuildPackagesOrderBySID($mp_id))
			SJB_Logger::error('Error! Can\'t order packages by membership_plan_sid');
        return $result;
    }
    
	function moveUpPackageBySID($membership_plan_sid, $package_id)
	{
		if (self::rebuildPackagesOrderBySID($membership_plan_sid))
			SJB_Logger::error('Error! Can\'t order packages by membership_plan_sid');
		
		$package_info = SJB_DB::query("SELECT * FROM packages WHERE  membership_plan_id = ?n AND id = ?n", $membership_plan_sid, $package_id);
		if (empty($package_info))
			return false;
			
		$package_info = array_pop($package_info);
		$current_order = $package_info['order'];
		$up_order = SJB_DB::query("SELECT MAX(`order`) FROM packages WHERE `order` < ?n  AND membership_plan_id = ?n", 
								$current_order, $membership_plan_sid);
		$up_order = array_pop(array_pop($up_order));
		if ($up_order == 0) 
			return false;
		
		SJB_DB::query("UPDATE packages SET `order` = ?n WHERE `order` = ?n  AND membership_plan_id = ?n", $current_order, $up_order, $membership_plan_sid);
		SJB_DB::query("UPDATE packages SET `order` = ?n WHERE membership_plan_id = ?n AND id = ?n", $up_order, $membership_plan_sid, $package_id);
		return true;
	}
	
	function moveDownPackageBySID($membership_plan_sid, $package_id)
	{
		if (self::rebuildPackagesOrderBySID($membership_plan_sid))
			SJB_Logger::error('Error! Can\'t order packages by membership_plan_sid');
		
		$package_info = SJB_DB::query("SELECT * FROM packages WHERE  membership_plan_id = ?n AND id = ?n", $membership_plan_sid, $package_id);
		if (empty($package_info)) 
			return false;
		
		$package_info = array_pop($package_info);
		$current_order = $package_info['order'];
		$less_order = SJB_DB::query("SELECT MIN(`order`) FROM packages WHERE `order` > ?n AND membership_plan_id = ?n", 
								$current_order, $membership_plan_sid);
		$less_order = array_pop(array_pop($less_order));
		if ($less_order == 0) 
			return false;
		SJB_DB::query("UPDATE packages SET `order` = ?n WHERE `order` = ?n AND membership_plan_id = ?n",
					$current_order, $less_order, $membership_plan_sid);
		SJB_DB::query("UPDATE packages SET `order` = ?n WHERE membership_plan_id = ?n AND id = ?n", $less_order, $membership_plan_sid, $package_id);
		return true;
	}
	
	function rebuildPackagesOrderBySID($membership_plan_sid)
	{
		$packages = SJB_DB::query("SELECT * FROM packages WHERE  membership_plan_id = ?n ORDER BY `order` ASC", $membership_plan_sid);
		if (empty($packages))
			return false;
		$i = 1;
		foreach($packages as $package) {
			SJB_DB::query("UPDATE packages SET `order` = ?n WHERE `id` = ?n AND membership_plan_id = ?n", $i, $package['id'], $package['membership_plan_id']);
			$i++;
		}
	}
	
}

