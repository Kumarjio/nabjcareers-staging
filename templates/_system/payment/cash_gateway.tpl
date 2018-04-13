{assign var="username" value=$user.username}

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
Dear $username, <br /><br />
Please send us a payment in the amount of $amount for]] {$item_name|regex_replace:"/(Payment for)/":" "}<br />

[[Your transaction reference number is $payment_id. <br /><br />

Thank you!]]
{/foreach}
