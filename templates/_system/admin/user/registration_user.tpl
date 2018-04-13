<h3 align="center">Register Agent</h3>

<!--  <h3>Activation:</h3><br> {$form_html} -->
 <form name="frmRegisterUser" enctype="multipart/form-data" method="POST">
<fieldset> <legend><b>  User Info </b></legend>
	<table class="fieldset">
	{foreach from=$form_elements key=key_element item=element} 
	  <tr> 
		{foreach from=$element key=caption item=html_text} 
			<td valign=top>{$caption}</td> <td>{$html_text}</td>
		{/foreach}	
	  </tr> 	
	{/foreach}
	</table>
</fieldset> 
<br>
	<table cellspacing=5><tr> 
	{foreach from=$form_actions item=action} 
		<td>{$action}</td> 
	{/foreach}
	</tr></table>
</form>

