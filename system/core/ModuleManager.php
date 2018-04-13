<?php


/**
 * @package SystemClasses
 * @subpackage ModuleManager
 */
/**
 * ModuleManager - class used to handle modules, including running their functions.
 * @package SystemClasses
 */
class SJB_ModuleManager
{
	var $modules;
	var $call_stack;
	var $prev_requests;
	
	var $cacheManager;
	
	/**
	 * ModuleManager constructor
	 */
	function SJB_ModuleManager()
	{
		$this -> modules = array ();
		$this -> call_stack = array();
		$this -> prev_requests = array ();
		$this->readModuleConfigs();
		
		$this->cacheManager = new SJB_CacheManager();
	}

	function doesModuleExists($module_name)
	{
		return isset($this -> modules[$module_name]);
	}

	function doesFunctionExist ($module, $function)
	{
		return isset($this -> modules[$module]['functions'][$function]);
	}

	/**
	 * Executes old-style script writen by Bakyt
	 *
	 * This function will prevent executeFunction from terminating,
	 * if there are "exit" statements used in old-style scripts.
	 * This function will not affect new-style scripts
	 *
	 * @param string $filename name of the required file
	 * @param object $template_processor instance of template processor - smarty
	 * @param string $page_title return by reference - page title
	 */
	function old_scripts_compatible_require_function($filename, &$template_processor, &$page_title)
	{
		require($filename);
	}

	/**
	 * Returns module information specified in monule configuration
	 *
	 * @param string $module_name Module name.
	 */
	function getModuleInfo($module_name = '')
	{
		if (empty($module_name))
			return $this -> modules;
		return isset($this -> modules[$module_name]) ? $this -> modules[$module_name] : false;
	}

	/**
	 * Returns function's access type
	 *
	 * @param string $module_name Module name
	 * @param string $function_name Function name
	 * @return string Access class
	 */
	function getFunctionAccessType($module_name, $function_name)
	{
		if (isset ($this -> modules[$module_name]['functions'][$function_name]))
			return $this -> modules[$module_name]['functions'][$function_name]['access_type'];
	}

	/**
	 * Returns function's type
	 *
	 * @param string $module_name Module name
	 * @param string $function_name Function name
	 * @return string Function type
	 */
	function getFunctionType($module_name, $function_name)
	{
		if (isset ($this -> modules[$module_name]['functions'][$function_name]))
			return $this -> modules[$module_name]['functions'][$function_name]['type'];
	}
	/**
	 * Returns module's classes directory
	 *
	 * @param string $module_name Module name
	 * @return string Path to classes directory
	 */
	function getModuleClassesDir($module_name)
	{
		return $this -> modules[$module_name]['classes'];
	}
	
	
	/**
	 * Returns function's cache info 
	 *
	 * @param string $module_name
	 * @param string $function_name
	 * @return array
	 */
	function getFunctionCacheInfo($module_name, $function_name)
	{
		$defaultLifetime = $this->cacheManager->getDefaultCacheLifetime();
		
		$cache_info = isset($this->modules[$module_name]['functions'][$function_name]['cache'])
						? $this->modules[$module_name]['functions'][$function_name]['cache']
						: array();
		
		$cache_info['caching']	= isset($cache_info['caching']) ? $cache_info['caching'] : false;
		$cache_info['time']		= isset($cache_info['time']) ? $cache_info['time'] : $defaultLifetime;
		
		return $cache_info;
	}

	
	/**
	 * Execute module function
	 *
	 * This function will execute function of the module
	 * If function does not exists, it will display error message
	 *
	 * @param string $module_name name of the module
	 * @param string $function_name function's name
	 * @param array $parameters_override _REQUEST parameters to rewrite
	 */
	function executeFunction($module_name, $function_name, $parameters_override = array(), $pageID = false)
	{
		$cacheInfo = $this->getFunctionCacheInfo($module_name, $function_name);
		$cacheID = $this->cacheManager->getCacheID($module_name, $function_name, $parameters_override, $pageID);
		
		if ( !$cacheInfo['caching'] || !$this->cacheManager->isCached($cacheID, $cacheInfo['time']) ) {
			ob_start();
			if ($this->isFunctionAccessible($module_name, $function_name)) {
				$script_filename = $this->getFunctionScriptFilename($module_name, $function_name);

								//////////////////////////
			    $acl = SJB_Acl::getInstance();
        	    if (!$acl->isAllowed('open_job_search_form')
        	        && $module_name == 'classifieds'
        	        && $function_name == 'search_form'
        	        && isset($parameters_override['listing_type_id'])
        	        && $parameters_override['listing_type_id'] == 'Job'
        	        && !isset($parameters_override['form_template'])) {
        	        $script_filename = 'system/user-scripts/miscellaneous/error.php';
        	    }
        	    
        	    if (!$acl->isAllowed('open_resume_search_form')
        	        && $module_name == 'classifieds'
        	        && $function_name == 'search_form'
        	        && isset($parameters_override['listing_type_id'])
        	        && $parameters_override['listing_type_id'] == 'Resume') {
        	        $script_filename = 'system/user-scripts/miscellaneous/error.php';
        	    }
        	    
        	    if (!$acl->isAllowed('view_job_search_results')
        	        && $module_name == 'classifieds'
        	        && $function_name == 'search_results'
        	        && isset($parameters_override['results_template'])
        	        && $parameters_override['results_template'] == 'search_results_jobs.tpl') {
        	        $script_filename = 'system/user-scripts/miscellaneous/error.php';
        	    }
        	    if (!$acl->isAllowed('view_resume_search_results')
        	        && $module_name == 'classifieds'
        	        && $function_name == 'search_results'
        	        && isset($parameters_override['results_template'])
        	        && $parameters_override['results_template'] == 'search_results_resumes.tpl') {
        	        $script_filename = 'system/user-scripts/miscellaneous/error.php';
        	    }
        	    
        	    if (!$acl->isAllowed('view_job_details')
        	        && $module_name == 'classifieds'
        	        && $function_name == 'display_listing'
        	        && isset($parameters_override['display_template'])
        	        && $parameters_override['display_template'] == 'display_job.tpl') {
        	        $script_filename = 'system/user-scripts/miscellaneous/error.php';
        	    }

        	    if (!$acl->isAllowed('view_resume_details')
        	        && $module_name == 'classifieds'
        	        && $function_name == 'display_listing'
        	        && isset($parameters_override['display_template'])
        	        && $parameters_override['display_template'] == 'display_resume.tpl') {
        	        	
        	        	$allow = false;
        	        	if (SJB_UserManager::isUserLoggedIn()) {
	        	        	// if view resume not allowed by ACL, check applications table
	        	        	// for current resume ID, applied for one of current user jobs
	        	        	// if present in applications - allow current user to view resume
	        	        	require_once("classifieds/Browse/UrlParamProvider.php");
	        	        	
	        	        	// check_params
	        	        	$passed_parameters_via_uri = SJB_Request::getVar('passed_parameters_via_uri', false);
		        	        if ($passed_parameters_via_uri) {
				            	$passed_parameters_via_uri = SJB_UrlParamProvider::getParams();
				            	if (isset($passed_parameters_via_uri[0]) && is_numeric($passed_parameters_via_uri[0])) {
				            		$resumeID = $passed_parameters_via_uri[0];
				            		
				            		// check for all jobs of current user
				            		$cu     = SJB_UserManager::getCurrentUser();
				            		$cuJobs = SJB_ListingManager::getListingsByUserSID($cu->getSID());
				            		$listingSids = array();
				            		foreach ($cuJobs as $job) {
				            			$listingSids[] = $job->getSID();
				            		}
				            		if (!empty($listingSids)) {
					            		$result = SJB_DB::query("SELECT * FROM `applications` WHERE `resume` = ?n AND `listing_id` IN (?l) LIMIT 1", $resumeID, $listingSids);
					            		if (!empty($result)) {
					            			$allow = true;
					            		}
				            		}
				            	}
				            }
        	        	}
			            if ($allow == false) {
			            	$script_filename = 'system/user-scripts/miscellaneous/error.php';
			            }
        	    }
        	    
        	    if (!$acl->isAllowed('use_private_messages')
        	        && $module_name == 'private_messages'
        	        && $function_name == 'aj_send') {
        	        $script_filename = 'system/user-scripts/miscellaneous/error.php';
        	    }
        	    
        	    if (!$acl->isAllowed('create_sub_accounts')
        	        && $module_name == 'users' && $function_name == 'sub_accounts') {
        	        $script_filename = 'system/user-scripts/miscellaneous/error.php';
        	    }
        	    
			   	if (strstr($script_filename, '/plugins/')) {
        	    	 $script_filename = str_replace('user-scripts/', '', $script_filename);
        	    }

				$cu = SJB_UserManager::getCurrentUser();
				if (!empty($cu) && $cu->isSubuser()) {
        	    	$cu = $cu->getSubuserInfo();
        	    	if ($module_name == 'users' && $function_name == 'user_notifications') {
        	    		$script_filename = 'system/user-scripts/miscellaneous/error.php';
        	    	}
        	    	
					if ($module_name == 'applications' && $function_name == 'screening_questionnaires') {
						$script_filename = 'system/user-scripts/miscellaneous/error.php';
					}
        	    	
	        	    if (!$acl->isAllowed('subuser_manage_subscription', $cu['sid'])
	        	        && $module_name == 'membership_plan' && $function_name == 'subscription_page') {
	        	        $script_filename = 'system/user-scripts/miscellaneous/error.php';
	        	    }
	        	    
                    if (!$acl->isAllowed('subuser_add_listings', $cu['sid'])
	        	        && $module_name == 'classifieds' && in_array($function_name, array('clone_job', 'add_listing', 'job_import'))) {
	        	        $script_filename = 'system/user-scripts/miscellaneous/error.php';
	        	    }
	        	    
                    if (!$acl->isAllowed('subuser_add_listings', $cu['sid']) && !$acl->isAllowed('subuser_manage_listings', $cu['sid'])
	        	        && $module_name == 'classifieds' && $function_name == 'my_listings') {
	        	        $script_filename = 'system/user-scripts/miscellaneous/error.php';
	        	    }
        	    }
				else {
					require_once('main/subadmin.php');
					$subAdminSID = SJB_SubAdmin::getSubAdminSID();

					$allowedModules = array(
						'main'	=> 'admin_login',
						'menu'	=> array(
							'show_subadmin_menu',
							'show_left_menu',
							'admin_menu',
						),
						'classifieds'	=> array('get_tree'),
						'dashboard'		=> 'view',
						'users'			=> 'logout',
						'sub_admins'	=> 'edit_profile',
					);

					require_once('sub_admins/SubAdminAcl.php');
					
					if ($subAdminSID && !SJB_SubAdminAcl::ifAllowedModule($module_name, $function_name, $allowedModules)) {
						$subAdminAcl = SJB_SubAdminAcl::getInstance();
						$allowed = false;

						//  	Manage Common Listing Fields
						if ($subAdminAcl->isAllowed('manage_common_listing_fields', $subAdminSID)
								&& $module_name == 'classifieds' 
								&& in_array($function_name, array('listing_fields', 'edit_listing_field',
									'attention_listing_type_field', 'add_listing_field', 'edit_tree', 'import_tree_data', 'edit_list', 'edit_list_item')))
						{
							$allowed = true;
						}
						//  	 Manage Listing Types and Specific Listing Fields
						if ($subAdminAcl->isAllowed('manage_listing_types_and_specific_listing_fields', $subAdminSID)
								&& ( ($module_name == 'classifieds'
								&& in_array($function_name, array(
											'listing_types', 'edit_listing_type', 'edit_listing_type_field', 'add_listing_type_field',
											'add_listing_type', 'delete_listing_type', 'delete_listing_type_field', 'edit_list',
											'edit_list_item', 'attention_listing_type_field', 'edit_complex_fields', 'edit_complex_list'))

								) || ($module_name == 'miscellaneous' && $function_name == 'geographic_data')
							))
						{
							$allowed = true;
						}
						//  	set_posting_pages
						if ($subAdminAcl->isAllowed('set_posting_pages', $subAdminSID)
								&& ($module_name == 'classifieds' && ($function_name == 'listing_types' || $function_name == 'posting_pages')))
						{
							$allowed = true;
						}
						//  	  	Manage Listings
						if ($subAdminAcl->isAllowed('manage_listings', $subAdminSID)
								&& (($module_name == 'classifieds'
								&& (in_array($function_name, array('manage_listings', 'listing_actions', 'manage_pictures', 'edit_picture', 'display_listing'))
									|| ( $function_name == 'edit_listing' && !SJB_Request::isAjax())
								))	|| ($module_name == 'comments' && $function_name == 'listing_comments')
									|| ($module_name == 'rating' && $function_name == 'listing_rating')))
						{
							$allowed = true;
						}
						//	Import Listings
						if ($subAdminAcl->isAllowed('import_listings', $subAdminSID) && $module_name == 'classifieds' && $function_name == 'import_listings')
						{
							$allowed = true;
						}
						//	EXport Listings
						if ($subAdminAcl->isAllowed('export_listings', $subAdminSID) && $module_name == 'classifieds' && $function_name == 'export_listings' )
						{
							$allowed = true;
						}
						//	XML Feeds
						if ($subAdminAcl->isAllowed('set_xml_feeds', $subAdminSID)
								&& $module_name == 'classifieds'
								&& $function_name == 'listing_feeds'
							)
						{
							$allowed = true;
						}
						//	XML Import
						if ($subAdminAcl->isAllowed('set_xml_import', $subAdminSID)
								&& $module_name == 'listing_import'
								&& in_array($function_name, array('show_import', 'edit_import', 'run_import',
								'add_import', 'user_fields', 'delete_import')))
						{
							$allowed = true;
						}
						//	Flagged Listings
						if ($subAdminAcl->isAllowed('manage_flagged_listings', $subAdminSID)
								&& $module_name == 'classifieds'
								&& ($function_name == 'flagged_listings' || $function_name == 'edit_listing')
							)
						{
							$allowed = true;
						}
						//	Flagged Listings
//						if ($subAdminAcl->isAllowed('edit_flag_listing_settings', $subAdminSID)
//								&& $module_name == 'classifieds'
//								&& SJB_Request::isAjax()
//								&& (
//									$function_name == 'edit_listing'
//								)
//							)
//						{
//							$allowed = true;
//						}
						//USERS
						//	manage_user_groups
						if ($subAdminAcl->isAllowed('manage_user_groups', $subAdminSID)
								&& $module_name == 'users'
								&& in_array($function_name, array('user_groups', 'add_user_group', 'delete_user_group', 'edit_user_group')))
						{
							$allowed = true;
						}
						//	 	Manage User Groups Permissions (Job seekers and employers)
						if ($subAdminAcl->isAllowed('manage_user_groups_permissions', $subAdminSID)
								&& $module_name == 'users'
								&& (($function_name == 'acl' && 'group' == SJB_Request::getVar('type')) || $function_name == 'user_groups'))
						{
							$allowed = true;
						}
												//	Edit User Groups Profile Fields (Job seekers and Employers)
						if ($subAdminAcl->isAllowed('edit_user_groups_profile_fields', $subAdminSID)
								&& $module_name == 'users'
								&& in_array($function_name, array('add_user_profile_field', 'edit_user_profile_field',
									'delete_user_profile_field', 'edit_user_profile')))
						{
							$allowed = true;
						}
						//	Manage Users
						if ($subAdminAcl->isAllowed('manage_users', $subAdminSID)
								&& (($module_name == 'users'
								&& in_array($function_name, array('users', 'add_user', 'edit_user')))
								|| ($module_name == 'applications' && $function_name == 'view')
								|| ($module_name == 'membership_plan' && $function_name == 'user_membership_plans')
								|| ($module_name == 'membership_plan' && $function_name == 'user_membership_plan')
								|| ($module_name == 'users' && $function_name == 'acl' && 'user' == SJB_Request::getVar('type'))
								|| ($module_name == 'users' && in_array($function_name, array('send_activation_letter', 'login_as_user')))
								|| ($module_name == 'private_messages' && in_array($function_name, array('pm_main', 'pm_inbox', 'pm_outbox', 'pm_read')))
								)
							)
						{
							$allowed = true;
						}
												// 	Import Users
						if ($subAdminAcl->isAllowed('import_users', $subAdminSID)
								&& $module_name == 'classifieds'
								&& ($function_name == 'import_users' || $function_name == 'edit_user' || $function_name == 'edit_user'))
						{
							$allowed = true;
						}
						// 	Create and Send Mass Mailings
						if ($subAdminAcl->isAllowed('create_and_send_mass_mailings', $subAdminSID)
								&& $module_name == 'users'
								&& $function_name == 'mailing'
							)
						{
							$allowed = true;
						}
						// 	Manage Membership Plans
						if ($subAdminAcl->isAllowed('manage_membership_plans', $subAdminSID)
								&& (($module_name == 'membership_plan'
								&& in_array($function_name, array('membership_plans', 'membership_plan',
											'add_membership_plan', 'add_package', 'package')))
									|| $module_name == 'users' && $function_name == 'acl' && 'plan' == SJB_Request::getVar('type'))
							)
						{
							$allowed = true;
						}
						// 	Manage Banned IPs
						if ($subAdminAcl->isAllowed('manage_banned_ips', $subAdminSID)
								&& $module_name == 'users' && $function_name == 'banned_ips')
						{
							$allowed = true;
						}
						// 	edit_templates_and_themes
						if ($subAdminAcl->isAllowed('edit_templates_and_themes', $subAdminSID)
								&& $module_name == 'template_manager'
								&& in_array($function_name, array('edit_templates', 'add_template', 'module_list',
											'template_list', 'edit_template', 'theme_editor')))
						{
							$allowed = true;
						}
						// 	manage_banners
						if ($subAdminAcl->isAllowed('manage_banners', $subAdminSID)
								&& $module_name == 'banners'
								&& in_array($function_name, array('manage_banner_groups', 'edit_banner_group', 'edit_banner', 'add_banner_group', 'add_banner')))
						{
							$allowed = true;
						}
						// 	manage_site_pages
						if ($subAdminAcl->isAllowed('manage_site_pages', $subAdminSID)
								&& $module_name == 'user_pages' && $function_name == 'edit_user_pages')
						{
							$allowed = true;
						}
						// 	manage_static_content
						if ($subAdminAcl->isAllowed('manage_static_content', $subAdminSID)
								&& (($module_name == 'static_content' && $function_name == 'edit_static_content')
										|| ($module_name =='user_pages' && $function_name == 'register_page_link')))
						{
							$allowed = true;
						}
						// 	manage_static_content
						if ($subAdminAcl->isAllowed('manage_static_content', $subAdminSID)
								&& $module_name == 'static_content' && $function_name == 'edit_static_content')
						{
							$allowed = true;
						}
						// 	manage_news
						if ($subAdminAcl->isAllowed('manage_news', $subAdminSID)
								&& $module_name == 'news' && ($function_name == 'news_categories' || $function_name == 'manage_news'))
						{
							$allowed = true;
						}
						// 	payment
						if ($subAdminAcl->isAllowed('set_up_payment_gateways', $subAdminSID)
								&& $module_name == 'payment'
								&& ($function_name == 'gateways' || $function_name == 'configure_gateway'))
						{
							$allowed = true;
						}
						// 	manage_payments
						if ($subAdminAcl->isAllowed('manage_payments', $subAdminSID)
								&& $module_name == 'payment' && $function_name == 'payments'
							)
						{
							$allowed = true;
						}
						// 	manage_payments
						if ($subAdminAcl->isAllowed('manage_payments', $subAdminSID)
								&& $module_name == 'payment' && $function_name == 'payments')
						{
							$allowed = true;
						}
						// manage_languages
						if ($subAdminAcl->isAllowed('manage_languages', $subAdminSID)
								&& $module_name == 'I18N' && in_array($function_name, array('manage_languages', 'edit_language', 'add_language')))
						{
							$allowed = true;
						}
						// manage_phrases
						if ($subAdminAcl->isAllowed('translate_phrases', $subAdminSID)
								&& $module_name == 'I18N' && in_array($function_name, array('manage_phrases', 'edit_phrase', 'add_phrase')))
						{
							$allowed = true;
						}
						// import_languages
						if ($subAdminAcl->isAllowed('import_languages', $subAdminSID) && $module_name == 'I18N' && $function_name == 'import_language')
						{
							$allowed = true;
						}
						// export_language
						if ($subAdminAcl->isAllowed('export_languages', $subAdminSID)
								&& $module_name == 'I18N' && $function_name == 'export_language')
						{
							$allowed = true;
						}

						// SYSTEM CONFIGURATION
						// configure_system_settings
						if ($subAdminAcl->isAllowed('configure_system_settings', $subAdminSID)
								&& $module_name == 'miscellaneous' && $function_name == 'settings')
						{
							$allowed = true;
						}
						// edit_zipcode_database
						if ($subAdminAcl->isAllowed('edit_zipcode_database', $subAdminSID)
								&& $module_name == 'miscellaneous'
								&& ($function_name == 'geographic_data'
									|| $function_name == 'edit_location'
									|| $function_name == 'import_geographic_data'
								)
							)
						{
							$allowed = true;
						}
						// configure_breadcrumbs
						if ($subAdminAcl->isAllowed('configure_breadcrumbs', $subAdminSID)
								&& $module_name == 'breadcrumbs' && $function_name == 'manage_breadcrumbs')
						{
							$allowed = true;
						}
						// set_html_filters
						if ($subAdminAcl->isAllowed('set_html_filters', $subAdminSID)
								&& $module_name == 'miscellaneous' && $function_name == 'filters'
							)
						{
							$allowed = true;
						}
						// manage_currencies
						if ($subAdminAcl->isAllowed('manage_currencies', $subAdminSID)
								&& $module_name == 'miscellaneous' && $function_name == 'currency'
							)
						{
							$allowed = true;
						}
						// set_task_scheduler
						if ($subAdminAcl->isAllowed('set_task_scheduler', $subAdminSID)
								&& $module_name == 'miscellaneous' && $function_name == 'task_scheduler_settings'
							)
						{
							$allowed = true;
						}
						// manage_plug-ins
						if ($subAdminAcl->isAllowed('manage_plug-ins', $subAdminSID)
								&& $module_name == 'miscellaneous' && $function_name == 'plugins' && ! SJB_Request::getVar('plugin', null))
						{
							$allowed = true;
						}
													// set phpbb plugin
						if ($subAdminAcl->isAllowed('set_phpbb_plug-in', $subAdminSID)
									&& (	($module_name == 'miscellaneous' && $function_name == 'plugins' && !SJB_Request::getVar('plugin') )
										|| ( $module_name == 'miscellaneous' && $function_name == 'plugins' && 'PhpBBBridgePlugin' == SJB_Request::getVar('plugin'))
											))
							{
								$allowed = true;
							}
							// set wordpress plugin
							if ($subAdminAcl->isAllowed('set_wordpress_plug-in', $subAdminSID)
									&& (	($module_name == 'miscellaneous' && $function_name == 'plugins' && !SJB_Request::getVar('plugin') )
										|| ( $module_name == 'miscellaneous' && $function_name == 'plugins' && 'WordPressBridgePlugin' == SJB_Request::getVar('plugin'))
									)
								)
							{
								$allowed = true;
							}
							// set set_twitter_plug-in
							if ($subAdminAcl->isAllowed('set_twitter_plug-in', $subAdminSID)
									&& (	($module_name == 'miscellaneous' && $function_name == 'plugins' && !SJB_Request::getVar('plugin') )
										|| ( $module_name == 'miscellaneous' && $function_name == 'plugins' && 'TwitterIntegrationPlugin' == SJB_Request::getVar('plugin'))
									)
								)
							{
								$allowed = true;
							}
						// set_refine_search_parameters
						if ($subAdminAcl->isAllowed('set_refine_search_parameters', $subAdminSID)
								&& $module_name == 'classifieds' && $function_name == 'refine_search')
						{
							$allowed = true;
						}

						// create_and_restore_backups
						if ($subAdminAcl->isAllowed('create_and_restore_backups', $subAdminSID)
								&& $module_name == 'miscellaneous' && $function_name == 'backup')
						{
							$allowed = true;
						}

						// edit_flag_listing_settings
						if ($subAdminAcl->isAllowed('edit_flag_listing_settings', $subAdminSID)
								&& $module_name == 'miscellaneous' && $function_name == 'flag_listing_settings')
						{
							$allowed = true;
						}
						
						// *****************************************************************
						if (!$allowed) {
							$script_filename = SJB_BASE_DIR.'system/admin-scripts/miscellaneous/subadmin-error.php';
						}
					}
								}

				if (!SJB_System::user_Access_this_page($pageID) && SJB_System::getSystemSettings ('SYSTEM_ACCESS_TYPE') != 'admin') {
					$script_filename = SJB_BASE_DIR.'system/user-scripts/miscellaneous/error.php';
				}

				if ( $script_filename != null && is_readable($script_filename) ) {
					$this->prepareFunctionEnvironment($parameters_override);
					$this->pushExecutionStack($module_name, $function_name);
					include ($script_filename);
					$this->popExecutionStack();
					$this->restoreEnvironment();
				}
				else {
					return "<!-- Either wrong module/function or function script file does not exist for $module_name, $function_name -->";
				}
			}
			else {
				return "<!-- No such function or function is not accessible for $module_name, $function_name -->";
			}
	
			$content = ob_get_contents();
			ob_end_clean();
		
			if ($cacheInfo['caching'])
				$this->cacheManager->writeCacheFile($content, $cacheID);
		}
		else {
			$content = $this->cacheManager->getCacheFile($cacheID);
		}
		
		return $content;
	}

	
	function getFunctionScriptFilename($module_name, $function_name)
	{
		if ( isset ($this->modules[$module_name]['functions'][$function_name]) ) {
			$script_path = $this->modules[$module_name]['functions'][$function_name]['script'];
			return SJB_PathManager::getAbsoluteFunctionScriptPath($module_name, $script_path);
		}
		return null;
	}

	function prepareFunctionEnvironment($parameters)
	{
		array_push ($this -> prev_requests, $_REQUEST);
		if (is_array ($parameters)) {
			foreach ($parameters as $key => $value)
				$_REQUEST[$key] = $value;
		}
	}

	function getCurrentModuleAndFunction()
	{
		return $this -> getCurrentFunction();
	}

	function restoreEnvironment()
	{
		$c = count($this->prev_requests);
		if ($c > 0)
			$_REQUEST = array_pop ($this->prev_requests);
	}

	function pushExecutionStack($module_name, $function_name)
	{
		array_push($this->call_stack, array($module_name, $function_name));
	}

	function popExecutionStack()
	{
		array_pop($this->call_stack);
	}

	function getCurrentFunction()
	{
		$c = count($this->call_stack);
		if ($c > 0)
			return $this->call_stack[$c-1];
		return null;
	}

	/**
	 * Sets page title.
	 *
	 * @param string $page_title Title of the page
	 */
	function setPageTitleOnce( $page_title )
	{
		if (!isset($GLOBALS['PAGE_TITLE']) && !empty($page_title))
			$GLOBALS['PAGE_TITLE'] = $page_title;
	}

	function isFunctionAccessible ($module, $function)
	{
		if ( $this->doesModuleExists($module) ) {
			$function_access_type = $this->getFunctionAccessType ($module, $function);
			if (!is_array($function_access_type))
				$function_access_type = array($function_access_type);
			$current_access_type = SJB_System::getSystemSettings ('SYSTEM_ACCESS_TYPE');
			if ( $current_access_type == SJB_System::getSystemSettings('ADMIN_ACCESS_TYPE')
				 || in_array($current_access_type, $function_access_type))
				return true;
		}
		return false;
	}

	function doesFunctionHaveRawOutput($module, $function)
	{
		if (isset($this->modules[$module]) && isset($this->modules[$module]['functions'][$function])) {
			if (isset($this->modules[$module]['functions'][$function]['raw_output']))
				return $this->modules[$module]['functions'][$function]['raw_output'];
			return false;
		}
		return null;
	}

	function readModuleConfigs()
	{
		if ($dh = opendir(SJB_PathManager :: getAbsoluteModulesPath())) {
			while (($module_name = readdir($dh)) !== false) {
				if (in_array($module_name, array(".", "..", ".svn", "CVS")))
					continue;
				$this->includeModule($module_name);
			}
			closedir($dh);
		}
	}

	function executeStartupScript ($module_name)
	{
		$module_startup_scripts = $this->getModuleSetting($module_name, 'startup_script');
		$module_startup_script = null;
		if ( isset ($module_startup_scripts[SJB_System::getSystemSettings('SYSTEM_ACCESS_TYPE')]) ) {
			$module_startup_script = $module_startup_scripts[SJB_System::getSystemSettings('SYSTEM_ACCESS_TYPE')];
			$this -> executeFunction($module_name, $module_startup_script);
		}
	}

	function getModuleSetting($module, $setting)
	{
		if (isset ($this->modules[$module][$setting]) )
			return $this->modules[$module][$setting];
		return null;
	}

	function includeModule($module_name)
	{
		$path = SJB_PathManager::getAbsoluteModulePath($module_name);
		if (is_dir($path) && $module_name != '.' && $module_name != '..')
			if (is_readable($path . 'config.php'))
				$this->modules[$module_name] = require($path . 'config.php');
	}

	function executeModulesStartupFunctions()
	{
		foreach ($this->modules as $module => $parameters)
			$this->executeStartupScript ($module);
	}

	function getModulesList()
	{
		return array_keys ($this->modules);
	}

	function getFunctionsList($module)
	{
		return array_keys ($this->modules[$module]['functions']);
	}

	function getParamsList($module, $function)
	{
		if ( isset($this->modules[$module]['functions'][$function]['params']) )
		   return $this->modules[$module]['functions'][$function]['params'];
	}

	function getFunctionAccessSystem($module_name, $function_name)
	{
		if (isset ($this -> modules[$module_name]['functions'][$function_name]))
			if (isset ($this -> modules[$module_name]['functions'][$function_name]['system']))
				return $this -> modules[$module_name]['functions'][$function_name]['system'];
		return false;
	}
	
	function getModuleOfCommand($command)
	{	
		foreach ($this->modules as $module_name => $module){	
			if ( isset($module['commands']) ) {
				foreach ($module['commands'] as $command_name => $command_info)
					if ( strtolower($command) == strtolower($command_name) )
						return $module_name;	
			}
		}
	}
	
	function getRegisteredCommands()
	{
		$commands = array();
		foreach ($this->modules as $module)
			if ( isset($module['commands']) )
				$commands = array_merge($commands, $module['commands']);
		return $commands;
	}
	
	function getCommandScriptAbsolutePath($module, $command)
	{		
		$script_name = $this->_getCommandScriptName($module, $command);
		if ($script_name)
			return SJB_PathManager::getAbsoluteCommandsPath($module) . $script_name;
	}
	
	function _getCommandScriptName($module, $command)
	{
		if ( isset($this->modules[$module]['commands']) ) {
			foreach ($this->modules[$module]['commands'] as $command_name => $command_info) {
				if (strtolower($command_name) == strtolower($command))
					return $command_info['script'];
			}	
		}
		return null;
	}
}
