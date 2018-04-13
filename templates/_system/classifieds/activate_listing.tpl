{foreach from=$errors item=message key=error}
	{if $error eq 'PAYMENT_IS_NOT_VERIFIED'}
		<p class="error">[[Payment is not verified]]</p>
	{elseif $error eq 'INVALID_PAYMENT_ID'}
		<p class="error">[[Invalid payment ID is specified]]</p>
	{elseif $error eq 'PAYMENT_IS_COMPLETED'}
		<p>[[Payment already has been processed]]</p>
	{/if}
{foreachelse}	
	<h1>[[Transaction Results]]</h1>
	<p>[[Transaction Approved]]</p>
	<p>[[Thank you for your payment. Your job(s) is now active on Nabjcareers.org]]</p>
	<input type="button" id="confirm_activat_btn" class = "button" value="Click here to continue" onclick="window.location.href='/my-account/'" />
{/foreach}