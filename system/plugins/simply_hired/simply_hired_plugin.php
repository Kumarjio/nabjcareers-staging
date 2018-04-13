<?php

require_once("plugins/PluginAbstract.php");
require_once 'simpleXML/simplexml.class.php';

class SimplyHiredPlugin extends SJB_PluginAbstract 
{
	public static $simplyhiredListings = array();
	
	function pluginSettings()
	{
		return array( 
			array (
				'id'			=> 'countSimplyHiredListings',
				'caption'		=> 'Number of listings',
				'type'			=> 'integer',
				'comment'		=> 'The Number of listings imported from Indeed to be displayed per page in search results',
				'length'		=> '50',
				'order'			=> null,
			),
			array (
				'id'			=> 'simplyHiredPublisherID',
				'caption'		=> 'Publisher ID',
				'type'			=> 'string',
				'comment'		=> 'To get the Publisher ID, go to http://simplyhired.com, sign in/register, then go to Publishers menu (http://www.simplyhired.com/a/publishers/overview), ',
				'length'		=> '50',
				'order'			=> null,
			),
			array (
				'id'			=> 'simplyHiredKeyword',
				'caption'		=> 'Keywords',
				'type'			=> 'string',
				'comment'		=> 'Specifying this parameter you can limit jobs from SimplyHired to jobs containing these phrases',
				'length'		=> '50',
				'order'			=> null,
			)
			,
			array (
				'id'			=> 'simplyHiredLocation',
				'caption'		=> 'Location',
				'type'			=> 'string',
				'comment'		=> 'Use a postal code or a "city, state/province/region" combination',
				'length'		=> '50',
				'order'			=> null,
			)
			,
			array (
				'id'			=> 'simplyHiredMiles',
				'caption'		=> 'Miles',
				'type'			=> 'string',
				'comment'		=> 'Distance from search location in miles. Default is 25',
				'length'		=> '50',
				'order'			=> null,
			)
			,
			array (
				'id'			=> 'simplyHiredSortBy',
				'caption'		=> 'Sort By',
				'type'			=> 'string',
				'comment'		=> 'A parameter indicating the sort order of organic jobs.<br>
				Valid values include:<br>
				<ul>
			    <li>rd = relevance descending (default)</li>
			    <li>ra = relevance ascending</li>
			    <li>dd = last seen date descending</li>
			    <li>da = last seen date ascending</li>
			    <li>td = title descending</li>
			    <li>ta = title ascending</li>
			    <li>cd = company descending</li>
			    <li>ca = company ascending</li>
			    <li>ld = location descending</li>
			    <li>la = location ascending</li>
			    </ul>
				',
				'length'		=> '50',
				'order'			=> null,
			)
		);
	}
	
	public static function getListingsFromSimplyHired($params)
	{
		$listingTypeID = SJB_ListingTypeManager::getListingTypeIDBySID($params->listing_type_sid);
		if ($listingTypeID == 'Job' && $GLOBALS['uri'] == '/search-results-jobs/') {
			$publisherID 	= SJB_Settings::getSettingByName('simplyHiredPublisherID');
			$limit = SJB_Settings::getSettingByName('countSimplyHiredListings');
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
			$keywords = '';
	
			$criteria = $params->criteria_saver->criteria;
			$categoryCriteria = isset($criteria['JobCategory']['multi_like']) ? $criteria['JobCategory']['multi_like'] : '';
			if (!empty($categoryCriteria)) {
				foreach ($categoryCriteria as $category) {
					$keywords .= $category . ' OR ';
				}
				$keywords = substr($keywords, 0, strlen($keywords) - 4);
			}

			foreach ($criteria as $fieldName => $field) {
				if (is_array($field)) {
					foreach ($field as $fieldType => $values) {
						if ($fieldType == 'multi_like_and') {
							foreach ($values as $val) {
								if ($keywords != '')
									$keywords .= " AND ";
								$keywords .= $val;
							}
						}
					}
				}
			}

			if (isset($criteria['keywords']) && !empty($criteria['keywords'])) {
				foreach ($criteria['keywords'] as $key => $item) {
					if ($key == 'exact_phrase' || $key == 'any_words') {
						$keywords .= $item;
					}
				}
			}
			$systemKeywords = SJB_Settings::getSettingByName('simplyHiredKeyword');
			$keywords = $systemKeywords?$systemKeywords. " OR ".$keywords:$keywords;
			$keywords = trim($keywords);
			$keywords = !empty($keywords)?$keywords:SJB_Settings::getSettingByName('simplyHiredKeyword');
			$keywords = urlencode($keywords);
			
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
			$location = SJB_Settings::getSettingByName('simplyHiredLocation');
			if (isset($criteria['ZipCode']['geo']['location']) && !empty($criteria['ZipCode']['geo']['location'])) {
				$location = $criteria['ZipCode']['geo']['location'];
			} elseif (!empty($city)) {
				$location = $city;
			}
			elseif (!empty($state)){
				$location = $state;
			}
			$radius = SJB_Settings::getSettingByName('simplyHiredMiles');
			if (isset($criteria['ZipCode']['geo']['radius']) && !empty($criteria['ZipCode']['geo']['radius'])) {
				$radius = $criteria['ZipCode']['geo']['radius'];
				if ($radius == 'any') {
					$radius = '';
				}
			}
			
			$country = isset($criteria['Country']['multi_like'][0]) ? $criteria['Country']['multi_like'][0] : '';
			foreach ($countryCodes as $name => $key) {
				if ($country == $name) {
					$country = $key;
					break;
				}
			}
			$sortBy = SJB_Settings::getSettingByName('simplyHiredSortBy');
			$url = "http://api.simplyhired.com/a/jobs-api/xml-v2/q-{$keywords}/l-{$location}/mi-$radius/ws-$limit/pn-{$params->listing_search_structure['current_page']}/sb-{$sortBy}?pshid={$publisherID}&ssty=2&cflg=r&jbd=sapjobsdirect.jobamatic.com&clip={$ip}";
			
			$sxml = new simplexml();
			$tree = $sxml->xml_load_file($url, 'array');
					
			$simplyhiredListings = array();
			$totalResults = 0;

			if ($tree !== false) {

				$results = isset($tree['rs'])?$tree['rs']:array();	
				$outputCountry = array_flip($countryCodes);

				foreach ($results as $node) {

					foreach ($node as $key => $result) {
						$state     = (string) $result['loc']['@attributes']['st'];
						$country   = (string) $result['loc']['@attributes']['country'];

						$simplyhiredListings [$key] = array(
							'Title'          => (string) $result['jt'],
							'CompanyName'    => (string) $result['cn']['@content'],
							'JobDescription' => (string) $result['e'],
							'City'           => (string) $result['loc']['@attributes']['cty'],
							'State'          => empty($location[1]) ? '' : $stateIndexes [ strtoupper($state) ],
							'Country'        => empty($country) ? '' : $outputCountry [ strtolower($country) ],
							'activation_date'=> (string) $result['dp'],
							'url'            => (string) $result['src']['@attributes']['url'],
							'api'			 => 'simplyHired', 
							'code'			 => '<div class="apiCode"><a STYLE="text-decoration:none" href="http://www.simplyhired.com/"><span style="color: rgb(0, 0, 0);">Jobs</span></a> by <a STYLE="text-decoration:none" href="http://www.simplyhired.com/"><span style="color: rgb(0, 159, 223); font-weight: bold;">Simply</span><span style="color: rgb(163, 204, 64); font-weight: bold;">Hired</span></a></div>'
						);
					}
				}
			}
			self::$simplyhiredListings = $simplyhiredListings;
		}
		return $params;
	}
	
	public static function addSimplyHiredListingsToListingStructure($listings_structure)
	{
		foreach (self::$simplyhiredListings as $key => $simplyhiredListing) {
			$listings_structure['simplyhired_'.$key] = $simplyhiredListing;
		}
		return $listings_structure;
	}
}