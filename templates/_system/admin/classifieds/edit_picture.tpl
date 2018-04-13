{breadcrumbs}<a href="{$GLOBALS.site_url}/manage-listings/?restore=1">Manage Listings</a> &#187; <a href="{$GLOBALS.site_url}/edit-listing/?listing_id={$listing_id}">Edit Listing</a> &#187; <a href="{$GLOBALS.site_url}/manage-pictures/?listing_id={$listing_id}">Manage Pictures</a> &#187; Edit Picture{/breadcrumbs}
<h1>Edit Picture</h1>

<fieldset>
	<legend>Edit Picture</legend>
	<form method="post" action="">
		<input type="hidden" name="picture_sid" value="{$picture_sid}"/>
		<input type="hidden" name="listing_id" value="{$listing_id}"/>
		<table>
			<tr>
				<td>Picture</td>
				<td><img src="{$picture.thumbnail_url}" alt=""/></td>
			</tr>
			<tr>
				<td>Caption</td>
				<td><input type="text" name="picture_caption" value="{$picture.caption}"/></td>
			</tr>
			<tr>
				<td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton" /></span></td>
			</tr>
		</table>
	</form>
</fieldset>