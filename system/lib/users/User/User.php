<?php

require_once('orm/Object.php');
require_once('membership_plan/ContractManager.php');
require_once('UserDetails.php');

class SJB_User extends SJB_Object
{
	
	var $user_group_sid;
	var $contract_id;
	var $activation_key   = null;
	var $verification_key = null;
	private $subuserInfo  = array();
	
	/**
	 * @var int Parent user id
	 */
	public $parent = 0;

	function SJB_User($user_info = array(), $user_group_sid = 0)
	{
		$this->setUserGroupSID($user_group_sid);
		$this->db_table_name = 'users';
		$this->details = new SJB_UserDetails($user_info, $user_group_sid);
		if (isset($user_info['contract_id'])) {
			$this->setContractID($user_info['contract_id']);
		}
		if (!$this->hasContract()) {
			$this->setContractID(false);
		}
	}
	
	public function isSubuser()
	{
		return !empty($this->subuserInfo);
	}
	
	public function setSubuserInfo($subuserInfo)
	{
		$this->subuserInfo = $subuserInfo;
	}
	
	public function getSubuserInfo()
	{
		return $this->subuserInfo;
	}
	
	public function setParent($parentSID)
	{
		$this->parent = $parentSID;
	}
	
	public function getParent()
	{
		return $this->parent;
	}
	
	public function addParentProperty($value = 0)
	{
		$this->details->addProperty(
			array (
				'id'			=> 'parent_sid',
				'caption'		=> 'Parent SID',
				'type'			=> 'integer',
				'is_system'		=> true,
				'value'			=> $value
			));
	}
	
	public function addUserGroupProperty($groupID = null)
	{
		$user_groups_info = SJB_UserGroupManager::getAllUserGroupsInfo();
		$list_values = array();
		foreach ($user_groups_info as $user_group) {
			$list_values[] = array('id' => $user_group['id'], 'caption' => $user_group['name']);
		}

		$this->addProperty(
			array(
				'id'			=> 'user_group',
				'type'			=> 'list',
				'value'			=> $groupID,
				'is_system' 	=> true,
				'list_values' 	=> $list_values,
			)
		);

		return array(
			'id' 				 => 'user_group',
			'real_id' 			 => 'user_group_sid',
			'transform_function' => 'SJB_UserGroupManager::getUserGroupSIDByID',
		);
	}
	
	public function addMembershipPlanProperty($membershipPlan = null, $userGroupSID = false)
	{
		if ($userGroupSID)
			$membershipPlanInfo = SJB_MembershipPlanManager::getPlansInfoByGroupSID($userGroupSID);
		else
			$membershipPlanInfo = SJB_MembershipPlanManager::getAllMembershipPlansInfo();
		$list_values = array();
		foreach ($membershipPlanInfo as $membership_plan) {
			$list_values[] = array('id' => $membership_plan['id'], 'caption' => $membership_plan['name']);
		}

		$this->addProperty(
			array(
				'id'			=> 'membership_plan',
				'type'			=> 'list',
				'value'			=> $membershipPlan,
				'is_system' 	=> true,
				'list_values' 	=> $list_values,
			)
		);
	}
	
	public function addRegistrationDateProperty($registrationDate = null)
	{
		$this->addProperty(
			array(
				'id'		=> 'registration_date',
				'type'		=> 'date',
				'value'		=> $registrationDate,
				'is_system' => true,
			)
		);
	}
	
	function setUserGroupSID($user_group_sid)
	{
		$this->user_group_sid = $user_group_sid;
	}
	
	function getUserGroupSID()
	{
		return $this->user_group_sid;
	}
	
	function getContractID()
	{
		return SJB_ContractManager::getAllContractsSIDsByUserSID(($this->sid));
	}
	
		/* 16-07-2016 bonuse days for resume DB access */
		function getContracts()
		{
			return SJB_ContractManager::getAllContractsInfoByUserSID(($this->sid));
		}

			
		function setContractsExpiredDate($expiration_date_new, $user_sid, $plan_to_change_id)
		{
			$changed_contr_id = SJB_ContractManager::setNewExpirDateForContract($expiration_date_new, $user_sid, $plan_to_change_id);
		}
		
		
					function resetBonusResumesValueByUserSID($user_sid) {
						SJB_ContractManager::resetBonusResumesValueByUserSID($user_sid);
					}
		
		/************* END ***********/ 
	
	function hasContract()
	{        
        $contract_info = SJB_ContractManager::getAllContractsInfoByUserSID($this->sid);	
		return !empty($contract_info);		
	}
	
	function mayChooseContract() // пользователь всегда может переподписаться
	{
		return true;
	}
	
	function getSubscribeOnceMembershipPlansIDByUserId()
	{
		$ids = SJB_ObjectManager::getPropertyValueByObjectSID('users', $this->getID(), 'Subscribe_once');
		if (empty($ids)) {
			return array();
		}

		$ids = explode(',', $ids);
		$subscribeOnceMembershipPlans = array();
		$membership_plans = SJB_MembershipPlanManager::getAllMembershipPlansInfo();
		if (!empty($membership_plans)) {
			foreach ($membership_plans as $plan) {
				$extra_info = unserialize($plan['serialized_extra_info']);
				if ($extra_info['subscribe_only_once'] == 1 && $plan['user_group_sid'] == $this->getUserGroupSID())
					$subscribeOnceMembershipPlans[] = $plan['id'];
			}
		}

		return $subscribeOnceMembershipPlans;
	}
	
	function getProhibitSubscribingTwiceMembershipPlansIDByUserIds($user_id, $user_group_id)
	{
		$membership_plans = SJB_MembershipPlanManager::getAllMembershipPlansInfo();
		$prohobited_membership_plan_ids = array();
		if (!empty($membership_plans)) {
			foreach ($membership_plans as $plan) {
				$unserialized_extra_info = unserialize($plan['serialized_extra_info']);
				if (($unserialized_extra_info['prohibit_subscribe_twice'] == 1) && ($plan['user_group_sid'] == $user_group_id))
					$prohobited_membership_plan_ids[] = $plan['id'];
			}
		}
		$active_membership_plan_ids = SJB_ContractManager::getActiveContractMembershipPlanIDsByUserID($user_id);
		return array_intersect($prohobited_membership_plan_ids, $active_membership_plan_ids);
	}
	
	function ifSubscribeOnceUsersProperties($membership_plan_id, $user_id)
	{
		$serialized_extra_info = SJB_DB::query('SELECT serialized_extra_info FROM membership_plans WHERE id = ?n', $membership_plan_id);
		$serialized_extra_info = array_pop(array_pop($serialized_extra_info));
		$unserialized_extra_info = unserialize($serialized_extra_info);
		$user = SJB_UserManager::getObjectBySID($user_id);
		$already_subscribed = $user->getSubscribeOnceMembershipPlansIDByUserId();
		if ($unserialized_extra_info['subscribe_only_once'] == 1) {
			if (!in_array($membership_plan_id, $already_subscribed)) {
				$already_subscribed[] = $membership_plan_id;
				$value = $membership_plan_id;
				if (count($already_subscribed) > 1) {
					$value = implode(',', $already_subscribed);
				}
				return true;
			}	
		} else {
			if (in_array($membership_plan_id, $already_subscribed)) {
				$value = array_search($membership_plan_id, $already_subscribed);
				unset($already_subscribed[$value]);
				if (count($already_subscribed) > 1){
					$value = implode(',',$already_subscribed);
				} else {$value = array_pop($already_subscribed); }
				
			}		
		}		
		return false;
	}
	
	function updateSubscribeOnceUsersProperties($membership_plan_id, $user_id)
	{
		$serialized_extra_info = SJB_DB::query('SELECT serialized_extra_info FROM membership_plans WHERE id = ?n', $membership_plan_id);
		$serialized_extra_info = array_pop(array_pop($serialized_extra_info));
		$unserialized_extra_info = unserialize($serialized_extra_info);
		$user = SJB_UserManager::getObjectBySID($user_id);
		$already_subscribed = $user->getSubscribeOnceMembershipPlansIDByUserId();
		if ($unserialized_extra_info['subscribe_only_once'] == 1) {
			if (!in_array($membership_plan_id, $already_subscribed)) {
				$already_subscribed[] = $membership_plan_id;
				$value = $membership_plan_id;
				if (count($already_subscribed) > 1) {
					$value = implode(',', $already_subscribed);
				}
				$user->addProperty(array(
					'id'=>'Subscribe_once',
					'type'=>'string',
					'value' => $value
				));
				$user->deleteProperty('password');
				SJB_UserManager::saveUser($user);
				return true;
			}	
		} else {
			if (in_array($membership_plan_id, $already_subscribed)) {
				$value = array_search($membership_plan_id, $already_subscribed);
				unset($already_subscribed[$value]);
				if (count($already_subscribed) > 1){
					$value = implode(',',$already_subscribed);
				} else {$value = array_pop($already_subscribed); }
				$user->addProperty(array(
					'id'=>'Subscribe_once',
					'type'=>'string',
					'value' => $value
				));
				$user->deleteProperty('password');
				SJB_UserManager::saveUser($user);
			}		
		}		
		return false;
	}
	
	function mayChooseMembershipPlan($membership_plan_id, &$error)
	{
		$membership_plan_info = SJB_MembershipPlanManager::getMembershipPlanInfoByID($membership_plan_id);
		$extra_info = unserialize($membership_plan_info['serialized_extra_info']);
		
		if (isset($extra_info['subscribe_only_once']) && $extra_info['subscribe_only_once']) {
			if ($this->ifSubscribeOnceUsersProperties($membership_plan_id, $this->getID())){
				return true;
			}
			$error = 'MEMBERSHIP_PLAN_IS_ONLY_ONCE_AVAILABLE';
			return false;
		}
		
		if (isset($extra_info['prohibit_subscribe_twice']) && $extra_info['prohibit_subscribe_twice']) {
			if ($this->hasContract()) {
				$ids = $this->getContractID();
				foreach ($ids as $id) {
					if (SJB_UserManager::getMembershipPlanSIDByContractID($id) == $membership_plan_id){
						$error = 'MEMBERSHIP_PLAN_NOT_EXPIRED_YET';
						return false;
					}
				}				
			}
		}
		
		//must be checked if membership plan is available for user's group
		return true;
	}
	
	function setContractID($contract_id)
	{
		$this->contract_id = $contract_id;
	}

	function getUserName()
	{
		$username = $this->details->getProperty('username')->getValue();
		if (is_array($username))
			$username = array_pop($username);
		return $username;
	}

	/* 12-06-2014 search by Company Name - listings numbers fix*/
					function getCompName()
					{
						$compname = $this->details->getProperty('CompanyName')->getValue();
						if (is_array($compname))
							$compname = array_pop($compname);
						return $compname;
					}
	/* 12-06-2014 END */
	
		
	function isSavedInDB()
	{
		$sid = $this->getSID();
		return !empty($sid);
	}

	function getActivationKey()
	{
		return $this->activation_key;
	}

	function getVerificationKey()
	{
		return $this->verification_key;
	}

	function createActivationKey()
	{
		$this->activation_key = $this->createUniqueKey();
	}

	function createVerificationKey()
	{
		$this->verification_key = $this->createUniqueKey();
	}

	function createUniqueKey()
	{
		$symbols = array_merge( range('a','z'), range('0','9') );
		shuffle($symbols);
		return join('', $symbols);
	}
}


