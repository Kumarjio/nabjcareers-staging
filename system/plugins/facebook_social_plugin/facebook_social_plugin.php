<?php
// Set Parameters
define('FB_CONSUMER_KEY', SJB_Settings::getSettingByName('fb_appID'));
define('FB_CONSUMER_SECRET', SJB_Settings::getSettingByName('fb_appSecret'));

require_once('plugins/PluginAbstract.php');
require_once('plugins/SocialPlugin.php');
require_once('facebook/facebook.php');
require_once 'facebook/FacebookDetails.php';

class FacebookSocialPlugin extends SJB_SocialPlugin
{
	
	protected $network = 'facebook';
	
	/**
	 *
	 * @var Facebook $object
	 */
	private static $object = null;
	private static $user = null;

	const NETWORK = 'facebook';
	
	/**
	 * list of facebook's permissions
	 * @var array
	 */
	private static $aPermissionFields = array(
		'user_about_me',
		'user_work_history',
		'user_education_history',
		'email',
		'user_website',
		'user_birthday',
		'user_hometown',
//		'user_interests',
//		'read_friendlists',
//		'user_photos',
//		'user_videos',
//		'publish_stream',
		'user_location',
//		'offline_access',
	);



	function pluginSettings()
	{
		return SJB_FacebookDetails::getDetails(array());
	}
	
	public function getNetwork()
	{
		return $this->network;
	}

	public static function createFacebookInstance()
	{
		// Create our Application instance (replace this with your appId and secret).
		self::$object = new Facebook(array('appId' => FB_CONSUMER_KEY, 'secret' => FB_CONSUMER_SECRET, 'cookie' => true,));

		// We may or may not have this data based on a $_GET or $_COOKIE based session.
		//
		// If we get a session here, it means we found a correctly signed session using
		// the Application Secret only Facebook and the Application know. We dont know
		// if it is still valid until we make an API call using the session. A session
		// can become invalid if it has already expired (should not be getting the
		// session back in this case) or if the user logged out of Facebook.
		self::$user = self::$object->getUser();
	}


	/**
	 * save social information
	 * access token,
	 */
	public function saveProfileSystemInfo()
	{
		if ($oProfile = &self::getProfileObject())
		{
			$sSocialID = (string) $oProfile->id;
			$session = serialize(self::$object->getAccessToken());
			$profileInfo = serialize($oProfile);

			if ( $sSocialID && $session && $profileInfo )
			{
				return SJB_DB::query('INSERT INTO `facebook` SET `facebook_id` = ?s, `access` = ?s, `profile_info` = ?s
					ON DUPLICATE KEY UPDATE `access` = ?s, `profile_info`=?s', $sSocialID, $session, $profileInfo, $session, $profileInfo);

			}
			
			return false;
			
		} //	if ( $oProfile = &self::getProfileObject())

		return null;
	}	//	public function saveProfileSystemInfo()
	
	
	public function init()
	{

		$this->cleanSessionData($this->network);
		
		if (empty($_SESSION['sn']['authorized']))
		{
			if (is_null(self::$object))
			{
				self::createFacebookInstance();
			}
			
			$this->takeDataFromServer = true;
			
			if (!SJB_Request::getVar('state', null, 'GET') && 'facebook' == $_REQUEST['network'])
			{
				$userGroupID = SJB_Request::getVar('user_group_id');
				if ($userGroupID)
				{
					$_SESSION['userGroupID'] = $userGroupID;
				}
				
				SJB_HelperFunctions::redirect($this->getFacebookLoginUrl());
				exit();
			}
			elseif (self::$user && $this->getProfileInformation())
			{
				$this->flagSocialPluginInSession($this->network);
				
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
				elseif(!self::ifUserIsRegistered()) {
					/**
					 * redirect user to registration page if he is not registered
					 */
					$this->redirectToRegistrationSocialPage();
				}
			}	//	if (self::$session)
		} //	if (is_null(self::$object))
		elseif (self::$oProfile && !self::ifUserIsRegistered()) {
			/**
			 * if user already logged in using social plugin but not registered
			 * redirect him to registration social page
			 */
			$this->redirectToRegistrationSocialPage();
		}

	}	//	public function init()
	

	public static function getFaceBookLogInOutUrl()
	{
		if ( self::$oProfile )
		{
			return self::getFacebookLogoutUrl();
		}
		else
		{
			return self::getFacebookLoginUrl();
		}
	}

	public static function getFacebookLogoutUrl()
	{
		if (is_object(self::$object) && self::$object instanceof  Facebook)
		{
			return self::$object->getLogoutUrl();
		}
		return false;
	}


	public static function getFacebookLoginUrl()
	{
//		if (is_object(self::$object) && !self::$object->getUser())
		if (is_object(self::$object))
		{
//			return self::$object->getLoginUrl(array('req_perms' => implode(',', self::$aPermissionFields)));
			return self::$object->getLoginUrl(array('scope' => implode(',', self::$aPermissionFields)));
		}
		return false;
	}


	
	public function __construct($takeDataFromServer = null)
	{
		if (empty($_SESSION['sn']['network']) || 'facebook' != $_SESSION['sn']['network']) {
			return null;
		}
		
		// Create our Application instance (replace this with your appId and secret).
		$this->createFacebookInstance();
		// Session based API call.

		if (isset($_GET['autofill'])) {
			$this->takeDataFromServer = true;
		}
		else {
			$this->takeDataFromServer = $takeDataFromServer;
		}

		if (self::$user && !empty($_SESSION['sn'])) {
			$this->getProfileInformation();
		} //	if (self::$session)
	}



	public function getProfileInformation()
	{
		require_once 'users/User/UserManager.php';
		
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
			try
			{
				$this->_getProfileInfoByAcessToken();
				
				if (self::$oProfile)
				{
					if ( isset($_GET['socialdebug']))
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
					unset($_SESSION['sn']);
				}
			}
			catch (FacebookApiException $e)
			{
				error_log($e);
			}
		}

		return null;
	}

	public function defineWetherEmailIsNeeded()
	{
		require_once('users/User/UserManager.php');

		if (!empty(self::$oProfile->email) && !strstr(self::$oProfile->email, 'proxymail.facebook.com') && !SJB_UserManager::getUserSIDbyEmail(self::$oProfile->email))
		{
			$key = array_search('email', self::$aUserFields);

			if ($key !== false)
			{
				unset(self::$aUserFields[$key]);
			}
		}
	}
	
	
	/**
	 * get SocialNetwork Profile info from facebook server
	 * 
	 * @param string $accessToken 
	 */
	public function _getProfileInfoByAcessToken($accessToken = null)
	{
		if ($accessToken)
		{
			self::$object->setAccessToken($accessToken);
		}
		
		self::$oProfile = self::$object->api('/me');
		self::$oProfile = new ArrayObject(self::$oProfile);
		self::$oProfile->setFlags(ArrayObject::ARRAY_AS_PROPS);

		if (self::$oProfile) {
			self::$oSocialPlugin = $this;
			return true;
		}

		return false;
	}
	
	
	/**
	 * 
	 * @param string $socialID
	 * @return stdClass
	 */
	public function getProfileSocialSavedInfoBySocialID($socialID)
	{
		$socInfo = SJB_DB::query('SELECT * FROM `facebook` WHERE `facebook_id` = ?s', $socialID);

		if (!empty($socInfo))
		{
			$socInfo = array_shift($socInfo);
			
			if (!empty($socInfo['access']))
			{
				$socInfo['access'] = unserialize($socInfo['access']);
				$socInfo['profile_info'] = unserialize($socInfo['profile_info']);
				return $socInfo;
			}
		}
		
		return null;
		
	}



	public function logout()
	{
		unset($_SESSION['sn']);
		if (self::$oProfile) {
			/**
			 * @var self::$object Facebook
			 */
//			self::$object->setSession(array());
			SJB_HelperFunctions::redirect(self::getFacebookLogoutUrl());
			exit();
		}
	}



	/**
	 * check wether user is registered using social plugin
	 * <p>if user is registered, returns user's SID</p>
	 * 
	 * @return boolean
	 */
	function ifUserIsRegistered()
	{
		if (self::$oProfile) {
			return parent::ifUserIsRegisteredByReferenceUid('facebook_' . self::$oProfile->id);
		}
		return false;
	}



	public function displayContentInviteFriends(&$tp)
	{
		if (self::$oProfile) {
			$tp->assign('appID', self::$object->getAppId());
			$tp->assign('session', json_encode(self::$user));
			$tp->display('facebook_invite_friends.tpl');
		}
	}

	public function addReferenceDetails(&$user)
	{
		if (self::$oProfile)
		{
			parent::fillRegistrationDataWithUser($user);
			parent::addReferenceDetails($user, 'facebook');
		}
		return $user;
	}


	public function createUser()
	{
		$user_group_id = SJB_Request::getVar('user_group_id');

		if (!is_null($user_group_id))
		{
			$user_group_sid = SJB_UserGroupManager::getUserGroupSIDByID($user_group_id);
//			$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid);

			$user = &SJB_ObjectMother::createUser($_REQUEST, $user_group_sid);
			$user->deleteProperty("active");
			$user->deleteProperty("featured");


			$this->fillRegistrationDataWithUser($user);

			self::addReferenceDetails($user);


			$user->deleteProperty("captcha");

			/*
			 * SAVE USER
			 */
			SJB_UserManager::saveUser($user);

			// SEND REGISTRATION LETTER
			//		Event::dispatch('SendUserSocialRegistrationLetter_SocialPlugin', $user);

//			self::createListing($user);

			// CONTRACT
//			$available_membership_plan_ids = SJB_MembershipPlanManager::getPlansIDByGroupSID($user_group_sid);
//			
//			if (count($available_membership_plan_ids) == 1)
//			{
//				$membership_plan_id = array_pop($available_membership_plan_ids);
//				$membership_plan = new SJB_MembershipPlan(array('id' => $membership_plan_id));
//				if ($membership_plan->getPrice() == 0)
//				{
//					$contract = new SJB_Contract(array('membership_plan_id' => $membership_plan_id));
//					$contract->setUserSID($user->getSID());
//					$contract->saveInDB();
//				}
//			}
			
			/**
			 * subscribe user on default membership plan
			 */
			$defaultPlan = SJB_UserGroupManager::getDefaultPlan($user_group_sid);
			$available_membership_plan_ids = SJB_MembershipPlanManager::getPlansIDByGroupSID($user_group_sid);

			if ($defaultPlan && in_array($defaultPlan, $available_membership_plan_ids))
			{
	//			$membership_plan = new SJB_MembershipPlan(array('id' => $defaultPlan));
				//price is not required for default membership plan
				//if ($membership_plan->getPrice() == 0) {
				$contract = new SJB_Contract(array('membership_plan_id' => $defaultPlan));
				$contract->setUserSID($user->getSID());
				$contract->saveInDB();
				//}
			}
			
			$this->sendUserSocialRegistrationLetter($user);
			//		$listingSID = SJB_SocialPlugin::createListing($user);

			// notifying administrator
			require_once("miscellaneous/AdminNotifications.php");
			if (SJB_AdminNotifications::isAdminNotifiedOnUserRegistration())
			{
				SJB_AdminNotifications::sendAdminUserRegistrationLetter($user->getSID());
			}

			SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL'). '/my-account/');
			
		}	// if (!is_null($user_group_id))

	}	//	public function createUser()


//	public function fillObjectOutSocialData(&$object)
	public function fillRegistrationDataWithUser(&$object)
	{
//		$request['ContactName'] = $fbProfile->name;
//			$request['FirstName'] = $fbProfile->first_name;
//			$request['LastName'] = $fbProfile->last_name;
//			$request['WebSite'] = isset($fbProfile->website) ? $fbProfile->website: '';
//			$request['CompanyName'] = (!empty($fbProfile->work[0]->employer->name)) ? $fbProfile->work[0]->employer->name : '';
//			$request['CompanyDescription'] = (!empty($fbProfile->bio)) ? $fbProfile->bio : '';
//			if(!empty($fbProfile->location->name))
//			{
//				$location = explode(', ', $fbProfile->location->name);
//				$request['Country'] = (count($location) > 2) ? ((!empty($location[2])?$location[2]:'')) : (!empty($location[1])?$location[1]:'') ;
//				$request['City'] = (!empty($location[0])) ? $location[0] : '';
//			}
		if ($oProfile = &self::getProfileObject())
		{
			foreach ( $object->getProperties() as $oProperty)
			{
				$value = false;

				switch ($oProperty->getID())
				{
					case 'Country':
					case 'CurrentCountry':
					case 'City':
					case 'CurrentCity':
						if(!empty($oProfile->location['name']))
						{
							$location = explode(', ', $oProfile->location['name']);
							if ( 'Country' == $oProperty->getID() || 'CurrentCountry' == $oProperty->getID())
							{
								$value = (count($location) > 2) ? ((!empty($location[2])?$location[2]:'')) : (!empty($location[1])?$location[1]:'') ;
							}
							elseif ( 'City' == $oProperty->getID() || 'CurrentCity' == $oProperty->getID())
							{
								$value = (!empty($location[0])) ? $location[0] : '';
							}
						}
						break;
					case 'WorkExperience':
						if ( !empty($oProfile->work))
						{
							$aWork = array();
							foreach ( $oProfile->work as $position)
							{
								$work = '';
								if ( !empty($position['employer']))
								{
									$work .= $position['employer']['name'] ."\r\n";
								}
								if ( !empty($position['location']))
								{
									$work .= $position['location']['name'] ."\r\n";
								}
								if ( !empty($position['start_date']))
								{
									$work .= $position['start_date'] ."\r\n";
								}
								if ( !empty($position['end_date']))
								{
									$work .= $position['end_date'] ."\r\n";
								}

								if ( !empty($work))
								{
									$aWork[] = $work;
								}
							}
							$value = implode("\r\n", $aWork);
						}
						break;
					case 'Education':
						if ( !empty($oProfile->education))
						{
							$aEducation = array();
							
							foreach ( $oProfile->education as $education)
							{
								$sEducation = '';
								
								if (!empty($education['school'])) {
									$sEducation = $education['school']['name'];
								}
								if (!empty($education['year'])) {
									$sEducation .= '('.$education['year']['name'].'):<br/>';
								}
								if (!empty($education['type'])) {
									$sEducation .= $education['type']."\r\n";
								}
									
										
								if (!empty($education['concentration'])) {
									foreach ($education['concentration'] as $concentration) {
										$sEducation .= '<br/>'.$concentration['name']."\r\n";
									}
								}
								if (!empty($education['classes'])) {
									foreach ($education['classes'] as $classes) {
										$sEducation .= '<br/>'.$classes['name'].' : ' . $classes['description'] . "\r\n";
									}
								}
								if (!empty($sEducation)) {
									array_push($aEducation, $sEducation);
								}		
							}
							$value = implode("\r\n", $aEducation);
						}
						break;
					case 'Title':
					case 'TITLE':
						$value = 'My Resume';
						break;
					case 'FirstName':
						if (!empty ($oProfile->first_name))
						{
							$value = $oProfile->first_name;
						}
						break;
					case 'LastName':
						if (!empty($oProfile->last_name))
						{
							$value = $oProfile->last_name;
						}
						break;
					case 'ContactName':
						if (!empty($oProfile->name))
						{
							$value = $oProfile->name;
						}
						break;
					case 'WebSite':
						if (!empty($oProfile->website))
						{
							$value = $oProfile->website;
						}
						break;
					case 'CompanyName':
						if (!empty($oProfile->work[0]['employer']['name']))
						{
							$value = $oProfile->work[0]['employer']['name'];
						}
						break;
					case 'CompanyDescription':
						if (!empty($oProfile->summary))
						{
							$value = $oProfile->summary;
						}
						break;

					case 'email':
						if (!in_array('email', self::$aUserFields) && !empty($oProfile->email))
						{
							$value = $oProfile->email;
						}
						break;
					case 'sendmail':
						$value = false;
						break;
					case 'username':
					case 'password':
						continue(2);
						break;
					default:
						if ( !in_array($oProperty->getID(), self::$aUserFields) && !in_array($oProperty->getID(), self::$aListingFields))
						{
							$object->deleteProperty($oProperty->getID());
							continue(2);
						}
						break;

				}	//	switch ($oProperty->getID())

				if ( $value )
				{
					$object->setPropertyValue($oProperty->getID(), $value);
				}

			}	//	foreach ( $object->getProperties() as $oProperty)

		}	//	if ($oProfile = &self::getProfileObject())

		return $object;

	}	//	public function fillObjectOutSocialData(&$object)
	
	/**
	 *
	 * @param array $request
	 * @return array
	 */
	public function fillRequestOutSocialData(&$request)
	{
		if ($oProfile = &self::getProfileObject())
		{
			require_once('facebook/FacebookFields.php');

			$oFF = new SJB_FacebookFields($oProfile);

			require_once('facebook/FacebookSettings.php');

			$oFF->fillOutListingData_Request($request, $aFieldAssoc);
		}

		return $request;
	}
	
	/**
	 *
	 * @param SJB_Listin $obj
	 * @return SJB_Listing
	 */
	public function fillObjectOutSocialData(&$obj)
	{
		if ($oProfile = &self::getProfileObject())
		{
			require_once('facebook/FacebookFields.php');

			$oFF = new SJB_FacebookFields($oProfile);

			require_once('facebook/FacebookSettings.php');

			$oFF->fillOutListingData_Object($obj, $aFieldAssoc);
		}

		return $obj;
	}
	
	public function getSocialIDByReferenceUID($referenceUID)
	{
		return substr($referenceUID, (strlen(self::getNetwork()) + 1));
	}
	
}	//	class FacebookIntegrationPlugin extends SJB_SocialPlugin