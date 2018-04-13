<?php

require_once('membership_plan/MembershipPlan.php');
require_once('membership_plan/MembershipPlanManager.php');
require_once('membership_plan/ContractSQL.php');
require_once('membership_plan/PackagesManager.php');

class SJB_Contract
{
	var $contract_id 			= null;
	var $user_sid  				= null;
	var $membership_plan_id 	= null;
	var $expired_date 			= null;
	var $price;
	var $id;
	private $recurring_id		= null;
	private $gateway_id			= null;
	
	function SJB_Contract($input_info)
	{
		if ( isset($input_info['contract_id']) ) {
			$this->contract_id = $input_info['contract_id'];
		}
		
		if ( isset($input_info['recurring_id']) ) {
			$this->recurring_id = $input_info['recurring_id'];
		}
		
		if ( isset($input_info['gateway_id']) ) {
			$this->gateway_id = $input_info['gateway_id'];
		}
		
		if ( isset($input_info['membership_plan_id']) ) {			
			$this->_constructorByMembershipPlan($input_info['membership_plan_id']);
		} else {
			$this->_constructorByID($input_info['contract_id']);
		}
		if (isset($input_info['user_sid']) && $input_info['user_sid'] != false)
			$this->user_sid = $input_info['user_sid'];
	}
	 
    function isExpired()
    {
    	return false;
    }
    
    function saveInDB()
    {
    	$result = SJB_ContractSQL::insert($this->_getHashedFields());
    	if ($result) {
    		if (!$this->id) {
    			$this->id = $result;
    		}
    		SJB_ContractSQL::updateContractExtraInfoByMembershipPlanID($this->id, $this->membership_plan_id);
    		SJB_Acl::copyPermissions($this->membership_plan_id, $this->id);
    	}
    	
    	return (bool)$result;
    }

	function _getHashedFields()
	{
		$fields['membership_plan_id'] 	= $this->membership_plan_id;
		$fields['creation_date']		= date("Y-m-d");
		$fields['expired_date']			= $this->expired_date;
		$fields['contract_id']			= $this->id;
		$fields['user_sid']				= $this->user_sid;
		$fields['recurring_id']			= $this->recurring_id;
		$fields['gateway_id']			= $this->gateway_id;
		return $fields;
	}

	function _constructorByID($id)
	{
		$contract_info = SJB_ContractSQL::selectInfoByID($id);
		if ($contract_info) {
			$this->id = $id;
			$this->contract_id	  		= $contract_info['id'];
			$this->price				= $contract_info['price'];
			$this->membership_plan_id 	= $contract_info['membership_plan_id'];
			$this->expired_date 		= $contract_info['expired_date'];
			$this->user_sid				= $contract_info['user_sid'];
			$this->extra_info 			= is_null($contract_info['serialized_extra_info']) ? null : unserialize($contract_info['serialized_extra_info']);
		}
	}
	
	function _constructorByMembershipPlan($membership_plan_id)
	{
		$this->membership_plan_id = $membership_plan_id;
		$membership_plan = new SJB_MembershipPlan(array('id' => $membership_plan_id));
		$subscriptionPeriod = $membership_plan->getSubscriptionPeriod();
		if ($subscriptionPeriod) {
			if (!empty($this->recurring_id)) // Для рекьюринг планов, делаем запас для проплаты в 1 день
				$subscriptionPeriod++;
			$this->expired_date = date("Y-m-d", strtotime("+" . $subscriptionPeriod . " day"));
		}
		
		$this->price = $membership_plan->getPrice();
	}
	
	function getPrice()
	{
		return $this->price;
	}
	
	function getID()
	{
		return $this->id;
	}
	
	function setUserSID($user_sid)
	{
		$this->user_sid = $user_sid;
	}
	
	function getUserSID()
	{
		return $this->user_sid;
	}
	
	function getPackagesInfo($class_name)
	{
		return SJB_PackagesManager::getPackagesByClassName($class_name, $this->membership_plan_id);
	}
	
	function getPackageInfoByPackageID($package_id)
	{
		return SJB_PackagesManager::getPackageInfoByPackageID($package_id);
	}
	
	function getListingPackagesInfo()
	{
		return $this->getPackagesInfo("ListingPackage");
	}
	
	function isListingPackageAvailableByID($package_id)
	{
		$listing_packages_info = $this->getListingPackagesInfo();
		foreach ($listing_packages_info as $listing_package_info) {
			if ($listing_package_info['id'] == $package_id) {
				return true;
			}
		}
		return false;
	}
    
    function delete()
    {
        return SJB_ContractSQL::delete($this->contract_id);   
    }
}
