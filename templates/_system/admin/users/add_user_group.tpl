{breadcrumbs}<a href="{$GLOBALS.site_url}/user-groups/">User Groups</a> &#187; Add a New User Group{/breadcrumbs}
{assign var="switchColumns" value=false}
<h1>Add User Group</h1>
{include file="field_errors.tpl"}

<fieldset>
<legend>Add a New User Group</legend>

	<form method="post">
		<input type="hidden" name="action" value="add">
		<table>
			{foreach from=$form_fields key=field_id item=form_field}
			{if $form_field.id == 'notify_on_listing_activation'}
			{assign var="switchColumns" value=true}
		</table>
		<div class="clr"><br/></div>
		<div id="mediumButton" class="setting_button">Default Notification Settings<div class="setting_icon"><div id="accordeonClosed"></div></div></div>
		<div class="setting_block" style="display: none">
			<table>
				<tr><td colspan="3" style='font-size:11px'>This settings will be applied by default for new registered users of this group.</td></tr>
				{/if}
				{if $form_field.id == 'notify_subscription_expire_date' || $form_field.id == 'notify_subscription_expire_date_days' || $form_field.id == 'notify_listing_expire_date' || $form_field.id == 'notify_listing_expire_date_days'}
					{if $form_field.id == 'notify_subscription_expire_date'}
						<tr>
							<td>{input property=$form_field.id} Remind User about Subscriptions Expiration </td>
							<td class="notifications">{input property=$form_fields.notify_subscription_expire_date_days.id}</td>
							<td>Days before <a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&template_name=remind_expiration_letter.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit remind_expiration_letter.tpl" title="Edit remind_expiration_letter.tpl" class="editEmailTemp"/></a></td>
						</tr>
					{elseif $form_field.id == 'notify_listing_expire_date'}
						<tr>
							<td>{input property=$form_field.id} Remind User about Listings Expiration </td>
							<td class="notifications">{input property=$form_fields.notify_listing_expire_date_days.id}</td>
							<td>Days before <a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&template_name=remind_expiration_letter.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit remind_expiration_letter.tpl" title="Edit remind_expiration_letter.tpl" class="editEmailTemp"/></a></td>
						</tr>
					{/if}
				{else}
					<tr>
						{if $switchColumns}
		                    	<td colspan="2">{input property=$form_field.id} {$form_field.caption}</td>
		                    	<td width="25%">{if $form_field.is_required}<font color="red">*</font>{/if}
									{if $form_field.id == "notify_on_listing_activation"}<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&template_name=listing_activation.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit listing_activation.tpl" title="Edit listing_activation.tpl" class="editEmailTemp"/></a>
									{elseif $form_field.id == "notify_on_listing_expiration"}<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&template_name=listing_expired.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit listing_expired.tpl" title="Edit listing_expired.tpl" class="editEmailTemp"/></a>
									{elseif $form_field.id == "notify_on_contract_expiration"}<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&template_name=contract_expired.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit contract_expired.tpl" title="Edit contract_expired.tpl" class="editEmailTemp"/></a>
									{elseif $form_field.id == "notify_on_listing_approve_or_reject"}<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&template_name=listing_rejected.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit listing_rejected.tpl" title="Edit listing_rejected.tpl" class="editEmailTempSec2"/></a> &nbsp; <a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&template_name=listing_approved.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit listing_approved.tpl" title="Edit listing_approved.tpl" class="editEmailTempSec"/></a>
									{elseif $form_field.id == "notify_on_private_message"}<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&template_name=new_private_message.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit new_private_message.tpl" title="Edit new_private_message.tpl" class="editEmailTemp"/></a>{/if}
		                    	</td>
						{else}
		                    	<td valign="top" width="42%">{$form_field.caption} {if $form_field.id == "immediate_activation"}<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&template_name=activation_email.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit activation_email.tpl" title="Edit activation_email.tpl"  style="width: 17px; display: block; float: right; margin: 0;"/></a>{/if}</td>
		                    	<td>{if $form_field.is_required}<font color="red">*</font>{/if} </td>
		                    	<td>{input property=$form_field.id}</td>
						{/if}
					</tr>
		                    {/if}
				{/foreach}
			</table>
		</div>
		<br/><span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton" /></span>
	</form>
</fieldset>

{literal}
<script>

$(".setting_button").click(function(){
	var butt = $(this);
	$(this).next(".setting_block").slideToggle("normal", function(){
			if ($(this).css("display") == "block") {
				butt.children(".setting_icon").html("<div id='accordeonOpen'></div>");
			} else {
				butt.children(".setting_icon").html("<div id='accordeonClosed'></div>");
			}
		});
});


</script>
{/literal}