<?php
require_once('admin.php');
class SJB_SubAdmin extends SJB_Admin
{
	static private $subAdminInfo = null;

	/**
	 * @package Users
	 * @subpackage Administrators
	 */
	/**
	 * authorizing administrator
	 *
	 * Function checks if there's active administrator.
	 * If it is, then it return true. If it's not it outputs
	 * form for logging into system untill administrator logins system
	 *
	 * @return bool 'true' administrator has authorized or 'false' otherwise
	 */
	function admin_auth()
	{
		$err_m = '<p>&nbsp;</p>';
		if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'login')
		{
			if (self::admin_login($_REQUEST['username'], $_REQUEST['password']))
				return true;
		}
//		echo SJB_Admin::admin_auth_page($err_m);
		return false;
	}

	/**
	 * checking for existing authorized administrator
	 *
	 * Function checks if administrator has authorized
	 *
	 * @return 'true' if administrator has authorized or 'false' otherwise
	 */
	public static function admin_authed()
	{
		if (isset ($_SESSION['username'], $_SESSION['usertype']) && $_SESSION['usertype'] == "subadmin" )
		{
			return self::setAdminInfo( $_SESSION['username'] );
		}
		return false;
	}
	
	/**
	 * logging into system as administrator
	 *
	 * Function logs administrator into system.
	 * If operation succeded it registers session variables 'username' and 'usertype'
	 *
	 * @param string $username user's name
	 * @param string $password user's password
	 * @return bool 'true' if operation succeeded or 'false' otherwise
	 */
	function admin_login( $username, $password )
	{
		$username = mysql_real_escape_string($username);
		$password = md5(mysql_real_escape_string($password)) ;
		$sql = "SELECT * FROM `subadmins` WHERE `username` = '$username' AND `password` = '$password'";
		$res = mysql_query($sql);
		if ($res === FALSE)
			return false;

		if (mysql_num_rows($res) !== 1)
			return false;
		$row = mysql_fetch_assoc($res);
		$_SESSION['username'] = $row['username'];
		$_SESSION['usertype'] = "subadmin";
		setcookie("admin_mode", 'on', null, '/' );
		self::$subAdminInfo = $row;
		
//		$acl = SJB_SubAdminAcl::getInstance();
//		$acl->setCurrentSubAdmin( $row );
		
		return true;
	}

	public static function checkCurrentPassword($sPassword)
	{
		return (strcmp(self::$subAdminInfo['password'], md5($sPassword)) === 0 );
	}

	public static function setAdminInfo( $username )
	{
		$result = SJB_DB::query('SELECT * FROM `subadmins` WHERE `username` = ?s ', $username);
		if (!empty($result))
		{
			self::$subAdminInfo = $result[0];
			return true;
		}
		return false;
	}

	public static function getSubAdminSID()
	{
		if ( isset( self::$subAdminInfo['sid'] ) )
		{
			return self::$subAdminInfo['sid'];
		}

		return null;
	}

	public static function getSubAdminInfo()
	{
		return self::$subAdminInfo;
	}

	/**
	 * logging administrator out of system
	 *
	 * Function logs administrator out of system
	 */
	function admin_log_out()
	{
		unset ($_SESSION['username']);
		unset ($_SESSION['usertype']);
		unset ($_SESSION['admintype']);
		setcookie("admin_mode", '', time()-3600, '/');
	}
	
}
