{subject}{$GLOBALS.user_site_url}: Account Activation{/subject}
{message}
	Hello {$user.ContactName}!<br /><br />
	You have created a new account, <i>"{$user.username}"</i>, on {$GLOBALS.user_site_url}.<br />
	Please follow the link below to activate your account:<br />
	<a href="{$GLOBALS.user_site_url}/activate-account/?username={$user.username}&amp;activation_key={$user.activation_key}">Activate account</a><br />
	Thank you,<br/>
	{$GLOBALS.settings.site_title}
{/message}