{breadcrumbs}<a href="{$GLOBALS.site_url}/users/?restore=1&user_group_id={$user_group_id}">Users</a> > <a href="{$GLOBALS.site_url}/edit-user/?username={$username}&user_group_id={$user_group_id}&user_sid={$user_sid}">Edit User Info</a> > Personal Messages{/breadcrumbs}
<h1>Manage Personal messages for {$username}</h1>
<h3>[[Select folder]]</h3>

<table>
	<thead>
		<tr>
			<th>Folder</th>
			<th align="center">Action</th>
		</tr>
	</thead>
	<tbody>
		<tr class="{cycle values = 'evenrow,oddrow'}">
			<td>[[Inbox]] ({$total_in})</td>
			<td width="20%" align="center"><a href="{$GLOBALS.site_url}/private-messages/pm-inbox/?username={$username}&user_group_id={$user_group_id}&user_sid={$user_sid}" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a></td>
		</tr>
		<tr class="{cycle values = 'evenrow,oddrow'}">
			<td>[[Outbox]] ({$total_out})</td>
			<td width="20%" align="center"><a href="{$GLOBALS.site_url}/private-messages/pm-outbox/?username={$username}&user_group_id={$user_group_id}&user_sid={$user_sid}" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a></td>
		</tr>
	</tbody>
</table>