<?php

require_once("plugins/PluginAbstract.php");

class IndeedPlugin extends SJB_PluginAbstract 
{
	public static $indeedListings = array();
	
	function pluginSettings()
	{
		return array( 
			array (
				'id'			=> 'countIndeedListings',
				'caption'		=> 'Number of listings',
				'type'			=> 'integer',
				'comment'		=> 'The Number of listings imported from Indeed to be displayed per page in search results',
				'length'		=> '50',
				'order'			=> null,
			),
			array (
				'id'			=> 'IndeedPublisherID',
				'caption'		=> 'Publisher ID',
				'type'			=> 'string',
				'comment'		=> 'To get the Publisher ID, go to http://indeed.com, sign in/register, then go to Publishers menu (https://ads.indeed.com/jobroll/) and Create an Account.<br/>Once you created an account, go to XML Feed tab (https://ads.indeed.com/jobroll/xmlfeed) and find your Publisher ID in the table below. ',
				'length'		=> '50',
				'order'			=> null,
			),			
			array (
				'id'			=> 'IndeedKeywords',
				'caption'		=> 'Keywords',
				'type'			=> 'string',
				'comment'		=> 'Specifying this parameter you can limit jobs from Indeed to jobs containing these phrases',
				'length'		=> '50',
				'order'			=> null,
			),
			array (
				'id'			=> 'IndeedLocation',
				'caption'		=> 'Location',
				'type'			=> 'string',
				'comment'		=> 'Use a postal code or a "city, state/province/region" combination',
				'length'		=> '50',
				'order'			=> null,
			),
			array (
				'id'			=> 'IndeedRadius',
				'caption'		=> 'Radius',
				'type'			=> 'string',
				'comment'		=> 'Distance from search location. Default is 25',
				'length'		=> '50',
				'order'			=> null,
			),
			array (
				'id'			=> 'IndeedSiteType',
				'caption'		=> 'Site Type',
				'type'			=> 'string',
				'comment'		=> "To show only jobs from job boards use 'jobsite'. For jobs from direct employer websites use 'employer'",
				'length'		=> '50',
				'order'			=> null,
			),
			array (
				'id'			=> 'IndeedJobType',
				'caption'		=> 'Job Type',
				'type'			=> 'string',
				'comment'		=> 'Allowed values: "fulltime", "parttime", "contract", "internship", "temporary"',
				'length'		=> '50',
				'order'			=> null,
			),
			array (
				'id'			=> 'IndeedCountry ',
				'caption'		=> 'Country',
				'type'			=> 'string',
				'comment'		=> 'Search within country specified. Default is us',
				'length'		=> '50',
				'order'			=> null,
			),
			array (
				'id'			=> 'IndeedSort',
				'caption'		=> 'Sort',
				'type'			=> 'string',
				'comment'		=> 'Sort by relevance or date. Default is relevance',
				'length'		=> '50',
				'order'			=> null,
			)
		);
	}
	
	public static function getListingsFromIndeed($params)
	{
		$listingTypeID = SJB_ListingTypeManager::getListingTypeIDBySID($params->listing_type_sid);
		if ($listingTypeID == 'Job' && $GLOBALS['uri'] == '/search-results-jobs/') {
			$publisherID 	= SJB_Settings::getSettingByName('IndeedPublisherID');
			$limit = SJB_Settings::getSettingByName('countIndeedListings');
			$ip          	= $_SERVER['REMOTE_ADDR'];
			$userAgent  	= urlencode($_SERVER['HTTP_USER_AGENT']);
			$start = $limit*($params->listing_search_structure['current_page']-1)+1;
	
			$stateIndexes = array(
				'AL' => 'Alabama',
				'AK' => 'Alaska',
				'AZ' => 'Arizona',
				'AR' => 'Arkansas',
				'CA' => 'California',
				'CO' => 'Colorado',
				'CT' => 'Connecticut',
				'DE' => 'Delaware',
				'FL' => 'Florida',
				'GA' => 'Georgia',
				'HI' => 'Hawaii',
				'ID' => 'Idaho',
				'IL' => 'Illinois',
				'IN' => 'Indiana',
				'IA' => 'Iowa',
				'KS' => 'Kansas',
				'KY' => 'Kentucky',
				'LA' => 'Louisiana',
				'ME' => 'Maine',
				'MD' => 'Maryland',
				'MA' => 'Massachusetts',
				'MI' => 'Michigan',
				'MN' => 'Minnesota',
				'MS' => 'Mississippi',
				'MO' => 'Missouri',
				'MT' => 'Montana',
				'NE' => 'Nebraska',
				'NV' => 'Nevada',
				'NH' => 'New Hampshire',
				'NJ' => 'New Jersey',
				'NM' => 'New Mexico',
				'NY' => 'New York',
				'NC' => 'North Carolina',
				'ND' => 'North Dakota',
				'OH' => 'Ohio',
				'OK' => 'Oklahoma',
				'OR' => 'Oregon',
				'PA' => 'Pennsylvania',
				'RI' => 'Rhode Island', 
				'SC' => 'South Carolina',
				'SD' => 'South Dakota',
				'TN' => 'Tennessee',
				'TX' => 'Texas',
				'UT' => 'Utah',
				'VT' => 'Vermont',
				'VA' => 'Virginia',
				'WA' => 'Washington',
				'WV' => 'West Virginia',
				'WI' => 'Wisconsin',
				'WY' => 'Wyoming',
				'DC' => 'District of Columbia',
				'AS' => 'American Samoa',
				'GU' => 'Guam',
				'MP' => 'Northern Mariana Islands',
				'PR' => 'Puerto Rico',
				'UM' => "United's Minor Outlying Islands",
				'VI' => 'Virgin Islands'
			);
			
			$countryCodes = array(
				'United States' => 'us',
				'Australia'     => 'au',
				'Austria'       => 'at',
				'Belgium'       => 'be',
				'Brazil'        => 'br',
				'Canada'        => 'ca',
				'France'        => 'fr',
				'Germany'       => 'de',
				'India'         => 'in',
				'Ireland'       => 'ie',
				'Italy'         => 'it',
				'Mexico'        => 'mx',
				'Netherlands'   => 'nl',
				'Spain'         => 'es',
				'Switzerland'   => 'ch',
				'United Kingdom' => 'gb',
			);
	
		// SET PARAMS FOR REQUEST
			$keywords = SJB_Settings::getSettingByName('IndeedKeywords');
	
			$criteria = $params->criteria_saver->criteria;
			$categoryCriteria = isset($criteria['JobCategory']['multi_like']) ? $criteria['JobCategory']['multi_like'] : '';
			if (!empty($categoryCriteria)) {
				if (!empty($keywords))
					$keywords .= ' or ';
				foreach ($categoryCriteria as $category) {
					$keywords .= $category . ' or ';
				}
				$keywords = substr($keywords, 0, strlen($keywords) - 4);
			}

			foreach ($criteria as $fieldName => $field) {
				if (is_array($field)) {
					foreach ($field as $fieldType => $values) {
						if ($fieldType == 'multi_like_and') {
							foreach ($values as $val) {
								if ($keywords != '')
									$keywords .= " and ";
								$keywords .= $val;
							}
						}
					}
				}
			}
			if (isset($criteria['keywords']) && !empty($criteria['keywords'])) {
				foreach ($criteria['keywords'] as $key => $item) {
					if ($key == 'exact_phrase' || $key == 'any_words') {
						if (!empty($keywords))
							$keywords .= ' or ';
						$keywords .= $item;
					}
				}
			}
			if (substr($keywords, -4) == ' or ')
				$keywords = substr($keywords, 0, strlen($keywords) - 4);
			$keywords = trim($keywords);
			$keywords = urlencode($keywords);
			$keywords = !empty($keywords)?"({$keywords})":'';
			
			$city  = isset($criteria['City']['like']) ? $criteria['City']['like'] : '';
			$state = isset($criteria['State']['multi_like'][0]) ? $criteria['State']['multi_like'][0] : '';
			
			if (!empty($state)) {
				foreach ($stateIndexes as $index => $name) {
					if ($state == $name) {
						$state = $index;
						break;
					}
				}
			}
			$location = SJB_Settings::getSettingByName('IndeedLocation');
			if (isset($criteria['ZipCode']['geo']['location']) && !empty($criteria['ZipCode']['geo']['location'])) {
				$location = $criteria['ZipCode']['geo']['location'];
			} elseif (!empty($city) && !empty($state)) {
				$location = "{$city}, $state";
				$location = urlencode($location);
			}
			$radius = SJB_Settings::getSettingByName('IndeedRadius');
			if (isset($criteria['ZipCode']['geo']['radius']) && !empty($criteria['ZipCode']['geo']['radius'])) {
				$radius = $criteria['ZipCode']['geo']['radius'];
				if ($radius == 'any') {
					$radius = '';
				}
			}
			
			$country = isset($criteria['Country']['multi_like'][0]) ? $criteria['Country']['multi_like'][0] : SJB_Settings::getSettingByName('IndeedCountry');
			foreach ($countryCodes as $name => $key) {
				if ($country == $name) {
					$country = $key;
					break;
				}
			}
			$jobType = SJB_Settings::getSettingByName('IndeedJobType');
			$siteType = SJB_Settings::getSettingByName('IndeedSiteType');
			$sort =  SJB_Settings::getSettingByName('IndeedSort');
			$url        = "http://api.indeed.com/ads/apisearch?publisher={$publisherID}&q={$keywords}&l={$location}&sort={$sort}&radius={$radius}&st={$siteType}&jt={$jobType}&start={$start}&limit={$limit}&fromage=&filter=&latlong=1&co={$country}&chnl=&userip={$ip}&useragent={$userAgent}&v=2";
			
			$ch = curl_init();
				
			// set URL and other appropriate options
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			// grab URL and pass it to the browser
			$xml = curl_exec($ch);
			
			// close cURL resource, and free up system resources
			curl_close($ch);
			
			$indeedListings = array();
			$totalResults = 0;

			if ($xml !== false) {
				$doc = new DOMDocument();
				$doc->loadXML($xml);
				
				$results = $doc->getElementsByTagName('results');
				$total   = $doc->getElementsByTagName('totalresults');
				$totalResults = $total->item(0)->nodeValue;
							
				// if we need just total results number
	
				$outputCountry = array_flip($countryCodes);

				foreach ($results as $node) {
					foreach ($node->getElementsByTagName('result') as $result) {
						$resultXML = simplexml_import_dom($result);
						$jobKey    = (string) $resultXML->jobkey;
						$state     = (string) $resultXML->state;
						$country   = (string) $resultXML->country;
	
						$indeedListings [$jobKey] = array(
							'Title'          => (string) $resultXML->jobtitle,
							'CompanyName'    => (string) $resultXML->company,
							'JobDescription' => (string) $resultXML->snippet,
							'City'           => (string) $resultXML->city,
							'State'          => empty($state) ? '' : $stateIndexes [ strtoupper($state) ],
							'Country'        => empty($country) ? '' : $outputCountry [ strtolower($country) ],
							'Location'       => (string) $resultXML->formattedLocation,
							'url'            => SJB_System::getSystemSettings('SITE_URL')."/partnersite/". str_replace('http://www.indeed.com/viewjob', '', (string) $resultXML->url),
							'onmousedown'    => (string) $resultXML->onmousedown,
							'jobkey'         => $jobKey,
							'activation_date'=> (string) $resultXML->date,
							'api'			 => 'indeed', 
							'code'			 => '<span id=indeed_at><a href="http://www.indeed.com/">jobs</a> by <a href="http://www.indeed.com/" title="Job Search"><img src="http://www.indeed.com/p/jobsearch.gif" style="border: 0; vertical-align: middle;" alt="Indeed job search"></a></span>' 
						);
					}
				}
			}
			self::$indeedListings = $indeedListings;
		}
		return $params;
	}
	
	public static function addIndeedListingsToListingStructure($listings_structure)
	{
		foreach (self::$indeedListings as $indeedListing) {
			$listings_structure[$indeedListing['jobkey']] = $indeedListing;
		}
		return $listings_structure;
	}
}