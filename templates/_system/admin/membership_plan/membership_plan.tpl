<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
{literal}
<script type="text/javascript"><!--
function Submit(form, fieldID) {
	$("#dialog").dialog({
		bgiframe: true,
		modal: true,
		buttons: {
			Ok: function() {
				$(this).dialog('close');
				$('#'+fieldID).val(1);
				form.submit();
			},
			Close: function() {
				$(this).dialog('close');
				form.submit();
			}
		}
	});
}
--></script>
{/literal}
{breadcrumbs}<a href="{$GLOBALS.site_url}/membership-plans/">Membership Plans</a> &#187; {$membership_plan_info.name}{/breadcrumbs}

<div id="dialog" title="Attention!" style='display:none'>
	<p><span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>Are the changes to be applied to current subscriptions?</p>
</div>

<h1>Edit Membership Plan</h1>

<fieldset>
	<legend>Membership Plan Info</legend>
	<form method="POST" name="membershipPlanForm">
		<input type="hidden" name="action" value="save_membership_plan">
		<input type="hidden" name="id" value="{$membership_plan_id}">
		<table>
			{foreach from=$form_fields item=form_field key=form_field_id}
				{if $form_field_id != 'listing_types' && $form_field_id != 'user_group_sid'}
					<tr>
						<td>{$form_field.caption} </td>
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
						<option value=""></option>
						{html_options options=$user_groups selected=$form_fields.user_group_sid.value}
					</select>
				</td>
			</tr>
			<tr><td colspan="2" style="text-align: right;"><small><b>Apply changes to all users currently subscribed to this plan</b></small> <input type="radio" name="update_users" value="1" checked></td></tr>
			<tr><td colspan="2" style="text-align: right;"><small><b>Changes will be applied to newly subscribed users only</b></small> <input type="radio" name="update_users" value="0"></td></tr>
			<tr><td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton" /></span></td></tr>
		</table>
	</form>
</fieldset>

<p><a href="{$GLOBALS.site_url}/system/users/acl/?type=plan&amp;role={$membership_plan_id}">Manage Permissions</a></p>
<p><a href="{$GLOBALS.site_url}/membership-plan/add-package/?membership_plan_id={$membership_plan_id}&class_name=ListingPackage">Add a New Package</a></p>
<br/>
<h3>Packages Included</h3>
{$packages_block}