{breadcrumbs}<a href="?">Site Pages Management</a> > {$page_info.uri}{/breadcrumbs}

<p class="page_title">Site Pages Management</p>
<table><tr><td>
{foreach from=$ERROR item=error_caption}
	<div>{$error_caption}</div>
{/foreach}
<form method="post">
<input type="hidden" name="action" value="modify_page">
<input type="hidden" name="old_uri" value="{$page_info.uri}">
<fieldset><legend> Change User Page Info</legend>


<table class="fieldset">
<tr>
	<td>URI</td>
	<td><input type="text" name="uri" value="{$page_info.uri}" class="text"></td>
</tr>
<tr>
	<td>Module</td>
	<td><input type="text" name="module" value="{$page_info.module}" class="text"></td>
</tr>
<tr>
	<td>Function</td>
	<td><input type="text" name="function" value="{$page_info.function}" class="text"></td>
</tr>
<tr>
	<td>Template</td>
	<td><input type="text" name="template" value="{$page_info.template}" class="text"></td>
</tr>
<tr>
	<td>Title</td>
	<td><input type="text" name="title" value="{$page_info.title}" class="text"></td>
</tr>
<tr>
	<td valign=top>Parameters</td>
	<td><textarea name="parameters" class="text" rows=5>{$page_info.parameters}</textarea></td>
</tr>
<tr>
	<td valign=top>Keywords</td>
	<td><textarea name="keywords" class="text" rows=5>{$page_info.keywords}</textarea></td>
</tr>
<tr>
	<td></td>
	<td><span class="greenButtonEnd"><input type="submit" value="Change" class="greenButton" /></span></td>
</tr>
</table>

</fieldset>
</form>
</td></tr></table>
