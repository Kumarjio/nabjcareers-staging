{breadcrumbs}Edit css{/breadcrumbs}
<h1>Edit css</h1>

{if $ERROR eq "NOT_ALLOWED_IN_DEMO"}
	<p class="error">CSS file is not editable in demo.</p>
{/if}

<table>
	<thead>
		<tr>
			<th>File</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$files item=file}
		<tr class="{cycle values = 'evenrow,oddrow'}">
			<td>{$file}</td>
			<td><a href="?action=edit&file={$file}"><img src="{image}edit.png" hspace="3" border=0 alt="Edit"></a></td>
		</tr>
		{/foreach}
	</tbody>
</table>

<h3>{$cssFile}</h3>
{if $action == "edit" || $action == "save"}
<form method="post">
	<input type="hidden" name="file" value="{$cssFile}" />
	<input type="hidden" name="action" value="save" />
	<textarea style="width: 100%; height: 400px;" id="template_content" class="text" name="file_content">{$file_content}</textarea>
	<br/><br/><span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton"/></span>
</form>
{/if}
