<?php

	require_once("users/User/UserManager.php");
	require_once("classifieds/Listing/ListingManager.php");
	require_once("payment/Payment/PaymentManager.php");
	
	$ou = SJB_UserManager::getOnlineUsers();
	$onlineUsers = array();
	$userGroups = SJB_UserGroupManager::createTemplateStructureForUserGroups();
	foreach ($userGroups as $userGroup) {
		$onlineUsers[$userGroup["id"]]["count"] = 0;
		$onlineUsers[$userGroup["id"]]["caption"] = $userGroup["caption"];
	}
	foreach ($ou as $key => $value) {
		$onlineUsers[$value["type"]]["count"]++;
	}
	
	$theme = SJB_Settings::getValue('TEMPLATE_USER_THEME', 'default');
	$themePath = SJB_TemplatePathManager::getAbsoluteThemePath($theme, "user");

	
	// FLAGGED LISTINGS
	$allListingTypes = SJB_ListingTypeManager::getAllListingTypesInfo();
	$totalFlagsNum   = array();
	foreach ($allListingTypes as $type) {
		$totalFlagsNum[$type['id']] = SJB_ListingManager::getFlagsNumberByListingTypeSID($type['sid'], $filter = null, $groupByListingSID = true);
	}
	
	$files = getCssFiles($themePath);

	$tp = SJB_System::getTemplateProcessor();
	$tp->assign('totalFlagsNum', $totalFlagsNum);
	$tp->assign('usersInfo', SJB_UserManager::getUsersInfo());
	$tp->assign('groupsInfo', SJB_UserManager::getGroupsInfo());
	$tp->assign('listingsInfo', SJB_ListingManager::getListingsInfo());
	$tp->assign('listingTypesInfo', SJB_ListingTypeManager::getAllListingTypesInfo());
	$tp->assign('paymentsInfo', SJB_PaymentManager::getPaymentsInfo());
	$tp->assign('pendingPayments', SJB_PaymentManager::getTotalPendingPayments());
	$tp->assign('totalPayments', SJB_PaymentManager::getTotalPayments());

	$i18n = SJB_I18N::getInstance();
	$lang = $i18n->getLanguageData($i18n->getCurrentLanguage());
	$tp->assign("today", strftime($lang['date_format'], time())); 
	// ранее были данные за период: месяц (последние 30 дней), неделя (последние 7 дней)
	// теперь - текущий месяц и текущая неделя
	$currMonth	= strftime($lang['date_format'], mktime(0, 0, 0, date("m"), 1, date("Y")) );
	$currWeek	= strftime($lang['date_format'], mktime(0,0,0,date("m"), date("d")-date("w"), date("Y")) );
	
	$tp->assign("weekAgo", $currWeek);
	$tp->assign("monthAgo", $currMonth);
			
	$tp->assign('onlineUsers', $onlineUsers);
	if (count($files) > 0)
		$tp->assign("file", $files[0]);
	$tp->display("index.tpl");
	
	function getCssFiles($dir) {
		if (!file_exists($dir))
			return array();
		$d = dir($dir);
		$files = array();
		if (!$d)
			return array();
		
		while (false !== ($entry = $d->read())) {
			if ($entry == '.' || $entry == '..')
				continue;
			$path = $dir . $entry;
			if (is_dir($path))
				$files = array_merge($files, getCssFiles($path . "/"));
			if (is_file($path)) {
				$pathinfo = pathinfo($path);
				if (isset($pathinfo["extension"]) && strtolower($pathinfo["extension"]) == "css") {
					$files[] = $path;
				}
			}
		}
		return $files;
	}

