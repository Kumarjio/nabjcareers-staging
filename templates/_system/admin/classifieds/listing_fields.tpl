{breadcrumbs}Common Fields{/breadcrumbs}
<h1>Common Fields</h1>
<p><a href="{$GLOBALS.site_url}/add-listing-field/">Add a New Listing Field</a></p>

<table>
	<thead>
		<th>ID</th>
		<th>Caption</th>
		<th>Type</th>
		<th>Required</th>
		<th colspan="3" class="actions">Actions</th>	
	</thead>
	<tbody>
		{foreach from=$listing_field_sids item=listing_field_sid name=items_block}
		<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
			<td>{display property='id' object_sid=$listing_field_sid}</td>
			<td>{display property='caption' object_sid=$listing_field_sid}</td>
			<td>{display property='type' object_sid=$listing_field_sid}</td>
			<td>{display property='is_required' object_sid=$listing_field_sid}</td>
			<td><a href="{$GLOBALS.site_url}/attention-listing-type-field/?listing_sid={$listing_field_sid}"  title="Template Instructions">Template Instructions</a></td>
			<td><a href="{$GLOBALS.site_url}/edit-listing-field/?sid={$listing_field_sid}" title="Edit"><img src="{image}edit.png" border="0" alt="Edit" /></a></td>
			<td><a href="{$GLOBALS.site_url}/delete-listing-field/?sid={$listing_field_sid}" onclick='return confirm("Are you sure you want to delete this field?")' title="Delete"><img src="{image}delete.png" border="0" alt="Delete" /></a></td>
		</tr>
		{/foreach}	
	</tbody>
</table>