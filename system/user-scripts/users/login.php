<?php

require_once('users/Authorization.php');
$tp = SJB_System::getTemplateProcessor();
$errors = array();

if (SJB_Authorization::isUserLoggedIn() && !isset($_REQUEST['as_user'])) {
	$tp->display('already_logged_in.tpl');
}
else {
	$page_config = SJB_System::getPageConfig(SJB_System::getURI());
	
	if (SJB_Request::getVar('action', false) == 'login') {
		$username = SJB_Request::getVar('username');
		$password = SJB_Request::getVar('password');
		$keep_signed = SJB_Request::getVar('keep',false);
		$logged_in = false;
		
		$login_as_user = false;
		if (isset($_REQUEST['as_user']))
			$login_as_user = true;
			// redirect user to the home page if it's login page or to the same page otherwise
			
			if (SJB_Request::getVar('return_url', false) != false)
				$redirect_url = base64_decode(SJB_Request::getVar('return_url'));
			elseif (SJB_System::getURI() == '/')
				$redirect_url = SJB_System::getSystemSettings("SITE_URL")."/my-account/";
			else {
				if ($page_config->module == 'users' && $page_config->function == 'login')
					$redirect_url = SJB_System::getSystemSettings("SITE_URL")."/my-account/";
				else 	
					$redirect_url = SJB_System::getSystemSettings("SITE_URL") . SJB_System::getURI();
			}
			SJB_Event::dispatch('Login', $_REQUEST);
			if (SJB_UserManager::getCurrentUserSID()) 
				$logged_in = true;
			else
				$logged_in = SJB_Authorization::login($username, $password, $keep_signed, $errors, $login_as_user);
				
			if ($logged_in) {
				$listings = SJB_ListingManager::getListingsInfoByUserSID(SJB_UserManager::getCurrentUserSID());
				if(!empty($listings)) {
					foreach($listings as $key => $listing) {
						SJB_DB::query("UPDATE `listings` SET `is_new` = 0 WHERE `sid` = ?n AND `user_sid` = ?n", $listing['sid'], SJB_UserManager::getCurrentUserSID());
					}
				}
				SJB_HelperFunctions::redirect($redirect_url);
			}	
	}

	$return_url = SJB_Request::getVar('return_url', ($page_config->function != 'login' && $page_config->function != 'search_form') ? base64_encode(SJB_Navigator::getURIThis()) : false);
	$tp->assign('return_url', $return_url);
	$tp->assign('ajaxRelocate', SJB_Request::getVar('ajaxRelocate', false));
	$tp->assign('errors', $errors);
	$tp->assign('adminEmail', SJB_System::getSettingByName('system_email'));
	$tp->display('login.tpl');
}
