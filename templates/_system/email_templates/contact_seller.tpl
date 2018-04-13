{subject}{$GLOBALS.user_site_url}: Request For Info on listing {$listing.id}{/subject}
{message}
	You've got a request regarding your listing #{$listing.id} from the following user:<br />
	Name: {$seller_request.name}<br />
	Email: {$seller_request.email}<br />
	Comments: {$seller_request.request}<br/>
	<p>{$GLOBALS.settings.site_title}</p>
{/message}