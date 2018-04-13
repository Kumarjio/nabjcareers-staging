<?php

class SJB_Cookie
{
    function &getCookie()
    {
        if (!isset($GLOBALS['Cookie_instance'])) {
            $GLOBALS['Cookie_instance'] = new SJB_Cookie();
        }
        return $GLOBALS['Cookie_instance'];
    }
    
    function createSetCookieAction($name, $value)
    {
    	$cookie_data_source = new SJB_CookieDataSource();
    	require_once("miscellaneous/Cookie_SetCookieAction.php");
        return new SJB_Cookie_SetCookieAction($cookie_data_source, $name, $value);
    }
}

