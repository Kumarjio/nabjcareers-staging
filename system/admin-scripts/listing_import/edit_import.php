<?php
require_once ("simpleXML/simplexml.class.php");
require_once ("listing_import/function.php");
require_once ("classifieds/ListingType/ListingTypeManager.php");
require_once("users/UserGroup/UserGroupManager.php");

$tp = SJB_System::getTemplateProcessor ();

$errors = array ();
$original_xml = (! empty ( $_REQUEST ['xml'] ) ? $_REQUEST ['xml'] : '');
$xml = $original_xml;

$tree = '';
$listing_fields = array ();

$parsing_name = (isset ( $_REQUEST ['parser_name'] ) ? $_REQUEST ['parser_name'] : '');
$usr_name = (isset ( $_REQUEST ['parser_user'] ) ? $_REQUEST ['parser_user'] : '');
$pars_url = (isset ( $_REQUEST ['parser_url'] ) ? $_REQUEST ['parser_url'] : '');
$pars_days = (isset ( $_REQUEST ['parser_days'] ) ? intval($_REQUEST ['parser_days']) : 0);
$form_description = (isset($_POST['form_description'])?$_POST['form_description']:"");
$type_id = (isset($_POST['type_id'])?intval($_POST['type_id']):"");
$custom_script = SJB_Request::getVar('custom_script', '');
$custom_script_users = SJB_Request::getVar('custom_script_users', '');
$add_new_user = (isset($_POST['add_new_user'])?intval($_POST['add_new_user']):0);
$username = SJB_Request::getVar('username', '');
$external_id = SJB_Request::getVar('external_id', '');
$only_new_listings = SJB_Request::getVar('only_new_listings', false);
$defaultValue = array();


$id = (isset ( $_GET ['id'] ) ? intval ( $_GET ['id'] ) : 0);
$selected = array ();
$a_selected = array ();

if (! empty ( $_REQUEST ['xml'] ) || $id > 0) {
	// step 2 OR edit exist
	

	if ($id > 0) { // load exist parser

		$parser_from_id = getSystemParsers ( $id );
		if (isset($parser_from_id [0] ['name'])) {
			$parser_from_id = $parser_from_id[0];
		}
		$parsing_name = $parser_from_id ['name'];
		$usr_id = $parser_from_id ['usr_id'];
		$usr_name = $parser_from_id ['usr_name'];
		$form_description = $parser_from_id ['description'];
		$pars_url = $parser_from_id ['url'];
		$pars_days = $parser_from_id ['days'];
		$type_id = $parser_from_id ['type_id'];
		$custom_script = $parser_from_id ['custom_script'];
		$custom_script_users = $parser_from_id ['custom_script_users'];
		$add_new_user = $parser_from_id ['add_new_user'];
		$xml = $parser_from_id ['xml'];
		$xml = cleanXmlFromImport ( $xml );
		$defaultValue = ($parser_from_id ['default_value'] != '') ? unserialize($parser_from_id ['default_value']) : array();
		$username = $parser_from_id ['username'];
		$map = unserialize ( $parser_from_id ['maper'] );
		$external_id = str_replace('@', '_dog_', $parser_from_id['external_id']);
		$only_new_listings = $parser_from_id['only_new_listings'];
		foreach ($map as $key => $val){
			unset($map[$key]);
			$map[str_replace('@', '_dog_', $key)] = $val;
			$map[str_replace(':', '_col_', $key)] = $val;
		}
		$selected = array_values ( $map );
		$a_selected = array_keys ( $map );
	} else {
		
		$xml = cleanXmlFromImport ( $_REQUEST ['xml'] );
	}

	$sxml = new simplexml ( );
	$xml = stripslashes($xml);
	$tree = $sxml->xml_load_file ( $xml, 'array' );
	if (isset($tree['@content']))
	$tree = $tree[0];

	if (is_array ( $tree )) {
		
		$tree = convertArray ( $tree );
		foreach ($tree as $key => $val) {
			unset($tree[$key]);
			$tree[$key]['val'] = $val;
			$tree[$key]['key'] = str_replace('@', '_dog_', $key);
			$tree[$key]['key'] = str_replace(':', '_col_', $key);
		}
		$field_types = array (0, $type_id );
		$listing_fields = array ();
		
		foreach ( $field_types as $type ) {
			
			$listing_fields_info = SJB_ListingFieldManager::getListingFieldsInfoByListingType ( $type );
			
			$listing_field_sids = array ();
			foreach ( $listing_fields_info as $listing_field_info ) {
				$listing_field = new SJB_ListingField ( $listing_field_info );
				$listing_field->setSID ( $listing_field_info ['sid'] );
				$listing_fields [] = $listing_field->details->properties ['id']->value;
			}
		
		}
		$listing_fields [] = "date";
		$listing_fields [] = "url";
		$listing_fields [] = "external_id";
	} else {
		$errors [] = 'XML syntaxis error.';
	}

} else {
	$errors [] = 'Please input correct xml';
}

$tp->assign ( 'id', $id );
$tp->assign ( 'selected', $selected );
$tp->assign ( 'a_selected', $a_selected );
$tp->assign('xml', htmlspecialchars($xml));
$tp->assign('xmlToUser', $xml);
$tp->assign ( 'default_value', $defaultValue );

$tp->assign ( 'form_name', $parsing_name );
$tp->assign ( 'form_user', $usr_name );
$tp->assign ( 'form_user_sid', $usr_id );
$tp->assign ( 'form_url', $pars_url );
$tp->assign ( 'form_days', $pars_days );
$tp->assign('form_description', $form_description);
$tp->assign('custom_script', $custom_script);
$tp->assign('custom_script_users', $custom_script_users);
$tp->assign('username', $username);
$tp->assign('external_id', $external_id);
$tp->assign('only_new_listings', $only_new_listings);

$tp->assign('user_groups', SJB_UserGroupManager::getAllUserGroupsInfo());
$type_name = SJB_ListingTypeManager::getListingTypeIDBySID($type_id);

$tp->assign('add_new_user', $add_new_user);
$tp->assign('type_id', $type_id);
$tp->assign('type_name', $type_name);
$tp->assign ( 'errors', $errors );
$tp->assign ( 'tree', $tree );
$tp->assign ( "fields", $listing_fields );

$tp->display ( 'add_step_two.tpl' );

