<?php

/**
 * @version $Id: SearchResultsTP.php 4358 2011-01-28 09:57:06Z kirill $
 */

require_once 'classifieds/SearchEngine/SearchFormBuilder.php';
require_once 'classifieds/SearchEngine/PropertyAliases.php';
require_once 'classifieds/Listing/ListingSearcher.php';
require_once 'classifieds/Listing/ListingCriteriaSaver.php';
require_once 'classifieds/Listing/ListingRequestCreator.php';
require_once 'classifieds/ListingType/ListingTypeManager.php';
require_once 'classifieds/RefineSearch.php';

class SJB_SearchResultsTP {
	
	var $requested_data;
	var $listing_type_sid;
	
	/**
	 * ListingCriteriaSaver
	 *
	 * @var SJB_ListingCriteriaSaver
	 */
	var $criteria_saver;
	var $found_listings_sids;
	var $listing_search_structure;
	var $searchId;

	function _filter_data(&$array, $key, $pattern) {
		if (isset($array[$key]) && !preg_match($pattern, $array[$key]))
			unset($array[$key]);
	}

	function SJB_SearchResultsTP($requested_data, $listing_type_id) {
 		$this->_filter_data($requested_data, 'sorting_field', '/^[_\w\d]+$/');
 		$this->_filter_data($requested_data, 'sorting_order', '/(^DESC$)|(^ASC$)/i');
 		$this->_filter_data($requested_data, 'default_sorting_field', '/^[_\w\d]+$/');
 		$this->_filter_data($requested_data, 'default_sorting_order', '/(^DESC$)|(^ASC$)/i');
		
		$this->requested_data = $requested_data;
		$this->listing_type_sid = !empty($listing_type_id) ? SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id) : 0;

		$this->searchId = microtime(true);
		if (isset($requested_data['searchId']))
			$this->searchId = $requested_data['searchId'];
		$this->criteria_saver = new SJB_ListingCriteriaSaver($this->searchId);
		$this->found_listings_sids = array();
	}

	function getChargedTemplateProcessor()
	{
		$order_info = $this->criteria_saver->getOrderInfo();
		
		if (isset($this->requested_data['sorting_field'], $this->requested_data['sorting_order'])) {
			$order_info = array(	'sorting_field'	=> $this->requested_data['sorting_field'],
									'sorting_order'	=> $this->requested_data['sorting_order']);
		}
		if (!isset($order_info['sorting_field']) && !isset($order_info['sorting_order'])) {
			$this->requested_data['sorting_field'] = $order_info['sorting_field'] = !empty($this->requested_data['default_sorting_field']) ? $this->requested_data['default_sorting_field'] : null;
			$this->requested_data['sorting_order'] = $order_info['sorting_order'] = !empty($this->requested_data['default_sorting_order']) ? $this->requested_data['default_sorting_order'] : null;
		}
		
		$this->criteria_saver->setSessionForOrderInfo($order_info);

		if ( isset($_REQUEST['show_brief_or_detailed']) ) {
			$show_brief_or_detailed = $_REQUEST['show_brief_or_detailed'];
		} elseif ($this->criteria_saver->getBriefOrDetailedSearch()) {
			$show_brief_or_detailed = $this->criteria_saver->getBriefOrDetailedSearch();			
		} else {
			$show_brief_or_detailed = 'detailed';
		}
		$this->criteria_saver->setSessionForBriefOrDetailedSearch($show_brief_or_detailed);

		$this->found_listings_sids = $this->criteria_saver->getObjectSIDs();
		if ($this->found_listings_sids === null) {
		    
		    $requireApprove = SJB_ListingTypeManager::getWaitApproveSettingByListingType($this->listing_type_sid);
			if ( $requireApprove ) {
			    $this->requested_data['status']['equal'] = 'approved';
    		}
    		$this->requested_data['active']['equal'] = '1';
    		
			$this->criteria_saver->setSessionForCriteria(array_merge($this->criteria_saver->getCriteria(), $this->requested_data));
			$this->found_listings_sids = $this->_getListingSidCollectionFromRequest();
		}

		$currentUserSid = SJB_UserManager::getCurrentUserSID();
		
		// filter by anonymous
		$criteries = $this->criteria_saver->getCriteria();
		if (isset($criteries['username'])) {
    		foreach ($this->found_listings_sids as $key=>$val) {
    			$listing_info = SJB_ListingManager::getListingInfoBySID($val);
    			if ($listing_info['anonymous'])
    				unset($this->found_listings_sids[$key]);
    		}
		}
		
		$lpp = $this->criteria_saver->getListingsPerPage();
		if (!empty($this->requested_data['default_listings_per_page']) && empty($lpp))
			$this->criteria_saver->setSessionForListingsPerPage($this->requested_data['default_listings_per_page']);	
		if (isset($this->requested_data['listings_per_page']))
			$this->criteria_saver->setSessionForListingsPerPage($this->requested_data['listings_per_page']);

		$this->criteria_saver->setSessionForCurrentPage(1);
		if (isset($this->requested_data['page']))
			$this->criteria_saver->setSessionForCurrentPage($this->requested_data['page']);

		$this->criteria_saver->setSessionForObjectSIDs($this->found_listings_sids);
		$this->listing_search_structure = $this->criteria_saver->createTemplateStructureForSearch();
		
		if (empty($this->listing_search_structure['sorting_field'])) {
	 		$this->listing_search_structure['sorting_field'] = 'activation_date';
	 	}

	 	SJB_Event::dispatch('beforeGenerateListingStructure', $this, true);
	 	
		$listings_structure = array();
		if ($this->listing_search_structure['listings_number'] > 0) {
			$listing = $this->_getEmptyListing();
			$this->found_listings_sids = $this->_getSortedSidCollection($listing);
			$this->criteria_saver->setSessionForObjectSIDs($this->found_listings_sids);
			$listings_structure = $this->getListingCollectionStructure($this->getListingSidCollectionForCurrentPage());
		}
		SJB_Event::dispatch('afterGenerateListingStructure', $listings_structure, true);
		return $this->_getChargedTemplateProcessor($listings_structure);
	}
	
	function getListingCollectionStructure($sorted_found_listings_sids_for_current_page)
	{
	    require_once('classifieds/SavedListings.php');
		$listings_structure = array();
		$currentUserSID = SJB_UserManager::getCurrentUserSID();
		$isUserLoggedIn = SJB_UserManager::isUserLoggedIn();
		foreach ($sorted_found_listings_sids_for_current_page as $sid) {
			$listing = SJB_ListingManager::getObjectBySID($sid);
			$listing->addPicturesProperty();
			$listings_structure[$listing->getID()] = SJB_ListingManager::createTemplateStructureForListing($listing);
			$listings_structure[$listing->getID()] = SJB_ListingManager::newValueFromSearchCriteria($listings_structure[$listing->getID()], $this->criteria_saver->criteria);
			if ($isUserLoggedIn) {
				$listings_structure[$listing->getID()]['saved_listing'] = SJB_SavedListings::getSavedListingsByUserAndListingSid($currentUserSID, $listing->getID());
			}
		}

		return $listings_structure;
	}
	
	function getListingSidCollectionForCurrentPage() {
		if (empty($this->listing_search_structure['listings_per_page']))
			return $this->found_listings_sids;
		
		$this->_normalizeCurrentPage();
		$listing_sids_by_page =  array_chunk($this->found_listings_sids, $this->listing_search_structure['listings_per_page'], true);
		return $listing_sids_by_page[$this->listing_search_structure['current_page'] - 1];
	}
	
	function _normalizeCurrentPage() {
	
		if ($this->listing_search_structure['current_page'] > $this->listing_search_structure['pages_number'])
			$this->listing_search_structure['current_page'] = $this->listing_search_structure['pages_number'];
		if ($this->listing_search_structure['current_page'] < 1)
			$this->listing_search_structure['current_page'] = 1;
		
	}
	
	function _getSortedSidCollection(&$listing) {
		$property = $listing->getProperty($this->listing_search_structure['sorting_field']);
		
		$orderInfo = $this->criteria_saver->getOrderInfo();
		$sorting_field = $orderInfo['sorting_field'];
		$sorting_order = $orderInfo['sorting_order'];
		
		$ids = join(', ', $this->found_listings_sids);
		$select = ' SELECT 	listings.* ';
		$from	= '	FROM listings ';
		$where	= " WHERE	listings.sid IN ($ids) ";
		switch ($sorting_field) {
			
			case 'username':
				$sql = "	$select $from LEFT JOIN users on listings.user_sid = users.sid
							$where ORDER BY listings.priority DESC, users.username $sorting_order";
				$listings_info = SJB_DB::query($sql);
				break;
				
			case 'listing_type':
				$sql = "	$select $from LEFT JOIN listing_types on listings. = listing_types.sid
							$where ORDER BY listings.priority DESC, listing_types.id $sorting_order";
				$listings_info = SJB_DB::query($sql);
				break;
				
			case 'CompanyName':
				$sql = "	$select $from
								LEFT JOIN users_properties on listings.user_sid = users_properties.object_sid
							$where AND users_properties.id = '$sorting_field'
							ORDER BY listings.priority DESC, users_properties.value $sorting_order";
				$listings_info = SJB_DB::query($sql);
				break;
								
			default:
				$listing_request_creator = new SJB_ListingRequestCreator($this->found_listings_sids, array(
					'property' => $property,
					'sorting_order' => $this->listing_search_structure['sorting_order']), array(
					'property' => 'priority',
					'sorting_order' => 'DESC'));
				$listings_info = SJB_DB::query($listing_request_creator->getRequest());
				break;
		}
		
		$listings_sids = array();

		foreach ($listings_info as $listing_info)
			$listings_sids[$listing_info['sid']] = $listing_info['sid'];

		return array_keys($listings_sids);
	}
	
	function _getChargedTemplateProcessor(&$listings_structure) {
		
		$tp = SJB_System::getTemplateProcessor();
		$searchCriteria = $this->criteria_saver->getCriteria();
		$listing_type_id = !empty($_REQUEST['listing_type_id']) ? $_REQUEST['listing_type_id'] : '';
		if (empty($searchCriteria['listing_type']) && !empty($searchCriteria['listing_type_sid']['equal'])) {
			$listing_type_id = $searchCriteria['listing_type_sid']['equal'];
			$listing_type_info = SJB_ListingTypeManager::getListingTypeInfoBySID($listing_type_id);
		} elseif(!empty($searchCriteria['listing_type']['equal'])) {
			$listing_type_id = $searchCriteria['listing_type']['equal'];
			$listing_type_info = SJB_ListingTypeManager::getListingTypeInfoBySID(SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id));
		}
		if(!empty($listing_type_info['show_brief_or_detailed'])) {
			$is_show_brief_or_detailed = $listing_type_info['show_brief_or_detailed'];
			$show_brief_or_detailed = $this->criteria_saver->getBriefOrDetailedSearch();
			$tp->assign("is_show_brief_or_detailed", $is_show_brief_or_detailed);
			$tp->assign("show_brief_or_detailed", $show_brief_or_detailed);
		}
		
		$tp->assign("sorting_field", $this->listing_search_structure['sorting_field']);
		$tp->assign("sorting_order", $this->listing_search_structure['sorting_order']);
		$tp->assign("listing_search", $this->listing_search_structure);
		$tp->assign("search_criteria", $this->criteria_saver->createTemplateStructureForCriteria());
		$tp->assign("listings", $listings_structure);
		$tp->assign("searchId", $this->searchId);
		
		$listing_structure_meta_data = array();
		foreach ($listings_structure as $listing_structure)
			if (isset($listing_structure['METADATA']))
				$listing_structure_meta_data = array_merge($listing_structure_meta_data, $listing_structure['METADATA']);
				
		if (isset($searchCriteria['username']['equal'])) {
			$userSID = SJB_UserManager::getUserSIDbyUsername($searchCriteria['username']['equal']);
			
			$user 		= SJB_UserManager::getObjectBySID($userSID);
			if (isset($searchCriteria['company_name']['equal'])) {
				$user->setPropertyValue('CompanyName', $searchCriteria['company_name']['equal']);
			}
			$userInfo	= !empty($user) ? SJB_UserManager::createTemplateStructureForUser($user) : null;
			$tp->assign("userInfo", $userInfo);
		}

		if (isset($searchCriteria['listing_type']['equal']) && SJB_System::getSettingByName('turn_on_refine_search_'.$searchCriteria['listing_type']['equal']) && $GLOBALS['uri'] !== '/job-alerts/' && $GLOBALS['uri'] !== '/resume-alerts/' && $GLOBALS['uri'] !== '/resume-alerts/' && $GLOBALS['uri'] !=='/saved-searches/') {
			if (count($this->found_listings_sids) > 1 ) {
				if ($this->found_listings_sids) {
					$listing_type_id = $searchCriteria['listing_type']['equal'];
					$listing_type_sid = SJB_ListingTypeManager::getListingTypeSIDByID($listing_type_id);
					$refineFields = SJB_RefineSearch::getFieldsByListingTypeSID($listing_type_sid);
					
					foreach ($refineFields as $key => $field) {
						 $fieldCriteria = isset($searchCriteria[$field['field_name']])?$searchCriteria[$field['field_name']]:false;
						 $search_result = SJB_RefineSearch::countListingsByFieldName($field['field_name'], $field['field_id'], $this->found_listings_sids, $field['user_field']);
						 $refineFields[$key]['search_result'] = $search_result['values'];
						 $refineFields[$key]['criteria'] = $fieldCriteria?is_array(array_pop($fieldCriteria))?array_pop($fieldCriteria):$fieldCriteria:array();
						 $refineFields[$key]['caption'] = $search_result['caption'];
						 $refineFields[$key]['count_results'] = count($search_result['values']);
						 
						 // if that elem value not in list of criteria - mark it field to show in refine search block
						 foreach ($search_result['values'] as $elem) {
						 	$elemSID  = isset($elem['sid']) ? $elem['sid'] : null;
						 	$criteria = $refineFields[$key]['criteria'];
						 	
						 	if ( !is_array($criteria)) {
						 		$refineFields[$key]['show'] = 1;
						 		continue;
						 	}
						 	if ( !in_array($elem['value'], $criteria) && (!$elemSID || ($elemSID && !in_array($elemSID, $criteria))) ) {
						 		$refineFields[$key]['show'] = 1;
						 	}
						 }
					}
					$tp->assign("refineFields", $refineFields);
				}
			}
			$currentSearch = SJB_RefineSearch::getCurrentSearchByCriteria($searchCriteria);
			$tp->assign("currentSearch", $currentSearch);
			$tp->assign("refineSearch", true);
		}
		$metaDataProvider = SJB_ObjectMother::getMetaDataProvider();
		$metadata = array("listing" => $metaDataProvider->getMetaData("Property_", $listing_structure_meta_data));
		$metadata["listing"]["user"]["group"]["caption"]["domain"] = "Miscellaneous";
		$tp->assign("METADATA", $metadata);
		
		return $tp;	
	}	
	
	function _getListingSidCollectionFromRequest() {		
		$listing = new SJB_Listing(array(), $this->listing_type_sid);
		$id_alias_info = $listing->addIDProperty();
		$listing->addActivationDateProperty();
		$username_alias_info = $listing->addUsernameProperty();
		$listing_type_id_info = $listing->addListingTypeIDProperty();
		$companyNameAliasInfo = $listing->addCompanyNameProperty();
		
		// select only accessible listings by user sid
		// see SearchCriterion.php, AccessibleCriterion class
		$this->requested_data['access_type'] = array('accessible' => SJB_UserManager::getCurrentUserSID());
		
		if (isset($this->requested_data['PostedWithin']) && $this->requested_data['PostedWithin']['multi_like'][0] != '') {
            $within_period = $this->requested_data['PostedWithin']['multi_like'][0];
            $i18n = SJB_I18N::getInstance();
            $this->requested_data['activation_date']['not_less'] = $i18n->getDate(date('Y-m-d', strtotime("- {$within_period} days")));
            unset ($this->requested_data['PostedWithin']['multi_like']);                
        }           
        $criteria = $this->criteria_saver->getCriteria();
      	if (isset($this->requested_data['CompanyName']['multi_like_and'][0])) {
      		if (SJB_Request::getVar('search') == 'company_name') {
      			// if refine search by jobg8 company name - replace search criteria
      			$this->requested_data['username']['equal']     = 'jobg8';
      			$this->requested_data['company_name']['equal'] = $this->requested_data['CompanyName']['multi_like_and'][0];
      			unset($this->requested_data['CompanyName']);
                if (isset($criteria['CompanyName'])) {
                	unset($criteria['CompanyName']);
                }
              	
      		} else {
	            $userName = SJB_UserManager::getUserNameByCompanyName($this->requested_data['CompanyName']['multi_like_and'][0]);
	            unset($this->requested_data['CompanyName']);
	            if (isset($criteria['CompanyName']))
	            	unset($criteria['CompanyName']);
	            if ($userName)
	            	$this->requested_data['username']['equal'] = $userName;
            }
         }

		$criteria = SJB_SearchFormBuilder::extractCriteriaFromRequestData(array_merge($criteria, $this->requested_data), $listing);
		
		$aliases = new SJB_PropertyAliases();
		$aliases->addAlias($id_alias_info);
		$aliases->addAlias($username_alias_info);
		$aliases->addAlias($listing_type_id_info);
		$aliases->addAlias($companyNameAliasInfo);
		
		$sortingFields = array();
		$orderInfo = $this->criteria_saver->getOrderInfo();
		$property = $listing->getProperty($orderInfo['sorting_field']);
		if (!empty($property) && $property->isSystem()) {
		    $sortingFields = array(
		        'priority' => 'desc',
		        $orderInfo['sorting_field'] => $orderInfo['sorting_order']
		    );
		}
		$searcher = new SJB_ListingSearcher();
				
		
		/********* FOR SEARCH BY USERNAME AND COMPANY NAME (Company Profile for JobG8 listings) *****/
		// search by username and company
		$company_search_name = SJB_Request::getVar('company_name', false);
		$username_search	 = SJB_Request::getVar('username', false);
		$user_sid            = SJB_Request::getVar('user_sid', false);
		
		$company_search_name = $company_search_name['equal'];
		$username_search	 = $username_search['equal'];
		$search_no_user      = false;
		
		if (SJB_Request::getVar('search_type', false) == 'company_name') {
			$company_search_name = SJB_Request::getVar('CompanyName', false);
			$company_search_name = array_pop($company_search_name['multi_like_and']);
			$search_no_user      = true;
		}
		
		if ( ($search_no_user || $username_search || $user_sid) && $company_search_name ) {
			// SEARCH BY company_name AND username (for JobG8 listings)
			if (!$user_sid) {
				$user_sid = SJB_UserManager::getUserSIDByUsername($username_search);
			}
			
			if ($search_no_user === false) {
				$main_search = SJB_DB::query("SELECT l.sid 
									FROM listings l
									LEFT JOIN listings_properties lp ON (lp.object_sid = l.sid)
									WHERE `user_sid` = ?n AND lp.id = 'company_name' AND lp.value = ?s", $user_sid, $company_search_name);
			} else {
				$main_search = SJB_DB::query("SELECT l.sid 
									FROM listings l
									LEFT JOIN listings_properties lp ON (lp.object_sid = l.sid)
									WHERE lp.id = 'company_name' AND lp.value = ?s", $company_search_name);
			}
			foreach ($main_search as $key=>$item) {
				$main_search[$key] = $item['sid'];
			}
			
		} else {
			// ORDINARY SEARCH IN LISTINGS
			$main_search = $searcher->getObjectsSIDsByCriteria($criteria, $aliases, $sortingFields);
		}
		return $main_search;			
	}
	
	function &_getEmptyListing() {
		
		$listing = new SJB_Listing(array(), $this->listing_type_sid);
		$listing->addPicturesProperty();
		$listing->addIDProperty();
		$listing->addListingTypeIDProperty();
		$listing->addActivationDateProperty();
		$listing->addUsernameProperty();
		$listing->addCompanyNameProperty();
		return $listing;
		
	}
	
}