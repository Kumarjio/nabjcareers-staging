{subject}{$GLOBALS.user_site_url}: Password Change{/subject}
{message}
	Dear {$user.username},
	<br /><br />
	You can change your password by following the link below:<br/>
	Your username is: {$user.username}<br/>
	<a href="{$GLOBALS.user_site_url}/change-password/?username={$user.username}&amp;verification_key={$user.verification_key}">Change your password</a>
	<p>{$GLOBALS.settings.site_title}</p>
{/message}