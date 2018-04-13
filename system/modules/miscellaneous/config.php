<?php

return array
(
	'display_name' => 'Miscellaneous',
	'description' => 'Miscellaneous routines',

	'startup_script'	=>	array (),

	'functions' => array
	(
		'geographic_data' => array
		(
			'display_name'	=> 'Geographic Data',
			'script'		=> 'geographic_data.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'currency' => array
		(
			'display_name'	=> 'Manage Currencies',
			'script'		=> 'currency.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'import_geographic_data' => array
		(
			'display_name'	=> 'Geographic Data',
			'script'		=> 'import_geographic_data.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),

		'edit_location' => array
		(
			'display_name'	=> 'Edit Location',
			'script'		=> 'edit_location.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'settings' => array
		(
			'display_name'	=> 'Settings',
			'script'		=> 'settings.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'filters' => array
		(
			'display_name'	=> 'filters',
			'script'		=> 'filters.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
				
		'task_scheduler' => array
		(
			'display_name'	=> 'Settings',
			'script'		=> 'task_scheduler.php',
			'raw_output'		=> true,
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		
		'task_scheduler_settings' => array
		(
			'display_name'	=> 'Task Scheduler Settings',
			'script'		=> 'task_scheduler_settings.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'uploaded_file' => array
		(
			'display_name'	=> 'Uploaded File',
			'script'		=> 'uploaded_file.php',
			'raw_output'		=> true,
			'type'			=> 'user',
			'access_type'	=> array('user', 'admin'),
		),
		'ajax_rate' => array
		(
			'display_name'	=> 'Ajax rate',
			'script'		=> 'ajax.php',
			//'raw_output'		=> true,
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		'ajax_comment' => array
		(
			'display_name'	=> 'Ajax rate',
			'script'		=> 'ajax.php',
			//'raw_output'		=> true,
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		'adminpswd' => array
		(
			'display_name'	=> 'Admin Password',
			'script'		=> 'adminpswd.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),

		'contact_form' => array
		(
			'display_name'	=> 'Contact Form',
			'script'		=> 'contact_form.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		
		'upgradeFieldToMonetary' => array
        (
            'display_name'    => 'Contact Form',
            'script'        => 'upgradeFieldToMonetary.php',
            'type'            => 'user',
            'access_type'    => array('user'),
        ),
        
		'plugins' => array
		(
			'display_name'	=> 'Plugins',
			'script'		=> 'plugins.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'backup' => array
		(
			'display_name'	=> 'Backup',
			'script'		=> 'backup.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'blog_page' => array
		(
			'display_name'	=> 'Blog Page',
			'script'		=> 'blog_page.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),

		'flag_listing_settings' => array
		(
			'display_name'	=> 'Flag Listing Settings',
			'script'		=> 'flag_listing_settings.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'sitemap_generator' => array
		(
			'display_name'	=> 'sitemap generator',
			'script'		=> 'sitemap_generator.php',
			'raw_output'		=> true,
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),

		'captcha' => array
		(
			'display_name'	=> 'captcha',
			'script'		=> 'captcha.php',
			'raw_output'		=> true,
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		'maintenance_mode' => array
		(
			'display_name'	=> 'Maintenance Mode',
			'script'		=> 'maintenance_mode.php',
			'raw_output'		=> true,
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		'kcfinder' => array
		(
			'display_name'	=> 'KCFinder',
			'script'		=> 'kcfinder.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
	),
);
