{foreach from=$errors item=error key=field_caption}
	{if $error eq 'INVALID_PERIOD_FROM'}
		<p class="error">Period From is not valid</p>
	{/if}
	{if $error eq 'INVALID_PERIOD_TO'}
		<p class="error">Period To is not valid</p>
	{/if}
	{if $error eq 'INVALID_AMOUNT'}
		<p class="error">Please input correct amount</p>
	{/if}
{/foreach}