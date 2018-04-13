{breadcrumbs}<a href="{$GLOBALS.site_url}/listing-types/">Listing Fields</a> &#187; {$listing_type_info.name}{/breadcrumbs}
<br/>
<h1>Listing Fields</h1>
<p><a href="{$GLOBALS.site_url}/add-listing-type-field/?listing_type_sid={$listing_type_sid}">Add a New Listing Field</a></p>
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Caption</th>
			<th>Type</th>
			<th>Required</th>
			<th colspan="3" class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$listing_field_sids item=listing_field_sid name=items_block}
			{display property='id' object_sid=$listing_field_sid assign=fieldID}
			{if $fieldID != 'anonymous' && $fieldID != 'access_type' && $fieldID != 'screening_questionnaire'}
			<tr class="{cycle values = 'evenrow,oddrow'}">
				<td>{display property='id' object_sid=$listing_field_sid}</td>
				<td>{display property='caption' object_sid=$listing_field_sid}</td>
				<td>{display property='type' object_sid=$listing_field_sid}</td>
				<td>{display property='is_required' object_sid=$listing_field_sid}</td>
				<td><a href="{$GLOBALS.site_url}/attention-listing-type-field/?listing_sid={$listing_field_sid}"  title="Template Instructions">Template Instructions</a></td>
				<td><a href="{$GLOBALS.site_url}/edit-listing-type-field/?sid={$listing_field_sid}" title="Edit"><img src="{image}edit.png" border="0" alt="Edit"/></a></td>
				<td><a href="{$GLOBALS.site_url}/delete-listing-type-field/?sid={$listing_field_sid}" onclick='return confirm("Are you sure you want to delete this field?")' title="Delete"><img src="{image}delete.png" border="0" alt="Delete"/></a></td>
			</tr>
			{/if}
		{/foreach}
	</tbody>
</table>