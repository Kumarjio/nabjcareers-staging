<?php

if ( SJB_SubAdmin::getSubAdminSID() )
{
	$tp = SJB_System::getTemplateProcessor ();
	$tp->assign('subadmin', SJB_SubAdmin::getSubAdminInfo() );
	$tp->display('subadmin_left_menu.tpl');
}







