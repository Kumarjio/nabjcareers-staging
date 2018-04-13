{foreach from=$errors item=message key=error}
	{if $error eq 'PAYMENT_IS_NOT_VERIFIED'}	
		<p class="error">[[Payment is not verified]]</p>
	{elseif $error eq 'INVALID_PAYMENT_ID'}	
		<p class="error">[[Invalid payment ID is specified]]</p>
	{/if}
{foreachelse}

<h1>[[Transaction Results]]</h1>

<p>[[Transaction Approved]]</p>

{if $membership_plan_id == 33 || $membership_plan_id == 37}
	<p>[[Thank you for your payment. You have successfully purchased access to the resume database.]]</p>
	<input type="button" id="confirm_activat_btn" class = "button" value="Click here to search resumes" onclick="window.location.href='/search-resumes/'" />
{else}
	<p>[[Thank you for your payment. You have now successfully subscribed for the membership plan]]</p>

	<input type="button" id="confirm_activat_btn" class = "button" value="Click here to continue" onclick="window.location.href='/my-account/'" />
{/if}

{/foreach}