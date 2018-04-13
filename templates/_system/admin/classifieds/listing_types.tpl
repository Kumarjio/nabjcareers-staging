{breadcrumbs}Listing Types{/breadcrumbs}
<h1>Listing Types</h1>
<p><a href="{$GLOBALS.site_url}/add-listing-type/">Add a New Listing Type</a></p>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Number of listings</th>
			<th colspan="3" class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$listing_types item=listing_type}
		<tr class="{cycle values = 'evenrow,oddrow'}">
			<td>{$listing_type.id}</td>
			<td>{$listing_type.caption}</td>
			<td>{$listing_type.listing_number}</td>
			<td align="center"><a href="{$GLOBALS.site_url}/edit-listing-type/?sid={$listing_type.sid}" title="Edit"><img src="{image}edit.png" border="0" alt="Edit" /></a></td>
			{if $listing_type.listing_number > 0}
			{else}
				<td><a href="{$GLOBALS.site_url}/delete-listing-type/?sid={$listing_type.sid}" onclick='return confirm("Are you sure you want to delete this listing type?")' title="Delete"><img src="{image}delete.png" border="0" alt="Delete"/></a></td>
			{/if}
			<td><a href="{$GLOBALS.site_url}/posting-pages/{$listing_type.id|lower}" title="Posting Pages"><img src="{image}postingPages.png" border="0" alt="Posting Pages" /></a></td>
		</tr>
		{/foreach}
	</tbody>
</table>