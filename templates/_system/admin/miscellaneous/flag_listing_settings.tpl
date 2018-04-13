{breadcrumbs}Flag Listing Settings{/breadcrumbs}
<h1>Flag Listing Settings</h1>

<form method="post">
	<input type="hidden" name="action" value="save">
	<fieldset id="form_fieldset">
		<legend>Add a New Flag</legend>
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
				<td><input type="text" name="new_value"></td>
				{foreach from=$listing_types item=type}
					<td><input type="checkbox" name="flag_listing_types[]" value="{$type.sid}"></td>
				{/foreach}
				<td colspan="2"><span class="greenButtonEnd"><input type="submit" name="save" value="Add Value" class="greenButton" /></span></td>
			</tr>
		</table>
	</fieldset>
</form>
<br/>

<table>
	<thead>
	    <tr>
	    	<th>Flag Reason</th>
	    	<th>Listing Types</th>
	    	<th class="actions">Actions</th>
	    </tr>
    </thead>
	    {foreach from=$settings item=item key=key}
		    <tr class="{cycle values = 'evenrow,oddrow'}">
		    	<td>{$item.value}</td>
		    	<td>
		    	{* SHOW LIST OF LISTING TYPES FOR THIS FLAG *}
		    	{foreach from=$item.listing_type_sid item=type name=typesCheck}
			    	{assign var=listing_type value=$listing_types.$type}
			    	{$listing_type.name}{if !$smarty.foreach.typesCheck.last}, {/if}
		    	{/foreach}
		    	</td>
		    	<td>
		    		<a href="{$GLOBALS.site_url}/flag-listing-settings/?item_sid={$item.sid}&action=edit" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a>&nbsp;
		    		<a href="{$GLOBALS.site_url}/flag-listing-settings/?item_sid={$item.sid}&action=delete" title="Delete"><img src="{image}delete.png" border=0 alt="Delete"></a>
		    	</td>
		    </tr>
	    {/foreach}
</table>