<?php

require_once ("users/User/UserManager.php");
require_once ("users/User/User.php");
require_once ("users/User/UserSearcher.php");
require_once ("forms/FormCollection.php");
require_once ("users/UserGroup/UserGroupManager.php");
require_once ("miscellaneous/Notifications.php");
require_once ("classifieds/SearchEngine/PropertyAliases.php");
require_once ("classifieds/SearchEngine/SearchFormBuilder.php");
require_once ("users/User/UserCriteriaSaver.php");
require_once ("miscellaneous/IPManager.php");

require_once "classifieds/Alphabet/AlphabetManager.php";

$tp = SJB_System::getTemplateProcessor();

$page = 1;
if (!empty($_REQUEST["page"]))
	$page = intval($_REQUEST["page"]);
$items_per_page = SJB_Request::getVar('users_per_page', 50);
$errors = array();



/****** Eldar 03-04-2014 ***********/

$alphabets = SJB_AlphabetManager::getAlphabetsForDisplay();
$abArr = array();
foreach ($alphabets as $alphabet)
	$abArr[] = explode(' ', $alphabet['value']);
/****** Eldar 03-04-2014 ***********/


/********** A C T I O N S   W I T H   U S E R S **********/
$action = SJB_Request::getVar('action_name');

if ( !empty($action) ) {
	$users_sids = SJB_Request::getVar('users', array());
	$_REQUEST['restore'] = 1;
	
	switch ($action) {
		
		case  'approve':
			foreach ( $users_sids as $user_sid => $value ) {
				$username = SJB_UserManager::getUserNameByUserSID($user_sid);
				/**/
				$compname= SJB_UserManager::getCompanyNameByUserSID($user_sid);
				/**/
				SJB_UserManager::setApprovalStatusByUserName($username, 'Approved');
				SJB_UserManager::activateUserByUserName($username);
				SJB_UserDBManager::deleteActivationKeyByUsername($username);
				SJB_Notifications::sendUserApprovedLetter($user_sid);
			}
			break;
		
		case  'reject':
			$rejection_reason = SJB_Request::getVar('rejection_reason', '');
			
			foreach ( $users_sids as $user_sid => $value ) {
				$username = SJB_UserManager::getUserNameByUserSID($user_sid);
				/**/
				$compname= SJB_UserManager::getCompanyNameByUserSID($user_sid);
				/**/
				
				SJB_UserManager::setApprovalStatusByUserName($username, 'Rejected', $rejection_reason);
				SJB_UserManager::deactivateUserByUserName($username);
				SJB_Notifications::sendUserRejectedLetter($user_sid);
			}
			break;
	    
		case  'activate':
			foreach ( $users_sids as $user_sid => $value ) {
				$username = SJB_UserManager::getUserNameByUserSID($user_sid);
				/**/
				$compname= SJB_UserManager::getCompanyNameByUserSID($user_sid);
				/**/
				
				$userinfo = SJB_UserManager::getUserInfoByUserName($username);
				SJB_UserManager::activateUserByUserName($username);
				if ($userinfo['approval'] == 'Approved') {
					SJB_UserDBManager::deleteActivationKeyByUsername($username);
					SJB_Notifications::sendUserApprovedLetter($user_sid);
				}
			}
			break;
			
		case 'deactivate':
			foreach ( $users_sids as $user_sid => $value ) {
				$username = SJB_UserManager::getUserNameByUserSID($user_sid);
				/**/
				$compname= SJB_UserManager::getCompanyNameByUserSID($user_sid);
				/**/
				
				SJB_UserManager::deactivateUserByUserName($username);
			}
			break;
			
		case 'delete':
			foreach ( $users_sids as $user_sid => $value ) {
				$username = SJB_UserManager::getUserNameByUserSID($user_sid);
				/**/
				$compname= SJB_UserManager::getCompanyNameByUserSID($user_sid);
				/**/
				
				SJB_UserManager::deleteUserByUserName($username);
			}
			break;
			
 		case 'send_activation_letter':
			foreach ( $users_sids as $user_sid => $value )
				SJB_Notifications::sendUserActivationLetter($user_sid);
			break;
			
		case 'change_plan':
			$membershipPlanToChange = SJB_Request::getVar('plan_to_change');
			
			if ( empty($membershipPlanToChange) )
				$membershipPlanToChange = 0;
	
			foreach ( $users_sids as $user_sid => $value ) {
				
				$user = SJB_UserManager::getObjectBySID($user_sid);
				// UNSUBSCRIBE selected
				if ($membershipPlanToChange == 0) {
					SJB_ContractManager::deleteAllContractsByUserSID($user_sid);
				} else {
					$contract = new SJB_Contract(array('membership_plan_id' => $membershipPlanToChange));
					$contract->setUserSID($user_sid);
					$contract->saveInDB();
				}
			}
			break;
			
		case 'ban_ip':
			$cantBanUsers = array();
			foreach ( $users_sids as $user_sid => $value ) {
				$user = SJB_UserManager::getUserInfoBySID($user_sid);
				if ($user['ip'] && !SJB_IPManager::getBannedIPByValue($user['ip'])) {
					SJB_IPManager::makeIPBanned($user['ip']);
				}
				else {
					$cantBanUsers[] = $user['username'];
				}
			}
			$tp->assign('cantBanUsers', $cantBanUsers);
			break;
			
		case 'unban_ip':
			$cantUnbanIPs = array();
			foreach ( $users_sids as $user_sid => $value ) {
				$user = SJB_UserManager::getUserInfoBySID($user_sid);
				if ($user['ip'] !== '') {
					if (SJB_IPManager::getBannedIPByValue($user['ip']))
						SJB_IPManager::makeIPEnabledByValue($user['ip']);
					elseif (SJB_UserManager::checkBan($errors, $user['ip']))
						$cantUnbanIPs[] = $user['ip'];
				}
			}
			if ($cantUnbanIPs) {
				$tp->assign('rangeIPs',$cantUnbanIPs);
			}
			break;
			
	 	default:
			unset($_REQUEST['restore']);
			break;
	}
}

/***************************************************************/

$_REQUEST['action'] = 'search';
if(isset($_REQUEST['user_group_id']) && ($_REQUEST['user_group_id']=='Employer'))
{
	$_REQUEST['user_group']['equal'] = 'Employer';
	$user_group_name="Employer";
	$page_title="Employer";
}
else
{
	$_REQUEST['user_group']['equal'] = 'JobSeeker';
	$user_group_name="JobSeeker";
	$page_title="Job Seeker";
}

$user = new SJB_User();
//$user_properties = new SJB_UserProperties();
/*$user_properties->addProperty(array
					( 
						'id' => 'LastName', 
						'type' => 'text', 
						'value' => '', 
						'is_system' => true,
						'table_name' => 'users_properties',
						
					)
				);*/
$user->addProperty(array
					( 
						'id' => 'user_group', 
						'type' => 'list', 
						'value' => '', 
						'is_system' => true, 
						'list_values' => SJB_UserGroupManager::getAllUserGroupsIDsAndCaptions() 
					)
				);

$user->addProperty(array
					(
						'id' => 'registration_date', 
						'type' => 'date', 
						'value' => '', 
						'is_system' => true 
					)
				);

$user->addProperty(array (
					'id'			=> 'approval',
					'caption'		=> 'Approval',
					'type'			=> 'list',
					'list_values'	 => array(
											array(
											'id'		=> 'Pending',
											'caption'	=> 'Pending',
											),
											array(
											'id'		=> 'Approved',
											'caption'	=> 'Approved',
											),
											array(
											'id'		=> 'Rejected',
											'caption'	=> 'Rejected',
											)
										),
					'length'		=> '10',
					'is_required'	=> false,
					'is_system'	=> true,
					)
				);

// get array of accessible membership plans
$membershipPlansArray = SJB_MembershipPlanManager::getAllMembershipPlansInfo();
foreach ( $membershipPlansArray as $plan ) {
	$plans[] = array( 'id' => $plan['id'], 'caption' => $plan['name'] );
}

$user->addProperty(array
					(
						'id' => 'membership_plan', 
						'type' => 'list', 
						'value' => '', 
						'list_values' => $plans,
						'is_system'  => true
					)
				);

$aliases = new SJB_PropertyAliases();

$aliases->addAlias(array(
						'id' => 'user_group', 
						'real_id' => 'user_group_sid', 
						'transform_function' => 'SJB_UserGroupManager::getUserGroupSIDByID' 
					)
				);
$aliases->addAlias(array(
						'id' => 'users_properties', 
						'real_id' => 'sid', 
					)
				);
$aliases->addAlias(array(
						'id' => 'membership_plan', 
						'real_id' => 'membership_plan_id', 
					)
				);

$search_form_builder = new SJB_SearchFormBuilder($user);
$criteria_saver = new SJB_UserCriteriaSaver();

if (isset($_REQUEST['restore']))
	$_REQUEST = array_merge($_REQUEST, $criteria_saver->getCriteria());

$criteria = $search_form_builder->extractCriteriaFromRequestData($_REQUEST, $user);


$search_form_builder->setCriteria($criteria);
$search_form_builder->registerTags($tp);
if (SJB_Request::getVar('online', '') == '1')
	$tp->assign("online", true);
if(isset($_REQUEST['CompanyName']))
	$tp->assign('CompanyName', $_REQUEST['CompanyName']);

if(isset($_REQUEST['LastName']))
	$tp->assign('LastName', $_REQUEST['LastName']);

/* Search by Fisrt Name 21-05-2017 */
if(isset($_REQUEST['FirstName']))
	$tp->assign('FirstName', $_REQUEST['FirstName']);
/* END 21-05-2017 below more */

$tp->assign('plans', $plans);
$tp->assign('membership_plan', isset($_REQUEST['membership_plan']['simple_equal']) ? $_REQUEST['membership_plan']['simple_equal'] : '');
$tp->assign('user_group_name', $user_group_name);
$tp->assign('page_title', $page_title);

/******Eldar 03-04-2014 - 2 ******/
$tp->assign('alphabets', $abArr);
/******END  Eldar 03-04-2014 - 2 END  ******/

$tp->display("user_search_form.tpl");

/********************** S O R T I N G *********************/

$sorting_field = SJB_Request::getVar('sorting_field', 'registration_date');
$sorting_order = SJB_Request::getVar('sorting_order', 'DESC');
$inner_join = false;

// if search by membership_plans field
if (isset($_REQUEST['membership_plan']['simple_equal']) && $_REQUEST['membership_plan']['simple_equal'] != '') {
	switch ($sorting_field) {
		case 'user_group':
			$inner_join = array( 'user_groups' => array( 'sort_field' => 'id', 'join_field' => 'sid', 'join_field2' => 'user_group_sid', 'join' => 'INNER JOIN' ),
			 					 'contracts' => array( 'join_field' => 'user_sid', 'join_field2' => 'sid', 'join' => 'INNER JOIN' ));
			break;
		default:
			$inner_join = array( 'contracts' => array( 'join_field' => 'user_sid', 'join_field2' => 'siid', 'join' => 'INNER JOIN' ) );
			break;
	}
}
else {
	switch ($sorting_field) {
		case 'user_group':
			$inner_join = array( 'user_groups' => array( 'sort_field' => 'id', 'join_field' => 'sid', 'join_field2' => 'user_group_sid', 'join' => 'INNER JOIN') );
			break;
	}
}
if(isset($_REQUEST['user_group_id']) && $_REQUEST['user_group_id']=='JobSeeker')
{
	if (isset($_REQUEST['LastName']) && $_REQUEST['LastName'] != '') {
	
		switch ($sorting_field) {
			case 'LastName':
				$inner_join_lastname = array( 'users_properties' => array( 'sort_field' => 'value', 'join_field' => 'object_sid', 'join_field2' => 'sid', 'join' => 'LEFT JOIN','where'=>"AND users_properties.id='LastName' AND value like '%".mysql_escape_string($_REQUEST['LastName'])."%'"));
				break;
			default:
				$inner_join_lastname = array( 'users_properties' => array( 'join_field' => 'object_sid', 'join_field2' => 'sid', 'join' => 'LEFT JOIN','where'=>"AND users_properties.id='LastName' AND value like '%".mysql_escape_string($_REQUEST['LastName'])."%'")  );
				break;
		}
				
		if ($inner_join)
			$inner_join = array_merge($inner_join, $inner_join_lastname);
		else
			$inner_join = $inner_join_lastname;
		
	}
	else
	{
		switch ($sorting_field) {
		case 'LastName':
			$inner_join_lastname = array( 'users_properties' => array( 'sort_field' => 'value', 'join_field' => 'object_sid', 'join_field2' => 'sid', 'join' => 'LEFT JOIN','where'=>"AND users_properties.id='LastName'") );
			break;
		default:
			$inner_join_lastname = array( 'users_properties' => array( 'join_field' => 'object_sid', 'join_field2' => 'sid', 'join' => 'LEFT JOIN','where'=>"AND users_properties.id='LastName'") );
			break;
		}

		if ($inner_join)
			$inner_join = array_merge($inner_join, $inner_join_lastname);
		else
			$inner_join = $inner_join_lastname;
	}



	/* Search by First name 21-05-2017 */
	if (isset($_REQUEST['FirstName']) && $_REQUEST['FirstName'] != '') {
	
		switch ($sorting_field) {
			case 'FirstName':
				$inner_join_firstname = array( 'users_properties' => array( 'sort_field' => 'value', 'join_field' => 'object_sid', 'join_field2' => 'sid', 'join' => 'LEFT JOIN','where'=>"AND users_properties.id='FirstName' AND value like '%".mysql_escape_string($_REQUEST['FirstName'])."%'"));
				break;
			default:
				$inner_join_firstname = array( 'users_properties' => array( 'join_field' => 'object_sid', 'join_field2' => 'sid', 'join' => 'LEFT JOIN','where'=>"AND users_properties.id='FirstName' AND value like '%".mysql_escape_string($_REQUEST['FirstName'])."%'")  );
				break;
		}
	
		if ($inner_join)
			$inner_join = array_merge($inner_join, $inner_join_firstname);
		else
			$inner_join = $inner_join_firstname;
	
	}
	else
	{
		switch ($sorting_field) {
			case 'FirstName':
				$inner_join_firstname = array( 'users_properties' => array( 'sort_field' => 'value', 'join_field' => 'object_sid', 'join_field2' => 'sid', 'join' => 'LEFT JOIN','where'=>"AND users_properties.id='FirstName'") );
				break;
			default:
				$inner_join_firstname = array( 'users_properties' => array( 'join_field' => 'object_sid', 'join_field2' => 'sid', 'join' => 'LEFT JOIN','where'=>"AND users_properties.id='FirstName'") );
				break;
		}
	
		if ($inner_join)
			$inner_join = array_merge($inner_join, $inner_join_firstname);
		else
			$inner_join = $inner_join_firstname;
	}
	/* END 21-05-2017 */




}
if(isset($_REQUEST['user_group_id']) && $_REQUEST['user_group_id']=='Employer')
{
	if (isset($_REQUEST['CompanyName']) && $_REQUEST['CompanyName'] != '') {
		
		switch ($sorting_field) {
			case 'CompanyName':
				$inner_join_companyname = array( 'users_properties' => array( 'sort_field' => 'value', 'join_field' => 'object_sid', 'join_field2' => 'sid', 'join' => 'LEFT JOIN','where'=>"AND users_properties.id='CompanyName' AND value like '%".mysql_escape_string($_REQUEST['CompanyName'])."%'"));
				break;
			default:
				$inner_join_companyname = array( 'users_properties' => array( 'join_field' => 'object_sid', 'join_field2' => 'sid', 'join' => 'LEFT JOIN','where'=>"AND users_properties.id='CompanyName' AND value like '%".mysql_escape_string($_REQUEST['CompanyName'])."%'")  );
				break;
		}
		
		if ($inner_join)
			$inner_join = array_merge($inner_join, $inner_join_companyname);
		else
			$inner_join = $inner_join_companyname;
		
	}
	else
	{
		switch ($sorting_field) {
		case 'CompanyName':
			$inner_join_companyname = array( 'users_properties' => array( 'sort_field' => 'value', 'join_field' => 'object_sid', 'join_field2' => 'sid', 'join' => 'LEFT JOIN','where'=>"AND users_properties.id='CompanyName'") );
			break;
		default:
				$inner_join_companyname = array( 'users_properties' => array( 'join_field' => 'object_sid', 'join_field2' => 'sid', 'join' => 'LEFT JOIN','where'=>"AND users_properties.id='CompanyName'") );
				break;
		}
		
		if ($inner_join)
			$inner_join = array_merge($inner_join, $inner_join_companyname);
		else
			$inner_join = $inner_join_companyname;
	}
}
if (SJB_Request::getVar('online', '') == '1') {
	$maxLifeTime = ini_get("session.gc_maxlifetime");
	$currentTime = time();
	$innerJoinOnline = array( 'session' => array( 'join_field' => 'user_sid', 'join_field2' => 'sid', 'select_field' => 'session_id', 'join' => 'INNER JOIN', 'where' => "AND `session`.time + $maxLifeTime > $currentTime " ) );
	if ($inner_join)
		$inner_join = array_merge($inner_join, $innerJoinOnline);
	else
		$inner_join = $innerJoinOnline;
		
	$inner_join = array_merge($inner_join,array('where' => "AND user_group ='JobSeeker'" ));	
}
$searcher = new SJB_UserSearcher(array('limit'=>($page - 1) * $items_per_page, 'num_rows'=>$items_per_page), $sorting_field, $sorting_order, $inner_join);

$found_users = array();
$found_users_sids = array();
//echo "<pre>";
//print_r($criteria);
//die;
if (SJB_Request::getVar('action', '') == 'search') {
	
	$found_users = $searcher->getObjectsSIDsByCriteria($criteria, $aliases);
		
	$criteria_saver->setSession($_REQUEST, $searcher->getFoundObjectSIDs());

} elseif (isset($_REQUEST['restore'])) {
	$found_users = $criteria_saver->getObjectsFromSession();
}


foreach ( $found_users as $id => $userID ) {
	$user_info = SJB_UserManager::getUserInfoBySID($userID);
	$user_group_id = SJB_UserGroupManager::getUserGroupNameBySID($user_info['user_group_sid']);
	$registration_date = $user_info['registration_date'];
	if (SJB_UserManager::checkBan($errors, $user_info['ip'])) {
		$user_info['ip_is_banned'] = 1;
	}
	$password = $user_info['password'];
	// get user membership plan info
	$contractInfo = SJB_ContractManager::getAllContractsInfoByUserSID($user_info['sid']);
	if ( $contractInfo ) {
		$i = 0;
		foreach ($contractInfo as $contract) {
			$membershipPlanInfo = SJB_MembershipPlanManager::getMembershipPlanInfoByID($contract['membership_plan_id']);
			$user_info['membership_plan'][$i]['name'] = $membershipPlanInfo['name'];
			$user_info['membership_plan'][$i]['id'] = $contract['id'];
			$i++;
		}
	} else {
		$user_info['membership_plan'] = '';
	}
	$user_info['user_group'] = $user_group_id;
	$found_users[$id] = $user_info;
}
// for compatible with PHP4
global $affectedRows__;

$usersCount =$affectedRows__;

$sorted_found_users_sids = $found_users_sids;

/****************************************************************/

$pages = array();
for($i = $page - 3; $i < $page + 3; $i ++) {
	if ($i > 0)
		$pages[] = $i;
	if ($i * $items_per_page > $usersCount)
		break;
}

$totalPages = ceil($usersCount / $items_per_page);
if (empty($totalPages))
	$totalPages = 1;

if (array_search(1, $pages) === false)
	array_unshift($pages, 1);
if (array_search($totalPages, $pages) === false)
	array_push($pages, $totalPages);
	
$ApproveByAdminChecked = SJB_UserGroupManager::isApproveByAdminChecked();

$tp->assign("ApproveByAdminChecked", $ApproveByAdminChecked);
$tp->assign("currentPage", $page);
$tp->assign("totalPages", $totalPages);
$tp->assign("pages", $pages);
$tp->assign("usersCount", $usersCount);
$tp->assign("found_users", $found_users);
$searchFields = '';
foreach ( $_REQUEST as $key => $val ) {
	if (is_array($val)) {
		foreach ( $val as $fieldName => $fieldValue ) {
			$searchFields .= "&{$key}[{$fieldName}]={$fieldValue}";
		}
	}
}
$tp->assign("searchFields", $searchFields);

$tp->assign("sorting_field", $sorting_field);
$tp->assign("sorting_order", $sorting_order);
$tp->assign("users_per_page", $items_per_page);
$tp->assign("found_users_sids", $sorted_found_users_sids);


$tp->display("users.tpl");
