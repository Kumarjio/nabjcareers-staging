{subject}{$GLOBALS.user_site_url}: New Listing(s) Found For '{$saved_search.name}'{/subject}
{message}
	<p>{$user.username}</p>
	<p>New listing(s) appeared that match your saved search criteria. To view them, please follow the link(s) below:</p>
	{foreach from=$listings_id item=listing_id}
		{if $listing_id.listing_type_sid == 'Resume'}
			<p><a href="{$GLOBALS.user_site_url}/display-resume/{$listing_id.sid}/">{$listing_id.title}</a> posted {$listing_id.posted}</p>
		{else}
			<p><a href="{$GLOBALS.user_site_url}/display-job/{$listing_id.sid}/">{$listing_id.title}</a> posted {$listing_id.posted}</p>
		{/if}
	{/foreach}
	<p>{$GLOBALS.settings.site_title}</p>
{/message}