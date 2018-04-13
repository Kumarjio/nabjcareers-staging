{breadcrumbs}Breadcrumbs{/breadcrumbs}
<h1>Breadcrumbs</h1>

{foreach from=$ERRORS item="error_message" key="error"}
	{if $error eq "NOT_ID"}
		<p class="error">Not set 'element_id'!</p>
	{/if}
{/foreach}


<table>
	<thead>
		<tr>
			<th>Item Name</th>
			<th class="actions">Actions</th>
		</tr>
	</thead>
	<tr>
		<td><b style="color: #00f">/</b></td>
		<td>
			<span class="greenButtonInEnd"><a href="{$GLOBALS.site_url}/manage-breadcrumbs/?action=add&element_id=0" class="greenButtonIn">Add Child</a></span>
		</td>
	</tr>
	{assign var="counter" value=0}
	{foreach from=$navStructure item=navItem name=navForeach}
		{assign var="counter" value=$counter+1}
		{if $navItem.sublevel eq '0'}
		<tr class="{if $counter is odd}oddrow{else}evenrow{/if}">
			<td>&nbsp;&nbsp;&nbsp;<b style="color: #00f">{$navItem.name}</b></td>
		{else}
		<tr class="{if $counter is odd}oddrow{else}evenrow{/if}">
			<td>&nbsp;&nbsp;&nbsp;{section name=for loop=$navItem.sublevel start=0 step=1}&nbsp;&nbsp;&nbsp;{/section}<b>{$navItem.name}</b></td>
		{/if}
			<td>
				<span class="greenButtonInEnd"><a href="{$GLOBALS.site_url}/manage-breadcrumbs/?action=add&element_id={$navItem.id}" class="greenButtonIn">Add Child</a></span>
				<span class="greenButtonInEnd"><a href="{$GLOBALS.site_url}/manage-breadcrumbs/?action=edit&element_id={$navItem.id}" class="greenButtonIn">Edit</a></span>
				<span class="deleteButtonEnd"><a href="{$GLOBALS.site_url}/manage-breadcrumbs/?action=delete&element_id={$navItem.id}" onclick="return confirm('Are you sure you want to delete the \'{$navItem.name}\' item and all child items of it?')" title="Delete" class="deleteButton">Delete</a></span>
			</td>
		</tr>
	{/foreach}
</table>