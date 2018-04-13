<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
<script type="text/javascript" language="JavaScript">
{literal}
$.ui.dialog.defaults.bgiframe = true;
function popUpWindow(url, widthWin, heightWin, title, parentReload, userLoggedIn){
	reloadPage = false;
	$("#messageBox").dialog( 'destroy' ).html('{/literal}<img style="vertical-align: middle" src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" /> [[Please, wait ...]]{literal}');
	$("#messageBox").dialog({
		width: widthWin,
		height: heightWin,
		modal: true,
		title: title,
		close: function(event, ui) {
			if(newPageReload == true) {
				if(reloadPage == true)
					parent.document.location.reload();
			}
		}
	}).dialog( 'open' );
	$.get(url, function(data){
		$("#messageBox").html(data);  
	});
	return false;
}
{/literal}
</script>

<h1>[[Jobs Applied]]</h1>
<form method="post" name="applicationForm" action="" id="applications">
	<input type="hidden" name="orderBy" value="{$orderBy}" />
	<input type="hidden" name="order" value="{$order}" />
	<input id="action" type="hidden" name="action" value="" />
	<p><input type="submit" value="[[Delete]]"	class="button" onclick="if (confirm('[[Are you sure you want to delete selected application(s)?]]')) submitForm('delete');" /></p>
	
	<table border="0" cellpadding="0" cellspacing="0" class="tableSearchResultApplications" width="100%">
		<thead>
			<tr>
				<th class="tableLeft"> </th>
				<th class="pointedInListingInfo2"><input type="checkbox" id="all_checkboxes_control"></th>
				<th class="pointedInListingInfo2" width="15%"><a href="?orderBy=date&amp;order={if		$orderBy == "date" 	&& $order == "asc"}desc{else}asc{/if}">[[Date Applied]]</a></th>
				<th class="pointedInListingInfo2"><a href="?orderBy=title&amp;order={if		$orderBy == "title" && $order == "asc"}desc{else}asc{/if}">&nbsp; [[Job Title]]</a></th>
				<th class="pointedInListingInfo2"><a href="?orderBy=company&amp;order={if		$orderBy == "company" && $order == "asc"}desc{else}asc{/if}">&nbsp; [[Company]]</a></th>
				<th class="pointedInListingInfo2"><a href="?orderBy=status&amp;order={if		$orderBy == "status" && $order == "asc"}desc{else}asc{/if}">&nbsp; [[Status]]</a></th>
				<th class="tableRight"> </th>
			</tr>
		</thead>
		{foreach item=application from=$applications name=applications}
		<tr>
			<td>&nbsp;</td>
			<td rowspan="2" class="ApplicationPointedInListingInfo2" width="1"><input type="checkbox" name="applications[{$application.id}]" value="1" id="checkbox_{$smarty.foreach.applications.iteration}" /></td>
			<td class="ApplicationPointedInListingInfo" width="10%">[[$application.date]]</td>
			<td class="ApplicationPointedInListingInfo">{if $application.job != NULL}<a href="{$GLOBALS.site_url}/display-job/{$application.job.sid}/">{$application.job.Title}</a>{else}[[Not Available Anymore]]{/if}</td>
			<td class="ApplicationPointedInListingInfo" width="20%">{$application.company.username}&nbsp; <br/>
				<a href="{$GLOBALS.site_url}/private-messages/send/?to={$application.company.sid}" onclick="popUpWindow('{$GLOBALS.site_url}/private-messages/aj-send/?to={$application.company.username}', 560, 440, '[[Send Private Message]]', true, {if $GLOBALS.current_user.logged_in}true{else}false{/if}); return false;"  class="pm_send_link">[[Send Private Message]]</a>
			</td>
			<td class="ApplicationPointedInListingInfo" width="10%">[[{$application.status}]]</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="4" class="ApplicationPointedInListingInfo"><strong>[[Cover Letter]]</strong>:<br/>{$application.comments}<br/><br/></td>
			<td>&nbsp;</td>
		</tr>
		{foreachelse}
		<tr>
			<td>&nbsp;</td>
			<td colspan="5" class="ApplicationPointedInListingInfo"><br/><center>[[You have no Applications now]]</center><br/></td>
			<td>&nbsp;</td>
		</tr>
		{/foreach}
	</table>
</form>
<br/>

<script type="text/javascript">
var total = {$smarty.foreach.applications.total};
{literal}

function set_checkbox(param) {
	for (i = 1; i <= total; i++) {
		if (checkbox = document.getElementById('checkbox_' + i))
			checkbox.checked = param;
	}
}

$("#all_checkboxes_control").click(function() {
	if ( this.checked == false)
		set_checkbox(false);
	else
		set_checkbox(true);
});

function submitForm(action) {
	document.getElementById('action').value = action;
	var form = document.applicationForm;
	form.submit();
}

</script>
{/literal}