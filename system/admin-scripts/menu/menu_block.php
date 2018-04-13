<?php

$tp = SJB_System::getTemplateProcessor ();

if (SJB_SubAdmin::getSubAdminSID()) {
	require_once ('sub_admins/SubAdminAcl.php');
	$tp->assign('left_admin_menu', mark_active_itemsPermissionWith($GLOBALS['LEFT_ADMIN_MENU'], SJB_SubAdminAcl::getInstance(), SJB_SubAdmin::getSubAdminSID() ) );
	$tp->assign('subadmin', SJB_SubAdmin::getSubAdminInfo() );
}
else {
	$tp->assign('left_admin_menu', mark_active_items($GLOBALS['LEFT_ADMIN_MENU']));
}

$tp->display('admin_left_menu.tpl');

function mark_active_items($arr)
{
	foreach($arr as $key=>$items) {
		$arr[$key]['active'] = false;
		foreach($items as $item_key=>$item) {
			$arr[$key][$item_key]['active'] = false;
			$item['highlight'][] = $item['reference'];
			
			if (in_array(SJB_System::getSystemSettings('SITE_URL').$GLOBALS['uri'], $item['highlight'])) {
				$arr[$key][$item_key]['active'] = true;
				$arr[$key]['active'] = true;
			}
		}
		$arr[$key]['id'] = str_replace(' ', '_', $key);
	}
	return $arr;
}

function mark_active_itemsPermissionWith( &$arr, SJB_SubAdminAcl $acl, $subAdminSID )
{
	if (empty ($arr))
		return array();

	foreach($arr as $key=>$items) {
		$arr[$key]['active'] = false;

		foreach( $items as $item_key=>$item) {
			$allowed = false;

			if (is_array($item['perm_label'])) {
				foreach ($item['perm_label'] as $permLabel) {
					if ( $acl->isAllowed( $permLabel, $subAdminSID, 'subadmin' ) ) {
						$allowed = true;
						break;
					}
				}
			}
			else {
				// check permission for subadmins
				if ( $acl->isAllowed( $item['perm_label'], $subAdminSID, 'subadmin' )  ) {
					$allowed = true;
				}
			}
			
			if (!$allowed) {
				// remove menu from menu list
				unset( $arr[$key][$item_key] );
				continue;
			}

			$arr[$key][$item_key]['active'] = false;
			$item['highlight'][] = $item['reference'];

			if (in_array(SJB_System::getSystemSettings('SITE_URL').$GLOBALS['uri'], $item['highlight'])) {
				$arr[$key][$item_key]['active'] = true;
				$arr[$key]['active'] = true;
			}
		}
		$arr[$key]['id'] = str_replace(' ', '_', $key);

		if ( empty( $arr[$key] ) || count($arr[$key]) == 2 ) {
			unset( $arr[$key] );
		}
	}
	return $arr;
}


