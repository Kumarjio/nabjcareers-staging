{subject}{$GLOBALS.user_site_url}: Sub account registration{/subject}
{message}
	Hello,<br />
	You've been just registered as sub user on {$GLOBALS.user_site_url}.<br />
	Here is your access info:<br />
	Username: {$user->getPropertyValue('username')}<br />
	Password: {$request.password.original}<br />
	<p>{$GLOBALS.settings.site_title}</p>
{/message}