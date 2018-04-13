<h3 align="center"> Edit User Profile </h3>

<!--  <h3>Activation:</h3><br> {$form_html} -->
 <form method="GET">
<fieldset><legend>Add a New Profile Item</legend>

<input type="hidden" name="action" value="addcolumn">
<table class="fieldset">
<tr>
	<td>Item</td><!---->
	<td><input type="text" name="newid" class="text"></td><!---->
	<td class="leftpadding">Type</td>
	<td><select class="list" size="1" name="columntype"><option value="0">List</option>
<option value="1">Integer</option>
<option value="2">Date</option>
<option value="3">Datetime</option>
<option value="4">Float</option>
<option value="5">Yes/No</option>
<option value="6">String</option>
<option value="7">Text</option>
<option value="8">Timestamp</option>
<option value="9">Tree</option>
<option value="10">Gallery</option>
<option value="11">Geographical</option>
<option value="12">Year</option>
<option value="13">Video</option>
<option value="15">Web Link</option>
<option value="16">ID</option>
</select></td>
	<td class="leftpadding"><input type="submit" value="Add" class="button"></td>
</tr>
</table>
</fieldset>
</form>

<fieldset> <legend><b> User Info </b></legend>
<br>
<table cellspacing=2 border="0" class="basetable">
<tr class="headrow">
	<td>Item</td><td>Type</td><td>Caption</td><td>Actions</td>
</tr>
{foreach from=$ProfileFields item=Field} 	
<tr class={cycle values="oddrow,evenrow"}><td>{if ($Field->isKeyField)}*{/if} {$Field->Name}</td>
	<td>{$Field->Type}</td>
	<td>{$Field->Caption}</td>
	<td>Edit {if (!$Field->isKeyField)}Delete{/if}</td>
</tr>
{/foreach}
<tr>
	<td>* - Key Fields</td><td></td>
</tr>
</table>
</fieldset>

