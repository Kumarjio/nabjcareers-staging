{breadcrumbs}User Groups{/breadcrumbs}
<h1>User Groups</h1>
<p><a href="{$GLOBALS.site_url}/add-user-group/">Add a New User Group</a></p>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Template</th>
			<th>Description</th>
			<th>User number</th>
			<th colspan="3" class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$user_groups item=user_group}
			<tr class="{cycle values = 'evenrow,oddrow'}">
				<td>{$user_group.id}</td>
				<td>{$user_group.caption}</td>
				<td>{$user_group.reg_form_template}</td>
				<td>{$user_group.description}</td>
				<td>{$user_group.user_number}</td>
				<td><a href="{$GLOBALS.site_url}/edit-user-group/?sid={$user_group.sid}" title="Edit"><img src="{image}edit.png" border="0" alt="Edit" /></a></td>
				<td><span class="greenButtonEnd"><input type="button" onclick="location.href='{$GLOBALS.site_url}/system/users/acl/?type=group&amp;role={$user_group.sid}'" class="greenButton" value="Manage permissions" /></span></td>
					{if $user_group.user_number > 0}
					{else}
						<td><a href="{$GLOBALS.site_url}/delete-user-group/?sid={$user_group.sid}" onclick="return confirm('Are you sure you want to delete this user group?')" title="Delete"><img src="{image}delete.gif" border=0 alt="Delete"></a></td>
					{/if}
			</tr>
		{/foreach}
		<tr class="{cycle values = 'evenrow,oddrow'}">
			<td colspan="5">Guest</td>
			<td></td>
			<td><span class="greenButtonEnd"><input type="button" onclick="location.href='{$GLOBALS.site_url}/system/users/acl/?type=guest&amp;role=guest'" class="greenButton" value="Manage permissions"/></span></td>
		</tr>
	</tbody>
</table>