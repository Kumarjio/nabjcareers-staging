<h3 align="center"> Edit User Profile </h3>

<form name="frmRegistration" enctype="multipart/form-data" method="POST">
    <fieldset><legend><b> User Info </b></legend>
    	<table class="fieldset">
    		<tr><td width="200">{$form_elements.login.caption}</td><td>{$form_elements.login.element}</td></tr>
    		<tr><td>{$form_elements.business_name.caption}</td><td>{$form_elements.business_name.element}</td></tr>
    		<tr><td>{$form_elements.business_address.caption}</td><td>{$form_elements.business_address.element}</td></tr>
    	</table>
    	<table class="fieldset">
    		<tr>
        		<td width="73">{$form_elements.city.caption}</td><td>{$form_elements.city.element}</td>
        		<td>{$form_elements.state.caption}</td><td>{$form_elements.state.element}</td>
        		<td>{$form_elements.zip.caption}</td><td>{$form_elements.zip.element}</td>
        	</tr>
        </table>
    	<table class="fieldset">
    		<tr><td>Your Name</td><td>{$form_elements.name.element}</td></tr>
    		<tr><td>{$form_elements.sales_agent_email.caption}</td><td>{$form_elements.sales_agent_email.element}</td></tr>
    		<tr><td>Your Position / Title</td><td>{$form_elements.position.element}</td></tr>
    		<tr><td>Your e-Mail Address</td><td>{$form_elements.email.element}</td></tr>
    		<tr><td width="200">{$form_elements.contact_name.caption}</td><td>{$form_elements.contact_name.element}</td></tr>
    		<tr><td>{$form_elements.billing_address.caption}</td><td>{$form_elements.billing_address.element}</td></tr>
    	</table>
    	<table class="fieldset">
    		<tr>
        		<td width="73">{$form_elements.billing_city.caption}</td><td>{$form_elements.billing_city.element}</td>
        		<td>{$form_elements.billing_state.caption}</td><td>{$form_elements.billing_state.element}</td>
        		<td>{$form_elements.billing_zip.caption}</td><td>{$form_elements.billing_zip.element}</td>
        	</tr>
        	<tr height="5px"><td></td></tr>
    	</table>
    	<table class="fieldset">
        	<tr>
        		<td>Accounts Payable Phone: {$form_elements.accounts_phone_area_code.caption}</td><td>{$form_elements.accounts_phone_area_code.element}</td>
        		<td>{$form_elements.accounts_phone.caption}</td><td>{$form_elements.accounts_phone.element}</td>
        	</tr>
        	<tr>
        		<td>Fax: {$form_elements.accounts_phone_area_code.caption}</td><td>{$form_elements.accounts_phone_area_code.element}</td>
        		<td>{$form_elements.accounts_phone.caption}</td><td>{$form_elements.accounts_phone.element}</td>
        		<td>{$form_elements.accounts_phone_ext.caption}</td><td>{$form_elements.accounts_phone_ext.element}</td>
        	</tr>
    	</table>
    	<table class="fieldset">
    		<tr><td>{$form_elements.logo.element}</td></tr>
    	</table>
    </fieldset>
	<br />
	<table cellspacing="5">
		<tr>
        	{foreach from=$form_actions item=action}
        		<td>{$action}</td>
        	{/foreach}
		</tr>
	</table>
	<br />
	<a href="{$GLOBALS.site_url}/set_password/?login={$login}" class="auth_small">Change password</a>
</form>

