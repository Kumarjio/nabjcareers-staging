<?php

return array
(
	'display_name' => 'Membership Plan',
	'description' => 'No description',
	'classes' => 'classes/',
	'functions' => array
	(
		'membership_plans' => array
		(
			'display_name'	=> 'Membership Plans',
			'script'		=> 'membership_plans.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		'membership_plan' => array
		(
			'display_name'	=> 'Membership Plan',
			'script'		=> 'membership_plan.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		'add_membership_plan' => array
		(
			'display_name'	=> 'Add a Membership Plan',
			'script'		=> 'membership_plan.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		'package' => array
		(
			'display_name'	=> 'Package',
			'script'		=> 'package.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		'add_package' => array
		(
			'display_name'	=> 'Package',
			'script'		=> 'package.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'subscription_page' => array
		(
			'display_name'	=> 'Package',
			'script'		=> 'subscription_page.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),		
		'create_contract' => array
		(
			'display_name'	=> 'Create Contract',
			'script'		=> 'create_contract.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		
		'user_membership_plan' => array
		(
			'display_name'	=> 'User Membership Plan',
			'script'		=> 'user_membership_plan.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
			),

		'user_membership_plans' => array
		(
			'display_name'	=> 'User Membership Plans',
			'script'		=> 'user_membership_plans.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),

		),
		
);

