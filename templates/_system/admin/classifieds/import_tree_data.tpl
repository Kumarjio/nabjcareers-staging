{if $field.listing_type_sid}
	{breadcrumbs}
		<a href="{$GLOBALS.site_url}/listing-types/">Listing Types</a> > <a href="{$GLOBALS.site_url}/edit-listing-type/?sid={$type_sid}">{$type_info.name}</a>
		&#187; <a href="{$GLOBALS.site_url}/edit-listing-type-field/?sid={$field_sid}">{$field.caption}</a>
		&#187; <a href="{$GLOBALS.site_url}/edit-listing-field/edit-tree/?field_sid={$field_sid}">Edit Tree</a>
		&#187; Import Tree Data
	{/breadcrumbs}
{else}
	{breadcrumbs}
		<a href="{$GLOBALS.site_url}/listing-fields/">Common Fields</a>
		&#187; <a href="{$GLOBALS.site_url}/edit-listing-field/?sid={$field_sid}">{$field.caption}</a>
		&#187; <a href="{$GLOBALS.site_url}/edit-listing-field/edit-tree/?field_sid={$field_sid}">Edit Tree</a>
		&#187; Import Tree Data
	{/breadcrumbs}
{/if}

<h1>Import Tree Data</h1>

{foreach from=$errors item=error key=field_caption}
	{if $error eq 'EMPTY_VALUE'}
		<p class="error">'{$field_caption}' is empty</p>
	{elseif $error eq 'NOT_INT_VALUE'}
		<p class="error">'{$field_caption}' is not an integer value</p>
	{/if}
{/foreach}

<fieldset>
	<legend>Import Data</legend>
	<form method="post" enctype="multipart/form-data">
	<input type="hidden" name="field_sid" value="{$field.sid}">
		<table>
			<tr>
				<td>File</td>
				<td><input type="file" name="imported_tree_file"> <font color="red">*</font></td>
			</tr>
			<tr>
				<td>File format</td>
				<td>
					<select name="file_format">
					<option value="csv">CSV</option><option value="excel" {if $imported_file_config.file_format == excel}selected{/if}>Excel</option></select>
					<font color="red">*</font>
				</td>
			</tr>
			<tr>
				<td>Start Line</td>
				<td><input type="text" name="start_line" value="{$imported_file_config.start_line}"> <font color="red">*</font></td>
			</tr>
			<tr><td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Import" class="greenButton"></span></td></tr>
		</table>
	</form>
</fieldset>