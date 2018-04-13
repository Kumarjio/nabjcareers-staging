{if $value.file_name ne null}
    {if $value.saved_file_name}
        <a href="?listing_id={$listing.id}&amp;filename={$value.saved_file_name}">{$value.file_name}</a>
    {else}
        <a href="{$value.file_url}">{$value.file_name}</a>
    {/if}
    | <a href="{$GLOBALS.site_url}/delete-uploaded-file/?listing_id={$listing.id}&amp;field_id={$id}">[[Delete]]</a>
    <br/><br/>
{/if}
<input type="file" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" class="{if $complexField}complexField{/if}"/>