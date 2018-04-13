<?php

class DomainData
{
	var $id;
	
	function setID($id)
	{
		$this->id = $id;
	}
	
	function getID()
	{
		return $this->id;
	}
	
	function create()
	{
		return new DomainData();
	}
}

