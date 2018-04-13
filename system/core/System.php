<?php

class SJB_System
{
	static $pluginsErrors = array();
	
	public static function boot()
	{
		// get path to SJB root directory
		$corePath = dirname(__FILE__);
		$appPath  = str_replace(DIRECTORY_SEPARATOR.'system'.DIRECTORY_SEPARATOR.'core', '', $corePath);
		
		// force include Base.php file (compatibility and specific functions)
		require_once $appPath . '/system/core/Base.php';
		
		// init autoloader
		require_once $appPath . '/system/core/Autoloader.php';
		SJB_Autoloader::getInstance()->init();

		set_include_path(
		    SJB_System::getSystemSettings('EXT_LIBRARY_DIR') . PATH_SEPARATOR .
		    SJB_System::getSystemSettings('LIBRARY_DIR') . PATH_SEPARATOR . get_include_path());
//		SJB_PluginManager::loadPlugins( SJB_System::getSystemSettings('PLUGINS_DIR') );
	}

	public static function loadSystemSettings ($file_name)
	{
		if (is_readable ($file_name)) {
			if (!isset ($GLOBALS['system_settings']))
				$GLOBALS['system_settings'] = array ();
			$settings = require_once ($file_name);
			if (gettype($settings) == 'array') {
				$GLOBALS['system_settings'] = array_merge ($GLOBALS['system_settings'], $settings);
			}
		}
		elseif (!is_file($file_name)){
			return false;
		}
		else
			die ("index.php"." File $file_name isn't readable Cannot read config file");
	}

	public static function getSystemSettings($setting_name)
	{		
		return (isset ($GLOBALS['system_settings'][$setting_name])) ? $GLOBALS['system_settings'][$setting_name] : null;
	}
	
	public static function setSystemSettings($setting_name, $value)
	{		
		$GLOBALS['system_settings'][$setting_name] = $value;
	}

	public static function getGlobalTemplateVariables()
	{
		return $GLOBALS['TEMPLATE_VARIABLES'];
	}

	public static function getGlobalTemplateVariable ($variable_name)
	{
		return ( isset ($GLOBALS['TEMPLATE_VARIABLES'][$variable_name]) ) ? $GLOBALS['TEMPLATE_VARIABLES'][$variable_name] : null;
	}

	public static function setGlobalTemplateVariable($name, $value, $in_global_array = true)
	{
		if ($in_global_array)
			$GLOBALS['TEMPLATE_VARIABLES']['GLOBALS'][$name] = $value;
		else
			$GLOBALS['TEMPLATE_VARIABLES'][$name] = $value;
	}

	/**
	 * @return SJB_ModuleManager
	 */
	public static function getModuleManager()
	{
		return $GLOBALS['System']['MODULE_MANAGER'];
	}

	/**
	 * Get Template Processor
	 *
	 * @return SJB_TemplateProcessor
	 */
	public static function getTemplateProcessor()
	{
		$module_manager = SJB_System::getModuleManager();
		list($module) = $module_manager->getCurrentModuleAndFunction();
		if ($module != null) {
			return new SJB_TemplateProcessor(new SJB_TemplateSupplier($module));
		}
		return null;
	}

	public static function setPageTitle($page_title)
	{
		SJB_System::setGlobalTemplateVariable('TITLE', $page_title, false);
	}
	
	public static function setCurrentUserInfo($current_user_info)
	{
		SJB_System::setGlobalTemplateVariable('current_user', $current_user_info);
	}
	
	function getPageTitle()
	{
		return SJB_System::getGlobalTemplateVariable('TITLE');
	}
	
	public static function setPageKeywords($page_keywords)
	{
		SJB_System::setGlobalTemplateVariable('KEYWORDS', $page_keywords, false);
	}
	
	public static function getPageKeywords()
	{
		return SJB_System::getGlobalTemplateVariable('KEYWORDS');
	}

	public static function setPageDescription($page_description)
	{
		SJB_System::setGlobalTemplateVariable('DESCRIPTION', $page_description, false);
	}
	
	public static function getPageDescription()
	{
		return SJB_System::getGlobalTemplateVariable('DESCRIPTION');
	}

	public static function executeFunction($module, $setting, $parameters = array(), $pageID = false)
	{
		return SJB_System::getModuleManager()->executeFunction($module, $setting, $parameters, $pageID);
	}

	public static function init()
	{
		// reserve 200K of memory for emergency needs (fatal error with exhausted memory)
		// this will be free in fatalErrorHandler
		$GLOBALS['fatal_error_reserve_buffer'] = str_repeat('x', 1024 * 200);
		
		ob_start(array('SJB_Error', 'fatalErrorHandler'));
//		ob_start();
		
		SJB_DB :: init(SJB_System::getSystemSettings('DBHOST'), SJB_System::getSystemSettings('DBUSER'), SJB_System::getSystemSettings('DBPASSWORD'), SJB_System::getSystemSettings('DBNAME'));
		SJB_Session::init(SJB_System::getSystemSettings('SITE_URL')); //		session_start();
		
		// Set Error Handler and Shutdown function
		// set_error_handler(array('SJB_Error', 'errorHandler'));
		// register_shutdown_function(array('SJB_System', 'shutdownFunction'));
		
		SJB_System::prepareGlobalArrays();
		SJB_System::setGlobalTemplateVariable('is_ajax', SJB_Request::isAjax());
		SJB_System::setGlobalTemplateVariable('site_url', SJB_System::getSystemSettings('SITE_URL'));
		SJB_System::setGlobalTemplateVariable('user_site_url', SJB_System::getSystemSettings('USER_SITE_URL'));
		SJB_System::setGlobalTemplateVariable('radius_search_unit', SJB_System::getSettingByName('radius_search_unit'));
		SJB_System::setGlobalTemplateVariable('settings', SJB_Settings::getSettings());
		
		SJB_PluginManager::loadPlugins( SJB_System::getSystemSettings('PLUGINS_DIR') );
		SJB_System::setGlobalTemplateVariable('plugins', SJB_PluginManager::getAllPluginsList());
		
		$GLOBALS['System']['MODULE_MANAGER'] = new SJB_ModuleManager();
		SJB_Event::dispatch('moduleManagerCreated');
		$GLOBALS['System']['MODULE_MANAGER']->executeModulesStartupFunctions();
		// difine if subadmin loged in and set subamdinmode for templates
		require_once('main/subadmin.php');
		if ( defined('ADMIN_MODE') && SJB_SubAdmin::getSubAdminSID())
		{
			SJB_System::setGlobalTemplateVariable('subAdminSID', SJB_SubAdmin::getSubAdminSID());
		}
		$GLOBALS['uri'] = SJB_Navigator::getURI();
	}
	
	public static function getPage($page_config)
	{
		return SJB_PageConstructor::getPage($page_config);
	}
	
	function user_Access_this_page($pageID)
	{
		$access = true;
		$pageAccess = array();
		$current_user = SJB_UserManager::getCurrentUser();
		
		if (!is_null($current_user)) {
		    $access = false;
		    $queryParam = '';
			$listing_id = SJB_Request::getVar("listing_id", false);
			$passedParametersViaUri = SJB_Request::getVar("passed_parameters_via_uri", false);
			if (!$listing_id && $passedParametersViaUri) {
				require_once("classifieds/Browse/UrlParamProvider.php");
				$passed_parameters_via_uri = SJB_UrlParamProvider::getParams();
				$listing_id = isset($passed_parameters_via_uri[0])?$passed_parameters_via_uri[0]:'';
			}
			if ($listing_id) {
				$queryParam = " AND `param` = '{$listing_id}' ";
			}
			$pageHasBeenVisited = SJB_DB::query("SELECT `param` FROM `page_view` WHERE `id_user` = ?s AND `id_pages` = ?s {$queryParam}", $current_user->getSID(), $pageID);
			if (!empty($queryParam) && $pageHasBeenVisited)
				$access = true;
			else {
			    if (in_array($pageID, array('/search-resumes/', '/search-results-resumes/', '/display-resume', '/find-jobs/', '/search-results-jobs/', '/display-job'))) {
    				$contracts_id = $current_user->getContractID();
    				$pageAccess = SJB_ContractManager::getPageAccessByUserContracts($contracts_id, $pageID);
    				$numbeOfPagesViewed = SJB_ContractManager::getNumbeOfPagesViewed($current_user->getSID(), $contracts_id, $pageID);
    				if (isset($pageAccess[$pageID]) && $pageAccess[$pageID]['count_views'] != '') {
    					if ($numbeOfPagesViewed < $pageAccess[$pageID]['count_views'])
    						$access = true;
    	
    					if ($access === true) {
    						SJB_DB::query("INSERT INTO page_view (`id_user` ,`id_pages`, `param`, `contract_id`) VALUES ( ?s, ?s, ?s, ?s)", $current_user->getSID(), $pageID, $listing_id, $pageAccess[$pageID]['contract_id'][0]);						
    					}
    				}
    				else {
    					$access = true;
    				}
			    }
			    else {
			        $access = true;
			    }
			}
		}
		return $access;
	}


	function getSystemURLByModuleAndFunction ($module, $function, $parameters)
	{
		$parameters_str = '';
		$params = array();

		foreach ($parameters as $parameter_name => $parameter_value)
			array_push( $params, urlencode($parameter_name) .'='. urlencode($parameter_value) );

		$parameters_str = join('&', $params);
		$site_url = SJB_System::getSystemSettings("SITE_URL");
		$system_url_base = SJB_System::getSystemSettings("SYSTEM_URL_BASE");
		$url = $site_url . '/' . $system_url_base . '/' . $module . '/' . $function . '?' . $parameters_str;
		return $url;
	}

	function getModuleAndFunctionBySystemURL($url)
	{
		list($uri) = split('\?', $url);
		list(,,$module,$function) = split('/',$uri);
		return array('module' => $module, 'function' => $function);
	}

	function getFunctionInfo($module, $function)
	{
		$module_manager = &SJB_System::getModuleManager();
		if ($module_manager->doesModuleExists($module)) {
			$module_info = $module_manager->getModuleInfo ($module);
			return ( isset($module_info['functions'][$function]) ) ? $module_info['functions'][$function] : array();
		}
		return array();
	}

	function getSystemDefaultTemplate()
	{
		return SJB_System::getSystemSettings('SYSTEM_DEFAULT_TEMPLATE');
	}

	function isFunctionAccessible($module, $function)
	{
		$module_manager = &SJB_System::getModuleManager ();
		return $module_manager->isFunctionAccessible ($module, $function);
	}

	public static function prepareGlobalArrays()
	{
		// simulating turning off register_globals if it's on
		if (@ini_get ("register_globals")) {
			$unset = array_keys ($_ENV + $_GET + $_POST + $_COOKIE + $_SERVER + $_SESSION);
			foreach ($unset as $rg_var){
				if (isset ($$rg_var))
					unset ($$rg_var);
			}
			unset ($unset);
		}

		switch($_SERVER['REQUEST_METHOD']) {
		    case 'POST':
		        $_REQUEST = $_POST;
		        break;
		    case 'GET';
		        $_REQUEST = $_GET;
		        break;
		}
		
		// turning of 'magic_quotes_runtime' (for outputting information)
		set_magic_quotes_runtime(0);
		// unquoting request data if 'get_magic_quotes_gpc' is turned on
		if (get_magic_quotes_gpc())
			SJB_HelperFunctions::unquote ($_REQUEST);
	}

	public static function requireAllFilesInDirectory($dir)
	{
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
					if (is_dir($dir .DIRECTORY_SEPARATOR . $file)) {
						if (($file != '.') && ($file != '..'))
							SJB_System::requireAllFilesInDirectory($dir . DIRECTORY_SEPARATOR. $file );
					}
					else {
						if (strlen($file) > 4)
							if (strtolower(substr($file, strlen($file) - 4)) == '.php')
								require_once($dir . DIRECTORY_SEPARATOR . $file);
					}
				}
				closedir($dh);
			}
		}
	}

	public static function doesFunctionHaveRawOutput($module, $function)
	{
		$mm = SJB_System::getModuleManager();
		return $mm->doesFunctionHaveRawOutput($module, $function);
	}

	function getPageConfig($uri)
	{
		return SJB_PageConfig::getPageConfig ($uri);
	}

	function getUserPages()
	{
		return SJB_PageManager::get_pages();
	}

	function getUserPage ($uri)
	{
		return SJB_PageManager::get_page ($uri, 'user');
	}
	
	function modifyUserPage($pageInfo)
	{
		$module_manager = &SJB_System::getModuleManager ();
		if (!$module_manager -> doesFunctionExist ($pageInfo['module'], $pageInfo['function']))
			return false;
		return SJB_PageManager::update_page($pageInfo);
	}

	function deleteUserPage($uri)
	{
		return SJB_PageManager::delete_page ($uri);
	}

	function addUserPage($pageInfo)
	{
		$module_manager = &SJB_System::getModuleManager ();
		if (!$module_manager -> doesFunctionExist ($pageInfo['module'], $pageInfo['function']))
			return false;
		return SJB_PageManager::addPage($pageInfo);
	}

	function doesUserPageExists($uri)
	{
		return SJB_PageManager::doesPageExists ($uri, 'user');
	}

	function getModulesList()
	{
		$module_manager = &SJB_System::getModuleManager();
		return $module_manager->getModulesList();
	}

	function getFunctionsList ($module) {
		$module_manager = &SJB_System::getModuleManager();
		return $module_manager->getFunctionsList ($module);
	}

	function getParamsList ($module, $function)
	{
		$module_manager = &SJB_System::getModuleManager();
		return $module_manager->getParamsList ($module, $function);
	}

	function getFunctionsUserList ($module)
	{
		$module_manager = &SJB_System::getModuleManager ();
		$func_list = $module_manager->getFunctionsList ($module);
		$user_func_list = array();
	    foreach($func_list as $func) {
		  	if ( ($module_manager->getFunctionType($module, $func) == 'user') && ($module_manager->getFunctionAccessSystem($module, $func) == false) )
		    	$user_func_list[] = $func;
		}
		return $user_func_list;
	}

	function getModulesUserList()
	{
		$module_manager = &SJB_System::getModuleManager();
		$module_list = $module_manager->getModulesList();
		$user_module_list = array();
	    foreach($module_list as $module) {
			if (isset($func_list))
		 	 	unset($func_list);
			$is_user = 0;
			$func_list = $module_manager->getFunctionsList($module);

			foreach($func_list as $func) {
				if ( ($module_manager->getFunctionType($module, $func) == 'user') && ($module_manager->getFunctionAccessSystem($module, $func) == false) ) {
		       		$is_user=1;
					break; 
				}
			}

			if ( $is_user == 1 )
				$user_module_list[] = $module;
		}
		return $user_module_list;
	}

	public static function getURI()
	{
		return SJB_Navigator::getURI();
	}
	
	function getRegisteredCommands()
	{
		$module_manager = &SJB_System::getModuleManager ();
		return $module_manager->getRegisteredCommands();		
	}
	
	function getCommandScriptAbsolutePath($module, $command)
	{
		$module_manager = &SJB_System::getModuleManager ();
		return $module_manager->getCommandScriptAbsolutePath($module, $command);		
	}
	
	function getModuleOfCommand($command)
	{		
		$module_manager = &SJB_System::getModuleManager ();
		return $module_manager->getModuleOfCommand($command);		
	}
	
    public static function getSettingsFromFile($file_name, $setting_name)
    {
		$settings = require($file_name);
		return isset($settings[$setting_name]) ? $settings[$setting_name] : null;
	}
  	
  	public static function getSettingByName($setting_name)
  	{
  		return SJB_Settings::getSettingByName($setting_name);
  	}
  	
  	public static function doesParentUserPageExist($uri)
  	{
  		return SJB_PageManager::doesParentPageExist($uri, SJB_System::getSystemSettings('SYSTEM_ACCESS_TYPE'));
  	}
  	
  	function getUserPageParentURI($uri)
  	{
  		return SJB_PageManager::getPageParentURI($uri, SJB_System::getSystemSettings('SYSTEM_ACCESS_TYPE'));
  	}
  	

  	/**
  	 * Shutdown function
  	 */
  	function shutdownFunction()
  	{
  		// get errors handle settings
  		$errorLogging = SJB_System::getSettingByName('error_logging');
  		$errorLevel   = SJB_System::getSettingByName('error_log_level');
  		
  		if ($errorLogging) {
  			$errors = SJB_Error::getRuntimeErrors($errorLevel);
  			if ( !empty($errors)) {
	  			SJB_Error::writeToLog($errors);
  			}
  		}
  	}
}
