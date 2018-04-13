<?php

require_once("orm/ObjectManager.php");
require_once("User.php");
require_once("UserDBManager.php");
require_once "users/UserGroup/UserGroupManager.php";
require_once("users/Authorization.php");
require_once("membership_plan/ContractManager.php");
require_once("classifieds/SavedSearches.php");
require_once("classifieds/Listing/ListingManager.php");
require_once("rating/Rating.php");
require_once("miscellaneous/IPManager.php");

class SJB_UserManager extends SJB_ObjectManager
{
	public static function getCurrentUserInfo()
	{
		if (SJB_Authorization::isUserLoggedIn()) {
			return SJB_Authorization::getCurrentUserInfo();
		}
		
		return null;
	}

	public static function isUserLoggedIn()
	{		
		return SJB_Authorization::isUserLoggedIn();
	}

	/**
	 * Get current user
	 *
	 * @return SJB_User|null
	 */
	public static function getCurrentUser()
	{
		$user_info = SJB_UserManager::getCurrentUserInfo();
		$user = null;
		if (!is_null($user_info)) {
			$user = new SJB_User($user_info, $user_info['user_group_sid']);
			$user->setSID($user_info['sid']);
			if (isset($user_info['subuser'])) {
				$user->setSubuserInfo($user_info['subuser']);
			}
		}
		return $user;
	}

	/**
	 * Gets user object by sid
	 *
	 * @param int $user_sid
	 * @return User
	 */
	public static function getObjectBySID($user_sid)
	{
		$user_info = SJB_UserManager::getUserInfoBySID($user_sid);
		if (!is_null($user_info)) {
			$user = new SJB_User($user_info, $user_info['user_group_sid']);
			$user->setSID($user_info['sid']);
			return $user;
		}
		return null;
	}

	public static function getUserInfoBySID($user_sid)
	{
		return SJB_UserDBManager::getUserInfoBySID($user_sid);
	}

	public static function isUserActiveBySID($user_sid)
	{
		$active = SJB_DB::query("SELECT active FROM users WHERE sid = ?n", $user_sid);
		return !empty($active) ? array_pop(array_pop($active)) : null;
	}

	public static function saveUser($user)
	{
		if (!$user->isSavedInDB()) {
			$user->createActivationKey();
			$user->createVerificationKey();
		}

		SJB_UserDBManager::saveUser($user);

		if (SJB_Authorization::isUserLoggedIn()) {
			SJB_Authorization::updateCurrentUserSession();
		}

		return true;
	}

	public static function getAllUsersInfo()
	{
		return SJB_UserDBManager::getAllUsersInfo();
	}

	public static function getUsersNumberByGroupSID($user_group_sid)
	{
		$count = SJB_DB::query("SELECT COUNT(*) FROM ?w WHERE user_group_sid = ?n", "users", $user_group_sid);
		return array_pop(array_pop($count));
	}

	public static function getUserSIDsByUserGroupSID($user_group_sid)
	{
		$sql_result = SJB_DB::query("SELECT `sid` FROM `users` WHERE `user_group_sid`=?n", $user_group_sid);
		return SJB_UserManager::_getUserSIDsFromRawSIDInfo($sql_result);
	}

	public static function getUserSIDsByMembershipPlanSID($membership_plan_sid)
	{
		$sql_result = SJB_DB::query(
			"SELECT DISTINCT users.sid  
			FROM users 
			INNER JOIN contracts ON users.sid = contracts.user_sid 
			INNER JOIN membership_plans ON membership_plans.id = contracts.membership_plan_id 
			WHERE membership_plans.id=?n 
			GROUP BY users.sid", $membership_plan_sid);
		
		return SJB_UserManager::_getUserSIDsFromRawSIDInfo($sql_result);
	}

	function _getUserSIDsFromRawSIDInfo($raw_sid_info)
	{
		$result = array();
		foreach($raw_sid_info as $found_sid_info)
			$result[] = $found_sid_info['sid'];
		return $result;
	}

	public static function deleteUserByUserName($username)
	{
		if (empty($username)) {
			SJB_UserDBManager::deleteEmptyUsers();
		}

        $user_info = SJB_UserManager::getUserInfoByUserName($username);
        if ($user_info !== null) {
	        return self::deleteUserById($user_info['sid']);
        }

        return false;
	}

	public static function deleteUserById($id)
	{
        $listings = SJB_ListingDBManager::getListingsSIDByUserSID($id);
		foreach ($listings as $listing => $value) {
			SJB_ListingManager::deleteListingBySID($value);
		}

		$subusers = self::getSubusers($id);
		foreach($subusers as $subuser) {
			self::deleteUserById($subuser['sid']);			
		}

		// delete user logo file
		$user     = SJB_UserManager::getObjectBySID($id);
		if (!empty($user)) {
			$pictProp = $user->getProperty('Logo');
			if ($pictProp)
				SJB_UploadFileManager::deleteUploadedFileByID($pictProp->value);
		}
        $result = SJB_UserDBManager::deleteUserById($id) && SJB_ContractManager::deleteAllContractsByUserSID($id) && SJB_Rating::deleteRatingByUserSID($id);
        return $result && SJB_SavedSearches::deleteUserSearchesFromDB($id);
	}

	public static function activateUserByUserName($username)
	{
		return SJB_UserDBManager::activateUserByUserName($username);
	}
	
	public static function setApprovalStatusByUserName($username, $status, $reason = '')
	{
		if (trim($reason))
			return SJB_DB::query("UPDATE `users` SET `reason`=?s, `approval`=?s WHERE `username`=?s", $reason, $status, $username);
		else
			return SJB_DB::query("UPDATE `users` SET `approval`=?s WHERE `username`=?s", $status, $username);
	}
	
	public static function deactivateUserByUserName($username)
	{
		return SJB_UserDBManager::deactivateUserByUserName($username);
	}

	public static function getUserInfoByUserName($username)
	{
		return SJB_UserDBManager::getUserInfoByUserName($username);
	}

	public static function getUserInfoByUserEmail($email)
	{
		return SJB_UserDBManager::getUserInfoByUserEmail($email);
	}

	public static function login($username, $password, &$errors, $autorizeByUsername = false, $login_as_user)
	{
		$userExists = SJB_DB::query("SELECT count(*) FROM `users` WHERE `username` = ?s", $username);
		$userExists = array_pop(array_pop($userExists));

		if ($userExists && $autorizeByUsername) {
		    return true;
		}

		if ($userExists) {
			if (!$login_as_user)
				$userAuthorized = SJB_DB::query("SELECT count(*) FROM `users` WHERE `username` = ?s AND `password` = ?s", $username, md5($password));
			else
				$userAuthorized = SJB_DB::query("SELECT count(*) FROM `users` WHERE `username` = ?s AND `password` = ?s", $username, $password);
			$userAuthorized = array_pop(array_pop($userAuthorized));

			if (!$userAuthorized) {
				$errors['INVALID_PASSWORD'] = 1;
				return false;
			}
			return true;
		}

		$errors['NO_SUCH_USER'] = 1;
		return false;
	}

	public static function getCurrentUserSID()
	{
		$user_info = SJB_UserManager::getCurrentUserInfo();
		if (!is_null($user_info))
			return $user_info['sid'];
		return null;
	}

	public static function getUserNameByUserSID($user_sid)
	{
		return SJB_UserDBManager::getUserNameByUserSID($user_sid);
	}

	
	/**/
	public static function getCompanyNameByUserSID($user_sid)
	{
		return SJB_UserDBManager::getCompanyNameByUserSID($user_sid);
	}
	
	/**/
	
	
	public static function getUserSIDbyUsername($username)
	{
		$user_info = SJB_UserManager::getUserInfoByUserName($username);
		if (!empty($user_info))
			return $user_info['sid'];
		return null;
	}

	public static function getUserSIDbyEmail($email)
	{
		$user_info = SJB_UserManager::getUserInfoByUserEmail($email);
		if (!empty($user_info))
			return $user_info['sid'];
		return null;
	}

	public static function getUserSIDsLikeUsername($username)
	{
		return SJB_UserDBManager::getUserSIDsLikeUsername($username);
	}

	public static function getUserPassword($username)
	{
		$user_password = SJB_DB::query("SELECT password FROM users WHERE username = ?s", $username);
		return array_pop(array_pop($user_password));
	}

	public static function changeUserPassword($user_sid, $password)
	{
		SJB_DB::query("UPDATE `users` SET `access_token`=?s WHERE `sid`=?s", $password, $user_sid);
		return SJB_DB::query("UPDATE `users` SET `password`=?s WHERE `sid`=?s", md5($password), $user_sid);
	}

	public static function saveUserSessionKey($session_key, $user_sid)
	{
		SJB_DB::query("INSERT INTO user_sessions SET session_key = ?s, user_sid = ?n, remote_ip = ?s, user_agent = ?s, start = UNIX_TIMESTAMP()", $session_key, $user_sid, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
	}

	public static function removeUserSessionKey($session_key)
	{
		SJB_DB::query("DELETE FROM user_sessions WHERE session_key = ?s", $session_key);
	}

	public static function getUserSIDBySessionKey($session_key)
	{
		$user_sid = SJB_DB::query("SELECT user_sid FROM user_sessions WHERE session_key = ?s", $session_key);
		if (empty($user_sid))
			return null;
		return array_pop(array_pop($user_sid));
	}

	/**
	 * 
	 * @param SJB_User $user
	 */
    public static function createTemplateStructureForUser($user)
	{
		if (!$user)
			return 0;
		$user_info = parent::getObjectInfo($user);
		$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_info['system']['user_group_sid']);
		$structure = array(
            'id'				=> $user_info['system']['id'],
			'user_name'			=> $user_info['system']['username'],
			'email'				=> $user_info['system']['email'],
			'group'				=> array
									(
										'id' 		=> $user_group_info['id'],
										'caption'	=> $user_group_info['name'],
									),
			'registration_date'	=> $user_info['system']['registration_date'],
		);

		$subuserInfo = $user->getSubuserInfo();
		if (!empty($subuserInfo)) {
			$structure['subuser'] = $subuserInfo;
		}

		$structure['METADATA'] = array(
			'group' => array(
				'caption' => array('type' => 'string', 'propertyID' => 'caption'),
			),
			'registration_date' => array('type' => 'date'),
		);
		$structure['METADATA'] = array_merge($structure['METADATA'], parent::getObjectMetaData($user)); 
		return array_merge($structure, $user_info['user_defined']);
	}

    public static function createTemplateStructureForCurrentUser()
	{
		return SJB_UserManager::createTemplateStructureForUser(SJB_UserManager::getCurrentUser());
	}

	/**
	 * gets all groups info
	 *
	 * @return array
	 */
	public static function getGroupsInfo($total = true)
	{
		$res = array();

		$periods = array(
			"Today" => "YEAR(CURDATE()) = YEAR(u.registration_date) AND DAYOFYEAR(CURDATE()) = DAYOFYEAR(u.registration_date)",
			"This Week" => "YEARWEEK(CURDATE()) = YEARWEEK(u.registration_date)",
			"This Month" => "YEAR(CURDATE()) = YEAR(u.registration_date) AND MONTH(CURDATE()) = MONTH(u.registration_date)");

		$user_groups_structure = SJB_UserGroupManager::createTemplateStructureForUserGroups();

		foreach ($user_groups_structure as $userGroup) {
			foreach ($periods as $key => $value) {
				$res[$userGroup["id"]]["periods"][$key] = array_shift(SJB_DB::query("
					select	ifnull(count(u.user_group_sid), 0) as `count`,
							ifnull(sum(u.active), 0) as `active`
					from users u
					where $value and u.user_group_sid = {$userGroup['sid']}"));
			}
			$res[$userGroup["id"]]["total"] = array_shift(SJB_DB::query("
				select ifnull(count(u.user_group_sid), 0) as `count`, ifnull(sum(u.active), 0) as `active`
				from users u
				where u.user_group_sid = {$userGroup['sid']}"));
			$res[$userGroup["id"]]["caption"] = $userGroup["caption"];
			$res[$userGroup["id"]]["approveInfo"] = self::getUsersApproveInfo($userGroup["sid"]);
		}
		return $res;
	}
	
	public static function getUsersApproveInfo($userGroupSID = false) 
	{
		if ($userGroupSID != false) {
			$userGroupInfo = SJB_UserGroupManager::getUserGroupInfoBySID($userGroupSID);
			if (empty($userGroupInfo['approve_user_by_admin'])) {
				return false;
			}
			$res = SJB_DB::query("
				SELECT count(*) as `count`, `approval`, `user_group_sid` 
				FROM `users` 
				WHERE `user_group_sid` = ?n 
				GROUP BY `approval`", $userGroupSID);
			
			
			$statusInfo = array();
			foreach ($res as $arr) {
				$statusInfo[$arr['approval']] = $arr['count'];
			}
			$statusInfo['user_group_sid'] = $userGroupSID;
			$statusInfo['user_group_id'] = SJB_UserGroupManager::getUserGroupIDBySID($userGroupSID);

			return $statusInfo;
		}
		
		$res = SJB_DB::query("
				SELECT count(*) as `count`, `user_group_sid`, `approval` 
				FROM `users` 
				GROUP BY `user_group_sid`, `approval`");
		
		$aprove = array();
		foreach ($res as $arr) {
			$aprove[$arr['user_group_sid']][$arr['approval']] = $arr['count'];
		}
		return $aprove;
	}

	/**
	 * gets all users info
	 *
	 * @return array
	 */
	public static function getUsersInfo()
	{
		return array_shift(SJB_DB::query("select ifnull(count(*), 0) as `count`, ifnull(sum(users.active), 0) as `active` from users"));
	}

	public static function getOnlineUsers()
	{
		$maxLifeTime = ini_get("session.gc_maxlifetime");
		$currentTime = time();

		// здесь получаем число используемых онлайн аккаунтов
		$result = SJB_DB::query("
			SELECT u.sid, ug.id as `type`, ses.*
			FROM users u, user_groups ug, session ses 
			WHERE ug.sid = u.user_group_sid 
				AND u.sid = ses.user_sid
				AND ses.time + $maxLifeTime > $currentTime 
				GROUP BY u.sid");
		
		return $result;
	}

	public static function getFeaturedProfiles($number_of_profiles)
	{
		$users_info = SJB_DB::query("SELECT u.`sid` FROM `users` u INNER JOIN `users_properties` up ON u.`sid`=up.`object_sid`  WHERE u.`featured`=1 AND u.`active`=1 AND up.`id`='Logo' AND up.`value`!='' ORDER BY RAND() LIMIT 0, ?n", $number_of_profiles);
		$users = array();
		foreach ($users_info as $user_info) {
			$user = SJB_UserManager::getObjectBySID($user_info['sid']);
			$users[] 	= !empty($user) ? SJB_UserManager::createTemplateStructureForUser($user) : null;
		}
		return $users;
	}

	public static function getMembershipPlanSIDByContractID($contractID)
	{
		$result = SJB_DB::query("SELECT `membership_plan_id` FROM `contracts` WHERE `id` = ?n", $contractID);
		return $result ? array_pop(array_pop($result)) : false;
	}

	public static function checkBan(&$errors, $bySavedUserIP = false)
	{
		$banIPs = SJB_IPManager::getAllBannedIPs();
		$userIP = $_SERVER['REMOTE_ADDR'];
		if ($bySavedUserIP) 
				$userIP = $bySavedUserIP;

		foreach ($banIPs as $banIP) {
			$ip = $banIP['value'];
			if (preg_match('#^' . str_replace('\*', '.*?', preg_quote($ip, '#')) . '$#i', $userIP)){
				$errors['BANNED_USER'] = 1;
				return true;
			}
		}
		return false;
	}
	
	public static function getUserNameByCompanyName($companyName) 
	{
		$userName = SJB_DB::query("SELECT u.`username` FROM `users` u INNER JOIN `users_properties` up ON u.`sid`=up.`object_sid` WHERE up.`id`='companyName' AND up.`value`='{$companyName}'");
		return $userName ? array_pop(array_pop($userName)) : false;
	}

	public static function getSubusers($userId)
	{
		return SJB_DB::query('SELECT `u`.* FROM `users` `u` WHERE `parent_sid` = ?n', $userId);
	}

	/**
	 * define displayName ("Message to" field ) for Private Messages
	 * @param string or integer $to
	 * @param string $displayName
	 * @return string or null
	 */
	public static function getComposeDisplayName( $to, &$displayName )
	{
		if ( empty ( $to ) ) {
			return null;
		}

		// by user's id
		$oReceiverInfo = SJB_UserManager::getUserInfoBySID( (int)$to );

		// by username
		if ( is_null ( $oReceiverInfo ) ) {
			$oReceiverInfo = SJB_UserManager::getUserInfoByUserName( $to );
		}

		/*
			 * Message to:  отображать там если есть то CompanyName
			 * если нет, то FirstName LastName
			 * если нет и того ни другого, то можно написать username
		*/
		if ( ! empty ( $oReceiverInfo['CompanyName'] ) ) {
			$displayName = $oReceiverInfo['CompanyName'];
		}
		elseif ( ! empty ( $oReceiverInfo['FirstName'] ) ) {
			$displayName = $oReceiverInfo['FirstName'] . ( ( ! empty ( $oReceiverInfo['LastName'] ) ) ? ' ' . $oReceiverInfo['LastName'] : '' );
		}
		elseif ( ! empty ( $oReceiverInfo['username'] ) ) {
			$displayName = $oReceiverInfo['username'];
		}
	}

	public static function getAllUserSystemProperties()
	{	
		$system_properties = array('id','username','email', 'membership_plan', 'user_group','active','language','featured','ip','registration_date', 'pictures');		
				
		return array(
			'system' => $system_properties,
		); 
	}
}
