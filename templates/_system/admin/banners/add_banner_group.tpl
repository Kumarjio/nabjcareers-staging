{breadcrumbs}<a href="{$GLOBALS.site_url}/manage-banner-groups/">Banners</a> &#187; Add a New Group</a>{/breadcrumbs}
<h1>Add a New Group</h1>
{if $errors }
	{foreach from=$errors item=error}
		<p class="error">{$error}</p>
	{/foreach}
{/if}

<fieldset>
	<legend>Add a New Group</legend>
	<table>
		<form method="post" enctype="multipart/form-data">
			<input type="hidden" name="action" value="add"> 
			<tr>
				<td valign=top>Group ID</td>
				<td><input type="text" name="groupID" maxlength="20" /></td>
			</tr>
			<tr>
				<td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton" /></span></td>
			</tr>
		</form>
	</table>
</fieldset>