<?php

require_once 'membership_plan/PackagesManager.php';
require_once("membership_plan/MembershipPlanSQL.php");

class SJB_MembershipPlanManager
{
	public static function getMembershipPlanInfoByID($membership_plan_id)
	{
		return SJB_MembershipPlanSQL::selectByID($membership_plan_id);
	}
	
	public static function getAllMembershipPlansInfo()
	{
		return SJB_MembershipPlanSQL::selectAll();
	}
	
	public static function getPlansIDByGroupSID($user_group_sid)
	{
		return SJB_MembershipPlanSQL::getPlansIDByGroupSID($user_group_sid);
	}

        public static function getPlansInfoByGroupSID( $user_group_sid )
        {
            return SJB_MembershipPlanSQL::getPlansInfoByGroupSID( $user_group_sid );
        }
	
	public static function deleteMembershipPlanBySID($membership_plan_sid)
	{
		$membership_plan_info = SJB_MembershipPlanManager::getMembershipPlanInfoByID($membership_plan_sid);
		$membership_plan = new SJB_MembershipPlan($membership_plan_info);
		$contract_quantity = $membership_plan->getContractQuantity();
		if ($contract_quantity)
		    return false;
		return SJB_MembershipPlanSQL::deleteById($membership_plan_sid) && SJB_PackagesManager::deleteMembershipPlanPackages($membership_plan_sid);
	}
	
	public static function checkPageAccessForMembershipPlanSID($membership_plan_sid)
	{
		return SJB_MembershipPlanSQL::checkPageAccessForMembershipPlanSID($membership_plan_sid);
	}
}

