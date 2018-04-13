<?php


class SJB_SavedListings {
	
	function saveListingInCookie($listing_sid) {
		$saved_listings = SJB_SavedListings::getSavedListingsFromCookie();
		array_push($saved_listings, $listing_sid);
		$saved_listings = array_unique($saved_listings);
		setcookie("SAVED_LISTINGS", implode(',', $saved_listings), time() + 31536000, '/');
	}
	
	function getSavedListingsFromCookie() {
		$saved_listings = isset($_COOKIE['SAVED_LISTINGS']) ? explode(',', $_COOKIE['SAVED_LISTINGS']) : array();
		return $saved_listings;
	}
	
	function saveListingOnDB($listing_sid, $user_sid) {
		$record_exists = SJB_DB::query("SELECT COUNT(*) FROM saved_listings WHERE user_sid = ?n AND listing_sid = ?n", $user_sid, $listing_sid);
		$record_exists = array_pop(array_pop($record_exists));
		if (!$record_exists)
			SJB_DB::query("INSERT INTO saved_listings SET listing_sid = ?n, user_sid = ?n", $listing_sid, $user_sid);	
	}
	
	function saveNoteOnDB($user_sid, $listing_sid, $note) {
		$note = htmlentities($note, ENT_COMPAT, 'UTF-8');
		return SJB_DB::query("UPDATE saved_listings SET note = ?s WHERE listing_sid = ?n AND user_sid = ?n", $note, $listing_sid, $user_sid);	
	}
	
	function getSavedListingsFromDB($user_sid)
	{
		$saved_listings = SJB_DB::query("SELECT * FROM saved_listings WHERE user_sid = ?n", $user_sid);
		return $saved_listings;
	}
	
	function  getSavedListingsByUserAndListingSid($user_sid, $listing_sid) {
		$saved_listings = SJB_DB::query("SELECT * FROM saved_listings WHERE listing_sid = ?n AND user_sid = ?n", $listing_sid, $user_sid);
		$saved_listings = $saved_listings?array_pop($saved_listings):$saved_listings;
		return $saved_listings;
	}
	
	function deleteListingFromDBBySID($listing_sid, $user_sid)
	{
		SJB_DB::query("DELETE FROM saved_listings WHERE user_sid = ?n AND listing_sid = ?n", $user_sid, $listing_sid);
	}
	
	function deleteListingFromCookieBySID($listing_sid)
	{
		$saved_listings = SJB_SavedListings::getSavedListingsFromCookie();
		if (in_array($listing_sid, $saved_listings)) {
			unset($saved_listings[array_search($listing_sid, $saved_listings)]);
			setcookie("SAVED_LISTINGS", implode(',', $saved_listings), time() + 31536000, '/');
		}
	}
}

