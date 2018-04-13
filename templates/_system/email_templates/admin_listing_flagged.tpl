{subject}{$GLOBALS.user_site_url}: {$listing.type.id} #{$listing.id} was Flagged{/subject}
{message}
	<p>{$listing.type.id} #{$listing.id}, {$listing.Title} was Flagged.</p>
	<p>Go to <a href="{$GLOBALS.user_site_url}/admin/flagged-listings/">Flagged Listings</a> section of your Admin Panel to view the details.</p>
	<p>{$GLOBALS.settings.site_title}</p>
{/message}