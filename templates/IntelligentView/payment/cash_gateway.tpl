{assign var="username" value=$user.CompanyName}

{foreach from=$errors item=message key=error}
	<p class="error">
    	{if $error == 'INVALID_PAYMENT_ID'}
    		[[Invalid payment ID is specified]]
    	{else}
    		[[{$error}]]: [[{$message}]]
    	{/if}
	</p>
{foreachelse}
[[
Dear {$username}, <br /><br />
Please send us a payment in the amount of {$GLOBALS.settings.transaction_currency} {$amount} for]] {$item_name|regex_replace:"/(Payment for)/":" "}<br />

[[Your transaction reference number is $payment_id. <br /><br />

Thank you!]]
{/foreach}


<p><iframe width="720" height="300" src="{$GLOBALS.site_url}/print-invoice/?payment_id={$payment_id}&send_email=1"></iframe></p>

<p><span class="buttonsinvoice"><a class="abuttonsinvoice" href="{$GLOBALS.site_url}/my-account/">My account</a></span></p>
{if $plan_id == 33 || $plan_id == 37 || $plan_id == 39 || $plan_id == 40 }
</p><span class="buttonsinvoice"><a class="abuttonsinvoice" href="{$GLOBALS.site_url}/search-resumes/">Search resumes</a></span></p>
{/if}
