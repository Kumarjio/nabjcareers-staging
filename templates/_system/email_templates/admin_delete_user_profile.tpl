{subject}{$GLOBALS.user_site_url}: {$user_info.username} Profile Deletion {/subject}
{message}
	<p>"{$user_info.username}" User Profile has been deleted from the system by user.</p>
	<p>User email: <a href="mailto:{$user_info.email}">{$user_info.email}</a></p><br />
	<p>{$GLOBALS.settings.site_title}</p>
{/message}