<?php

return array
(
	'display_name' => 'Main',
	'description' => 'Home page and all site pages',
	'classes' => 'classes/',
	'startup_script' => array (
		'admin' => 'admin_login',
	),
	'functions' => array
	(
		'admin_login' => array
		(
			'display_name'	=> 'Admin Login Page',
			'script'		=> 'admin_login.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		'show_user_page' => array
		(
			'display_name'	=> 'Show Page',
			'script'		=> 'show_page.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		'show_admin_page' => array
		(
			'display_name'	=> 'Show Page',
			'script'		=> 'show_page.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
			'raw_output'	=> true,
		),
	),
);
