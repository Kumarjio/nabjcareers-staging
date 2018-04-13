<h3 align="center"> Edit User Profile </h3>

<form method="GET">
<fieldset><legend>Delete Profile Item</legend>
<input type="hidden" name="ItemName" value="{$Field->Name}">
<table cellspacing=2 border="0" class="basetable">
<tr class="headrow">
	<td>Item</td><td>Type</td><td>Caption</td><td>Description</td>
</tr>
	<tr class={cycle values="oddrow,evenrow"}><td>{if ($Field->isKeyField)}*{/if} {$Field->Name}</td>
	<td>{$Field->Type}</td>
	<td>{$Field->Caption}</td>
	<td>{$Field->Description}</td>
</tr>
</table><br>
<input type="checkbox" name="update_storage" value="1" checked>Update Storage<br><br>
<input type="hidden" name="ProfileType" value="{$ProfileType}">
<input type="hidden" name="action" value="DeleteField"><input type="submit" value="Delete" class="button"> <input type="submit" name="action" value="Cancel" class="button">
</fieldset>
</form>