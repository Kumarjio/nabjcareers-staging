<?php
function queryValue($sql)
{
	$res	=	mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($res) >  0)
	{
		$row	=	mysql_fetch_assoc($res);
		foreach($row as $key=>$value)
		{
			return $value;
		}
	}
	return "";
}

		set_time_limit(0);
		ini_set('memory_limit', -1);
		$tp 				= 	SJB_System::getTemplateProcessor();
		$subject			=	addslashes(SJB_Request::getVar('subject'));
		$formSubmitted 		= 	SJB_Request::getVar('save', false, 'POST');
		$testRun	 		= 	SJB_Request::getVar('testrun', false, 'POST');
		$lastRun	 		= 	SJB_Request::getVar('lastrun', false, 'POST');
		
		
		//checkdate ( int $month , int $day , int $year );
		$isDataSubmitted 	= 	false;
		$isTestRun		 	= 	false;
		$errors				=	array();
		if($formSubmitted)
		{
			if($lastRun!="")
			{
				$lastRunArr			=	explode("/", $lastRun);
				if(count($lastRunArr)!=3)
				{
					$errors['SUBJECT_EMPTY']	=	'Invalid date format';	
				}
				else
				{
					if(!checkdate ( $lastRunArr[0] , $lastRunArr[1] , $lastRunArr[2] ))
					{
						$errors['SUBJECT_EMPTY']	=	'Invalid date format';	
					}
					else
					{
						$lastRun	=	$lastRunArr[2]."-".$lastRunArr[0]."-".$lastRunArr[1];
					}
				}
			}		
			if($subject	==	"")
			{
				$errors['SUBJECT_EMPTY']	=	'Subject is empty';
			}
			if(empty($errors))
			{
				$intervals			=	SJB_Request::getVar('intervals');
				$header				=	addslashes(SJB_Request::getVar('header'));
				$footer				=	addslashes(SJB_Request::getVar('footer'));
				$facebook			=	addslashes(SJB_Request::getVar('facebook'));
				$twitter			=	addslashes(SJB_Request::getVar('twitter'));
				$newsletterId		=	SJB_Request::getVar('newsletter_id');
				if($newsletterId)
				{
					$id					=	SJB_DB::query("update newsletter set subject='". $subject ."', header='". $header ."', footer='". $footer ."', intervals='". $intervals ."', lastrun='". $lastRun ."', facebook='". $facebook ."', twitter='". $twitter ."'");
					$isDataSubmitted 	= 	true;
				}
				else
				{
					$id					=	SJB_DB::query("insert into newsletter set subject='". $subject ."', header='". $header ."', footer='". $footer ."', intervals='". $intervals ."', facebook='". $facebook ."', twitter='". $twitter ."'");
					$isDataSubmitted 	= 	true;
				}
				
			}
		}
		if($testRun)
		{
			$newsletterInfo	=	SJB_DB::query("select * from newsletter");
			if(!empty($newsletterInfo))
			{
				$newsletter	=	$newsletterInfo[0];
			}
			$daysLastRun	=	queryValue("SELECT DATEDIFF(NOW(), lastrun) from newsletter");
			
			$msg	=	"";
			$daysLastRun	=	queryValue("SELECT lastrun from newsletter");
			$catsArr		=	SJB_DB::query("select sid, value from listing_field_list where field_sid='198' order by `order`");
			$catsList		=	"";
			$patterns 		= 	array('/\s/', '/&/', '/\$/', '/\,/', '/\*/', '/\%/', '/\|/', '/\//');
			if(!empty($catsArr))
			{
				foreach($catsArr as $catId)
				{
					
					$sql			=	"select l.* from listings l inner join listings_properties lp on l.sid=lp.object_sid where lp.id='JobCategory' and lp.value in ('". $catId['value'] ."') and activation_date > '". $daysLastRun ."' and listing_type_sid='6' and active='1'";
					if($catsList!="")
						$sql			.=	" and lp.id not in (". $catsList .")";
						
					$listingList	=	SJB_DB::query($sql);
					if(!empty($listingList))
					{
						$msg			.=	'<h2>'. $catId['value'] .'</h2>';
						foreach($listingList as $listing)
						{
							$date	=	date("m/d/Y", strtotime($listing['activation_date']));
							$company	=	queryValue("select value from users_properties where id='CompanyName' and object_sid='". $listing['user_sid'] ."'");
							$title	=	queryValue("select value from listings_properties where id='Title' and object_sid='". $listing['sid'] ."'");
							$title	=	(preg_replace('/[^A-Za-z0-9\-]/', '-', $title));
							$city	=	queryValue("select value from listings_properties where id='City' and object_sid='". $listing['sid'] ."'");
							$msg	.=	'- '.$company.' - <a href="'.SJB_System::getSystemSettings('USER_SITE_URL').'/display-job/'. $listing['sid'] .'/'. $title .'">'.$title.' in '. $city .' - '. $date .'</a><br>URL: <a href="'.SJB_System::getSystemSettings('USER_SITE_URL').'/display-job/'. $listing['sid'] .'/'. $title .'">'.SJB_System::getSystemSettings('USER_SITE_URL').'/display-job/'. $listing['sid'] .'/'. $title .'</a><br /><br />';
							if($catsList	==	"")
								$catsList	.=	"'".$catId['value']."'";
							else
								$catsList	.=	",'".$catId['value']."'";
						}
						//echo $catsList;
						//echo "<br>";
					}
				}
			}
			$isTestRun	=	true;
			
			//echo $msg;
			$subject	=	$newsletter['subject'];
			$message	=	'<table><tr><td><img src="'.SJB_System::getSystemSettings('USER_SITE_URL').'/templates/'.SJB_Settings::getValue('TEMPLATE_USER_THEME', 'default').'/main/images/logo.png" /></td><td><table><tr><td><img src="'.SJB_System::getSystemSettings('USER_SITE_URL').'/templates/'.SJB_Settings::getValue('TEMPLATE_USER_THEME', 'default').'/main/images/social/fb.gif" /></td><td><img src="'.SJB_System::getSystemSettings('USER_SITE_URL').'/templates/'.SJB_Settings::getValue('TEMPLATE_USER_THEME', 'default').'/main/images/social/twitter.gif" /></td></tr></table></td></tr></table><br>If you no longer want to receive these updates, <a href="'.SJB_System::getSystemSettings('USER_SITE_URL').'/unsubscribe/" target="_blank">click here to instantly unsubscribe</a><br />-----------------------------------------------------------------<br />';
			$message	.=	$newsletter['header'];
			
			$message	.=	$msg;
			
			$message	.=	$newsletter['footer'];
			$message	.=	'<table><tr><td><a href="'.SJB_System::getSystemSettings('USER_SITE_URL').'"><img src="'.SJB_System::getSystemSettings('USER_SITE_URL').'/templates/'.SJB_Settings::getValue('TEMPLATE_USER_THEME', 'default').'/main/images/social/join_mailing_list.png" /></a></td></table>';
			
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html' . "\r\n";
			$headers .= 'From: '. SJB_System::getSettingByName('FromName') .'<'. SJB_System::getSettingByName('system_email') .'>' . "\r\n";
			
			//echo SJB_System::getSettingByName('system_email');
			if(mail(SJB_System::getSettingByName('system_email'), $subject, $message, $headers))
			{
				$append	=	date("d-m-Y");
				$id		=	addslashes(str_replace(' ', '', $subject))."_". $append;
				$params	=	serialize( array("pageid"=>$id));
				$isPageExist	=	queryValue("select * from stat_pages where id='". $id ."'");
				if(!$isPageExist)
				{
					SJB_DB::query("insert into stat_pages set id='". $id ."', name='".addslashes($subject)."_". $append ."', content='". addslashes($message) ."', lang='en' ");
				}
				$isPageExist	=	queryValue("select * from pages where uri='/". $id ."/'");
				if(!$isPageExist)
				{
					SJB_DB::query("insert into pages set uri='/". $id ."/', pass_parameters_via_uri='1', module='static_content', function='show_static_content', template='index.tpl', title='". addslashes($subject)."_". $append ."', access_type='user', parameters='". $params ."' ");
				}	
				
				if($newsletter['facebook'])
				{
					// require Facebook PHP SDK
					// see: https://developers.facebook.com/docs/php/gettingstarted/
					require_once("../facebook_php_sdk/facebook.php");
					 
					// initialize Facebook class using your own Facebook App credentials
					// see: https://developers.facebook.com/docs/php/gettingstarted/#install
					$config = array();
					$config['appId'] = '282817885241570';
					$config['secret'] = 'f2e9683d7255c6167c47381d7cc89f96';
					$config['fileUpload'] = false; // optional
					 
					$fb = new FacebookPost($config);
					 
					// define your POST parameters (replace with your own values)
					$params = array(
					  "access_token" => "CAAEBOKuWAOIBAOHwcxwpkhTy9buYW0ObaKq5UgAUtVa9tmJ4Bi4EoZC9D4keZANiZA68ehnWXn2YwHYlNz21Cr8z2ZAuv0Y14jgOuwhsNVOVbYzlBdNCyqvN1GCFf7LkTmncC9WPs5jpbs46eSO5x1m3ZAUKZBbQP1ZA9hWNjnj6AWl24RtWkipvAVjThNSo2cZD",
					  "message" => "Here are the latest jobs on Asiamediajobs.com-the job site for media professionals across Asia.",
					  "link" => "http://asiamediajobs.com/".$id,
					  //"picture" => "http://i.imgur.com/lHkOsiH.png",
					  "name" => "New Media Jobs on Asiamediajobs.com::".$append,
					  "caption" => "www.asiamediajobs.com",
					  "description" => "Here are the latest jobs on Asiamediajobs.com-the job site for media professionals across Asia."
					);
					 
					// see: https://developers.facebook.com/docs/reference/php/facebook-api/
					try {
					  $ret = $fb->api('/Asiamediajobs/feed', 'POST', $params);
					} catch(Exception $e) {
					  echo $e->getMessage();
					}
					
				}
				if($newsletter['twitter'])
				{
					require_once('../twitter_php_sdk/codebird.php');
 
					\Codebird\Codebird::setConsumerKey("GUnxkMFZR8bESkbbBz0QNqAKo", "NGqf9ZpOtgge9FeahGVaIuzDrkO3eWjWsZN9bwu8QrLnS8SUVb");
					$cb = \Codebird\Codebird::getInstance();
					$cb->setToken("247236334-7PPxmvfbBdA5vfDQUg4u1T5SBxOzltQTiKOyvxRH", "DXXiuPDnKarIzUWDEjfJVr8vb8jGJ5qMBAydQD9fWcl0y");
					 
					$params = array(
					  'status' => "New Media Jobs::".$append." http://asiamediajobs.com/".$id
					);
					$reply = $cb->statuses_update($params);
				}
			}
		}
		
		
		$newsletterInfo	=	array();
		$info	=	SJB_DB::query("select * from newsletter limit 0,1")	;
		if(!empty($info))
		{
			$newsletterInfo	=	$info[0];
			if($newsletterInfo['lastrun'] == '0000-00-00 00:00:00')
				$newsletterInfo['lastrun']	=	'';
			else
				$newsletterInfo['lastrun']	=	date('m/d/Y', strtotime($newsletterInfo['lastrun']));	
		}
		$tp->assign('errors', $errors);
		$tp->assign('info', $newsletterInfo);
		$tp->assign('header', $newsletterInfo['header']);
		$tp->assign('footer', $newsletterInfo['footer']);
		$tp->assign('is_data_submitted', $isDataSubmitted);
		$tp->assign('is_test_run', $isTestRun);
		$tp->display("newsletter.tpl");
	