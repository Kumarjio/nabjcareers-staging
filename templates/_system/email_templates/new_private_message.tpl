{subject}{$GLOBALS.user_site_url}: New Private Message Received{/subject}
{message}
	<p>Dear {$user.username},</p>
	<p><strong>{$sender.FirstName} {$sender.LastName}</strong> has sent you a private message.</p>
	<p><strong>Date:</strong> {$message.data}</p>
	<p><strong>Subject:</strong> {$message.subject}</p>
	<hr size="1">
	<p>{$message.message}</p>
	<p><a href="{$GLOBALS.user_site_url}/private-messages/reply/?id={$message.id}">Reply to this message</a></p>
	<hr size="1"/>
	<p>To cancel receiving notifications of this kind you need to <a href="{$GLOBALS.user_site_url}/login/">log in to the site</a> under your account, go to My Notifications and disable the respective option there.</p>
	<p>{$GLOBALS.settings.site_title}</p>
{/message}