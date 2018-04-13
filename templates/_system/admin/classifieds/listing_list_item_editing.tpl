{if $complex}
	{if $listing_type_sid}
		{breadcrumbs}
			<a href="{$GLOBALS.site_url}/listing-types/">Listing Types</a> > <a href="{$GLOBALS.site_url}/edit-listing-type/?sid={$listing_type_sid}">{$listing_type_info.name}</a>
			&#187; <a href="{$GLOBALS.site_url}/edit-listing-type-field/?sid={$listing_field_info.sid}">{$listing_field_info.caption}</a>
			&#187; <a href="{$GLOBALS.site_url}/edit-listing-field/edit-fields/?field_sid={$listing_field_info.sid}">Edit Fields</a>
			&#187; <a href="{$GLOBALS.site_url}/edit-listing-field/edit-fields/?sid={$field_sid}&field_sid={$listing_field_info.sid}&action=edit">{$field_info.caption}</a>
			&#187; <a href="{$GLOBALS.site_url}/edit-listing-field/edit-fields/edit-list/?field_sid={$field_sid}">Edit List</a> > {$list_item_value}
		{/breadcrumbs}
	{else}
		{breadcrumbs}
			<a href="{$GLOBALS.site_url}/listing-fields/">Listing Fields</a>
			 &#187; <a href="{$GLOBALS.site_url}/edit-listing-type-field/?sid={$listing_field_info.sid}">{$listing_field_info.caption}</a>
			 &#187; <a href="{$GLOBALS.site_url}/edit-listing-field/edit-fields/?field_sid={$listing_field_info.sid}">Edit Fields</a>
			 &#187; <a href="{$GLOBALS.site_url}/edit-listing-field/edit-fields/?sid={$field_sid}&field_sid={$listing_field_info.sid}&action=edit">{$field_info.caption}</a>
			 &#187; <a href="{$GLOBALS.site_url}/edit-listing-field/edit-fields/edit-list/?field_sid={$field_sid}">Edit List</a> > {$list_item_value}
		{/breadcrumbs}
	{/if}
{else}
	{if $listing_type_sid}
		{breadcrumbs}
			<a href="{$GLOBALS.site_url}/listing-types/">Listing Types</a> > <a href="{$GLOBALS.site_url}/edit-listing-type/?sid={$listing_type_sid}">{$listing_type_info.name}</a>
			&#187; <a href="{$GLOBALS.site_url}/edit-listing-type-field/?sid={$field_sid}">{$listing_field_info.caption}</a>
			&#187; <a href="{$GLOBALS.site_url}/edit-listing-field/edit-list/?field_sid={$field_sid}">Edit List</a> > {$list_item_value}
		 {/breadcrumbs}
	{else}
		{breadcrumbs}
			<a href="{$GLOBALS.site_url}/listing-fields/">Listing Fields</a>
			&#187; <a href="{$GLOBALS.site_url}/edit-listing-field/?sid={$field_sid}">{$listing_field_info.caption}</a>
			&#187; <a href="{$GLOBALS.site_url}/edit-listing-field/edit-list/?field_sid={$field_sid}">Edit List</a> > {$list_item_value}
		 {/breadcrumbs}
	{/if}
{/if}
<h1>Edit List Item</h1>
{include file='field_errors.tpl'}

<fieldset>
	<legend>Edit List Item</legend>
	<form method="post" action="">
	<input type="hidden" name="action" value="save"/>
	<input type="hidden" name="field_sid" value="{$field_sid}"/>
	<input type="hidden" name="item_sid" value="{$item_sid}"/>
		<table>
			<tr>
				<th>Value </th>
				<th><input type="text" name="list_item_value" value="{$list_item_value}"/><font color="red">*</font></th>
			</tr>
			<tr>
				<td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton"/></span></td>
			</tr>
		</table>
	</form>
</fieldset>