<?php
/***************************************************
 * Integration of JobSource Jobg8 script
 * 
 * This script dispatch event to generate outgoing
 * XML document for JobG8
 ***************************************************/
set_time_limit(3600);
error_reporting(E_ALL);
ini_set('display_errors', 'on');
ini_set('memory_limit', '128M');
error_log('jobg8_outgoing_error_log.log');


$tp = SJB_System::getTemplateProcessor();

SJB_Event::dispatch('sendJobsToJobG8');

exit;