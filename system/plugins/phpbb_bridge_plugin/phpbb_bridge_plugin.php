<?php

require_once("plugins/PluginAbstract.php");
require_once 'Zend/Http/Client.php';

class PhpBBBridgePlugin extends SJB_PluginAbstract
{
	function pluginSettings()
	{
		return array( 
			array (
				'id'			=> 'forum_path',
				'caption'		=> 'PhpBB Path',
				'type'			=> 'string',
				'comment'		=> '* e.g. /forum',
				'length'		=> '50',
				'order'			=> null,
			)
		);
	}
	
	function login($request)
	{
		$username = $request['username'];
		$password = $request['password'];
		
		$url = SJB_System::getSystemSettings('SITE_URL') . SJB_Settings::getSettingByName('forum_path') . '/ucp.php?mode=login';

	    $client = new Zend_Http_Client($url, array('useragent' => $_SERVER['HTTP_USER_AGENT']));
        $client->setCookie($_COOKIE);
        $client->setMethod(Zend_Http_Client::POST);
        $client->setParameterPost(
            array(
            	'username'  => $username,
            	'password'  => $password,
            	'login'	    => 'Login',
            	'autologin' => '',
            	'viewonline'=> ''
            )
        );

        $client->setCookieJar();
        try {
    	    $ret = $client->request();
	        foreach ($ret->getHeaders() as $key => $header) {
	            if ('set-cookie' == strtolower($key)) {
	                if (is_array($header)) {
    	                foreach ($header as $val) {
                            header("Set-Cookie: " . $val, false);
    	                }
	                }
	                else {
	                    header("Set-Cookie: " . $header, false);
	                }
	            }
	        }
        }
        catch (Exception $ex) {}
	}
	
	function logout()
	{
		$url = SJB_System::getSystemSettings('SITE_URL') . SJB_Settings::getSettingByName('forum_path') . '/';
	    $client = new Zend_Http_Client($url, array('useragent' => $_SERVER['HTTP_USER_AGENT']));
        $client->setCookie($_COOKIE);
        $client->setCookieJar();
        try {
            $response = $client->request();
            $matches = array();
            if (preg_match('/\.\/ucp.php\?mode=logout\&amp;sid=([\w\d]+)"/', $response->getBody(), $matches)) {
                $sid = $matches[1];
        		$url = SJB_System::getSystemSettings('SITE_URL') . SJB_Settings::getSettingByName('forum_path') . '/ucp.php?mode=logout&sid=' . $sid;
        	    $client->setUri($url);
        	    $response = $client->request();
    	        foreach ($response->getHeaders() as $key => $header) {
    	            if ('set-cookie' == strtolower($key)) {
    	                if (is_array($header)) {
        	                foreach ($header as $val) {
                                header("Set-Cookie: " . $val, false);
        	                }
    	                }
    	                else {
    	                    header("Set-Cookie: " . $header, false);
    	                }
    	            }
    	        }
            }
        }
        catch (Exception $ex) {}
	}
}