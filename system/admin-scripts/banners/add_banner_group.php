<?php

require_once ('banners/Banners.php');

$tp =& SJB_System::getTemplateProcessor();
$bannersObj = new SJB_Banners();

$errors = array();



if (isset($_REQUEST['action']))
{
	$action_name = $_REQUEST['action'];
	$params = $_REQUEST;
	
	
	switch ($action_name) {
		case 'add':
			if ( $params['groupID'] == '') {
				$errors[] = 'GROUP_ID_MISMATCHED';
				break;
			}

			$result = $bannersObj->addBannerGroup($params['groupID']);
			if ($result === false) {
				$errors[] = 'ERROR_ADD_BANNER_GROUP';
				break;
			}
			
			$site_url = SJB_System::getSystemsettings('SITE_URL')."/manage-banner-groups/";
			header("Location: {$site_url}");
			break;
	}
	
}


		
$tp->assign("errors", $errors);

$tp->display("add_banner_group.tpl");

