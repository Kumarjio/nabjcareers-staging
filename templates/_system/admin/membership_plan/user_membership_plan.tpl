<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.form.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>
{literal}
<script>
	function changeContractSubmit() {
		var options = {
				  target: "#dialog",
				  url:  $("#changeContractForm").attr("action")
				}; 
		$("#changeContractForm").ajaxSubmit(options);
		return false;
	}

	function formSubmit() {
		var options = {
				  target: "#dialog",
				  url:  $("#changeExpirationDate").attr("action")
				}; 
		$("#changeExpirationDate").ajaxSubmit(options);
		return false;
	}
</script>
{/literal}
<p><b>Username:</b> {$user.username}</p>
{if $deleted == 'yes'}
	<p class="error">Contract was deleted</p>
	{literal}
	<script> var parentReload = true;</script>
	{/literal}
{elseif $deleted == 'no'}
	<p class="error">Contract was not deleted</p>
{else}
<form method="post" action='{$GLOBALS.site_url}/user-membership-plan/' id="changeExpirationDate" onsubmit='return formSubmit();'>
<input type='hidden' name='userId' value='{$userId}' />
<input type='hidden' name='contract_id' value='{$contract_id}' />
<input type='hidden' name='action' value='changeExpirationDate' />
<input type='hidden' name='user_group_id' value='{$user_group_id}' />
<table border="1" cellspacing="0" cellpadding="3" width="530">
	<tr>
		<td width="50%">Membership plan:</td>
		<td width="50%">{$membershipPlan.name|default:"&nbsp;"}</td>
	</tr>
	<tr>
		<td>Subscription date:</td>
		<td>[[{$contractInfo.creation_date|default:"&nbsp;"}]]</td>
	</tr>
	<tr>
		<td>Subscription expiration date:</td>
		<td><input type="text" class="displayDate" style="z-index:99999;" name="expired_date" value="[[{$contractInfo.expired_date|default:"Never Expire"}]]"  id="expired_date"/></td>
	</tr>
	<tr>
		<td>Subscription price:</td>
		<td>{$contractInfo.extra_info.price|default:0}</td>
	</tr>
</table>
<div style='text-align:right;'><span class="greenButtonEnd"><input type="submit"  value="Save" class="greenButton" /></span></div>
</form>
<br />
<a href="{$GLOBALS.site_url}/system/users/acl/?type=user&amp;role={$userId}&user_group_id={$user_group_id}">View user permissions</a>

<p>Change membership plan to:</p>
<form method="POST" action='{$GLOBALS.site_url}/user-membership-plan/' id="changeContractForm" onsubmit="return changeContractSubmit();">
	<input type='hidden' name='userId' value='{$userId}' />
	<input type='hidden' name='contract_id' value='{$contract_id}' />
	<input type='hidden' name='action' value='change' />
    <input type='hidden' name='user_group_id' value='{$user_group_id}' />
	<select name="plan_to_change" id="plan_select">
		<option value='0'>Delete this subscription</option>
		{foreach from=$plans item=plan}
			<option value="{$plan.id}">{$plan.caption}</option>
		{/foreach}
	</select>
	<span class="greenButtonEnd"><input type="submit" id="change_plan_send_button" name="change_plan_send_button" value="Change" class="greenButton" /></span>
</form>
{if $changed}<script> var parentReload = true;</script>{/if}
{/if}

<script>

{foreach from=$GLOBALS.languages item=language}
	{if $language.id == $GLOBALS.current_language}
		var dFormat = '%Y-%m-%d';
	{/if}
{/foreach}
	
{literal}
dFormat = dFormat.replace('%Y', "yy");
dFormat = dFormat.replace('%m', "mm");
dFormat = dFormat.replace('%d', "dd");

$( function() {
	$("#expired_date").datepicker({
		dateFormat: dFormat, 
		showOn: 'button', 
		changeMonth: true,
		changeYear: true,
		minDate: new Date(1940, 1 - 1, 1),
		maxDate: '+10y +0m +0w',
		yearRange: '-99:+99',
		buttonImage: '{/literal}{$GLOBALS.site_url}/../system/ext/jquery/calendar.gif{literal}', 
		buttonImageOnly: true 
	});
});
{/literal}
</script>