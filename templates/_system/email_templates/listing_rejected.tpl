{subject}{$GLOBALS.user_site_url}: {$listingTypeId} #{$listing.sid} Rejection{/subject}
{message}
	<p>Dear {$user.username},</p>
	<p>Your {$listingTypeId|strtolower} #{$listing.sid}, {$listing.Title} has been rejected by {$GLOBALS.user_site_url} Administrator and therefore cannot be posted on the site.</p>
	<p>Rejection reason: {$listing.reject_reason}</p>
	<p>If you have any questions or need an assistance, please send a message using the <a href="{$GLOBALS.user_site_url}/contact/">Contact form</a></p>
	<p>Thank you!</p>
	<p>{$GLOBALS.settings.site_title}</p>
	<hr size="1"/>
	<p>To cancel receiving notifications of this kind you need to <a href="{$GLOBALS.user_site_url}/login/">log in to the site</a> under your account, go to My Notifications and disable the respective option there.</p>
{/message} 