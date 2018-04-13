{if is_array($filesInfo)}
	{if $listing.id && $filesInfo.$complexStep.saved_file_name}
		<a href="?filename={$filesInfo.$complexStep.saved_file_name}&amp;listing_id={$listing.id}">{$filesInfo.$complexStep.file_name}</a>
	{else}
		<a href="{$filesInfo.$complexStep.file_url}">{$filesInfo.$complexStep.file_name}</a>
	{/if}
{else}
	{if $listing.id && $value.saved_file_name}
		<a href="?filename={$value.saved_file_name}&amp;listing_id={$listing.id}">{$value.file_name}</a>
	{else}
		<a href="{$value.file_url}">{$value.file_name}</a>
	{/if}
{/if}
