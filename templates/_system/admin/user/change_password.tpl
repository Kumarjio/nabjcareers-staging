<h3 align="center"> Change User Password </h3>

<!--  <h3>Activation:</h3><br> {$form_html} -->
<form name="frmChangePassword2">
<input type=hidden name="login" value={$login}>
<fieldset> <legend><b> User Info </b></legend>
	<table class="fieldset">
	<tr>
		<td colspan=2 style="color:red"><small>
			{foreach from=$ERROR item="error_message" key="error"}
				{if $error eq "NOT_EXIST_PASSWORD2"}	No filled confirmed password
				{elseif $error eq "NOT_PASSWORD_EQ"}	No equal password
				{/if}
			{/foreach}				
		</small></td>
	</tr>
	
	<table class="fieldset">
		<tr><td width=150>{$form_elements.login.caption}</td><td>{$form_elements.login.element}</td> </tr>
		<tr><td width=150>{$form_elements.password.caption}</td><td>{$form_elements.password.element}</td> </tr>	
		<tr><td width=150>{$form_elements.password2.caption}</td><td>{$form_elements.password2.element}</td> </tr>			
	</table>

</fieldset> 
<br>
	<table cellspacing=5><tr> 
	{foreach from=$form_actions item=action} 
		<td>{$action}</td> 
	{/foreach}
	</tr></table>
</form>

