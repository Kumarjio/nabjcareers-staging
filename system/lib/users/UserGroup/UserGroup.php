<?php

require_once("orm/Object.php");
require_once("UserGroupDetails.php");

class SJB_UserGroup extends SJB_Object
{
	function SJB_UserGroup($user_group_info = null)
	{
		$this->db_table_name = 'user_groups';
		$this->details = new SJB_UserGroupDetails($user_group_info);
	}
}
