{foreach from=$errors key=error item=errmess}
	<p class="error">
		{if $error eq 'NO_SUCH_USER'}
			[[Login error]]
		{elseif $error eq 'INVALID_PASSWORD'}
			[[Login error]]
		{elseif $error eq 'USER_NOT_ACTIVE'}
			[[Your account is not active]]
		{elseif $error eq 'BANNED_USER'}
			[[Your IP address was banned by site administrator. Please contact at $adminEmail for any questions.]]
		{else}
			[[$error]] [[$errmess]]
		{/if}
	</p>
{/foreach}