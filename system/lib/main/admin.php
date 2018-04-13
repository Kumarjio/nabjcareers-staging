<?php

class SJB_Admin
{
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
		$err_m = '';
		if (isset ($_REQUEST['action']) && $_REQUEST['action'] == 'login')
		{
			if (SJB_Admin::admin_login($_REQUEST['username'], $_REQUEST['password'])
					|| SJB_SubAdmin::admin_auth())
				return true;
			else
				$err_m = 'The username or password you entered is incorrect';
		}
		echo SJB_Admin::admin_auth_page($err_m);
		return false;
	}

	function admin_auth_page($err_m)
	{
		$tp = SJB_System::getTemplateProcessor ();
		$params = SJB_HelperFunctions::form(array ('action' => 'login') + SJB_HelperFunctions::get_request_data_params());
		$info_file_path = $GLOBALS['GLOBALS']['PATH_BASE'].'/packageinfo.txt';
		$file_lines = false;
		if (file_exists($info_file_path))
			$file_lines = file($info_file_path);
			
		if ($file_lines && (count($file_lines) > 0)) {
			foreach($file_lines as $file_line) {
				if ($prod_version = preg_replace('/(SmartJobBoard\s*)(.*)/i', '$2', $file_line))
					break;
			}
		}
		else
			$prod_version = 'v '. SJB_System::getSystemSettings('SJB_VERSION');
		
		$tp->assign( 'form_hidden_params', $params );
		$tp->assign( 'ERROR', $err_m );
		$tp->assign( 'sjb_version', $prod_version );
		return $tp->fetch('auth.tpl');
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
		if (isset ($_SESSION['username'], $_SESSION['usertype']) && $_SESSION['usertype'] == "admin" )
			return true;
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
	function admin_login($username, $password)
	{
		$username = mysql_real_escape_string($username);
		$password = md5(mysql_real_escape_string($password)) ;
		$sql = "SELECT * FROM `administrator` WHERE `username` = '$username' AND `password` = '$password'";
		$res = mysql_query($sql);
		if ($res === FALSE)
			return false;

		if (mysql_num_rows($res) !== 1)
			return false;
		$row = mysql_fetch_assoc($res);
		$_SESSION['username'] = $row['username'];
		$_SESSION['usertype'] = "admin";
		setcookie("admin_mode", 'on', null, '/' );
		
		return true;
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
		setcookie("admin_mode", '', time()-3600, '/');
	}
	
	function NeedShowSplashScreen()
	{
		return (isset ($_REQUEST['showsplash']) && $_REQUEST['showsplash'] === 'true');
	}
	
	function ShowSplashScreen()
	{
		include(SJB_System::getSystemSettings('ADMIN_SPLASH_SCREEN_URL'));
	}
}
