<?php

require_once 'phpbb_bridge_plugin.php';

SJB_Event::handle('Login', array('PhpBBBridgePlugin', 'login'));
SJB_Event::handle('Logout', array('PhpBBBridgePlugin', 'logout'));
