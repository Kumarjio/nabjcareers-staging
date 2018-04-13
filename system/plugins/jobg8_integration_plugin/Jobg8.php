<?php

require_once 'classifieds/Listing/ListingManager.php';

class UploadAdvertsFile
{

	private $jobBoardID;
	private $password;
	private $fileContent = "";
	
	public function setJobBoardID($id)
	{
		$this->jobBoardID = $id;
	}
	
	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function setFileContent($content)
	{
		$this->fileContent = $content;
	}
}

class GetFileResponse
{

	private $jobBoardID;
	private $password;
	public $fileName = '';
	
	public function setJobBoardID($id)
	{
		$this->jobBoardID = $id;
	}
	
	public function setPassword($password)
	{
		$this->password = $password;
	}
	
	function setFileName($fileName)
	{
		$this->fileName = $fileName;
	}
}



class Jobg8
{
	/**
	 * Filter by CompanyName
	 * 
	 * If 'true' or '1' - filter send to JobG8 listings by CompanyName
	 *
	 * @var integer|boolean
	 */
	public static $filterByCompany = false;
	
	/**
	 * List of companies to filter by CompanyName
	 *
	 * @var array
	 */
	public static $companiesList = array();
	
	/**
	 * Filter listings By Membership Plan ID
	 *
	 * @var integer|boolean
	 */
	public static $filterByPlan = false;
	
	/**
	 * List of membership plan IDs to filter
	 *
	 * @var array
	 */
	public static $plansList = array();
	
	/**
	 * Filter listings By Job Category
	 *
	 * @var integer|boolean
	 */
	public static $filterByCategory = false;
	
	/**
	 * List of job categories to filter
	 *
	 * @var array
	 */
	public static $categoryList = array();
	
	
	
	/**
	 * Get XML for 'post' action for listings sids
	 *
	 * @param array $listingsSids
	 * @param TemplateProcessor $tp
	 * @return string
	 */
	public static function getPostListingsXml($listingsSids)
	{
		$xml= '';
		foreach ($listingsSids as $sid) {
			$jobReference = JobG8IntegrationPlugin::getJobReferenceByListingSID($sid);
			$listingObj   = SJB_ListingManager::getObjectBySID($sid);
			if (empty($listingObj)) {
				continue;
			}
			if (empty($listingObj->job_reference)) {
				$listingObj->job_reference = $listingObj->getSID();
			}
			
			$listing = SJB_ListingManager::createTemplateStructureForListing($listingObj);
			
			
			$allowToSend = null;
			
			// check filter by company
			if (self::$filterByCompany)
				$allowToSend = in_array($listing['user']['CompanyName'], self::$companiesList);
			
			
			// check filter by plan
			if (self::$filterByPlan) {
				// if not allowed by previous filter - check this filter
				if ($allowToSend !== true) {
					$listingPackageID = $listing['package']['id'];
					$packageInfo      = SJB_PackagesManager::getPackageInfoByPackageID($listingPackageID);
					$allowToSend = in_array($packageInfo['membership_plan_id'], self::$plansList);
				}
			}
			
			
			// check filter by category
			$inCategory = false;
			if (self::$filterByCategory) {
				// if not allowed by previous filter - check this filter
				if ($allowToSend !== true) {
					$listingCategories = explode(',', $listing['JobCategory']);
					foreach ($listingCategories as $category) {
						if (in_array($category, self::$categoryList)) {
							$inCategory = true;
							break;
						}
					}
					
					if (!$inCategory) {
						$allowToSend = false;
					} else {
						$allowToSend = true;
					}
				}
			}
			
			
			// Check value of $allowToSend.
			// if true - allowed by filters,
			// if false - denied by filters
			// if null - no filters set (allowed)
			if ($allowToSend === false) {
				continue;
			}
			

			
			$xml .= "
			<job action=\"post\">
				<id>{$listing['id']}</id>
				<title><![CDATA[{$listing['Title']}]]></title>
				<date><![CDATA[{$listing['activation_date']}]]></date>
				<url><![CDATA[" . SJB_System::getSystemSettings('SITE_URL') . "/display-job/{$listing['id']}/]]></url>
				<company><![CDATA[{$listing['user']['CompanyName']}]]></company>
			
				<description><![CDATA[{$listing['JobDescription']}]]></description>
			
				<city><![CDATA[{$listing['City']}]]></city>
				<state><![CDATA[{$listing['State']}]]></state>
				<country><![CDATA[{$listing['Country']}]]></country>
				<zipcode><![CDATA[{$listing['ZipCode']}]]></zipcode>
			
				<salaryAmount><![CDATA[{$listing['Salary']['value']}]]></salaryAmount>
				<salaryCurrency><![CDATA[{$listing['Salary']['currency_code']}]]></salaryCurrency>
				<salaryType><![CDATA[{$listing['SalaryType']}]]></salaryType>
			
				<jobtype>";
				
				if (!empty($listing['EmploymentType'])) {
					if (!is_array($listing['EmploymentType'])) {
						$res = explode(',', $listing['EmploymentType']);
						if (count($res) > 1) {
							$listing['EmploymentType'] = $res;
						}
					}
					if (is_array($listing['EmploymentType'])) {
						$i = 1;
						foreach ($listing['EmploymentType'] as $elem) {
							$xml .= "<elem name=\"elem_{$i}\"><![CDATA[{$elem}]]></elem>";
							$i++;
						}
					} else {
						$xml .= "<elem name=\"elem_1\"><![CDATA[{$listing['EmploymentType']}]]></elem>";
					}
				}
				
				$xml .= "</jobtype>
				
				<jobCategory>";
				
				if (!empty($listing['JobCategory'])) {
					if (!is_array($listing['JobCategory'])) {
						$res = explode(',', $listing['JobCategory']);
						if (count($res) > 1) {
							$listing['JobCategory'] = $res;
						}
					}
					if (is_array($listing['JobCategory'])) {
						$i = 1;
						foreach ($listing['JobCategory'] as $elem) {
							$xml .= "<elem name=\"elem_{$i}\"><![CDATA[{$elem}]]></elem>";
						}
					} else {
						$xml .= "<elem name=\"elem_1\"><![CDATA[{$listing['JobCategory']}]]></elem>";
					}
				}
				
				$xml .= "</jobCategory>
			
				<video><![CDATA[{$listing['video']['file_url']}]]></video>
			
				<user>
					<id>{$listing['user']['id']}</id>
					<name><![CDATA[{$listing['user']['username']}]]></name>
					<email><![CDATA[{$listing['user']['email']}]]></email>
					<website><![CDATA[{$listing['user']['WebSite']}]]></website>
				</user>
			</job>";
		}
		return $xml;
	}
	
	
	
	/**
	 * Get XML for 'amend' action for listings sids
	 *
	 * @param array $listingsSids
	 * @return string
	 */
	public static function getAmendListingsXml($listingsSids)
	{
		/*
		Unabled fields to Amend
		- Sender Reference
		- Display Reference
		- Classification
		- Sub Classification
		- Buy Price
		- Application Template
		- Filter Template
		- Number of Applications
		- Country (The location details can be updated except for the Country)
		 */
		$xml= '';
		foreach ($listingsSids as $sid) {
			$jobReference = JobG8IntegrationPlugin::getJobReferenceByListingSID($sid);
			$listingObj   = SJB_ListingManager::getObjectBySID($sid);
			if (empty($listingObj)) {
				continue;
			}
			if (empty($listingObj->job_reference)) {
				$listingObj->job_reference = $listingObj->getSID();
			}
			
			$listing = SJB_ListingManager::createTemplateStructureForListing($listingObj);
			$allowToSend = null;
			
			// check filter by company
			if (self::$filterByCompany)
				$allowToSend = in_array($listing['user']['CompanyName'], self::$companiesList);
			
			// check filter by plan
			if (self::$filterByPlan) {
				// if not allowed by previous filter - check this filter
				if ($allowToSend !== true) {
					$listingPackageID = $listing['package']['id'];
					$packageInfo      = SJB_PackagesManager::getPackageInfoByPackageID($listingPackageID);
					$allowToSend = in_array($packageInfo['membership_plan_id'], self::$plansList);
				}
			}
			
			
			// check filter by category
			$inCategory = false;
			if (self::$filterByCategory) {
				// if not allowed by previous filter - check this filter
				if ($allowToSend !== true) {
					$listingCategories = explode(',', $listing['JobCategory']);
					foreach ($listingCategories as $category) {
						if (in_array($category, self::$categoryList)) {
							$inCategory = true;
							break;
						}
					}
					
					if (!$inCategory) {
						$allowToSend = false;
					} else {
						$allowToSend = true;
					}
				}
			}
			
			
			// Check value of $allowToSend.
			// if true - allowed by filters,
			// if false - denied by filters
			// if null - no filters set (allowed)
			if ($allowToSend === false) {
				continue;
			}
			
			
			
			
			$xml .= "
			<job action=\"amend\">
				<id>{$listing['id']}</id>
				<title><![CDATA[{$listing['Title']}]]></title>
				<date><![CDATA[{$listing['activation_date']}]]></date>
				<url><![CDATA[" . SJB_System::getSystemSettings('SITE_URL') . "/display-job/{$listing['id']}/]]></url>
				<company><![CDATA[{$listing['user']['CompanyName']}]]></company>
			
				<description><![CDATA[{$listing['JobDescription']}]]></description>
			
				<city><![CDATA[{$listing['City']}]]></city>
				<state><![CDATA[{$listing['State']}]]></state>
				<zipcode><![CDATA[{$listing['ZipCode']}]]></zipcode>
			
				<salaryAmount><![CDATA[{$listing['Salary']['value']}]]></salaryAmount>
				<salaryCurrency><![CDATA[{$listing['Salary']['currency_code']}]]></salaryCurrency>
				<salaryType><![CDATA[{$listing['SalaryType']}]]></salaryType>
			
				<jobtype>";
				
				if (!empty($listing['EmploymentType'])) {
					if (!is_array($listing['EmploymentType'])) {
						$res = explode(',', $listing['EmploymentType']);
						if (count($res) > 1) {
							$listing['EmploymentType'] = $res;
						}
					}
					if (is_array($listing['EmploymentType'])) {
						$i = 1;
						foreach ($listing['EmploymentType'] as $elem) {
							$xml .= "<elem name=\"elem_{$i}\"><![CDATA[{$elem}]]></elem>";
							$i++;
						}
					} else {
						$xml .= "<elem name=\"elem_1\"><![CDATA[{$listing['EmploymentType']}]]></elem>";
					}
				}
				
				$xml .= "</jobtype>
			
				<video><![CDATA[{$listing['video']['file_url']}]]></video>
			
				<user>
					<id>{$listing['user']['id']}</id>
					<name><![CDATA[{$listing['user']['username']}]]></name>
					<email><![CDATA[{$listing['user']['email']}]]></email>
					<website><![CDATA[{$listing['user']['WebSite']}]]></website>
				</user>
			</job>";
		}
		return $xml;
	}
	
	
	
	/**
	 * Get XML for 'delete' action for listings sids
	 *
	 * @param array $listingsSids
	 * @return string
	 */
	public static function getDeleteListingsXml($listingsSids)
	{
		$xml = '';
		foreach ($listingsSids as $sid) {
			$jobReference = JobG8IntegrationPlugin::getJobReferenceByListingSID($sid);
			// if it is JobG8 listing - skip it.
			if (!empty($jobReference) && $jobReference != $sid) {
				break;
			}
			$xml .= "\n\t<job action=\"delete\"><id>{$sid}</id></job>\n";
		}
		return $xml;
	}
	
	
	/**
	 * Remove listings from jobg8 queue table
	 *
	 * @param array|integer $listingsSids
	 */
	public static function removeListingsFromJobg8Table($listingsSids)
	{
		if (is_array($listingsSids)) {
			SJB_DB::query("DELETE FROM `listings_to_jobg8` WHERE `listing_sid` IN (?l)", $listingsSids);
		} else if (is_numeric($listingsSids)) {
			SJB_DB::query("DELETE FROM `listings_to_jobg8` WHERE `listing_sid` = ?n", $listingsSids);
		}
	}
	
}