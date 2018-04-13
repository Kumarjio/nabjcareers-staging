{breadcrumbs}<a href="{$GLOBALS.site_url}/users/?restore=1&user_group_id={$user_group_id}">Users</a> &#187; <a href="{$GLOBALS.site_url}/edit-user/?username={$username}&user_group_id={$user_group_id}&user_sid={$user_sid}">Edit User Info</a> &#187; Manage Applications{/breadcrumbs}
<h1>Manage Applications for {$username}</h1>
<h3>[[Jobs Applied]]</h3>

{if $applications}
<form method="post" action="">
	<input type="hidden" name="orderBy" value="{$orderBy}" />
	<input type="hidden" name="order" value="{$order}" />
	<input type="hidden" name="username" value="{$username}" />

	<span class="deleteButtonEnd"><input type="submit" name="action" value="[[Delete selected]]" class="deleteButton" onclick="return confirm('Are you sure you want to delete this listing?')"/></span>
	<div class="clr"><br /></div>
	
	<table>
		<thead>
			<tr>
				<th><input type="checkbox" id="all_checkboxes_control"></th>
				<th><a href="?username={$username}&orderBy=date&order={if		$orderBy == "date" 		&& $order == "asc"}desc{else}asc{/if}">[[Date applied]]</a></th>
				<th><a href="?username={$username}&orderBy=title&order={if		$orderBy == "title" 	&& $order == "asc"}desc{else}asc{/if}">[[Job title]]</a></th>
				<th><a href="?username={$username}&orderBy=company&order={if	$orderBy == "company" 	&& $order == "asc"}desc{else}asc{/if}">[[Company]]</a></th>
				<th><a href="?username={$username}&orderBy=status&order={if		$orderBy == "status" 	&& $order == "asc"}desc{else}asc{/if}">[[Status]]</a></th>
			</tr>
		</thead>
		<tbody>
			{foreach item=app from=$applications name=applications}
			<tr class="{cycle values = 'evenrow,oddrow'}">
				<td rowspan="2"><input type="checkbox" name="applications[{$app.id}]" value="1" id="checkbox_{$smarty.foreach.applications.iteration}"/></td>
				<td>{$app.date}</td>
				<td>{if $app.job != NULL}<a href="{$GLOBALS.site_url}/display-listing/?listing_id={$app.job.sid}">{$app.job.Title}</a>{else}[[Not Available Anymore]]{/if}</td>
				<td>{$app.company.CompanyName}</td>
				<td>{$app.status}</td>
			</tr>
			<tr><td colspan="4">[[Cover Letter]]:<br/>{$app.comments}</td></tr>
			{/foreach}
		</tbody>
	</table>
	
</form>
{/if}

<script type="text/javascript">
	var total = {$smarty.foreach.applications.total};
	{literal}
	
	function set_checkbox(param) {
		for (i = 1; i <= total; i++) {
			if (checkbox = document.getElementById('checkbox_' + i))
				checkbox.checked = param;
		}
	}
	
	$("#all_checkboxes_control").click(function() {
		if ( this.checked == false)
			set_checkbox(false);
		else
			set_checkbox(true);
	});
</script>
{/literal}