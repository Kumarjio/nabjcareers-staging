{literal}
<script type="text/javascript">
<!--
	function viewPermission(el)
    {
    	var groupDiv = '#' + el.name + '_groupPermissions';
    	var amountDiv = '#' + el.name + '_amountPermissions';

    	if (el.tagName == 'INPUT') {
    		$(groupDiv).hide();
    		if (el.checked) {
    			$(amountDiv).show();
    		}
    		else {
    			$(amountDiv).hide();        		
    		}
    	}
    	else {
        	switch (el.value) {
        		case 'inherit':
            		$(groupDiv).show();
            		$(amountDiv).hide();
            		break;
        		case 'allow':
            		$(groupDiv).hide();
            		$(amountDiv).show();
            		break;
        		case 'deny':
        			$(groupDiv).hide();
        			$(amountDiv).hide();
            		break;
        	}
    	}
	}

    $(document).ready(function () {
        $(".permissionSelect").each(function () {
        	viewPermission(this);
        });
    });

//-->
</script>
{/literal}

{breadcrumbs}
    {if $type == 'user'}
    	<a href="{$GLOBALS.site_url}/users/?restore=1">Users</a> &#187; <a href="{$GLOBALS.site_url}/edit-user/?sid={$role}&user_group_id={$user_group_id}">Edit User Info</a> &#187; View Permissions
    {elseif $type == 'group'}
    	<a href="{$GLOBALS.site_url}/user-groups/">User Groups</a> &#187; <a href="{$GLOBALS.site_url}/edit-user-group/?sid={$role}">{$userGroupInfo.name}</a> &#187; Manage {if $type == 'group'}{$userGroupInfo.name} {/if}Permissions
    {elseif $type == 'guest'}
    	<a href="{$GLOBALS.site_url}/user-groups/">User Groups</a> &#187; Manage Guest Permissions
    {elseif $type == 'plan'}
    	<a href="{$GLOBALS.site_url}/membership-plans/">Membership Plans</a> &#187; <a href="{$GLOBALS.site_url}/membership-plan/?id={$role}">{$membershipPlanInfo.name}</a> &#187; Manage {$membershipPlanInfo.name} Permissions 
    {/if}
{/breadcrumbs}
<h1>
	{if $type == "user"}View{else}Manage{/if} 
	{if $type == 'group'}
		{$userGroupInfo.name}
	{elseif $type == 'guest'}
		Guest
	{elseif $type == 'plan'}
		{$membershipPlanInfo.name}
	{/if} Permissions
</h1>
<div style="width: 700px;	display: block;">
	<form method="post" action="{$GLOBALS.site_url}/system/users/acl/">
		<input type="hidden" name="action" value="save" />
		<input type="hidden" name="type" value="{$type}" />
		<input type="hidden" name="role" value="{$role}" />
		<h3>General permissions</h3>
		{include file="acl_group_permissions.tpl" group="general"}
		
		{foreach item=listingType from=$listingTypes}
			<h3>{$listingType.name} permissions</h3>
			{include file="acl_group_permissions.tpl" group=$listingType.id}
		{/foreach}
	
		{if $type != 'user'}
	    	{if $type == 'plan'}
	        	<table width="100%" id="clear">
	        		<tr>
	        			<td  width="100%" style="text-align: right;"><small><b>Apply changes to all users currently subscribed to this plan</b></small></td><td align="right" ><input type="radio" name="update_users" value="1" checked="checked" /></td>
	        		</tr>
	        		<tr>
	        			<td  style="text-align: right;"><small><b>Changes will be applied to newly subscribed users only</b></small></td><td align="right" ><input type="radio" name="update_users" value="0"></td>
	        		</tr>
	        	</table>
	    	{/if}
			<br/><span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton" /></span>
		{/if}
	</form>
</div>