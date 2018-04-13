<?php

require_once 'twitter_integration_plugin.php';

SJB_Event::handle('postToTwitter', array('TwitterIntegrationPlugin', 'postToTwitter'));
