{breadcrumbs}Admin Password{/breadcrumbs}
<h1>Admin Password</h1>
{if $message}
	<p class="message">{$message}</p>
{/if}

<form method="post">
	<fieldset>
		<legend>Change Administrator's Username and Password</legend>
		<input type="hidden" name="action" value="change_admin_account" />
			<table>
				{foreach from=$form_items key=item_name item=item_params}
					<tr>
						<td>{$item_params.caption}</td>
						{if $item_params.type == 'static'}
							<td>{$item_params.value}</td>
						{else}
							<td><input type="{$item_params.type}" name="{$item_name}" value="{$item_params.value}" class="text" /></td>
						{/if}
					</tr>
				{/foreach}
				<tr>
					<td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Change" class="greenButton" /></span></td>
				</tr>
			</table>
	</fieldset>
</form>