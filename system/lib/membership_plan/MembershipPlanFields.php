<?php


class SJB_MembershipPlanFields
{
	function getFieldsInfo()
	{
		return array(
			'name' => array(
					'type' => 'string',
					'value' => '',
					'caption' => "Name",
					),
			
			'description' => array(
					'type' => 'text',
					'value' => '',
					'caption' => "Description",
					),
			
			'price' => array(
					'type' => 'float',
					'value' => '',
					'caption' => "Subscription Price",
					),
			
			'subscription_period' => array(
					'type' => 'integer',
					'value' => '',
					'caption' => "Expiration Period",
					),
					
			'user_group_sid' => array(
				'type'			=> 'integer',
				'value'			=> '',
			    'caption'	    => "User group",
				    ),
				    
			);
	}
}

