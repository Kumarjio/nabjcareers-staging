<?php

require_once "SearchResultsTP.php";
require_once("classifieds/RefineSearch.php");

/*
 *  SEO friendly URL for company profile
 */
if ( strpos(SJB_Navigator::getURI(), '/company/') === 0) {
    require_once("classifieds/Browse/FixedUrlParamProvider.php");
    $params = SJB_FixedUrlParamProvider::getParams();
    if (!empty($params)) {
        $companyNameAlias = str_replace('-', ' ', array_pop($params));
        $aliasUsername = SJB_UserManager::getUserNameByCompanyName($companyNameAlias);
        if (!empty($aliasUsername)) {
            $_REQUEST['username']['equal'] = $aliasUsername;
        }
    }
}

// i
if ( ! empty ( $_REQUEST['username']['equal'] ) && $rUserID = intval( $_REQUEST['username']['equal'] ) )
{
    $aliasUsername = SJB_UserManager::getUserNameByUserSID( $rUserID );
    
    if (!empty($aliasUsername))
    {
        $_REQUEST['username']['equal'] = $aliasUsername;
    }
}

$listing_type_id = isset($_REQUEST['listing_type']['equal'])? $_REQUEST['listing_type']['equal']: SJB_Session::getValue('listing_type_id');
if ($listing_type_id)
	$_REQUEST['listing_type']['equal'] = $listing_type_id;
$action = SJB_Request::getVar('action', 'search');
$request = $_REQUEST;
if (SJB_System::getSettingByName('turn_on_refine_search_'.$listing_type_id)) {
	switch ($action) {
		case 'refine':
			$searchID = SJB_Request::getVar('searchId', false);
			unset($request['searchId']);
			$criteria_saver = new SJB_ListingCriteriaSaver($searchID);
			$criteria = $criteria_saver->criteria;
			$isCriterion = 0;
			foreach ($criteria as $criteria_name => $criteriaVal) {
				if ($criteria_name != 'listing_type' && $criteria_name != 'username') {
					if (array_key_exists($criteria_name, $request)) {
						foreach ($request[$criteria_name] as $type => $value) {
							if (array_key_exists($type, $criteria[$criteria_name])) {
								$criteria[$criteria_name][$type] = array_merge($criteria[$criteria_name][$type], $request[$criteria_name][$type]);
							}
							else {
								$criteria[$criteria_name] = array_merge($criteria[$criteria_name], $request[$criteria_name]);
							}
						}
						$isCriterion = 1;
					}
				}
			}
			$criteria['action'] = 'search';
			$criteria['default_sorting_field'] = $request['default_sorting_field'];
			$criteria['default_sorting_order'] = $request['default_sorting_order'];
			$criteria['default_listings_per_page'] = $request['default_listings_per_page'];
			$criteria['results_template'] = $request['results_template'];
			if (!$isCriterion)
				$criteria = array_merge($criteria, $request);

			$request = $criteria;
		case 'undo':
			$param = SJB_Request::getVar('param', false);
			$field_type = SJB_Request::getVar('type', false);
			$value = SJB_Request::getVar('value', false);
			if ($param && $field_type && $value) {
				$searchID = SJB_Request::getVar('searchId', false);
				unset($request['searchId']);
				$criteria_saver = new SJB_ListingCriteriaSaver($searchID);
				$criteria = $criteria_saver->criteria;
				if (isset($criteria[$param][$field_type])) {
					switch ($field_type) {
						case 'geo':
							if ($criteria[$param][$field_type]['location'] == $value)
								unset($criteria[$param]);
							break;
						case 'monetary':
							if ($criteria[$param][$field_type]['not_less'] == $value)
								$criteria[$param][$field_type]['not_less'] = "";
							if ($criteria[$param][$field_type]['not_more'] == $value)
								$criteria[$param][$field_type]['not_more'] = "";
							break;
						case 'tree':
								// search params incoming as string, where params separated by ','
								// we need to undo one of them
								$params = explode(',', $criteria[$param][$field_type]);
								$params = array_flip($params);
								unset($params[$value]);
								$params = array_flip($params);
								$criteria[$param][$field_type] = implode(',', $params);
							break;
						default:
							if (is_array($criteria[$param][$field_type])) {
								foreach ($criteria[$param][$field_type] as $key => $val) {
									if ($val == $value)
										unset($criteria[$param][$field_type][$key]);
								}
							}
							else {
								unset($criteria[$param]);
							}
							break; 
					}
				}
				$criteria['default_sorting_field'] = $request['default_sorting_field'];
				$criteria['default_sorting_order'] = $request['default_sorting_order'];
				$criteria['default_listings_per_page'] = $request['default_listings_per_page'];
				$criteria['results_template'] = $request['results_template'];
						
				$request = $criteria;
			}
			break;
	}
}

$searchResultsTP = new SJB_SearchResultsTP($request, $listing_type_id);
$template = SJB_Request::getVar("results_template", "search_results.tpl");


$tp = $searchResultsTP->getChargedTemplateProcessor();
$tp->assign("listing_type_id", $listing_type_id);
$tp->display($template);