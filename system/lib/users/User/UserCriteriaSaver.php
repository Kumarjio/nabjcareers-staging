<?php

require_once("classifieds/SearchEngine/CriteriaSaver.php");
require_once("users/User/UserManager.php");

class SJB_UserCriteriaSaver extends SJB_CriteriaSaver
{
	function SJB_UserCriteriaSaver($searchId = 'UserSearcher')
	{
		$searchId = 'UserSearcher_'.$searchId;
		parent::SJB_CriteriaSaver($searchId, new SJB_UserManager);
	}
}
