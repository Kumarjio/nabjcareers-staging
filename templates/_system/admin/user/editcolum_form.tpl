<h3 align="center"> Edit User Profile </h3>


<form method="GET">
<fieldset><legend>Edit Profile Item</legend>
<table class="fieldset">
<tr>
	<input type="hidden" name="ItemName" value="{$Field->Name}">
	<td>Item&nbsp;{$Field->Name}</td>
	<td class="leftpadding">Type&nbsp;{$Field->Type}</td>
	<td>Caption&nbsp;<input type="text" name="Caption" class="text" value="{$Field->Caption}"></td>
	<td>Description&nbsp;<input type="text" name="Description" class="text" value="{$Field->Description}"></td>
</tr>
</table>
<input type="hidden" name="ProfileType" value="{$ProfileType}">
<input type="hidden" name="action" value="SaveField"><input type="submit" value="Update" class="button"> <input type="submit" name="action" value="Cancel" class="button">
</fieldset>
</form>