{foreach from=$errors item=error key=error_code}
	<p class="error">
     {if $error_code == 'card_num'}
            	[[Enter Card Number]]
     {elseif $error_code == 'exp_date'}
    		 [[Please enter Expiry Date]]
    	{elseif $error_code == 'card_code'}
    		 [[Please Enter CCV Number]]
    	{/if}
	</p>
{/foreach}
{*
		<form action="https://secure.quantumgateway.com/cgi/qgwdbe.php" method="post" class="quantum_form">		
			<input name="gwlogin" type="hidden" value="nabjca1114"> 
			<input name="post_return_url_approved" type="hidden" value="{$GLOBALS.site_url}/quantum_approved/?payment_sid={$payment_id}">
			<input name="post_return_url_declined" type="hidden" value="{$GLOBALS.site_url}/quantum_declined/?payment_sid={$payment_id}">
			<input name="amount" type="hidden" value="{$payment_amount}">
			<br /><br />
			<p><span class="quantum_field_label">[[Billing Address:]]</span><span class="quantum_field"> <input name="BADDR1" type="text" value="{$GLOBALS.current_user.billingAddress}"></span></p><br /><br />
			<p><span class="quantum_field_label">[[Billing Zip Code:]]</span><span class="quantum_field"> <input name="BZIP1" type="text" value="{$GLOBALS.current_user.billingZip}"></span></p><br /><br />
			<p><span class="quantum_field_label">[[Billing City:]]</span><span class="quantum_field"> <input name="BCITY" type="text" value="{$GLOBALS.current_user.billingCity}"></span></p><br /><br />

			<br /><p><span class="quantum_field_label">[[Card Number:]]</span><span class="quantum_field"><input name="ccnum" type="text" /></span>&nbsp;<span class="quantum_field">(enter number without spaces or dashes)</span></p><br /><br />			
			<p><span class="quantum_field_label">[[Card Expiration month:]]</span><span class="quantum_field"><input name="ccmo" type="text" /></span>&nbsp;<span class="quantum_field">(mm)</span></p><br /><br />
			<p><span class="quantum_field_label">[[Card Expiration year:]]</span><span class="quantum_field"><input name="ccyr" type="text" /></span>&nbsp;<span class="quantum_field">(yy)</span></p><br /><br />
			<p><span class="quantum_field_label">[[CVV2:]]</span><span class="quantum_field"><input name="CVV2" type="text" /></span>&nbsp;<span class="quantum_field">(enter number without spaces or dashes)</span></p><br /><br />
			<br/><input type='submit' value ='Submit payment' class="paymentButton gatewayLabel" />
		</form>
*}