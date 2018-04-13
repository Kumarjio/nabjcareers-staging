{breadcrumbs}Manage Languages{/breadcrumbs}
<h1>Manage Languages</h1>

{foreach from=$errors item=error}
	<p class="error">{$error}</p>
{/foreach}
<p><a href="{$GLOBALS.site_url}/add-language/">Add a New Language</a></p>

<table>
	<thead>
		<tr>
			<td>Language Caption</td>
			<td>Active</td>
			<td colspan=4 class="actions">Actions</td>
		</tr>
	</thead>
	{foreach from=$langs item=lang}
		<tr class="{cycle values = 'evenrow,oddrow'}">
			<td>{$lang.caption}</td>
			<td>{if $lang.active}Yes{else}No{/if}</td>
			<td><a href="{$GLOBALS.site_url}/edit-language/?languageId={$lang.id}" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a></td>
			<td>
				{if !$lang.is_default}
					<a href="{$GLOBALS.site_url}/manage-languages/?languageId={$lang.id}&action=delete_language" onclick='return confirm("Do you want to delete {$lang.caption} language?")' title="Delete"><img src="{image}delete.png" border=0 alt="Delete"></a>
				{/if}
			</td>
			<td><a href="{$GLOBALS.site_url}/manage-phrases/?language={$lang.id}&action=search_phrases">Translate Phrases</a></td>
			<td>
				{if $lang.is_default}
					<b>Default</b>
				{elseif $lang.active}
					<a href="{$GLOBALS.site_url}/manage-languages/?languageId={$lang.id}&action=set_default_language">Make Default</a>
				{/if}
			</td>
		</tr>
	{/foreach}
</table>