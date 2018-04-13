{breadcrumbs}<a href="{$GLOBALS.site_url}/manage-breadcrumbs/">Manage Breadcrumbs</a> &#187; Add Item{/breadcrumbs}
{if $parentElement.parent_id neq 0}
	<h1>Create child item of '{$parentElement.name}'</h1>
{else}
	<h1>Create child item of '/'</h1>
{/if}

<form method="post">
	<input type="hidden" name="action" value="add" />
	<input type="hidden" name="element_id" value="{$parentElement.id}" />
	<table>
		<tr>
			<td>Name</td>
			<td><input type="text" name="item_name"></td>
		</tr>
		<tr>
			<td>URI</td>
			<td><input type="text" name="item_uri"></td>
		</tr>
		<tr>
			<td colspan="2"><span class="greenButtonEnd"><input type="submit" name="addElement" value="Add Element" class="greenButton" /></span></td>
	</table>
</form>