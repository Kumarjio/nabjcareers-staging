<?php

require_once("orm/ObjectDetails.php");
require_once("orm/ObjectProperty.php");

class SJB_UserGroupDetails extends SJB_ObjectDetails
{
	function SJB_UserGroupDetails($user_group_info)
	{
		$details_info = SJB_UserGroupDetails::getDetails();
		foreach ($details_info as $detail_info) {
			$detail_info['value'] = '';
			if (isset($user_group_info[$detail_info['id']])) {
				$detail_info['value'] = $user_group_info[$detail_info['id']];
			}
			$this->properties[$detail_info['id']] = new SJB_ObjectProperty($detail_info);
		}
	}
	
	public static function getDetails()
	{
		return array (
				array (
					'id'		=> 'id',
					'caption'	=> 'ID', 
					'type'		=> 'unique_string',
					'length'	=> '20',
                    'table_name'=> 'user_groups',
					'is_required'=> true,
					'is_system'	=> true,
				),
				array (
					'id'		=> 'name',
					'caption'	=> 'Group name', 
					'type'		=> 'string',
					'length'	=> '20',
                    'table_name'=> 'user_groups',
					'is_required'=> true,
					'is_system'	=> false,
				),
				array (
					'id'		=> 'reg_form_template',
					'caption'	=> 'Registration form template',
					'type'		=> 'string',
					'length'	=> '',
					'is_required'=> false,
					'is_system'	=> false,
				),
				array (
					'id'		=> 'description',
					'caption'	=> 'Description',
					'type'		=> 'string',
					'length'	=> '',
					'is_required'=> false,
					'is_system'	=> false,
				),
				array (
					'id'		 => 'send_activation_email',
					'caption'	 => 'Send Activation Email',
					'type'		 => 'boolean',
					'comment'	 => 'Enable this setting if you want users to activate their account using the activation link sent to their email.',
					'length'	 => '',
					'is_required'=> false,
					'is_system'	 => false,
				),
				array (
					'id'		 => 'approve_user_by_admin',
					'caption'	 => 'Approve Users by Admin',
					'type'		 => 'boolean',
					'comment'	 => 'Enable this setting if you want users of this group to be approved by admin, before their account will be activated.',
					'length'	 => '',
					'is_required'=> false,
					'is_system'	 => false,
				),
				array (
					'id'		 => 'email_confirmation',
					'caption'	 => 'Require email confirmation',
					'type'		 => 'boolean',
					'comment'	 => 'If this box is checked, users will be asked to enter their email twice for confirmation when registering.',
					'length'	 => '',
					'is_required'=> false,
					'is_system'	 => false,
				),
				array (
					'id'		 => 'user_menu_template',
					'caption'	 => 'User Menu Template',
					'type'		 => 'string',
					'length'	 => '',
					'is_required'=> false,
					'is_system'	 => false,
				),
				array (
					'id'		 => 'show_mailing_flag',
					'caption'	 => "Show \"Don't send mailings\" check box<br/> in user profile",
					'type'		 => 'boolean',
					'length'	 => '',
					'is_required'=> false,
					'is_system'	 => false,
				),
				array (
					'id'		 => 'user_email_as_username',
					'caption'	 => 'User email as user name',
					'type'		 => 'boolean',
					'comment'	 => 'Set this setting if you want users to use their email<br/> instead of user name when sign in',
					'length'	 => '',
					'is_required'=> false,
					'is_system'	 => false,
				),
				array (
					'id'		 => 'notify_on_listing_activation',
					'caption'	 => 'Notify User on Listings Activation',
					'type'		 => 'boolean',
					'length'	 => '',
					'is_required'=> false,
					'is_system'	 => false,
				),
				array (
					'id'		 => 'notify_on_listing_expiration',
					'caption'	 => 'Notify User on Listings Expiration',
					'type'		 => 'boolean',
					'length'	 => '',
					'is_required'=> false,
					'is_system'	 => false,
				),
				array (
					'id'		 => 'notify_on_contract_expiration',
					'caption'	 => 'Notify User on Subscriptions Expiration',
					'type'		 => 'boolean',
					'length'	 => '',
					'is_required'=> false,
					'is_system'	 => false,
				),
				array (
					'id'		 => 'notify_on_listing_approve_or_reject',
					'caption'	 => 'Notify User on Listings Approval or Rejection',
					'type'		 => 'boolean',
					'length'	 => '',
					'is_required'=> false,
					'is_system'	 => false,
				),
				array (
					'id'		 => 'notify_on_private_message',
					'caption'	 => 'Notify User on New Private Messages',
					'type'		 => 'boolean',
					'length'	 => '',
					'is_required'=> false,
					'is_system'	 => false,
				),
				array (
					'id'		 => 'notify_subscription_activation',
					'caption'	 => 'Notify User on Subscriptions Activation',
					'type'		 => 'boolean',
					'length'	 => '',
					'is_required'=> false,
					'is_system'	 => false,
				),
				array (
					'id'		 => 'notify_subscription_expire_date',
					'caption'	 => 'Remind User about Subscriptions Expiration',
					'type'		 => 'boolean',
					'length'	 => '',
					'is_required'=> false,
					'is_system'	 => false,
				),
				array (
					'id'		 => 'notify_subscription_expire_date_days',
					'caption'	 => 'days before',
					'type'		 => 'integer',
					'length'	 => '',
					'is_required'=> false,
					'is_system'	 => false,
				),
				array (
					'id'		 => 'notify_listing_expire_date',
					'caption'	 => 'Remind User about Listings Expiration',
					'type'		 => 'boolean',
					'length'	 => '',
					'is_required'=> false,
					'is_system'	 => false,
				),
				array (
					'id'		 => 'notify_listing_expire_date_days',
					'caption'	 => 'days before',
					'type'		 => 'integer',
					'length'	 => '',
					'is_required'=> false,
					'is_system'	 => false,
				),
			   );
	}
}
