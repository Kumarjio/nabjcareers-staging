<script language="JavaScript">
{literal}
	function check(f) {

		if ( (f['confirm_primary_email'].value != f['primary_sales_agent_email'].value) || !f['confirm_primary_email'].value) {
			alert("e-Mail Addresses don't match");
			f['confirm_primary_email'].focus();
			return false;
		} else if ( (f['confirm_sec_email'].value != f['sec_sales_agent_email'].value) || !f['confirm_sec_email'].value) {
			alert("e-Mail Addresses don't match");
			f['confirm_sec_email'].focus();
			return false;
		} else if ( (f['confirm_third_email'].value != f['third_sales_agent_email'].value) || !f['confirm_third_email'].value) {
			alert("e-Mail Addresses don't match");
			f['confirm_third_email'].focus();
			return false;
		} else {
			return true;
		}
	}
{/literal}
</script>
<h3 align="center">Developer / Sales Office Registration</h3>

<!--  <h3>Activation:</h3><br> {$form_html} -->
 <form name="frmRegistration" enctype="multipart/form-data" method="POST">
<fieldset> <legend><b>  User Info </b></legend>

	<table class="fieldset">
		<tr><td width=200>{$form_elements.login.caption}</td><td>{$form_elements.login.element}</td> </tr>
		<tr><td>{$form_elements.password.caption}</td><td>{$form_elements.password.element}</td> </tr>
		<tr><td>{$form_elements.ConfirmPass.caption}</td><td>{$form_elements.ConfirmPass.element}</td> </tr>
		<tr><td>{$form_elements.community_name.caption}</td><td>{$form_elements.community_name.element}</td> </tr>
		<tr><td width=200>{$form_elements.sales_office_address.caption}</td><td>{$form_elements.sales_office_address.element}</td></tr>
	</table>
	<table class="fieldset"><tr>
	  <td>{$form_elements.city.caption}</td><td>{$form_elements.city.element}</td>
		<td>{$form_elements.state.caption}</td><td>{$form_elements.state.element}</td>
		<td>{$form_elements.zip.caption}</td><td>{$form_elements.zip.element}</td>
	</tr></table>
	<table class="fieldset">
		<tr><td>{$form_elements.primary_sales_agent_name.caption}</td><td>{$form_elements.primary_sales_agent_name.element}</td></tr>
		<tr><td>{$form_elements.primary_sales_agent_email.caption}</td><td>{$form_elements.primary_sales_agent_email.element}</td></tr>
		<tr><td>Confirm e-Mail Address</td><td><input type="text" name="confirm_primary_email" class="text" size="36"></td></tr>
		<tr><td>{$form_elements.sec_sales_agent_name.caption}</td><td>{$form_elements.sec_sales_agent_name.element}</td></tr>
		<tr><td>{$form_elements.sec_sales_agent_email.caption}</td><td>{$form_elements.sec_sales_agent_email.element}</td></tr>
		<tr><td>Confirm e-Mail Address</td><td><input type="text" name="confirm_sec_email" class="text" size="36"></td></tr>
		<tr><td>{$form_elements.third_sales_agent_name.caption}</td><td>{$form_elements.third_sales_agent_name.element}</td></tr>
		<tr><td>{$form_elements.third_sales_agent_email.caption}</td><td>{$form_elements.third_sales_agent_email.element}</td></tr>
		<tr><td>Confirm e-Mail Address</td><td><input type="text" name="confirm_third_email" class="text" size="36"></td></tr>
		<tr><td>{$form_elements.builder_company.caption}</td><td>{$form_elements.builder_company.element}</td></tr>
		<tr><td>{$form_elements.developer_name.caption}</td><td>{$form_elements.developer_name.element}</td></tr>
	</table>
	<br>

	<table cellspacing=5><tr>
	{foreach from=$form_actions item=action}
		<td>{$action}</td>
	{/foreach}
	</tr></table>

</form>

