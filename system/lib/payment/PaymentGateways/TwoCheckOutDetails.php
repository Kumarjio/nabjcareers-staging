<?php

require_once "payment/PaymentGateway/PaymentGatewayDetails.php";

class SJB_TwoCheckOutDetails extends SJB_PaymentGatewayDetails
{
    public static function getDetails()
	{
        $common_details = parent::getDetails();
		$specific_details = array
			   (
				array
				(
					'id'		=> '2co_account_id',
					'caption'	=> '2Checkout vendor ID',
					'type'		=> 'string',
					'length'	=> '20',
					'is_required'=> true,
					'is_system' => false,
				),
				array
				(
					'id'		=> 'secret_word',
					'caption'	=> '2Checkout secret word',
					'type'		=> 'string',
					'length'	=> '20',
					'is_required'=> true,
					'is_system' => false,
				),
                array
				(
					'id'		=> '2co_api_user_login',
					'caption'	=> '2Checkout API user login',
					'type'		=> 'string',
					'length'	=> '20',
					'is_required'=> false,
					'is_system' => false,
				),
                array
				(
					'id'		=> '2co_api_user_password',
					'caption'	=> '2Checkout API user password',
					'type'		=> 'string',
					'length'	=> '20',
					'is_required'=> false,
					'is_system' => false,
				),
				array
				(
					'id'		=> 'demo',
					'caption'	=> 'Demo mode <br> <span class="note">check to enable Demo mode</span>',
					'type'		=> 'boolean',
					'length'	=> '20',
					'is_required'=> true,
					'is_system' => false,
				),
			   );

		require_once 'membership_plan/MembershipPlanManager.php';
		$membershipPlans = SJB_MembershipPlanManager::getAllMembershipPlansInfo();
		foreach ($membershipPlans as $membershipPlanInfo) {
			$membershipPlan = new SJB_MembershipPlan($membershipPlanInfo);
			if (!$membershipPlan->isRecurring())
				continue;
			$specific_details[] = array(
				'id'		=> 'membership_plan_' . $membershipPlanInfo['id'],
				'caption'	=> 'Membership plan "' . $membershipPlanInfo['name'] . '" recurring product ID',
				'type'		=> 'string',
				'length'	=> '255',
				'is_required'=> true,
				'is_system' => false,
			);
		}

		return array_merge($common_details, $specific_details);
	}
}

