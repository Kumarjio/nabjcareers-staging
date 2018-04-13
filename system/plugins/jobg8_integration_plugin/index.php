<?php

require_once 'jobg8_integration_plugin.php';
require_once 'Jobg8.php';

// init handle
SJB_Event::handle('moduleManagerCreated', array('JobG8IntegrationPlugin', 'init'));

// Output events handle
SJB_Event::handle('listingActivated', array('JobG8IntegrationPlugin', 'addListingToJobg8'));
SJB_Event::handle('listingEdited', array('JobG8IntegrationPlugin', 'amendListingToJobg8'));
SJB_Event::handle('beforeListingDelete', array('JobG8IntegrationPlugin', 'deleteListingFromJobg8'));
SJB_Event::handle('sendJobsToJobG8', array('JobG8IntegrationPlugin', 'sendJobsToJobG8'));

// Incoming events handle
SJB_Event::handle('incomingFromJobG8', array('JobG8IntegrationPlugin', 'getJobsFromJobG8'));

// Task scheduler event handle
SJB_Event::handle('task_scheduler_run', array('JobG8IntegrationPlugin', 'deleteExpiredJobG8Listings'));