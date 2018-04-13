<?php

require_once('plugins/SocialPlugin.php');
//require_once('linkedin/linkedin_2.1.0.class.php');
require_once('linkedin/Linkedin.php');

class LinkedinSocialPlugin extends SJB_SocialPlugin
{
	private $_profileFields = array(
		'id',
		'first-name',
		'main-address',
		'last-name',
		'headline',
		'date-of-birth',
		'industry',
		'summary',
		'positions',
		'educations',
		'specialties',
		'picture-url',
		'phone-numbers',
		'twitter-accounts',
		'public-profile-url',
		'location'
	);
	
	protected static $network = 'linkedin';
	private static $object = null;

	function pluginSettings()
	{
		return SJB_LinkedinDetails::getDetails(array());
	}
	
	/**
	 * display login button;
	 * 
	 * @param SJB_TemplateProcessor $tp
	 */
	public function displayContent(&$tp)
	{
		$tp->assign('profile', LinkedinSocialPlugin::getProfileObject());
		$tp->display('linkedin_login.tpl');
	}
	
	public function getNetwork()
	{
		return self::$network;
	}

	public function init()
	{
		$this->cleanSessionData(self::$network);
		
		if (is_null(self::$object) && empty($_SESSION['sn']['authorized'])) {
			try {
				$_REQUEST[LINKEDIN::_GET_TYPE] = (isset($_REQUEST[LINKEDIN::_GET_TYPE])) ? $_REQUEST[LINKEDIN::_GET_TYPE] : '';

				/**
				 * initialize user by profile social id
				 * if not initialized trying to authorized by default
				 */
				if (!empty($_GET['network']) && 'linkedin' == $_GET['network'] && !empty($_SESSION['linkedin']['id']) && !isset($_GET['setid'])) {
					if ($this->initializeByProfileSocialID($_SESSION['linkedin']['id'])) {
						$this->flagSocialPluginInSession($this->network);

						$_SESSION['linkedin']['id'] = (string) self::$oProfile->id;

						return true;
					}
				}

				if (!empty($_GET['network']) && 'linkedin' == $_GET['network'] && !isset($_GET['social_id'])) {
					// user initiated LinkedIn connection
					// create the linkedin object
					$callback_url = SJB_System::getSystemSettings('SITE_URL');

					if (isset($_SERVER['HTTP_REFERER'])) {
						$callback_url = $_SERVER['HTTP_REFERER'] . ((strstr($_SERVER['HTTP_REFERER'], '?')) ? '&' : '?') . 'network=linkedin&' . LINKEDIN::_GET_TYPE . '=initiate&' . LINKEDIN::_GET_RESPONSE . '=1';
					}
					else {
						$callback_url = SJB_System::getSystemSettings('SITE_URL') . SJB_Navigator::getURI() . '?network=linkedin&' . LINKEDIN::_GET_TYPE . '=initiate&' . LINKEDIN::_GET_RESPONSE . '=1';
					}
					
					/**
					 * remember userGroupID if is defined
					 */
					$userGroupID = SJB_Request::getVar('user_group_id');
					
					if ($userGroupID) {
						$_SESSION['userGroupID'] = $userGroupID;
					}
					
					self::$object = new LinkedIn($callback_url);

					// check for response from LinkedIn
					$_GET[LINKEDIN::_GET_RESPONSE] = (isset($_GET[LINKEDIN::_GET_RESPONSE])) ? $_GET[LINKEDIN::_GET_RESPONSE] : '';


					if (!$_GET[LINKEDIN::_GET_RESPONSE]) {
						$response = self::$object->_getRequestToken();
					}
					else {
						// LinkedIn has sent a response, user has granted permission, take the temp access token, the user's secret and the verifier to request the user's real secret key
						// user is already connected
						self::$object = new linkedin();

						$response = self::$object->_getAccessToken();

						if (self::$object->getAccessToken()) {
							// the request went through without an error, gather user's 'access' tokens
							// set the user as authorized for future quick reference
							$this->flagSocialPluginInSession(self::$network);
							
							// now we have the session 'access' tokens, request the linkedin profile info for the user
							// and store that with keys in SESSION
							$this->takeDataFromServer = true;

							$this->getProfileInformation();

							/*
							 * save new accessToken, profileInfo in DB
							 */
							$this->saveProfileSystemInfo();
							
							/*
							 * if user already registered we should link his profile 
							 * with linkedin id
							 */
							if ($oCurrentUser = SJB_UserManager::getCurrentUser()) {
								$this->setUserSocialIDByUserSID($oCurrentUser->getSID(), self::$oProfile->id);
								SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/my-account/');
							}
							elseif (!self::ifUserIsRegistered()) {
								/**
								 * redirect user to registration page if he is not registered
								 */
								$this->redirectToRegistrationSocialPage();
							}
						}
						else {
							if (isset($_GET['debug'])) {
								// bad token access
								// FIXME: *********************************************************
								echo '<h5>VARDUMP :: ' . __FILE__ . '::LINE ' . __LINE__ . '</h5><pre>';
								var_dump("Bad access token call:\n\nRESPONSE:\n\n" . print_r($response, TRUE) . "\n\nLINKEDIN OBJ:\n\n" . print_r(self::$object, TRUE));
								echo '</pre>';
								// FIXME: *********************************************************
							}
						}
					}
				}	//	if ('linkedin' == $_GET['network'] && !isset($_GET['social_id']))
				/*
				 * if user have alredy logged into linkedin
				 */
//				elseif ('linkedin' == $_GET['network'] && !empty($_GET['social_id']))
//				{
//					if ($this->initializeByProfileSocialID($_GET['social_id']))
//					{
//						$_SESSION['sn']['authorized'] = TRUE;
//
//// FIXME: *********************************************************
//						echo '<h5>VARDUMP :: ' . __FILE__ . '::LINE ' . __LINE__ . '</h5><pre>';
//						var_dump( $this->getProfileObject());
//						echo '</pre>';
//// FIXME: *********************************************************
//
//						$_SESSION['linkedin']['id'] = (string)self::$oProfile->id;
//					}
//				}
			}
			catch (LinkedInException $e) {
				// exception raised by library call
				echo $e->getMessage();
			}
		}
		elseif (self::$oProfile && !self::ifUserIsRegistered()) {
			/**
			 * if user already logged in using social plugin but not registered
			 * redirect him to registration social page
			 */
			$this->redirectToRegistrationSocialPage();
		}
		
		return;
	}



	/**
	 *
	 * @param string $profileSocialID
	 * @return boolean
	 */
	public function initializeByProfileSocialID($profileSocialID)
	{
		if (!LinkedinSocialPlugin::ifUserIsRegistered($profileSocialID)) {
			return false;
		}

		if ($accessToken = $this->getProfileSavedAccessToken($profileSocialID)) {
			return $this->initialize($accessToken);
		}

		return false;
	}



	public function getProfileSavedAccessToken($socialID)
	{
		$socInfo = SJB_DB::query('SELECT `access` FROM `linkedin` WHERE `linkedin_id` = ?s', $socialID);

		if (!empty($socInfo))
		{
			$socInfo = array_shift($socInfo);
			
			if (!empty($socInfo['access']))
			{
				return unserialize($socInfo['access']);
			}
		}
		return null;
	}
	
	
	public function getProfileSocialSavedInfoBySocialID($socialID)
	{
		$socInfo = SJB_DB::query('SELECT * FROM `linkedin` WHERE `linkedin_id` = ?s', $socialID);

		if (!empty($socInfo))
		{
			$socInfo = array_shift($socInfo);
			
			if (!empty($socInfo['access']))
			{
				$socInfo['access'] = unserialize($socInfo['access']);
				$socInfo['profile_info'] = new SimpleXMLElement(unserialize($socInfo['profile_info']));
				return $socInfo;
			}
		}
		return null;
		
	}


	public function getProfilePublicUrlByProfileLinkedinID($socialID)
	{
//		$response = self::$object->getProfileInfo(array('public-profile-url'), $profileID);

		$socInfo = SJB_DB::query('SELECT `profile_info` FROM `linkedin` WHERE `linkedin_id` = ?s', $socialID);

		if (!empty($socInfo))
		{
			$socInfo = array_shift($socInfo);

			if (!empty($socInfo['profile_info']))
			{
				$nProf = unserialize($socInfo['profile_info']);
				$nProf = new SimpleXMLElement($nProf);
				return !empty($nProf->{'public-profile-url'}) ? (string) $nProf->{'public-profile-url'} : false;
			}
		}

		return null;
	}

//	public function getProfilePublicUrl($profileID)

	/**
	 *
	 * @param array|object $access_token
	 */
	public function initialize($access_token)
	{
		self::$object = new linkedin();

		if (self::$object->_getAccessToken($access_token))
		{
			// profile
			return $this->getProfileInformation();
		}
		else
		{
			if (isset($_GET['debug']))
			{
				// failed setting user access token
				// revocation successful, clear session
				// FIXME: *********************************************************
				echo '<h5>VARDUMP :: ' . __FILE__ . '::LINE ' . __LINE__ . '</h5><pre>';
				var_dump('An error occured setting the user access token.');
				echo '</pre>';
				// FIXME: *********************************************************
			}
		}

		return null;
	}

//	public function initialize($access_token)

	public function __construct($takeDataFromServer = false)
	{
		$_SESSION['sn']['authorized'] = (isset($_SESSION['sn']['authorized'])) ? $_SESSION['sn']['authorized'] : FALSE;

		if (isset($_GET['autofill'])) {
			$this->takeDataFromServer = true;
		}
		else {
			$this->takeDataFromServer = $takeDataFromServer;
		}

		if ($_SESSION['sn']['authorized'] === TRUE && self::$network === $_SESSION['sn']['network'] && !empty($_SESSION['linkedin']['accessToken'])) {
			$this->initialize(unserialize($_SESSION['linkedin']['accessToken']));
		}
	}



	public function getSocialIDByReferenceUID($referenceUID)
	{
		return substr($referenceUID, (strlen(self::$network) + 1));
	}

	/**
	 * save social information
	 * access token,
	 */
	public function saveProfileSystemInfo()
	{
		if ($oProfile = &self::getProfileObject())
		{
			$linkedinID = (string) $oProfile->id;
			$access = $_SESSION['linkedin']['accessToken'];
			$profileInfo = serialize($oProfile->asXML());

			if ( $linkedinID && $access && $profileInfo )
			{
				return SJB_DB::query('INSERT INTO `linkedin` SET `linkedin_id` = ?s, `access` = ?s, `profile_info` = ?s
					ON DUPLICATE KEY UPDATE `access` = ?s, `profile_info`=?s', $linkedinID, $access, $profileInfo, $access, $profileInfo);

			}
			
			return false;
			
		} //	if ( $oProfile = &self::getProfileObject())

		return null;
	}	//	public function saveProfileSystemInfo()

	
	private function getProfileInformation()
	{
		if (!$this->takeDataFromServer && $oCurUser = SJB_UserManager::getCurrentUser())
		{
			$curUserSID = $oCurUser->getSID();
			$profileSocialID = self::getProfileSocialID($curUserSID);
			
			if ($profileSocialID)
			{
				$aProfExpl = explode($this->getNetwork() . '_', $profileSocialID);
				$linkedinID = $aProfExpl[1];

				$profileSocialInfo = $this->getProfileSocialSavedInfoBySocialID($linkedinID);

				if ($profileSocialInfo)
				{
//					echo '<h1>took info from local server</h1>';
					self::$oProfile = $profileSocialInfo['profile_info'];
					self::$oSocialPlugin = $this;
					
					if (SJB_Request::getVar('socialdebug'))
					{
						// FIXME: *********************************************************
						echo '<h5>VARDUMP :: ' . __FILE__ . '::LINE ' . __LINE__ . '</h5><pre>';
						var_dump(self::$oProfile);
						echo '</pre>';
						// FIXME: *********************************************************
					}
					return true;
				}
			}
		}

		if (self::$object)
		{
			$response = self::$object->getProfileInfo($this->_profileFields);

			if ($response)
			{
//				echo '<h1>took info from REMOTE server</h1>';

				self::$oProfile = new SimpleXMLElement($response);
				self::$oSocialPlugin = $this;

				if (SJB_Request::getVar('socialdebug'))
				{
					// FIXME: *********************************************************
					echo '<h5>VARDUMP :: ' . __FILE__ . '::LINE ' . __LINE__ . '</h5><pre>';
					var_dump(self::$oProfile);
					echo '</pre>';
					// FIXME: *********************************************************
				}
				return true;
			}
			else
			{
				// revocation successful, clear session
				unset($_SESSION['oauth']['linkedin']);
				$this->cleanSessionData(self::$network);

				if (isset($_GET['debug'])) {
					// profile retrieval failed
					// FIXME: *********************************************************
					echo '<h5>VARDUMP :: ' . __FILE__ . '::LINE ' . __LINE__ . '</h5><pre>';
					var_dump("Error retrieving profile information:\n\nRESPONSE:\n\n<pre>" . print_r($response) . "</pre>");
					echo '</pre>';
					// FIXME: *********************************************************
				}
			} //	if ($response['success'] === TRUE)
		} //	if ( self::$object)

		return null;
	}


	

	public function logout()
	{
		if (self::$object && self::$oProfile)
		{
			$response = self::$object->revoke();

			if ($response === TRUE)
			{
				// revocation successful, clear session
				unset($_SESSION['oauth']['linkedin']);

				if (empty($_SESSION['oauth']['linkedin']))
				{
					// session destroyed
//					header('Location: ' . $_SERVER['PHP_SELF']);
				}
				else
				{
					// session not destroyed
					echo "Error clearing user's session";
				}
			}
			else
			{
//				// revocation failed
//				echo "Error revoking user's token:\n\nRESPONSE:\n\n" . print_r($response, TRUE) . "\n\nLINKEDIN OBJ:\n\n" . print_r(self::$object, TRUE);
			}
		}
	}

	public function fillRequestOutSocialData(&$request)
	{
		if ($oProfile = &self::getProfileObject())
		{
			require_once('linkedin/LinkedinFields.php');

			$oLF = new SJB_LinkedinFields($oProfile);

			require_once('linkedin/LinkedinSettings.php');

			$oLF->fillOutListingData_Request($request, $aFieldAssoc);
		}

		return $request;
	}
	

	public function fillObjectOutSocialData(&$obj)
	{
		if ($oProfile = &self::getProfileObject())
		{
			require_once('linkedin/LinkedinFields.php');

			$oLF = new SJB_LinkedinFields($oProfile);

			require('linkedin/LinkedinSettings.php');

			$oLF->fillOutListingData_Object($obj, $aFieldAssoc);
		}

		return $obj;
	}
	

	public function fillRegistrationDataWithUser(&$object)
	{
		if (self::$oSocialPlugin instanceof LinkedinSocialPlugin && $oProfile = &self::getProfileObject()) {
			foreach ($object->getProperties() as $oProperty) {
				$value = '';

				switch ($oProperty->getID()) {
					case 'Country':
						if (!empty($oProfile->location->country->code)) {
							require_once('miscellaneous/Countries.php');
							$object->setPropertyValue('Country', SJB_Countries::getCountryNameByISO2((string) $oProfile->location->country->code));
						}
						break;
					case 'DateOfBirth':
						if (!empty($oProfile->{'date-of-birth'})) {
							$year = !empty($oProfile->{'date-of-birth'}->year) ? (string) $oProfile->{'date-of-birth'}->year : '0000';
							$month = !empty($oProfile->{'date-of-birth'}->month) ? (string) $oProfile->{'date-of-birth'}->month : '00';
							$day = !empty($oProfile->{'date-of-birth'}->day) ? (string) $oProfile->{'date-of-birth'}->day : '00';
							$object->setPropertyValue('DateOfBirth', SJB_I18N::getInstance()->getDate($day . '-' . $month . '-' . $year));
						}
						break;
					case 'FirstName':
						if (!empty($oProfile->{'first-name'})) {
							$object->setPropertyValue('FirstName', $oProfile->{'first-name'});
						}
						break;
					case 'LastName':
						if (!empty($oProfile->{'last-name'})) {
							$object->setPropertyValue('LastName', $oProfile->{'last-name'});
						}
						break;
					case 'ContactName':
						if (!empty($oProfile->{'last-name'})) {
							$object->setPropertyValue('ContactName', $oProfile->{'first-name'} . ' ' . $oProfile->{'last-name'});
						}
						break;
					case 'WebSite':
						// WebSite
						if (!empty($oProfile->website)) {
							$object->setPropertyValue('WebSite', $oProfile->website);
						}
						break;
					case 'Title':
					case 'TITLE':
						if (!empty($oProfile->positions->position->title)) {
							$value = $oProfile->positions->position->title;
						}
						break;
					case 'CompanyName':
						if (!empty($oProfile->positions->position->company->name)) {
							$object->setPropertyValue('CompanyName', $oProfile->positions->position->company->name);
						}
						break;
					case 'CompanyDescription':
						if (!empty($oProfile->summary)) {
							$object->setPropertyValue('CompanyDescription', $oProfile->summary);
						}
						break;
					case 'City':
						if (!empty($oProfile->location->name)) {
							$object->setPropertyValue('City', $oProfile->location->name);
						}
						break;
					case 'PhoneNumber':
						if (!empty($oProfile->{'phone-numbers'})) {
							$aPhoneNumbers = array();
							foreach (self::$oProfile->{'phone-numbers'}->{'phone-number'} as $phone) {
								array_push($aPhoneNumbers, $phone->{'phone-number'} . ' (' . $phone->{'phone-type'} . ')');
							}
							$object->setPropertyValue('PhoneNumber', implode(', ', $aPhoneNumbers));
						}
						break;
					case 'jsTwitter':
						if (!empty($oProfile->{'twitter-accounts'})) {
							$aTwitters = array();
							foreach (self::$oProfile->{'twitter-accounts'}->{'twitter-account'} as $twitter) {
								array_push($aTwitters, $twitter->{'provider-account-name'});
							}
							$object->setPropertyValue('jsTwitter', implode(', ', $aTwitters));
						}
						break;
					case 'Address':
						if (!empty($oProfile->{'main-address'})) {
							$object->setPropertyValue('Address', $oProfile->{'main-address'});
						}
						break;

					case 'username':
					case 'email':
					case 'password':
						continue(2);
						break;
					default:
						if (!in_array($oProperty->getID(), self::$aUserFields) && !in_array($oProperty->getID(), self::$aListingFields)) {
							$object->deleteProperty($oProperty->getID());
						}
						break;
				} //	switch ($oProperty->getID())
//				if (!empty($value))
//				{
//					$object->setPropertyValue($object->getID(), $value);
//				}
			} //	foreach ( $user->getProperties() as $oProperty)
		} //	if ($oProfile = &self::getProfileObject())

		return $object;
	}


	function ifUserIsRegistered($profileSocialID = null)
	{
		return parent::ifUserIsRegistered(self::$network, $profileSocialID);
	}


	public function peopleSearch($aFields = array())
	{
		$aPrepared = array();

		if (self::$object && self::$oProfile && is_array($aPrepared))
		{
			foreach($aFields as $fieldName => $fieldValue)
			{
				if(!empty($fieldValue))
				{
					if('facet' == $fieldName)
					{
						$aPrepared[$fieldName] = $fieldValue;
					}
					else
					{
						$aPrepared[$fieldName] = urlencode($fieldValue);
					}
				}
			}

			$response = self::$object->peopleSearch($aPrepared);


			if ( $response)
			{
				$oPersons = new SimpleXMLElement($response);

				if ( (int)$oPersons->{'num-results'} >= 0 )
				{
					return $oPersons;
				}
			}
		}
		
		return null;
	}


	public function preparePeopleStructure($oPersons = array())
	{
		$result = array();

		if ( !empty($oPersons->people->person))
		{
			foreach ( $oPersons->people->person as $oPerson)
			{
				$structure = array(
					'firstName' => empty($oPerson->{'first-name'}) ? 'Undefined' : (string)$oPerson->{'first-name'},
					'lastName' => empty($oPerson->{'last-name'}) ? '' : (string)$oPerson->{'last-name'},
					'industry' => empty($oPerson->industry) ? '' : (string)$oPerson->industry,
					'id' => empty($oPerson->id) ? '' : (string)$oPerson->id,
					'headline' => empty($oPerson->headline) ? '' : (string)$oPerson->headline,
//					'url' => empty($oPerson->{'public-profile-url'}) ? '' : (string)$oPerson->{'public-profile-url'},
					'url' => empty($oPerson->{'site-standard-profile-request'}->url) ? '' : (string)$oPerson->{'site-standard-profile-request'}->url,
				);
				array_push($result, $structure);
			}
		}
		
		return $result;
	}
}

// end of class
