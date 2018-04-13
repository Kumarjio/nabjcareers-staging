{foreach from=$errors item=error key=field_caption}
	{if $error eq 'EMPTY_VALUE'}
		<p class="error">'[[FormFieldCaptions!{$field_caption}]]' [[is empty]]</p>
	{elseif $error eq 'NOT_UNIQUE_VALUE'}
		<p class="error">'{$field_caption}' this value is already used in the system</p>
	{elseif $error eq 'NOT_CONFIRMED'}
		<p class="error">'{$field_caption}' not confirmed</p>
	{elseif $error eq 'DATA_LENGTH_IS_EXCEEDED'}
		<p class="error">'{$field_caption}' length is exceeded</p>
	{elseif $error eq 'NOT_INT_VALUE'}
		<p class="error">'{$field_caption}' is not an integer value</p>
	{elseif $error eq 'OUT_OF_RANGE'}
		<p class="error">'{$field_caption}' value is out of range</p>
	{elseif $error eq 'NOT_FLOAT_VALUE'}
		<p class="error">'{$field_caption}' is not an float value</p>
	{elseif $error eq 'LOCATION_NOT_EXISTS'}
		<p class="error">'[[FormFieldCaptions!{$field_caption}]]' [[is unknown]]</p>
	{elseif $error eq 'NOT_VALID_ID_VALUE'}
		<p class="error">'{$field_caption}' is not valid</p>
	{elseif $error eq 'NOT_SUPPORTED_VIDEO_FORMAT'}
		<p class="error">'{$field_caption}' this file is not in a supported video file format</p>
	{elseif $error eq 'MAX_FILE_SIZE_EXCEEDED'}
		<p class="error">'{$field_caption}' filesize exceeds the quota</p>
	{else}
		{$error}
	{/if}
{/foreach}