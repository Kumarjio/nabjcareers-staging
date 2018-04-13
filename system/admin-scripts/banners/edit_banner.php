<?php 

require_once ('miscellaneous/UploadPictureManager.php');
require_once ('banners/Banners.php');

$tp =& SJB_System::getTemplateProcessor();

$bannersObj = new SJB_Banners();

$params = $_REQUEST;
$bannerId = $params['bannerId'];
$banner = $bannersObj->getBannerProperties($bannerId);

$filesDir = SJB_System::getSystemSettings('FILES_DIR');

if (isset($_REQUEST['action']))
{
	$action_name = $_REQUEST['action'];
	$params = $_REQUEST;
	
	switch ($action_name) {			
		case 'edit':
			
			// if image changed - save it
			if( $_FILES['image']['name'] != '' && $_FILES['image']['tmp_name'] != '') {
				
				$hashName = md5((time() * $_FILES['image']['size'])."_".$_FILES['image']['name']);
				$ext = preg_match("|\.(\w{3})\b|", $_FILES['image']['name'], $arr);
				
				$bannerFilePath = $filesDir."banners/".$hashName.".".$arr[1];
				
				// move file from temporary folder, and fill banner info to DB
				$copy = copy($_FILES['image']['tmp_name'], $bannerFilePath);
				
				if(!$copy) {
					$copyError = 'Cannot copy file from TMP dir to FILES_FIR';
					$tp->assign('copyError', $copyError);
					break;
				}
				
				
				if ($_FILES['image']['type'] != 'application/x-shockwave-flash') {
					// array of bannerInfo
					// [0] - width
					// [1] - height
					// [2] - ??
					// [3] - width & height in next view: width="104" height="150"
					// [bits] - bit size of image
					// [channels] 
		    		// [mime] - type, (image/jpeg, image/gif, image/png )
					
					    		// [1] - start_date
								// [1] - end_date
											
					
					$bannerInfo = getimagesize($bannerFilePath);
					if ($params['width'] != '' && $params['height'] != '') {
						$sx	= $params['width'];
						$sy = $params['height'];
														
					} else {
						$sx		= $bannerInfo[0];
						$sy		= $bannerInfo[1];
						
						
															$start_date = $bannerInfo[0];
															$end_date = $bannerInfo[0];
															
					}
					$type	= $bannerInfo['mime'];
					
				} else {
					if ($params['width'] == '' || $params['height'] == '') {
						$errors[] = 'SIZE_PARAMETER_MISMATCHED';
						break;
					}
					$sx		= $params['width'];
					$sy 	= $params['height'];
					$type	= $_FILES['image']['type'];
				}
				
				$bannerFilePath = "/".str_replace("../", "/", str_replace(SJB_BASE_DIR, '', $bannerFilePath));
				// now delete old banner image
				$bannersObj->deleteBannerImage($bannerId);
			
			} else {
				// if image not changed - leave it as is
				$bannerOldInfo = $bannersObj->getBannerProperties($params['bannerId']);
				
				$sx		= $bannerOldInfo['width'];
				$sy		= $bannerOldInfo['height'];
				if ($params['width'] != '' && $params['height'] != '') {
					if ($params['width'] != $sx || $params['height'] != $sy) {
						$sx = $params['width'];
						$sy = $params['height'];
					}
				}
				
				$type	= $bannerOldInfo['type'];
				$bannerFilePath = $bannerOldInfo['image_path'];
			}
			
			$title	= $params['title'];
			$link	= $params['link'];
			$active = $params['active'];
			$group	= $params['groupSID'];
			
			/***********/
							$start_date = $params['start_date'];
							$end_date = $params['end_date'];
			/************/					
			
			// check 'link' for correct. If it hasn't 'http://' - add them
			$expr = preg_match("/(http:\/\/)/", $link, $matches);
			if($expr != true) {
				$link = "http://".$link;
			}
			if ($params['bannerType'] == 'code'){
				$bannersObj->deleteBannerImage($bannerId);
			}
			$result		= $bannersObj->updateBanner($params['bannerId'], $title, $link, $bannerFilePath, $sx, $sy, $type, $active, $group, $params, $start_date, $end_date);
			
			$site_url	= SJB_System::getSystemsettings('SITE_URL')."/edit-banner-group/?groupSID=$group";
			header("Location: {$site_url}");
			break;
	}
}

$banner_fields = $bannersObj->getBannersMeta();

$tp->assign("banner_fields", $banner_fields);
$tp->assign("banner", $banner);
$tp->assign('bannersPath', SJB_Banners::getSiteUrl() );

$tp->display("edit_banner.tpl");
