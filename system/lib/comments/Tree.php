<?php

class SJB_Tree
{
	var $assoc = array();
	var $levels = array();
	var $normalized = array();
	
	function SJB_Tree($data)
	{
		$this->data = $data;		
	}
	
	function normalize($parent_id = 0, $current_level = 0)
	{
		$on_level = array();
		$k = 0;
		foreach ($this->data as $k => $elem)		
			if ($this->isParent($elem, $parent_id))
			{
				$id = $this->getID($elem);
				$on_level[] = $id;
				$this->assoc[$id] = $k;
				$this->levels[$id] = $current_level;
				$below = $this->normalize($id, $current_level + 1);
				if (!empty($below))
					$on_level = array_merge($on_level, $below); 
			}
		return $on_level;
	}
	
	function toArray()
	{
		$result = array();
		foreach ($this->normalized as $id)
		{
			$node = $this->data[$this->assoc[$id]];
			$node['level'] = $this->levels[$id];
			$result[] = $node;
		}
		return $result;
	}
	
	function build()
	{
		return $this->normalized = $this->normalize();
	}
	
	function isParent($elem, $parent_id)
	{
		;#virtual		
	}
	
	function getID($elem)
	{
		;#virtual
	}
}

