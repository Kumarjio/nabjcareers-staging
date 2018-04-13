{breadcrumbs}<a href="{$GLOBALS.site_url}/user-groups/">User Groups</a> &#187; <a href="{$GLOBALS.site_url}/edit-user-group/?sid={$user_group_sid}">{$user_group_info.name}</a> &#187; <a href="{$GLOBALS.site_url}/edit-user-profile/?user_group_sid={$user_group_sid}">Edit User Profile Fields</a> &#187; Add Field{/breadcrumbs}
<h1>Add User Profile Field</h1>
{include file='field_errors.tpl'}

<fieldset>
	<legend>Add a New User Profile Field </legend>
	<form method="post">
		<input type="hidden" name="action" value="add" />
		<input type="hidden" name="user_group_sid" value="{$user_group_sid}" />
		<table>
			{foreach from=$form_fields item=form_field}
				<tr>
					<td>{$form_field.caption} </td>
					<td>{if $form_field.is_required}<font color="red">*</font>{/if}</td>
					<td>{input property=$form_field.id}</td>
				</tr>
			{/foreach}
			<tr><td colspan="3"><span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton" /></span></td></tr>
		</table>
	</form>
</fieldset>