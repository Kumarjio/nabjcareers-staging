<div class="location"> <a href="{$GLOBALS.site_url}/add-listing/">Add Listing</a> > {$listing_type_info.name}</div>

<p class="page_title">Add Listing</p>

{include file='field_errors.tpl'}

<p>Fields marked with an asterisk (<font color="red">*</font>) are mandatory</p>

<table class="fieldset">
<tr><td>
<fieldset>
<legend>Add a New Listing</legend>


<table>
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="add">
<input type="hidden" name="listing_type_id" value="{$listing_type_id}">

{foreach from=$form_fields item=form_field}
<tr><td>{$form_field.caption}</td><td>{if $form_field.is_required} <font color="red">*</font>{/if} </td><td> {input property=$form_field.id}</td></tr>
{/foreach}

<tr><td><span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton" /></span></td></tr>
</form>
</table>

</fieldset>
</td></tr>
</table>