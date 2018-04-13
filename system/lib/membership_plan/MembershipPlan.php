<?php

require_once('membership_plan/MembershipPlanFields.php');
require_once('membership_plan/MembershipPlanSQL.php');

class SJB_MembershipPlan
{
	var $id				= null;
	var $fields         = null;
	var $extra_fields   = array (
                    			'prohibit_subscribe_twice' => array(
                    				'type' => 'boolean',
                    				'value' => '',
                    				'caption' => 'Prohibit subscribing twice'),
                    			'subscribe_only_once' => array(
                    				'type' => 'boolean',
                    				'value' => '',
                    				'caption' => 'Subscribe only once'),
                    			'is_recurring' => array(
                    				'type' => 'boolean',
                    				'value' => '',
                    				'caption' => 'Make this Subscription Recurring')
                    	  );
	
	function SJB_MembershipPlan($input_info = null)
	{
		$this->base_fields = SJB_MembershipPlanFields::getFieldsInfo();
		$this->fields = array_merge($this->base_fields, $this->extra_fields);
		
		if ( !is_null($input_info) ) {
			if ( isset($input_info['id']) ) {
				$db_info = SJB_MembershipPlanSQL::selectByID($input_info['id']);
				if ( !is_null($db_info) ) {
					$this->id = $db_info['id'];
					foreach ($this->base_fields as $parameter_name => $parameter_info) {
						$this->base_fields[$parameter_name]['value'] = $db_info[$parameter_name];
					}
					if (!empty($db_info['serialized_extra_info'])) {
						$extra_info = unserialize($db_info['serialized_extra_info']);
						foreach ($this->extra_fields as $parameter_name => $parameter_info) {
							if ( isset($extra_info[$parameter_name]) )
								$this->extra_fields[$parameter_name]['value'] = $extra_info[$parameter_name];
						}
					}
				}
			}
			
			$this->fields = array_merge($this->base_fields, $this->extra_fields);
			foreach ($input_info as $parameter_name => $parameter_value) {
				if ( array_key_exists($parameter_name, $this->fields) ) {
					$this->fields[$parameter_name]['value'] = $parameter_value;
				}
			}
		}
	}
	
	function getPackagesByClassName($class_name)
	{
		return null;
	}
	
	function getFieldsInfo()
	{
		return $this->fields;
	}
	
	function saveInDB()
	{
		return SJB_MembershipPlanSQL::save($this->id, $this->getHashedFields());
	}
	
	function getHashedFields()
	{
		foreach ($this->fields as $field_name => $field_info) {
			$hashed_fields[$field_name] = $field_info['value'];
		}
		return $hashed_fields;
	}
	
	function getSubscriptionPeriod()
	{
		return $this->fields['subscription_period']['value'];
	}
	
	function getPrice()
	{
		return $this->fields['price']['value'];
	}	
	
	function getContractQuantity()
	{
		return SJB_MembershipPlanSQL::getContractQuantityByMembershipPlanId($this->id);
	}
	
	function getName()
	{
		return $this->fields['name']['value'];
	}

	public function isRecurring()
	{
		return !empty($this->fields['is_recurring']['value']);
	}
	
	
	
	/* 28-03-2015 */
	public function getPlanId()
	{
		return $this->id;
	}
	
}
