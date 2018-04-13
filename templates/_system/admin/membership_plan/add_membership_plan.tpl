{breadcrumbs}<a href="{$GLOBALS.site_url}/membership-plans/">Membership Plans</a> &#187; Add Membership Plan{/breadcrumbs}
<h1>Add Membership Plan</h1>

<fieldset>
	<legend>Add a New Membership Plan</legend>
	<form method="POST">
		<input type="hidden" name="action" value="save_membership_plan" />
		<table>
			{foreach from=$form_fields item=form_field key=form_field_id}
				{if $form_field_id != 'listing_types' && $form_field_id != 'user_group_sid'}
					<tr>
						<td>{$form_field.caption} 
						<td>{$form_field.element}</td>
					</tr>
					{if $form_field_id == 'subscription_period'}
						<tr><td colspan="2"><small>Set empty or zero for unlimited subscription</small></td></tr>
					{elseif $form_field_id == 'prohibit_subscribe_twice'}
						<tr><td colspan="2"><small>Enable this setting to disallow users to subscribe to this plan again until it is expired</small></td></tr>
					{elseif $form_field_id == 'is_recurring'}
						<tr><td colspan="2"><small>Enable this option to charge users automatically for renewing this plan once the expiration period is over<br/>For correct work of Recurring payments for this Membership Plan you need to configure the <a href="{$GLOBALS.site_url}/system/payment/gateways/">Payment Gateways</a> you are going to use.</small></td></tr>
					{/if}
				{/if}
			{/foreach}
			<tr>
				<td>User group</td>
				<td> 
					<select name="user_group_sid">
						<option value="">Select User group</option>
						{html_options options=$user_groups selected=$form_fields.user_group_sid.value}
					</select>
				</td>
			</tr>						
			<tr><td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton" /></span></td></tr>
		</table>
	</form>
</fieldset>
