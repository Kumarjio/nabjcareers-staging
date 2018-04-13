{subject}{$GLOBALS.user_site_url}: {$user.username} Account Rejection{/subject}
{message}
	Dear {$user.username},<br /><br />	
	The account you registered on {$GLOBALS.user_site_url} has been rejected by Administrator and therefore cannot be activated.<br />
	Rejection reason: {$user.reason}<br /><br />
	
	If you have any questions or need an assistance, please send a message using the <a href="{$GLOBALS.user_site_url}/contact/">Contact form</a><br />
	Thank you!<br />
	{$GLOBALS.user_site_url}
{/message}