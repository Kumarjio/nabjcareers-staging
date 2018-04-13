<?php

class SJB_StructureExplorer
{
	var $filters = array();
	var $eventHandler;

	function addFilter($string)
	{
		$this->filters[] = $string;
	}

	function setEventHandler($callback)
	{
		$this->eventHandler =& $callback;
	}
	
	function explore(&$data)
	{
		$this->_explore($data, null, $data);
	}
	
	function _explore(&$data, $key, &$parentData)
	{
		if ($this->canRaise($data, $key, $parentData)) {
			$this->raiseEvent($data, $key, $parentData);
		}
		if (is_array($data)) {
			foreach(array_keys($data) as $key) {
				$this->_explore($data[$key], $key, $data);
			}
		}
	}
	
	function canRaise(&$value, $key, &$parentData)
	{
		foreach ($this->filters as $filter) {
			if (!eval('return ' . $filter . ';')) {
				return false;
			}
		}
		return !is_null($this->eventHandler);
	}

	function raiseEvent(&$value, $key, &$parentData)
	{
		$value = call_user_func($this->eventHandler, $value, $key, $parentData);
	}
}
