<p><br /></p>
{if $errors}
<p>
[[The following errors occured]]:<br />
	<blockquote style='color:red'>
	{foreach from=$errors key=error item=error_data}
	{if $error == 'NOT_IMPLEMENTED'}[[There is something missing in the code]]<br />{/if}
	{if $error == 'PAYMENT_ID_IS_NOT_SET'}[[Callback parameters are missing required payment information.]]<br />{/if}
	{if $error == 'NONEXISTED_PAYMENT_ID_SPECIFIED'}[[System is unable to identify the payment processed.]]<br />{/if}
	{if $error == 'PAYMENT_IS_NOT_PENDING'}[[The payment that you are requesting to process has already been processed before.]]<br />{/if}
	{if $error == 'PAYMENT_STATUS_NOT_VERIFIED'}[[Payment is not verified]]<br />{/if}
	{/foreach}
	</blockquote>
</p>
{/if}
