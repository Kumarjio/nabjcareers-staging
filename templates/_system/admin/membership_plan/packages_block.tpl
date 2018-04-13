<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Type</th>
			<th>Number of Listings</th>
			<th colspan="4" class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
	{foreach from=$packages item=package name=items_block}
		<tr class="{cycle values = 'evenrow,oddrow'}">
			<td>{$package.fields.name}</td>
			<td>{$package.fields.description}</td>
			<td>{$package.class_name}</td>
			<td>{$package.number_of_listings}</td>
			<td><a href="{$GLOBALS.site_url}/membership-plan/package/?id={$package.id}" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a></td></td>
			<td><a href="{$GLOBALS.site_url}/membership-plan/package/?action=delete&id={$package.id}" onClick="return confirm('Are you sure you want to delete this package?');" title="Delete"><img src="{image}delete.png" hspace="3" border=0 alt="Delete"></a></td>
			<td>
				{if $smarty.foreach.items_block.iteration < $smarty.foreach.items_block.total}
					<a href="?package_id={$package.id}&amp;action=move_down&id={$membership_plan_id}"><img src="{image}b_down_arrow.gif" border="0" alt=""/></a>
				{/if} 
			</td>
			<td>
				{if $smarty.foreach.items_block.iteration > 1}
					<a href="?package_id={$package.id}&amp;action=move_up&id={$membership_plan_id}"><img src="{image}b_up_arrow.gif" border="0" alt=""/></a>
				{/if} 
			</td>
		</tr>
	{/foreach}
	</tbody>
</table>