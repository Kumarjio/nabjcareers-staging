{subject}{$GLOBALS.user_site_url}: Listing {$listing.id} Has Just Expired{/subject}
{message}
	<p>Dear {$user.ContactName},</p>
	<p>Your posting #{$listing.id}, "{$listing.Title}" has just expired.</p>
	<p>To activate it again, go to <a href="{$GLOBALS.user_site_url}/my-listings/">My Postings</a> section and use the "Activate" link opposite the expired #{$listing.id} posting.</p>
	<p>Thank you!</p>
	<p>{$GLOBALS.settings.site_title}</p>
	<hr size="1" />
	<p>To cancel receiving notifications of this kind you need to <a href="{$GLOBALS.user_site_url}/login/">log in to the site</a> under your account, go to My Notifications and disable the respective option there.</p>
{/message}