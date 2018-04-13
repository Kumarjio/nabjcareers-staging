{if $value.file_name ne null}
<a href="{$value.file_url}">{$value.file_name}</a> 
| <a href="{$GLOBALS.site_url}/delete-uploaded-file/?listing_id={$listing_id}&amp;field_id={$id}">Delete</a>
<br/><br/>
{/if}
<input type="file" class="inputVideo" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" class="{if $complexField}complexField{/if}" />