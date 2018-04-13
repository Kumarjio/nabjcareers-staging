<?php
/***************************************************
 * Integration of JobSource Jobg8 script
 * 
 * This script integrate P4P of JobG8
 ***************************************************/
/*
For example in SJB there is a user "emp", с user_id = 8, emal = emp@emp.com, username = EMPjob
Are we correct to assume that the encryption parameters will be as follows:

ADHOC is ON:
?cid=810388&a=ADHOC&email=emp@emp.com&adv=EMPjob 

ADHOC is OFF:
?cid=810388&a=8&email=emp@emp.com&adv=EMPjob 
*/

$tp = SJB_System::getTemplateProcessor();


if (SJB_UserManager::isUserLoggedIn()) {
	
	$currentUser = SJB_UserManager::getCurrentUserInfo();
	$userEmail	 = $currentUser['email'];
	$username	 = $currentUser['CompanyName'];
	
	if (empty($username)) {
		$username = $currentUser['username'];
	}
	
	// our jobg8 Job Board ID
	$jobboardID	   = SJB_Settings::getSettingByName('jobg8_jobboard_id_p4p');
	$jobg8_p4p_url = SJB_Settings::getSettingByName('jobg8_p4p_url');
	$cid		   = SJB_Settings::getSettingByName('jobg8_cid');
	
	$adhoc_mode    = JobG8IntegrationPlugin::getAdhocMode();
	
	$mode = '';
	
	// look jobg8 p4p-integration doc (parameter 'a')
	if ($adhoc_mode) {
		$mode = 'ADHOC';
	} else {
		$mode = $currentUser['sid'];
	}
	
	$message = "?cid={$cid}&a={$mode}&email={$userEmail}&adv={$username}";

	
	// use RSA library for crypt
	require 'rsa.php';
	
	//$sshKey   = SJB_Settings::getSettingByName('jobg8_ssh_key');
	$sshKey   = JobG8IntegrationPlugin::getRsaKey();
	$keyArray = explode(' ', $sshKey, 3);
	
	$keyLength = $keyArray[0];
	$exponent  = $keyArray[1];
	$modulus   = $keyArray[2];
	// Encrypt the message
	$encryptedData = rsa_encrypt($message, $exponent, $modulus, $keyLength);
	// Base64 encode the encrypted data
	$output = urlencode( base64_encode($encryptedData) );
	
	
	$tp->assign('jobg8_p4p_url', $jobg8_p4p_url);
	$tp->assign('jobboardID', $jobboardID);
	$tp->assign('encoded_data', $output);
	
	$tp->display('jobg8_p4p.tpl');
}
else {
	$tp->assign("return_url", base64_encode(SJB_Navigator::getURIThis()));
	//$tp->assign("ajaxRelocate", true);
	$tp->display("../users/login.tpl");
}