<?php
/***************************************************
 * Integration of JobSource Jobg8 script
 * 
 * This script dispatch event to parse incoming
 * XML document from JobG8
 ***************************************************/
set_time_limit(600);
error_reporting(E_ALL);
ini_set('display_errors', 'on');
ini_set('memory_limit', '128M');
error_log('jobg8_incoming_error_log.log');


require_once ("users/User/UserManager.php");
require_once ("membership_plan/Contract.php");
require_once ("classifieds/ListingType/ListingTypeManager.php");
require_once ("classifieds/Listing/Listing.php");
require_once ("classifieds/Listing/ListingManager.php");
require_once ("forms/Form.php");
require_once ("miscellaneous/AdminNotifications.php");
require_once ("users/Authorization.php");


$tp = SJB_System::getTemplateProcessor();

SJB_Event::dispatch('incomingFromJobG8');

exit;

