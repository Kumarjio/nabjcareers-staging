<?php

require_once 'users/User/UserManager.php';
require_once 'main/admin.php';

class SJB_Acl_Resource
{
    protected $title = '';
    protected $resourceId = '';
    protected $group = 'general';
    
    public function __construct($resourceId, $title = '', $group = '')
    {
    	$this->resourceId = $resourceId;
        $this->title = $title;
        $this->group = $group;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    public function getResourceId()
    {
        return $this->resourceId;
    }
    
    public function getGroup()
    {
    	return $this->group;
    }
}

class SJB_Acl_Resource_Limitable extends SJB_Acl_Resource
{
}

class SJB_Acl
{
    /**
     * @var SJB_Acl
     */
    protected static $instance = null;
    
    /**
     * Ресурсы (то на что можно задавать привелегии)
     * @var array
     */
    protected $resources = array();
    
    protected $permissions = array();
    
    protected function __construct()
    {
    }
    
    public static function copyPermissions($plan, $contract)
    {
        SJB_DB::query("delete from `permissions` where `type` = 'contract' and `role` = ?s", $contract);
        SJB_DB::query("insert into `permissions` (`type`, `role`, `name`, `value`, `params`)"
            . " select 'contract', ?s, `name`, `value`, `params` from `permissions` "
            . " where `type` = 'plan' and `role` = ?s", $contract, $plan);
    }
    
    /**
     * @return SJB_Acl
     */
    public static function getInstance($reload = false)
    {
        if (null === self::$instance || $reload)
            self::$instance = new self();
        return self::$instance;
    }
    
    /**
     * @return array
     */
    public function getResources($type = 'all', $role = '')
    {
    	$listingTypes = SJB_ListingTypeManager::getAllListingTypesInfo();
    	
        $resources = array(
			'open_search_by_company_form' => array(
				'title' => 'Open search by company form',
        		'group' => 'general',
                'type'  => 'guest'),
			'apply_for_a_job' => array(
				'title' => 'Apply for a job',
        		'group' => 'general',
        		'type'  => 'guest'),
        );
        
        foreach ($listingTypes as $listingType) {
        	$typeId = strtolower($listingType['id']);
        	$resources = array_merge($resources, array(
        	    "open_{$typeId}_search_form" => array(
            		'title' => "Open {$listingType['name']} search form",
            		'limitable' => true,
            		'group' => $listingType['id'],
        	        'type'  => 'guest'),
        	    "view_{$typeId}_search_results" => array(
            		'title' => "View {$listingType['name']} search results",
        			'limitable' => true,
            		'group' => $listingType['id'],
        			'type'  => 'guest'),
            	"view_{$typeId}_details" => array(
            		'title' => "View {$listingType['name']} details",
            		'limitable' => true,
            		'group' => $listingType['id'],
        	        'type'  => 'guest'),
        	    "flag_{$typeId}" => array(
            		'title' => "Flag {$listingType['name']}",
            		'limitable' => false,
            		'group' => $listingType['id'],
        	        'type'  => 'guest'),
        	));
        }
        if ($type == 'guest')
        	return $resources;
        
        $resources = array_merge($resources, array(
			'delete_user_profile' => array(
				'title' => 'Delete user profile',
				'group' => 'general',
                'type'  => 'group'),
        	'use_private_messages' => array(
        		'title' => 'Use private messages',
        		'group' => 'general',
        		'type'  => 'group'),
   			"save_searches" => array(
           		'title' => "Save searches",
           		'group' => 'general',
       	        'type'  => 'group'),
           	"use_screening_questionnaires" => array(
           		'title' => "Use Screening Questionnaires",
           		'group' => 'general',
       	        'type'  => 'group'),
        	'create_sub_accounts' => array(
        		'title' => 'Create Sub Accounts',
        		'group' => 'general',
        		'type'	=> 'group'
        		),
        ));
        
        foreach ($listingTypes as $listingType) {
        	$typeId = strtolower($listingType['id']);
        	$resources = array_merge($resources, array(
            	"save_{$typeId}" => array(
            		'title' => "Save {$listingType['name']}",
            		'group' => $listingType['id'],
        			'type'  => 'group'),
            	"add_{$typeId}_comments" => array(
            		'title' => "Add {$listingType['name']} comments",
            		'group' => $listingType['id'],
        	        'type'  => 'group'),
            	"add_{$typeId}_ratings" => array(
            		'title' => "Add {$listingType['name']} ratings",
            		'group' => $listingType['id'],
        	        'type'  => 'group'),
            	"use_{$typeId}_alerts" => array(
            		'title' => "Use {$listingType['name']} alerts",
            		'group' => $listingType['id'],
        	        'type'  => 'group'),        	
        	));
        }
        
        if ($type == 'group')
           	return $resources;
           	
        $resources = array_merge($resources, array(
			'add_featured_listings' . $role => array(
				'title' => 'Add featured listings',
        		'group' => 'general',
                'type'  => 'plan'),
        ));
        
        foreach ($listingTypes as $listingType) {
        	$typeId = strtolower($listingType['id']);
        	$resources = array_merge($resources, array(
        	    "post_{$typeId}" => array(
            		'title' => "Post {$listingType['name']}",
        			'limitable' => true,
            		'group' => $listingType['id'],
        	        'type'  => 'plan'),
        	));
        }
        $resources = array_merge($resources, array(
			'bulk_job_import' . $role => array(
				'title' => 'Bulk Job Import',
        		'group' => 'Job',
                'type'  => 'plan'),
        ));
        
        
        return $resources;
    }
    
    /**
     * Можно ли?
     * @param $resource
     * @param $roleId
     */
    public function isAllowed($resource, $roleId = null, $type = 'user', $returnParams = false)
    {
        $resource = strtolower($resource);
        $role = $type . '_' . $roleId;
        if (!isset($this->permissions[$role])) {
    	    switch ($type) {
    	        case 'user':
    	        case 'guest':
    	            $userInfo = array();
	                if (null === $roleId) { // если не задан пользователь, то попробуем использовать текущего
                        $userInfo = SJB_UserManager::getCurrentUserInfo();
                        if (!empty($userInfo))
                            $roleId = $userInfo['sid'];
                        if (null === $roleId) {
                            if (SJB_Admin::admin_authed() && SJB_System::getSystemSettings ('SYSTEM_ACCESS_TYPE') == 'admin') {
                                if ($returnParams)
                                    return '';
                                return true;
                            }
                            $roleId = 'guest';
                        }
                    }
                    else {
                        $userInfo = SJB_UserManager::getUserInfoBySID($roleId);
                    }
                    
                    if ($roleId == 'guest' || $type == 'guest') {
                        $role = 'user_guest';
                        if (empty($this->permissions[$role]))
                        	$this->permissions[$role] = $this->getPermissions('guest', 'guest');
                    }
                    else {
                        $permissions = $this->getPermissions('user', $roleId);
        	            $groupPermissions = $this->getPermissions('group', $userInfo['user_group_sid']);
        	            $this->permissions['group_' . $userInfo['user_group_sid']] = $groupPermissions;
        	            $contracts = SJB_ContractManager::getAllContractsSIDsByUserSID($roleId);
        	            if (!empty($contracts)) {
        	                foreach ($contracts as $contract) {
        	                    $contractPermissions = $this->getPermissions('contract', $contract);
        	                    $this->permissions['contract_' . $contract] = $contractPermissions;
        	                    if (empty($permissions)) {
        	                        $permissions = $contractPermissions;
        	                    }
        	                    else {
        	                        $permissions = $this->mergePermissions($contractPermissions, $permissions);
        	                    }
        	                }
        	            }
        	            $this->permissions[$role] = $this->mergePermissionsWithGroup($permissions, $groupPermissions);
                    }
    	            break;
    	            
    	        case 'group':
    	            $this->permissions[$role] = $this->getPermissions($type, $roleId);
    	            break;
    	            
    	        case 'plan':
                    $planInfo = SJB_MembershipPlanManager::getMembershipPlanInfoByID($roleId);
                    if (!empty($planInfo['user_group_sid'])) {
                        $groupRole = 'group_' . $planInfo['user_group_sid'];
                        if (empty($this->permissions[$groupRole])) {
                            $this->permissions[$groupRole] = $this->getPermissions('group', $planInfo['user_group_sid']);
                        }
                        $this->permissions[$role] = $this->mergePermissionsWithGroup($this->getPermissions('plan', $roleId), $this->permissions[$groupRole]);
                    }
                    else {
                        $this->permissions[$role] = $this->getPermissions('plan', $roleId);
                    }
    	            break;
    	    }
        }
        
        if (!isset($userInfo))
        	$userInfo = SJB_UserManager::getCurrentUserInfo();
        
        $is_display_resume = (!preg_match_all("/.*\/(?:display_resume|display_job)\/(\d*)/i", $_SERVER['REQUEST_URI'], $match))? (isset($_SERVER['REDIRECT_URL']))? preg_match_all("/.*\/(?:display_resume|display_job)\/(\d*)/i", $_SERVER['REDIRECT_URL'], $match) : false : true;
        // Allow access to Resume/Job Details page if an employer has an application linked to the resume
        if (isset($userInfo) && $is_display_resume) {
        	$apps = SJB_DB::query("SELECT `a`.resume FROM `applications` `a`
						            INNER JOIN `listings` l ON
						                  `l`.`sid` = `a`.`listing_id`
						            WHERE `l`.`user_sid` = ?n AND `a`.`show_emp` = 1  ORDER BY a.`date` DESC", $userInfo['sid']);
        	
	        if (isset($match[1]) && (in_array(array("resume" => array_pop($match[1])), $apps))) {
	        	$this->permissions[$role][$resource]['value'] = "allow";
	        	$this->permissions[$role][$resource]['params'] = "";
	        }
        }
        
        if (!$returnParams)
            return isset($this->permissions[$role][$resource]['value']) && $this->permissions[$role][$resource]['value'] == 'allow';
        return empty($this->permissions[$role][$resource]['params']) ? '' : $this->permissions[$role][$resource]['params'];
    }
    
    /**
     * 
     * @param string $type
     * @param string $role
     */
    public static function clearPermissions($type, $role)
    {
    	SJB_DB::query('delete from `permissions` where `type` = ?s and `role` = ?s', $type, $role);
    }
    
    public static function allow($name, $type, $role, $value, $params = '')
    {
    	SJB_DB::query('insert into `permissions` (`name`, `type`, `role`, `value`, `params`) values (?s, ?s, ?s, ?s, ?s)',
                $name, $type, $role, $value, $params);
    }
    
    public function getPermissionParams($resource, $roleId = null, $type = 'user')
    {
        return $this->isAllowed($resource, $roleId, $type, true);
    }
    
    protected function getPermissions($type, $role)
    {
        $permissions = array();
        $rows = SJB_DB::query("select `name`, `value`, `params` from `permissions` where `type` = ?s and `role` = ?s", $type, $role);
        foreach ($rows as $row)
            $permissions[$row['name']] = array(
            	'value' => $row['value'],
                'params' => $row['params']
            );
        return $permissions;
    }
    
    protected function mergePermissions($permissions, $parentPermissions)
    {
        foreach ($permissions as $key => $permission) {
            switch ($permission['value']) {
                case 'allow':
                    if (isset($parentPermissions[$key]) && $parentPermissions[$key]['value'] == 'allow') {
                        if (empty($permissions[$key]['params']) || empty($parentPermissions[$key]['params'])) {
                            $permissions[$key]['params'] = '';
                        }
                        else {
                            $permissions[$key]['params'] = intval($permissions[$key]['params']) + intval($parentPermissions[$key]['params']);
                        }
                    }
                    break;
                    
                case 'deny':
                    if (isset($parentPermissions[$key]) && $parentPermissions[$key]['value'] == 'allow') {
                        $permissions[$key] = $parentPermissions[$key];
                    }
                    break;
                
                default:
                    if (isset($parentPermissions[$key])) {
                        $permissions[$key] = $parentPermissions[$key];
                    }
                    break;
            }
        }
        return array_merge(array_diff_key($parentPermissions, $permissions), $permissions);
    }
    
    protected function mergePermissionsWithGroup($permissions, $groupPermissions)
    {
        foreach ($permissions as $key => $permission) {
            switch ($permission['value']) {
                case 'allow':
                case 'deny':
                    break;
                
                default:
                    if (isset($groupPermissions[$key])) {
                        $permissions[$key] = $groupPermissions[$key];
                    }
                    break;
            }
        }
        return array_merge(array_diff_key($groupPermissions, $permissions), $permissions);
    }
    
}
