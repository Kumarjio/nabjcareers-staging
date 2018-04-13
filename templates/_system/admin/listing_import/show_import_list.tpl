{breadcrumbs}XML Import{/breadcrumbs}
<h1>XML Import</h1>
<p>XML import allows you to import job postings from other sites such as Indeed and SyplyHired</p>
<p><a href="{$GLOBALS.site_url}/add-import/?add_level=1">Add new data source</a></p>

{assign var="counter" value=0}

<p><strong>XML Data Sources</strong></p>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Description</th>
			<th nowrap="nowrap" class="actions">Actions</th>
			<th>Status</th>		
		</tr>
	</thead>
	{foreach from=$systemParsers item=curr}
		{if $curr.active == 0}
			{assign var="stat" value="off"}
			{assign var="action" value="activate"}
			{assign var="title" value="Not active. Click to activate"}				
		{else}
			{assign var="stat" value="on"}
			{assign var="action" value="deactivate"}
			{assign var="title" value="Active. Click to deactivate"}			
		{/if}
		{assign var="counter" value=$counter+1}
		<tr class="{if $counter is odd}oddrow{else}evenrow{/if}">
			<td>{$curr.id}</td>
			<td>{$curr.name}</td>
			<td>{$curr.description}</td>
			<td nowrap="nowrap"><a href="{$GLOBALS.site_url}/run-import/?id={$curr.id}"><img border=0 alt="run parser" title="run parser" src="{image}run.gif"></a> <a href="{$GLOBALS.site_url}/edit-import/?id={$curr.id}"><img border=0 title="edit parser" alt="edit parser" src="{image}edit.png"></a> <a href="{$GLOBALS.site_url}/delete-import/?id={$curr.id}" onclick="return confirm('Are you sure ?');"><img border=0 title="delete parser" alt="delete parser" src="{image}delete.png"></a></td>
			<td><center><a href="?action={$action}&id={$curr.id}"><img title="{$title}" border=0 src="{image}{$stat}.gif"></a></center></td>
		</tr>
	{/foreach}
</table>