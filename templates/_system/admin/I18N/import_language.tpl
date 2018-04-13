{breadcrumbs}Import Language{/breadcrumbs}
<h1>Import Language</h1>
{foreach from=$errors item=error}
	<p class="error">{$error}</p>
{/foreach}
<form action="" method="post" enctype="multipart/form-data">
	<table>
		<tr class="evenrow">
			<td>Language Import File</td>
			<td><input type="file" name="lang_file" /></td>
		</tr>
		<tr class="oddrow">
			<td colspan="2">
				<input type="hidden" name="action" value="import_language" />
				<span class="greenButtonEnd"><input type="submit" class="greenButton" value="Import" /></span>
			</td>
		</tr>
	</table>
</form>