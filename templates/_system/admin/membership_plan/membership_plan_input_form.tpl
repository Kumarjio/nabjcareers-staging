<form method="POST" action="?">
<input type="hidden" name="action" value="save_membership_plan">
{if $membership_plan_id}
<input type="hidden" name="id" value="{$membership_plan_id}">
{/if}
<table>
{foreach from=$form_fields item=form_field key=form_field_id}
<tr><td>{$form_field.caption}</td><td>{$form_field.element}</td></tr>
{/foreach}
<tr><td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton" /></span></td></tr>
</table>
</form>