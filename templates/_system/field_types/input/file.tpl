{if $complexField && $filesInfo.$complexStep.file_name ne null}
	<div class="complex-view-file-caption">
		{if $filesInfo.$complexStep.saved_file_name}
			<a href="?listing_id={$listing.id}&amp;filename={$filesInfo.$complexStep.saved_file_name}">{$filesInfo.$complexStep.file_name}</a>
		{else}
			<a href="{$filesInfo.$complexStep.file_url}">{$filesInfo.$complexStep.file_name}</a>
		{/if}
		| <a href="{$GLOBALS.site_url}/delete-complex-file/?listing_id={$listing.id}&amp;field_id={$filesInfo.$complexStep.file_id}">[[Delete]]</a>

		<br/><br/>
    </div>
	<input type="hidden" id="hidden_{$complexField}_{$id}_{$complexStep}" name="{$complexField}[{$id}][{$complexStep}]" value="{$filesInfo.$complexStep.file_id}" class="complexField"/>
{/if}
{if !$complexField && $value.file_name ne null}

	{if $form_field.id== "Resume"}<span style="color: orange;">Current uploaded resume : </span>{/if}
    {if $value.saved_file_name}
        <a href="?listing_id={$listing.id}&amp;filename={$value.saved_file_name}">{$value.file_name}</a>
    {else}
        <a href="{$value.file_url}">{$value.file_name}</a>
    {/if}
    {if $form_field.id== "Resume"}<br/><br/><span style="color: orange;">Click here to delete uploaded resume</span>{/if}
    | <a href="{$GLOBALS.site_url}/classifieds/delete-uploaded-file/?listing_id={$listing.id}&amp;field_id={$id}">[[Delete]]</a>
    <br/><br/>
{/if}
{if $form_field.id== "Resume" && $value.file_name ne null}
<span style="color: orange;">or replace uploaded resume: </span>
{/if}
<input type="file" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" 
class="{if $complexField}complexField{/if}"/>

<span style="color: orange;">(doc,docx, pdf files are accepted)</span>