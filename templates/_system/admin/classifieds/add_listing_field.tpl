{breadcrumbs}<a href="{$GLOBALS.site_url}/listing-fields/">Listing Fields</a> &#187; Add Listing Fields{/breadcrumbs}
<h1>Add Listing Field</h1>
{include file="field_errors.tpl" errors=$errors}
<fieldset>
	<legend>Add a New Listing Field</legend>
	<form method="post" action="">
	<input type="hidden" name="action" value="add" />
		<table>
			{foreach from=$form_fields key=field_name item=form_field}
			<tr>
				<td valign="top">{$form_field.caption} </td>
				<td valign="top">{if $form_field.is_required}<font color="red">*</font>{/if} </td>
				<td valign="top">{input property=$form_field.id}</td>
			</tr>
			{/foreach}
			<tr>
				<td colspan="3"><span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton" /></span></td>
			</tr>
		</table>
	</form>
</fieldset>
{if $pageCount>0}
	<font style=" font-weight: bold; font-size: 11px;">The created field will be automatically added to Posting Pages #1 of all Listing Types. <br />To move this field to another page you will need to go to the Page #1 and use the Move action.</font> 
{/if}