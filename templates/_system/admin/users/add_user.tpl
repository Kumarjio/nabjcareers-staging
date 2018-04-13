{breadcrumbs}<a href="{$GLOBALS.site_url}/users/?restore=1&user_group_id={$user_group.id}">Users</a> &#187; Add a New {$user_group.name}{/breadcrumbs}
<h1>Add {$user_group.name}</h1>
{include file="field_errors.tpl"}

<fieldset>
	<legend>Add a New {$user_group.name}</legend>
	<form method="post">
	<input type="hidden" name="action" value="add">
	<input type="hidden" name="user_group_id" value="{$user_group.id}">
		<table>
		{foreach from=$form_fields item=form_field}
			<tr>
				<td valign=top>{$form_field.caption}</td>
				<td valign=top>{if $form_field.is_required} <font color="red">*</font>{/if} </td>
				<td> {input property=$form_field.id}</td>
			</tr>
			{/foreach}
			
			<tr>
				<td colspan="3"><span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton" /></span></td>
			</tr>
		</table>
	</form>
</fieldset>

<script language="javascript">
	
	var user_group_name="{$user_group.id}";
	{literal}
		$(document).ready(function(){
		if(user_group_name=="JobSeeker")
		{
			$('#Manage_Employers').addClass('lmsi');
			$('#Manage_Employers').removeClass('lmsih');
		}
		else
		{
			$('#Manage_Job_Seekers').addClass('lmsi');
			$('#Manage_Job_Seekers').removeClass('lmsih');
		}
 });

	{/literal}
	</script>