<?php

include_once ('main/admin.php');
include_once ('main/subadmin.php');

if (SJB_System::getSystemSettings('SYSTEM_ACCESS_TYPE') == 'admin') {
	if (!SJB_SubAdmin::admin_authed() && !SJB_Admin::admin_authed() ) {
		if (SJB_Admin::NeedShowSplashScreen()) {
			SJB_Admin::ShowSplashScreen();
			exit;
		}
		if (!SJB_Admin::admin_auth() )
		{
			exit;
		}
	}
}