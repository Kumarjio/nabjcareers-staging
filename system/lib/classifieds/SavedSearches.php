<?php

/**
 * @version $Id: SavedSearches.php 4178 2010-10-26 10:03:11Z kloto $
 */

/**
 * Saved Searches manager
 */
class SJB_SavedSearches {
    
    function saveSearchInCookie($requested_data, $search_name, &$errors) {
        
        $cookie =& SJB_Cookie::getCookie();
        $action =& $cookie->createSetCookieAction("SAVED_SEARCHES_" . $search_name, serialize($requested_data));
        
        if ($action->canPerform()) {
            $action->perform();
            return true;
        }
        
        $errors = $action->getErrors();
        return false;
	}
	
	function getSavedSearchesFromCookie() {
		$saved_searches = array();
		foreach ($_COOKIE as $sid => $saved_search) {
			if (preg_match("/^SAVED_SEARCHES_(.*)/u", $sid, $matches)){
				$saved_searches[$sid]['name'] 	= $matches[1];
				$saved_searches[$sid]['sid'] 	= $matches[1];
				$saved_searches[$sid]['id'] 	= $matches[1];
				$saved_searches[$sid]['data'] 	= unserialize(stripslashes($saved_search));
			}
		}		
		return $saved_searches;
	}
	
	function saveSearchOnDB($requested_data, $search_name, $user_sid, $enableNotify = false, $isAlert = false, $emailFrequency = false) {		
		$is_alert = 0;
		if ($isAlert)
			$is_alert = 1;
		if ($enableNotify)
			SJB_DB::query("INSERT INTO saved_searches SET user_sid = ?n, name = ?s, data = ?s, is_alert = ?s, auto_notify = '1', last_send = CURDATE(), email_frequency=?s", $user_sid, $search_name, serialize($requested_data), $is_alert, $emailFrequency);		
		else
			SJB_DB::query("INSERT INTO saved_searches SET user_sid = ?n, name = ?s, data = ?s, is_alert = ?s, last_send = CURDATE(), email_frequency=?s", $user_sid, $search_name, serialize($requested_data), $is_alert,  $emailFrequency);		
	}
	
	function updateSearchOnDB($requested_data, $search_id, $user_sid, $search_name = false, $emailFrequency = false) {	 		
		if ($search_name)
			SJB_DB::query("UPDATE saved_searches SET data = ?s, name = ?s, email_frequency=?s WHERE sid =?n AND user_sid = ?n",serialize($requested_data), $search_name, $emailFrequency, $search_id, $user_sid );
		else {
			if ($user_sid)
				SJB_DB::query("UPDATE saved_searches SET data = ?s, email_frequency=?s WHERE sid =?n AND user_sid = ?n",serialize($requested_data), $emailFrequency, $search_id, $user_sid );
			else 
				SJB_DB::query("UPDATE saved_searches SET data = ?s, email_frequency=?s WHERE sid =?n ",serialize($requested_data), $emailFrequency, $search_id );
		}
	}

	function getSavedSearchesFromDB($user_sid) {
		$saved_searches = SJB_DB::query("SELECT *, sid AS id FROM saved_searches WHERE user_sid = ?n  AND is_alert = 0", $user_sid);
		
		foreach($saved_searches as $key => $search_info)
			$saved_searches[$key]['data'] = unserialize($search_info['data']);
		
		return $saved_searches;
	}
	
	function getSavedJobAlertFromDB($user_sid) {
		$saved_searches = SJB_DB::query("SELECT *, sid AS id FROM saved_searches WHERE user_sid = ?n AND is_alert=1", $user_sid);
		
		foreach($saved_searches as $key => $search_info)
			$saved_searches[$key]['data'] = unserialize($search_info['data']);
		
		return $saved_searches;
	}
	
	function getSavedJobAlertFromDBBySearchSID($search_sid){
		$saved_searches = SJB_DB::query("SELECT *, sid AS id FROM saved_searches WHERE  sid = ?n", $search_sid);
		
		foreach($saved_searches as $key => $search_info)
			$saved_searches[$key]['data'] = unserialize($search_info['data']);
		
		return $saved_searches;
	}
	
	function deleteSearchFromDBbySID($search_sid) {
		SJB_DB::query("DELETE FROM saved_searches WHERE sid = ?n", $search_sid);
	}
	
	function deleteSearchFromCookieBySID($search_sid) {
		setcookie("SAVED_SEARCHES_".$search_sid, null, time() + 31536000, '/');
	}
    
    function deleteUserSearchesFromDB($user_sid) {
        return SJB_DB::query("DELETE FROM saved_searches WHERE user_sid = ?n", $user_sid);
    }
	
	function disableSearchAutoNotify($user_sid, $saved_search_sid) {
		SJB_DB::query("UPDATE saved_searches SET auto_notify = '0' WHERE user_sid = ?n AND sid = ?n", $user_sid, $saved_search_sid);
	}
	
	function enableSearchAutoNotify($user_sid, $saved_search_sid) {
		SJB_DB::query("UPDATE saved_searches SET auto_notify = '1' WHERE user_sid = ?n AND sid = ?n", $user_sid, $saved_search_sid);
	}
	
	function getAutoNotifySavedSearches() {
		return SJB_DB::query("SELECT ss.*, ss.sid AS id 
							  FROM saved_searches ss 
							  INNER JOIN `users` u ON ss.`user_sid`=u.`sid`
							  WHERE ss.auto_notify = 1 
							  AND ss.is_alert = 1 
							  AND ((ss.last_send != current_date AND  (ss.email_frequency='daily' OR ss.email_frequency='')) 
							  OR (ss.last_send <= (CURDATE() - INTERVAL 7 DAY) AND  ss.email_frequency='weekly') 
							  OR (ss.last_send <= (CURDATE() - INTERVAL 1 MONTH) AND  ss.email_frequency='monthly')) 
							  AND u.`active`=1");
	}
	
	function buildCriteriaFields($criteria) {
		$criteria_fields = array();
		
		foreach($criteria as $criteria_name => $criteria_values)
			$criteria_fields[$criteria_name] = SJB_SavedSearches::buildCriterionField($criteria_name, $criteria_values);
		
		return $criteria_fields;	
	}
	
	function buildCriterionField($criteria_name, $criterion) {
		$result = array();
		if(is_array($criterion)) {
			foreach($criterion as $criterion_name => $criterion_value)		
				if ( is_array($criterion_value) ) {
					foreach($criterion_value as $ext_criterion_name => $ext_criterion_value)
						$result[] = "<input type='hidden' name='{$criteria_name}[$criterion_name][$ext_criterion_name]' value='$ext_criterion_value' />";
				}
				else {
					$result[] = "<input type='hidden' name='{$criteria_name}[$criterion_name]' value='$criterion_value' />";
				}
		}
		else {
			$result[] = "<input type='hidden' name='{$criteria_name}' value='$criterion' />";
		}
				
		return $result;
	}
}

