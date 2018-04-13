{breadcrumbs}<a href="{$GLOBALS.site_url}/users/?restore=1&user_group_id={$user_group_id}">Users</a> 
	&#187; <a href="{$GLOBALS.site_url}/edit-user/?username={$username}&user_group_id={$user_group_id}&user_sid={$user_sid}">Edit User Info</a> 
	&#187; <a href="{$GLOBALS.site_url}/private-messages/pm-main/?username={$username}&user_group_id={$user_group_id}&user_sid={$user_sid}">Personal Messages</a>
{if $returt_to == "in"}
	&#187; <a href="{$GLOBALS.site_url}/private-messages/pm-inbox/?username={$username}&user_group_id={$user_group_id}&user_sid={$user_sid}">Inbox</a>
{else}
	&#187; <a href="{$GLOBALS.site_url}/private-messages/pm-outbox/?username={$username}&user_group_id={$user_group_id}&user_sid={$user_sid}">Outbox</a>
{/if}
	&#187; Message detail
{/breadcrumbs}

<h1>Manage Personal messages for {$username}</h1>

<h3>[[Message detail]]</h3>

<table> 
{if $message.outbox == 0}
	<tr>
		<td>[[Message from:]]</td>
		<td>{$message.from_name}</td>
	</tr>
{else}
	<tr>
		<td>[[Message to:]]</td>
		<td>{$message.to_name}</td>
	</tr>
{/if}
	<tr>
		<td>[[Date:]]</td>
		<td>{$message.data}</td>
	</tr>
	<tr>
		<td>[[Subject:]]</td>
		<td>{$message.subject}</td>
	</tr>
	<tr><td colspan="2">{$message.message}</td></tr>
	<tr><td colspan="2"><a href="{$GLOBALS.site_url}/private-messages/pm-read/?username={$username}&mess={$message.id}&from={$returt_to}&action=delete&page={$page}&user_group_id={$user_group_id}&user_sid={$user_sid}"><img border="0" src="{image}delete.png" id="pm_delete"></a></td></tr>
</table>

{literal}
	<script>
		$("#pm_delete").click(function(){
			if (confirm('{/literal}[[Are you sure?:raw]]{literal}'))
			return true;
			else 
			return false;
		});
	</script>
{/literal}