{if $listing.id && $value.saved_file_name}
	<a href="?filename={$value.saved_file_name}&amp;listing_id={$listing.id}">{$value.file_name}</a>
{else}
	<a href="{$value.file_url}">{$value.file_name}</a>
{/if}