{subject}{$GLOBALS.user_site_url}: New Posting Added{/subject}
{message}
	{if $listingTypeId == 'Resume'}
		<P>A new Resume, ID: <a href="{$GLOBALS.user_site_url}/display-resume/{$listing_sid}/">{$listing_sid}</a>, "<a href="{$GLOBALS.user_site_url}/display-resume/{$listing_sid}/">{$listingInfo.Title}</a>" was added</P>
	{else}
		<P>A new Job, ID: <a href="{$GLOBALS.user_site_url}/display-job/{$listing_sid}/">{$listing_sid}</a>, "<a href="{$GLOBALS.user_site_url}/display-job/{$listing_sid}/">{$listingInfo.Title}</a>" was added</P>
	{/if}<br /><br />
	To edit this {$listingTypeId} click <a href="{$GLOBALS.user_site_url}/admin/edit-listing/?listing_id={$listing_sid}">here</a><br /><br />
	<p>{$GLOBALS.settings.site_title}</p>
{/message}