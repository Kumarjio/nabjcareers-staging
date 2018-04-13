{breadcrumbs}<a href="{$GLOBALS.site_url}/listing-types/">Listing Types</a> &#187; {$listing_type_info.name}{/breadcrumbs}
<h1>Edit Listing Type Info</h1>
{include file="errors.tpl" errors=$errors}

<fieldset>
    <legend>Listing Type Info</legend>
    <form method="post" action="">
    	<input type="hidden" name="action" value="save_info" />
        <input type="hidden" name="sid" value="{$listing_type_info.sid}" />
        <table>
        		{foreach from=$form_fields key=field_name item=form_field}
        		<tr>
        			<td valign="top">{$form_field.caption}</td>
        			<td valign="top">{if $form_field.is_required}<font color="red">*</font>{/if}</td>
        			<td valign="top">{input property=$form_field.id}</td>
        		</tr>
        		{/foreach}
        		<tr>
        			<td colspan="3" align="right"><span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton" /></span></td>
        		</tr>
        </table>
    </form>
</fieldset>
<p><a href="{$GLOBALS.site_url}/posting-pages/{$listing_type_info.id|lower}">Edit Posting Pages</a></p>
