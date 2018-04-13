{foreach from=$errors item=error}
	{if $error eq 'COOKIE_MAX_SIZE_EXCEEDED'}
		<p class="error">
		[[Maximum query storage capacity exceeded for you as an unregistered user. To save more searches, please login or register.]]
		</p>
	{elseif $error eq 'DENIED_SAVE_JOB_SEARCH'}
		<p class="error">
		[[You're not allowed to open this page]]
		</p>
	{elseif $error eq 'DENIED_VIEW_SAVED_LISTING'}
		<p class="error">
		[[You're not allowed to open this page]]
		</p>
	{/if}
{/foreach}
