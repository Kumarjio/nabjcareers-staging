{breadcrumbs}<a href="{$GLOBALS.site_url}/users/?restore=1">Users</a> &#187; Add a New User{/breadcrumbs}
<h1>Choose User Group</h1>
<p>Please select the appropriate user group:</p>
{foreach from=$user_groups_info item=user_group_info}
	<p><a href="?user_group_id={$user_group_info.id}">{$user_group_info.name}</a></p>
{/foreach}

