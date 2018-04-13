<?php

class SJB_MembershipPlanSQL
{
	function getContractQuantityByMembershipPlanId($id)
	{		 
		$result = array_pop(SJB_DB::query(
			"SELECT COUNT( DISTINCT users.sid) 
			FROM users 
			INNER JOIN contracts ON users.sid = contracts.user_sid 
			INNER JOIN membership_plans ON membership_plans.id = contracts.membership_plan_id 
			WHERE membership_plans.id=?n"
		, $id));
		
		return $result ? array_pop($result) : 0;
	}
	
	function selectAll()
	{
		return SJB_DB::query("SELECT * FROM `membership_plans` ORDER BY `name`");		
	}
	
	function selectByID($id)
	{
		$result = SJB_DB::query("SELECT * FROM `membership_plans` WHERE id=?n", $id);
		if ($result) 
			return array_pop($result);
		return false;
	}
	
	function deleteById($id)
	{
		$del_plan = SJB_DB::query("DELETE FROM membership_plans WHERE id = ?n", $id);
		$del_page = SJB_DB::query("DELETE FROM page_access WHERE id_membership = ?n", $id);
		return $del_plan && $del_page;
	}
	
	function save($id, $info)
	{
		$info['serialized_extra_info'] = serialize($info);
		if ( !is_null($id) ) {
			return SJB_MembershipPlanSQL::_update($id, $info);
		}
		
		return SJB_MembershipPlanSQL::_insert($info);
	}
	
	function _update($id, $info)
	{
		return SJB_DB::query(
			 "UPDATE `membership_plans` SET `name` = ?s, `user_group_sid` = ?s, `description` = ?s, `price` = ?s, `subscription_period` = ?n, `serialized_extra_info` = ?s"
			." WHERE `id` = ?n",
		 	$info['name'], $info['user_group_sid'], $info['description'], $info['price'], $info['subscription_period'], $info['serialized_extra_info'],  $id);
	}
	
	function _insert($info)
	{
		$max_order = SJB_DB::query("SELECT MAX(`order`) FROM membership_plans WHERE `user_group_sid`=?n", $info['user_group_sid']);
		$max_order = empty($max_order) ? 0 : array_pop(array_pop($max_order));
		return SJB_DB::query(
			"INSERT INTO membership_plans(`name`, `user_group_sid`, `description`, `price`, `subscription_period`, `serialized_extra_info`, `order`)"
			." VALUES(?s, ?s, ?s, ?f, ?n, ?s, ?n)",
			$info['name'], $info['user_group_sid'], $info['description'], $info['price'], $info['subscription_period'], $info['serialized_extra_info'], ++$max_order);
	}
	
	function getPlansIDByGroupSID($user_group_sid)
	{
		$membership_plans =	SJB_DB::query("SELECT `id` FROM `membership_plans` WHERE `user_group_sid` = ?n ORDER BY `order`", $user_group_sid);
		
		$membership_plans_id = array();
		if ( is_array($membership_plans) ) {
			foreach($membership_plans as $key => $membership_plan) {
				$membership_plans_id[] = $membership_plan['id'];
			}
		}
		return $membership_plans_id;
	}
        
	function getPlansInfoByGroupSID($user_group_sid)
	{
            return SJB_DB::query("SELECT * FROM `membership_plans` WHERE `user_group_sid` = ?n ORDER BY `order`", $user_group_sid);
	}
	
	function checkPageAccessForMembershipPlanSID($membership_plan_sid)
	{
		$check = SJB_DB::query("SELECT * FROM `page_access` WHERE `id_membership` = ?n", $membership_plan_sid);
		return !empty($check);
	}
}
