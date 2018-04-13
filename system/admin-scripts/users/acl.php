<?php
$acl = SJB_Acl::getInstance();
$type = SJB_Request::getVar('type', '');
$role = SJB_Request::getVar('role', '');
$user_group_id = SJB_Request::getVar('user_group_id', '');
$tp = SJB_System::getTemplateProcessor();
$resources = $acl->getResources();

switch (SJB_Request::getVar('action')) {
    case 'save':
    	SJB_Acl::clearPermissions($type, $role);
        foreach ($resources as $name => $resource) {
        	SJB_Acl::allow($name, $type, $role, SJB_Request::getVar($name, ''), SJB_Request::getVar($name . '_params'));
        }
        
		if ($type == 'plan' && SJB_Request::getVar('update_users', 0) == 1) {
			$contracts =  SJB_ContractManager::getAllContractsByMemebershipPlanSID($role);
			foreach ($contracts as $contract_id) {
				SJB_Acl::clearPermissions('contract', $contract_id['id']);
            	SJB_DB::query("insert into `permissions` (`type`, `role`, `name`, `value`, `params`)"
                    . " select 'contract', ?s, `name`, `value`, `params` from `permissions` "
                    . " where `type` = 'plan' and `role` = ?s", $contract_id['id'], $role);
			}
		}
        
        break;
    default:
        break;
}

$acl = SJB_Acl::getInstance(true);
$resources = $acl->getResources($type);
$perms = SJB_DB::query('select * from `permissions` where `type` = ?s and `role` = ?s', $type, $role);
foreach ($resources as $key => $resource) {
    $resources[$key]['value'] = 'inherit';
    $resources[$key]['name'] = $key;
    foreach ($perms as $perm) {
        if ($key == $perm['name']) {
            $resources[$key]['value'] = $perm['value'];
            $resources[$key]['params'] = $perm['params'];
            break;
        }
    }
}

$tp->assign('resources', $resources);
$tp->assign('type', $type);
$tp->assign('listingTypes', SJB_ListingTypeManager::getAllListingTypesInfo());
$tp->assign('role', $role);
$tp->assign('user_group_id', $user_group_id);

switch ($type) {
    case 'group':
        $tp->assign('userGroupInfo', SJB_UserGroupManager::getUserGroupInfoBySID($role));
        break;
    case 'plan':
        $tp->assign("membershipPlanInfo", SJB_MembershipPlanManager::getMembershipPlanInfoByID($role));
        break;
}

$tp->display('acl.tpl');