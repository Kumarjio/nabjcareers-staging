<?php

require_once 'classifieds/ListingType/ListingTypeManager.php';
require_once 'classifieds/Listing/Listing.php';
require_once 'classifieds/Listing/ListingManager.php';
require_once 'simpleXML/simplexml.class.php';

function cleanXmlFromImport($xml)
{
	$xml = str_replace("\r", '', $xml ); // cut new line
	$xml = str_replace("\n", '', $xml ); // cut new line
	$xml = preg_replace('/&(?!amp;)/u', '&amp;', $xml ); // CUT comment
	$xml = preg_replace('#<([-a-z]*)\/>#siu', '<$1>.</$1>', $xml ); // make empty readible
	$xml = preg_replace('#(\<\!\-\-.*?\>)#siu', '', $xml ); // CUT comment
	return $xml;
}

function activate($id)
{
	SJB_DB::query("UPDATE parsers SET active='1' WHERE id='{$id}'");	
}

function deactivate($id)
{
	SJB_DB::query("UPDATE parsers SET active='0' WHERE id='{$id}'");	
}

function convertToAsData($StrData)
{
	if ($time = strtotime($StrData )) {
		return date('Y-m-d H:i:s', $time );
	}
	return $StrData;
}

function addListings($data, $usr_id, $parser_id, $script)
{
	$parser = getSystemParsers($parser_id);
	if (!isset($parser[0]))
		return;
	$parser = $parser[0];
	$import_only_new_listings = isset($parser['only_new_listings']) && $parser['only_new_listings'] == 1 ? $parser['only_new_listings'] : 0;
	$currentUser = SJB_UserManager::getObjectBySID($usr_id );
	foreach ($data as $listing) {
		if (isset($listing['userSID']))
			$user = SJB_UserManager::getObjectBySID($listing['userSID']);
		else 	
			$user = $currentUser;
			
		$listing['access_type'] = 'everyone';
		$listing['active'] = 1;
		
		if (empty($user))
			$listing['user_sid'] = '';
		else
			$listing['user_sid'] = $user->getSID();
			
		if (!isset($listing['url']))
			$listing['url'] = '';

		$external_id = isset ($listing['external_id']) ? $listing['external_id'] : '';
		$skip = false;
		if (!empty($script)) 
			eval(stripslashes($script));
		if ($skip)
			continue;
		
		// fix for new format of ApplicationSettings
		if (!empty($listing['ApplicationSettings'])) {
			if (ereg("^[a-z0-9\._-]+@[a-z0-9\._-]+\.[a-z]{2,4}\$",  $listing['ApplicationSettings'] )) {
				$listing['ApplicationSettings'] = array( 'value' => $listing['ApplicationSettings'], 'add_parameter' => 1);
			} elseif(ereg("^(http:\/\/)", $listing['ApplicationSettings'])) {
				$listing['ApplicationSettings'] = array( 'value' => $listing['ApplicationSettings'], 'add_parameter' => 2);					
			} else {
				//put empty if not valid email or url  
				$listing['ApplicationSettings'] = array( 'value' => '', 'add_parameter' => '');
			}
		}

		$listingObj = new SJB_Listing($listing, $parser['type_id']);
		$listingObj->deleteProperty('featured');
		$listingObj->deleteProperty('status');
		$listingObj->deleteProperty('reject_reason');
		$listingObj->addDataSourceProperty($parser_id);
		
		$import_listing = true;
		if (!empty($external_id)) {
			$listingObj->addExternalIdproperty($listing['external_id']);
			if ($import_only_new_listings) {
				$is_listing_exist = SJB_ListingManager::isListingExistsByExternalId($external_id);
				//Do not add listing if listing with such id exists
				if ($is_listing_exist)
					$import_listing = false;
			}
		}
		$properties = $listingObj->getProperties();
		foreach ($properties as $name => $property) {
			if ($property->type->property_info['type'] === 'tree') {
				$value = SJB_DB::query("SELECT `sid` FROM  `listing_field_tree` WHERE `caption`='$property->value'");
				$value = $value?array_pop(array_pop($value)):'';
				$listingObj->setPropertyValue($property->id, $value);
				$listingObj->getProperty($property->id)->type->property_info['value'] = $value;
			}
		}
		if ($import_listing) {
			SJB_ListingManager::saveListing($listingObj);
			SJB_ListingManager::activateListingBySID($listingObj->getSID() );
			$sid = $listingObj->getSID();
			SJB_DB::query("UPDATE listings SET expiration_date = NOW() + INTERVAL ?s DAY WHERE sid='{$sid}'", $parser['days']);
			if (empty($listing['url']))
				SJB_DB::query("INSERT INTO parsers_url SET id_parser= ?s, id_listing= ?s, url= ?s", $parser_id, $listingObj->getSID(), $listing['url']);
		}
	}
}

function getRootNode($xml)
{
	preg_match('/<(.*?)>/i', $xml, $mathc );
	if (isset($mathc[1]) && strlen($mathc[1]) > 0)
		return $mathc[1];
	return false;
}

function megaReader($root, $array)
{
	$tmp_arr = array();
	foreach ($array as $key => $val) {
		if ($key == $root) {
			$tmp_arr = array_merge($tmp_arr, $val);
		} elseif (is_array($val)) {
			$tmp_arr = array_merge($tmp_arr, megaReader($root, $val));
		}
	}
	return $tmp_arr;
}

function getListingArray($root, $tree)
{
	return megaReader($root, $tree);
}

function parseData($found, $map, $defaultValues = array())
{
	$data = array();
	foreach ($found as $one) {
		$tmp = array();
		foreach ($map as $remote => $local) {
			if (isset($one[$remote])) {
				// fix convert of &nbsp; to non-ASCII character
				$one[$remote] = str_replace("&nbsp;", " ", $one[$remote]);
				
				if (is_array($local)) {
					foreach ($local as $arr) {
						$tmp[$arr] = html_entity_decode($one[$remote]);
					}
				}
				else {
					$tmp[$local] = html_entity_decode($one[$remote]);
				}
			}
		}
		$data[] = array_merge($tmp, $defaultValues);
	}
	return $data;
}

function convertArray($array, $parent = '')
{
	$tmp = array();
	foreach ($array as $key => $val) {
		if (is_array($val)) {
			$tmp = array_merge($tmp, convertArray($val, (!is_numeric($key) ? $key : '')));
		} else {
			$tmp[(! empty($parent) ? $parent . '_' : '') . $key] = $val;
		}
	}
	return $tmp;
}

function is_multy($array)
{
	foreach ($array as $ar) {
		if (is_array($ar))
			return true;
	}
	return false;
}

function runImport($id_pars = '')
{
	$work_id = getSystemParsers($id_pars);
	$result = array('total' => 0, 'errors');
	
	foreach ($work_id as $pars) {
		$result['total']++;
		$data = '';
		$map = unserialize($pars['maper']);
		$defaultValues = ($pars['default_value'] != '')?unserialize($pars['default_value']):array();
		$defaultValuesUser  = ($pars['default_value_user'] != '')?unserialize($pars['default_value_user']):array();
		// MAP (REMOTE >> LOCAL)
		$usr_id = $pars['usr_id'];
		
		$stop_data = SJB_DB::query("SELECT activation_date FROM listings WHERE user_sid= ?s ORDER BY sid DESC LIMIT 1", $usr_id);
		$stop_data = (isset($stop_data[0]['activation_date']) ? $stop_data[0]['activation_date'] : date('Y-m-d H:i:s', mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'))));
		
		if ($root = getRootNode($pars['xml'])) {
			
			$sxml = new simplexml();
			@$tree = $sxml->xml_load_file($pars['url'], 'array');

			if (! $tree || ! is_array($tree)){
				$result['errors'][] = 'Faid open data URL, data source - '.$pars['name'];
				continue;
			}
			
			if (isset($tree['@content']))
				$tree = $tree[0];
			
			$found = getListingArray($root, $tree);
			if (!is_multy($found)) {
				$tmp = $found;	
				$found = array();
				$found[] = $tmp;
			}
							
			foreach ($found as $key => $val) {
				$found[$key] = convertArray($val);
			}
			
			// field in username to mapping it, and default mapping(incomingFieldName -> username)
			$parsUsername = $pars['username'];
			$mapUser[$parsUsername] = 'username';

			// check for non default mapping
			if ($pars['add_new_user'] == 1 && !empty($pars['maper_user'])) {
				$mapUser  = unserialize($pars['maper_user']);
				if (array_key_exists($parsUsername, $mapUser))
					$mapUser[$parsUsername] = array($mapUser[$parsUsername], 'username');
				else
					$mapUser[$parsUsername] = 'username';
			}

			$data = parseData($found, $map, $defaultValues);
			if ($pars['add_new_user'] == 1) {
				$dataUser = parseData($found, $mapUser, $defaultValuesUser);
				foreach ($dataUser as $key => $user){
					if (isset($user['username']) && $user['username'] != '') {
						$username = preg_replace('/[\\/\\\:*?\"<>|%#$\s\'-]/u', '_',html_entity_decode($user['username']));
						$username = str_replace('&', 'And', $username);
						// If user_email_as_username set to TRUE	
						$user_group_sid = $pars['usr_id'];
						if (!is_null($user_group_sid)) {
							$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid);
							if ( isset($user_group_info['user_email_as_username']) && (($user_group_info['user_email_as_username']) == true) )
								$userSID = SJB_UserManager::getUserSIDbyEmail($user['email']);
							else
								$userSID = SJB_UserManager::getUserSIDbyUsername($username);
						}
						else
							$userSID = SJB_UserManager::getUserSIDbyUsername($username);

						if (empty($userSID)) {
							$skip = false;
							$user['username'] = $username;
							$user['password']['confirmed'] = $user['password']['original'] = $username;
							if (!empty($pars['custom_script_users']))
								eval(stripslashes($pars['custom_script_users']));
							if ($skip)
								continue;
							$userObj = SJB_ObjectMother::createUser($user, $user_group_sid);
							$userObj->deleteProperty('active');
							$userObj->deleteProperty('featured');
							$userObj->deleteProperty('captcha');
							SJB_UserManager::saveUser($userObj);
							SJB_UserManager::activateUserByUserName($userObj->getUserName());
							$data[$key]['userSID'] = $userObj->getSID();
						}
						else {
							$data[$key]['userSID'] = $userSID;
						}
					}
				}
			}
			if (count($data) > 0)
				addListings($data, $usr_id, $pars['id'], $pars['custom_script']);
		} else {
			$result['errors'][] = 'Not correct XML in parser - '.$pars['name'];
			continue;
		}
	
	}
	return $result;
}

function getSystemParsers($id = '', $all = false)
{
	return SJB_DB::query("SELECT * FROM parsers WHERE " . (!empty($id)?"id='{$id}'":(!$all?"active='1'":"active='0' OR active='1'")));
}