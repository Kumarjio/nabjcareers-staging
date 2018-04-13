<?php

include_once('PHPMailer/class.phpmailer.php');

class SJB_SendContactSeller{
	var $mail = null;
	var $body = '';
	var $fileAttachment = '';
	
	function SJB_SendContactSeller()
	{
		$this->mail = new PHPMailer();
		
	}
	function setBody($body)
	{
		$this->body = $body;
	}
	function setFile($file)
	{
		$this->fileAttachment = $file;
	}
	function send($from,$from_name,$subject,$to,$to_name){
		$this->mail->IsSendmail(); // telling the class to use SendMail transport

		$this->mail->From       =  $from;
		$this->mail->FromName   = $from_name;
		
		$this->mail->Subject    = $subject;
		
		$this->mail->MsgHTML($this->body);
		
		$this->mail->AddAddress($to, $to_name);
		
		$this->mail->AddAttachment($this->fileAttachment); 
		
		return $this->mail->Send();
	}
}


