{if $reactivation}
	{subject}{$GLOBALS.user_site_url}: {$plan.name} Subscription Renewal{/subject}
	{message} 
		Dear {$user.username},<br/>
		Your subscription to {$plan.name} Membership Plan was successfully renewed.<br/>  
		To see your next renewal date, click on the <a href="{$GLOBALS.user_site_url}/subscription/">Subscriptions</a> menu on "My Account" page and opposite the Subscription Name you'll see a date listed next to the "Renewal Date" heading. This means that your subscription is paid up to that day and your card will be charged again on that date.<br/>
		Thank you,<br/>
		{$GLOBALS.settings.site_title}
	{/message}
{else}
	{subject}{$GLOBALS.user_site_url}: Subscription Activation{/subject}
	{message}
	    Dear {$user.username},<br/>
	    Your were successfully subscribed to "{$membershipPlanInfo.name}" Membership Plan.<br/>
	    Thank you,<br/>
	    {$GLOBALS.settings.site_title}
	{/message}
{/if}