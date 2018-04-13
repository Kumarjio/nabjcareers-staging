<h3 align="center"> Select User Profile </h3>

<form method="GET">
<fieldset> <legend><b> User Profile </b></legend>
<br>
Profile Type <select class="list" size="1" name="ProfileType">
			<option value="agent" selected>Agent</option>
			<option value="developer">Developer</option>
			<option value="business">Business</option>
		</select>
		
<input type="hidden" name="action" value="read">		
<input type="submit" value="Edit" class="button">
</fieldset>
</form>
