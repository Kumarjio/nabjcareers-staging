<?php



return array

(

	'display_name' => 'Payment',

	'description' => 'Handles payment routines',



	'startup_script'	=>	array (),



	'functions' => array

	(

		'gateways' => array(

								'display_name'	=> 'Payment Gateway Control Panel',

								'script'		=> 'gateways.php',

								'type'			=> 'admin',

								'access_type'	=> array('admin'),

								'raw_output'	=> false,

								),

		'configure_gateway' => array(

								'display_name'	=> 'Payment Gateway Control Panel',

								'script'		=> 'configure_gateway.php',

								'type'			=> 'admin',

								'access_type'	=> array('admin'),

								'raw_output'	=> false,

								),



		'payment_complete' => array(

								'display_name'	=> 'Payments',

								'script'		=> 'list_payments.php',

								'type'			=> 'admin',

								'access_type'	=> array('admin'),

								'raw_output'	=> false,

								),



		'payments' => array(

								'display_name'	=> 'Payments',

								'script'		=> 'list_payments.php',

								'type'			=> 'admin',

								'access_type'	=> array('admin'),

								'raw_output'	=> false,

								),
								
	 'payments-error' => array(

								'display_name'	=> 'Payments-Error',

								'script'		=> 'payment_error.php',

								'type'			=> 'user',

								'params'		=> array ('display_template','payment_sid'),
								
								'access_type'	=> array('user'),

								'raw_output'	=> false

								),

		'open_invoices' => array(

								'display_name'	=> 'Open Invoices',

								'script'		=> 'manage_open_invoices.php',

								'type'			=> 'admin',

								'access_type'	=> array('admin'),

								'raw_output'	=> false,

		),

		'print_invoice' => array(

			'display_name'	=> 'Print Invoice',

			'script'		=> 'print_invoice.php',

			'type'			=> 'admin',

			'access_type'	=> array('admin'),

			'raw_output'	=> false,

		),



//

//               USER SCRIPTS

//



			'print_invoice' => array(

					'display_name'	=> 'Print Invoice',

					'script'		=> 'print_invoice.php',

					'type'			=> 'user',

					'access_type'	=> array('user'),

					'raw_output'	=> false,

			),

// 02-12-2014				
			'payment_page_quantumgateway' => array(
					'display_name'	=> 'Payment Quantum Gateway',
					'script'		=> 'payment_page_quantumgateway.php',
					'type'			=> 'user',
					'access_type'	=> array('user'),
					'raw_output'	=> false,
			),
			
			
			'quantum_declined' => array(
			
					'display_name'	=> 'Payment declined',
					'script'		=> 'quantum_declined.php',
					'type'			=> 'user',
					'access_type'	=> array('user'),
					'raw_output'	=> false,			
			),

			'quantum_approved' => array(
						
					'display_name'	=> 'Payment approved',
					'script'		=> 'quantum_approved.php',
					'type'			=> 'user',
					'access_type'	=> array('user'),
					'raw_output'	=> false,
			),
// end
// 10-03-2015 

			'prices' => array(
			
					'display_name'	=> 'Prices',
					'script'		=> 'prices.php',
					'type'			=> 'user',
					'access_type'	=> array('user'),
					'raw_output'	=> false,
			),

//end			

			

			
			
			

		'payment_page' => array(

								'display_name'	=> 'Payment',

								'script'		=> 'payment_page.php',

								'type'			=> 'user',

								'access_type'	=> array('user'),

								'raw_output'	=> false,

								),
		'payment_page_authorizenet' => array(
								'display_name'	=> 'Payment Authorize Net',
								'script'		=> 'payment_page_authorizenet.php',
								'type'			=> 'user',
								'access_type'	=> array('user'),
								'raw_output'	=> false,
								),
		'process_payment' => array(
								'display_name'	=> 'Process Payment',
								'script'		=> 'process_payment.php',
								'type'			=> 'user',
								'access_type'	=> array('user'),
								'raw_output'	=> false,
								),	



		'callback' => array(

								'display_name'	=> 'Payment',

								'script'		=> 'callback_payment_page.php',

								'type'			=> 'user',

								'access_type'	=> array('user'),

								'raw_output'	=> false,

								),
		'callback_net' => array(

								'display_name'	=> 'Payment',

								'script'		=> 'callback_payment_page_net.php',

								'type'			=> 'user',

								'access_type'	=> array('user'),

								'raw_output'	=> false,

								),

        'notifications' => array(

								'display_name'	=> 'Payment notifications',

								'script'		=> 'notifications_payment_page.php',

								'type'			=> 'user',

								'access_type'	=> array('user'),

								'raw_output'	=> false,

								),

		'service_completed' => array(

								'display_name'	=> 'Payment complited',

								'script'		=> 'service_completed.php',

								'type'			=> 'user',

								'access_type'	=> array('user'),

								'raw_output'	=> false,

								),

		'payments' => array(

								'display_name'	=> 'Payments',

								'script'		=> 'list_payments.php',

								'type'			=> 'user',

								'access_type'	=> array('user'),

								'raw_output'	=> false,

								),

		'cancel_recurring' => array(

								'display_name'	=> 'Cancel recurring',

								'script'		=> 'cancel_recurring.php',

								'type'			=> 'user',

								'access_type'	=> array('user'),

								'raw_output'	=> false,

								),								

		'cash_payment_page' => array(

								'display_name'	=> 'Payments',

								'script'		=> 'cash_payment_page.php',

								'type'			=> 'user',

								'access_type'	=> array('user'),

								'raw_output'	=> false,

								),

		'paypal_ipn' => array(

								'display_name'	=> 'PayPal IPN',

								'script'		=> 'paypal_ipn.php',

								'type'			=> 'user',

								'access_type'	=> array('user'),

								'raw_output'	=> false,

								),



	),

);

