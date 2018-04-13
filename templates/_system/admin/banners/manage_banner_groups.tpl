{breadcrumbs}Banners{/breadcrumbs}
<h1>Banners Groups</h1>

{foreach from=$errors item=error}
	{$error}
{/foreach} 
<p><a href="{$GLOBALS.site_url}/add-banner-group/">Add a new group</a></p>

<table>
	<thead>
		<tr>
			<th>Group ID</th>
			<th colspan=2 class="actions">Actions</th>
		</tr>
	</thead>
	{foreach from=$bannerGroups item=group}
		<tr class="{cycle values = 'evenrow,oddrow'}">
			<td><a href="{$GLOBALS.site_url}/edit-banner-group/?groupSID={$group.sid|escape}" title="Edit">{$group.id}</a></td>
			<td><a href="{$GLOBALS.site_url}/edit-banner-group/?groupSID={$group.sid|escape}" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a></td>
			<td>
				{capture name="delete_confirm_script"} return confirm('Do you want to delete \'{$group.id|escape:"javascript"}\' banner group? \n (All banners in group will be deleted)') {/capture}
				<a href="?action=delete_banner_group&groupSID={$group.sid|escape}" onclick="{$smarty.capture.delete_confirm_script|escape:"html"}" title="Delete"><img src="{image}delete.png" border=0 alt="Delete"></a>
			</td>
		</tr>
	{/foreach}
</table>