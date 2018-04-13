
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.form.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>
{literal}
<script type="text/javascript">

var progbar = "<img src='{/literal}{$GLOBALS.site_url}/../system/ext/jquery/progbar.gif{literal}'>";
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
				if(parentReload == true) {
					parent.document.location.reload();
			}}
		});
	});
	return false;
	});
</script>
{/literal}
<small>Click on the plan to view its details and available actions </small> <br /> <br />
{foreach from=$membership_plans item=plan}
	<a href="{$GLOBALS.site_url}/user-membership-plan/?userId={$user.sid}&contract_id={$plan.id}&user_group_id={$user_group_id}" class="getUser">{$plan.extra_info.name}</a><br /><br />
{/foreach}

{if $changed}
	<script> var parentReload = true;</script>
{/if}
