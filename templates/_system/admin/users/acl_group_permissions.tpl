<table>
	<thead>
		<tr>
			<th width="400px">Permission</th>
			{if $type == 'plan' && $membershipPlanInfo.user_group_sid}
				<th width="150px">Plan permissions</th>
				<th width="150px">User Group Permissions</th>
			{else}
				<th width="150px"></th>
				<th width="150px"></th>
			{/if}
		</tr>
	</thead>
	<tbody>
	    {foreach item=permission from=$resources}
	    	{if $permission.group == $group}
	        	<tr class="{cycle values = 'evenrow,oddrow'}">
	        		<td>{$permission.title}</td>
	        		<td>
	        			{if $type == 'user'}
	        				{if $acl->isAllowed($permission.name, $role)}
	        					Allowed
	        				{else}
	        					Denied
	        				{/if}
	        			{elseif $type == 'guest' || $type == 'group' || $permission.type == 'plan'}
	            			<label for="{$permission.name}_allow">Allow</label>
	            			<input type="hidden" name="{$permission.name}" value="inherit" />
	            			<input id="{$permission.name}_allow" type="checkbox" name="{$permission.name}" value="allow" {if $permission.value == "allow"}checked="checked"{/if} onchange="viewPermission(this);" class="permissionSelect" />
	        			{else}
	        				<select name="{$permission.name}" onchange="viewPermission(this);" class="permissionSelect">
	        					<option value="inherit" {if $permission.value != "allow" && $permission.value != "deny"}selected="selected"{/if}>Use user group permission</option>
	        					<option value="allow" {if $permission.value == "allow"}selected="selected"{/if}>Allow</option>
	        					<option value="deny" {if $permission.value == "deny"}selected="selected"{/if}>Deny</option>
	        				</select>
	        			{/if}
	            		{if $permission.limitable && $type == 'plan'}
	                		<div id="{$permission.name}_amountPermissions">
		            			{if strpos($permission.name, 'post') !== false}Number of postings{else}Number of views{/if} <input size="4" type="text" name="{$permission.name}_params" value="{$permission.params}" />
		            			<br /><div style="font-size: 9px">Set empty or 0 for unlimited number.</div>
	            			</div>
	            		{/if}
	        		</td>
	        		<td>
	            		{if $type == 'user'}
	    					{if $permission.limitable && $acl->isAllowed($permission.name, $role)}
	    						{if $acl->getPermissionParams($permission.name, $role)}
	    							{$acl->getPermissionParams($permission.name, $role)}
	    							{if $acl->getPermissionParams($permission.name, $role) == 1}
	    								{if strpos($permission.name, 'post') !== false}
	    									posting
	    								{else}
	    									use
	    								{/if}
	    							{else}
	    								{if strpos($permission.name, 'post') !== false}
	    									postings
	    								{else}
	    									uses
	    								{/if}
	    							{/if}
	    						{else}
									{if strpos($permission.name, 'post') !== false}
										unlimited postings
									{else}
										unlimited use
									{/if}
	    						{/if}
	    					{/if}
	            		{/if}
	            		{if $type == 'plan' && $membershipPlanInfo.user_group_sid}
		    				{if $acl->isAllowed($permission.name, $membershipPlanInfo.user_group_sid, "group")}
		    					{if $permission.limitable}
	    							unlimited
	    						{else}
	    							allow
	    						{/if}
	        				{else}
	        					deny
	        				{/if}
	            		{/if}
	        		</td>
	        	</tr>
	    	{/if}
	    {/foreach}
	</tbody>
</table>