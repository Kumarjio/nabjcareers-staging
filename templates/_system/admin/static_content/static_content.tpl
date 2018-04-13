{breadcrumbs}Static Content{/breadcrumbs}
<h1>Static Content</h1>
{$error}

<form method=post>
	<fieldset>
		<legend>Add a New Static Content</legend>
		<input type= "hidden" name= "action" value= "add">
		<table>
			<tr>
				<td>ID</td>
				<td><input type="text" name="page_id" value="" class="text"></td>
			</tr>
			<tr>
				<td>Name</td>
				<td><input type="text" name="name" value="" class="text" onFocus="JavaScript: if (!this.value) this.value=pageid.value;"></td>
			</tr>
			<tr>
				<td>Language</td>
				<td>
					<select name="lang">
						{foreach from=$GLOBALS.languages item=language}
							<option value="{$language.id}"{if $language.id == $GLOBALS.current_language} selected="selected"{/if}>{$language.caption}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton" /></span></td>
			</tr>
		</table>
	</fieldset>
</form>

<div class="clr"><br/></div>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Language</th>
			<th colspan=2 class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$pages item=page key=sid name=foreach}
			<tr class={cycle values="'oddrow', 'evenrow'"}>
				<td>{$page.id}</td>
				<td>{$page.name}&nbsp;</td>
				<td>
					{foreach from=$GLOBALS.languages item=language}
						{if $language.id == $page.lang}{$language.caption}{/if}
					{/foreach}
				</td>
				<td><a href="?action=edit&page_sid={$sid}&pageid={$page.id}" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a></td>
				<td><a href="?action=delete&page_sid={$sid}" onclick="return confirm('Are you sure you want to delete this Static Content?')" title="Delete"><img src="{image}delete.png" border=0 alt="Delete"></a></td>
			</tr>
		{/foreach}
	</tbody>
</table>