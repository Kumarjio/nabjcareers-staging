<?php

require_once 'users/UserProfileField/UserProfileFieldTreeManager.php';
require_once 'miscellaneous/TreeHelper.php';

$id = (isset($_GET['id']) ? intval($_GET['id']) : 0);
$name = SJB_Request::getVar('name', '');
$checked = (isset($_GET['check']) ? explode(',', $_GET['check']) : array());
$search = (isset($_GET['search']) ? true : false);

function haveSelectedChildren($id, $checked, $tree_values)
{
	$co = 0;
	foreach ($checked as $one) {
		foreach ($tree_values[$id] as $item) {
			if ($one == $item['sid']) $co++;
		}
	}
	if ($co == count($tree_values[$id]))
		return ' checked';
	if ($co > 0)
		return ' half_checked';
	return '';
}

$tree = '';
$tree_values = SJB_UserProfileFieldTreeManager::getTreeValuesBySID($id);
$tree = SJB_TreeHelper::get_tree_recurse_fixed($name, $id, $tree_values, $checked, 0, $search);

echo $tree;
exit;
