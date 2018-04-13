<h3 align="center"> Edit User Profile </h3>

<form method="GET">
<fieldset><legend>Add a New Profile Item</legend>
<table class="fieldset">
<tr>
	<td>Item&nbsp;<input type="text" name="ItemName" class="text"></td>
	<td class="leftpadding">Type&nbsp;<select class="list" size="1" name="ItemType">
			<!--<option value="0">List</option>-->
			<option value="1">Integer</option>
			<!--<option value="2">Date</option>-->
			<option value="3">Datetime</option>
			<option value="4">Float</option>
			<option value="5">Yes/No</option>
			<option value="6" selected>String</option>
			<option value="7">Text</option>
			<!--<option value="8">Timestamp</option>-->
			<!--<option value="9">Tree</option>-->
			<!--<option value="10">Gallery</option>-->
			<!--<option value="11">Geographical</option>-->
			<!--<option value="12">Year</option>-->
			<!--<option value="13">Video</option>-->
			<!--<option value="15">Web Link</option>-->
			<!--<option value="16">ID</option>-->
		</select>&nbsp;Size&nbsp;<input type="text" name="Size" class="text"></td>
</tr>
<tr>
	<td>Caption&nbsp;<input type="text" name="Caption" class="text"></td>
	<td>Description&nbsp;<input type="text" name="Description" class="text"></td>
</tr>
</table>
<input type="checkbox" name="update_storage" value="1" checked>Update Storage<br><br>
<input type="hidden" name="action" value="NewField">
<input type="hidden" name="ProfileType" value="{$ProfileType}">
<span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton"></span> <span class="greenButtonEnd"><input type="submit" name="action" value="Cancel" class="greenButton"></span>
</fieldset>
</form>