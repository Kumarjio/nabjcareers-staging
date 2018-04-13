{subject}{$GLOBALS.user_site_url}: New {$user.user_group_name} Registration{/subject}
{message}
	<p><strong>New User {$user.username} Has Just Registered at {$GLOBALS.user_site_url}</strong></p>
	<p>UserID: {$user.sid}</p>
	<p>UserGroup: {$user.user_group_name}</p>
	{foreach from=$otherInfo key=key item=value}
		<p>{$key|capitalize|regex_replace:"/_/":" "}: {$value}</p>
	{/foreach}
	<hr size="1" />
	<p>To edit details of this user click <a href="{$GLOBALS.user_site_url}/admin/edit-user/?username={$user.username}">here</a></p>
	<p>To cancel receiving notifications on new users registration, go to the System Settings section of your Admin Panel and disable the "Notify Admin on User Registration" setting.</p>
	<p>{$GLOBALS.settings.site_title}</p>
{/message}