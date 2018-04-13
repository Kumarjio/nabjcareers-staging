<?php

require_once 'comments/Tree.php';

class SJB_CommentsTree extends SJB_Tree
{
	function isParent($elem, $parent_id)
	{
		return $elem['post_id'] == $parent_id;
	}
	
	function getID($elem)
	{
		return $elem['sid'];
	}
}
