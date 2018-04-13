{breadcrumbs}Membership Plans{/breadcrumbs}
<h1>Membership Plans</h1>
<p><a href="{$GLOBALS.site_url}/membership-plan/add/">Add a New Membership Plan</a></p>


<table>
	<thead>
	    <tr>
	    	<th>Id</th>
	        <th>Name</th>
	        <th>Descriptin</th>
	        <th>Price</th>
	        <th>Subscribed Users</th>
	        <th colspan="3" class="actions">Actions</th>
	    </tr>
    </thead>
    
    {if $url != "/resume-plans/"} {* MEMBERSHIP PLANS page *}
    
    
    <tbody>
	    {foreach from=$membership_plans item=membership_plan}
	    {if $membership_plan.id != "34" && $membership_plan.id != "33" && $membership_plan.id != "37" && $membership_plan.id != "36"}
	    	<tr class="{cycle values = 'evenrow,oddrow'}">
	    		<td>{$membership_plan.id}</td>
	        	<td>{$membership_plan.name}</td>
	        	<td>{$membership_plan.description}</td>
	        	<td>{$membership_plan.price}</td>
	        	<td>{$membership_plan.subscribed_users}</td>
	        	<td><a href="{$GLOBALS.site_url}/membership-plan/?id={$membership_plan.id}" title="Edit"><img src="{image}edit.png" border="0" alt="Edit" /></a></td>
	        	<td><span class="greenButtonEnd"><input type="button" onclick="location.href='{$GLOBALS.site_url}/system/users/acl/?type=plan&amp;role={$membership_plan.id}'" class="greenButton" value="Manage permissions" /></span></td>
	        	{if $membership_plan.subscribed_users}
	        		<td>&nbsp;</td>
	        	{else}
		        	<td><a href="{$GLOBALS.site_url}/membership-plans/?action=delete&membership_plan_sid={$membership_plan.id}" onClick="return confirm('Are you sure you want to delete this membership plan?');" title="Delete"><img src="{image}delete.png" border="0" alt="Delete" /></a></td>
	        	{/if}
	    	</tr>
	    {/if}
	    {/foreach}
	</tbody>
	
	{else} {* RESUME PLANS page *}
	    <tbody>
	    {foreach from=$membership_plans item=membership_plan}
	    	{if $membership_plan.id != "35"}	    	
		    	<tr class="{cycle values = 'evenrow,oddrow'}">
		    		<td>{$membership_plan.id}</td>
		        	<td>{$membership_plan.name}</td>
		        	<td>{$membership_plan.description}</td>
		        	<td>{$membership_plan.price}</td>
		        	<td>{$membership_plan.subscribed_users}</td>
		        	<td><a href="{$GLOBALS.site_url}/membership-plan/?id={$membership_plan.id}" title="Edit"><img src="{image}edit.png" border="0" alt="Edit" /></a></td>
		        	<td><span class="greenButtonEnd"><input type="button" onclick="location.href='{$GLOBALS.site_url}/system/users/acl/?type=plan&amp;role={$membership_plan.id}'" class="greenButton" value="Manage permissions" /></span></td>
		        	{if $membership_plan.subscribed_users}
		        		<td>&nbsp;</td>
		        	{else}
			        	<td><a href="{$GLOBALS.site_url}/membership-plans/?action=delete&membership_plan_sid={$membership_plan.id}" onClick="return confirm('Are you sure you want to delete this membership plan?');" title="Delete"><img src="{image}delete.png" border="0" alt="Delete" /></a></td>
		        	{/if}
		    	</tr>	    	
	    	{/if}
	    {/foreach}
	</tbody>
	{/if}

</table>