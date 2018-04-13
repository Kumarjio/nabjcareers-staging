<?php
if (!class_exists('SJB_SocialPlugin') || ! in_array('facebook', SJB_SocialPlugin::getAvailablePlugins()) || ! SJB_Settings::getSettingByName('facebook_resumeAutoFillSync'))
{
    echo 'facebook synchronization function is turned off';
    return null;
}
/**
 * get all listings where synchronization is set
 */
$listingsSIDs = SJB_DB::query('SELECT `reference_uid`, `listings`.`sid` as `listingSID`, `listings`.`user_sid` FROM `listings_properties`
	INNER JOIN `listings` ON `object_sid` = `listings`.`sid`
	INNER JOIN `users` ON `listings`.`user_sid` = `users`.`sid`
	WHERE `id`= \'facebook_sync\' AND `value`=1 AND `users`.`reference_uid` IS NOT NULL ORDER BY `user_sid`');


if (!empty($listingsSIDs))
{
	$oFacebookSync = new FacebookSync();

	foreach ($listingsSIDs as $rUid)
	{
		try
		{
			if ( $oFacebookSync->init($rUid['reference_uid'], $rUid['listingSID']) )
			{
				$oFacebookSync->sync();
			}
			else
			{
				throw new Exception('cant connect to facebook  :: ' . $oFacebookSync->getSocialID());
			}
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
}


class FacebookSync
{
	private $profileSID = null;
	private $referenceUID = null;
	private $listingSID = null;
	private $socialID = null;
	private $profileSocialInfo = null;

	/**
	 *
	 * @var FacebookSocialPlugin
	 */
	private $facebookSocialPlugin = null;

	public function getSocialID()
	{
		return $this->socialID;
	}

	
	public function  __construct()
	{
		$this->facebookSocialPlugin = new FacebookSocialPlugin(true);
		$this->facebookSocialPlugin->createFacebookInstance();
		
	}

	
	public function init($referenceUid, $listingSID)
	{
		$this->listingSID = $listingSID;

		if ($referenceUid != $this->referenceUID)
		{
			$this->referenceUID = $referenceUid;
			$this->socialID = $this->facebookSocialPlugin->getSocialIDByReferenceUID($referenceUid);
			$this->getProfileSocialInfo();

			if ($this->profileSocialInfo)
			{
				$accessToken = unserialize($this->profileSocialInfo['access']);
				$this->facebookSocialPlugin->_getProfileInfoByAcessToken($accessToken);
				return $this->facebookSocialPlugin->getProfileObject();
			}
			else
			{
				//throw new Exception('cant take profile social information : '. $this->socialID);
			}
			return false;
		}

		return $this->facebookSocialPlugin->getProfileObject();

	}	//	public function init($referenceUid, $listingSID)

	
	private function getProfileSocialInfo()
	{
		$this->profileSocialInfo = SJB_DB::query('SELECT * FROM `facebook` WHERE `facebook_id` = ?s', $this->socialID);

		if ( !empty($this->profileSocialInfo))
		{
			$this->profileSocialInfo = array_shift($this->profileSocialInfo);
			return true;
		}
		return null;
	}


	public function sync()
	{
		$listingInfo = SJB_ListingManager::getListingInfoBySID($this->listingSID);

		$oCurListing = &SJB_ObjectMother::createListing($listingInfo, SJB_ListingTypeManager::getListingTypeSIDByID('Resume'));

		$this->facebookSocialPlugin->fillObjectOutSocialData($oCurListing);
		
		$oCurListing->setSID($this->listingSID);

		SJB_ListingManager::saveListing($oCurListing);

	}	//	public function sync()
	
}	//	class LinkedinSync