{breadcrumbs}<a href="{$GLOBALS.site_url}/flag-listing-settings/">Flag Listing Settings</a> &#187; Edit Flag{/breadcrumbs}
<h1>Edit Flag</h1>

<form method="post">
	<input type="hidden" name="item_sid" value="{$current_setting.sid}">
	<input type="hidden" name="action" value="save">
	<fieldset id="form_fieldset"><legend>Edit Flag</legend>
	<table>
		<thead>
			<tr>
				<th>Flag Reason</th>
				{foreach from=$listing_types item=type}
					<th>{$type.name}</th>
				{/foreach}
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tr>
			<td><input type="text" name="new_value" value="{$current_setting.value}"></td>
			{foreach from=$listing_types item=type}
				<td><input type="checkbox" name="flag_listing_types[]" value="{$type.sid}" {if in_array($type.sid, $current_setting.listing_type_sid)} checked="checked"{/if}></td>
			{/foreach}
			<td colspan="2"><span class="greenButtonEnd"><input type="submit" name="save" value="Update Value" class="greenButton" /></span></td>
		</tr>
	</table>
	
	</fieldset>
	
</form>
