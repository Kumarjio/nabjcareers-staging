<br/>
{foreach from=$field_errors item=error key=field_caption}
	{if $error eq 'FILE_NOT_SPECIFIED'}
		<p class="error">'{$field_caption}' [[file not specified]]</p>
	{elseif $error eq 'NOT_SUPPORTED_IMAGE_FORMAT'}
		<p class="error">'{$field_caption}' [[not supported image format]]</p>
	{elseif $error eq 'PICTURES_LIMIT_EXCEEDED'}
		<p class="error">'{$field_caption}' [[limit exceeded]]</p>
	{elseif $error eq 'UPLOAD_ERR_INI_SIZE'}
		<p class="error">[[File size exceeds system limit]]</p>
	{elseif $error eq 'UPLOAD_ERR_FORM_SIZE'}
		<p class="error">[[File size exceeds system limit]]</p>
	{elseif $error eq 'UPLOAD_ERR_PARTIAL'}
		<p class="error">[[There was an error during file upload]]</p>
	{elseif $error eq 'UPLOAD_ERR_NO_FILE'}
		<p class="error">'{$field_caption}' [[file not specified]]</p>
	{/if}
{/foreach}
{if $errors != ''}
	{foreach from=$errors item=error_message key=error}
	
		{if $error eq 'WRONG_PARAMETERS_SPECIFIED'}
		<p class="error">[[Wrong parameters are specified]]</p>
	
		{elseif $error eq 'PARAMETERS_MISSED'}
		<p class="error">[[The system cannot proceed as some key parameters are missed]]</p>
	
		{elseif $error eq 'NOT_OWNER'}
		<p class="error">[[You are not owner of this listing]]</p>
		{/if}
		
	{/foreach}

{else}
	{if $number_of_picture < $number_of_picture_allowed}
		<form id="uploadForm" method="post" action="{$GLOBALS.site_url}/manage-pictures/" enctype="multipart/form-data" onsubmit="return UploadSubmit();">
		<input type="hidden" name="action" value="add" />
		<input type="hidden" id="listing_id" name="listing_sid" value="{$listing.id}" />
			<table>
				<tr>
					<td>[[Caption]]</td>
					<td><input type="text" name="caption" value="" /></td>
				</tr>
				<tr>
					<td>[[Add Picture]]</td>
					<td><input type="file" name="picture" /></td>
				</tr>
				<tr>
		        <td></td>
				<td colspan="2">
	          <br/>
					<input type="submit" value="[[Add Picture:raw]]" class="button"/>
					</td>
				</tr>
			</table>
		</form>
		
	{else}
	
		[[You've reached the limit of number of listings allowed by your plan]]
	
	{/if}
	
	<br />
	
	<table cellpadding="5">
		{if $pictures}
		<tr>
			<td>[[Thumbnail]]</td>
			<td>[[Caption]]</td>
			<td colspan="4">[[Actions]]</td>
		</tr>
		{foreach from=$pictures item=picture name=pictures_block}
		
		<tr>
			<td><img src="{$picture.thumbnail_url}" alt="" /></td>
			<td>{$picture.caption|truncate:15}</td>
			<td><a href="{$GLOBALS.site_url}/edit-picture/?listing_sid={$listing.id}&amp;picture_id={$picture.id}" onclick="popUpWindow('{$GLOBALS.site_url}/system/classifieds/edit-picture/?listing_id={$listing.id}&amp;picture_id={$picture.id}', 560, 400, '[[Edit Picture]]', true, {if $GLOBALS.current_user.logged_in}true{else}false{/if}); return false;" class="edit"><img src="{image}b_edit.gif" border="0" alt="" /></a></td>
			<td><a href="{$GLOBALS.site_url}/manage-pictures/?listing_sid={$listing.id}&amp;action=delete&amp;picture_id=" onclick="Delete('{$picture.id}'); return false;" id="delete_picture" style="cursor:pointer;"><img src="{$GLOBALS.site_url}/templates/_system/main/images/b_drop.gif"></a></td>
		</tr>
		{/foreach}
		{/if}
	</table>
{/if}
{literal}
<script>

	function UploadSubmit() {
		var browser=navigator.appName.toLowerCase();
		var options = {
			target: "#UploadPics",
			url:  $("#uploadForm").attr("action") + "?listing_sid=" + {/literal}{$listing.id}{literal},
			success: function(data) {
				if (browser == 'microsoft internet explorer') {
					$("#UploadPics").load(url);
				}
			}
		};
		$("#uploadForm").ajaxSubmit(options);
		return false;
	}
	
	function Delete(picture_id){
		if ( confirm('Are you sure?') ) {
			var options = {
				target: "#UploadPics",
				url:  $("#delete_picture").attr("href") + picture_id
			};
			$("#messageBox").ajaxSubmit(options);
		}
	};
	
</script>
{/literal}