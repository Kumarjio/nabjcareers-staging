{breadcrumbs}<a href="{$GLOBALS.site_url}/users/?restore=1&user_group_id={$user_group_id}">Users</a> &#187; <a href="{$GLOBALS.site_url}/edit-user/?username={$username}&user_group_id={$user_group_id}&user_sid={$user_sid}">Edit User Info</a> &#187; <a href="{$GLOBALS.site_url}/private-messages/pm-main/?username={$username}&user_group_id={$user_group_id}&user_sid={$user_sid}">Personal Messages</a> &#187; Inbox{/breadcrumbs}
<h1>Manage Personal messages for {$username}</h1>

<h3>[[Inbox]]</h3>

<form action="{$GLOBALS.site_url}/private-messages/pm-inbox/?username={$username}&user_group_id={$user_group_id}&user_sid={$user_sid}&page={$page}" method="post" id="pm_form">
<input type="hidden" id="pm_action" name="pm_action" value="">
{foreach from=$navigate item=one key=page}
	{if $one|count_characters == 0}
		{$page}
	{else}
		<a href="{$GLOBALS.site_url}/private-messages/pm-inbox/?username={$username}&page={$one}&user_group_id={$user_group_id}&user_sid={$user_sid}">{$page}</a>
	{/if}
{/foreach}

<table>
	<thead>
		<tr>
			<th width="40%">Subject</th>
			<th>Author</th>
			<th width="25%">Date</th>
			<th align="center" width="5%"><input id="pm_all_check" type="checkbox"/></th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$message item=one}
			<tr class="{cycle values = 'evenrow,oddrow'}">
				<td><a href="{$GLOBALS.site_url}/private-messages/pm-read/?username={$username}&mess={$one.id}&from=in&page={$page}&user_group_id={$user_group_id}&user_sid={$user_sid}">{$one.subject}</a></td>
				<td>{$one.from_name}</td>
				<td>{$one.data}</td>
				<td align="center"><input class="pm_checkbox" type="checkbox" value="{$one.id}" name="pm_check[]"/></td>
			</tr>
		{/foreach}
	</tbody>
	<thead>
		<tr>
			<td colspan="4"><img border="0" src="{image}delete.png" id="pm_delete" style="cursor: pointer;"></td>
		</tr>
	</thead>
</table>

{foreach from=$navigate item=one key=page}
 {if $one|count_characters == 0}
 {$page}
 {else}
 <a href="{$GLOBALS.site_url}/private-messages/pm-inbox/?username={$username}&page={$one}&user_group_id={$user_group_id}&user_sid={$user_sid}">{$page}</a>
 {/if}
{/foreach}

</form>

<script>
{literal}

$("#pm_form").submit(function(){
	if ($("#pm_action").val() == '') return false;
	else return true;
});



$("#pm_delete").click(function(){
	var butt = $(this);
	if ($(".pm_checkbox:checked").size() > 0) {
		if (!confirm('Are you sure ?')) return false;
			$("#pm_action").val("delete");
			$("#pm_form").submit();
		} else {
			alert('No selection');
			}	
});

$("#pm_all_check").change(function(){
	var total = $(this).attr("checked");
	$(".pm_checkbox").attr("checked", total);
});

{/literal}
</script>


