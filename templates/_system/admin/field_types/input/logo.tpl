{if $value.file_name ne null}
<a href="{$GLOBALS.site_url}/users/delete-uploaded-file/?username={$username}&amp;field_id={$id}">Delete</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<img src="{$value.file_url}" alt="" border="0" />
<br/><br/>
{/if}
<input type="file" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" class="{if $complexField}complexField{/if}" />