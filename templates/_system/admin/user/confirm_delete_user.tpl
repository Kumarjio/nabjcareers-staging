<h3 align="center">Delete User</h3>

<!--  <h3>Activation:</h3><br> {$form_html} -->
<form name="frmDeleteUser">
<input type="hidden" name="login" value="{$login}">
You really want to delete {$login}?
<span class="greenButtonEnd"><input type=submit name="confirm" value="Yes" class="greenButton" /></span>
<span class="greenButtonEnd"><input type=submit name="confirm" value="No" class="greenButton" /></span>
</form>

