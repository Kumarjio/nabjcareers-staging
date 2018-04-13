<?php

require_once ("miscellaneous/Notifications.php");
require_once ("miscellaneous/UserNotifications.php");

define('PM_STATUS_NEW', 0);
define('PM_STATUS_READ', 1);
define('PM_STATUS_REPLIED', 2);

class SJB_PrivateMessage {
	
	var $user_id = 0;
	
	
	/**
	 * get page navigation
	 *
	 * @param unknown_type $page
	 * @param unknown_type $total
	 * @param unknown_type $per_page
	 * @return unknown
	 */
	function getNavigate($page = 1, $totalMessages = 1, $per_page = 10)
	{
		$total_page = ceil ( $totalMessages / $per_page );
		
		$tmp = array ();
		for($i = 1; $i <= $total_page; $i ++) {
			if ($i > $total_page)
				break;
			if ($total_page == 1)
				break;
			$tmp [$i] = ($i == $page ? "" : $i);
		}
		return $tmp;
	}
	
	
	/**
	 * METHOD MARKED TO DELETE
	 *
	 * @return unknown
	 */
/*
	function getUserId() {
		if (SJB_UserManager::isUserLoggedIn ()) {
			$user_info = SJB_UserManager::getCurrentUserInfo ();
			return $user_info ['sid'];
		}
		return 0;
	}
*/
	
	
	/**
	 * Mark messages as read. 
	 * Incoming param is hash of private messages SIDs or single message SID.
	 *
	 * @param array|integer $messageSIDs
	 */
	function markAsRead($messageSIDs)
	{
		if (empty($messageSIDs)) {
			return;
		}
		if (is_array ( $messageSIDs )) {
			
			foreach ($messageSIDs as $key => $sid) {
				if (!SJB_PrivateMessage::isMyMessage( $sid ) || empty($sid)) {
					unset($messageSIDs[$key]);
				}
			}
			SJB_DB::query("UPDATE `private_message` SET `status` = ?n WHERE `id` IN (?l)", PM_STATUS_READ, $messageSIDs);

		} else {
			$sid = intval($messageSIDs);
			if (SJB_PrivateMessage::isMyMessage( $sid )) {
					SJB_DB::query ( "UPDATE `private_message` SET `status` = ?n WHERE `id` = ?n", PM_STATUS_READ, $sid );
			}
		}
	}
	
	
	/**
	 * Delete private messages.
	 * 
	 * Incoming param is hash of private messages SIDs or single message SID.
	 *
	 * @param array|integer $messageSIDs
	 */
	function delete($messageSIDs)
	{
		if (empty($messageSIDs)) {
			return;
		}
		if (is_array ( $messageSIDs )) {
			
			foreach ($messageSIDs as $key => $sid) {
				if (!SJB_PrivateMessage::isMyMessage( $sid ) || !is_numeric($sid) || empty($sid)) {
					unset($messageSIDs[$key]);
				}
			}
			$sidsString = join(',', $messageSIDs);
			
			SJB_DB::query("DELETE FROM `private_message` WHERE `id` IN (?w)", $sidsString);

		} else {
			$sid = intval($messageSIDs);
			if (SJB_PrivateMessage::isMyMessage( $sid )) {
				SJB_DB::query ( "DELETE FROM `private_message` WHERE `id` = ?n", $sid );
			}
		}
	}
	
	
	/**
	 * Send private message
	 *
	 * @param integer $from
	 * @param integer $to
	 * @param string $subject
	 * @param string $message
	 * @param boolean $copy       Save copy in outbox
	 * @param boolean $reply_id   if we reply to message with $reply_id, mark it as replied
	 */
	function sendMessage($from, $to, $subject, $message, $copy = true, $reply_id = false, $cc = false, $anonym = 0)
	{
		$date = date ( 'Y-m-d H:i:s' );
		// to anonymous resume
		$anonym = $anonym ? $anonym : 0;

		if (SJB_DB::query("INSERT INTO `private_message` SET `from_id`=?n, `to_id`=?n, `data`=?s, `subject`=?s, `message`=?s, `anonym` = ?n", $from, $to, $date, $subject, $message, $anonym )) {
			if (SJB_UserNotifications::isUserNotifiedOnNewPersonalMessage ( $to )) {
				$mess_id = mysql_insert_id ();
				$message_for_notification = SJB_PrivateMessage::readMessage ( $mess_id, true );
				SJB_Notifications::sendNewPrivateMessageLetter ( $to, $from, $message_for_notification, $cc );
			}
			if ($copy) 
			{

				SJB_DB::query("
					INSERT INTO `private_message`
					SET `from_id`=?n, `to_id`=?n, `data`=?s, `subject`=?s, `message`=?s, `outbox`=1, `anonym` = ?n", $from, $to, $date, $subject, $message, $anonym );
			}
			if ($reply_id) {
				SJB_DB::query ( "UPDATE `private_message` SET `status`=?n WHERE id = ?n",PM_STATUS_REPLIED, $reply_id );
			}
		}
	}
	
	
	/**
	 * Get list of inbox messages by user id
	 *
	 * @param integer $user_id
	 * @param integer $page
	 * @param integer $per_page
	 * @return array
	 */
	function getListInbox($user_id, $page = 1, $per_page = 10)
	{
		$from = ($page - 1) * $per_page;
		$res = SJB_DB::query("
			SELECT * FROM `private_message` 
			WHERE `to_id` = ?n AND `outbox` = 0 
			ORDER BY `id` DESC 
			LIMIT {$from}, {$per_page}", $user_id );
			
		$list = array ();
		foreach ( $res as $one ) {
			$list [] = SJB_PrivateMessage::readMessage ( $one ['id'], true );
		}
		return $list;
	}
	
	
	/**
	 * Get list of outbox messages by user id
	 *
	 * @param integer $user_id
	 * @param integer $page
	 * @param integer $per_page
	 * @return array
	 */
	function getListOutbox($user_id, $page = 1, $per_page = 10)
	{
		$from = ($page - 1) * $per_page;
		$res = SJB_DB::query("
			SELECT * FROM `private_message` 
			WHERE `from_id` = ?n AND `outbox` = 1 
			ORDER BY `id` DESC 
			LIMIT {$from}, {$per_page}", $user_id );
			
		$list = array ();
		foreach ( $res as $one ) {
			$list [] = SJB_PrivateMessage::readMessage ( $one ['id'], true );
		}
		return $list;
	}
	
	
	/**
	 * read private message
	 *
	 * @param integer $id
	 * @param boolean $system   true - if admin
	 * @return array|boolean
	 */
	function readMessage($id, $system = false)
	{
		$res = SJB_DB::query ( "SELECT * FROM `private_message` WHERE `id`=?n", $id );
		if (isset ( $res [0] ['data'] )) {

			$status = $res[0]['status'];
			
			if (!$system && $status != PM_STATUS_REPLIED)
				SJB_DB::query ( "UPDATE `private_message` SET `status` = ?n WHERE id = ?n", PM_STATUS_READ, $id );
			
			$from_user = SJB_UserManager::getUserInfoBySID ( $res [0] ['from_id'] ); // LastName FirstName username
			$to_user   = SJB_UserManager::getUserInfoBySID ( $res [0] ['to_id'] );
			
			$res [0] ['from_name']       = $from_user ['username'];
			$res [0] ['from_first_name'] = (isset($from_user ['FirstName'])?$from_user ['FirstName']:$from_user['ContactName']);
			$res [0] ['from_last_name']  = (isset($from_user ['LastName'])?$from_user ['LastName']:'');
			
			$res [0] ['to_name']       = $to_user ['username'];
			$res [0] ['to_first_name'] = (isset($to_user ['FirstName'])?$to_user ['FirstName']:$to_user['ContactName']);
			$res [0] ['to_last_name']  = (isset($to_user ['LastName'])?$to_user ['LastName']:'');
			$res [0] ['time']          = strtotime($res [0] ['data']); 			
			$res [0] ['message']       = stripslashes ( $res [0] ['message'] );
			return $res [0];
		}
		return false;
	}
	
	
	/**
	 * Strip tags from string
	 *
	 * @param string $string
	 * @return string
	 */
	function cleanText($string)
	{
		if (SJB_Settings::getValue('escape_html_tags') === 'htmlpurifier') {
			$filters = str_replace(',', '', SJB_Settings::getSettingByName('htmlFilter')); // выбираем заданные админом тэги для конвертации
			$string = strip_tags($string, $filters);
		}
		return $string;
	}
	
	
	/**
	 * Check message owner by message id
	 *
	 * @param integer $id
	 * @return boolean
	 */
	function isMyMessage($id)
	{
		if (SJB_System::getSystemSettings ( 'SYSTEM_ACCESS_TYPE' ) == 'admin')
			return true;
		
		$user_id = SJB_UserManager::getCurrentUserSID();
		$mes     = SJB_PrivateMessage::readMessage ( $id, true );
		
		if ($mes)
			return ($mes ['from_id'] == $user_id || $mes ['to_id'] == $user_id);
		return false;
	}
	
	// PAGING - COUNTING	
	
	/**
	 * Get total count of inbox messages 
	 *
	 * @param integer $user_id
	 * @return integer
	 */
	function getTotalInbox($user_id)
	{
		$result = SJB_DB::query("
			SELECT COUNT(*) AS `num` 
				FROM `private_message` 
			WHERE `to_id` = ?n AND `outbox` = 0", $user_id );
		
		return (isset ( $result [0] ['num'] ) ? $result [0] ['num'] : 0);
	}
	
	
	/**
	 * Get total count of outbox messages
	 *
	 * @param integer $user_id
	 * @return integer
	 */
	function getTotalOutbox($user_id)
	{
		$result = SJB_DB::query("
			SELECT COUNT(*) AS `num` 
				FROM `private_message` 
			WHERE `from_id` = ?n AND `outbox` = 1", $user_id );
		
		return (isset ( $result [0] ['num'] ) ? $result [0] ['num'] : 0);
	}
	
	
	/**
	 * Get count of unread private messages by user id
	 *
	 * @param integer $user_id
	 * @return integer
	 */
	function getCountUnreadMessages($user_id)
	{
		$result = SJB_DB::query("
			SELECT COUNT(*) AS `num` 
				FROM `private_message`
			WHERE `to_id` = ?n AND `status` = 0 AND `outbox` = 0", $user_id );
		
		return (isset ( $result [0] ['num'] ) ? $result [0] ['num'] : 0);
	}
	
}