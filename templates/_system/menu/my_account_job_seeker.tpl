<div class="MyAccount">
	<div class="MyAccountHead"><h1>[[My Account]]</h1></div>

	<!-- LEFT COLUMN MY ACCOUNT -->
	<div class="leftColumnMA">
		<ul>
			<li><img src="{image}account/myresumes_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/my-listings/">[[My Resumes]]</a></li>
			<li><img src="{image}account/applications_track_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/system/applications/view/">[[My Applications]]</a></li>
			{if $acl->isAllowed('save_job')}<li><img src="{image}account/saved_listings_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/saved-jobs/">[[Saved Jobs]]</a></li>{/if}
			{if $acl->isAllowed('use_job_alerts')}<li><img src="{image}account/resume_alerts_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/job-alerts/">[[Job Alerts]]</a></li>{/if}
			{if $acl->isAllowed('save_searches')}<li><img src="{image}account/save_ico.png"  alt=""/> <a href="{$GLOBALS.site_url}/saved-searches/">[[Saved Searches]]</a></li>{/if}
		</ul>
	</div>
	<!-- END LEFT COLUMN MY ACCOUNT -->

	<!-- RIGHT COLUMN MY ACCOUNT -->
	<div class="rightColumnMA">
		<ul>
			<li><img src="{image}account/myprofile_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/edit-profile/">[[My Profile]]</a></li>
			<li><img src="{image}account/notifications_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/user-notifications/">[[My Notifications]]</a></li>
			<li><img src="{image}account/subscription_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/subscription/">[[Subscriptions]]</a></li>
			<li><img src="{image}account/billing_hist_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/payments/">[[Billing History]]</a></li>
			{if $acl->isAllowed('use_private_messages')}
				<li><img src="{image}account/message_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/private-messages/inbox/">[[Private messages]]</a>
				<div class="PMMenu">
				&#187; <a href="{$GLOBALS.site_url}/private-messages/inbox/">[[Inbox]] ({$GLOBALS.current_user.new_messages})</a><br>
				&#187; <a href="{$GLOBALS.site_url}/private-messages/outbox/">[[Outbox]]</a>
				</div></li>
			{/if}
		</ul>
	</div>
	<!-- END RIGHT COLUMN MY ACCOUNT -->
	
</div>
<div class="MyAccountFoot"> </div>
<div id="adSpaceAccount">{module name="static_content" function="show_static_content" pageid="AccountJsAdSpace"}</div>