{if $contract.recurring_id}
	{subject}{$GLOBALS.user_site_url}: {$plan.name} Subscription Canceled{/subject}
	{message} 
		Dear {$user.username},<br/>
		<br/>
		The recurring payment for {$plan.name} subscription was not made on the renewal date.<br/>
		Therefore your subscription was canceled.<br/>
		<br/>
		For re-subscribing to {$plan.name} or getting another subscription, please go to the <a href="{$GLOBALS.user_site_url}/subscription/">Subscriptions</a> section on "My Account page".<br /> 
		<a href="{$GLOBALS.user_site_url}/login/">Log in to the site.</a><br/>
		<br/>
		For any questions regarding the payment, please contact your payment gateway support. 
		<br />
		Thank you,<br />
		{$GLOBALS.settings.site_title}
	{/message}
{else}
	{subject}{$GLOBALS.user_site_url}: Subscription Expired{/subject}
	{message}
		Dear {$user.username},<br/>
		Your subscription to {$plan.name} has just expired.<br/>
		To renew this subscription or subscribe to another available plan, go to <a href="{$GLOBALS.user_site_url}/subscription/">Subscriptions</a> section.<br/>
	 	<hr size="1"/>
	 	<p>To cancel receiving notifications of this kind you need to <a href="{$GLOBALS.user_site_url}/login/">log in to the site</a> under your account, go to My Notifications and disable the respective option there.</p>
	 	<p>{$GLOBALS.settings.site_title}</p> 
	{/message}
{/if}