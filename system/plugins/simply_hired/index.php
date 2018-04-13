<?php

require_once 'simply_hired_plugin.php';

SJB_Event::handle('beforeGenerateListingStructure', array('SimplyHiredPlugin', 'getListingsFromSimplyHired'));
SJB_Event::handle('afterGenerateListingStructure', array('SimplyHiredPlugin', 'addSimplyHiredListingsToListingStructure'));