<?php

/**
 * @version		$Id: $
 */

class SJB_Request
{
	const METHOD_POST	= 'POST';
	const METHOD_GET	= 'GET';
	const METHOD_PUT	= 'PUT';
	
	
	public static function getMethod()
	{
		return strtoupper( $_SERVER['REQUEST_METHOD'] );
	}
	
	public static function get($hash = 'default')
	{
		$input = array();
		switch ($hash) {
			case 'GET':		$input = &$_GET;			break;
			case 'POST':	$input = &$_POST;			break;
			case 'FILES':	$input = &$_FILES;			break;
			case 'COOKIE':	$input = &$_COOKIE;			break;
			case 'ENV':		$input = &$_ENV;			break;
			case 'SERVER':	$input = &$_SERVER;			break;
			default:		$input = &$_REQUEST;		break;
		}
		return $input;
	}

	public static function getVar($name, $default = null, $hash = 'default', $type = 'none')
	{
		$input = SJB_Request::get($hash);
		if (isset($input[$name])) {
			$var = $input[$name];
			if ($type !== 'none')
				settype($var, $type);
			return $var;
		}
		return $default;
	}

	public static function getInt($name, $default = 0, $hash = 'default')
	{
		return SJB_Request::getVar($name, $default, $hash, 'int');
	}

	public static function getFloat($name, $default = 0.0, $hash = 'default')
	{
		return SJB_Request::getVar($name, $default, $hash, 'float');
	}

	public static function getBool($name, $default = false, $hash = 'default')
	{
		return SJB_Request::getVar($name, $default, $hash, 'bool');
	}

	public static function getString($name, $default = '', $hash = 'default')
	{
		return (string) SJB_Request::getVar($name, $default, $hash, 'string');
	}
	
	
	/**
	 * Check request type.
	 * 
	 * For AJAX request return true
	 *
	 * @return boolean
	 */
	public static function isAjax()
	{
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
			return true;
		}
		return false;
	}
	
	
	
	
	/***************** NON STATIC METHODS ****************/
	
	
	/**
	 * Instance of SJB_Request
	 *
	 * @var SJB_Request
	 */
	private static $instance = null;
	
	
	/**
	 * Get instance of SJB_Request
	 *
	 * @param string $uri
	 * @return SJB_Request
	 */
	public function getInstance($uri = null)
	{
		if (self::$instance === null) {
			self::$instance = new SJB_Request($uri);
		}
		return self::$instance;
	}
	
	
	/**
	 * Request factory
	 *
	 * @param string $uri
	 */
	public static function factory($uri = null)
	{
		return new SJB_Request($uri);
	}
	
	
	public static $method = 'GET';
	
	public static $remoteAddr = '0.0.0.0';
	
	public static $userAgent = null;
	
	
	/**
	 * SJB_PageConfig object
	 *
	 * @var SJB_PageConfig
	 */
	public $page_config;

	
	/**
	 * Headers to send
	 *
	 * @var array
	 */
	private $headers = array();
	
	/**
	 * URI of current request
	 *
	 * @var string
	 */
	public $uri;
	
	
	
	private function __construct($uri = null)
	{
		// fill request properties
		if (isset($_SERVER['REQUEST_METHOD'])) {
			self::$method = $_SERVER['REQUEST_METHOD'];
		}
		
		if (isset($_SERVER['REMOTE_ADDR'])) {
			self::$remoteAddr = $_SERVER['REMOTE_ADDR'];
		}
		
		if (isset($_SERVER['HTTP_USER_AGENT'])) {
			self::$userAgent = $_SERVER['HTTP_USER_AGENT'];
		}
		
		
		// default header
		$this->headers['Content-type'] = 'text/html;charset=utf-8';
		
		$this->uri = $uri;
		if ($uri === null || empty($uri)) {
			$this->uri = SJB_Navigator::getUri();
		}
		
		if (SJB_UserManager::checkBan($errors) && !defined('ADMIN_MODE')) {
			$this->uri = "/user-banned/";
		}

		/**
		 * maintenance mode
		 */
		if (!defined('ADMIN_MODE'))
		{
			$oMaintenance = new SJB_MaintenanceMode(self::$remoteAddr);
			if (!$oMaintenance->getAllowed())
			{
				$this->uri = '/maintenance-mode/';
			}
		}
		/**
		 * end of maintenance mode
		 */
		
		$this->page_config = SJB_PageConfig::getPageConfig ($this->uri);
	}
	
	
	/**
	 * Set header to responce
	 *
	 * @param string $name
	 * @param string $value
	 */
	public function setHeader($name, $value)
	{
		$this->headers[$name] = $value;
	}
	
	
	/**
	 * Execute request
	 *
	 */
	public function execute()
	{
		// send headers
		foreach ($this->headers as $name => $value) {
			$header = $name . ':' . $value;
			header($header, true);
		}

		if($this->page_config->PageExists()) {
			echo SJB_System::getPage($this->page_config);
		}
		else {
			if ($this->page_config->isADirecotryRequestedWithoutASlashAtTheEnd()) {
				
				header($_SERVER['SERVER_PROTOCOL'] . ' 301 Moved Permanently'); // no such page in configuration
				header("Location: {$_SERVER['REQUEST_URI']}/");
				echo "The requested resource is located under a different URL: {$_SERVER['REQUEST_URI']}/";
			}
			else {
				if (SJB_System::doesParentUserPageExist($this->uri)) {
					
					$parent_uri        = SJB_System::getUserPageParentURI($this->uri);
					$this->page_config = SJB_PageConfig::getPageConfig ($parent_uri);
					
					$passed_parameters_via_uri             = substr($this->uri, strlen($parent_uri));
					$_REQUEST['passed_parameters_via_uri'] = $passed_parameters_via_uri;
					
					echo SJB_System::getPage($this->page_config);
				}
				else { // the 404 error case!
					header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');// no such page in configuration
					include('temp/404.php');
					exit;
				}
			}
		}
	}
	
}
