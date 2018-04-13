<?php

// Set Parameters
define('CONSUMER_KEY', SJB_Settings::getSettingByName('li_apiKey'));
define('CONSUMER_SECRET', SJB_Settings::getSettingByName('li_secKey'));

require_once 'Zend/Loader/Autoloader.php';
require_once 'LinkedinDetails.php';

Zend_Loader_Autoloader::getInstance();

class LinkedIn
{
	const _GET_RESPONSE = 'lResponse';
	const _GET_TYPE = 'lType';

	/**
	 * profile linkedin fields
	 * @var array
	 */
	private $_aProfileFields = array(
		'id',
		'first-name',
		'main-address',
		'last-name',
		'industry',
		'summary',
		'positions',
		'educations',
		'specialties',
		'picture-url',
		'phone-numbers',
		'twitter-accounts',
		'location:(name)'
	);

	private $_options = array(
		'siteUrl' => 'https://api.linkedin.com/uas/oauth',
		'localUrl' => 'http://localhost/',
		'callbackUrl' => 'http://localhost/test/linkedin/index.php?return=1',
		'requestTokenUrl' => 'https://api.linkedin.com/uas/oauth/requestToken',
//		'userAuthorisationUrl' => 'https://api.linkedin.com/uas/oauth/authorize',
		'userAuthorisationUrl' => 'https://www.linkedin.com/uas/oauth/authorize',
		'accessTokenUrl' => 'https://api.linkedin.com/uas/oauth/accessToken',
		'consumerKey' => CONSUMER_KEY,
		'consumerSecret' => CONSUMER_SECRET,
		'version' => '1.0', // there is no other version�
		'invalidateTokenUrl' => 'https://api.linkedin.com/uas/oauth/invalidateToken',
	);
	
	private $_oConsumer = null;
	private $_accessToken = null;

	public function __construct($callbackUrl = null, $aProfileFields = array())
	{

		$this->_options['localUrl'] = SJB_System::getSystemSettings('SITE_URL');
		$this->_options['callbackUrl'] = SJB_System::getSystemSettings('SITE_URL') . '?network=linkedin';

		if (!empty($callbackUrl))
		{
			$this->_options['callbackUrl'] = $callbackUrl;
		}

		if (is_array($aProfileFields))
		{
			$this->_aProfileFields = $aProfileFields;
		}

		$this->_oConsumer = new Zend_Oauth_Consumer($this->_options);
	}

//	public function __construct($callbackUrl = null, $aProfileFields = array())

	public function _getRequestToken($requestToken = null)
	{
		$token = $this->_oConsumer->getRequestToken();
		$_SESSION['linkedin']['requestToken'] = serialize($token);
		$this->_oConsumer->redirect();
	}

	public function _getAccessToken($accessToken = null)
	{
		if (!empty($accessToken))
		{
			$this->_accessToken = $accessToken;
		}
		elseif (!empty($_SESSION['linkedin']['accessToken']))
		{
			$this->_accessToken = unserialize($_SESSION['linkedin']['accessToken']);
		}
		elseif (!empty($_SESSION['linkedin']['requestToken']))
		{
			$this->_accessToken = $this->_oConsumer->getAccessToken($_REQUEST, unserialize($_SESSION['linkedin']['requestToken']));
		}

		if ($this->_accessToken)
		{
			$_SESSION['linkedin']['accessToken'] = serialize($this->_accessToken);
			return $this->_accessToken;
		}
	}

	public function getAccessToken()
	{
		return $this->_accessToken;
	}

	public function getProfileInfo($aFields = array(), $profileID = null)
	{
		if (!empty($aFields))
		{
			$this->_aProfileFields = $aFields;
		}

		if ($this->_accessToken && $this->_accessToken instanceof  Zend_Oauth_Token_Access)
		{
			$client = $this->_accessToken->getHttpClient($this->_options);

			// Set LinkedIn URI
			$sParams = '~';
			
			if (!is_null($profileID))
			{
				$sParams = 'id=' . $profileID;
			}

			$client->setUri('https://api.linkedin.com/v1/people/' . $sParams . ':('.implode(',', $this->_aProfileFields).')');


			$client->setMethod(Zend_Http_Client::GET);
			$response = $client->request();
			
			return $response->getBody();
		}
		
	}	//	public function getProfileInfo($aFields = array())

	public function peopleSearch($aFields = array())
	{
		if ($this->_accessToken && $this->_accessToken instanceof  Zend_Oauth_Token_Access)
		{
			$client = $this->_accessToken->getHttpClient($this->_options);
			
			// Set LinkedIn URI
			$client->setUri('https://api.linkedin.com/v1/people-search:(people:(id,first-name,last-name,public-profile-url,site-standard-profile-request:(url),headline,industry),num-results)');
			$client->setParameterGet($aFields);

			$client->setMethod(Zend_Http_Client::GET);
			$response = $client->request();

			return $response->getBody();
		}

		return null;
	}


	public function revoke()
	{
		if ($this->_accessToken && $this->_accessToken instanceof  Zend_Oauth_Token_Access)
		{
//			$client = $this->_accessToken->getHttpClient($this->_options);
//
//			// Set LinkedIn URI
//			$client->setUri($this->_options['invalidateTokenUrl']);
//
//			$client->setMethod(Zend_Http_Client::GET);
//			$responce = $client->request();

			unset($_SESSION['sn']['authorized']);
			$this->_accessToken = null;
			unset($_SESSION['linkedin']);

//			return $responce->getMessage() == 'OK' ? true : false;
		}
	}

}




