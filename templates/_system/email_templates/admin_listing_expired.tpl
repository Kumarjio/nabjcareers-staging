{subject}{$GLOBALS.user_site_url}: {$listing.type.id} #{$listing.id} Has Expired{/subject}
{message}
	<p>{$listing.type.id} #{$listing.id}, {$listing.Title} has just expired and was automatically deactivated.</p>
	<p>In the <a href="{$GLOBALS.user_site_url}/admin/manage-listings/">Manage Listings</a> section of the Admin Panel you can view the details of this listing and make further actions.</p>
	<p>To get this listing displayed there insert its ID: {$listing.id} to the "Listing ID" field of the Search Criteria form.</p>
	<p>{$GLOBALS.settings.site_title}</p>
{/message}