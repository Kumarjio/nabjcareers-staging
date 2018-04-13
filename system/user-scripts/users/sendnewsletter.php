<?php
function queryValue($sql)
{
	$res	=	mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($res) > 0)
	{
		$row	=	mysql_fetch_assoc($res);
		foreach($row as $key=>$value)
		{
			return $value;
		}
	}
	return "";
}

// where sendemailnewsletter='1' 
$userList	=	SJB_DB::query("select sid, username, email from users where sendmail='0' and user_group_sid='36'");
if(!empty($userList))
{
	$newsletterInfo	=	SJB_DB::query("select * from newsletter");
	if(!empty($newsletterInfo))
	{
		$newsletter	=	$newsletterInfo[0];
	}
	if($newsletter['intervals'] > 0)
	{
		$daysLastRun		=	queryValue("SELECT DATEDIFF(NOW(), lastrun) from newsletter");
		if(($daysLastRun	>= $newsletter['intervals']) || ( is_null($daysLastRun) )) 
		{
			$msg			=	"";
			$daysLastRun	=	queryValue("SELECT lastrun from newsletter");
			$catsArr		=	SJB_DB::query("select sid, value from listing_field_list where field_sid='198' order by `order`");
			$catsList		=	"";
			$patterns 		= 	array('/\s/', '/&/', '/\$/', '/\,/', '/\*/', '/\%/', '/\|/', '/\//');
			if(!empty($catsArr))
			{
				foreach($catsArr as $catId)
				{
					
					//$sql			=	"select * from listings where JobCategory in (". $catId['sid'] .") and activation_date > '". $daysLastRun ."'";
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
			
			//echo $msg;
			if($msg!="")
			{
				$subject	=	$newsletter['subject'];
				/*$message	=	'<table><tr><td><img src="'.SJB_System::getSystemSettings('USER_SITE_URL').'/templates/'.SJB_Settings::getValue('TEMPLATE_USER_THEME', 'default').'/main/images/logo.png" /></td><td><table><tr><td><img src="'.SJB_System::getSystemSettings('USER_SITE_URL').'/templates/'.SJB_Settings::getValue('TEMPLATE_USER_THEME', 'default').'/main/images/social/fb.gif" /></td><td><img src="'.SJB_System::getSystemSettings('USER_SITE_URL').'/templates/'.SJB_Settings::getValue('TEMPLATE_USER_THEME', 'default').'/main/images/social/twitter.gif" /></td></tr></table></td></tr></table><br>If you no longer want to receive these updates, <a href="'.SJB_System::getSystemSettings('USER_SITE_URL').'/unsubscribe/" target="_blank">click here to instantly unsubscribe</a><br />-----------------------------------------------------------------<br />';
				$message	.=	$newsletter['header'];
				
				$message	.=	$msg;
				
				$message	.=	$newsletter['footer'];
				$message	.=	'<table><tr><td><a href="'.SJB_System::getSystemSettings('USER_SITE_URL').'"><img src="'.SJB_System::getSystemSettings('USER_SITE_URL').'/templates/'.SJB_Settings::getValue('TEMPLATE_USER_THEME', 'default').'/main/images/social/join_mailing_list.png" /></a></td></table>';*/
				
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html' . "\r\n";
				$headers .= 'From: '. SJB_System::getSettingByName('FromName') .'<'. SJB_System::getSettingByName('system_email') .'>' . "\r\n";
				//print_r($userList);
				foreach($userList as $user)
				{
					$message	=	'<table><tr><td><img src="'.SJB_System::getSystemSettings('USER_SITE_URL').'/templates/'.SJB_Settings::getValue('TEMPLATE_USER_THEME', 'default').'/main/images/logo.png" /></td><td><table><tr><td><a href="https://www.facebook.com/Asiamediajobs" target="_blank"><img src="'.SJB_System::getSystemSettings('USER_SITE_URL').'/templates/'.SJB_Settings::getValue('TEMPLATE_USER_THEME', 'default').'/main/images/social/fb.gif" /></a></td><td><a href="https://twitter.com/asiamediajobs" target="_blank"><img src="'.SJB_System::getSystemSettings('USER_SITE_URL').'/templates/'.SJB_Settings::getValue('TEMPLATE_USER_THEME', 'default').'/main/images/social/twitter.gif" /></a></td></tr></table></td></tr></table><br>If you no longer want to receive these updates, <a href="'.SJB_System::getSystemSettings('USER_SITE_URL').'/unsubscribe/?param='. base64_encode($user['sid']) .'" target="_blank">click here to instantly unsubscribe</a><br />-----------------------------------------------------------------<br />';
					$message	.=	$newsletter['header'];
					
					$message	.=	$msg;
					
					$message	.=	$newsletter['footer'];
					$message	.=	'<table><tr><td><a href="'.SJB_System::getSystemSettings('USER_SITE_URL').'"><img src="'.SJB_System::getSystemSettings('USER_SITE_URL').'/templates/'.SJB_Settings::getValue('TEMPLATE_USER_THEME', 'default').'/main/images/social/join_mailing_list.png" /></a></td></table>';
					
					if(mail($user['email'], $subject, $message, $headers))
					{
						echo "mail sent to : ".$user['email']."<br>";
					}
					else
					{
						echo "mail not sent to : ".$user['email']."<br>";
					}
					//mail("lalit.ymca@gmail.com", $subject, $message, $headers);
				}
				
				//mail("lalit.ymca@gmail.com", $subject, $message, $headers);
				SJB_DB::query("update newsletter set lastrun=NOW()");
			}	
		}
	}
	
	
}

