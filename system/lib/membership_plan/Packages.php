<?php

require_once("membership_plan/PackageSQL.php");

class SJB_Packages
{
	function getPackages($membership_plan_id)
	{
		return SJB_PackageSQL::getPackages($membership_plan_id);
	}
}
