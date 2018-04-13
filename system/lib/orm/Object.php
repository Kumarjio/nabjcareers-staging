<?php


require_once("orm/ObjectDBManager.php");

class SJB_Object
{
	var $sid;
	var $db_table_name;

/*** Job Fair mod  */
	var $visible_emp;
/*** END of  Job Fair mod  */
	
	
	/**
	 * 
	 * @var SJB_UserDetails
	 */
	var $details;
	var $errors; 
		
	function getDetails()
	{
		return $this->details;
	}
	
	function getProperties()
	{
		return $this->details->getProperties();
	}
	
	function setSID($sid)
	{
		$this->details->setObjectSID($sid);
		$this->sid = $sid;
	}

	function getSID()
	{
		return $this->sid;
	}

	/** Job Fair mod  */	
		function getEmpVisible()
		{
			return $this->visible_emp;
		}
		
		function setEmpVisible($empVisibleCheckbox)
		{
			$this->visible_emp = 55;
		}
	/*** END of  Job Fair mod  */
	
	function getID()
	{
		$id = $this->getPropertyValue('id');

		if (!empty($id))	return $id;
		else				return $this->sid;
	}

	function addProperty($property_info)	{ $this->details->addProperty($property_info); }
	function deleteProperty($property_id)	{ $this->details->deleteProperty($property_id);	}
	
	/**
	 * 
	 * @param SJB_ObjectProperty $property_id
	 */
	function getProperty($property_id)
	{
	    return $this->details->getProperty($property_id);
	}
	
	function makePropertyNotRequired($property_id)	{ return $this->details->makePropertyNotRequired($property_id);	}
	function dontSaveProperty($property_id)			{ return $this->details->dontSaveProperty($property_id);	}
    function propertyIsSet($property_id)			{ return $this->details->propertyIsSet($property_id); }

	function getPropertyDisplayValue($property_id)
	{
		$property = $this->details->getProperty($property_id);

		if (!empty($property)) return $property->getDisplayValue();
		else				   return null;
	}

	function getPropertyValue($property_id)
	{
		$property = $this->details->getProperty($property_id);

		if (!empty($property)) return $property->getValue();
		else				   return null;
	}

	function setPropertyValue($property_id, $value)
	{
            $property = $this->details->getProperty($property_id);

            if (!empty($property)) return $property->setValue($value);
            else				   return false;
	}

	
	
	function getErrors()	{ return $this->errors; }
}

