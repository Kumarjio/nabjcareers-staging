<?php

class SJB_Autoloader
{
	/**
	 * Instance of SJB_Autoloader
	 *
	 * @var SJB_Autoloader
	 */
	protected static $_instance;
	
	/**
	 * Path to SJB
	 *
	 * @var string
	 */
	protected $_appPath;
	
	/**
	 * Array of search paths to load
	 *
	 * @var array
	 */
	protected $_paths;
	
	
	/**
	 * Get instance of SJB_Autoloader
	 *
	 * @return SJB_Autoloader
	 */
	public static function getInstance()
	{
		if (null === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	
	/**
	 * Create new instance of SJB_Autoloader
	 *
	 */
	protected function __construct()
	{
		if (defined('SJB_BASE_DIR')) {
			$appPath = SJB_BASE_DIR;
		} else {
			// get path to SJB /system/core directory
			$corePath = dirname(__FILE__);
			// get application path from it
			$appPath  = str_replace('system'.DIRECTORY_SEPARATOR.'core', '', $corePath);
		}
		
		if (substr($appPath, -1) != '/') {
			$appPath .= '/';
		}
		$this->_appPath = $appPath;
		
		$separator = DIRECTORY_SEPARATOR;
		
		$this->_paths = array(
			$appPath . 'system'. $separator . 'core',
			$appPath . 'system'. $separator . 'classes' . $separator . 'lib',
		);
	}
	
	
	/**
	 * Initiate autoloader
	 *
	 * @return SJB_Autoloader
	 */
	public function init()
	{
		spl_autoload_register(array( self::$_instance, 'autoload' ));
		return $this;
	}
	
	
	/**
	 * Class autoloader.
	 * Return file load status
	 *
	 * @param string $class
	 * @return boolean
	 */
	public function autoload($class)
	{
		$filename = str_replace('SJB_', '', $class);
		$filename = str_replace('_', DIRECTORY_SEPARATOR, $filename);
		$filename .= '.php';
		
		foreach ($this->_paths as $path) {
			$filepath = $path . DIRECTORY_SEPARATOR . $filename;
			
			if (file_exists($filepath)) {
				require_once $filepath;
				return true;
			}
		}
		return false;
	}
	
	
	/**
	 * Set Application Path
	 *
	 * @param string $appPath
	 * @return SJB_Autoloader
	 */
	public function setAppPath($appPath)
	{
		$this->_appPath = $appPath;
		return $this;
	}
	
	
	/**
	 * Add autoload path to list
	 *
	 * @param string $path
	 * @return SJB_Autoloader
	 */
	public function addPath($path)
	{
		$this->_paths[] = $path;
		return $this;
	}
	
	/**
	 * Remove autoload path from list
	 *
	 * @param string $path
	 */
	public function removePath($path)
	{
		if ( $key = array_search($path, $this->_paths) )
		{
			unset($this->_paths[$key]);
			return true;
		}		
		return false;
	}
	
}