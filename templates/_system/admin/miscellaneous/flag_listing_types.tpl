<h1>Flag Listing Settings</h1>
<table>
	<thead>
	    <tr>
	    	<th>Listing Type</th>
	    	<th class="actions">Actions</th>
	    </tr>
    </thead>
    {foreach from=$listing_types item=type key=key}
	    <tr class="{cycle values = 'evenrow,oddrow'}">
	    	<td>{$type.name}</td>
	    	<td><a href="{$GLOBALS.site_url}/flag-listing-settings/?listing_type_id={$type.id}" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a></td>
	    </tr>
    {/foreach}
</table>