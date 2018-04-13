{breadcrumbs}<a href="{$GLOBALS.site_url}/membership-plans/">Membership Plans</a> &#187; <a href="{$GLOBALS.site_url}/membership-plan/?id={$membership_plan_id}">{$membership_plan_info.name}</a> &#187; Add Package{/breadcrumbs}
<h1>Add Package</h1>

<fieldset>
	<legend>Add a New Package</legend>
	<form method="POST" action="?">
		<input type="hidden" name="action" value="save_package">
		<input type="hidden" name="class_name" value="{$class_name}">
		<input type="hidden" name="membership_plan_id" value="{$membership_plan_id}">
		<table>
			{foreach from=$package_input_form_elements item=form_field key=form_field_id}
				<tr>
					<td>{$form_field.caption}</td>
					<td>{$form_field.element}</td>
				</tr>
				{if $form_field.comment}
					<tr>
						<td colspan="2"><small>{$form_field.comment}</small></td>
					</tr>
				{/if}
			{/foreach}
			<tr>
				<td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton" /></span></td>
			</tr>
		</table>
	</form>
</fieldset>
