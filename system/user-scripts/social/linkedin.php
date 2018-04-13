<?php

if (!class_exists('SJB_SocialPlugin') || ! in_array('linkedin', SJB_SocialPlugin::getAvailablePlugins()) || ! SJB_Settings::getSettingByName('linkedin_resumeAutoFillSync'))
{
    echo 'linkedin synchronization function is turned off';
    return null;
}

/**
 * get all listings where synchronization is set
 */
$listingsSIDs = SJB_DB::query('SELECT `reference_uid`, `listings`.`sid` as `listingSID`, `listings`.`user_sid` FROM `listings_properties`
	INNER JOIN `listings` ON `object_sid` = `listings`.`sid`
	INNER JOIN `users` ON `listings`.`user_sid` = `users`.`sid`
	WHERE `id`= \'linkedin_sync\' AND `value`=1 AND `users`.`reference_uid` IS NOT NULL ORDER BY `user_sid`');


if (!empty($listingsSIDs))
{
	$oLinkedinSync = new LinkedinSync();

	foreach ($listingsSIDs as $rUid)
	{
		try
		{
			if ( $oLinkedinSync->init($rUid['reference_uid'], $rUid['listingSID']) )
			{
				$oLinkedinSync->sync();
			}
			else
			{
				throw new Exception('cant connect to linkedin  :: ' . $oLinkedinSync->getSocialID());
			}
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
}


class LinkedinSync
{
	private $profileSID = null;
	private $referenceUID = null;
	private $listingSID = null;
	private $socialID = null;
	private $profileSocialInfo = null;

	/**
	 *
	 * @var object SJB_LinkedinSocialPlugin
	 */
	private $linkedinSocialPlugin = null;

	public function getSocialID()
	{
		return $this->socialID;
	}

	
	public function  __construct()
	{
		$this->linkedinSocialPlugin = new LinkedinSocialPlugin(true);
	}

	
	public function init($referenceUid, $listingSID)
	{
		$this->listingSID = $listingSID;

		if ($referenceUid != $this->referenceUID)
		{
			$this->referenceUID = $referenceUid;
			$this->socialID = $this->linkedinSocialPlugin->getSocialIDByReferenceUID($referenceUid);
			$this->getProfileSocialInfo();

			if ($this->profileSocialInfo)
			{
				return $this->linkedinSocialPlugin->initialize(unserialize($this->profileSocialInfo['access']));
			}
			else
			{
				//throw new Exception('cant take profile social information : '. $this->socialID);
			}
		}

		return $this->linkedinSocialPlugin->getProfileObject();

	}	//	public function init($referenceUid, $listingSID)

	
	private function getProfileSocialInfo()
	{
		$this->profileSocialInfo = SJB_DB::query('SELECT * FROM `linkedin` WHERE `linkedin_id` = ?s', $this->socialID);

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

		$this->linkedinSocialPlugin->fillObjectOutSocialData($oCurListing);

		$oCurListing->setSID($this->listingSID);

		SJB_ListingManager::saveListing($oCurListing);

	}	//	public function sync()
	
}	//	class LinkedinSync