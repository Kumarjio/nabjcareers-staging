<form method="POST" action="?">
<input type="hidden" name="action" value="save_package">
<input type="hidden" name="id" value="{$membership_plan_id}">

<table>
{foreach from=$package_input_form_elements item=form_field key=form_field_id}
<tr><td>{$form_field.caption}</td><td>{$form_field.element}</td></tr>
{if $form_field.comment}<tr><td colspan='2'><small>{$form_field.comment}</small></td></tr>{/if}
{/foreach}
<tr><td>Package Type</td>
	<td><input type="text" name="class_name" value="ListingPackage"></td></tr>
<tr><td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton" /></span></td></tr>
</table>
</form>