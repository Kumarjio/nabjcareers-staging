<?php

// example ssh-key ([length] [modulus] [key])
// 2048 65537 22442015378622330147703430717707554878761876163659762121453696328810847513688836851052192212612017656489563887089352281582202261915211582995212485363517097143817647909041057374387791355077014153925864678953029079466244344762506301713460658847327189275108650557158836409307042260183481406066860839901790534757087540701065757402507689816972901215183849292158852019230153625006159015085007524530437170548903804313471315386290109179369052668989735284634552426456596511520079196795903258548072347461491508475481476560754904629064211682117230668891222851440715047615321869421531822145706753882546261318057521359980845042679


/**
 * Integration SJB to JobG8 plugin class
 * 
 * May get some simple test params:
 * 
 * /jobg8_outgoing/:
 * test    - if value is not empty, set test mode on
 * listing - ID of listing to test send to jobg8
 * action  - type of test action to send to jobg8 (type of XML-request. Possible values: post, amend, delete)
 * 
 * http://example.site.url/jobg8_outgoing/?test=1&listing=40005&action=post
 * will be generate for listing 40005 "post" XML-request and send it to JobG8, use plugin settings
 * 
 * 
 * /jobg8_incoming/:
 * test   - if value is not empty, set test mode on
 * action - type of test data to post on SJB JobBoard (emulation of JobG8 incoming data)
 * 
 * http://example.site.url/jobg8_incoming/?test=1&action=post
 * 
 * will be generate incoming data for "post" action, and post it to SJB Job Board
 * 
 */

require_once("plugins/PluginAbstract.php");


class JobG8IntegrationPlugin extends SJB_PluginAbstract 
{
	/**
	 * Number of special listing package for jobg8 listings
	 * Uses in postAdvert, amendAdvert and deleteAdvert methods
	 * 
	 * @var integer
	 */
	public static $jobg8PackageID;
	
	
	/**
	 * Setting for ADHOC mode of P4P integration
	 * 
	 * Used in user-scripts/miscellaneous/jobg8_p4p.php
	 *
	 * @var boolean
	 */
	private static $adhocMode = true;
	
	
	
	private static $log_incoming_requests  = false;
	private static $log_responses_to_jobg8 = false;
	private static $log_outgoing_requests  = false;
	
	/**
	 * log filename for incoming requests from JobG8
	 *
	 * @var string
	 */
	private static $incomingLogFilename = 'jobg8_incoming.log';
	/**
	 * log filename for responses of incoming requests from JobG8
	 *
	 * @var string
	 */
	private static $responseLogFilename = 'jobg8_response.log';
	/**
	 * log filename for outgoing requests from SJB to JobG8
	 *
	 * @var string
	 */
	private static $outgoingLogFilename = 'jobg8_outgoing.log';
	
	
	
	/**
	 * Initialization of plugin functions.
	 * 
	 * This will add new functions in modules. After this, new functions may be
	 * called via http://site.url/system/<module_name>/<function_name>/
	 *
	 */
	public static function init() {
		$moduleManager = SJB_System::getModuleManager();
		
		$miscellaneous = $moduleManager->modules['miscellaneous']['functions'];
		$newMiscellaneous = array(
			'jobg8_outgoing' => array (
				'display_name'	=> 'Jobg8 Outgoing',
				'script'		=> 'jobg8_outgoing.php',
				'type'			=> 'user',
				'access_type'	=> array('user'),
			),
			'jobg8_incoming' => array (
				'display_name'	=> 'Jobg8 Incoming',
				'script'		=> 'jobg8_incoming.php',
				'type'			=> 'user',
				'access_type'	=> array('user'),
			),
			'jobg8_p4p' => array (
				'display_name'	=> 'Jobg8 P4P',
				'script'		=> 'jobg8_p4p.php',
				'type'			=> 'user',
				'access_type'	=> array('user'),
			),
		);
		$allFunctions = array_merge( $miscellaneous, $newMiscellaneous );
		$moduleManager->modules['miscellaneous']['functions'] = $allFunctions;
		
		
		$classifieds = $moduleManager->modules['classifieds']['functions'];
		$newClassifieds = array(
			'apply_now_jobg8' => array (
				'display_name'	=> 'Apply Now',
				'script'		=> 'apply_now_jobg8.php',
				'type'			=> 'user',
				'access_type'	=> array('user'),
			),
			'select_posting_type' => array (
				'display_name'	=> 'Select Posting Type',
				'script'		=> 'select_posting_type.php',
				'type'			=> 'user',
				'access_type'	=> array('user'),
			),
		);
		$allFunctions = array_merge( $classifieds, $newClassifieds );
		$moduleManager->modules['classifieds']['functions'] = $allFunctions;
	}
	
	
	/**
	 * Get plugin settings
	 *
	 * @return array
	 */
	public function pluginSettings ()
	{
		// Membership plans list
		$allPlansList    = array();
		$membershipPlans = SJB_MembershipPlanManager::getAllMembershipPlansInfo();
		foreach ($membershipPlans as $plan) {
			$allPlansList[] = array(
				'id'      => $plan['id'],
				'caption' => $plan['name'],
			);
		}
		
		// job categories list
		$jobCategoryInfo   = SJB_ListingFieldDBManager::getListingFieldInfoByID('JobCategory');
		$jobCategoriesList = SJB_ListingFieldDBManager::getListValuesBySID($jobCategoryInfo['sid']);
		
		
		return array(
			array (
				'id'			=> 'jobg8_jobboard_id',
				'caption'		=> 'Your Jobboard ID for Job Source (JobG8)',
				'type'			=> 'string',
				'comment'		=> '* needed for JS',
				'length'		=> '5',
			),
			array (
				'id'			=> 'jobg8_jobboard_id_p4p',
				'caption'		=> 'Your Jobboard ID for P4P (JobG8)',
				'type'			=> 'string',
				'comment'		=> '* needed for P4P',
				'length'		=> '5',
			),
			array (
				'id'			=> 'jobg8_cid',
				'caption'		=> 'Your Jobg8 Account Number (JobG8)',
				'comment'		=> '* for P4P only',
				'type'			=> 'string',
				'length'		=> '6',
			),
			array (
				'id'			=> 'jobg8_password',
				'caption'		=> 'Your Jobboard Password (JobG8)',
				'comment'		=> '* JS only',
				'type'			=> 'string',
				'length'		=> '50',
			),
			array (
				'id'			=> 'jobg8_p4p_url',
				'caption'		=> 'Jobg8 P4P URL (JobG8)',
				'comment'		=> '*created with the RSA key, ID and account number from jobg8',
				'type'			=> 'string',
				'length'		=> '255',
			),
			array (
				'id'			=> 'jobg8_wsdl_url',
				'caption'		=> 'Jobg8 WSDL URL (JobG8)',
				'comment'		=> '* webservice url from Jobg8',
				'type'			=> 'string',
				'length'		=> '255',
			),
			array(
				'id'			=> '',
				'type'			=> 'separator',
				'caption'		=> '',
			),
			
			array (
				'id'			=> 'jobg8_package_ID',
				'caption'		=> 'Package ID for Jobg8 Listings',
				'type'			=> 'string',
			),
			
			array(
				'type'			=> 'separator',
				'caption'		=> 'Job Source Filters',
				'comment'		=> '<br />Please select the jobs you would like to distribute to jobg8 for buying qualified applications.  
<br />PLEASE NOTE: If you do not check any of the options, all jobs will be sent with the Pay Per Posting model.
<br />PLEASE NOTE: These filters operate separately, not together.
<br /><span style="color: #f00">For example, if you enter Company 1 and select the plan for Employers Plan (Enhanced Subscription), this will send all jobs from Company 1 AND all jobs from any companies with this employer plan to Jobg8.</span>'
			),
			
			// FILTER BY COMPANY NAME SETTINGS
			array (
				'id'			=> 'jobg8_company_name_filter',
				'caption'		=> 'To distribute jobs and buy applications for certain customers only, please check this box and enter the company names (must be the same format as their name in the User Profile):',
				'type'			=> 'boolean',
				'order'			=> 10,
			),
			array (
				'id'			=> 'jobg8_company_list',
				'caption'		=> '',
				'type'			=> 'text',
				'order'			=> 11,
			),
			
			// FILTER BY MEMBERSHIP PLANS
			array (
				'id'			=> 'jobg8_membership_plan_filter',
				'caption'		=> 'To distribute jobs and buy applications for customers with certain plans, please check this box and select the plan:',
				'type'			=> 'boolean',
				'order'			=> 12,
			),
			array (
				'id'			=> 'jobg8_membership_plan_list',
				'caption'		=> '',
				'type'			=> 'multilist',
				'list_values'   => $allPlansList,
				'order'			=> 13,
				'comment'       => 'Please use the "Control" key to choose two or more options.',
			),
			
			// FILTER BY JOB CATEGORY
			array (
				'id'			=> 'jobg8_job_category_filter',
				'caption'		=> 'To distribute jobs and buy applications for postings within certain Categories, please check this box and select the Industries:',
				'type'			=> 'boolean',
				'order'			=> 14,
			),
			array (
				'id'			=> 'jobg8_job_category_list',
				'caption'		=> '',
				'type'			=> 'multilist',
				'list_values'   => $jobCategoriesList,
				'order'			=> 15,
				'comment'       => 'Please use the "Control" key to choose two or more options.',
			),
		);
	}
	
	
	/**
	 * Get SSH RSA Key value.
	 * Key must be at pluginFolder/ssh_key.txt file
	 *
	 */
	public static function getRsaKey()
	{
		$dirName  = dirname(__FILE__);
		$filePath = $dirName . '/ssh.key';
		if (file_exists($filePath)) {
			$key = file_get_contents($filePath);
			return $key;
		}
		return null;
	}
	
	
	public static function getAdhocMode()
	{
		return self::$adhocMode;
	}
	
	
	
	/**
	 * Add listing SID in 'post' queue to send to JobG8
	 * 
	 * Check listing - if it is not JobG8 listing, than add it to send queue.
	 *
	 * @param integer $listingSID
	 * @return boolean
	 */
	public static function addListingToJobg8($listingSID)
	{
		$jobReference = self::getJobReferenceByListingSID($listingSID);
		// if it's jobg8 listing - not send it to jobg8
		if (!empty($jobReference) && $jobReference != $listingSID) {
			return;
		}
		
		$listingInfo   = SJB_ListingManager::getListingInfoBySID($listingSID);
		$listingTypeID = SJB_ListingTypeManager::getListingTypeIDBySID($listingInfo['listing_type_sid']);
		
		if ($listingTypeID != 'Job') {
			return false;
		}
		return SJB_DB::query("INSERT INTO `listings_to_jobg8` SET `listing_sid` = ?n, `action` = 'post'", $listingSID);
	}
	
	
	/**
	 * Add listing SID in 'amend' queue to send to JobG8
	 *
	 * @param integer $listingSID
	 * @return boolean
	 */
	public static function amendListingToJobg8($listingSID)
	{
		$jobReference = self::getJobReferenceByListingSID($listingSID);
		// if it's jobg8 listing - not send it to jobg8
		if (!empty($jobReference) && $jobReference != $listingSID) {
			return;
		}
		
		$listingInfo   = SJB_ListingManager::getListingInfoBySID($listingSID);
		$listingTypeID = SJB_ListingTypeManager::getListingTypeIDBySID($listingInfo['listing_type_sid']);
		
		if ($listingTypeID != 'Job') {
			return false;
		}
		return SJB_DB::query("INSERT INTO `listings_to_jobg8` SET `listing_sid` = ?n, `action` = 'amend'", $listingSID);
	}
	

	/**
	 * Add listing SID in 'delete' queue to send to JobG8
	 * 
	 * Check previous records for current listing. If have it, and action is 'post',
	 * just delete it from table (not send to JobG8), and if action is 'amend' - 
	 * change it to 'delete' action.
	 * If not set actions for current listing - add action 'delete' to table.
	 *
	 * @param integer $listingSID
	 * @return boolean
	 */
	public static function deleteListingFromJobg8($listingSID)
	{
		$jobReference = self::getJobReferenceByListingSID($listingSID);
		// if its's 'Jobg8' job - ignore jobg8 delete and return
		if (!empty($jobReference) && $jobReference != $listingSID) {
			return;
		}
		
		$listingInfo   = SJB_ListingManager::getListingInfoBySID($listingSID);
		$listingTypeID = SJB_ListingTypeManager::getListingTypeIDBySID($listingInfo['listing_type_sid']);
		
		if ($listingTypeID != 'Job') {
			return false;
		}
		
		$result = SJB_DB::query("SELECT * FROM `listings_to_jobg8` WHERE `listing_sid` = ?n LIMIT 1", $listingSID);
		if (!empty($result)) {
			if ($result[0]['action'] == 'post') {
				return SJB_DB::query("DELETE FROM `listings_to_jobg8` WHERE `sid` = ?n", $result[0]['sid']);
			} else {
				return SJB_DB::query("UPDATE `listings_to_jobg8` SET `action` = 'delete' WHERE `sid` = ?n", $result[0]['sid']);
			}
		}
		return SJB_DB::query("INSERT INTO `listings_to_jobg8` SET `listing_sid` = ?n, `action` = 'delete'", $listingSID);
	}
	
	
	/**
	 * Set job_reference value of listing
	 *
	 * @param integer $listingSID
	 * @param string $jobReference
	 */
	public static function setListingJobReference($listingSID, $jobReference = false)
	{
		if ($jobReference === false) {
			$jobReference = $listingSID;
		}
		$result = SJB_DB::query("UPDATE `listings` SET `job_reference`=?s WHERE `sid`=?n", $jobReference, $listingSID);
	}
	
	
	/**
	 * Get job_reference value of listing
	 *
	 * @param integer $listingSID
	 * @return array|boolean
	 */
	public static function getJobReferenceByListingSID($listingSID)
	{
		$result = array_pop( SJB_DB::query("SELECT `job_reference` FROM `listings` WHERE `sid` = ?n LIMIT 1", $listingSID) );
		return $result['job_reference'];
	}
	
	
	/**
	 * Get listing SID by job_reference value
	 *
	 * @param string $jobReference
	 * @return integer
	 */
	public static function getListingSIDByJobReference($jobReference)
	{
		$result = array_pop( SJB_DB::query("SELECT `sid` FROM `listings` WHERE `job_reference`=?s LIMIT 1", $jobReference) );
		return $result['sid'];
	}
	
	
	/**
	 * Generate outgoing XML and send it to JobG8
	 *
	 */
	public static function sendJobsToJobG8()
	{
		error_log('jobg8_outgoing_start');
		
		/**
		 * Array of listings and actions. Array format:
		 * 
		 * $listingsToSend = array(
		 *	 array('listing_sid'=>47756, 'action' => 'post'),
		 *	 array('listing_sid'=>47753, 'action' => 'amend'),
		 *	 array('listing_sid'=>47748, 'action' => 'delete'),
		 * );
		 */
		$listingsToSend = SJB_DB::query("SELECT * FROM `listings_to_jobg8`");
		
		
		
		// We can pass some params to test outgoing
		// test = 1 - test mode is on
		// listing = 48005 - listing ID to test send
		// action = post - type of xml-block action (post, amend, delete)
		if ($test = SJB_Request::getVar('test', false)) {
			$listingSid = SJB_Request::getInt('listing');
			$testAction = SJB_Request::getString('action');
			$listingsToSend = array(
				array('listing_sid' => $listingSid, 'action' => $testAction),
			);
		}
		
		
		$postListings   = array();
		$amendListings  = array();
		$deleteListings = array();
		
		$listingsSids   = array();
		
		foreach ($listingsToSend as $listing) {
			switch ($listing['action']) {
				case 'post':
					$listingsSids[] = $postListings[] = $listing['listing_sid'];
					break;
				case 'amend':
					$listingsSids[] = $amendListings[] = $listing['listing_sid'];
					break;
				case 'delete':
					$listingsSids[] = $deleteListings[] = $listing['listing_sid'];
					break;
			}
		}
		
		
		
		///////////////////// SET FILTERS
		
		// check filter by companies settings
		$filterByCompany = SJB_System::getSettingByName('jobg8_company_name_filter');
		$companiesList   = array();
		if ($filterByCompany) {
			$list = SJB_System::getSettingByName('jobg8_company_list');
			$list = str_replace("\r", '', $list);
			$companiesList = explode("\n", $list);
		}
		// set filter by company settings
		Jobg8::$filterByCompany = $filterByCompany;
		Jobg8::$companiesList   = $companiesList;
		
		
		// check filter by membership plan
		$filterByPlan = SJB_System::getSettingByName('jobg8_membership_plan_filter');
		$plansList    = array();
		if ($filterByPlan) {
			$list      = SJB_System::getSettingByName('jobg8_membership_plan_list');
			$plansList = explode(',', $list);
		}
		// set filter by plans
		Jobg8::$filterByPlan = $filterByPlan;
		Jobg8::$plansList    = $plansList;
		
		
		// check filter by job category
		$filterByCategory = SJB_System::getSettingByName('jobg8_job_category_filter');
		$categoryList     = array();
		if ($filterByCategory) {
			$list         = SJB_System::getSettingByName('jobg8_job_category_list');
			$categoryList = explode(',', $list);
		}
		// set filter by job category
		Jobg8::$filterByCategory = $filterByCategory;
		Jobg8::$categoryList     = $categoryList;
		
		
		
		
		// GET XML
		$postXml   = Jobg8::getPostListingsXml($postListings);
		$deleteXml = Jobg8::getDeleteListingsXml($deleteListings);
		$amendXml  = Jobg8::getAmendListingsXml($amendListings);
		
		// Make output XML
		$outXml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<content>";
		$outXml .= $postXml;
		$outXml .= $amendXml;
		$outXml .= $deleteXml;
		$outXml .= "\n</content>";
		

		
		$logText = "**************** " . date("Y-m-d H:i") . " *************************\n\nListings Sended to Jobg8: ";
		
		if (!empty($listingsSids)) {
			
			// SEND XML TO JOBG8
			$jobg8WSDLUrl	 = SJB_Settings::getSettingByName('jobg8_wsdl_url');
			$jobg8JobBoardID = SJB_Settings::getSettingByName('jobg8_jobboard_id');
			$jobg8Password	 = SJB_Settings::getSettingByName('jobg8_password');
			
			// UPLOAD
			$objUpload = new UploadAdvertsFile();
			
			$objUpload->setJobBoardID($jobg8JobBoardID);
			$objUpload->setPassword($jobg8Password);
			$objUpload->setFileContent($outXml);
			
			
			$client = new SoapClient($jobg8WSDLUrl);
			$result = $client->UploadAdvertsFile($objUpload);
			
			
			// show result on test mode
			if ($test) {
				SJB_HelperFunctions::d($result, $result->UploadAdvertsFileResult);
			}
			
			
			// GET RESPONSE
			$objResponse = new GetFileResponse();
			$objResponse->setJobBoardID($jobg8JobBoardID);
			$objResponse->setPassword($jobg8Password);
			$objResponse->setFileName($result->UploadAdvertsFileResult);
			
			$result = $client->GetFileResponse($objResponse);
			
			// show result on test mode
			if ($test) {
				SJB_HelperFunctions::d($result, $outXml);
			}
		
		
			// ON THE END - DELETE SENDED SIDS FROM TABLE AND LOG IT
			Jobg8::removeListingsFromJobg8Table($listingsSids);
			
			$count = count($listingsSids);
			foreach ($listingsSids as $key => $sid) {
				$logText .= $sid;
				if ($key < ($count-1)) {
					$logText .= ", ";
				}
			}
			echo $logText;
		} else {
			$logText .= "no listings to send";
			echo $logText;
		}
		$logText .= "\n\n\n";
		
		
		
		// LOG TO FILE
		if (self::$log_outgoing_requests) {
			$filename = self::$outgoingLogFilename;
			
			if (file_exists($filename) && filesize($filename) > 15000000) {
				$fp = fopen($filename, "w");
			} else {
				$fp = fopen($filename, "a");
			}
			flock($fp, LOCK_EX);
			fputs($fp, $logText);
			flock($fp, LOCK_UN);
			fclose($fp);
		}
		
		error_log('jobg8_outgoing_end');
	}

	
	
	/**
	 * Get jobs and actions from JobG8 XML
	 *
	 * @param string $xml
	 */
	public static function getJobsFromJobG8()
	{
		error_log('jobg8_incoming_start');
		
		// get input data
		$xml  = file_get_contents('php://input');
		$ip   = $_SERVER['REMOTE_ADDR'];
		$date = date("Y-M-d H:i:s");


		
		// LOG TO FILE
		if (self::$log_incoming_requests) {
			$filename = self::$incomingLogFilename;
			
			if (file_exists($filename) && filesize($filename) > 15000000) {
				$fp = fopen($filename, "w");
			} else {
				$fp = fopen($filename, "a");
			}
			flock($fp, LOCK_EX);
			fputs($fp, "\n\n{$date}\nIP-address: {$ip}\n");
			fputs($fp, "\n------------- RAW POST -----------\n\n");
			fputs($fp, $xml);
			fputs($fp, "\n\n\n=====================================================================\n\n\n");
			flock($fp, LOCK_UN);
			fclose($fp);
		}


		// check for test action
		if (SJB_Request::getVar('test')) {
			$type = SJB_Request::getVar('action');
			// action type = 'post', 'amend' or 'delete'
			$xml = JobG8IntegrationPlugin::getTestData($type);
		}
		
		// check incoming data
		if (empty($xml)) {
			header("Content-type: text/xml; charset=UTF8");
			echo '<?xml version="1.0" encoding="utf-8"?><Body><Error>No Data To Parse</Error></Body>';
			exit;
		}

		// try to login by jobg8 user
		$user  = 'jobg8';
		$pass  = '123';
		$login = SJB_Authorization::login($user, $pass, false, $errors, false);
		if (!$login) {
			header("Content-type: text/xml; charset=UTF8");
			echo '<?xml version="1.0" encoding="utf-8"?><Body><Error>No Such User To JobG8</Error></Body>';
			exit;
		}

		
		// start working
		self::$jobg8PackageID = SJB_Settings::getSettingByName('jobg8_package_ID');
		
		$doc = new DOMDocument();
		$doc->loadXML($xml);
		
		$xmlResponse = '<?xml version="1.0" encoding="utf-8"?><Body>';
		
		
		// POST
		$nodes = $doc->getElementsByTagNameNS("urn:jobg8", "PostAdverts");
		foreach ($nodes as $node) {
		    foreach ($node->getElementsByTagName("PostAdvert") as $job) {
		        $sjob   = simplexml_import_dom($job);
		        $result = self::postAdverts($sjob);
		        
		        foreach ($result as $item) {
					if (isset($item['errors']) && empty($item['errors']) || !isset($item['errors'])) {
						$xmlResponse .= "<PostAdvertResponse><JobReference>{$item['id']}</JobReference><Success>{$item['id']} posted</Success></PostAdvertResponse>";
			        }
			        elseif (isset($item['errors']) && !empty($item['errors'])) {
			        	if (is_array($item['errors'])) {
			        		foreach ($item['errors'] as $field=>$errorText) {
			        			$xmlResponse .= "<PostAdvertResponse><JobReference>{$item['id']}</JobReference><Error>{$field} error: {$errorText}</Error></PostAdvertResponse>";
			        		}
			        	} else {
			        		$xmlResponse .= "<PostAdvertResponse><JobReference>{$item['id']}</JobReference><Error>{$item['errors']}</Error></PostAdvertResponse>";
			        	}
			        }
		        }
		    }
		}
		
		
		// DELETE
		$nodes = $doc->getElementsByTagNameNS("urn:jobg8", "DeleteAdverts");
		foreach ($nodes as $node) {
			foreach ($node->getElementsByTagName("DeleteAdvert") as $job) {
			    $sjob   = simplexml_import_dom($job);
			    $result = self::deleteAdverts($sjob);
			    
			    foreach ($result as $item) {
					if (isset($item['errors']) && empty($item['errors']) || !isset($item['errors'])) {
						$xmlResponse .= "<DeleteAdvertResponse><JobReference>{$item['id']}</JobReference><Success>{$item['id']} deleted</Success></DeleteAdvertResponse>";
			        } elseif (isset($item['errors']) && !empty($item['errors'])) {
			        	if (is_array($item['errors'])) {
			        		foreach ($item['errors'] as $field=>$errorText) {
			        			$xmlResponse .= "<DeleteAdvertResponse><JobReference>{$item['id']}</JobReference><Error>{$field} error: {$errorText}</Error></DeleteAdvertResponse>";
			        		}
			        	} else {
			        		$xmlResponse .= "<DeleteAdvertResponse><JobReference>{$item['id']}</JobReference><Error>{$item['errors']}</Error></DeleteAdvertResponse>";
			        	}
			        }
		        }
		    }
		}
		
		
		// AMEND
		$nodes = $doc->getElementsByTagNameNS("urn:jobg8", "AmendAdverts");
		foreach ($nodes as $node) {
			foreach ($node->getElementsByTagName("AmendAdvert") as $job) {
			    $sjob   = simplexml_import_dom($job);
			    $result = self::amendAdverts($sjob);
			    
				foreach ($result as $item) {
					if (isset($item['errors']) && empty($item['errors']) || !isset($item['errors'])) {
						$xmlResponse .= "<AmendAdvertResponse><JobReference>{$item['id']}</JobReference><Success>{$item['id']} amended</Success></AmendAdvertResponse>";
			        } elseif (isset($item['errors']) && !empty($item['errors'])) {
			        	if (is_array($item['errors'])) {
			        		foreach ($item['errors'] as $field=>$errorText) {
			        			$xmlResponse .= "<AmendAdvertResponse><JobReference>{$item['id']}</JobReference><Error>{$field} error: {$errorText}</Error></AmendAdvertResponse>";
			        		}
			        	} else {
			        		$xmlResponse .= "<AmendAdvertResponse><JobReference>{$item['id']}</JobReference><Error>{$item['errors']}</Error></AmendAdvertResponse>";
			        	}
			        }
		        }
			}
		}
		
		$xmlResponse .= '</Body>';
		
		
		// check for errors output
		$output = ob_get_contents();

		// output results
		if (empty($output)) {
			header("Content-type: text/xml; charset=UTF8");
		} else {
			// if errors - show as html
			header("Content-type: text/html; charset=UTF8");
		}
		
		echo $xmlResponse;
		
		
		
		// LOG RESPONSE TO FILE
		if (self::$log_responses_to_jobg8) {
			$filename = self::$responseLogFilename;
			
			if (file_exists($filename) && filesize($filename) > 15000000) {
				$fp = fopen($filename, "w");
			} else {
				$fp = fopen($filename, "a");
			}
			flock($fp, LOCK_EX);
			fputs($fp, "\n\n{$date}\nIP-address: {$ip}\n");
			fputs($fp, "\n------------- RAW POST -----------\n\n");
			fputs($fp, $xmlResponse);
			fputs($fp, "\n\n\n=====================================================================\n\n\n");
			flock($fp, LOCK_UN);
			fclose($fp);
		}
		
		
		error_log('jobg8_incoming_end');
	}
	
	
	/**
	 * Post JobG8 advert on SJB
	 *
	 * @param object $job DOM object
	 * @return array
	 */
	private function postAdverts($job)
	{
		$current_user = SJB_UserManager::getCurrentUser();
		
		/********** SET SOME PACKET FOR TEST *************/
		
		$listing_type_id    = 'Job';
		// jobg8 package
		$listing_package_id = self::$jobg8PackageID;
		
		$_REQUEST ['listing_type_id']    = $listing_type_id;
		$_REQUEST ['listing_package_id'] = $listing_package_id;
		
		$listing_types_info = SJB_ListingTypeManager::getAllListingTypesInfo ();
		
		if (count ( $listing_types_info ) == 1) {
			$listing_type_info = array_pop ( $listing_types_info );
			$listing_type_id = $listing_type_info ['id'];
		}
		
		$listing_type_sid     = SJB_ListingTypeManager::getListingTypeSIDByID ( $listing_type_id );
		$listing_package_info = SJB_PackagesManager::getPackageInfoByPackageID($listing_package_id);
		
		$advertsErrors = array ();
		$jobReference  = ( string ) $job->JobReference;
		
		// OK. Now prepare $_REQUEST from $PostAdvert object
		$_REQUEST ['Title'] = (string) $job->Position;
		$_REQUEST ['JobReference'] = $jobReference;
		$_REQUEST ['company_name'] = ( string ) $job->AdvertiserName;
		
		$_REQUEST ['JobCategory'] = array (( string ) $job->Classification );
		//$_REQUEST['Occupations']	= array('tree' => '');
		
		$_REQUEST ['Country']	= ( string ) $job->Country;
		$_REQUEST ['State']		= ( string ) $job->Location;
		$_REQUEST ['City']		= ( string ) $job->Area;
		//$_REQUEST['ZipCode']	= (string) $job->PostCode;
		
		$_REQUEST ['EmploymentType'] = ( string ) $job->EmploymentType;
		$_REQUEST ['Salary']		 = isset($job->PayAmount) ? ( string ) $job->PayAmount : ( string ) $job->PayMaximum;
		$_REQUEST ['SalaryType'] = ( string ) $job->PayPeriod;
		
		// this range of payment
		//$_REQUEST ['SalaryMin']		= ( string ) $job->PayMinimum;
		//$_REQUEST ['SalaryMax']		= ( string ) $job->PayMaximum;
		
		
		// check 'Salary' value
		if ( strstr($_REQUEST['Salary'], '.') !== false) {
			// ok - we find '.' in value - round this!
			$_REQUEST['Salary'] = ( string ) floor( $_REQUEST['Salary'] );
		}
		
		// SET CORRECT 'Salary' REQUEST
		require_once ('miscellaneous/Currency/Currency.php');
		
		$currencyCode = '';
		if (!empty($job->Currency)) {
			list(,$currencyCode) = explode('.', $job->Currency[0], 2);
			$currencyCode        = trim($currencyCode);
		}
		$currentCurrency     = SJB_CurrencyManager::getDefaultCurrency();
		$currencyList        = SJB_CurrencyManager::getActiveCurrencyList();
		foreach ($currencyList as $currency) {
			if ($currency['currency_code'] == $currencyCode) {
				$currentCurrency = $currency;
			}
		}
		$_REQUEST['Salary'] = array('value' => $_REQUEST['Salary'], 'add_parameter' => $currentCurrency['sid']);
		
		
		$_REQUEST ['JobDescription']  = ( string ) $job->Description;
		$_REQUEST ['JobRequirements'] = '';
		
		$_REQUEST ['ApplicationSettings']['value'] = ( string ) $job->ApplicationURL;
		$_REQUEST ['ApplicationSettings']['add_parameter'] = 2;
		
		//==========================================================================
		
		$listing = new SJB_Listing ( $_REQUEST, $listing_type_sid );
		$listing->deleteProperty ( 'featured' );
		$listing->deleteProperty ( 'priority' );
		$listing->deleteProperty ( 'status' );
		$listing->deleteProperty ( 'reject_reason' );
		$listing->deleteProperty ( 'ZipCode' );
		
		$listing->makePropertyNotRequired('Occupations');
		
		$listing->addProperty ( array ('id' => 'access_list', 'type' => 'multilist', 'value' => SJB_Request::getVar ( "list_emp_ids" ), 'is_system' => true ) );
		
		// add JobReference property for listing
		$listing->addProperty ( array ('id' => 'job_reference', 'type' => 'string', 'value' => $jobReference, 'is_system' => true ) );
		
		$add_listing_form = new SJB_Form ( $listing );
		$fieldErrors      = array ();
		
		if ($add_listing_form->isDataValid ( $fieldErrors )) {
			$listing->setUserSID ( $current_user->getSID () );
			$listing->setListingPackageInfo ( $listing_package_info );
			
			$access_type = $listing->getProperty ( 'access_type' );
			
			if (empty ( $access_type->value ))
				$listing->setPropertyValue ( 'access_type', 'everyone' );
				
			// check for unique JobReference
			$checkUniqueJobReference = SJB_DB::query("SELECT * FROM `listings` WHERE `job_reference` = ?s", $jobReference);
			if (!empty($checkUniqueJobReference)) {
				$advertsErrors[] = array ('id' => $jobReference, 'errors' => 'JobReference Already Exists' );
				return $advertsErrors;
			}
			
			$result = SJB_ListingManager::saveListing ( $listing );
			
			// is listing featured by default
			if ($listing_package_info ['is_featured']) {
				SJB_ListingManager::makeFeaturedBySID ( $listing->getSID () );
			}
			
			SJB_ListingManager::activateListingBySID ( $listing->getSID () );
			SJB_ListingManager::setListingApprovalStatus($listing->getSID(), 'approved');
			
		} else {
			// 'Some fields not valid!'
			$advertsErrors[] = array ('id' => $jobReference, 'errors' => $fieldErrors );
		}
		
		if (!empty($advertsErrors)) {
			return $advertsErrors;
		}
		return array( array('id' => $jobReference, 'errors' => ''));
	}


	
	/**
	 * Delete JobG8 advert on SJB
	 *
	 * @param object $job DOM object
	 * @return array
	 */
	private function deleteAdverts($job)
	{
		$current_user = SJB_UserManager::getCurrentUser();
	
		/********** SET SOME PACKET FOR TEST *************/
		
		$listing_type_id    = 'Job';
		// jobg8 package
		$listing_package_id = self::$jobg8PackageID;
		
		$_REQUEST ['listing_type_id']    = $listing_type_id;
		$_REQUEST ['listing_package_id'] = $listing_package_id;
		
		
		$listing_types_info = SJB_ListingTypeManager::getAllListingTypesInfo();
			
		if (count($listing_types_info) == 1) {
			$listing_type_info = array_pop($listing_types_info);
			$listing_type_id = $listing_type_info['id'];
		}
	
		$listing_type_sid     = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id);
		$listing_package_info = SJB_PackagesManager::getPackageInfoByPackageID($listing_package_id);
		
		$advertsErrors = array();
		$jobReference  = (string) $job->JobReference;
		
		if (!empty($jobReference)) {
			// OK. Now prepare $_REQUEST from $PostAdvert object
			$_REQUEST['JobReference']	= $jobReference;
			
			$result = array_pop(SJB_DB::query("SELECT `sid` FROM `listings` WHERE `job_reference` = ?s", $jobReference));
			
			if (!empty($result)) {
				$jobSID = $result['sid'];
				SJB_Event::addToIgnoreList('beforeListingDelete');
				$result = SJB_ListingManager::deleteListingBySID($jobSID);
				SJB_Event::removeFromIgnoreList('beforeListingDelete');
			} else {
				$advertsErrors [] = array ('id' => $jobReference, 'errors' => 'Job Reference Not Exists');
			}
		} else {
			$advertsErrors[] = array ('id' => $jobReference, 'errors' => 'Empty Job Reference');
		}
		
		if (!empty($advertsErrors)) {
			return $advertsErrors;
		}
		
		return array( array('id' => $jobReference, 'errors' => ''));
	}
		

	
	/**
	 * Amend JobG8 advert on SJB
	 *
	 * @param object $job DOM object
	 * @return array
	 */
	private function amendAdverts($job)
	{
		$current_user = SJB_UserManager::getCurrentUser ();
		
		/********** SET SOME PACKET FOR TEST *************/
		
		$listing_type_id    = 'Job';
		// jobg8 package
		$listing_package_id = self::$jobg8PackageID;
		
		$_REQUEST ['listing_type_id']    = $listing_type_id;
		$_REQUEST ['listing_package_id'] = $listing_package_id;
		
		$listing_types_info = SJB_ListingTypeManager::getAllListingTypesInfo ();
		
		if (count ( $listing_types_info ) == 1) {
			$listing_type_info = array_pop ( $listing_types_info );
			$listing_type_id = $listing_type_info ['id'];
		}
		
		$listing_type_sid     = SJB_ListingTypeManager::getListingTypeSIDByID ( $listing_type_id );
		$listing_package_info = SJB_PackagesManager::getPackageInfoByPackageID($listing_package_id);
		
		$advertsErrors = array ();
		
		$jobReference	= ( string ) $job->JobReference;
		//$jobLocation	= ( string ) $job->Location;
		
		/************* GET LISTING TO AMEND **************/
		
		// get id of listing by job reference
		$result = array_pop(SJB_DB::query("SELECT `sid` FROM `listings` WHERE `job_reference` = ?s", $jobReference));
		if (empty($result) || empty($result['sid'])) {
			return array('id' => $jobReference, 'errors' => 'Unable to amend: listing by job reference not exists');
		}
		$jobSID = $result['sid'];
		
		$listingInfo = SJB_ListingManager::getListingInfoBySID($jobSID);
		$listing     = new SJB_Listing ( $listingInfo, $listing_type_sid );
		
		
		/*************** GET AMENDED VALUES ******************/
		
		$_REQUEST ['JobReference']	= $jobReference;
		
		$_REQUEST ['Title']			= isset($job->Position) ? (string) $job->Position : $listing->getPropertyValue('Title');
		$_REQUEST ['JobCategory']	= isset($job->Classification) ? array ( (string) $job->Classification) : $listing->getPropertyValue('JobCategory');
		//$_REQUEST['Occupations']	= array('tree' => '');
		$_REQUEST ['Country']		= isset($job->Country) ? ( string ) $job->Country : $listing->getPropertyValue('Country');
		$_REQUEST ['State']			= isset($job->Location) ? (string) $job->Location : $listing->getPropertyValue('State');
		$_REQUEST ['City']			= isset($job->Area) ? (string) $job->Area : $listing->getPropertyValue('State');
		//$_REQUEST['ZipCode']		= isset($job->PostCode) ? (string) $job->PostCode : $listing->getPropertyValue('ZipCode');
		$_REQUEST ['EmploymentType'] = isset($job->EmploymentType) ? (string) $job->EmploymentType : $listing->getPropertyValue('EmploymentType');
		
		if (isset($job->PayAmount)) {
			$_REQUEST ['Salary'] = (string) $job->PayAmount;
		} else if( isset($job->PayMaximum)) {
			$_REQUEST ['Salary'] = (string) $job->PayMaximum;
		} else {
			$_REQUEST ['Salary'] = '';
		}
		
		// check 'Salary' value
		if ( strstr($_REQUEST['Salary'], '.') !== false) {
			// ok - we find '.' in value - round this!
			$_REQUEST['Salary'] = ( string ) floor( $_REQUEST['Salary'] );
		}
		
		// SET CORRECT 'Salary' REQUEST
		require_once ('miscellaneous/Currency/Currency.php');
		
		$currencyCode = '';
		if (!empty($job->Currency)) {
			list(,$currencyCode) = explode('.', $job->Currency[0], 2);
			$currencyCode        = trim($currencyCode);
		}
		$currentCurrency     = SJB_CurrencyManager::getDefaultCurrency();
		$currencyList        = SJB_CurrencyManager::getActiveCurrencyList();
		foreach ($currencyList as $currency) {
			if ($currency['currency_code'] == $currencyCode) {
				$currentCurrency = $currency;
			}
		}
		$_REQUEST['Salary'] = array('value' => $_REQUEST['Salary'], 'add_parameter' => $currentCurrency['sid']);
		
		$_REQUEST ['SalaryType'] = isset($job->PayPeriod) ? (string) $job->PayPeriod : $listing->getPropertyValue('SalaryType');
		
		// this need to be create new fields (we dont have them)
		//$_REQUEST ['SalaryMin']		= ( string ) $job->PayMinimum;
		//$_REQUEST ['SalaryMax']		= ( string ) $job->PayMaximum;
		
		$_REQUEST ['JobDescription'] = isset($job->Description) ? (string) $job->Description : $listing->getPropertyValue('JobDescription');
		$_REQUEST ['JobRequirements'] = '';
		
		$applicationSettings = $listing->getPropertyValue('ApplicationSettings');
		$_REQUEST ['ApplicationSettings']['value'] = isset($job->ApplicationURL) ? (string) $job->ApplicationURL : $applicationSettings['value'];
		$_REQUEST ['ApplicationSettings']['add_parameter'] = 2;
		
		//==========================================================================
		
		
		$listingInfo = array_merge($listingInfo, $_REQUEST);
		
		$listing = new SJB_Listing ( $listingInfo, $listing_type_sid );
		$listing->deleteProperty ( 'featured' );
		$listing->deleteProperty ( 'priority' );
		$listing->deleteProperty ( 'status' );
		$listing->deleteProperty ( 'reject_reason' );
		$listing->deleteProperty ( 'ZipCode' );
		
		$listing->makePropertyNotRequired('Occupations');
		
		$listing->addProperty ( array ('id' => 'access_list', 'type' => 'multilist', 'value' => SJB_Request::getVar ( "list_emp_ids" ), 'is_system' => true ) );
		
		// add JobReference property for listing
		$listing->addProperty ( array ('id' => 'job_reference', 'type' => 'string', 'value' => $jobReference, 'is_system' => true ) );
		
		
		$add_listing_form = new SJB_Form ( $listing );
		$fieldErrors      = array ();
		
		$listing->setSID($jobSID);
		
		if ($add_listing_form->isDataValid ( $fieldErrors )) {
			$listing->setUserSID ( $current_user->getSID () );
			$listing->setListingPackageInfo ( $listing_package_info );
			
			$access_type = $listing->getProperty ( 'access_type' );
			
			if (empty ( $access_type->value )) {
				$listing->setPropertyValue ( 'access_type', 'everyone' );
			}
			SJB_ListingManager::saveListing ( $listing );
			
			// is listing featured by default
			if ($listing_package_info ['is_featured']) {
				SJB_ListingManager::makeFeaturedBySID ( $listing->getSID () );
			}
			
			SJB_ListingManager::setListingApprovalStatus($listing->getSID(), 'approved');
			
		} else {
			// 'Some fields not valid!'
			$advertsErrors[] = array ('id' => $jobReference, 'errors' => $fieldErrors );
		}
		
		if (!empty($advertsErrors)) {
			return $advertsErrors;
		}
		return array( array('id' => $jobReference, 'errors' => ''));
	}

	
	/**
	 * get test xml data to check posting, amending or deleting jobg8 listings
	 *
	 * @param string $action 'post', 'amend' or 'delete'
	 * @return string
	 */
	private function getTestData($action)
	{
		switch ( strtolower($action) ) {
			case 'post':
				return '<?xml version="1.0" encoding="utf-8"?><s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"><s:Body s:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
					<q1:PostAdverts xmlns:q1="urn:jobg8">
					<user xsi:type="xsd:string" />
					<pass xsi:type="xsd:string" />
					
					<PostAdvert xmlns="http://jobg8.com/">
					<JobReference>7597381/45608000</JobReference>
					<ClientReference>7597381000</ClientReference>
					<Classification>I.T. &amp; Communications</Classification>
					<SubClassification>Other</SubClassification>
					<Position>TEST Senior Producer / Project manager</Position>
					<Description><![CDATA[A digital advertising agency based in Central London is currently looking for a Senior Producer/Project Manager to join them. You will be working in the digital department across a number of account for leading UK ad international brands. You will have<br/>solid digital agency background and will be required to show examples of successful projects. You will successfully manage budgets and timelines, manage third party supplier relationships, coordination between design and production/technical teams.<br/>Experience in MS Project is also necessary.]]></Description>
					<Location>London</Location>
					<Area>Not Specified</Area>
					<Country>United Kingdom</Country>
					<EmploymentType>Any</EmploymentType>
					<WorkHours>Not Specified</WorkHours>
					<VisaRequired>Applicants must be eligible to work in the specified location</VisaRequired>
					<PayPeriod>Annual</PayPeriod>
					<PayMinimum>35000</PayMinimum>
					<PayMaximum>45000</PayMaximum>
					<Currency>British Pound . GBP</Currency>
					<Contact></Contact>
					<ApplicationURL>http://training.jobg8.com/Application.aspx?CbHaj2P2jteDFHa4CPaonQe</ApplicationURL>
					<JobSource>The IT Job Board</JobSource>
					<AdvertiserName>Preferred Choice Ltd</AdvertiserName>
					</PostAdvert>
					</q1:PostAdverts></s:Body></s:Envelope>';
				break;
				
			case 'amend':
				return '<?xml version="1.0" encoding="utf-8"?><s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"><s:Body s:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
					<q1:AmendAdverts xmlns:q1="urn:jobg8">
					<user xsi:type="xsd:string" />
					<pass xsi:type="xsd:string" />
					
					<AmendAdvert xmlns="http://jobg8.com/">
					<JobReference>7597381/45608000</JobReference>
					<Position>TEST AMEND Senior Producer / Project manager</Position>
					<Description><![CDATA[A digital advertising agency based in Central London is currently looking for a Senior Producer/Project Manager to join them. You will be working in the digital department across a number of account for leading UK ad international brands. You will have<br/>solid digital agency background and will be required to show examples of successful projects. You will successfully manage budgets and timelines, manage third party supplier relationships, coordination between design and production/technical teams.<br/>Experience in MS Project is also necessary.]]></Description>
					<Location>New Casle</Location>
					<Area>Not Specified</Area>
					<EmploymentType>Contact</EmploymentType>
					<WorkHours>Not Specified</WorkHours>
					<VisaRequired>Applicants must be eligible to work in the specified location</VisaRequired>
					<PayPeriod>Annual</PayPeriod>
					<PayMinimum>3300</PayMinimum>
					<PayMaximum>3000</PayMaximum>
					<Currency>British Pound . GBP</Currency>
					<Contact></Contact>
					<ApplicationURL>http://training.jobg8.com/Application.aspx?CbHaj2P2jteDFHa4CPaonQe</ApplicationURL>
					<JobSource>The IT Job Board</JobSource>
					<AdvertiserName>Preferred Choice Ltd</AdvertiserName>
					</AmendAdvert>
					</q1:AmendAdverts></s:Body></s:Envelope>';
				break;
				
			case 'delete':
				return '<?xml version="1.0" encoding="utf-8"?><s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"><s:Body s:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
					<q1:DeleteAdverts xmlns:q1="urn:jobg8">
					<user xsi:type="xsd:string" />
					<pass xsi:type="xsd:string" />
					
					<DeleteAdvert xmlns="http://jobg8.com/">
					<JobReference>7597381/45608000</JobReference>
					</DeleteAdvert>
					</q1:DeleteAdverts></s:Body></s:Envelope>';
				break;
				
			default:
				return '';
		}
	}
	
	
	
	public function deleteExpiredJobG8Listings()
	{
		// Get not active expired JobG8 jobs (NOW() - expiration_date) > 1 days, and delete it
		$daysOld = 1;
		$expired_jobg8_jobreferences = array();
		
		$listings = SJB_DB::query("	SELECT `sid` FROM `listings` 
				WHERE `expiration_date` < DATE_SUB( NOW(), INTERVAL {$daysOld} DAY) AND `active` = 0 AND `job_reference` <> `sid`");
		if (empty($listings)) {
			return;
		}
		
		$listings_sid = array();
		foreach ($listings as $listing) {
			$listings_sid[] = $listing['sid'];
		}
		
		foreach ($listings_sid as $sid) {
			$expired_jobg8_jobreferences[] = SJB_ListingManager::getJobReferenceByListingSID($sid);
			SJB_ListingManager::deleteListingBySID($sid);
		}
		
		return;
	}
	
}