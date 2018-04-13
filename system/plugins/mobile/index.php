<?php

require_once 'mobile_plugin.php';

SJB_Event::handle('GetCurrentTheme', array('MobilePlugin', 'getCurrentTheme'));
SJB_Event::handle('CanApplyWithoutResume', array('MobilePlugin', 'canApplyWithoutResume'));
