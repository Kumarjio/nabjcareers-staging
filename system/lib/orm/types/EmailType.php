<?php

require_once('orm/types/Type.php');

class SJB_EmailType extends SJB_Type
{
	var $email_confirmation;
	
    function SJB_EmailType($property_info)
    {
		parent::SJB_Type($property_info);
		$this->default_template = 'email.tpl';
		$user_group_id = SJB_Request::getVar('user_group_id', null);
		if(!is_null($user_group_id)) {
			$user_group_sid  = SJB_UserGroupManager::getUserGroupSIDByID($user_group_id);
			$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid);
			$this->email_confirmation = false;
			if(isset($user_group_info['email_confirmation']))
			 	$this->email_confirmation = $user_group_info['email_confirmation'];
		}
	}

	function getPropertyVariablesToAssign()
	{
		$value = $this->property_info['value'];
		if (is_array($value) && isset($value['original'])) {
			if($value['confirmed'] == $value['original'])
				$confirmed = $value['confirmed'];
			$value = $value['original'];
		}
		
		return array(	'id'			=> $this->property_info['id'],
						'value'			=> $value,
						'confirmed' 	=> $confirmed,
						'isUsername' 	=> true,
						'isRequireConfirmation' => $this->email_confirmation);
	}

    function isValid()
    {
//    	if(!ereg("^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-zA-Z]{2,4}\$",  $this->property_info['value']['original'] ))
//					/.+@.+\..+/i
    	if(!ereg("^[a-zA-Z0-9\._\:-]+@[a-zA-Z0-9\._-]+.{3,}\$",  $this->property_info['value']['original'] ))    	
    	return 'NOT_VALID_EMAIL_FORMAT';
    	if($this->email_confirmation == 1) {
	        if ($this->property_info['value']['original'] != $this->property_info['value']['confirmed'])
	            return 'NOT_CONFIRMED';
    	}
   		return true;
    }
    
	function getSavableValue()
	{
		$value = $this->property_info['value'];
		if (is_array($value) && isset($value['original']))
			$value = $value['original'];
       	return $value;
	}
      
	function getSQLValue()
	{
		$value = $this->property_info['value'];
		if (is_array($value) && isset($value['original']))
			$value = $value['original'];
       	return "'" . mysql_real_escape_string(trim($value)) . "'";
	}    
}

