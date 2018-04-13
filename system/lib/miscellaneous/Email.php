<?php

/*
 * $Id: Email.php 3830 2010-09-13 06:45:52Z nwy $
 */

include_once('PHPMailer/class.phpmailer.php');

class SJB_Email
{
	
	var $mail 			 = NULL;
	var $text 			 = NULL;
	var $subject 		 = NULL;
	var $recipient_email = NULL;

	var $reply_to = NULL;
	var $fileAttachment = null;
	
	private $cc = '';

	function SJB_Email($recipient_email, $template, $data)
	{
		$this->recipient_email = $recipient_email;
		$tp = SJB_System::getTemplateProcessor();
		$this->registerTags($tp);
		foreach ($data as $key => $value)
			$tp->assign($key, $value);
		
		$at = $tp->getSystemAccessType();
		$tp->setSystemAccessType('user');
		$tp->fetch($template);
		$tp->setSystemAccessType($at);
	}
	
	public function addCC($cc)
	{
		$this->cc = $cc;
	}
	
	function registerTags(&$tp)
	{
		$tp->register_block("subject", array(&$this, "parseLetterSubject"));
		$tp->register_block("message", array(&$this, "parseLetterMessage"));
		$tp->register_block("tr", array(&$this, "translate"));
	}
		
	function translate($params, $phrase_id, &$smarty, $repeat)
	{
		if ($repeat)
		    return null; // see Smarty manual

		$this->i18n = SJB_I18N::getInstance();
		$mode = isset($params['mode']) ? $params['mode'] : null;
		$phrase_id = trim($phrase_id);
		$domain = isset($params['domain']) ? $params['domain'] : null;
		$res = $this->i18n->gettext($domain, $phrase_id, $mode);
		return $this->replace_with_template_vars($res, $smarty);
	}

	function replace_with_template_vars($res, &$smarty)
	{
		if (preg_match_all("/{[$]([a-zA-Z0-9_]+)}/", $res, $matches)) {
			foreach($matches[1] as $varName){
				$value = $smarty->get_template_vars($varName);
				$res = preg_replace("/{[$]".$varName."}/u",$value,$res);
			}
		}
		return $res;
	}
	
	function parseLetterSubject($params, $content, &$tp, &$repeat)
	{
		$this->subject = $content;
	}

	function parseLetterMessage($params, $content, &$tp, &$repeat)
	{
		$this->text = $content;
	}

	function getText()
	{
		return $this->text;
	}
	
	function setReplyTo($reply_to)
	{
		$this->reply_to = $reply_to;
	}
	
	function setFile($file)
	{
		$this->fileAttachment = $file;
	}

	function send($fromEmail = false)
	{
		if (empty($this->recipient_email))
			return false;

		$mail = new PHPMailer();
		$mail->MsgHTML( $this->text);
		$mail->From			= SJB_Settings::getSettingByName('system_email');
		$mail->FromName		= SJB_Settings::getSettingByName('FromName');
		$mail->Subject		= $this->subject;
		$mail->AddAddress($this->recipient_email);
		$mail->Sender		= SJB_Settings::getSettingByName('notification_email');
		$mail->CharSet		= "UTF-8";
		if (!empty($this->cc)) {
			$mail->AddCC($this->cc);
		}
		
		if (SJB_Settings::getSettingByName('smtp') == 1) {
			try {			
				$mail->IsSMTP();
				$mail->Port = SJB_Settings::getSettingByName('smtp_port');
				$mail->SMTPAuth = true;
				$mail->Host = SJB_Settings::getSettingByName('smtp_host');
				$mail->Username = SJB_Settings::getSettingByName('smtp_username');
				$mail->Password = SJB_Settings::getSettingByName('smtp_password');
				$mail->Sender= SJB_Settings::getSettingByName('smtp_sender');
				$mail->From = SJB_Settings::getSettingByName('smtp_sender');
				$mail->AddReplyTo(SJB_Settings::getSettingByName('system_email'));
				
				$smtpSecurity = SJB_System::getSettingByName('smtp_security');
				if ($smtpSecurity != 'none') {
					$mail->set('SMTPSecure', $smtpSecurity);
				}
			}
			catch (Exception $e) {}
		}
		elseif (SJB_Settings::getSettingByName('smtp') == 0) {
			if (SJB_Settings::getSettingByName('sendmail_path') != '') {
				$mail->isSendmail();
				$mail->setSendmail(SJB_Settings::getSettingByName('sendmail_path'));
			}
		}
		if (!empty($this->reply_to))		
			$mail->AddReplyTo($this->reply_to);			
		
		if ($this->fileAttachment)
			$mail->AddAttachment($this->fileAttachment); 
		
		try {
			$sent = $mail->Send();
			return $sent;
		} catch (Exception $e) {}
		return false;
	}
}

