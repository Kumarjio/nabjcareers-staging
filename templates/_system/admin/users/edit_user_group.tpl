{breadcrumbs}<a href="{$GLOBALS.site_url}/user-groups/">User Groups</a> &#187; {$user_group_info.id}{/breadcrumbs}
{assign var="switchColumns" value=false}
<h1>Edit User Group</h1>

{foreach from=$errors key=error item=message}
    {if $error eq "USER_GROUP_SID_NOT_SET"}
	    <p class="error">User group SID is not set</p>
    {/if}
{/foreach}

	<fieldset>
		<legend>User Group Info</legend>
		<form method="post" action="">
			<input type="hidden" name="action" value="save_info" />
			<input type="hidden" name="sid" value="{$object_sid}" />
				<table>
					{foreach from=$form_fields key=field_id item=form_field}
						{if $form_field.id == 'notify_on_listing_activation'}
							{assign var="switchColumns" value=true}
							</table>
							<div id="mediumButton" class="setting_button">Default Notification Settings<div class="setting_icon"><div id="accordeonClosed"></div></div></div>
							<div  class="setting_block" style="display: none">
							<table>
								<tr>
									<td colspan="3" style='font-size:11px'>This settings will be applied by default for new registered users of this group.</td>
								</tr>
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
												{if $form_field.id == "notify_on_listing_activation"}<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&amp;template_name=listing_activation.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit listing_activation.tpl" title="Edit listing_activation.tpl" class="editEmailTemp"/></a>
												{elseif $form_field.id == "notify_on_listing_expiration"}<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&amp;template_name=listing_expired.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit listing_expired.tpl" title="Edit listing_expired.tpl" class="editEmailTemp"/></a>
												{elseif $form_field.id == "notify_on_contract_expiration"}<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&amp;template_name=contract_expired.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit contract_expired.tpl" title="Edit contract_expired.tpl" class="editEmailTemp"/></a>
												{elseif $form_field.id == "notify_on_listing_approve_or_reject"}<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&amp;template_name=listing_rejected.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit listing_rejected.tpl" title="Edit listing_rejected.tpl" class="editEmailTempSec2"/></a> &nbsp; <a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&template_name=listing_approved.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit listing_approved.tpl" title="Edit listing_approved.tpl" class="editEmailTempSec"/></a>
												{elseif $form_field.id == "notify_on_private_message"}<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&amp;template_name=new_private_message.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit new_private_message.tpl" title="Edit new_private_message.tpl" class="editEmailTemp"/></a>
												{elseif $form_field.id == "notify_subscription_activation"}<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&amp;template_name=subscription_activation_letter.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit subscription_activation_letter.tpl" title="Edit subscription_activation_letter.tpl" class="editEmailTemp"/></a>{/if}
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
					<br/><span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton" /></span>
				</form>
			</fieldset>

<div  class="setting_block" style="display: none"></div>
<p><a href="{$GLOBALS.site_url}/edit-user-profile/?user_group_sid={$user_group_sid}">Edit User Profile Fields</a></p>
<p><a href="{$GLOBALS.site_url}/systems/users/acl/?type=group&amp;role={$user_group_sid}">Manage Permissions</a></p>

<br/>
<h2>Membership Plans </h2>
<table>
	<thead>
	    <tr>
	        <th>ID</th>
	        <th>Name</th>
	        <th>User number</th>
	        <th>Default</th>
	        <th colspan="2">Order</th>
	    </tr>
	</thead>
	<tbody>
	    {foreach from=$user_group_membership_plans_info item=membership_plan_info  name=items_block}
	        <tr class="{cycle values = 'evenrow,oddrow'}">
	            <td>{$membership_plan_info.id}</td>
	            <td><a href="{$GLOBALS.site_url}/membership-plan/?id={$membership_plan_info.id}">{$membership_plan_info.name}</a></td>
	            {assign var="membership_plan_sid" value=$membership_plan_info.id}
	            <td>{$user_group_membership_plan_user_number.$membership_plan_sid}</td>
	            <td><input class="default-plan" value="{$membership_plan_info.id}" type="checkbox" {if $user_group_info.default_plan == $membership_plan_info.id}checked="checked"{/if}" /></td>
	            <td>
	                {if $smarty.foreach.items_block.iteration < $smarty.foreach.items_block.total}
	               		<a href="?membership_plan_sid={$membership_plan_info.id}&amp;action=move_down&amp;sid={$user_group_sid}"><img src="{image}b_down_arrow.gif" border="0" alt=""/></a>
	                {/if} 
	            </td>
	            <td>
	                {if $smarty.foreach.items_block.iteration > 1}
	                	<a href="?membership_plan_sid={$membership_plan_info.id}&amp;action=move_up&amp;sid={$user_group_sid}"><img src="{image}b_up_arrow.gif" border="0" alt="" /></a>
	                {/if} 
	            </td>
	        </tr>
	    {/foreach}
	</tbody>
</table>
				
<small>Users of this group will be automatically subscribed (free of charge) to the plan marked as <strong>Default</strong> after registration</small>

{literal}
<script type="text/javascript">

	$(document).ready(function() {
		
		$('.default-plan').change( function() {
			var plan = 0;
	    	if (this.checked) {
		    	plan = this.value
	    	}
	    	location.href = '?membership_plan_sid=' + plan + '&action=set_default_plan&sid={/literal}{$user_group_sid}{literal}';
		});
		
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
	});
    
</script>
{/literal}
