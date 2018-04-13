<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.bgiframe.js"></script>
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

function SaveAd(noteId, url){
	$.get(url, function(data){
		$("#"+noteId).html(data);  
	});
}
{/literal}
</script>

<h1>[[Application Tracking]]</h1>
{foreach from=$errors key=error_code item=error_message}
	<font size="3" class="error">
		{if $error_code == 'NO_SUCH_FILE'} [[No such file]]
		{elseif $error_code == 'NO_SUCH_APPS'} [[No such application with this ID]]
		{/if}
	</font>
{/foreach}
<form method="post" name="applicationFilter" action=""  id="applications">
[[Select Job Posting]] 
	<select name="appJobId">
		<option value="">[[All Jobs]]</option>
	{foreach from=$appJobs item=appJob}
		<option value="{$appJob.id}"{if $appJob.id == $current_filter} selected="selected"{/if}>{$appJob.title}</option>
	{/foreach}
	</select>
	{if $acl->isAllowed('use_screening_questionnaires')}
	<select name="score">
		<option value="">[[Any Score]]</option>
		<option value="passed" {if $score == 'passed'} selected="selected"{/if}>[[Passed]]</option>
		<option value="not_passed" {if $score == 'not_passed'} selected="selected"{/if}>[[Not Passed]]</option>
	</select>
	{/if}
<input type="submit" name="applicationFilterSubmit" value="[[Filter]]" class="button" />


<form method="post" name="applicationForm" action="">
	<input type="hidden" name="orderBy" value="{$orderBy}" />
	<input type="hidden" name="order" value="{$order}" />
	<input id="action" type="hidden" name="action" value="" />
	<p><input type="submit" value="[[Delete]]" onclick="if (confirm('[[Are you sure you want to delete selected application(s)?]]')) submitForm('delete');" /> / <input type="submit" value="[[Approve selected]]" onclick="submitForm('approve'); return false;" /> / <input type="submit" value="[[Reject selected]]" onclick="submitForm('reject')" /></p>
	
	<table border="0" cellpadding="0" cellspacing="0" class="tableSearchResultApplications" width="100%">
		<thead>
			<tr>
				<th class="tableLeft"> </th>
				<th class="pointedInListingInfo2"><input type="checkbox" id="all_checkboxes_control"></th>
				<th class="pointedInListingInfo2" width="15%"><a href="?orderBy=date&amp;order={if $orderBy == "date" && $order == "asc"}desc{else}asc{/if}{if $current_filter}&amp;appJobId={$current_filter}{/if}">[[Date Applied]]</a></th>
				<th class="pointedInListingInfo2"><a href="?orderBy=title&amp;order={if $orderBy == "title" && $order == "asc"}desc{else}asc{/if}{if $current_filter}&amp;appJobId={$current_filter}{/if}">[[Job Title]]</a></th>
				<th class="pointedInListingInfo2"><a href="?orderBy=applicant&amp;order={if	$orderBy == "applicant" && $order == "asc"}desc{else}asc{/if}{if $current_filter}&amp;appJobId={$current_filter}{/if}">[[Applicant’s Name]]</a></th>
				<th class="pointedInListingInfo2"><a href="">[[Attached Resume]]</a></th>
				{if $acl->isAllowed('use_screening_questionnaires')}
				<th class="pointedInListingInfo2" colspan="2"><a href="?orderBy=score&amp;order={if	$orderBy == "score" && $order == "asc"}desc{else}asc{/if}{if $current_filter}&amp;appJobId={$current_filter}{/if}">[[Score]]</a></th>
				{/if}
				<th class="pointedInListingInfo2"><a href="?orderBy=status&amp;order={if $orderBy == "status" && $order == "asc"}desc{else}asc{/if}{if $current_filter}&amp;appJobId={$current_filter}{/if}">[[Status]]</a></th>
				<th class="tableRight"> </th>
			</tr>
		</thead>
		{foreach item=application from=$applications name=applications}
		<tr>
			<td>&nbsp;</td>
			<td rowspan="3" class="ApplicationPointedInListingInfo2" width="1"><input type="checkbox" name="applications[{$application.id}]" value="1" id="checkbox_{$smarty.foreach.applications.iteration}" /></td>
			<td class="ApplicationPointedInListingInfo" width="10%">[[$application.date]]</td>
			<td class="ApplicationPointedInListingInfo"><a href="{$GLOBALS.site_url}/my-job-details/{$application.job.sid}/">{$application.job.Title}</a></td>
			<td class="ApplicationPointedInListingInfo">{$application.user.FirstName} {$application.user.LastName} <br/>
					{if $application.user.sid}
						<a href="{$GLOBALS.site_url}/private-messages/send/?to={$application.user.sid}" onclick="popUpWindow('{$GLOBALS.site_url}/private-messages/aj-send/?to={$application.user.username}', 560, 440, '[[Send Private Message]]', true, {if $GLOBALS.current_user.logged_in}true{else}false{/if}); return false;"  class="pm_send_link">[[Send Private Message]]</a>
					{else}
						<a href="mailto:{$application.email}" class="pm_send_link">{$application.email}</a>
					{/if}
			</td>
			<td class="ApplicationPointedInListingInfo">
					{if $application.resume}- <a href="{$GLOBALS.site_url}/display-resume/{$application.resume}/">{$application.resumeInfo.Title}</a>{/if}
					{if $application.file}<br />- <a href="?appsID={$application.id}&amp;filename={$application.file|escape:"url"}">[[View Attached File]]</a>{/if}
			</td>
			{if $acl->isAllowed('use_screening_questionnaires')}
			<td class="ApplicationPointedInListingInfo">{$application.score}</td>
			<td class="ApplicationPointedInListingInfo"><a href="{$GLOBALS.site_url}/applications/view-questionaire/{$application.id}">[[{$application.passing_score}]]</a></td>
			{/if}
			<td class="ApplicationPointedInListingInfo" width="10%">[[{$application.status}]]</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td {if $acl->isAllowed('use_screening_questionnaires')}colspan="7"{else}colspan="5"{/if} class="ApplicationPointedInListingInfo">
				<div class="applicationCommentsHeader"><strong>[[Cover Letter]]:</strong></div>
				<div class="applicationComments">
					{$application.comments}
				</div>
				<br/>
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td {if $acl->isAllowed('use_screening_questionnaires')}colspan="7"{else}colspan="5"{/if} class="ApplicationPointedInListingInfo">
			<div  id = 'formNote_{$application.id}'>
			{if $application.note}
			<div class="applicationCommentsHeader"><strong>[[My notes]]</strong>:</div>
			<div class="applicationComments">
				{$application.note}
			</div>
			<br/>
			{/if}
			</div>
			<span id='notes_{$application.id}'>
				{if $application.note != ''}
					<a href="{$GLOBALS.site_url}/edit-notes/?apps_id={$application.id}" onclick="SaveAd( 'formNote_{$application.id}', '{$GLOBALS.site_url}/edit-notes/?apps_id={$application.id}&page=apps'); return false;"  class="action">[[Edit notes]]</a>&nbsp;&nbsp;
				{else}
					<a href="{$GLOBALS.site_url}/add-notes/?apps_id={$application.id}" onclick="SaveAd( 'formNote_{$application.id}', '{$GLOBALS.site_url}/add-notes/?apps_id={$application.id}&page=apps'); return false;"  class="action">[[Add notes]]</a>&nbsp;&nbsp;
				{/if}
			<br /><br />
			</td>
		</tr>
		{foreachelse}
		<tr>
			<td colspan="8" class="pointedInListingInfo"><br/><center>[[You have no Applications now]]</center><br/></td>
		</tr>
		{/foreach}
	</table>
</form>

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