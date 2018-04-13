<?php

	require_once 'applications/Applications.php';
	require_once 'users/User/UserManager.php';
	require_once 'classifieds/Listing/ListingManager.php';
	require_once 'applications/ScreeningQuestionnaires.php';
	
	$tp = SJB_System::getTemplateProcessor();
	$displayTemplate = "view.tpl";
	$errors = array();
	
	// не бум пускать незарегенных
	if (SJB_UserManager::isUserLoggedIn() === false) {
		$tp->assign("ERROR", "NOT_LOGIN");
		$tp->display("../miscellaneous/error.tpl");
		return;
	}
	
	$filename = SJB_Request::getVar('filename', false);
	
	if ($filename) {
		$appsID = SJB_Request::getVar('appsID',false);
		if($appsID) {
			require_once("miscellaneous/UploadFileManager.php");
			$file = SJB_UploadFileManager::openApplicationFile($filename, $appsID);
			if(!$file)
				$errors['NO_SUCH_FILE'] = true;
		}
		else 
			$errors['NO_SUCH_APPS'] = true;
	}	
		
	$cu = SJB_UserManager::getCurrentUser();
	$appJobId	= SJB_Request::getVar('appJobId', false);
	$score = SJB_Request::getVar('score', false);
	
	// посортируем чего-нибуть
	$orderBy = SJB_Request::getVar('orderBy', 'date');
	$order   = SJB_Request::getVar('order', 'desc');
	$tp->assign("orderBy", $orderBy);
	$tp->assign("order", $order);
	if (isset($orderBy) && isset($order) && $orderBy != "") {
		switch ($orderBy) {
			case "date":
				$orderInfo = array('sorting_field'=>'date', 'sorting_order'=>$order);
				break;
			case "title":
				$orderInfo = array('sorting_field'=>'Title', 'sorting_order'=>$order, 'inner_join'=>array('table'=>'listings_properties', 'field1'=>'object_sid', 'field2'=>'listing_id'));
				break;
			case "applicant":
				$orderInfo = false;
				$sortByUsername = true;
				break;
			case "status":
				$orderInfo = array('sorting_field'=>'status', 'sorting_order'=>$order);
				break;
			case "score":
				$orderInfo = array('sorting_field'=>'score', 'sorting_order'=>$order);
				break;
			case "company":
				$orderInfo = array('sorting_field'=>'CompanyName', 'sorting_order'=>$order, 'inner_join'=>array('table'=>'listings', 'field1'=>'sid', 'field2'=>'listing_id'), 'inner_join2' => array('table1'=>'users_properties', 'table2' => 'listings', 'field1'=>'object_sid', 'field2'=>'user_sid'));
				break;
		}
	}
	if ($cu->getUserGroupSID() == 41) { // Работадатель
			
		switch (SJB_Request::getVar('action', '')) {
			case "approve":
				if (isset($_POST["applications"]))
					foreach ($_POST["applications"] as $key => $value)
						SJB_Applications::accept($key);
				break;
				
			case "reject":
				if (isset($_POST["applications"]))
					foreach ($_POST["applications"] as $key => $value)
						SJB_Applications::reject($key);
				break;
				
			case "delete":
				if (isset($_POST["applications"]))
					foreach ($_POST["applications"] as $key => $value)
						SJB_Applications::hideEmp($key);
				break;
		}
		
		$subuser = false;
		if ($appJobId) {
			$isUserOwnerApps = SJB_Applications::isUserOwnsAppsByAppJobId($cu->getID(), $appJobId);
			if ( !$isUserOwnerApps ) {
				$tp->assign("ERROR", "NOT_OWNER_OF_APPLICATIONS");
				$tp->display("../miscellaneous/error.tpl");
				return;
			}
			$apps = SJB_Applications::getByJob($appJobId, $orderInfo, $score);
		}
		else {
			if ($cu->isSubuser()) {
				$subuserInfo = $cu->getSubuserInfo();
				if (!SJB_Acl::getInstance()->isAllowed('subuser_manage_listings', $subuserInfo['sid']))
					$subuser = $subuserInfo['sid'];
			}
			$apps = SJB_Applications::getByEmployer($cu->getSID(), $orderInfo, $score, $subuser);
		}
			
		foreach ($apps as $i => $app) {
			$apps[$i]["job"] = SJB_ListingManager::getListingInfoBySID($apps[$i]["listing_id"]);
			if (!empty($apps[$i]["job"]['screening_questionnaire'])) {
				$screening_questionnaire = SJB_ScreeningQuestionnaires::getInfoBySID($apps[$i]["job"]['screening_questionnaire']);
				$passing_score = 0;
				switch ($screening_questionnaire['passing_score']) {
					case 'acceptable':
						$passing_score = 1;
						break;
					case 'good':
						$passing_score = 2;
						break;
					case 'very_good':
						$passing_score = 3;
						break;
					case 'excellent':
						$passing_score = 4;
						break;
				}
				if ($apps[$i]['score'] >= $passing_score)
					$apps[$i]['passing_score'] = 'Passed';
				else 	
					$apps[$i]['passing_score'] = 'Not passed';
			}
			if (isset($apps[$i]["resume"]) && !empty($apps[$i]["resume"]))
				$apps[$i]["resumeInfo"] = SJB_ListingManager::getListingInfoBySID($apps[$i]["resume"]);
			// если это анонимный соискатель - то возьмем имя из пришедшего поля 'username'
			if ($apps[$i]['jobseeker_id'] == 0) {
				$apps[$i]["user"]["FirstName"] = $apps[$i]['username'];
			} else {
				$apps[$i]["user"] = SJB_UserManager::getUserInfoBySID($apps[$i]["jobseeker_id"]);
			}
		}
		
		$jobs = SJB_ListingManager::getListingsInfoByUserSID($cu->sid, $subuser);
		$appJobs = array();
		foreach ($jobs as $job) {
			$appJobs[] = array('title' => $job['Title'], 'id' => $job['sid']);
		}
		$tp->assign("appJobs", $appJobs);
		$tp->assign("score", $score);
		$tp->assign("current_filter", $appJobId);

	}
	else { // Соискатель
		
		if (SJB_Request::getVar('action', '', 'POST') == "delete") {
			foreach (SJB_Request::getVar('applications', array(), 'POST') as $key => $value)
				SJB_Applications::hideJS($key);
		}
		
		$apps = SJB_Applications::getByJobseeker($cu->sid, $orderInfo);
		for ($i = 0; $i < count($apps); ++$i) {
			$apps[$i]["job"] = SJB_ListingManager::getListingInfoBySID($apps[$i]["listing_id"]);
			$apps[$i]["company"] = SJB_UserManager::getUserInfoBySID($apps[$i]["job"]["user_sid"]);
		}
		
		$displayTemplate = "view_seeker.tpl";
	}
	
	if (isset($sortByUsername)) {
	    $sortKeys = array();
		$order = ($order == "desc") ? SORT_DESC : SORT_ASC ;
		foreach ($apps as $key => $value) {
			if(!isset($apps[$key]["user"]["FirstName"])) $apps[$key]["user"]["FirstName"] = '';
			if(!isset($apps[$key]["user"]["LastName"]))  $apps[$key]["user"]["LastName"] = '';
			$sortKeys[$key] = $apps[$key]["user"]["FirstName"] . " " . $apps[$key]["user"]["LastName"];
		}
		array_multisort($sortKeys, $order, SORT_REGULAR, $apps);
	}

	$tp->assign( "METADATA", SJB_Application::getApplicationMeta() );
	$tp->assign("applications", $apps);
	$tp->assign("errors", $errors);
	$tp->display($displayTemplate);
