<?php

class SJB_ContractSQL
{
	
	function selectInfoByID($id)
	{
		return array_pop(SJB_DB::query("SELECT * FROM contracts WHERE id=?n", $id));
	}
	
	function selectInfoByUserSID($user_sid)
	{
		return SJB_DB::query("SELECT * FROM contracts WHERE user_sid=?n", $user_sid);
	}
	
	function insert($contract_info)
	{
		$contract_id = $contract_info['contract_id'];
		if (!empty($contract_id)) {
			if (!empty($contract_info['expired_date']))
				return SJB_DB::query("UPDATE `contracts` SET `membership_plan_id` = ?n, `creation_date` = ?s, `expired_date` = ?s WHERE `id` = ?n",
					$contract_info['membership_plan_id'], $contract_info['creation_date'], $contract_info['expired_date'], $contract_id);
			else {
				return SJB_DB::query("UPDATE `contracts` SET `membership_plan_id` = ?n, `creation_date` = ?s WHERE `id` = ?n",
					$contract_info['membership_plan_id'],  $contract_info['creation_date'], $contract_id);
			}
		}
		else {
			if (!empty($contract_info['expired_date']))
				return SJB_DB::query("INSERT INTO `contracts`(`user_sid`, `membership_plan_id`, `creation_date`, `expired_date`, `recurring_id`, `gateway_id`) VALUES(?n, ?n, ?s, ?s, ?s, ?s)",
					$contract_info['user_sid'], $contract_info['membership_plan_id'],  $contract_info['creation_date'], $contract_info['expired_date'], $contract_info['recurring_id'], $contract_info['gateway_id']);
			else
				return SJB_DB::query("INSERT INTO `contracts`(`user_sid`, `membership_plan_id`, `creation_date`, `recurring_id`, `gateway_id`) VALUES(?n, ?n, ?s, ?s, ?s)",
					$contract_info['user_sid'], $contract_info['membership_plan_id'],  $contract_info['creation_date'], $contract_info['recurring_id'], $contract_info['gateway_id']);
		}
	}
	
	function updateContractExtraInfoByMembershipPlanID($contract_id, $membership_plan_id)
	{
		$serialized_extra_info = SJB_DB::query("SELECT serialized_extra_info FROM membership_plans WHERE id = ?n", $membership_plan_id);
		$serialized_extra_info = array_pop(array_pop($serialized_extra_info));
		$unserialized_extra_info = unserialize($serialized_extra_info);
		
		$contract_pages = array();
		$contract_pages_ids = array();
	
		// добавим параметр number_of_views. Значение null - неограниченный просмотр
		$pageArray	= SJB_DB::query("SELECT `id_pages`, `number_of_views` FROM `page_access` WHERE `id_membership`=?n", $membership_plan_id);
		foreach ($pageArray as $elem) {
			// если в контракте уже существует такая страница
			if (in_array($elem['id_pages'], $contract_pages_ids)) {
				if ($elem['number_of_views'] == null || $contract_pages[$elem['id_pages']] == null || $elem['number_of_views'] == 0 || $contract_pages[$elem['id_pages']] == 0)
					$contract_pages[$elem['id_pages']] = null;
				else
					$contract_pages[$elem['id_pages']] += $elem['number_of_views'];
			} else {
				$contract_pages[$elem['id_pages']] = $elem['number_of_views'];
			}
		}
		$page_access = $contract_pages;
		// дополним информацию контракта новыми данными
		if (isset($page_access))
			$unserialized_extra_info['page_access'] = $page_access;

		$serialized_extra_info	= serialize($unserialized_extra_info);

		SJB_DB::query("UPDATE contracts SET serialized_extra_info = ?s WHERE id = ?n", $serialized_extra_info, $contract_id);
	}
	
	function updateAllContractsExtraInfoByMembershipPlanID($contracts_sids, $membership_plan_id)
	{
		$serialized_extra_info = SJB_DB::query("SELECT serialized_extra_info FROM membership_plans WHERE id = ?n", $membership_plan_id);
		$serialized_extra_info = array_pop(array_pop($serialized_extra_info));
		$unserialized_extra_info = unserialize($serialized_extra_info);
		
		$contract_pages = array();
		$contract_pages_ids = array();
		
		// добавим параметр number_of_views. Значение null - неограниченный просмотр
		$pageArray	= SJB_DB::query("SELECT `id_pages`, `number_of_views` FROM `page_access` WHERE `id_membership`=?n", $membership_plan_id);
		foreach ($pageArray as $elem) {
			// если в контракте уже существует такая страница
			if (in_array($elem['id_pages'], $contract_pages_ids)) {
				if ($elem['number_of_views'] == null || $contract_pages[$elem['id_pages']] == null || $elem['number_of_views'] == 0 || $contract_pages[$elem['id_pages']] == 0)
					$contract_pages[$elem['id_pages']] = null;
				else
					$contract_pages[$elem['id_pages']] += $elem['number_of_views'];
			} else {
				$contract_pages[$elem['id_pages']] = $elem['number_of_views'];
			}
		}
		$page_access = $contract_pages;
		if (isset($page_access))
			$unserialized_extra_info['page_access'] = $page_access;

		$serialized_extra_info	= serialize($unserialized_extra_info);

        SJB_DB::query("delete from `permissions` where `type` = 'contract' and `role` in ({$contracts_sids})");
		foreach (explode(',', $contracts_sids) as $contract) {
        	SJB_DB::query("insert into `permissions` (`type`, `role`, `name`, `value`, `params`)"
                . " select 'contract', ?s, `name`, `value`, `params` from `permissions` "
                . " where `type` = 'plan' and `role` = ?s", $contract, $membership_plan_id);
		}
            
		SJB_DB::query("UPDATE contracts SET serialized_extra_info = '?w' WHERE id in ({$contracts_sids})", $serialized_extra_info);
	}
	
	function delete($contract_id)
	{
		return SJB_DB::query("DELETE FROM `contracts` WHERE `id`=?s", $contract_id);
	}
	
	function deletePageViews($user_sid)
	{
		return SJB_DB::query("DELETE FROM `page_view` WHERE `id_user`=?n", $user_sid);
	}
	
}

