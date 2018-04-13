{breadcrumbs}<a href="{$GLOBALS.site_url}/manage-listings/?restore=1">Manage Listings</a> &#187; <a href="{$GLOBALS.site_url}/edit-listing/?listing_id={$listing_id}">Edit Listing</a> &#187; Manage Pictures{/breadcrumbs}
<h1>Manage Listing Pictures</h1>

{foreach from=$field_errors item=error key=field_caption}
	{if $error eq 'FILE_NOT_SPECIFIED'}
		<p class="error">'{$field_caption}' file not specified</p>
	{elseif $error eq 'NOT_SUPPORTED_IMAGE_FORMAT'}
		<p class="error">'{$field_caption}' not supported image format</p>
	{/if}
{/foreach}

<fieldset>
	<legend>Add a New Picture</legend>
	<table>
		<form method="post" enctype="multipart/form-data">
			<input type="hidden" name="action" value="add">
			<input type="hidden" name="listing_id" value="{$listing_id}">
			<tr>
				<td>Caption</td>
				<td><input type="text" name="caption" value=""></td>
			</tr>
			<tr>
				<td>Picture</td>
				<td><input type="file" name="picture"> <font color="red">*</font></td>
			</tr>
			<tr>
				<td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton" /></span></td>
			</tr>
		</form>
	</table>
</fieldset>

<div class="clr"><br /></div>

<table>
	<thead>
		<tr>
			<td>Thumbnail</td>
			<td>Caption</td>
			<td colspan=4 class="actions">Actions</td>
		</tr>
	</thead>
	<tbody>
		{foreach from=$pictures_info item=picture_info name=pictures_block}
			<tr class="{cycle values = 'evenrow,oddrow'}">
				<td><img src="{$picture_info.thumbnail_url}"></td>
				<td>{$picture_info.caption}</td>
				<td><a href="{$GLOBALS.site_url}/edit-picture/?listing_id={$listing_id}&picture_sid={$picture_info.sid}" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a></td>
				<td><a href="{$GLOBALS.site_url}/manage-pictures/?listing_id={$listing_id}&action=delete&picture_sid={$picture_info.sid}" onclick="return confirm('Are you sure you want to delete this picture?')" title="Delete"><img src="{image}delete.png" border=0 alt="Delete"></a></td>
				<td>
					{if $smarty.foreach.pictures_block.iteration < $smarty.foreach.pictures_block.total}
						<a href="{$GLOBALS.site_url}/manage-pictures/?listing_id={$listing_id}&action=move_down&picture_sid={$picture_info.sid}"><img src="{image}b_down_arrow.gif" border=0></a>
					{/if}
				</td>
				<td>
					{if $smarty.foreach.pictures_block.iteration > 1}
						<a href="{$GLOBALS.site_url}/manage-pictures/?listing_id={$listing_id}&action=move_up&picture_sid={$picture_info.sid}"><img src="{image}b_up_arrow.gif" border=0></a>
					{/if}
				</td>
			</tr>
		{/foreach}
	</tbody>
</table>
