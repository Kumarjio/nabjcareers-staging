<?php

require_once 'miscellaneous/Notifications.php';
require_once 'miscellaneous/UploadFileManager.php';

$tp = SJB_System::getTemplateProcessor();

if (isset($_REQUEST['send'])) {
	SJB_DB::query("DELETE FROM uploaded_files WHERE id = 'file_mail'");
	$upload_manager = new SJB_UploadFileManager();
	$upload_manager->setFileGroup('files');
	$upload_manager->setUploadedFileID('file_mail');
	$upload_manager->uploadFile('file_mail');
	$id_file = mysql_insert_id();

	$file_name = '';

	if (!isset($_REQUEST['delete_file']) && isset($_REQUEST['old_file']) && !$upload_manager->getUploadedFileName('file_mail'))
		$file_name = $_REQUEST['old_file'];
	elseif ($upload_manager->getUploadedFileName('file_mail'))
		$file_name = "files/files/" . $upload_manager->getUploadedSavedFileName('file_mail');

	$language = SJB_Request::getVar('language', 'any');
	$users = SJB_Request::getVar('users', 'any');
	$without_cv = SJB_Request::getVar('without_cv', false);

	$plans = SJB_Request::getVar('plans', array());
	$user_status = SJB_Request::getVar('user_status', '');
	$registration_date = SJB_Request::getVar('registration_date', array());

	$param = serialize(
		array(
			'language' => $language,
			'users' => $users,
			'without_cv' => $without_cv,
			'plans' => $plans,
			'status' => $user_status,
			'registration' => $registration_date,
		));

	$email = "";

	if (isset($_REQUEST['mail_id'])) {
		SJB_DB::query("
			UPDATE `mailing` SET
				`subject` 	= ?s,
				`text` 		= ?s,
				`email` 	= ?s,
				`file` 		= ?s,
				`param` 	= ?s
				WHERE `id` 	= ?s",
			$_REQUEST['subject'], stripcslashes($_REQUEST['text']), $email, $file_name, $param, $_REQUEST['mail_id']);
	}
	else {
		SJB_DB::query("
			INSERT INTO mailing ( email , subject , text , file, param)
				VALUES ( ?s, ?s, ?s, ?s, ?s)", $email, $_REQUEST['subject'], stripcslashes($_REQUEST['text']), $file_name, $param);
	}

	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/mailing/');
}

if (SJB_Request::getVar('action') == 'delete') {
	SJB_DB::query("DELETE FROM mailing WHERE id=" . $_REQUEST['id']);
	SJB_DB::query("DELETE FROM `mailing_info` WHERE `mailing_id` = " . $_REQUEST['id']);
	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/mailing/');
}


if (isset($_REQUEST['edit'])) {
	$mail_arr = SJB_DB::query("SELECT * FROM mailing WHERE id=" . $_REQUEST['edit']);

	$tp->assign("mail_id", $mail_arr[0]['id']);
	$tp->assign("subject", $mail_arr[0]['subject']);
	$tp->assign("text", $mail_arr[0]['text']);
	$tp->assign("file", $mail_arr[0]['file']);
	$tp->assign("file_url", $mail_arr[0]['file']);
	$tp->assign("param", unserialize($mail_arr[0]['param']));
}

// get membership plans by UserGroup ID
// via ajax
if (SJB_Request::isAjax()) {
	$userGroupID = SJB_Request::getVar('usergr', 0);

	if ($userGroupID > 0) {
		$membership_plans = SJB_MembershipPlanManager::getPlansInfoByGroupSID($userGroupID);
	}
	else {
		$membership_plans = SJB_MembershipPlanManager::getAllMembershipPlansInfo();
	}

	$tp->assign("plans", $membership_plans);
	$tp->display("mailing_plans.tpl");

	exit();
} // if ( SJB_Request::isAjax() )


$mail_list = SJB_DB::query("SELECT * FROM mailing");

foreach ($mail_list as $key => $var) {
	$param = unserialize($mail_list[$key]['param']);

	$where = "";
	$join = "";

	$numSentEmails = SJB_DB::query("SELECT count(*) FROM `mailing_info` WHERE `mailing_id` = ?n AND `status`=0", $var['id']);
	$numSentEmails = array_pop(array_pop($numSentEmails));

	if ($param["language"] != 'any')
		$where .= " and language='{$param['language']}'";
	if ($param["users"] != '0')
		$where .= ' and u.user_group_sid=' . $param['users'];
	if ($param["without_cv"]) {
		$join = "left join listings l on l.user_sid = u.sid";
		$where .= " and l.sid is null";
	}
	// user status
	if (!empty($param['status'])) {
		$where .= ' and `u`.`active`=' . (int) $param['status'];
	}

	// registration date
	if (!empty($param['registration']) && is_array($param['registration'])) {
		$i18n = SJB_I18N::getInstance();

		if (!empty($param['registration']['not_less'])) {
			$where .= ' AND `u`.`registration_date` > \'' . $i18n->getInput('date', $param['registration']['not_less']) . '\'';
		}
		if (!empty($param['registration']['not_more'])) {
			$where .= ' AND `u`.`registration_date` < \'' . $i18n->getInput('date', $param['registration']['not_more']) . '\'';
		}
	}

	// membership plans
	if (!empty ($param['plans'])) {
		$join .= "
            LEFT JOIN contracts ON u.sid = contracts.user_sid
            LEFT JOIN membership_plans ON membership_plans.id = contracts.membership_plan_id
        ";

		$wherePlan = array();

		foreach ($param['plans'] as $thePlan) {
			$thePlan = (int) $thePlan;

			if (!empty ($thePlan)) {
				$wherePlan[] .= "membership_plans.id = '{$thePlan}'";
			}
			else {
				$wherePlan[] .= 'membership_plans.id IS NULL';
			}
		}

		if (!empty($wherePlan)) {
			$where .= ' AND (' . implode(' OR ', $wherePlan) . ')';
		}
	} /// membership plans

	$mail_list[$key]['not_send'] = $numSentEmails;

	$mail_list[$key]['mail_arr'] = SJB_DB::query("
        SELECT u.sid as sid, u.username, u.user_group_sid, u.language
        FROM users u
            {$join}
            WHERE u.sendmail = 0
            {$where}
    ");

	$mail_list[$key]['count'] = count($mail_list[$key]['mail_arr']);
}


/*
 * test sending
 */
$testMailingID = SJB_Request::getVar('test_send', 0);

if ($testMailingID) {
	$oMailing = new SJB_Mailing($testMailingID);
	$oMailing->setMailingList($mail_list);
	$oMailing->testSend();
	SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/mailing/');
}


/*
 * general sending
 */
$sendToMailingID = SJB_Request::getVar('sending', 0);

if ($sendToMailingID) {
	$oMailing = new SJB_Mailing($sendToMailingID);
	$oMailing->setMailingList($mail_list);
	$oMailing->send();
	if ($oMailing->getUndeliveredMailingsInfo())
		$tp->assign("UndeliveredMailings", $oMailing->getUndeliveredMailingsInfo());
}


/*
 * send mailing to undelivered
 */
$sendToUndeliveredMailingID = SJB_Request::getVar('sendToUndeliveredEmails', 0);

if (!empty($sendToUndeliveredMailingID)) {
	$oMailing = new SJB_Mailing($sendToUndeliveredMailingID);
	$oMailing->setMailingList($mail_list);
	$oMailing->sendToUndelivered();
	if ($oMailing->getUndeliveredMailingsInfo())
		$tp->assign("UndeliveredMailings", $oMailing->getUndeliveredMailingsInfo());
}

function fileImg(&$text)
{
	$dir = $_SERVER['DOCUMENT_ROOT'];
	$url = dirname(SJB_System::getSystemSettings('SITE_URL'));
	$sRegExp = "/(src|background)=\"(.*)\"/Ui";
	preg_match_all($sRegExp, $text, $matches);
	$result = array();
	$i = 0;
	foreach ($matches[2] as $img_url)
	{
		if (!preg_match('#^[A-z]+://#', $img_url)) {
			$result[$i]['url'] = $img_url;
			if (strstr($img_url, $url) !== false)
				$result[$i]['dir'] = str_replace($url, $dir, $img_url);
			else
				$result[$i]['dir'] = $dir . $img_url;
			$result[$i]['name'] = 'cid:' . str_replace('/', '', strrchr($result[$i]['dir'], '/'));
		}
		$i++;
	}
	foreach ($result as $res)
		$text = str_replace($res['url'], urldecode($res['dir']), $text);
	return $result;
}

$groups = SJB_DB::query("SELECT * FROM `user_groups`");
$membership_plans = SJB_MembershipPlanManager::getAllMembershipPlansInfo();


$tp->assign("plans", $membership_plans);
$tp->assign("groups", $groups);
$tp->assign("mail_list", $mail_list);
$tp->display("mailing.tpl");

function sendMailing($text, $img, $emailAddress, $subject, $file = '')
{
	$email = new SJB_Email($emailAddress, '../email_templates/massMailing.tpl', array('subject' => $subject, 'message' => $text));
	if ($file) {
		$email->setFile('../' . $file);
	}
	return $email->send();
}


class SJB_Mailing {
	private $_mailingID;

	/**
	 * array of all mailings from `mailing` table
	 * @var array
	 */
	private $_aMailings = array();

	/**
	 *
	 * @param int $mailingID
	 */
	function __construct($mailingID)
	{
		$this->_mailingID = (int) $mailingID;
	}

	/**
	 *
	 * @param array $aMailings
	 */
	public function setMailingList(array $aMailings)
	{
		$this->_aMailings = $aMailings;
	}

	public function getMailingID()
	{
		return $this->_mailingID;
	}


	/**
	 * check if mailing exists in list
	 * of mailings
	 *
	 * @return int | boolean false
	 */
	public function checkIfMailingExists()
	{
		if ($this->_mailingID) {
			foreach ($this->_aMailings as $mailIndex => $mailItem)
			{
				if ($mailItem['id'] == $this->_mailingID) {
					return $mailIndex;
				}
			}
		}

		return false;

	} // 	public function checkIfMailingExists( $aMailings )

	/**
	 * send mailings
	 * @return boolean
	 */
	public function send()
	{
		$mailIndex = $this->checkIfMailingExists();

		if ($mailIndex !== false) {
			SJB_DB::query("DELETE FROM `mailing_info` WHERE `mailing_id` = ?n", $this->_mailingID);

			foreach ($this->_aMailings[$mailIndex]['mail_arr'] as $i => $val)
			{
				$email_res = SJB_DB::query('SELECT email FROM users WHERE sid=?n', $val['sid']);
				SJB_DB::query("INSERT INTO `mailing_info` (`mailing_id`, `email`, `username`, `status`) VALUES ('{$this->_mailingID}', '{$email_res[0]['email']}', '{$val['username']}', '0')");
			}
			return $this->sendToUndelivered();

		}

		return false;
	}

	/**
	 * send test mailing
	 * @return boolean
	 */
	public function testSend()
	{
		$mailIndex = $this->checkIfMailingExists();

		if ($mailIndex === false) {
			return false;
		}

		$text = $this->_aMailings[$mailIndex]['text'];
		return sendMailing($text, fileImg($text), SJB_Settings::getSettingByName('test_email'), $this->_aMailings[$mailIndex]['subject'], $this->_aMailings[$mailIndex]['file']);
	}

	/**
	 * send mailings to undelivered
	 * @return boolean
	 */
	public function sendToUndelivered()
	{
		$mailIndex = $this->checkIfMailingExists();

		if ($mailIndex === false) {
			return false;
		}

		$aMailing = $this->_aMailings[$mailIndex];

		$text = $aMailing['text'];
		$img = fileImg($text);
		$file = $aMailing['file'];
		$subject = $aMailing['subject'];

		$aNeedToSend = $this->getUndeliveredMailingsInfo();

		if (!is_array($aNeedToSend)) {
			return false;
		}

		foreach ($aNeedToSend as $mailInfo)
		{
			SJB_DB::query("UPDATE `mailing_info` SET `status` = ?n WHERE `id` = ?n", sendMailing($text, $img, $mailInfo['email'], $subject, $file), $mailInfo['emailId']);
		}

		return true;
	}

	/**
	 * get undelivered mailings info list
	 * @return array
	 */
	public function getUndeliveredMailingsInfo()
	{
		return $result = SJB_DB::query("
			SELECT u.sid as sid, u.username, u.user_group_sid, u.language, mi.email, mi.id as emailId
			FROM users u
			INNER JOIN `mailing_info` mi ON mi.`email` = u.`email` AND mi.`username` = u.`username`
			WHERE mi.`status` = 0 AND `mi`.`mailing_id` = ?n AND `mi`.`email` <> ''", $this->_mailingID);
	}

} // class SJB_Mailing
