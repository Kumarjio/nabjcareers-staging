<?php

$GLOBALS['LEFT_ADMIN_MENU']['Listing Configuration'] = array

(

	array

	(

		'title' => 'Common Fields',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/listing-fields/',

		'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/add-listing-field/',

			SJB_System::getSystemsettings('SITE_URL').'/edit-listing-field/',

			SJB_System::getSystemsettings('SITE_URL').'/delete-listing-field/',

			SJB_System::getSystemsettings('SITE_URL').'/edit-listing-field/edit-tree/',

		),

		'perm_label'	=>	'manage_common_listing_fields',

	),

	array

	(

		'title' => 'Listing Types',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/listing-types/',

		'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/add-listing-type/',

			SJB_System::getSystemsettings('SITE_URL').'/edit-listing-type/',

			SJB_System::getSystemsettings('SITE_URL').'/delete-listing-type/',

			SJB_System::getSystemsettings('SITE_URL').'/add-listing-type-field/',

			SJB_System::getSystemsettings('SITE_URL').'/edit-listing-type-field/',

			SJB_System::getSystemsettings('SITE_URL').'/delete-listing-type-field/',

			SJB_System::getSystemsettings('SITE_URL').'/posting-pages/',

		),

		'perm_label'	=>	array('manage_listing_types_and_specific_listing_fields','set_posting_pages')



	),

);







$GLOBALS['LEFT_ADMIN_MENU']['Listing Management'] = array

(

	array

	(

		'title' => 'Manage Listings',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/manage-listings/',

		'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/edit-listing/',

			SJB_System::getSystemsettings('SITE_URL').'/manage-pictures/',

			SJB_System::getSystemsettings('SITE_URL').'/edit-picture/',

		),

		'perm_label'	=>	'manage_listings',

	),

	array

	(

		'title' => 'Import Listings',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/import-listings/',

		'highlight' => array(),

		'perm_label'	=>	'import_listings',

	),

	array

	(

		'title' => 'Export Listings',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/export-listings/',

		'highlight' => array(),

		'perm_label'	=>	'export_listings',

	),

	array

	(

		'title' => 'XML Feeds',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/listing-feeds/',

		'highlight' => array(),

		'perm_label'	=>	'set_xml_feeds',

	),

	array

	(

		'title' => 'XML Import',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/show-import/',

		'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/add-import/',

			SJB_System::getSystemsettings('SITE_URL').'/edit-import/',

			SJB_System::getSystemsettings('SITE_URL').'/run-import/',

		),

		'perm_label'	=>	'set_xml_import',

	),

	array

	(

		'title' => 'Flagged Listings',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/flagged-listings/',

		'highlight' => array(),

		'perm_label'	=>	'manage_flagged_listings',

	)

);





$GLOBALS['LEFT_ADMIN_MENU']['Users'] = array

(



	array

	(

		'title' => 'User Groups',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/user-groups/',

		'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/add-user-group/',

			SJB_System::getSystemsettings('SITE_URL').'/edit-user-group/',

			SJB_System::getSystemsettings('SITE_URL').'/delete-user-group/',

			SJB_System::getSystemsettings('SITE_URL').'/edit-user-profile/',

			SJB_System::getSystemsettings('SITE_URL').'/add-user-profile-field/',

		),

		'perm_label'	=>	array('manage_user_groups','manage_user_groups_permissions')

	),

	array

	(

		'title' => 'Manage Job Seekers',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/users/?user_group_id=JobSeeker',

		'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/edit-user/',

			SJB_System::getSystemsettings('SITE_URL').'/add-user/',

			SJB_System::getSystemsettings('SITE_URL').'/users/?user_group_id=JobSeeker',

		),

		'perm_label'	=>	'manage_jobseeker',

	),

	array

	(

		'title' => 'Manage Employers',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/users/?user_group_id=Employer',

		'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/edit-user/',

			SJB_System::getSystemsettings('SITE_URL').'/add-user/',

			SJB_System::getSystemsettings('SITE_URL').'/users/?user_group_id=Employer',

			

		),

		'perm_label'	=>	'manage_employer',

	),

	array

	(

		'title' => 'Import Users',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/import-users/',

		'highlight' => array(),

		'perm_label'	=>	'import_users',

	),

	array

	(

		'title' => 'Export Users',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/export-users/',

		'highlight' => array(),

		'perm_label'	=>	'export_users',

	),

	array

	(

		'title' => 'Mass Mailing',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/mailing/',

		'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/add-user/',

		),

		'perm_label'	=>	'create_and_send_mass_mailings',

	),
	array
	(
		'title' => 'Newsletter',
		'reference' => SJB_System::getSystemsettings('SITE_URL').'/newsletter/',
		'highlight' => array(),
		'perm_label'	=>	'create_and_send_newsletter',
	),

	array

	(

		'title' => 'Membership Plans',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/membership-plans/',

		'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/membership-plan/',

			SJB_System::getSystemsettings('SITE_URL').'/membership-plan/add/',

			SJB_System::getSystemsettings('SITE_URL').'/membership-plan/package/',

			SJB_System::getSystemsettings('SITE_URL').'/membership-plan/add-package/',

		),

		'perm_label'	=>	'manage_membership_plans',

	),

	array

	(

		'title' => 'Banned IPs',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/banned-ips/',

		'perm_label'	=>	'manage_banned_ips',

	),

);



$GLOBALS['LEFT_ADMIN_MENU']['Layout and Content'] = array

(

	array

	(

		'title' => 'Edit Templates',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/edit-templates/',

		'perm_label'	=>	'edit_templates_and_themes',

	),

	array

	(

		'title' => 'Themes',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/edit-themes/',

		'perm_label'	=>	'edit_templates_and_themes',

	),	

	array

	(

		'title' => 'Site Pages',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/user-pages/',

		'perm_label'	=>	'manage_site_pages',

	),	

	array

	(

		'title' => 'Static Content',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/stat-pages/',

		'perm_label'	=>	'manage_static_content',

	),

	array

    (

        'title' => 'Banners',

        'reference' => SJB_System::getSystemsettings('SITE_URL').'/manage-banner-groups/',

    	'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/add-banner-group/',

			SJB_System::getSystemsettings('SITE_URL').'/edit-banner-group/',

			SJB_System::getSystemsettings('SITE_URL').'/edit-banner/',

			SJB_System::getSystemsettings('SITE_URL').'/add-banner/',

		),

		'perm_label'	=>	'manage_banners',

   ),

    array

    (

        'title' => 'News',

        'reference' => SJB_System::getSystemsettings('SITE_URL').'/news-categories/',

    	'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/manage-news/',

		),

		'perm_label'	=>	'manage_news',

    ),

);



$GLOBALS['LEFT_ADMIN_MENU']['Payments'] = array

(

	array

	(

		'title' => 'Payment Gateways',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/system/payment/gateways/',

		'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/configure-gateway/',

		),

		'perm_label'	=>	'set_up_payment_gateways',

	),

	array

	(

		'title' => 'Invoice Log',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/system/payment/payments/',

		'perm_label'	=>	'manage_payments',

	),



);



$GLOBALS['LEFT_ADMIN_MENU']['System Configuration'] = array

(

	array

	(

		'title' => 'System Settings',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/settings/',

		'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/alphabet-letters/',

		),

		'perm_label'	=>	'configure_system_settings',

	),

	array

	(

		'title' => 'Admin Password',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/adminpswd/',

	),

	array

	(

		'title' => 'Admin Sub Accounts',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/manage-subadmins/',

		'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/add-subadmin/',

			SJB_System::getSystemsettings('SITE_URL').'/edit-subadmin/',

		),

	),

	array

	(

		'title' => 'ZipCode Database',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/geographic-data/',

		'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/geographic-data/import-data/',

			SJB_System::getSystemsettings('SITE_URL').'/geographic-data/edit-location/',

		),

		'perm_label'	=>	'edit_zipcode_database',

	),

	array

	(

		'title' => 'Manage Currencies',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/currency-list/',

		'perm_label'	=>	'manage_currencies',

	),

	array

	(

		'title' => 'Refine Search Settings',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/refine-search-settings/',

		'perm_label'	=>	'set_refine_search_parameters',

	),

	array

	(

		'title' => 'Flag Listing Settings',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/flag-listing-settings/',

		'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/flag/',

			SJB_System::getSystemsettings('SITE_URL').'/flag/',

		),

		'perm_label'	=>	'edit_flag_listing_settings',

	),

	array

	(

		'title' => 'Breadcrumbs Config',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/manage-breadcrumbs/',

		'perm_label'	=>	'configure_breadcrumbs',

	),

	array

	(

		'title' => 'HTML filters',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/filters/',

		'perm_label'	=>	'set_html_filters',

	),

	array

	(

		'title' => 'Task Scheduler',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/task-scheduler-settings/',

		'perm_label'	=>	'set_task_scheduler',

	),

	array

	(

		'title' => 'Plugins',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/system/miscellaneous/plugins/',

		'perm_label'	=>	array('manage_plug-ins','set_phpbb_plug-in','set_twitter_plug-in','set_wordpress_plug-in'),

	),

	array

	(

		'title' => 'Backup/Restore',

		'reference' => SJB_System::getSystemsettings('SITE_URL').'/backup/',

		'perm_label'	=>	'create_and_restore_backups',

	),

);



$GLOBALS['LEFT_ADMIN_MENU']['Language Management'] = array

(

    array

    (

        'title' => 'Manage Languages',

        'reference' => SJB_System::getSystemsettings('SITE_URL').'/manage-languages/',

		'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/edit-language/',

			SJB_System::getSystemsettings('SITE_URL').'/edit-language/',

		),

		'perm_label'	=>	'manage_languages',

    ),

    array

    (

        'title' => 'Translate Phrases',

        'reference' => SJB_System::getSystemsettings('SITE_URL').'/manage-phrases/',

		'highlight' => array

		(

			SJB_System::getSystemsettings('SITE_URL').'/add-phrase/',

		),

		'perm_label'	=>	'translate_phrases',

    ),

    array

    (

        'title' => 'Import Language',

        'reference' => SJB_System::getSystemsettings('SITE_URL').'/import-language/',

		'perm_label'	=>	'import_languages',

    ),

    array

    (

        'title' => 'Export Language',

        'reference' => SJB_System::getSystemsettings('SITE_URL').'/export-language/',

		'perm_label'	=>	'export_languages',

    ),

);











// set subadmin mode

if (SJB_SubAdmin::getSubAdminSID())

{

	$GLOBALS['subadmin_id'] = SJB_SubAdmin::getSubAdminSID();

}





