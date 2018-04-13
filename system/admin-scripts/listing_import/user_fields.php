<?php
require_once("users/UserGroup/UserGroupManager.php");
require_once("users/User/UserDetails.php");
require_once ("simpleXML/simplexml.class.php");
require_once ("listing_import/function.php");
require_once("users/UserGroup/UserGroupManager.php");

$tp = SJB_System::getTemplateProcessor ();

$errors       = array ();
$selected     = array ();
$a_selected   = array ();
$defaultValue = array();

$user_group_sid = SJB_Request::getVar('user_group_sid');
$id       = SJB_Request::getVar('id', 0);
$tree     = '';
$username = '';

if ($id > 0) { // load exist parser
	$parser_from_id = getSystemParsers ( $id );
	if (isset($parser_from_id [0] ['name'])) {
		$parser_from_id = $parser_from_id[0];
	}
	$xml = $parser_from_id ['xml'];
	$xml = cleanXmlFromImport ( $xml );
	$username = $parser_from_id ['username'];
	$defaultValue = ($parser_from_id ['default_value_user'] != '')?unserialize($parser_from_id ['default_value_user']):array();
	if ($parser_from_id ['maper_user'] != '') {
		$map = unserialize ( $parser_from_id ['maper_user'] );
		foreach ($map as $key => $val){
			unset($map[$key]);
			$map[str_replace('@', '_dog_', $key)] = $val;
			$map[str_replace(':', '_col_', $key)] = $val;
		}
		$selected = array_values ( $map );
		$a_selected = array_keys ( $map );
	}
} else {
	$xml = cleanXmlFromImport ( base64_decode($_REQUEST ['xml']) );
}

$sxml = new simplexml ( );
$xml = stripslashes($xml);
$tree = $sxml->xml_load_file ( $xml, 'array' );
if (isset($tree['@content'])) {
	$tree = $tree[0];
}

if (is_array ( $tree )) {
	$tree = convertArray ( $tree );
	foreach ($tree as $key => $val) {
		unset($tree[$key]);
		$tree[$key]['val'] = $val;
		$tree[$key]['key'] = str_replace('@', '_dog_', $key);
		$tree[$key]['key'] = str_replace(':', '_col_', $key);
	}
	$user_profile_fields = SJB_UserDetails::getDetails($user_group_sid);
	foreach ($user_profile_fields as $key => $val) {
		if($val['id'] == 'username') {
			unset($user_profile_fields[$key]); break;
		}
	}
}
else {
	$errors [] = 'XML syntaxis error.';
}

$tp->assign ( 'username', $username);
$tp->assign ( 'id', $id );
$tp->assign ( 'selecteduser', $selected );
$tp->assign ( 'a_selecteduser', $a_selected );
$tp->assign ( 'xml', htmlspecialchars($xml ));
$tp->assign ( 'errors', $errors );
$tp->assign ( 'tree', $tree );
$tp->assign ( "fields", $user_profile_fields );
$tp->assign ( 'user_default_value', $defaultValue );

$tp->display ( 'user_fields.tpl' );

?>