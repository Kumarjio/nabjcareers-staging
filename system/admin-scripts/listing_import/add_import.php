<?php

require_once "listing_import/function.php";
require_once "classifieds/ListingType/ListingTypeManager.php";
require_once "users/User/UserManager.php";
require_once "simpleXML/simplexml.class.php";
require_once "users/UserGroup/UserGroupManager.php";


$tp = SJB_System::getTemplateProcessor();

$errors = array();

$add_level = SJB_Request::getVar('add_level', 1);

// check for errors
if ($add_level == '3') {
	$selectUserType = SJB_Request::getVar('selectUserType');
	$addNewUser = 0;
	if ($selectUserType == 'username') {
		$usr_name = (isset($_REQUEST['parser_user']) ? mysql_real_escape_string($_REQUEST['parser_user']) : '');
		$usr_id = SJB_UserManager::getUserSIDbyUsername($usr_name);
		if (empty($usr_name)) {
			$errors[] = 'Please enter user name of existing user to the "User Name" field';
			$usr_name = '';
		} else {
			$user_sid_exists = SJB_UserManager::getUserSIDbyUsername($usr_name);
			if (empty($user_sid_exists)) {
				$errors[] = 'User "'.$usr_name.'" not exists. Please enter user name of existing user to the "User Name" field';
				$usr_name = '';
			}
		}
	}
	elseif ($selectUserType == 'group') {
		$userGroupSid = (isset($_REQUEST['parser_user']) ? $_REQUEST['parser_user'] : 0);
		$usr_id = $userGroupSid;
		$usr_name = SJB_UserGroupManager::getUserGroupIDBySID($usr_id);
		$addNewUser = 1;
	}

	if ($errors) {
		$add_level = 2;
	}
}



$listings_type = SJB_ListingTypeManager::getAllListingTypesInfo();
$types = array();
foreach ( $listings_type as $one ) {
	$types[$one['sid']] = $one['id'];
}
$tp->assign('types', $types);
		

switch ($add_level) {
	
	case '1':
		$template = 'add_step_one.tpl';
		/*
		$types = array();
		foreach ( $listings_type as $one ) {
			$types[$one['sid']] = $one['id'];
		}
		$tp->assign('types', $types);
		*/
		$tp->display('add_step_one.tpl');
		break;
		
		
	
	case '2':
		$template = 'add_step_two.tpl';
		
		$original_xml = SJB_Request::getVar('xml');
		$xml = $original_xml;
		
		$tree = '';
		$listing_fields = array();
		
		$parsing_name	= SJB_Request::getVar('parser_name');
		$usr_name		= SJB_Request::getVar('parser_user');
		$pars_url		= SJB_Request::getVar('parser_url');
		$pars_days		= SJB_Request::getVar('parser_days', 0);
		$form_description = SJB_Request::getVar('form_description', '', 'POST');
		$type_id		= SJB_Request::getVar('type_id', '', 'POST');
		$only_new_listings = SJB_Request::getVar('only_new_listings', 0);
		
		$id = SJB_Request::getVar('id', 0, 'GET');
		$selected = array();
		$a_selected = array();
		
		if (! empty($_REQUEST['xml']) || $id > 0) {
			// step 2 OR edit exist
			
			if ($id > 0) { // load exist parser
				
				$parser_from_id = getSystemParsers($id);
				
				if (isset($parser_from_id[0]['name'])) {
					$parser_from_id = $parser_from_id[0];
				}
				
				$parsing_name = $parser_from_id['name'];
				$usr_id = $parser_from_id['usr_id'];
				$usr_name = $parser_from_id['usr_name'];
				$form_description = $parser_from_id['description'];
				$pars_url = $parser_from_id['url'];
				$pars_days = $parser_from_id['days'];
				$type_id = $parser_from_id['type_id'];
				
				$xml = $parser_from_id['xml'];
				$xml = cleanXmlFromImport($xml);
				
				$map = unserialize($parser_from_id['maper']);
				$selected = array_values($map);
				$a_selected = array_keys($map);
			
			} else {
				$xml = cleanXmlFromImport($_REQUEST['xml']);
			}
			
			$sxml = new simplexml();
			$tree = $sxml->xml_load_file($xml, 'array');
			if (isset($tree['@content']))
				$tree = $tree[0];
			
			if (is_array($tree)) {
				
				$tree = convertArray($tree);
				foreach ($tree as $key => $val) {
					unset($tree[$key]);
					$tree[$key]['val'] = $val;
					$tree[$key]['key'] = str_replace('@', '_dog_', $key);
					$tree[$key]['key'] = str_replace(':', '_col_', $key);
				}
				$field_types = array( 0, $type_id );
				$listing_fields = array();
				
				foreach ( $field_types as $type ) {
					$listing_fields_info = SJB_ListingFieldManager::getListingFieldsInfoByListingType($type);
					$listing_field_sids = array();
					
					foreach ( $listing_fields_info as $listing_field_info ) {
						$listing_field = new SJB_ListingField($listing_field_info);
						$listing_field->setSID($listing_field_info['sid']);
						$listing_fields[] = $listing_field->details->properties['id']->value;
					}
				
				}
				$listing_fields[] = "date";
				$listing_fields[] = "url";
				$listing_fields[] = "external_id";
			} else {
				$errors[] = 'XML syntaxis error.';
				$template = 'add_step_one.tpl';
			}
		
		} else {
			$errors[] = 'Please input correct xml';
			$template = 'add_step_one.tpl';
		}
		
		$tp->assign('id', $id);
		$tp->assign('selected', $selected);
		$tp->assign('a_selected', $a_selected);
		$tp->assign('xml', htmlspecialchars($xml));
		$tp->assign('xmlToUser', $xml);
		$tp->assign('user_groups', SJB_UserGroupManager::getAllUserGroupsInfo());
		$tp->assign('form_name', $parsing_name);
		$tp->assign('form_user', $usr_name);
		$tp->assign('form_url', $pars_url);
		$tp->assign('form_days', $pars_days);
		$tp->assign('form_description', $form_description);
		$type_name = SJB_ListingTypeManager::getListingTypeIDBySID($type_id);
		$tp->assign('type_id', $type_id);
		$tp->assign('type_name', $type_name);
		$tp->assign('errors', $errors);
		$tp->assign('tree', $tree);
		$tp->assign("fields", $listing_fields);
		$tp->assign("only_new_listings", $only_new_listings);
		
		$tp->display($template);
		break;
	
		
		
	case '3':
		$parsing_name = (isset($_REQUEST['parser_name']) ? mysql_real_escape_string($_REQUEST['parser_name']) : '');
		$pars_url = (isset($_POST['parser_url']) ? mysql_real_escape_string($_POST['parser_url']) : '');
		$pars_days = (isset($_POST['parser_days']) ? intval($_POST['parser_days']) : 0);
		$form_description = (isset($_REQUEST['form_description']) ? mysql_real_escape_string($_REQUEST['form_description']) : "");
		$type_id = (isset($_POST['type_id']) ? intval($_POST['type_id']) : "");
		$script = (isset($_POST['custom_script']) && !empty($_POST['custom_script'])) ? mysql_real_escape_string($_POST['custom_script']) : "";
		$script_users = SJB_DB::quote(SJB_Request::getVar('custom_script_users', '', SJB_Request::METHOD_POST));
		$defaultValue = SJB_Request::getVar('default_value', false);
		$defaultValueUser = SJB_Request::getVar('user_default_value', false);
		
		if ($defaultValue) {
			foreach ($defaultValue as $key => $val) {
				$defaultValue[$key] = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');				
			}
		}
		if ($defaultValueUser) {
			foreach ($defaultValue as $k => $v) {
				$defaultValueUser[$val] = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
			}
		}

		$original_xml = (! empty($_POST['xml']) ? mysql_real_escape_string($_POST['xml']) : '');
		$id = (isset($_GET['id']) ? intval($_GET['id']) : 0);
		$addQuery = '';
		$username = str_replace('_dog_', '@', SJB_Request::getVar('username', ''));
		$username = str_replace('_col_', ':', SJB_Request::getVar('username', ''));
		$external_id = str_replace('_dog_', '@', SJB_Request::getVar('external_id', ''));
		$only_new_listings = SJB_Request::getVar('only_new_listings', 0);
		if (! empty($_REQUEST['mapped']) && is_array($_REQUEST['mapped']) && ! empty($original_xml) && empty($errors)) {
			// make map
			$map1 = array();
			$map2 = array();
			$serUserMap = '';

			foreach ( $_REQUEST['mapped'] as $one ) {
				$tmp = explode(':', $one);
				$map1[] = $tmp[0];
				$map2[] = $tmp[1];
			}
			if ($addNewUser == 1 &&  !empty($_REQUEST['mapped_user']) && is_array($_REQUEST['mapped_user'])) {
				// make map
				$mapUser1 = array();
				$mapUser2 = array();
				foreach ( $_REQUEST['mapped_user'] as $one ) {
					$tmp = explode(':', $one);
					$mapUser1[] = str_replace('user_', '', $tmp[0]);
					$mapUser2[] = $tmp[1];
				}
				foreach ( $mapUser1 as $key => $val ) {
					$mapUser[str_replace('_dog_', '@',$val)] = $mapUser2[$key];
					$mapUser[str_replace('_col_', ':',$val)] = $mapUser2[$key];
				}
				$serUserMap = serialize($mapUser);
			}
			//$map = array_combine($map1, $map2); // PHP5
			foreach ( $map1 as $key => $val ) {
				$map[str_replace('_dog_', '@',$val)] = $map2[$key];
				$map[str_replace('_col_', ':',$val)] = $map2[$key];
			}

			$serMap = serialize($map);

			if ( $defaultValue ) {
				foreach ($defaultValue as $key => $val)
					if ($val == '')
						unset($defaultValue[$key]);
				$defaultValue = SJB_db::quote(serialize($defaultValue));
				$addQuery .= ", default_value = '".$defaultValue."'";
			}
			if ( $defaultValueUser ){
				foreach ($defaultValueUser as $keyuser => $valuser)
					if ($valuser == '')
						unset($defaultValueUser[$keyuser]);
				$defaultValueUser = SJB_db::quote(serialize($defaultValueUser));
				$addQuery .= ", default_value_user = '".$defaultValueUser."'";
			}

			$query = "SET `custom_script_users` = '$script_users', `custom_script` = '{$script}', type_id='{$type_id}', name='{$parsing_name}', description = '{$form_description}', url='{$pars_url}', usr_id='{$usr_id}', usr_name='{$usr_name}', maper='{$serMap}', maper_user='{$serUserMap}', xml='{$original_xml}', days='{$pars_days}', add_new_user='{$addNewUser}', username='{$username}', only_new_listings='{$only_new_listings}', external_id='{$external_id}' {$addQuery}";

			if ($id > 0)
				$sql = "UPDATE `parsers` {$query} WHERE id='{$id}'";
			else
				$sql = "INSERT INTO `parsers` {$query}";

			mysql_query($sql);

			$site_url = SJB_System::getSystemSettings("SITE_URL");
			SJB_HelperFunctions::redirect($site_url . "/show-import/");
		
		} else {
			if (empty($errors))
				$errors[] = 'No data to save';

			$tp->assign('errors', $errors);
			$tp->assign('xml', htmlspecialchars($original_xml));
			$tp->assign('xmlToUser', $original_xml);
			$tp->assign('form_name', $parsing_name);
			$tp->assign('form_user', $usr_name);
			$tp->assign('form_url', $pars_url);
			$tp->assign('form_days', $pars_days);
			$tp->assign('form_description', $form_description);
			$tp->assign("only_new_listings", $only_new_listings);

			$tp->display('add_step_three.tpl');
		
		}
		break;
}