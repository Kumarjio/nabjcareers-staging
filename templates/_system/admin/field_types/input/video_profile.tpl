{if $value.file_url}
	<a href="{$value.file_url}">{$value.file_name}</a>
	|
	<a href="{$GLOBALS.site_url}/users/delete-uploaded-file/?username={$username}&amp;field_id={$id}">Delete</a>
	<br />
{/if}
<input type="file" class="inputVideo" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" class="{if $complexField}complexField{/if}" />