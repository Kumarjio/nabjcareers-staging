<?php

require_once("plugins/PluginAbstract.php");
require_once 'Zend/Http/Client.php';
$c = new Zend_Http_Client();
$c->setCookieJar();

class WordPressBridgePlugin extends SJB_PluginAbstract
{
	function pluginSettings ()
	{
		return array( 
			array (
				'id'			=> 'blog_path',
				'caption'		=> 'WordPress Path',
				'type'			=> 'string',
				'comment'		=> '* e.g. /blog',
				'length'		=> '50',
				'order'			=> null,
			),
			array (
				'id'			=> 'display_blog_on_homepage',
				'caption'		=> 'Display on homepage',
				'type'			=> 'boolean',
				'length'		=> '50',
				'order'			=> null,
			),
			array (
				'id'			=> 'rss_url_for_wordpress',
				'caption'		=> 'RSS url',
				'type'			=> 'string',
				'comment'		=> '* e.g. http://rss_url.com',
				'length'		=> '50',
				'order'			=> null,
			)
		);
	}
	
	function login($request)
	{
		$username = $request['username'];
		$password = $request['password'];
		
		$url = SJB_System::getSystemSettings('SITE_URL') . SJB_Settings::getSettingByName('blog_path') . '/wp-login.php';
		$client = new Zend_Http_Client($url,
		    array(
		    	'useragent' => $_SERVER['HTTP_USER_AGENT'],
		        'maxredirects' => 0
		    )
		);
		$client->setCookieJar();
        $client->setCookie($_COOKIE);
        $client->setMethod(Zend_Http_Client::POST);
        $client->setParameterPost(
            array(
                'log' => $username,
                'pwd' => $password,
                'wp-submit' => 'Log in'
            )
        );
        
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
        $_SESSION['wp_cookie_jar'] = $client->getCookieJar();
	}
	
	function logout()
	{
		$url = SJB_System::getSystemSettings('SITE_URL') . SJB_Settings::getSettingByName('blog_path') . '/';
		$client = new Zend_Http_Client($url,
		    array(
		   		'useragent' => $_SERVER['HTTP_USER_AGENT'],
		        'maxredirects' => 0
		    )
		);
		if (isset($_SESSION['wp_cookie_jar']))
		    $client->setCookieJar($_SESSION['wp_cookie_jar']);
	    $response = $client->request();
        $matches = array();
        if (preg_match('/_wpnonce=([\w\d]+)"/', $response->getBody(), $matches)) {
            $wpnonce = $matches[1];
    		$url = SJB_System::getSystemSettings('SITE_URL') . SJB_Settings::getSettingByName('blog_path') . '/wp-login.php?action=logout&_wpnonce=' . $wpnonce;
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
	
	function displayBlogContent()
	{
    	require_once 'Zend/Feed.php';
		require_once 'Zend/Date.php';
	    
		if (SJB_System::getSettingByName('display_blog_on_homepage')) {
			$url = SJB_System::getSettingByName('rss_url_for_wordpress');
			try {
			    $feed = Zend_Feed::import($url);
			}
			catch (Exception $ex ){
			    $feed = array();
			}
			
			$items = array();
			foreach ($feed as $feedItem) {
			    $date = new Zend_Date($feedItem->pubDate(), DATE_RSS);
				$i18n = SJB_I18N::getInstance();
				$langData = $i18n->getLanguageData($i18n->getCurrentLanguage());
				$item = array(
						'date' => $i18n->getDate(strftime($langData['date_format'], $date->toValue(Zend_Date::TIMESTAMP))),
				        'title' => $feedItem->title(),
				        'description' => $feedItem->description() 
				    );
				$items[] = $item;
			}
			return $items;
		}
	}
}