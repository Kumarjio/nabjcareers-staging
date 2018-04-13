<?php

//phpinfo();
// for PHP 5.3 and above compability
date_default_timezone_set('America/Chicago'); 
if (defined('E_DEPRECATED')) {
	error_reporting(E_ALL ^ E_DEPRECATED);
} else {
	error_reporting(E_ALL);
}

ini_set('display_errors', 'on');
$PATH_BASE = dirname(__FILE__);
$DEBUG     = array();
$ds	= DIRECTORY_SEPARATOR;
$path = $PATH_BASE."{$ds}system{$ds}cache{$ds}agents_bots.txt";
if (file_exists($path)) {
	$agents = str_replace("\r", '', file_get_contents($path));
	$agents = explode("\n", $agents);
	$http_user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'NoUserAgent'; // for example: JobG8 not send UserAgent	
	foreach ($agents as $agent){		
		if ($agent && strstr($http_user_agent, $agent)){
			header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');// no such page in configuration
			include($PATH_BASE.'/temp/403.php');
			exit;
		}
	}
}
class TimeCalculator {

	private $start_time;
	private $caption;
	
	public function TimeCalculator($caption) {
		$this->start_time = microtime();
		$this->caption = $caption;	
	}
	
	public function getElapsedTime() {
		$end_time = microtime();
		$elapsed_time = round($this->getFloatTime($end_time) - $this->getFloatTime($this->start_time), 3);
		echo "<b>{$this->caption}</b> was executed in <b>$elapsed_time</b> seconds <br>\r\n";
	}
	
	private function getFloatTime($time_str) {
	    list($usec, $sec) = explode(" ", $time_str); 
	    return ((float)$usec + (float)$sec);		
	}
	
}

define ('PATH_TO_SYSTEM_CLASS','system/core/System.php');
define ('SJB_BASE_DIR', dirname(__FILE__ )."/");

//         start of the script actions
require_once(PATH_TO_SYSTEM_CLASS);


SJB_System::loadSystemSettings ('system/user-config/DefaultSettings.php');
SJB_System::loadSystemSettings ('config.php');

if (is_null(SJB_System::getSystemSettings('SITE_URL'))) {
	header("Location: install.php");
	exit;
}
else {
	if (is_readable ("install.php") && SJB_System::getSystemSettings('IGNORE_INSTALLER') != 'true') {
		echo '<p>Your installation is temporarily disabled because the install.php file in the root of your'
		.' installation is still readable.<br> To proceed, please remove the file or change its mode to make'
		.' it non-readable for the Apache server process and refresh this page.</p>';
		exit;
	}
}

require_once('admin/lang/'. SJB_System::getSystemSettings ('LOCALE') .'.php');

SJB_System::boot();
SJB_System::init();
SJB_Event::dispatch('AfterSystemBoot');

if (file_exists("update.php")) {
	include 'update.php';
}


SJB_Request::getInstance()->execute();


if(isset($_GET['debug'])) {
	$DEBUG[] = array('os'=>PHP_OS);
	echo '<pre>';
	print_r($DEBUG);
	echo '</pre>';
	echo 'REQUEST<br><pre>';
	print_r($_REQUEST);
	echo '</pre>';
}

