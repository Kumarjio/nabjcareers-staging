<h3 align="center"> Edit User Profile </h3>

<fieldset> <legend><b> User Info </b></legend>
<br>
<table cellspacing=2 border="0" class="basetable">
<tr class="headrow">
	<td>Item</td><td>Type</td><td>Caption</td><td>Description</td><td>Actions</td>
</tr>
{foreach from=$ProfileFields item=Field} 	
<tr class={cycle values="oddrow,evenrow"}><td>{if ($Field->isKeyField)}*{/if} {$Field->Name}</td>
	<td>{$Field->Type}</td>
	<td>{$Field->Caption}</td>
	<td>{$Field->Description}</td>
	<td><a href="?ItemName={$Field->Name}&action=editcolum_form&ProfileType={$ProfileType}">Edit</a> {if (!$Field->isKeyField)}<a href="?ItemName={$Field->Name}&action=deletecolum_form&ProfileType={$ProfileType}">Delete</a>{/if}</td>
</tr>
{/foreach}
<tr>
	<td>* - Key Fields</td><td></td>
</tr>
</table>
<a href="?action=addcolum_form&ProfileType={$ProfileType}">Add New Field</a>
</fieldset>
