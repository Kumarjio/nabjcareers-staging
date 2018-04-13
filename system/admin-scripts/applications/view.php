<?php

	require_once 'applications/Applications.php';
	require_once 'users/User/UserManager.php';
	require_once 'classifieds/Listing/ListingManager.php';
	
	$tp = SJB_System::getTemplateProcessor();
	$displayTemplate = "view.tpl";
	$errors = array();
	
	$filename = SJB_Request::getVar('filename', false);
	
	if ($filename) {
		$appsID = SJB_Request::getVar('appsID',false);
		if($appsID) {
			require_once("miscellaneous/UploadFileManager.php");
			$file = SJB_UploadFileManager::openApplicationFile($filename, $appsID);
			if (!$file)
				$errors['NO_SUCH_FILE'] = true;
		}
		else 
			$errors['NO_SUCH_APPS'] = true;
	}
	
	$cu = SJB_UserManager::getUserInfoByUserName($_REQUEST["username"]);
	$tp->assign("username", $_REQUEST["username"]);
	$tp->assign("user_group_id", $_REQUEST["user_group_id"]);
	$tp->assign("user_sid", $_REQUEST["user_sid"]);
	
	$appJobId	= SJB_Request::getVar('appJobId', false);
	
	// посортируем чего-нибуть
	$orderBy = isset($_REQUEST["orderBy"])?$_REQUEST["orderBy"]:'date';
	$order   = isset($_REQUEST["order"])  ?$_REQUEST["order"]  :'desc';
	
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
			case "company":
				$orderInfo = array('sorting_field'=>'CompanyName', 'sorting_order'=>$order, 'inner_join'=>array('table'=>'listings', 'field1'=>'sid', 'field2'=>'listing_id'), 'inner_join2' => array('table1'=>'users_properties', 'table2' => 'listings', 'field1'=>'object_sid', 'field2'=>'user_sid'));
				break;
		}
	}
	
	if ($cu['user_group_sid'] == 41) { // Работадатель
		if (isset($_REQUEST['action'])) {
			
			switch ($_REQUEST['action']) {
				
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
		}

		if ($appJobId)
			$apps = SJB_Applications::getByJob($appJobId, $orderInfo);
		else
			$apps = SJB_Applications::getByEmployer($cu['sid'], $orderInfo);

		for ($i = 0; $i < count($apps); ++$i) {
			$apps[$i]["job"] = SJB_ListingManager::getListingInfoBySID($apps[$i]["listing_id"]);
			//$apps[$i]["user"] = UserManager::getUserInfoBySID($apps[$i]["jobseeker_id"]);
			if (isset($apps[$i]["resume"]) && !empty($apps[$i]["resume"]))
				$apps[$i]["resumeInfo"] = SJB_ListingManager::getListingInfoBySID($apps[$i]["resume"]);
			// если это анонимный соискатель - то возьмем имя из пришедшего поля 'username'
			if($apps[$i]['jobseeker_id'] == 0) {
				$apps[$i]["user"]["FirstName"] = $apps[$i]['username'];
			} else {
				$apps[$i]["user"] = SJB_UserManager::getUserInfoBySID($apps[$i]["jobseeker_id"]);
			}
		}
		
		$jobs = SJB_ListingManager::getListingsByUserSID($cu['sid']);
		$appJobs	= array();
		foreach ($jobs as $job) {
			$appJobs[] = array('title' => $job->details->properties['Title']->value, 'id' => $job->sid);
		}
		
		$tp->assign("appJobs", $appJobs);
		$tp->assign("current_filter", $appJobId);
		
	}
	else { // Соискатель
		
		if (isset($_POST["action"]) && $_POST["action"] == "Delete selected") {
			if (isset($_POST["applications"]))
				foreach ($_POST["applications"] as $key => $value)
					SJB_Applications::hideJS($key);
		}
		
		$apps = SJB_Applications::getByJobseeker($cu["sid"], $orderInfo);
		for ($i = 0; $i < count($apps); ++$i) {
			$apps[$i]["job"] = SJB_ListingManager::getListingInfoBySID($apps[$i]["listing_id"]);
			$apps[$i]["company"] = SJB_UserManager::getUserInfoBySID($apps[$i]["job"]["user_sid"]);
		}
		
		$displayTemplate = "view_seeker.tpl";
	}
	
	if(isset($sortByUsername)) {
		$order = ($order == "desc") ? SORT_DESC : SORT_ASC ;
		foreach ($apps as $key => $value) {
			if (!isset($apps[$key]["user"]["FirstName"]))
				$apps[$key]["user"]["FirstName"] = '';
			if (!isset($apps[$key]["user"]["LastName"]))
				$apps[$key]["user"]["LastName"] = '';
			$sortKeys[$key] = $apps[$key]["user"]["FirstName"] . " " . $apps[$key]["user"]["LastName"];
		}
		if ($apps)
			array_multisort($sortKeys, $order, SORT_REGULAR, $apps);
	}
	
	$tp->assign( "METADATA", SJB_Application::getApplicationMeta() );
	$tp->assign("applications", $apps);
	$tp->assign("errors", $errors);
	
	$tp->display($displayTemplate);
