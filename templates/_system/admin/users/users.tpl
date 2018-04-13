<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.bgiframe.js"></script>
<link type="text/css" href="{$GLOBALS.site_url}/../system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />
{literal}
<script type="text/javascript">
	$.ui.dialog.defaults.bgiframe = true;
	var progbar = "<img src='{/literal}{$GLOBALS.site_url}/../system/ext/jquery/progbar.gif{literal}'>";
	var parentReload = false;
	$(function() {
		$(".getUser").click(function(){
			$("#dialog").dialog('destroy');
			$("#dialog").attr({title: "Loading"});
			$("#dialog").html(progbar).dialog({width: 180});
			var link = $(this).attr("href");
			$.get(link, function(data){
				$("#dialog").dialog('destroy');
				$("#dialog").attr({title: "User Membership Plan Details"});
				$("#dialog").html(data).dialog({
					width: 560,
					close: function(event, ui) {
						$("#expired_date").datepicker( 'hide' );
						if(parentReload == true) {
							parent.document.location.reload();
					}}
				});
			});
			return false;
			});
		

		$("#change_plan_send_button").click(function(){
			val = $("#plan_select").val();
			$("#plan_to_change").val( val );
			$("input[name='action_name']").val('change_plan');
			$("#change_plan_dialog").dialog('destroy').html("{/literal}[[Please wait...]]{literal}" + progbar).dialog( {width: 200});
			$("form[name='users_form']").submit();
		});

		$("#user_reject_send_button").click(function(){
			val = $("#rejection_reason_text").val();
			$("#rejection_reason").val(val);
			$("input[name='action_name']").val('reject');
			$("#user_reject_dialog").dialog('destroy').html("{/literal}[[Please wait...]]{literal}" + progbar).dialog( {width: 200});
			$("form[name='users_form']").submit();
		});
		
		$("tr[id^='users']").click(function(){
			var name = ($(this).attr('id'));
			if( !$(this).attr('style') ) {
				$("input[name='" + name + "']").attr('checked','checked');
				$(this).attr('style','background-color: #ffcc99');
				
			}else {
				$(this).removeAttr('style');
				$("input[name='" + name + "']").removeAttr('checked');
			}

			});
		
	});

	function mem_plans ( link ) {
		$("#dialog").dialog('destroy');
		$("#dialog").attr({title: "Loading"});
		$("#dialog").html(progbar).dialog({width: 180});
		$.get(link, function(data){
			$("#dialog").dialog('destroy');
			$("#dialog").attr({title: "User Membership Plans"});
			$("#dialog").html(data).dialog({
				width: 400,
				close: function(event, ui) {
				}
			});
		});			
	}
	
	function login_as_user( name, pass ) {
		$.get('{/literal}{$GLOBALS.site_url}{literal}/login-as-user/', { username: name, password: pass}, function (data) {
			var response = $.trim(data);
			if (response == "") {
				document.login.username.value = name;
				document.login.password.value = pass;
				document.getElementById('login').submit();
			}
			else {
				popUpWindow(300,100,'Error',data);
			}
		});
	}

	function popUpWindow(widthWin, heightWin, title, message){
		$("#messageBox").dialog( 'destroy' ).html(message);
		$("#messageBox").dialog({
			width: widthWin,
			height: heightWin,
			modal: true,
			title: title
			
		}).dialog( 'open' );
		
		return false;
	}

	function go( button ){
		if($("input:checked").length > 0 && $("#selectedAction_"+button).val() != ''){
			var action = $("#selectedAction_"+button).val();

			switch ( action ) {
			case 'send_activation_letter':
				var users = [];
				var userids = [];
				users = $("input:checked");
			
				for (var i = 0; i < users.length; i++) {
					userids[i] = users[i].name.substring(users[i].name.indexOf('[')+1,users[i].name.lastIndexOf(']'));
				}
			
				var progbar = "<img src='{/literal}{$GLOBALS.site_url}/../system/ext/jquery/progbar.gif{literal}'>";
				$(function() {
					var data = '';
					$("#dialog").dialog('destroy');
					$("#dialog").attr({title: "Loading"});
					$("#dialog").html(progbar).dialog({width: 180});
					
					$.get("{/literal}{$GLOBALS.site_url}{literal}/send-activation-letter/",{'userids[]':userids, ajax:true}, function(data){
			
						$("#dialog").dialog('destroy');
						$("#dialog").attr({title: "Sending activation emails "});
						$("#dialog").html(data).dialog({width: 300});
					});
				});
				break;
			case 'reject':
				$("#user_reject_dialog").dialog('destroy');
				$("#user_reject_dialog").dialog({title: "User Rejection", width: 350});
				break;
			case 'change_plan':
				$("#change_plan_dialog").dialog('destroy');
				$("#change_plan_dialog").dialog({title: "Change Membership Plan", width: 350});
				break;
			case 'delete':
				if ( !confirm('Are you sure you want to delete selected user(s)?') )
					break;
			default:
				document.getElementById( 'action_name' ).value = action;
				var form = document.users_form;
				form.submit();
			}		
		} else {
			$(function() {
				$("#dialog").dialog('destroy');
				$("#dialog").attr({title: "Information"});
				$("#dialog").html("Please choose an action first").dialog({width: 300});
			});
		} 
	}
	</script>
{/literal}

{if $rangeIPs}
	<div id="bannedIPsInfo" title="Attention!" style='display:none'>
		<p>
			<span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
			The range of the IP addresses has been banned. That's why you are not able to unblock the following IP addresses:
			{foreach from=$rangeIPs item=IP}
				<b>{$IP}</b><br/>
			{/foreach}
		</p>
	</div>
	{literal}
	<script type="text/javascript"><!--
	$("#bannedIPsInfo").dialog({
		bgiframe: true,
		modal: true,
		buttons: {
			Close: function() {
				$(this).dialog('close');
			}
		}
	});
	--></script>
	{/literal}
{/if}

{if $cantBanUsers}
	<div id="usersInfo" title="Attention!" style='display:none'>
		<p>
			<span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
			IPs of the following users were not defined, therefore they can’t be banned:<br/>
			{foreach from=$cantBanUsers item=username}
				<b>{$username}</b><br/>
			{/foreach}
		</p>
	</div>
	{literal}
	<script type="text/javascript"><!--
	$("#usersInfo").dialog({
		bgiframe: true,
		modal: true,
		buttons: {
			Close: function() {
				$(this).dialog('close');
			}
		}
	});
	--></script>
	{/literal}
{/if}

<div id="dialog" style="display: none"></div>

<form id="login" name="login" target="_blank"  action="{$GLOBALS.site_url}../../login/" method="post">
	<input type="hidden" name="action" value="login">
	<input type="hidden" name="as_user">
	<input type="hidden" name="username" value="">
	<input type="hidden" name="password" value="">
</form>

<form method="post" name="users_form">
<input type="hidden" name="action_name" id="action_name" value="">
<input type="hidden" name="plan_to_change" id="plan_to_change" value="">
<input type="hidden" name="rejection_reason" id="rejection_reason" value="">

<div id="change_plan_dialog" style="display: none">
	Select Action:
	<select name="plan_select" id="plan_select" style="width: 219px;">
		<option value='0'>Clear Subscriptions</option>
			{foreach from=$plans item=plan}
				<option value="{$plan.id}">Add {$plan.caption}</option>
			{/foreach}
	</select>
	<div class="clr"><br/></div>
	<span class="greenButtonEnd"><input type="submit" id="change_plan_send_button" name="change_plan_send_button" value="Change" class="greenButton" /></span>
</div>

<div id="user_reject_dialog" style="display: none">
	Enter Reject Reason:
	<textarea name="rejection_reason_text" id="rejection_reason_text" style="width: 315px; height: 200px;"></textarea>
	<div class="clr"><br/></div>
	<span class="greenButtonEnd"><input type="submit" id="user_reject_send_button" name="user_reject_send_button" value="Reject" class="greenButton" /></span>
</div>
<div class="clr"><br/></div>
<div style="display:inline-block;">
<div class="actionSelected">
     Actions with Selected:
     <select id="selectedAction_up" name="selectedAction_up">
          <option value="">Select action</option>
          <option value="activate">Activate</option>
          <option value="deactivate">Deactivate</option>
          {if $ApproveByAdminChecked}
          <option value="approve">Approve</option>
          <option value="reject">Reject</option>
          {/if}
          <option value="send_activation_letter">Send Activation Email</option>
          <option value="delete">Delete</option>
          <option value="change_plan">Change Plan</option>
          <option value="ban_ip">Ban IP</option>
          <option value="unban_ip">Unban IP</option>
     </select>
     <span class="greenButtonEnd"><input type="button" value="Go" class="greenButton" onclick="go('up');"/></span>
</div>

<div class="numberPerPage">
	<strong>[[Number of users per page]]:</strong>
	<select id="users_per_page" name="users_per_page" onchange="window.location = '?user_group_id={$user_group_name}&restore=1{if $user_group_name == 'JobSeeker'}&LastName={$LastName}{else}&CompanyName={$CompanyName}{/if}&users_per_page='+this.value;" class="perPage">
		<option value="10" {if $users_per_page == 10}selected="selected"{/if}>10</option>
		<option value="20" {if $users_per_page == 20}selected="selected"{/if}>20</option>
		<option value="50" {if $users_per_page == 50}selected="selected"{/if}>50</option>
		<option value="100" {if $users_per_page == 100}selected="selected"{/if}>100</option>
	</select>
</div>

<div class="clr"><br/></div>

<div class="numberPage">
	{foreach from=$pages item=page}
		{if $page == $currentPage}
			<strong>{$page}</strong>
		{else}
			{if $page == $totalPages && $currentPage < $totalPages-3} ... {/if}
			<a href="?user_group_id={$user_group_name}&page={$page}{if $sorting_field ne null}&sorting_field={$sorting_field}{/if}{if $user_group_name == 'JobSeeker'}&LastName={$LastName}{else}&CompanyName={$CompanyName}{/if}{if $sorting_order ne null}&sorting_order={$sorting_order}{/if}&users_per_page={$users_per_page}{$searchFields}">{$page}</a>
			{if $page == 1 && $currentPage > 4} ... {/if}
		{/if}
	{/foreach}
</div>
<div class="clr"></div>

<table>
	<thead>
		<tr>
			<th><input type="checkbox" id="all_checkboxes_control"></th>
			<th>
	            <a href="?restore=1&user_group_id={$user_group_name}&sorting_field=users.sid&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'users.sid'}DESC{else}ASC{/if}&users_per_page={$users_per_page}{if $online==1}&online=1{/if}{if $user_group_name == 'JobSeeker'}&LastName={$LastName}{else}&CompanyName={$CompanyName}{/if}">ID</a>
   				{if $sorting_field == 'users.sid'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
			</th>
			<th>
				<a href="?restore=1&user_group_id={$user_group_name}&sorting_field=username&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'username'}DESC{else}ASC{/if}&users_per_page={$users_per_page}{if $online==1}&online=1{/if}{if $user_group_name == 'JobSeeker'}&LastName={$LastName}{else}&CompanyName={$CompanyName}{/if}">Username</a>
				{if $sorting_field == 'username'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
			</th>
			<th>
				<a href="?restore=1&user_group_id={$user_group_name}&sorting_field=user_group&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'user_group'}DESC{else}ASC{/if}&users_per_page={$users_per_page}{if $online==1}&online=1{/if}{if $user_group_name == 'JobSeeker'}&LastName={$LastName}{else}&CompanyName={$CompanyName}{/if}">User Group</a>
				{if $sorting_field == 'user_group'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
			</th>
            {if $user_group_name == "JobSeeker"}
            <th>
				<a href="?restore=1&user_group_id={$user_group_name}&sorting_field=LastName&LastName={$LastName}&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'LastName'}DESC{else}ASC{/if}&users_per_page={$users_per_page}{if $online==1}&online=1{/if}">Last Name</a>
				{if $sorting_field == 'LastName'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
			</th>
            {else}
             <th>
				<a href="?restore=1&user_group_id={$user_group_name}&sorting_field=CompanyName&CompanyName={$CompanyName}&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'CompanyName'}DESC{else}ASC{/if}&users_per_page={$users_per_page}{if $online==1}&online=1{/if}">Company Name</a>
				{if $sorting_field == 'CompanyName'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
			</th>
            {/if}
			<th>
				<a href="?restore=1&user_group_id={$user_group_name}&sorting_field=email&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'email'}DESC{else}ASC{/if}&users_per_page={$users_per_page}{if $online==1}&online=1{/if}{if $user_group_name == 'JobSeeker'}&LastName={$LastName}{else}&CompanyName={$CompanyName}{/if}">Email</a>
				{if $sorting_field == 'email'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
			</th>
			{if $user_group_name == "JobSeeker"} <th>Membership Plan</th> {/if}
			<th>
				<a href="?restore=1&user_group_id={$user_group_name}&sorting_field=registration_date&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'registration_date'}DESC{else}ASC{/if}&users_per_page={$users_per_page}{if $online==1}&online=1{/if}{if $user_group_name == 'JobSeeker'}&LastName={$LastName}{else}&CompanyName={$CompanyName}{/if}">Registration Date</a>
				{if $sorting_field == 'registration_date'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
			</th>
			<th>
				<a href="?restore=1&user_group_id={$user_group_name}&sorting_field=active&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'active'}DESC{else}ASC{/if}&users_per_page={$users_per_page}{if $online==1}&online=1{/if}{if $user_group_name == 'JobSeeker'}&LastName={$LastName}{else}&CompanyName={$CompanyName}{/if}">Status</a>
				{if $sorting_field == 'active'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
			</th>
			{if $ApproveByAdminChecked}
			<th>
				<a href="?restore=1&user_group_id={$user_group_name}&sorting_field=approval&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'approval'}DESC{else}ASC{/if}&users_per_page={$users_per_page}{if $online==1}&online=1{/if}{if $user_group_name == 'JobSeeker'}&LastName={$LastName}{else}&CompanyName={$CompanyName}{/if}">Approval Status</a>
				{if $sorting_field == 'approval'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
			</th>
			{/if}
			<th>
				<a href="?restore=1&user_group_id={$user_group_name}&sorting_field=ip&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'ip'}DESC{else}ASC{/if}&users_per_page={$users_per_page}{if $online==1}&online=1{/if}{if $user_group_name == 'JobSeeker'}&LastName={$LastName}{else}&CompanyName={$CompanyName}{/if}">IP Address</a>
				{if $sorting_field == 'ip'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
			</th>
			<th colspan="3" class="actions">Actions</th>
		</tr>
	</thead>
	{foreach from=$found_users item=found_user name=users_block}
		<tr id="users[{$found_user.sid}]" class="{cycle values = 'evenrow,oddrow'}">
			<td><input type="checkbox" name="users[{$found_user.sid}]" value="1" id="checkbox_{$smarty.foreach.users_block.iteration}"></td>
			<td><a href="{$GLOBALS.site_url}/edit-user/?user_sid={$found_user.sid}&user_group_id={$user_group_name}" title="Edit"><b>{$found_user.sid}</b></a></td>
			<td><a href="{$GLOBALS.site_url}/edit-user/?user_sid={$found_user.sid}&user_group_id={$user_group_name}" title="Edit"><b>{$found_user.username}</b></a></td>
			<td>{$found_user.user_group}</td>
            <td>{if $user_group_name == "JobSeeker"}
					{$found_user.LastName}
				{else}
					{$found_user.CompanyName}
				{/if}</td>
			<!-- for ie -->	<td style="word-break: break-all;"><!-- for firefox--><div style="word-wrap: break-word; width: 130px;"><a href="mailto:{$found_user.email}">{$found_user.email}</a></div></td>
			{if $user_group_name == "JobSeeker"}
				<td>{foreach from=$found_user.membership_plan item=membership_plan}<a href="{$GLOBALS.site_url}/user-membership-plan/?userId={$found_user.sid}&contract_id={$membership_plan.id}" target="_blank" class="getUser">{$membership_plan.name}</a><br/>{/foreach}</td> 
			{/if}
			<td>{$found_user.registration_date}</td>
			<td>
				{if $found_user.active == "1"}
					Active
				{else}
					Not Active
				{/if}
			</td>
			{if $ApproveByAdminChecked}
			<td>{$found_user.approval}</td>
			{/if}	
			<td>{if $found_user.ip_is_banned == 1}<p class='error'>{$found_user.ip}</p>{else}{$found_user.ip}{/if}</td>
			<td><a href="{$GLOBALS.site_url}/edit-user/?user_sid={$found_user.sid}&user_group_id={$user_group_name}" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a></td>
			<td>{if $found_user.membership_plan}<span class="greenButtonEnd"><input type="button" name="button" value="Change Plan" class="greenButton" id="ChangePlan" onclick="mem_plans('{$GLOBALS.site_url}/user-membership-plans/?userId={$found_user.sid}&user_group_id={$user_group_name}');"></span>{/if}</td>
			<td><span class="greenButtonEnd"><input type="button" name="button" value="Login" class="greenButton" onclick="login_as_user('{$found_user.username}', '{$found_user.password}');"></span></td>
		</tr>
	{/foreach}
</table>

<div class="clr"><br/></div>
<div class="actionSelected">
	Actions with Selected:
	<select id="selectedAction_down" name="selectedAction_down" >
		<option value="">Select action</option>
		<option value="activate">Activate</option>
		<option value="deactivate">Deactivate</option>
		{if $ApproveByAdminChecked}
        <option value="approve">Approve</option>
        <option value="reject">Reject</option>
        {/if}
		<option value="send_activation_letter">Send Activation Email</option>
		<option value="delete">Delete</option>
		<option value="change_plan">Change Plan</option>
		<option value="ban_ip">Ban IP</option>
		<option value="unban_ip">Unban IP</option>
	</select>
	<span class="greenButtonEnd"><input type="button" value="Go" class="greenButton" onclick="go('down');"></span>
</div>
</div>

<script>
var total={$smarty.foreach.users_block.total};
var user_group_name="{$user_group_name}";
{literal}

function set_checkbox(param) {
	for (i = 1; i <= total; i++) {
		if (checkbox = document.getElementById('checkbox_' + i)) {
			checkbox.checked = param;
		}
	}
}

$("#all_checkboxes_control").click(function() {
	if ( this.checked == false){
		set_checkbox(false);
		$("tr[id^='users']").removeAttr('style');
	}else {
		set_checkbox(true);
		$("tr[id^='users']").attr( 'style','background-color: #ffcc99' );
	}
});

$(document).ready(function(){
		if(user_group_name=="JobSeeker")
			$('#Manage_Job_Seekers').addClass('lmsih');
		else
			$('#Manage_Employers').addClass('lmsih');
 });

{/literal}
</script>