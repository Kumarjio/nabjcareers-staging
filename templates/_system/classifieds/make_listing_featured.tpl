{foreach from=$errors item=message key=error}
	{if $error eq 'PAYMENT_IS_COMPLETED'}
		<p>[[Payment already has been processed]]</p>
	{elseif $error eq 'PAYMENT_IS_NOT_VERIFIED'}
		<p class="error">[[Payment is not verified]]</p>
	{elseif $error eq 'INVALID_PAYMENT_ID'}
		<p class="error">[[Invalid payment ID is specified]]</p>
	{elseif $error eq 'INVALID_LISTING_ID'}
		<p class="error">[[Invalid listing ID is specified]]</p>
	{elseif $error eq 'LISTING_ALREADY_FEATURED'}
		<p class="error">[[Listing is already featured]]</p>
	{elseif $error eq 'PARAMETERS_MISSED'}
		<p class="error">[[The system cannot proceed as some key parameters are missed]]</p>
	{/if}
{foreachelse}	
	<h1>[[Transaction Results]]</h1>
	<p>[[Transaction Approved]]</p>
	<p>[[Thank you for your payment.Your listing succesfully upgraded to featured on Nabjcareers.org]]</p>
	<input type='button' onclick="window.location.href='/my-account/'" value ='Click here to continue' class="button" id="confirm_activat_btn" />
{/foreach}