<ul>
	<li><a href="{$GLOBALS.site_url}/my-listings">[[My Resumes]]</a></li>
	<li><a href="{$GLOBALS.site_url}/system/applications/view/">[[My Applications]]</a></li>
	{if $acl->isAllowed('save_job')}<li><a href="{$GLOBALS.site_url}/saved-jobs">[[Saved Jobs]]</a></li>{/if}
	{if $acl->isAllowed('use_job_alerts')}<li><a href="{$GLOBALS.site_url}/job-alerts">[[Job Alerts]]</a></li>{/if}
	{if $acl->isAllowed('save_searches')}<li><a href="{$GLOBALS.site_url}/saved-searches">[[Saved Searches]]</a></li>{/if}
	<li><a href="{$GLOBALS.site_url}/edit-profile">[[My Profile]]</a></li>
	<li><a href="{$GLOBALS.site_url}/system/users/user_notifications/">[[My Notifications]]</a></li>
	<li><a href="{$GLOBALS.site_url}/system/membership_plan/subscription_page">[[Subscriptions]]</a></li>
	<li><a href="{$GLOBALS.site_url}/payments/">[[Billing History]]</a></li>
	{if $acl->isAllowed('use_private_messages')}
		<li><a href="{$GLOBALS.site_url}/private-messages/inbox/">[[Private messages]]</a></li>
		<li><a href="{$GLOBALS.site_url}/private-messages/inbox/">[[Inbox]] ({$GLOBALS.current_user.new_messages})</a></li>
		<li><a href="{$GLOBALS.site_url}/private-messages/outbox/">[[Outbox]]</a></li>
	{/if}
</ul>