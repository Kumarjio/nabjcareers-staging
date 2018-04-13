{subject}{$GLOBALS.user_site_url}: {$listing.type.id} #{$listing.id} activation{/subject}
{message}
	<p>Dear {$user.username}</p>
	<p>Your listing #{$listing.id}, "{$listing.Title}" was activated.</p>
	<p>Log in to the site and go to <a href="{$GLOBALS.user_site_url}/my-listings/">My Postings</a> section to manage this {$listing.type.id}</p>
	<p>Thank you!</p>
	</p>{$GLOBALS.settings.site_title}</p>
	<hr size="1"/>
	<p>To cancel receiving notifications of this kind you need to <a href="{$GLOBALS.user_site_url}/login/">log in to the site</a> under your account, go to My Notifications and disable the respective option there.</p>
{/message}