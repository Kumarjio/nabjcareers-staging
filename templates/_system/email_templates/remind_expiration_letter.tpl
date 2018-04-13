{if $type == 'contract'}
	{subject}{$GLOBALS.user_site_url}: Remind About Subscription Expiration{/subject}
	{message}
		Dear {$user.ContactName},<br/>
		Your subscription "{$contractInfo.extra_info.name}" is going to expire within next {$days} days.<br/>
		You can subscribe again after current subscription expires.<br/>
		<p>{$GLOBALS.settings.site_title}</p>
		<hr size="1"/>
		<p>To cancel receiving notifications of this kind you need to <a href="{$GLOBALS.user_site_url}/login/">log in to the site</a> under your account, go to My Notifications and disable the respective option there.</p>
	{/message}
{else}
	{subject}{$GLOBALS.user_site_url}: Remind About Listing Expiration{/subject}
	{message}
		Dear {$user.ContactName},<br/>
		Your listing number {$listingInfo.id} titled "{$listingInfo.Title}" is going to expire within next {$days} days.<br/>
		To make your listing available again you just need to activate it after it expires.<br/>
		<p>{$GLOBALS.settings.site_title}</p>
		<hr size="1"/>
		<p>To cancel receiving notifications of this kind you need to <a href="{$GLOBALS.user_site_url}/login/">log in to the site</a> under your account, go to My Notifications and disable the respective option there.</p>
	{/message}
{/if}