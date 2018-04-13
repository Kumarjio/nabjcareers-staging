<?php

require_once 'indeed_plugin.php';

SJB_Event::handle('beforeGenerateListingStructure', array('IndeedPlugin', 'getListingsFromIndeed'));
SJB_Event::handle('afterGenerateListingStructure', array('IndeedPlugin', 'addIndeedListingsToListingStructure'));