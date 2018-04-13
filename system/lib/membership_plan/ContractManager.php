<?php

require_once('ContractSQL.php');
require_once('membership_plan/Contract.php');

class SJB_ContractManager
{
	public static function deleteContract($contract_id, $user_sid = false)
	{
        $contract = new SJB_Contract( array('contract_id' => $contract_id, 'user_sid' => $user_sid) );
        SJB_ContractManager::deleteContractIDFromNotificationSended($contract_id);
        return $contract->delete();  
    }
    
	public static function deleteAllContractsByUserSID($user_sid)
	{
		require_once 'payment/PaymentGateway/PaymentGatewayManager.php';
		require_once 'payment/Payment/Payment.php';
		require_once 'payment/Payment/PaymentManager.php';
		require_once 'membership_plan/MembershipPlanManager.php';
		
		$userContracts = SJB_DB::query("SELECT `id`, `gateway_id`, `recurring_id` FROM `contracts` WHERE `user_sid` = ?n", $user_sid);
		foreach ($userContracts as $contract) {
			// 'paypal_standard' != $contract['gateway_id']  - redirect on paypal
			// cancel recurring
			if ( !empty($contract['gateway_id']) && !empty($contract['recurring_id']) && 'paypal_standard' != $contract['gateway_id'] && $gateway = SJB_PaymentGatewayManager::getObjectByID($contract['gateway_id'], true) )
			{
				$gateway->cancelSubscription($contract['recurring_id']);
			}
			SJB_ContractManager::deleteContractIDFromNotificationSended($contract['id']);
		}
		return SJB_DB::query("DELETE FROM `contracts` WHERE `user_sid`=?n", $user_sid);
    }
    
   	public static function deleteAllContractsByRecurringId($recurringId)
	{
		$contracts = SJB_DB::query("SELECT id FROM `contracts` WHERE `recurring_id` = ?s", $recurringId);
		foreach ($contracts as $contract) {
			SJB_ContractManager::deleteContractIDFromNotificationSended($contract['id']);
		}
        return SJB_DB::query("DELETE FROM `contracts` WHERE `recurring_id` = ?s", $recurringId);
    }
	
	public static function getExpiredContractsID()
	{
		$expired_contracts = SJB_DB::query("SELECT id FROM contracts WHERE expired_date < NOW() AND expired_date != '0000-00-00'");
		$contracts_id = array();
		foreach ($expired_contracts as $expired_contract) {			
			$contracts_id[] = $expired_contract['id'];			
		}
		return $contracts_id;
	}
	
	public static function getActiveContractMembershipPlanIDsByUserID($user_sid)
	{
		$active_contracts = SJB_DB::query("SELECT membership_plan_id FROM contracts WHERE (expired_date >= CURDATE() OR ISNULL(expired_date)) AND (`user_sid` = ?n)", $user_sid);
		
		$membership_plan_ids = array();
		if (!empty($active_contracts))
			foreach ($active_contracts as $active_contract) {
				$membership_plan_ids[] = $active_contract['membership_plan_id'];			
			}
		
		return $membership_plan_ids;
	}
	
	public static function getContractsIDByDaysLeftToExpired($user_sid, $days = 0)
	{
		$expired_contracts = SJB_DB::query("SELECT id FROM contracts WHERE expired_date < DATE_ADD( NOW(), INTERVAL ?w DAY ) AND expired_date != '0000-00-00' AND `user_sid` = ?n", $days, $user_sid);
		$contracts_id = array();
		foreach ($expired_contracts as $expired_contract) {			
			$contracts_id[] = $expired_contract['id'];			
		}
		return $contracts_id;
	}
	
	
	/**
	 * Check contract to have sended remind notifications about expiration date.
	 * Look for contract ID in 'contract_notifications_send' table,
	 *
	 * @param integer $contractID
	 * @return boolean
	 */
	public static function isContractNotificationSended($contractID)
	{
		$result = SJB_DB::query("SELECT * FROM `notifications_sended` WHERE `object_type` = 'contract' AND `object_sid` = ?n", $contractID);
		if (empty($result)) {
			return false;
		}
		return true;
	}
	
	
	public static function deleteContractIDFromNotificationSended($contractSID)
	{
		return SJB_DB::query("DELETE FROM `notifications_sended` WHERE `object_type` = 'contract' AND `object_sid` = ?n", $contractSID);
	}
	
	
	/**
	 * Save contract ID in `contract_notifications_send` table.
	 *
	 * @param integer|array $contractSID
	 * @return boolean
	 */
	public static function saveContractIDAsSendedNotificationsTable($contractSID)
	{
		$result = false;
		
		if (is_integer($contractSID)) {
			$result = SJB_DB::query("INSERT INTO `notifications_sended` SET `object_sid` = ?n, `object_type` = 'contract'", $contractSID);
		} elseif ( is_array($contractSID)) {
			$insertValues = array();
			foreach ($contractSID as $value) {
				if (!is_numeric($value)) {
					continue;
				}
				$insertValues[] = "('contract', $value)";
			}
			
			$insert = implode(",", $insertValues);
			$result = SJB_DB::query("INSERT INTO `notifications_sended` (`object_type`, `object_sid`) VALUES $insert");
		}
		
		if ($result === false) {
			return false;
		}
		return true;
	}
    
    public static function getInfo($contract_id)
    {
    	if ($contract_id == 0) {
    		return false;
    	}
        $contractInfo = SJB_ContractSQL::selectInfoByID($contract_id);

        if ($contractInfo && empty($contractInfo['serialized_extra_info']) ) {
        	$membershipPlan = SJB_MembershipPlanManager::getMembershipPlanInfoByID($contractInfo['membership_plan_id']);
        	$contractInfo['serialized_extra_info'] = $membershipPlan['serialized_extra_info'];
			$unserializedInfo = unserialize($contractInfo['serialized_extra_info']);
        }

        return $contractInfo;
    }
    
    public static function getInfoByRecurringId($recurringId)
    {
    	if ($recurringId == 0) {
    		return false;
    	}
        $contractInfo = array_pop(SJB_DB::query("SELECT * FROM `contracts` WHERE `recurring_id` = ?n", $recurringId));
        if ($contractInfo && empty($contractInfo['serialized_extra_info']) ) {
        	$membershipPlan = SJB_MembershipPlanManager::getMembershipPlanInfoByID($contractInfo['membership_plan_id']);
        	$contractInfo['serialized_extra_info'] = $membershipPlan['serialized_extra_info'];
			$unserializedInfo = unserialize($contractInfo['serialized_extra_info']);
        }

        return $contractInfo;
    }
    
    public static function getAllContractsInfoByUserSID($user_sid)
    {
    	if ($user_sid == 0) {
    		return false;
    	}
        $contractsInfo = SJB_ContractSQL::selectInfoByUserSID($user_sid);

        foreach($contractsInfo as $key => $contractInfo) {
	        if ($contractInfo && empty($contractInfo['serialized_extra_info']) ) {
	        	$membershipPlan = SJB_MembershipPlanManager::getMembershipPlanInfoByID($contractInfo['membership_plan_id']);
	        	$contractInfo['serialized_extra_info'] = $membershipPlan['serialized_extra_info'];
	        	$unserializedInfo = unserialize($contractInfo['serialized_extra_info']);
	        	$contractsInfo[$key] = $contractInfo;
	        }
        }
        return $contractsInfo;
    }
    
    public static function getAllContractsSIDsByUserSID($user_sid)
    {
    	if ($user_sid == 0) {
    		return false;
    	}
        $contractsInfo = SJB_ContractSQL::selectInfoByUserSID($user_sid);
		$result = array();
        foreach($contractsInfo as $key => $contractInfo) {
			$result[] = $contractInfo['id'];
        }
        return $result;
    }
    
	public static function getExtraInfoByID($contract_id)
	{
    	$extra_info = SJB_DB::query("SELECT serialized_extra_info FROM contracts WHERE id = ?n", $contract_id);
    	$contract_extra_info	= false;
    	if (!empty($extra_info)) {
    		$contract_extra_info	= array_pop(array_pop( $extra_info ));
    		$contract_extra_info	= unserialize($contract_extra_info);
    	}
    	
		return $contract_extra_info;
    }
    
	public static function getPageAccessByUserContracts($contracts_id, $pageID)
	{
	    $permission = '';
	    $pageAccess = array();
	    switch ($pageID) {
	        case '/search-resumes/':
	            $permission = 'open_resume_search_form';
	            break;
	        case '/search_results_resumes/':
	            $permission = 'view_resume_search_results';
	            break;
	        case '/display-resume':
	            $permission = 'view_resume_details';
	            break;
	        case '/find-jobs/':
	            $permission = 'open_job_search_form';
	            break;
	        case '/search-results-jobs/':
	            $permission = 'view_job_search_results';
	            break;
	        case '/display-job':
	            $permission = 'view_job_details';
	            break;
	        default:
	            return array();
	            break;
	    }
	    $acl = SJB_Acl::getInstance();
	    
	    if ($acl->isAllowed($permission) && in_array($acl->getPermissionParams($permission), array('', '0')))
	        return $pageAccess;
	    
	    foreach ($contracts_id as $contractId) {
            if ($acl->isAllowed($permission, $contractId, 'contract')) {
                if (isset($pageAccess[$pageID]['count_views'])) {
                    $params = $acl->getPermissionParams($permission, $contractId, 'contract');
                    if (empty($pageAccess[$pageID]['count_views']) || empty($params))
                        $pageAccess[$pageID]['count_views'] = '';
                    else
                        $pageAccess[$pageID]['count_views'] += $params;
                }
                else {
                    $pageAccess[$pageID]['count_views'] = $acl->getPermissionParams($permission, $contractId, 'contract');
                }
                $pageAccess[$pageID]['contract_id'][] = $contractId;
            }	     
	    }
		return $pageAccess;
    }
    
    public static function getNumbeOfPagesViewed($user_id, $contracts_id, $pageID)
    {
    	$contractsIDs = implode(',', $contracts_id);
    	if (empty($contractsIDs))
    	    return 0;
    	$page_view = SJB_DB::query("SELECT count(param) FROM `page_view` WHERE id_user = ?s AND id_pages = ?s AND `contract_id` in ({$contractsIDs})", $user_id, $pageID);
    	return array_pop(array_pop($page_view));
    }
    
    public static function getAllContractsByMemebershipPlanSID($membership_plan_sid)
    {
    	 return SJB_DB::query("SELECT `id` FROM `contracts` WHERE `membership_plan_id` = ?n",$membership_plan_sid);
    }
    
    public static function removeSubscriptionId($subscriptionId)
    {
    	SJB_DB::query('UPDATE `contracts` SET `recurring_id` = \'\', `gateway_id` = \'\' WHERE `recurring_id` = ?s', $subscriptionId);
    }
    
    
    /* 16/07/2016 - resumes access bonus days*/
    public static function setNewExpirDateForContract($expiration_date_new, $user_sid, $plan_to_change_id)
    {
    	$changed_contract = SJB_DB::query("UPDATE `contracts` SET `expired_date`  = ?s WHERE `user_sid` = ?s AND membership_plan_id = ?s", $expiration_date_new, $user_sid, $plan_to_change_id);
    	return $expiration_date_new;
    }
    
    public static function resetBonusResumesValueByUserSID($user_sid)
    {
    	$reset_value = SJB_DB::query ("UPDATE `users_properties` SET `value` = '0' WHERE `object_sid` = ?s AND `id` = 'resume_bonus_days' ", $user_sid);
    	return $reset_value;    		
    }

    /* 16/07/2016 - END*/    
}
