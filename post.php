<?php
// require Facebook PHP SDK
// see: https://developers.facebook.com/docs/php/gettingstarted/
require_once("./facebook_php_sdk/facebook.php");
 
// initialize Facebook class using your own Facebook App credentials
// see: https://developers.facebook.com/docs/php/gettingstarted/#install
$config = array();
$config['appId'] = '282817885241570';
$config['secret'] = 'f2e9683d7255c6167c47381d7cc89f96';
$config['fileUpload'] = false; // optional
 
$fb = new Facebook($config);
 
// define your POST parameters (replace with your own values)
$params = array(
  //"access_token" => "CAAT18hMMWOABAJgqR2hZBNZCQTfEg0N1f5vEwZBKQbFGqEeZAJjav77YKFRpbAQHlQsMMGQcdWBv8OmfbjLvFjqoC06iBBfftpHZC8X1GxHRg6izQr0WPAjkYCgYdbB1wd0omLvPDsKhccvNFZAIQvjniri2bNHgJAzTzIZBC17N0t0dya1MvLIHpDeNTBDh7QZCS4wkPnJu2H7lV4A67F7o", // see: https://developers.facebook.com/docs/facebook-login/access-tokens/
  
  "access_token" => "CAAEBOKuWAOIBAOHwcxwpkhTy9buYW0ObaKq5UgAUtVa9tmJ4Bi4EoZC9D4keZANiZA68ehnWXn2YwHYlNz21Cr8z2ZAuv0Y14jgOuwhsNVOVbYzlBdNCyqvN1GCFf7LkTmncC9WPs5jpbs46eSO5x1m3ZAUKZBbQP1ZA9hWNjnj6AWl24RtWkipvAVjThNSo2cZD",
  "message" => "Here is a blog post about auto posting on Facebook using PHP #php #facebook",
  "link" => "http://www.pontikis.net/blog/auto_post_on_facebook_with_php",
  "picture" => "http://i.imgur.com/lHkOsiH.png",
  "name" => "How to Auto Post on Facebook with PHP",
  "caption" => "www.pontikis.net",
  "description" => "Automatically post on Facebook with PHP using Facebook PHP SDK. How to create a Facebook app. Obtain and extend Facebook access tokens. Cron automation."
);
 
// post to Facebook
// see: https://developers.facebook.com/docs/reference/php/facebook-api/
try {
  $ret = $fb->api('/Asiamediajobs/feed', 'POST', $params);
  echo 'Successfully posted to Facebook';
} catch(Exception $e) {
  echo $e->getMessage();
}
?>