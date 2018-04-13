{$error}
<form method="post">
	<input type="hidden" name="action" value="change" />
	<input type="hidden" name="page_sid" value={$page_sid} />
	<table width="100%">
		<tr>
			<td width="15%">ID</td>
			<td><input type="text" name="page_id" value="{$page.id}" class="text" /></td>
		</tr>
		<tr>
			<td>Static content name</td>
			<td><input type="text" name="name" value="{$page.name}" class="text" /></td>
		</tr>
		<tr>
			<td>Language</td>
			<td>
				<select name="lang">
					{foreach from=$GLOBALS.languages item=language}
						<option value="{$language.id}"{if $language.id == $page.lang} selected="selected"{/if}>{$language.caption}</option>
					{/foreach}
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">Static content:</td>
		</tr>
		<tr>
			<td colspan="2">{WYSIWYGEditor name="content" width="100%" height="700" value=$page_content type="fckeditor" conf="BasicAdmin"}</td>
		</tr>
		<tr id="clearTable">
			<td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Change" class="greenButton" /></span></td>
		</tr>
	</table>
</form>