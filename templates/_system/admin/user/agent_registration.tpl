<h3 align="center">Register a New Agent Account</h3>

<!--  <h3>Activation:</h3><br> {$form_html} -->
 <form name="frmRegistration" enctype="multipart/form-data" method="POST">
<fieldset> <legend><b>  User Info </b></legend>

	<table class="fieldset">
		<tr><td width=150>Public ID#</td><td>{$form_elements.login.element}</td> </tr>
		<tr><td width=150>{$form_elements.password.caption}</td><td>{$form_elements.password.element}</td> </tr>
		<tr><td width=150>{$form_elements.ConfirmPass.caption}</td><td>{$form_elements.ConfirmPass.element}</td> </tr>
		<tr><td width=150>{$form_elements.first_name.caption}</td><td>{$form_elements.first_name.element}</td></tr>
		<tr><td width=150>{$form_elements.last_name.caption}</td><td>{$form_elements.last_name.element}</td> </tr>
		<tr><td width=150>{$form_elements.email.caption}</td><td>{$form_elements.email.element}</td></tr>
		<tr><td width=150>{$form_elements.ConfirmEmail.caption}</td><td>{$form_elements.ConfirmEmail.element}</td></tr>
	</table>
	<table class="fieldset">
		<tr><td width=150>{$form_elements.company_name.caption}</td><td>{$form_elements.company_name.element}</td></tr>
		<tr><td width=150>{$form_elements.company_address.caption}</td><td>{$form_elements.company_address.element}</td></tr>
	</table>
	<table class="fieldset"><tr>
	  <td>{$form_elements.city.caption}</td><td>{$form_elements.city.element}</td>
		<td>{$form_elements.state.caption}</td><td>{$form_elements.state.element}</td>
		<td>{$form_elements.zip.caption}</td><td>{$form_elements.zip.element}</td>
	</tr></table>
	<table class="fieldset">
		<tr>
			<td>Office Phone: </td>
		  <td>{$form_elements.phone_office_area_code.caption}</td><td>{$form_elements.phone_office_area_code.element}</td>
			<td>{$form_elements.phone_office_number.caption}</td><td>{$form_elements.phone_office_number.element}</td>
			<td>{$form_elements.phone_office_ext.caption}</td><td>{$form_elements.phone_office_ext.element}</td>
		</tr>
		<tr>
			<td>Cell Phone: </td>
		  <td>{$form_elements.phone_cell_area_code.caption}</td><td>{$form_elements.phone_cell_area_code.element}</td>
			<td>{$form_elements.phone_cell_number.caption}</td><td>{$form_elements.phone_cell_number.element}</td>
		</tr>
	</table>

	<table>
		<tr><td width=150>{$form_elements.personal_address.caption}</td><td>{$form_elements.personal_address.element}</td></tr>
	</table>

	<table class="fieldset"><tr>
	  <td>{$form_elements.home_city.caption}</td><td>{$form_elements.home_city.element}</td>
		<td>{$form_elements.home_state.caption}</td><td>{$form_elements.home_state.element}</td>
		<td>{$form_elements.home_zip.caption}</td><td>{$form_elements.home_zip.element}</td>
	</tr></table>
	
	<table>	
		<tr><td width=55>{$form_elements.home_country.caption}</td><td>{$form_elements.home_country.element}</td></tr>	
	</table>			
	
	
	<br>	
	<table cellspacing=5><tr>
	{foreach from=$form_actions item=action}
		<td>{$action}</td>
	{/foreach}
	</tr></table>

</form>

