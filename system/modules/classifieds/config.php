<?php


return array
(
	'display_name' => 'Classifieds engine',
	'description' => 'Classifieds engine',
	'classes' => 'classes/',
/*	'startup_script' =>	array (
		'user' => 'init_dbtypes',
		'admin' => 'init_dbtypes_admin'
	),
*/
	'functions' => array
	(
		'listing_fields' => array
		(
			'display_name'	=> 'Listing Fields',
			'script'		=> 'listing_fields.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'add_listing_field' => array
		(
			'display_name'	=> 'Add Listing Field',
			'script'		=> 'add_listing_field.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'edit_listing_field' => array
		(
			'display_name'	=> 'Edit Listing Field',
			'script'		=> 'edit_listing_field.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'delete_listing_field' => array
		(
			'display_name'	=> 'Delete Listing Field',
			'script'		=> 'delete_listing_field.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'listing_types' => array
		(
			'display_name'	=> 'Listing Types',
			'script'		=> 'listing_types.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'edit_listing_type' => array
		(
			'display_name'	=> 'Edit Listing Type',
			'script'		=> 'edit_listing_type.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
			
			
			
			'job-fairs'	 => array
		(
			'display_name'	=> 'Manage Job fairs',
			'script'		=> 'edit_complex_fields.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
			
			
		
		'add_listing_type' => array
		(
			'display_name'	=> 'Add Listing Type',
			'script'		=> 'add_listing_type.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'delete_listing_type' => array
		(
			'display_name'	=> 'Delete Listing Type',
			'script'		=> 'delete_listing_type.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'add_listing_type_field' => array
		(
			'display_name'	=> 'Add Listing Type Field',
			'script'		=> 'add_listing_type_field.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'edit_listing_type_field' => array
		(
			'display_name'	=> 'Edit Listing Type Field',
			'script'		=> 'edit_listing_type_field.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'delete_listing_type_field' => array
		(
			'display_name'	=> 'Delete Listing Type Field',
			'script'		=> 'delete_listing_type_field.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'attention_listing_type_field' => array
		(
			'display_name'	=> 'Attention',
			'script'		=> 'attention_listing_type_field.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),

		'add_listing' => array
		(
			'display_name'	=> 'Add Listing',
			'script'		=> 'add_listing.php',
			'type'			=> 'user',
			'access_type'	=> array('admin', 'user'),
			'params'		=> array ('input_template')
		),

		'display_listing' => array
		(
			'display_name'	=> 'Display Listing',
			'script'		=> 'display_listing.php',
			'type'			=> 'user',
			'access_type'	=> array('admin', 'user'),
			'params'		=> array ('display_template')
		),
			
			
				'manage_resume' => array
				(
						'display_name'	=> 'Manage Resume',
						'script'		=> 'manage_resume.php',
						'type'			=> 'user',
						'access_type'	=> array('admin', 'user'),
						'params'		=> array ('display_template')
				),
			
				'manage_job' => array
				(
						'display_name'	=> 'Manage Job',
						'script'		=> 'manage_job.php',
						'type'			=> 'user',
						'access_type'	=> array('admin', 'user'),
						'params'		=> array ('display_template')
				),

		'print_listing' => array
		(
			'display_name'	=> 'Print Listing',
			'script'		=> 'display_listing.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
			'params'		=> array ('display_template')
		),

		'search_form' => array
		(
			'display_name'	=> 'Search Form',
			'script'		=> 'search_form.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
			'params'		=> array ('listing_type_id', 'form_template'),
		),

		'search_results' => array
		(
			'display_name'	=> 'Search Form',
			'script'		=> 'search_results.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
			'params'		=> array ('default_sorting_field',
									  'default_sorting_order',
									  'default_listings_per_page',
									  'results_template'),
		),

		'pay_for_listing' => array
		(
			'display_name'	=> 'Pay For Listing',
			'script'		=> 'pay_for_listing.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		
		'activate_listing' => array
		(
			'display_name'	=> 'Activate Listing',
			'script'		=> 'activate_listing.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),

		'manage_listings' => array
		(
			'display_name'	=> 'Manage Listings',
			'script'		=> 'manage_listings.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),

		'listing_actions' => array
		(
			'display_name'	=> '',
			'script'		=> 'listing_actions.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),

		'edit_listing' => array
		(
			'display_name'	=> 'Edit Listing',
			'script'		=> 'edit_listing.php',
			'type'			=> 'user',
			'access_type'	=> array('admin', 'user'),
			'params'		=> array ('edit_template')
		),
		
		'add_listing_step' => array
		(
			'display_name'	=> 'Add Listing',
			'script'		=> 'add_listing_step.php',
			'type'			=> 'user',
			'access_type'	=> array('admin', 'user'),
			'params'		=> array ('edit_template')
		),
		
		'my_listings' => array
		(
			'display_name'	=> 'My Listings',
			'script'		=> 'my_listings.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
			'params'		=> array ('listing_type_id'),
		),
		
		'edit_list' => array
		(
			'display_name'	=> 'Edit List',
			'script'		=> 'edit_list.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'edit_complex_fields' => array
		(
			'display_name'	=> 'Edit Fields',
			'script'		=> 'edit_complex_fields.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		'edit_complex_list' => array
		(
			'display_name'	=> 'Edit List',
			'script'		=> 'edit_complex_list.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'edit_list_item' => array
		(
			'display_name'	=> 'Edit List Item',
			'script'		=> 'edit_list_item.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'edit_complex_list_item' => array
		(
			'display_name'	=> 'Edit List Item',
			'script'		=> 'edit_complex_list_item.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'manage_pictures' => array
		(
			'display_name'	=> 'Manage Pictures',
			'script'		=> 'manage_pictures.php',
			'type'			=> 'user',
			'access_type'	=> array('admin', 'user'),
		),
		
		'listing_picture' => array
		(
			'display_name'	=> 'Listing Picture',
			'script'		=> 'listing_picture.php',
			'type'			=> 'admin',
			'raw_output' 	=> true,
			'access_type'	=> array('admin', 'user'),
		),
		
		'edit_picture' => array
		(
			'display_name'	=> 'Edit Listing Picture',
			'script'		=> 'edit_listing_picture.php',
			'type'			=> 'user',
			'access_type'	=> array('admin', 'user'),
		),
		
		'manage_listing' => array
		(
			'display_name'	=> 'Manage Listing',
			'script'		=> 'manage_listing.php',
			'type'			=> 'user',
			'access_type'	=> array('admin', 'user'),
		),

		'edit_tree' => array
		(
			'display_name'	=> 'Edit Tree',
			'script'		=> 'edit_tree.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'edit_complex_tree' => array
		(
			'display_name'	=> 'Edit Tree',
			'script'		=> 'edit_complex_tree.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'import_tree_data' => array
		(
			'display_name'	=> 'Import Tree Data',
			'script'		=> 'import_tree_data.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'move_listing_type_field' => array
		(
			'display_name'	=> '',
			'script'		=> 'move_listing_type_field.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'save_listing' => array
		(
			'display_name'	=> 'Save Listing',
			'script'		=> 'save_listing.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		
		'saved_listings' => array
		(
			'display_name'	=> 'Saved Listings',
			'script'		=> 'saved_listings.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
			'params'		=> array ('listing_type_id'),
		),
		
		'save_search' => array
		(
			'display_name'	=> 'Save Search',
			'script'		=> 'save_search.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),

		'saved_searches' => array
		(
			'display_name'	=> 'Saved Searches',
			'script'		=> 'saved_searches.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
			'params'		=> array ('listing_type_id', 'form_template', 'is_alert'),
		),

		'contact_seller' => array
		(
			'display_name'	=> 'Contact Seller',
			'script'		=> 'contact_seller.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		'apply_now' => array
		(
			'display_name'	=> 'Apply Now',
			'script'		=> 'apply_now.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),

		'tell_friend' => array
		(
			'display_name'	=> 'Tell a friend',
			'script'		=> 'tell_friend.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),

		'loan_calculator' => array
		(
			'display_name'	=> 'Loan Calculator',
			'script'		=> 'loan_calculator.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		
		'delete_uploaded_file' => array
		(
			'display_name'	=> 'Delete Uploaded File',
			'script'		=> 'delete_uploaded_file.php',
			'type'			=> 'user',
			'access_type'	=> array('user', 'admin'),
		),
		
		'delete_complex_file' => array
		(
			'display_name'	=> 'Delete Uploaded File',
			'script'		=> 'delete_complex_file.php',
			'type'			=> 'user',
			'access_type'	=> array('user', 'admin'),
		),
		
		'featured_listings' => array
		(
			'display_name'	=> 'Featured Listings',
			'script'		=> 'featured_listings.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
			'params'		=> array ('featured_listings_template', 'number_of_rows', 'number_of_cols'),
		),
		'latest_listings' => array
		(
			'display_name'	=> 'Latest Listings',
			'script'		=> 'latest_listings.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
			'params'		=> array ('count_listing','listing_type','listings_template'),
		),

		'import_listings' => array
		(
			'display_name'	=> 'Import Listings',
			'script'		=> 'import_listings.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'export_listings' => array
		(
			'display_name'	=> 'Export Listings',
			'script'		=> 'export_listings.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
			'raw_output' 	=> false,
		),
		
		'archive_and_send_export_data' => array
		(
			'display_name'	=> 'Archive And Send Export Data',
			'script'		=> 'archive_and_send_export_data.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
			'raw_output' 	=> true,
		),
		
		'make_featured' => array
		(
			'display_name'	=> 'Make Featured',
			'script'		=> 'make_featured.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		
		'make_priority' => array
		(
			'display_name'	=> 'Make Priority',
			'script'		=> 'make_priority.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		
		'resume_alerts' => array
		(
			'display_name'	=> 'Get resumes by email',
			'script'		=> 'alerts.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		
		'job_alerts' => array
		(
			'display_name'	=> 'Get job by email',
			'script'		=> 'alerts.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		
		
		'browse' => array
		(
			'display_name'	=> 'Browse',
			'script'		=> 'browse.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
			'params'		=> array (
				'level1Field',
				'level2Field',
				'level3Field',
				'level4Field',
				'level5Field',
				'level6Field',
				'browse_template',
				'listing_type_id',
				'columns'
			),
		),
		'alerts' => array
		(
			'display_name'	=> 'Alerts',
			'script'		=> 'alerts.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
			'params'		=> array ('listing_type_id', 'form_template'),
		),
		'display_my_listing' => array
		(
			'display_name'	=> 'Display My Listing',
			'script'		=> 'display_my_listing.php',
			'type'			=> 'user',
			'access_type'	=> array('admin', 'user'),
			'params'		=> array ('display_template')
		),
				
		'clone_job' => array
		(
			'display_name'	=> 'Copy Job',
			'script'		=> 'copy_listing.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
			'params'		=> array ('edit_template')
		),
		
		'listing_feeds' => array
		(
			'display_name'	=> 'Listing Feeds',
			'script'		=> 'listing_feeds.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
			'params'		=> array ('count_listings'),
		),
		'get_tree' => array
		(
			'display_name'	=> 'Get tree values',
			'script'		=> 'get_tree.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		
		'browseCompany' => array
		(
			'display_name'	=> 'Search By Company',
			'script'		=> 'browseCompany.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
			'params'		=> array ('display_template','listing_type_id')
		),

			
			

			
			
			
			
			'browseUsernameJSAdmin' => array
			(
					'display_name'	=> 'Admin - Search By Username',
					'script'		=> 'browseUsernameJSAdmin.php',
					'type'			=> 'admin',
					'access_type'	=> array('admin'),
					'params'		=> array ('display_template','listing_type_id')
			),
			
			'browseCompanyAdmin' => array
			(
					'display_name'	=> 'Admin - Search By Company',
					'script'		=> 'browseCompanyAdmin.php',
					'type'			=> 'admin',
					'access_type'	=> array('admin'),
					'params'		=> array ('display_template','listing_type_id')
			),
				
			
			
			
			
		'notes' => array
		(
			'display_name'	=> 'Add Notes',
			'script'		=> 'notes.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
			'params'		=> array ('action')
		),
				
		'alphabet_letters' => array
		(
			'display_name'	=> 'Alphabet Letters for “Search by Company�? section',
			'script'		=> 'alphabet_letters.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'import_users' => array
		(
			'display_name'	=> 'Import Users',
			'script'		=> 'import_users.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'refine_search' => array
		(
			'display_name'	=> 'refine search settings',
			'script'		=> 'refine_search.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		'job_import' => array
		(
			'display_name'	=> 'Bulk job import from exl/csv file',
			'script'		=> 'job_import.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
			'params'		=> array ('listing_type_id')
		),
		'count_listings' => array
		(
			'display_name'	=> 'count_listings',
			'script'		=> 'count_listings.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		
		'flag_listing' => array
		(
			'display_name'	=> 'Flag Listing',
			'script'		=> 'flag_listing.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		
		'select_flagged_listing_type' => array
		(
			'display_name'	=> 'Select Flagged Listing Type',
			'script'		=> 'select_flagged_listing_type.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
		
		'flagged_listings' => array
		(
			'display_name'	=> 'Flagged Listings',
			'script'		=> 'flagged_listings.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),

						
						'deleted_listings' => array
						(
								'display_name'	=> 'Deleted Listings',
								'script'		=> 'deleted_listings.php',
								'type'			=> 'admin',
								'access_type'	=> array('admin'),
						),
				
			
			

			/* 2016 march job credits mod */
			'activated-with-credits' => array
			(
					'display_name'	=> 'Activated with credits',
					'script'		=> 'activated-with-credits.php',
					'type'			=> 'user',
					'access_type'	=> array('user'),
			),
			/* end job credits mod */
					
			
			
			
		'twitter' => array
		(
			'display_name'	=> 'twitter',
			'script'		=> 'twitter.php',
			'type'			=> 'user',
			'access_type'	=> array('user'),
		),
		
		'posting_pages' => array
		(
			'display_name'	=> 'posting_pages',
			'script'		=> 'posting_pages.php',
			'type'			=> 'admin',
			'access_type'	=> array('admin'),
		),
	),
);
