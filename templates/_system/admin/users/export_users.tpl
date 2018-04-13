{breadcrumbs}Export Users{/breadcrumbs}
<h1>Export Users</h1>
{include file="error.tpl"}
<form method="post">
	<p>
	<table class="basetable">
		<input type="hidden" name="action" value="export">
		<thead>
			<tr>
				<th colspan="6">Export Filter</th>
			</tr>
		</thead>
		<tbody>
			<tr class="oddrow"><td>User ID: </td><td colspan="5">{search property="sid"}</td></tr>
			<tr class="evenrow"><td>Username: </td><td colspan="5">{search property="username"}</td></tr>
			<tr class="oddrow"><td>User Group:</td><td colspan="5">{search property="user_group" template="list_with_reload_user.tpl"}</td></tr>
			<tr class="evenrow"><td>Membership Plan:</td>	<td colspan="5">{search property="membership_plan" template="multilist.tpl"}</td></tr>
			<tr class="oddrow"><td>Registration Date: </td><td colspan="5">{search property="registration_date"}</td></tr>
			<tr class="evenrow"><td>Featured: </td><td colspan="5">{search property="featured"}</td></tr>
		</tbody>
		<tr id="clearTable"><td colspan="6">&nbsp;</td></tr>
		<thead>
			<tr>
				<th colspan="6">System User Properties to Export</th>
			</tr>
		</thead>
		<tbody>
			<tr class="oddrow">
				{foreach from=$userSystemProperties.system item=property_id name=system_properties}
					<td colspan="2"><input type="checkbox" name="export_properties[{$property_id}]" value="1" id="system_checkbox_{$smarty.foreach.system_properties.iteration}" /> {$property_id}</td>
					{if $smarty.foreach.system_properties.iteration % 3 == 0}
						</tr><tr class="{cycle values="evenrow,oddrow"}">
					{/if}
				{/foreach}
			</tr>
				<tr class="{cycle values="evenrow,oddrow"}"><td colspan="6"><a href="#" onClick="check_all('system', '{$smarty.foreach.system_properties.total}');return false;">Select</a> / <a href="#" onClick="uncheck_all('system', '{$smarty.foreach.system_properties.total}');return false;">Deselect</a> All</td>
			</tr>
		</tbody>
		{foreach from=$userCommonProperties item=properties key=groupName}
		<tr id="clearTable"><td colspan="6">&nbsp;</td></tr>
		<thead>
			<tr>
				<th colspan="6">{$groupName} User Properties to Export</th>
			</tr>
		</thead>
		<tbody>
			<tr class="evenrow">
				{foreach from=$properties item=property name=$groupName}
					<td colspan="2"><input type="checkbox" name="export_properties[{$property.id}]" value="1" id="{$groupName}_checkbox_{$smarty.foreach.$groupName.iteration}" /> {$property.caption}</td>
					{if $smarty.foreach.$groupName.iteration % 3 == 0}
						</tr><tr class="{cycle values="evenrow,oddrow"}">
					{/if}
				{/foreach}
			</tr>
			<tr>
				<td colspan="6"><a href="#" onClick="check_all('{$groupName}', '{$smarty.foreach.$groupName.total}');return false;">Select</a> / <a href="#" onClick="uncheck_all('{$groupName}', '{$smarty.foreach.$groupName.total}');return false;">Deselect</a> All</td>
			</tr>
		</tbody>
		{/foreach}
		<tr id="clearTable">
			<td colspan="6" align="right"><span class="greenButtonEnd"><input type="submit" value="Export" class="greenButton" /></span></td>
		</tr>
	</table>
</form>

<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>
<script language="Javascript">
$(function(){ldelim}
	var dFormat = '{$GLOBALS.current_language_data.date_format}';
	{literal}
	dFormat = dFormat.replace('%m', "mm");
	dFormat = dFormat.replace('%d', "dd");
	dFormat = dFormat.replace('%Y', "yy");
	
	$("#registration_date_notless, #registration_date_notmore").datepicker({
		dateFormat: dFormat,
		showOn: 'button',
		buttonImage: '{/literal}{$GLOBALS.site_url}/../system/ext/jquery/calendar.gif{literal}',
		yearRange: '-99:+99',
		buttonImageOnly: true });
	
});

function check_all(group, total)
{ 
	for (i = 1; i <= total; i++)
	{
		if (checkbox = document.getElementById(group + '_checkbox_' + i))
		{
			checkbox.checked = true;
		}
	}
}

function uncheck_all(group, total)
{
	for (i = 1; i <= total; i++)
	{
		if (checkbox = document.getElementById(group + '_checkbox_' + i))
		{
			checkbox.checked = false;
		}
	}
}

{/literal}
</script>