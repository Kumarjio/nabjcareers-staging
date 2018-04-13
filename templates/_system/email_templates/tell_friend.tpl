{subject}{$GLOBALS.user_site_url}: {$submitted_data.name} Recommends You {$listing.type.id} #{$listing.id}{/subject}
{message}
	<p>Dear {$submitted_data.friend_name},</p>
	<p>You've got a message from {$submitted_data.name} regarding {$listing.type.id} #{$listing.id}, {$listing.Title}.</p>
	<p><strong>Message text</strong>: {$submitted_data.comment}</p>
	<p>To view the recommended {$listing.type.id} follow the link below:</p>
	<p>
		{if $listing.type.id == 'Job'}
			<a href="{$GLOBALS.user_site_url}/display-job/{$listing.id}/">{$GLOBALS.user_site_url}/display-job/{$listing.id}/</a>
		{else}
			<a href="{$GLOBALS.user_site_url}/display-resume/{$listing.id}/">{$GLOBALS.user_site_url}/display-resume/{$listing.id}/</a>
		{/if}
	</p>
	<p>Thank you!</p>
	<p>{$GLOBALS.settings.site_title}</p>
{/message}  