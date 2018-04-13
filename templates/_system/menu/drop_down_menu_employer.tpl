<ul>
	{if $GLOBALS.current_user.subuser}
		{if $acl->isAllowed('subuser_add_listings', $GLOBALS.current_user.subuser.sid) || $acl->isAllowed('subuser_manage_listings', $GLOBALS.current_user.subuser.sid)}
			<li><a href="{$GLOBALS.site_url}/my-listings/">[[My Jobs]]</a></li>
			<li><a href="{$GLOBALS.site_url}/system/applications/view/">[[Application Tracking]]</a></li>
		{/if}
	{else}
		<li><a href="{$GLOBALS.site_url}/my-listings/">[[My Jobs]]</a></li>
		<li><a href="{$GLOBALS.site_url}/system/applications/view/">[[Application Tracking]]</a></li>
	{/if}

	{if $acl->isAllowed('save_resume')}
		<li><a href="{$GLOBALS.site_url}/saved-resumes/">[[Saved Resumes]]</a></li>
	{/if}
	{if $acl->isAllowed('use_resume_alerts')}
		<li><a href="{$GLOBALS.site_url}/resume-alerts/">[[Resume Alerts]]</a></li>
	{/if}
	{if $acl->isAllowed('save_searches')}
		<li><a href="{$GLOBALS.site_url}/saved-searches/">[[Saved Searches]]</a></li>
	{/if}
	{if $acl->isAllowed('use_screening_questionnaires') && !$GLOBALS.current_user.subuser}
		<li><a href="{$GLOBALS.site_url}/screening-questionnaires/">[[Screening Questionnaires]]</a></li>
	{/if}
	<li><a href="{$GLOBALS.site_url}/edit-profile/">[[My Profile]]</a></li>
	{if $acl->isAllowed('create_sub_accounts') && !$GLOBALS.current_user.subuser}
		<li><a href="{$GLOBALS.site_url}/sub-accounts/">[[Sub Accounts]]</a></li>
	{/if}
	{if !$GLOBALS.current_user.subuser}
		<li><a href="{$GLOBALS.site_url}/system/users/user_notifications/">[[My Notifications]]</a></li>
	{/if}
	{if $GLOBALS.current_user.subuser}
		{if $acl->isAllowed('subuser_manage_subscription', $GLOBALS.current_user.subuser.sid)}
			<li><a href="{$GLOBALS.site_url}/system/membership_plan/subscription_page/">[[Subscriptions]]</a></li>
		{/if}
	{else}
		<li><a href="{$GLOBALS.site_url}/system/membership_plan/subscription_page/">[[Subscriptions]]</a></li>
	{/if}
	<li><a href="{$GLOBALS.site_url}/payments/">[[Billing History]]</a></li>
	{if $acl->isAllowed('use_private_messages')}
		<li><a href="{$GLOBALS.site_url}/private-messages/inbox/">[[Private messages]]</a></li>
		<li><a href="{$GLOBALS.site_url}/private-messages/inbox/">[[Inbox]] ({$GLOBALS.current_user.new_messages})</a></li>
		<li><a href="{$GLOBALS.site_url}/private-messages/outbox/">[[Outbox]]</a></li>
	{/if}
</ul>