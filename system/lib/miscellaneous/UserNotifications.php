<?php

class SJB_UserNotifications
{
	public static function getSettings($user_sid)
	{
		$settings = SJB_DB::query('SELECT * FROM `users_notifications` WHERE `user_sid` = ?n', $user_sid);
		return empty($settings) ? array() : array_pop($settings);
	}
	
	public static function getSettingByName($setting_name, $user_sid)
	{
		$settings = SJB_DB::query('SELECT * FROM `users_notifications` WHERE `user_sid` = ?n', $user_sid);
		$settings = empty($settings) ? array() : array_pop($settings);
		return isset($settings[$setting_name]) ? $settings[$setting_name] : null;
	}
	
	public static function updateSettings($settings, $user_sid)
	{
		$record_exists = SJB_DB::query('SELECT COUNT(*) FROM `users_notifications` WHERE `user_sid` = ?n', $user_sid);
		$record_exists = array_pop(array_pop($record_exists));
		if ($record_exists) {
			SJB_DB::query(
                'UPDATE `users_notifications`
                 SET `notify_on_listing_activation` = ?n,
                  `notify_on_listing_expiration` = ?n,
                  `notify_on_contract_expiration` = ?n,
                  `notify_on_listing_approve_or_reject` = ?n,
                  `notify_on_private_message` = ?n,
                  `notify_subscription_expire_date` = ?n,
                  `notify_subscription_activation` = ?n,
                  `notify_subscription_expire_date_days` = ?n,
                  `notify_listing_expire_date` = ?n,
                  `notify_listing_expire_date_days` = ?n
                  WHERE user_sid = ?n',
			$settings['notify_on_listing_activation'],
            $settings['notify_on_listing_expiration'],
            $settings['notify_on_contract_expiration'],
            $settings['notify_on_listing_approve_or_reject'],
            $settings['notify_on_private_message'],
            $settings['notify_subscription_expire_date'],
            $settings['notify_subscription_activation'],
            $settings['notify_subscription_expire_date_days'],
            $settings['notify_listing_expire_date'],
            $settings['notify_listing_expire_date_days'],
            $user_sid);
		} else {
			SJB_DB::query(
                'INSERT INTO `users_notifications`
                 SET `user_sid` = ?n,
                 `notify_on_listing_activation` = ?n,
                 `notify_on_listing_expiration` = ?n,
                 `notify_on_contract_expiration` = ?n,
                 `notify_on_listing_approve_or_reject` = ?n,
                 `notify_on_private_message` = ?n,
                 `notify_subscription_expire_date` = ?n,
                 `notify_subscription_activation` = ?n,
                 `notify_subscription_expire_date_days` = ?n,
                 `notify_listing_expire_date` = ?n,
                 `notify_listing_expire_date_days` = ?n',
			$user_sid,
                $settings['notify_on_listing_activation'],
                $settings['notify_on_listing_expiration'],
                $settings['notify_on_contract_expiration'],
                $settings['notify_on_listing_approve_or_reject'],
                $settings['notify_on_private_message'],
                $settings['notify_subscription_expire_date'],
                $settings['notify_subscription_activation'],
                $settings['notify_subscription_expire_date_days'],
                $settings['notify_listing_expire_date'],
                $settings['notify_listing_expire_date_days']);
		}
		return true;
	}
	
	public static function isUserNotifiedOnListingActivation($user_sid)
    {
		return SJB_UserNotifications::getSettingByName('notify_on_listing_activation', $user_sid);
	}
	
	public static function isUserNotifiedOnListingExpiration($user_sid)
	{
		return SJB_UserNotifications::getSettingByName('notify_on_listing_expiration', $user_sid);
	}
	
	public static function isUserNotifiedOnContractExpiration($user_sid)
	{
		return SJB_UserNotifications::getSettingByName('notify_on_contract_expiration', $user_sid);
	}
	
	public static function isUserNotifiedOnListingApproveOrReject($user_sid)
	{
		return SJB_UserNotifications::getSettingByName('notify_on_listing_approve_or_reject', $user_sid);
	}
	
	public static function isUserNotifiedOnNewPersonalMessage($user_sid)
	{
		return SJB_UserNotifications::getSettingByName('notify_on_private_message', $user_sid);
	}

    public static function isUserNotifiedOnSubscriptionActivation($user_sid)
	{
		return SJB_UserNotifications::getSettingByName('notify_subscription_activation', $user_sid);
	}

	public static function isUserNotifiedOnRemindSubsriptionExpirationDate($user_sid)
	{
		return SJB_UserNotifications::getSettingByName('notify_subscription_expire_date', $user_sid);
	}
	
	public static function isUserNotifiedOnRemindListingExpirationDate($user_sid)
	{
		return SJB_UserNotifications::getSettingByName('notify_listing_expire_date', $user_sid);
	}
	
	public static function getUsersAndDaysOnSubscriptionExpirationRemind()
	{
		return $result = SJB_DB::query('SELECT `user_sid`, `notify_subscription_expire_date_days` as `days` FROM `users_notifications` WHERE `notify_subscription_expire_date` = 1');
	}
	
	public static function getUsersAndDaysOnListingExpirationRemind()
	{
		return $result = SJB_DB::query('SELECT `user_sid`, `notify_listing_expire_date_days` as `days` FROM `users_notifications` WHERE `notify_listing_expire_date` = 1');
	}
}
