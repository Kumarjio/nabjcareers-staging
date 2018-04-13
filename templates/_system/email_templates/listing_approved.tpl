{subject}{$GLOBALS.user_site_url}: {$listingTypeId} #{$listing.sid} Approval{/subject}
{message}
	<p>Dear {$user.username},</p>
	<p>Your {$listingTypeId|strtolower} #{$listing.sid}, {$listing.Title} has been successfully approved by {$GLOBALS.user_site_url} Administrator.</p>
	<p>Log in to the site and go to <a href="{$GLOBALS.user_site_url}/my-listings/">My Postings</a> section to manage this {$listingTypeId}</p>
	<p>Thank you!</p>
	<p>{$GLOBALS.settings.site_title}</p>
	<hr size="1"/>
	<p>To cancel receiving notifications of this kind you need to <a href="{$GLOBALS.user_site_url}/login/">log in to the site</a> under your account, go to My Notifications and disable the respective option there.</p>
{/message}