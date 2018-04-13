{breadcrumbs}<a href="{$GLOBALS.site_url}/users/?restore=1&user_group_id={$user_group_id}">Users</a> &#187; <a href="{$GLOBALS.site_url}/edit-user/?username={$username}&user_group_id={$user_group_id}&user_sid={$user_sid}">Edit User Info</a> &#187; Manage Applications{/breadcrumbs}
<h1>Manage Applications for {$username}</h1>

<form method="post" name="applicationForm" action="">
	<input type="hidden" name="orderBy" value="{$orderBy}" />
	<input type="hidden" name="order" value="{$order}" />
	<input id="action" type="hidden" name="action" value="" />
	<input type="hidden" name="username" value="{$username}" />
	
	<span class="deleteButtonEnd"><input type="submit" value="[[Delete selected]]"	class="deleteButton" onclick="if (confirm('[[Are you sure you want to delete this listing?]]')) submitForm('delete');"/></span>
	<span class="greenButtonInEnd"><input type="submit" value="[[Approve selected]]"	class="greenButtonIn" onclick="submitForm('approve'); return false;"/></span>
	<span class="greenButtonInEnd"><input type="submit" value="[[Reject selected]]" class="greenButtonIn" onclick="submitForm('reject')"/></span>
	
	<div class="clr"><br/></div>
	
	<table>
		<thead>
			<tr>
				<th><input type="checkbox" id="all_checkboxes_control"></th>
				<th><a href="?username={$username}&amp;orderBy=date&amp;order={if		$orderBy == "date" 		&& $order == "asc"}desc{else}asc{/if}">[[Date applied]]</a></th>
				<th><a href="?username={$username}&amp;orderBy=title&amp;order={if		$orderBy == "title" 	&& $order == "asc"}desc{else}asc{/if}">[[Job title]]</a></th>
				<th><a href="?username={$username}&amp;orderBy=applicant&amp;order={if	$orderBy == "applicant" && $order == "asc"}desc{else}asc{/if}">Applicant’s Name</a></th>
				<th><a href="?username={$username}&amp;orderBy=status&amp;order={if		$orderBy == "status" 	&& $order == "asc"}desc{else}asc{/if}">Status</a></th>
			</tr>
		</thead>
		<tbody>
			{foreach item=app from=$applications name=applications}
			<tr class="{cycle values = 'evenrow,oddrow'}">
				<td rowspan="2"><input type="checkbox" name="applications[{$app.id}]" value="1" id="checkbox_{$smarty.foreach.applications.iteration}"/></td>
				<td>{$app.date}</td>
				<td><a href="{$GLOBALS.site_url}/display_listing/?listing_id={$app.job.sid}">{$app.job.Title}</a></td>
				<td>{$app.user.FirstName} {$app.user.LastName}</td>
				<td>{$app.status}</td>
			</tr>
			<tr>
				<td colspan="4">
					<div class="applicationCommentsHeader">[[Cover Letter ]]:</div>
					<div class="applicationComments">
						{$app.comments}
						{if $app.resume}
							<br />- <a href="{$GLOBALS.site_url}/display-listing/?listing_id={$app.resume}">[[Attached resume]]</a>
						{/if}
						{if $app.file}
							<br />- <a href="?appsID={$app.id}&filename={$app.file}">[[View Attached File]]</a>
						{/if}
					</div>
				</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</form>

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

function submitForm(action) {
	document.getElementById('action').value = action;
	var form = document.applicationForm;
	form.submit();
}

</script>
{/literal}