{foreach from=$errors item=error key=field_caption}
	<p class="error">
		{if $error eq 'EMPTY_VALUE'}
			'[[FormFieldCaptions!{$field_caption}]]' [[is empty]]
		{elseif $error eq 'NOT_UNIQUE_VALUE'}
			'{$field_caption}' [[this value is already used in the system]]
		{elseif $error eq 'NOT_CONFIRMED'}
			'{$field_caption}' [[not confirmed]]
		{elseif $error eq 'DATA_LENGTH_IS_EXCEEDED'}
			'{$field_caption}' [[length is exceeded]]
		{elseif $error eq 'NOT_INT_VALUE'}
			'{$field_caption}' [[is not an integer value]]
		{elseif $error eq 'OUT_OF_RANGE'}
			'{$field_caption}' [[value is out of range]]
		{elseif $error eq 'NOT_FLOAT_VALUE'}
			'{$field_caption}' [[is not an float value]]
		{elseif $error eq 'LOCATION_NOT_EXISTS'}
			'[[FormFieldCaptions!{$field_caption}]]' [[is unknown]]
		{elseif $error eq 'NOT_VALID_ID_VALUE'}
			'{$field_caption}' [[is not valid]]
		{elseif $error eq 'NOT_SUPPORTED_IMAGE_FORMAT'}
			'{$field_caption}' [[image format is not supported]]
		{elseif $error eq 'NOT_VALID_EMAIL_FORMAT'}
			[[Email format is not valid]]
		{elseif $error eq 'HAS_BAD_WORDS'}
			'{$field_caption}' [[has bad words]]
		{else}
			[[{$error}]]
		{/if}
	</p>
{/foreach}