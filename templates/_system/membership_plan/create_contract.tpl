{foreach from=$errors item=message key=error}
{if $error eq 'PAYMENT_IS_NOT_VERIFIED'}
<p class="error">[[Payment is not verified]]</p>

{elseif $error eq 'INVALID_PAYMENT_ID'}
<p class="error">[[Invalid payment ID is specified]]</p>

{/if}

{foreachelse}

[[You have successfully subscribed for the membership plan]]

{/foreach}