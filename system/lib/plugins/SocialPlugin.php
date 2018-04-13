<?php
require_once('plugins/PluginAbstract.php');

//class SJB_SocialPlugin extends SJB_PluginAbstract
class SJB_SocialPlugin
{
	protected static $oProfile = null;
//	protected static $session = null;
//	protected static $network = null;
	protected static $loadedPlugins = array();
	protected static $isSyncAllowed = false;
	/**
	 *
	 * @var FacebookSocialPlugin
	 * @var LinkedinSocialPlugin
	 * 
	 */
	protected static $oSocialPlugin = null;
	protected static $aUserFieldsNotRequiredInRegistration = array('username', 'password');
//	protected static $aUserFields = array('email', 'City', 'State', 'CompanyName');
	protected static $aUserFields = array('email');
//	protected static $aListingFields = array('JobCategory', 'City', 'State');
	protected static $aListingFields = array();

	/**
	 * take data from SocialNetwork server or from local server
	 * @var boolean
	 */
	protected $takeDataFromServer = false;

	function __construct()
	{
		//
	}

	/**
	 * get all available plugins
	 * 
	 * @return array
	 */
	public static function getAvailablePlugins()
	{
		$aNetworks = array();

		foreach ( self::$loadedPlugins as $name => $object )
		{
			array_push($aNetworks, $name);
		}

		return $aNetworks;
	}
	

	public static function loadPlugin($network, $object)
	{
		if (!isset(self::$loadedPlugins[$network]))
		{
			self::$loadedPlugins[$network] = $object;
		}

		$requestedNetwork = SJB_Request::getString('network');
		
		if ( $requestedNetwork === $network )
		{
			self::$oSocialPlugin = &self::getSocialPlugin($network);
			self::$oSocialPlugin->init();
		}
	}

	


	public static function getSocialPlugin($network)
	{
		return (isset(self::$loadedPlugins[$network])) ? self::$loadedPlugins[$network] : false;
	}

	/**
	 *
	 * @return LinkedinSocialPlugin 
	 * @return FacebookSocialPlugin 
	 */
	public static function getActiveSocialPlugin()
	{
		if ( self::$oSocialPlugin )
		{
			return self::$oSocialPlugin;
		}
		return null;
	}

	public static function setNetwork($network)
	{
		self::$network = $network;
	}

	
	protected static function pushLoadedPlugin($network)
	{
		array_push(self::$loadedPlugins, $network);
	}


	public static function getProfileObject()
	{
		return self::$oProfile;
	}


	function pluginSettings()
	{
		return array();
	}


	public function addReferenceDetails(&$user)
	{
		if (self::$oProfile && self::$oSocialPlugin)
		{
			self::definePasswordAndUsernameByEmail($user);

			$user->addProperty(array(
				'id' => 'reference_uid',
				'type' => 'string',
				'value' => self::getNetwork() .'_'. self::$oProfile->id,
				'is_system' => true));
			$user->addProperty(array(
				'id' => 'active',
				'type' => 'boolean',
				'value' => true,
				'is_system' => true));
		}
		return $user;
	}
	

	function ifUserIsRegistered($network, $profileSocialID = null)
	{
		if (self::$oProfile && $network)
		{
			return self::ifUserIsRegisteredByReferenceUid($network . '_' . self::$oProfile->id);
		}
		elseif ( $profileSocialID && $network)
		{
			return self::ifUserIsRegisteredByReferenceUid($network . '_' . $profileSocialID);
		}
		return false;
	}


	function ifUserIsRegisteredByReferenceUid($referenceUid)
	{
		$result = SJB_DB::query('SELECT `sid` FROM `users` WHERE `reference_uid` = ?s', $referenceUid);

		if ( !empty($result))
		{
			$result = array_shift($result);
			return $result['sid'];
		}

		return false;
	}

	
	/**
	 * deletes undesired property fields from SJB_User object
	 * 
	 * function deletes undesired properties from SJB_User details
	 * according to params in SocialPlugin::$aUserFields and 
	 * SocialPlugin::$aListingFields and
	 * fields that are marked as "Required" in admin area
	 * 
	 * but always deletes properties that are in self::$aUserFieldsNotRequiredInRegistration ARRAY
	 * 
	 * @param SJB_User $user
	 * @return SJB_User 
	 */
	public function prepareRegistrationFields(&$user)
	{
		if (self::getProfileObject())
		{
			foreach ( $user->getProperties() as $oProperty)
			{
				if ( (!in_array($oProperty->getID(), self::$aUserFields) && !in_array($oProperty->getID(), self::$aListingFields) && !$oProperty->isRequired()) 
						|| in_array($oProperty->getID(), self::$aUserFieldsNotRequiredInRegistration) )
				{
					$user->deleteProperty($oProperty->getID());
				}

			}	//	foreach ( $user->getProperties() as $oProperty)

		}	//	if ($oProfile = &self::getProfileObject())

		return $user;
	}


	public static function addListingFieldsIntoRegistration($user)
	{
		if (self::getProfileObject())
		{
			if ('JobSeeker' == SJB_Request::getVar('user_group_id'))
			{
				$listing_type_id = 'Resume';
				$listing = &SJB_ObjectMother::createListing($_REQUEST, SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id));

				foreach( self::$aListingFields as $field)
				{
					$user->addPropertyObj($listing->getProperty($field));
				}
			}

		}	//	if ($oProfile = &self::getProfileObject())

		return $user;
	}

	
	public function makeRegistrationFieldsNotRequired(&$user)
	{
		if (self::getProfileObject())
		{
			foreach ($user->getProperties() as $oProperty)
			{
				if ( !in_array($oProperty->getID(), self::$aUserFields) && !in_array($oProperty->getID(), self::$aListingFields))
				{
					if ( $oProperty->isRequired())
					{
						$oProperty->makeNotRequired();
					}
				}

			}	//	foreach ( $user->getProperties() as $oProperty)

		}	//	if ($oProfile = &self::getProfileObject())

		return $user;

	}


	/**
	 *
	 * @param SJB_User $object
	 * @param SJB_Listing $object
	 * @return SJB_User
	 * @return SJB_Listing
	 */
	public function fillObjectOutSocialData(&$object)
	{
		if ( is_object(self::$oSocialPlugin))
		{
			/**
			 * @var FacebookSocialPlugin
			 */
			self::$oSocialPlugin->fillObjectOutSocialData($object);
		}

		return $object;

	}
	
	public function fillRegistrationDataWithUser(&$user)
	{
		if ( is_object(self::$oSocialPlugin))
		{
			self::$oSocialPlugin->fillRegistrationDataWithUser($user);
		}
		
		return $user;
	}

	
	public function definePasswordAndUsernameByEmail(&$user)
	{
		/*
		 * EMAIL
		 */
		$email = $user->getPropertyValue('email');

		if(is_array($email))
		{
			$email = $email['original'];
		}

		$user->setPropertyValue('username', $email);

		/*
		 * PASSWORD
		 */
		$password = substr(md5(microtime(true) . $email), 0, 6);

		$user->setPropertyValue('password', $password);

		return $user;
	}


	/**
	 * sends registration letter to user
	 * 
	 * @param SJB_User $user
	 * @return boolean 
	 */
	public static function sendUserSocialRegistrationLetter($user)
	{
		if (self::$oSocialPlugin)
		{
			$params = array(
				'id' => $user->getSID(),
				'password' => $user->getPropertyValue('password'),
				'email' => $user->getPropertyValue('username'),
				'username' => $user->getPropertyValue('username'));

//			return SJB_Notifications::sendUserSocialRegistrationLetter($params, self::getNetwork());
			require_once 'miscellaneous/Email.php';
			require_once("users/User/UserManager.php");

			if ($user_config_file_path = SJB_System::getSystemSettings('USER_CONFIG_FILE'))
				$user_site_url = SJB_System::getSettingsFromFile($user_config_file_path, 'SITE_URL');
			else
				$user_site_url = SJB_System::getSystemSettings('SITE_URL');

			$email = new SJB_Email($params['email'], '../email_templates/social_registr_email.tpl',
							array('user' => $params,
								'network' => self::getNetwork(),
								'user_site_url' => $user_site_url));

			return $email->send();
		}
	}

	/**
	 *
	 * @param SJB_User $user
	 * @return type 
	 */
	public static function createListing($user)
	{
		if (self::getProfileObject())
		{
			$listing_type_id = 'Job';

			if ('JobSeeker' == SJB_Request::getVar('user_group_id'))
			{
				$listing_type_id = 'Resume';

				/*
				 * membership plan
				 */

				$membership_plan_id = 4;
				$membership_plan = new SJB_MembershipPlan(array('id' => $membership_plan_id));
				if ($membership_plan->getPrice() == 0)
				{
					$contract = new SJB_Contract(array('membership_plan_id' => $membership_plan_id));
					$contract->setUserSID($user->getSID());
					$contract->saveInDB();
				}

				/*
				 * membership plan
				 */

				$listing = &SJB_ObjectMother::createListing($_REQUEST, SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id));

//				$listing->fillPropertiesValuesWithDefaultValues();
				
				$listing->deleteProperty('featured');
				$listing->deleteProperty('priority');
				$listing->deleteProperty('status');
				$listing->deleteProperty('reject_reason');
				$listing->setPropertyValue('Title', 'My First Resume');
				$listing->setUserSID($user->getSID());

				/*
				 * listing package
				 */
				$contracts_id = $user->getContractID();
				$contract_id = array_shift($contracts_id);
				$listing_package_id = 11;
				$contract = new SJB_Contract(array('contract_id' => $contract_id));
				$listing_package_info = $contract->getPackageInfoByPackageID($listing_package_id);
				$listing->setListingPackageInfo($listing_package_info);

				$listing->addProperty(
				array (	'id'		=> 'contract_id',
						'type'		=> 'integer',
						'value'		=> $contract_id,
						'is_system' => true));
				/*
				 * end of "listing package"
				 */
				
//				$listing->setListingPackageInfo();
				$access_type = $listing->getProperty('access_type');
				
				if(empty($access_type->value))
					$listing->setPropertyValue('access_type', 'everyone');

				foreach( self::$aListingFields as $field)
				{
					$listing->deleteProperty($field);
					$listing->addPropertyObj($user->getProperty($field));
				}

				SJB_ListingManager::saveListing($listing);

				if ($listing_package_info['is_featured'])
					SJB_ListingManager::makeFeaturedBySID($listing->getSID());
				if ($listing_package_info['priority_listing'])
					SJB_ListingManager::makePriorityBySID($listing->getSID());
				
				return $listing->getSID();
			}

		}	//	if ($oProfile = &self::getProfileObject())

	}	//	public static function createListing($user)

	
	/**
	 * get current social network
	 * @return string
	 */
	public function getNetwork()
	{
		if (self::$oSocialPlugin)
		{
			return self::$oSocialPlugin->getNetwork();
		}

		return null;
	}
	
	/**
	 * login 
	 * @return boolean 
	 */
	public function login()
	{
		/** @var LinkedinSocialPlugin $oSocialPlugin */
		if (self::$oSocialPlugin) {
//			return self::$oSocialPlugin->login();

			if (!self::$oProfile) {
				return null;
			}

//			if ($userSID = self::$oSocialPlugin->ifUserIsRegistered()) {
			if ($userSID = self::ifUserIsRegistered(self::getNetwork())) {
				$errors = array();
				$user = SJB_UserManager::getObjectBySID($userSID);

				if ($user && SJB_Authorization::login($user->getUserName(), false, false, $errors, '', true)) {
					SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/my-account/');
				}
				return false;
			}
		}

		return null;
	}
	
	
	public function logout()
	{
		unset($_SESSION['sn']);
		
		if (self::$oSocialPlugin)
		{
			return self::$oSocialPlugin->logout();
		}

		return null;
	}


	public static function getProfilePublicUrlByProfileID($profileID)
	{
		if ( $profileID )
		{
			$socialProfileID = self::getProfileSocialID($profileID);

			if ( $socialProfileID )
			{
				$aSoc = explode('linkedin_', $socialProfileID);
				if (is_array($aSoc))
				{
					return LinkedinSocialPlugin::getProfilePublicUrlByProfileLinkedinID($aSoc[1]);
				}
			}
		}

		return null;
	}


	public static function getProfileSocialID($profileSID)
	{
		$result = SJB_DB::query('SELECT `reference_uid` from `users` where `sid` = ?n', $profileSID);
		if (!empty($result))
		{
			$result = array_shift($result);
			
			return $result['reference_uid'];
		}
		return null;
	}


	public function fillRequestOutSocialData(&$_request)
	{
//		if (self::$oSocialPlugin && self::$oSocialPlugin instanceof LinkedinSocialPlugin)
		if (self::$oSocialPlugin)
		{
			self::$oSocialPlugin->fillRequestOutSocialData($_request);
		}
		unset($_request['autofill']);
	}


	public function getProfileSocialAutoFillData($profileSID)
	{
		$aReturn = array('allow' => false);

		if (self::getProfileSocialID($profileSID))
		{
			$aReturn['allow'] = true;
			if ( self::$oSocialPlugin && self::getProfileObject())
			{
				$aReturn['logged'] = true;
				$aReturn['network'] = self::$oSocialPlugin->getNetwork();
			}
		}

		return $aReturn;
		
	}	//	public function getProfileSocialAutoFillData($profileSID)


	public static function postRegistration()
	{
		if (self::$oSocialPlugin && self::$oProfile)
		{
			self::$oSocialPlugin->saveProfileSystemInfo();
		}

	}	//	public static function postRegistration()


	public static function addSyncDetails(&$listing, $network, $value = 0)
	{
		$listing->addProperty(
			array(
				'id' => $network . '_sync',
				'caption' => 'Periodically synchronize my resume with my ' . $network . ' profile',
				'type' => 'boolean',
				'is_required' => false,
				'is_system' => false,
				'value' => $value,
			)
		);
	}	//	public static function addSyncDetails($userSID, &$listing, $value = false)
	
	
	public static function setUserSocialIDByUserSID($userSID, $socialID, $network = '')
	{
		if ( $network = self::getNetwork())
		{
			return SJB_DB::query('UPDATE `users` SET `reference_uid` = ?s WHERE `sid` = ?n', $network . '_' . $socialID, $userSID);
		}
	}
	
	
	public function autofillListing($aAutofillData)
	{
		if (	self::getNetwork()
				&& SJB_Settings::getSettingByName(self::getNetwork() . '_resumeAutoFillSync')
				&& ! $aAutofillData['formSubmitted']
				&& 'Resume' == $aAutofillData['listingTypeID']
				&& isset($_REQUEST['autofill'])
		):
			self::$isSyncAllowed = true;
			self::fillRequestOutSocialData($_REQUEST);
		endif;
	}
	
	
	public function autofillListingForm($aAutofillData)
	{
		if (self::getNetwork()
			&& SJB_Settings::getSettingByName(self::getNetwork() . '_resumeAutoFillSync')
			&& 'Resume' == $aAutofillData['listingTypeID']
		):
			/** @var $aAutofillData['tp'] SJB_TemplateProcessor */
			$aAutofillData['tp']->assign('socialAutoFillData', self::getProfileSocialAutoFillData($aAutofillData['userSID']));
		endif;
	}
	
	/**
	 *
	 * @param array $aAutofillData 
	 */
	public function autofillListingFields($aAutofillData)
	{
		$network = self::getNetwork();
		
		if ($network
			&& SJB_Settings::getSettingByName($network . '_resumeAutoFillSync')
			&& 'Resume' == $aAutofillData['listingTypeID']
			&& self::getProfileSocialID($aAutofillData['userSID'])
		):
			/**
			 * @var $aAutofillData['oListing'] SJB_Listing
			 */
			$propertyName = $network . '_sync';
			
			$syncWLinkedin = SJB_Request::getVar($propertyName);
			
			$syncOrNot = $syncWLinkedin ? $syncWLinkedin : (!empty($aAutofillData['listing_info'][$propertyName]) ? $aAutofillData['listing_info'][$propertyName] : 0);
			self::addSyncDetails($aAutofillData['oListing'], $network, $syncOrNot);
		endif;
		
	}
	
	/**
	 *
	 * @param array $aAutofillData 
	 */
	public function autofillListingFieldsOnPostingPages($aAutofillData)
	{
		$network = self::getNetwork();
		$propertyName = $network . '_sync';

		if ($network
//			&& SJB_Settings::getSettingByName($network . '_resumeAutoFillSync')
//			&& 'Resume' == $aAutofillData['listingTypeID']
//			&& self::getProfileSocialID($aAutofillData['userSID'])
			&& ! empty($aAutofillData['form_fields'][$propertyName])
			&& ! empty($aAutofillData['pages'])
		):
			$page = array_shift($aAutofillData['pages']);
			$aAutofillData['listing_fields_by_page'][$page['page_name']][$propertyName] = $aAutofillData['form_fields'][$propertyName];
			
		endif;
		
	}
	
	
	public function preparePluginsThatAreAvailableForRegistration(&$aAvailablePlugins, $userGroupID = null)
	{
		$aAvailableUserGroups = SJB_UserGroupManager::getAllUserGroupsInfo();

		foreach ($aAvailablePlugins as $socialKey => $socNetwork)
		{
			$aAvailableUserGroupsTemp = $aAvailableUserGroups;
			
			$aResolvedUserGroups = self::getResolvedUserGroupsByNetwork($socNetwork);
			
			if (empty($aResolvedUserGroups))
			{
				unset($aAvailablePlugins[$socialKey]);
				continue;
			}
			
			foreach( $aAvailableUserGroupsTemp as $key => $aUserGroupInfo)
			{
				if ( !in_array($aUserGroupInfo['sid'], $aResolvedUserGroups) || ($userGroupID && $userGroupID !== $aUserGroupInfo['id']))
				{
					unset($aAvailableUserGroupsTemp[$key]);
				}
			}

			if (empty($aAvailableUserGroupsTemp))
			{
				unset($aAvailablePlugins[$socialKey]);
			}
			
		}	//		foreach ($aAvailablePlugins as $socNetwork)

	}
	
	public function getResolvedUserGroupsByNetwork($socNetwork = null)
	{
		if (!$socNetwork)
		{
			$socNetwork = self::getNetwork();
		}

		return explode(',', SJB_System::getSettingByName($socNetwork . '_userGroup'));
	}
	
	public function ifRegistrationIsAllowedByUserGroupSID($userGroupSID)
	{
		return in_array($userGroupSID, SJB_SocialPlugin::getResolvedUserGroupsByNetwork());
	}



	/**
	 * redirects user to "/registration-social/" page
	 */
	public function redirectToRegistrationSocialPage()
	{
		$userGroupIDPart = '';

		if (!empty($_SESSION['userGroupID'])) {
			$userGroupIDPart = '?user_group_id=' . $_SESSION['userGroupID'];
			unset($_SESSION['userGroupID']);
		}
		if (empty($userGroupIDPart) && $userGroupID = SJB_Request::getVar('user_group_id')) {
			$userGroupIDPart = '?user_group_id=' . $userGroupID;
		}

		SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/registration-social/' . $userGroupIDPart);
	}

	protected function cleanSessionData($network)
	{
		if (!empty($_SESSION['sn']['authorized']) && $_SESSION['sn']['network'] !== $network) {
			SJB_Session::unsetValue('sn');
		}
	}



	protected function flagSocialPluginInSession($network)
	{
		SJB_Session::setValue('sn', array('authorized' => true, 'network' => $network));
	}


}



//	class SJB_SocialPlugin extends SJB_PluginAbstract