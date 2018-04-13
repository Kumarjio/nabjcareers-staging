{subject}{$GLOBALS.user_site_url}: {$user.username} Account Approval{/subject}
{message}
	Dear {$user.username},<br /><br />		
	The account you registered on {$GLOBALS.user_site_url} has been successfully approved by Administrator.<br />
	Now your account is active and you may <a href="{$GLOBALS.site_url|cat:"/login/"}">sign in</a> to the site using the following username:<br />
	Username: {$user.username}<br /><br />	
	Thank you!<br />
	{$GLOBALS.user_site_url}
{/message}