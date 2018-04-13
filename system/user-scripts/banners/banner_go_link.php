<?php 

require_once ('miscellaneous/UploadPictureManager.php');
require_once ('banners/Banners.php');


$bannersObj = new SJB_Banners();

$params = $_REQUEST;

$bannerId = $params['bannerId'];

$banner = $bannersObj->getBannerProperties($bannerId);


// get link of banner
$link = $banner['link'];


// increment CLICK counter
$bannersObj->incrementClickCounter($bannerId);

header("Location: {$link}");
exit;

