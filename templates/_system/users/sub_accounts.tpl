{if $errors}
	{foreach item='error' from=$errors}
		<p class="error">
			{if $error == 'ACCESS_DENIED'}
				[[You don't have permissions to access this page.]]
			{else}
				{$error}
			{/if}
		</p>
	{/foreach}
{else}
	{if $isSubuserRegistered}
		<p class="message">[[Sub-user registered successfully]]</p>
	{/if}
	
	<a href="{$GLOBALS.site_url}/sub-accounts/new/">[[Create New Account]]</a>
	<div class="clr"><br/></div>
	
	<form method="post" action="{$GLOBALS.site_url}/sub-accounts/">
		<input type="hidden" name="action_name" value="delete" />
		<div class="numberPerPage">
			[[Actions with Selected]]:
			<input type="submit" name="action_delete" value="[[Delete:raw]]" class="button" onclick="return confirm('[[Are you sure?:raw]]')" />
		</div>
		
		<!-- END PER PAGE / NAVIGATION -->
		<div class="clr"><br/></div>
		<div class="results">
			<table cellspacing="0">
				<thead>
					<tr>
						<th class="tableLeft"> </th>
						<th width="1"><input type="checkbox" id="all_checkboxes_control" /></th>
						<th width="50%">{if !$isEmailAsUsername}[[Username]]{/if}</th>
						<th>[[Email]]</th>
						<th colspan="2">[[Actions]]</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$subusers item=subuser name=subuser_block}
					<tr {if $listing.priority == 1}class="priorityListing"{else}class="{cycle values = 'evenrow,oddrow'}"{/if}>
						<td> </td>
						<td><input type="checkbox" name="user_id[]" value="{$subuser.sid}" id="checkbox_{$smarty.foreach.subuser_block.iteration}" /></td>
						<td>{if !$isEmailAsUsername}<a href="{$GLOBALS.site_url}/sub-accounts/edit/?user_id={$subuser.sid}"><strong>{$subuser.username}</strong></a>{/if}</td>
						<td><a href="{$GLOBALS.site_url}/sub-accounts/edit/?user_id={$subuser.sid}"><strong>{$subuser.email}</strong></a></td>
						<td><a href="{$GLOBALS.site_url}/sub-accounts/edit/?user_id={$subuser.sid}">[[Edit]]</a></td><td><a href="{$GLOBALS.site_url}/sub-accounts/?action_name=delete&amp;user_id[]={$subuser.sid}" onclick="return confirm('[[Are you sure?:raw]]')">[[Delete]]</a></td>
					</tr>
					<tr>
						<td colspan="6" class="separateListing"> </td>
					</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</form>
	<script type="text/javascript">
		var total = {$smarty.foreach.subuser_block.total};
		{literal}
		function set_checkbox(param) {
			for (i = 1; i <= total; i++) {
				if (checkbox = document.getElementById('checkbox_' + i))
					checkbox.checked = param;
			}
		}
		
		$("#all_checkboxes_control").click(function() {
			set_checkbox(this.checked);
		});
		{/literal}
	</script>
{/if}