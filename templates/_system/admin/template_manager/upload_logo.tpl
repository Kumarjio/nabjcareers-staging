{breadcrumbs}Upload logo for theme {$theme}{/breadcrumbs}
<h1>Upload logo for theme {$theme}</h1>

{foreach from=$errors item=error}
	<p class="error">
		{if $error == "NOT_ALLOWED_IN_DEMO"}
			Logo is not uploadable in demo.
		{else}
			{$error}
		{/if}
	</p>
{/foreach}
<p><img src="{$GLOBALS.user_site_url}/templates/{$theme}/main/images/logo.png" /></p>

<form method="post" enctype="multipart/form-data" action="">
	<input type="hidden" name="action" value="save" />
	<table>
			<tr>
				<td>File</td>
				<td><input type="file" name="logo" /></td>
			</tr>
			<tr>
				<td>Alternative text</td>
				<td><input type="text" name="logoAlternativeText" value="{$logoAlternativeText}" /></td>
			</tr>
			<tr>
				<td colspan="2">
					<span class="greenButtonEnd"><input type="submit" name="submit" value="Save" class="greenButton" /></span>
				</td>
			</tr>
	</table>
</form>