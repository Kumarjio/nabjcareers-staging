{foreach from=$errors item=error key=field_caption}
	{if $error eq 'EMPTY_VALUE'}
		<p class="error">'{$field_caption}' is empty</p>
	{elseif $error eq 'NOT_UNIQUE_VALUE'}
		<p class="error">'{$field_caption}' this value is already used in the system</p>
	{elseif $error eq 'NOT_CONFIRMED'}
		<p class="error">'{$field_caption}' not confirmed</p>
	{elseif $error eq 'DATA_LENGTH_IS_EXCEEDED'}
		<p class="error">'{$field_caption}' length is exceeded</p>
	{else}
		<p class="error">{$field_caption} {$error}</p>
	{/if}
{/foreach}