<?php


return array
(
	'display_name' => 'Plugins',
	'description' => 'Plugins',
	'classes' => 'classes/',
	'functions' => array
	(
		'reloadCustomCaptcha' => array
		(
			'display_name'	=> 'reloadCustomCaptcha',
			'script'		=> 'captcha/reloadCustomCaptcha.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		
		'partnersite' => array
		(
			'display_name'	=> 'partnersite',
			'script'		=> 'indeed/partnersite.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
	),
);
