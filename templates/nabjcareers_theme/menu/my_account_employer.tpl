<div class="MyAccount">
	<div class="MyAccountHead"><h1>[[My Account]]</h1></div>
	
	<!-- LEFT COLUMN MY ACCOUNT -->
	<div class="leftColumnMA">
		<ul>
			{if $GLOBALS.current_user.subuser}
				{if $acl->isAllowed('subuser_add_listings', $GLOBALS.current_user.subuser.sid) || $acl->isAllowed('subuser_manage_listings', $GLOBALS.current_user.subuser.sid)}
					<li><img src="{image}account/myresumes_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/my-listings/">[[My Jobs]]</a></li>
					<li><img src="{image}account/applications_track_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/system/applications/view/">[[Application Tracking]]</a></li>
				{/if}
			{else}
						
			<li><img src="{image}account/postjobs.png" alt="" /> <a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Job" >[[Post Jobs]]</a></li>
						
			<li><img src="{image}account/myresumes_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/my-listings/">[[My Jobs]]</a></li>
			<li><img src="{image}account/applications_track_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/system/applications/view/">[[Application Tracking]]</a></li>
			{/if}
			
			{if $acl->isAllowed('save_resume')}
				<li><img src="{image}account/saved_listings_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/saved-resumes/">[[Saved Resumes]]</a></li>
			{/if}
			{if $acl->isAllowed('use_resume_alerts')}
				<li><img src="{image}account/resume_alerts_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/resume-alerts/">[[Resume Alerts]]</a></li>
			{/if}
			{if $acl->isAllowed('save_searches')}
				<li><img src="{image}account/save_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/saved-searches/">[[Saved Searches]]</a></li>
			{/if}
			{if $acl->isAllowed('use_screening_questionnaires') && !$GLOBALS.current_user.subuser}
				<li><img src="{image}account/questionnaires.png" alt=""/> <a href="{$GLOBALS.site_url}/screening-questionnaires/">[[Screening Questionnaires]]</a></li>
			{/if}
			
			{* if false}
			<li><img src="{image}account/myresumes_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/search-resumes/">[[Resume Database Access]]</a></li>
			{/if}
			{if $GLOBALS.current_user. NO ACCESS}
				<p> Search and view résumés from media candidates here. You can search by keywords or categories to find qualified candidates to for your open positions</p>
			{else HAVE ACCESS}
				<p>Your access to the resume database will end on 
					!!!1!!Jan xx, 2013 !!!!
				</p>
			{/if *}
		</ul>
	</div>
	<!-- END LEFT COLUMN MY ACCOUNT -->

	<!-- RIGHT COLUMN MY ACCOUNT -->
	<div class="rightColumnMA">
		<ul>


			<li><img src="{image}account/searchResumes.png" alt="" /> <a href="{$GLOBALS.site_url}/search-resumes/">[[Search Resumes]]</a></li>
			{assign var="maxDate" value="2013-12-01"}
			{foreach from=$contractsInfo item=contractInfo}
					{if $contractInfo.membership_plan_id == 33 || $contractInfo.membership_plan_id == 37 || $contractInfo.membership_plan_id == 40}
						{if ($contractInfo.expired_date > $maxDate) }
							{assign var="maxDate" value=$contractInfo.expired_date}
						{else if ($maxDate == '0' && $maxDate == '') }
							{assign var="maxDate" value="2033-12-01"}
						{/if}
					{/if}			
			{/foreach}
		
			{if $maxDate != '2013-12-01' }
				<p style="font-size: 10px; text-align: right;">				
					{if $maxDate == '2033-12-01'} 
						Your access to the resume database will <strong>[[never expire]]</strong> 
					{else} 
						Your access to the resume database will end on <strong>{$maxDate}</strong>
					{/if}
				</p>
			{/if}


			<li><img src="{image}account/myprofile_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/edit-profile/">[[My Profile]]</a></li>
			{if $acl->isAllowed('create_sub_accounts') && !$GLOBALS.current_user.subuser}
				<li><img src="{image}account/subaccounts.png" alt=""/> <a href="{$GLOBALS.site_url}/sub-accounts/">[[Sub Accounts]]</a></li>
			{/if}
			{if !$GLOBALS.current_user.subuser}
				<li><img src="{image}account/notifications_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/user-notifications/">[[My Notifications]]</a></li>
			{/if}
			
			{* REMOVE!!! *}
			{if $GLOBALS.current_user.subuser}
				{if $acl->isAllowed('subuser_manage_subscription', $GLOBALS.current_user.subuser.sid)}
					{if $GLOBALS.current_user.group.id != "Employer"}<li><img src="{image}account/subscription_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/subscription/">[[Subscriptions]]</a></li>{/if}
				{/if}
			{else}
				{if $GLOBALS.current_user.group.id != "Employer"}<li><img src="{image}account/subscription_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/subscription/">[[Subscriptions]]</a></li>{/if}
			{/if}
			{* REMOVE!!! *}
			
			<li><img src="{image}account/billing_hist_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/payments/">[[Billing History]]</a></li>
			{if $acl->isAllowed('use_private_messages')}
	   			<li><img src="{image}account/message_ico.png" alt=""/> <a href="{$GLOBALS.site_url}/private-messages/inbox/">[[Private messages]]</a>
	   			<div class="PMMenu">
	   			&#187; <a href="{$GLOBALS.site_url}/private-messages/inbox/">[[Inbox]] ({$GLOBALS.current_user.new_messages})</a><br/>
	   			&#187; <a href="{$GLOBALS.site_url}/private-messages/outbox/">[[Outbox]]</a>
	   			</div>
	   			</li>
			{/if}
		</ul>
	</div>
	<!-- END RIGHT COLUMN MY ACCOUNT -->
	
</div>
<div class="MyAccountFoot"> </div>
<div id="adSpaceAccount">{module name="static_content" function="show_static_content" pageid="AccountEmpAdSpace"}</div>