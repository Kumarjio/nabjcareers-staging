{if $GLOBALS.current_user.logged_in}
	<a href="{$GLOBALS.site_url}/private-messages/inbox/" class="pm">{if $url=="/private-messages/inbox/"}<b>[[Inbox]]</b>{else}[[Inbox]]{/if}</a> ({$unread}) | 
	<a href="{$GLOBALS.site_url}/private-messages/outbox/" class="pm">{if $url=="/private-messages/outbox/"}<b>[[Outbox]]</b>{else}[[Outbox]]{/if}</a> | 
	<a href="{$GLOBALS.site_url}/private-messages/send/" class="pm">{if $url=="/private-messages/send/"}<b>[[Compose Message]]</b>{else}[[Compose Message]]{/if}</a><br>
	{if $errors.NOT_EXISTS_MESSAGE}
		<p class="error">[[Message with specified ID not exists in your mailbox]]</p>
		{assign var="include" value=''}
	{/if}
	<div class="clr"><br/></div>
	{if $include != ""}{include file="$include"}{/if}
	<script>
	{literal}
	
	$("#pm_all_check").click(function () {
		var total = $(this).attr("checked");
		$(".pm_checkbox").attr("checked", total);
	});
	
	$("#pm_controll_delete, #pm_controll_mark").click(function(){
		var butt = $(this);
		if ($(".pm_checkbox:checked").size() > 0) {
				if (butt.attr("id") == "pm_controll_mark"){
					$("#pm_action").val("mark");
				} else {
					if (!confirm("{/literal}[[Are you sure you want to delete this private message?]]{literal}")) return false;
					$("#pm_action").val("delete");
				}
				$("#pm_form").submit();
			} else {
				alert('No selection');
				}	
	});
	
	$("#pm_reply").click(function(){
		document.location.href = $("#pm_reply_link").val();
	});
	
	$("#pm_delete").click(function(){
		if (confirm('{/literal}[[Are you sure?:raw]]{literal}'))
		document.location.href = $("#pm_delete_link").val();
	});
	
	{/literal}
	</script>
{else}
	{assign var="url" value=$GLOBALS.site_url|cat:"/registration/"} 
	<p class="error">[[Please log in to access this page. If you do not have an account, please]] <a href="{$url}">[[Register.]]</a></p>
	{module name="users" function="login"}
{/if}
