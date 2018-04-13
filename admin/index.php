<?php

// for PHP 5.3 and above compability
if (defined('E_DEPRECATED')) {
	error_reporting(E_ALL ^ E_DEPRECATED);
} else {
	error_reporting(E_ALL);
}
define ('PATH_TO_SYSTEM_CLASS','../system/core/System.php');
define( 'ADMIN_MODE', true);
ini_set('max_execution_time', 0);
$DEBUG = array();
$PATH_BASE = str_replace('/admin', '', dirname(__FILE__));

require_once(PATH_TO_SYSTEM_CLASS);
define ('SJB_BASE_DIR', realpath(dirname(__FILE__ )."/..") . '/');
SJB_System::loadSystemSettings ('../system/admin-config/DefaultSettings.php');
SJB_System::loadSystemSettings ('../config.php');

$GLOBALS['system_settings']['USER_SITE_URL'] = $GLOBALS['system_settings']['SITE_URL'];
$GLOBALS['system_settings']['SITE_URL'] = $GLOBALS['system_settings']['ADMIN_SITE_URL'];

require_once('lang/'. SJB_System::getSystemSettings ('LOCALE') .'.php');//��������
SJB_System::boot();
SJB_System::init();

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
