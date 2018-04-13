<?php


require_once("membership_plan/Packages.php");
require_once("membership_plan/ContractPackage.php");

class SJB_ContractPackagesManager {
	
	function createContractPackagesFromMembershipPlan($membership_plan_id, $contract_id) {
		$packages = SJB_Packages::getPackages($membership_plan_id);
		SJB_ContractPackagesManager::deletePackagesByContractID($contract_id);
		foreach ($packages as $package) {
			$package['id'] = null;
			$package['membership_plan_id'] = null;
			$package['contract_id'] = $contract_id;
			$contract_package = new SJB_ContractPackage($package);
			$contract_package->saveInDB();
		}
	}
	
	function getPackagesByClassName($class_name, $contract_id) {
		
		$packages = SJB_DB::query("SELECT * FROM contract_packages WHERE class_name = ?s AND contract_id = ?n", $class_name, $contract_id);
		
		foreach ($packages as $key => $package) {
				
			$packages[$key] = array_merge($packages[$key], unserialize($packages[$key]['fields']));
			
		}
		
		return $packages;
		
	}
	
	function getPackageInfoByPackageID($package_id) {
		
		$package = SJB_DB::query("SELECT * FROM contract_packages WHERE id = ?n", $package_id);
		
		$package = array_pop($package);
		
		$package = array_merge($package, unserialize($package['fields']));
		
		unset($package['fields']);
		
		return $package;
		
	}
	
	function deletePackagesByContractID($contract_id) {
        return SJB_DB::query("DELETE FROM contract_packages WHERE contract_id=?n", $contract_id);
    }
	
}

