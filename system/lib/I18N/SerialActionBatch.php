<?php


class SJB_SerialActionBatch
{	
	var $actions = array();
	
	function addAction(&$action)
	{
		$this->actions[] =& $action;
	}
	
	function canPerform()
	{
		$result = true;
		
		foreach($this->actions as $key => $value)
		{
			$action =& $this->actions[$key];
			$result &= $action->canPerform();
		}
		
		return $result;
	}
	
	function perform()
	{
		foreach($this->actions as $key => $value)
		{
			$action =& $this->actions[$key];
			$action->perform();
		}
	}

	function getErrors()
	{
		$errors = array();
		
		foreach($this->actions as $key => $value)
		{
			$action =& $this->actions[$key];
			$errors = array_merge($action->getErrors(), $errors);
		}
		
		return $errors;
	}
}

