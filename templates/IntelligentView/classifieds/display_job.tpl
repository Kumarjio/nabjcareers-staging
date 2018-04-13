<div id="displayListing">
	{title} {$listing.Title} {/title}
	{keywords} {$listing.Title} {/keywords}
	{description} {$listing.Title} {/description}
	{if $errors}
	    {foreach from=$errors key=error_code item=error_message}
			<p class="error">
				{if $error_code == 'UNDEFINED_LISTING_ID'} [[Listing ID is not defined]]
					{if $GLOBALS.settings.exp_listings_404_page}
						{title} [[404 Not Found]] {/title}
					{/if}
				{elseif $error_code == 'WRONG_LISTING_ID_SPECIFIED'} [[There is no listing in the system with the specified ID]]
					{if $GLOBALS.settings.exp_listings_404_page}
						{title} [[404 Not Found]] {/title}
					{/if}
				{elseif $error_code == 'LISTING_IS_NOT_ACTIVE'} [[This Job is no longer available]]
					{if $GLOBALS.settings.exp_listings_404_page}
						{title} [[404 Not Found]] {/title}
					{/if}
				{elseif $error_code == 'NOT_OWNER'} [[You're not the owner of this posting]]
				{elseif $error_code == 'LISTING_IS_NOT_APPROVED'} [[Listing with specified ID is not approved by admin]]
					{if $GLOBALS.settings.exp_listings_404_page}
						{title} [[404 Not Found]] {/title}
					{/if}
				{elseif $error_code == 'WRONG_DISPLAY_TEMPLATE'} [[Wrong template to display listing]]
				{/if}
			</p>
		{/foreach}
	{else}
		<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
		<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.bgiframe.js"></script>
		<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.form.js"></script>
		{literal}
		<script type="text/javascript"><!---
		$.ui.dialog.defaults.bgiframe = true;
		function popUpWindow(url, widthWin, heightWin, title, parentReload, userLoggedIn){
			reloadPage = false;
			$("#messageBox").dialog( 'destroy' ).html({/literal}'{capture name="displayJobProgressBar"}<img style="vertical-align: middle;" src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" /> [[Please, wait ...]]{/capture}{$smarty.capture.displayJobProgressBar|escape:'quotes'}'{literal});
			$("#messageBox").dialog({
				width: widthWin,
				height: heightWin,
				modal: true,
				title: title,
				close: function(event, ui) {
					if (parentReload == true && !userLoggedIn && reloadPage == true) {
						parent.document.location.reload();
					}
				}
			}).dialog( 'open' );
	
			$.get(url, function(data){
				$("#messageBox").html(data);
			});
	
			return false;
		}
		function windowMessage() {
			$("#messageBox").dialog( 'destroy' ).html('You already applied');
			$("#messageBox").dialog({
				bgiframe: true,
				modal: true,
				title: 'Error',
				buttons: {
					Ok: function() {
						$(this).dialog('close');
					}
				}
			});
		}
	
	
		{/literal}
		var link = "{$GLOBALS.site_url}/flag-listing/";
		{literal}
	
		// send flagForm and show result
		function sendFlagForm() {
	
			$("#flagForm").ajaxSubmit({
				url: link,
				success: function(response, status) {
					$("#messageBox").html(response);
				}
			});
	
			return false;
		}
	
		--></script>
		{/literal}
	
	<div class="results">
		<div id="topResults">
			<!-- SAVE LISTING / PRINT LISTING -->
			<div class="searchResultsHeaderLineNew">
				<ul>
					{if $GLOBALS.user_page_uri != "/my-job-details"}
						<li class="panelSavedIco"><a href="{$GLOBALS.site_url}/saved-ads/?listing_id={$listing.id}" onclick="popUpWindow('{$GLOBALS.site_url}/saved-ads/?listing_id={$listing.id}&displayForm=1', 350, 300, '[[Save this Job]]', true, {if $GLOBALS.current_user.logged_in}true{else}false{/if}); return false;"  class="action">[[Save this Job]]</a></li>
						<li class="panelViewDitailsIco">
							{if $GLOBALS.current_user.logged_in}
								<a href="{$GLOBALS.site_url}/saved-jobs" class="action">[[View Saved Jobs]]</a>
							{else}
								<a onclick="popUpWindow('{$GLOBALS.site_url}/saved-listings/?listing_type_id=job', 350, 300, 'Saved jobs'); return false;" href="{$GLOBALS.site_url}/saved-listings">[[View Saved Jobs]]</a>
							{/if}
						</li>
					{/if}
					<li class="printListingIco"><a href="{$GLOBALS.site_url}/tell-friends/?listing_id={$listing.id}" onclick="popUpWindow('{$GLOBALS.site_url}/tell-friends/?listing_id={$listing.id}', 400, 470, '[[Tell a Friend]]'); return false;" id="message_link">[[Tell a Friend]]</a></li>
					{if $acl->isAllowed('flag_job')}
						<li class="printListingIco"><a href="{$GLOBALS.site_url}/flag-listing/?listing_id={$listing.id}" onclick="popUpWindow('{$GLOBALS.site_url}/flag-listing/?listing_id={$listing.id}', 400, 350, '[[Flag Job]]'); return false;" id="message_link">[[Flag This Job]]</a></li>
					{/if}
					<li class="printListingIco"><a target="_blank" href="{$GLOBALS.site_url}/print-listing/?listing_id={$listing.id}">[[Print This Ad]]</a></li>
					<li class="viewMapIco"><a target="_blank" href="http://www.maps.google.com/?q={$listing.City}+{$listing.State}+{$listing.ZipCode}">[[View Map]]</a></li>
				</ul>
			</div>
			<!-- END SAVE LISTING / PRINT LISTING -->
		
			<!-- MODIFY RESULTS / RATING / COMMENTS / PAGGING -->
			<div class="clr"></div>
			<div class="underQuickLinks">
				<div class="ModResults">&nbsp;
					{if $searchId != "" && $GLOBALS.user_page_uri != "/my-job-details"}
						<ul>
							<li class="arrow"><a href="{$GLOBALS.site_url}{$search_uri}?action=search&amp;searchId={$searchId}&amp;page={$page}#listing_{$listing.id}">[[Back to Results]]</a></li>
							<li class="modifySearchIco"><a href="{$GLOBALS.site_url}/find-jobs/?searchId={$searchId}">[[Modify Search]]</a></li>
						</ul>
					{/if}
				</div>
				<div class="Rating">&nbsp;
					{if $show_rates !=0 && $acl->isAllowed('add_job_ratings')}
						<ul>
							<li class="ratingPanel"><p style="float:left; margin-top: 0px; padding: 0px;">[[Rate This Job]]: {include file="rating.tpl" listing=$listing}</p></li>
						</ul>
					{/if}
				</div>
				<div class="Comments">&nbsp;
					{if $show_comments != 0 && $acl->isAllowed('add_resume_comments')}
						<ul><li class="comments"><a href="#comment_1">[[Comments]] (+{$listing.comments_num})</a></li></ul>
					{/if}
				</div>
				<div class="Pagging">&nbsp;
					{if $searchId != "" || $GLOBALS.user_page_uri == "/my-job-details"}
						<ul>
							<li class="pagging">
								<img src="{image}prev_btn.png"  style="margin-right:2px;" alt="[[Previous]]"  border="0" />
								{if $prev_next_ids.prev}
									<a href="{$GLOBALS.site_url}/{if $GLOBALS.user_page_uri == "/my-job-details"}my-job-details{else}display-job{/if}/{$prev_next_ids.prev}/?searchId={$searchId}&amp;page={$page}">[[Previous]]</a> &nbsp;
								{else}
									{if !$prev_next_ids.prev && !$prev_next_ids.next}{else}[[Previous]] &nbsp;{/if}
								{/if}
								{if $prev_next_ids.next}
									<a href="{$GLOBALS.site_url}/{if $GLOBALS.user_page_uri == "/my-job-details"}my-job-details{else}display-job{/if}/{$prev_next_ids.next}/?searchId={$searchId}&amp;page={$page}">[[Next]]</a>
								{else}
									{if !$prev_next_ids.prev && !$prev_next_ids.next}{else}[[Next]]{/if}
								{/if}
								<img src="{image}next_btn.png"  style="margin-left:2px;" alt="[[Next]]"  border="0"/>
							</li>
						</ul>
					{/if}
				</div>
			</div>
			<!-- END MODIFY RESULTS / RATING / COMMENTS / PAGGING -->
		</div>
	</div>
	
	<div id="refineResults">
		<!--- PROFILE BLOCK --->
		<div class="userInfo">
			<div id="blockTop"></div>
			<div class="compProfileTitle">[[Company Info]]</div>
			<div class="compProfileInfo">
				{if $listing.anonymous != 1 || $applications.anonymous === 0 }
					{if $listing.user.Logo.file_url}
						<center><img src="{$listing.user.Logo.file_url}" alt="" /></center><br/>
					{/if}
					{* Check for JobG8 listings property *}
					<strong>
{if $listing.company_name}{$listing.company_name}{else}{$listing.CompanyName}{/if}
</strong>
					<br />{$listing.user.Address}
					<br />{if $listing.user.City}{$listing.user.City}, {/if}[[$listing.user.State]] {if $listing.user.Country}([[$listing.user.Country]]){/if}
					<br/><br/>
					
					{* Check for JobG8 listings property to post link to company profile *}
					{if $listing.company_name}
						<a href="{$GLOBALS.site_url}/search-results-jobs/?action=search&amp;username[equal]={$listing.user.id}&company_name[equal]={$listing.company_name}">[[Company Profile]]</a>
					{else}
						<strong>[[FormFieldCaptions!Phone]]</strong>: {$listing.user.PhoneNumber}<br/>
						<strong>[[FormFieldCaptions!Web]]</strong>: <a href="{if strpos($listing.user.WebSite, 'http://') === false}http://{/if}{$listing.user.WebSite}" target="_blank">{$listing.user.WebSite}</a><br/><br/>
						{if strpos($listing.user.CompanyName, '-') !== false}
							<a href="{$GLOBALS.site_url}/search-results-jobs/?action=search&amp;username[equal]={$listing.user.id}">[[Company Profile]]</a><br/>
						{else}
							<a href="{$GLOBALS.site_url}/company/{$listing.user.CompanyName|replace:" ":"-"|escape:"url"}">[[Company Profile]]</a><br/>
						{/if}
					{/if}
	
					{if !$listing.company_name}
						<a href="{$GLOBALS.site_url}/private-messages/send/?to={$listing.user.id}{if $listing.subuser}&amp;cc={$listing.subuser.id}{/if}" onclick="popUpWindow('{$GLOBALS.site_url}/private-messages/aj-send/?to={$listing.user.id}&ajaxRelocate=1{if $listing.subuser}&cc={$listing.subuser.id}{/if}', 560, 400, '[[Send Private Message]]', true, {if $GLOBALS.current_user.logged_in}true{else}false{/if}); return false;"  class="pm_send_link">[[Send Private Message]]</a>
					{/if}
				{else}
					<center><strong>[[Anonymous User Info]]</strong></center>
				{/if}
				<br/>
				{* LINKEDIN: COMPANY INSIDER WIDGET *}
				{module name="social" function="company_insider_widget" companyName=$listing.user.CompanyName}
				{* end of : LINKEDIN: COMPANY INSIDER WIDGET *}
				{foreach from=$video_fields item=field_id}
					{if $listing.$field_id.file_url != ""}
					<br/><center>{include file="video_player.tpl"}</center><br/>
					{/if}
				{/foreach}
				<br/>
				
				{if $listing.youtube}
					<br/>
					<center><strong>[[FormFieldCaptions!youtube]]:</strong></center>
					{* display property=youtube *}
				{/if}
				<br/>
				
				<center>
					{foreach from=$listing.pictures key=key item=picture name=picimages }
						<br/><a target="_black" href ="{$picture.picture_url}"> <img src="{$picture.thumbnail_url}" border="0" title="{$picture.caption}" alt="{$picture.caption}" /></a>
					{/foreach}
				</center>
				<br/>
			</div>
			<div class="compProfileBottom"></div>
		</div>
		<!--- END PROFILE BLOCK --->
	</div>
	
	<div id="listingsResults">
		<!--- LISTING INFO BLOCK --->
		<div class="listingInfo">
			<h2>{$listing.Title}
				{if $acl->isAllowed('apply_for_a_job') && $listing.ApplicationSettings != ""}
					<div style="float: right"><input type="button" class="buttonApply" style="float: right;" {if $isApplied}onclick="windowMessage();"{else}{if $listing.ApplicationSettings.add_parameter && $listing.ApplicationSettings.add_parameter == 2}onclick="javascript:window.open('{if $listing.company_name}{$GLOBALS.site_url}/apply-now-external/?listing_id={$listing.id}{else}{$listing.ApplicationSettings.value}{/if}');"{else}onclick="popUpWindow('{$GLOBALS.site_url}/apply-now/?listing_id={$listing.id}&ajaxRelocate=1', 520, 480, '[[Apply now]]')"{/if}{/if}  value='[[Apply now]]' /></div>
				{/if}
			</h2>
			<div class="clr"><br/></div>
			<div class="smallListingInfo"><strong>[[FormFieldCaptions!Job ID]]</strong>: [[$listing.id]]</div>
			<div class="smallListingInfo"><strong>[[FormFieldCaptions!Job Views]]</strong>: {$listing.views}</div>
			<div class="smallListingInfo"><strong>[[FormFieldCaptions!Location]]:</strong> {if $listing.City}{$listing.City},{/if} {if $listing.State !='Outside The US (No State)'}[[$listing.State]], {/if}[[Property_Country!{$listing.Country}]]</div>
			<div class="smallListingInfo"><strong>[[FormFieldCaptions!Zip Code]]:</strong> {$listing.ZipCode}</div>
			<div class="smallListingInfo"><strong>[[FormFieldCaptions!Job Category]]:</strong> {* display property=JobCategory *}{$listing.JobCategory}</div>
			<div class="smallListingInfo"><strong>[[FormFieldCaptions!Employment Type]]:</strong> {* display property=EmploymentType *}{$listing.EmploymentType}</div>
			<div class="smallListingInfo"><strong>[[FormFieldCaptions!Salary]]:</strong> {* display property=Salary *}{$listing.Salary.value} [[$listing.SalaryType]]</div>
			<div class="smallListingInfo"><strong>[[FormFieldCaptions!Posted]]:</strong> [[$listing.activation_date]]</div>
			<div class="clr"><br/></div>
	
			{if !$listing.company_name}
				{if $listing.Occupations}
					<h3>[[Occupations]]</h3>
					{* display property=Occupations *}{$listing.Occupations}
					<div class="clr"><br/></div>
				{/if}
			{/if}
	
			{if $listing.JobDescription}
				<h3>[[FormFieldCaptions!Job Description]]</h3>
				{$listing.JobDescription}
				<div class="clr"><br/></div>
			{/if}
	
			{if !$listing.company_name}
				{if $listing.JobRequirements}
					<h3>[[FormFieldCaptions!Job Requirements]]</h3>
					{$listing.JobRequirements}
					<div class="clr"><br/></div>
				{/if}
			{/if}
	
			{if $GLOBALS.plugins.ShareThisPlugin.active == 1 && $GLOBALS.settings.display_on_job_page == 1}
				{$GLOBALS.settings.header_code}
				{$GLOBALS.settings.code}
			{/if}
		    {* SOCIAL PLUGIN: FACEBOOK LIKE BUTTON *}
			{module name="social" function="facebook_like_button" listing=$listing type="Job"}
		    {* / SOCIAL PLUGIN: FACEBOOK LIKE BUTTON *}
		    {* SOCIAL PLUGIN: LINKEDIN SHARE BUTTON *}
			{module name="social" function="linkedin_share_button" listing=$listing}
		    {* / SOCIAL PLUGIN: LINKEDIN SHARE BUTTON *}
			<div class="clr"><br/></div>
	
			{if $acl->isAllowed('add_job_comments')}
				{include file="listing_comments.tpl" listing=$listing }
			{/if}
		</div>
		<!--- END LISTING INFO BLOCK --->
	</div>
	
	<div id="endResults">
		<ul class="listingLinksBottom">
			{if $searchId != "" || $GLOBALS.user_page_uri == "/my-job-details"}
				<li class="paggingBottom">
					<img src="{image}prev_btn.png"  style="margin-right:5px;" alt="[[Previous]]"  border="0" />
					{if $prev_next_ids.prev}
						<a href="{$GLOBALS.site_url}/{if $GLOBALS.user_page_uri == "/my-job-details"}my-job-details{else}display-job{/if}/{$prev_next_ids.prev}/?searchId={$searchId}&amp;page={$page}">[[Previous]]</a> &nbsp;
					{else}
						{if !$prev_next_ids.prev && !$prev_next_ids.next}{else}[[Previous]] &nbsp;{/if}
					{/if}
					{if $prev_next_ids.next}
						<a href="{$GLOBALS.site_url}/{if $GLOBALS.user_page_uri == "/my-job-details"}my-job-details{else}display-job{/if}/{$prev_next_ids.next}/?searchId={$searchId}&amp;page={$page}">[[Next]]</a>
					{else}
						{if !$prev_next_ids.prev && !$prev_next_ids.next}{else}[[Next]]{/if}
					{/if}
					<img src="{image}next_btn.png"  style="margin-left:5px;" alt="[[Next]]"  border="0"/>
				</li>
			{/if}
		</ul>
	</div>
	{/if}
</div>