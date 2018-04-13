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
				{elseif $error_code == 'LISTING_IS_NOT_ACTIVE'} [[This Resume is no longer available]]
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
		<script type="text/javascript"><!--
		$.ui.dialog.defaults.bgiframe = true;
		function popUpWindow(url, widthWin, heightWin, title, parentReload, userLoggedIn) {
			reloadPage = false;
			$("#messageBox").dialog( 'destroy' ).html('{/literal}<img style="vertical-align: middle;" src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" /> [[Please, wait ...]]{literal}');
			$("#messageBox").dialog({
				width: widthWin,
				height: heightWin,
				modal: true,
				title: title,
				close: function(event, ui) {
					if(parentReload == true && !userLoggedIn) {
						if(reloadPage == true)
							parent.document.location.reload();
					}
				}
			}).dialog( 'open' );
			
			$.get(url, function(data){
				$("#messageBox").html(data);  
			});
			return false;
		}
		
		{/literal}
			var link = "{$GLOBALS.site_url}/flag-listing/";
			{literal}
			// send flagForm and show result
			function sendFlagForm() {
				$("#flagForm").ajaxSubmit({
					url : link, 
					success : function (data) {
						$("#messageBox").html(data);
					}
				});
				return false;
			}
			--></script>
		{/literal}


{if $GLOBALS.user_page_uri != "/manage-listing/"}	
	<div class="results">
		<div id="topResults">
			<!-- SAVE LISTING / PRINT LISTING -->
			<div class="searchResultsHeaderLineNew">
				<ul>
					{if $GLOBALS.user_page_uri != "/my-resume-details"}
						<li class="panelSavedIco"><a onclick="popUpWindow('{$GLOBALS.site_url}/saved-ads/?listing_id={$listing.id}&displayForm=1&listing_type=resume', 350, 300, '[[Save this Resume]]', true, {if $GLOBALS.current_user.logged_in}true{else}false{/if}); return false;" href="{$GLOBALS.site_url}/saved-ads/?listing_id={$listing.id}">[[Save this Resume]]</a></li>
						<li class="panelViewDitailsIco">
							{if $GLOBALS.current_user.logged_in}<a href="{$GLOBALS.site_url}/saved-resumes">[[View Saved Resumes]]</a>
							{else}<a onclick="popUpWindow('{$GLOBALS.site_url}/saved-listings/?listing_type_id=resume', 350, 300, '[[View Saved Resumes]]'); return false;" href="{$GLOBALS.site_url}/saved-listings/">[[View Saved Resumes]]</a>
							{/if}
						</li>
					{/if}
					{if $acl->isAllowed('flag_resume')}
						<li class="printListingIco"><a href="{$GLOBALS.site_url}/flag-listing/?listing_id={$listing.id}" onclick="popUpWindow('{$GLOBALS.site_url}/flag-listing/?listing_id={$listing.id}', 400, 350, '[[Flag Resume]]'); return false;" id="message_link">[[Flag This Resume]]</a></li>
					{/if}
						<li class="printListingIco"><a target="_blank" href="{$GLOBALS.site_url}/print-listing/?listing_id={$listing.id}">[[Print This Ad]]</a></li>
						<li class="viewMapIco"><a target="_blank" href="http://www.maps.google.com/?q={$listing.City}+{$listing.State}+{$listing.ZipCode}">[[View Map]]</a></li>
				</ul>
			</div>
			<!-- END SAVE LISTING / PRINT LISTING -->
			
			<!-- MODIFY RESULTS / RATING / COMMENTS / PAGGING -->
			<div class="clr"></div>
			<div class="ModResults">&nbsp;
				{if $searchId != "" && $GLOBALS.user_page_uri != "/my-resume-details"}
					<ul>
						<li class="arrow"><a href="{$GLOBALS.site_url}{$search_uri}?action=search&amp;searchId={$searchId}&amp;page={$page}#listing_{$listing.id}">[[Back to Results]]</a></li>
						<li class="modifySearchIco"><a href="{$GLOBALS.site_url}/search-resumes/?searchId={$searchId}">[[Modify Search]]</a></li>
					</ul>
				{/if}
			</div>
			<div class="Rating">&nbsp;
				{if $show_rates !=0 && $acl->isAllowed('add_resume_ratings')}
					<ul><li class="ratingPanel"><p style="float:left; margin-top: 0px; padding: 0px;">[[Rate This Resume]]: {include file="rating.tpl" listing=$listing }</p></li></ul>
				{/if}
			</div>
			<div class="Comments">&nbsp;
				{if $show_comments != 0 && $acl->isAllowed('add_resume_comments')}
					<ul><li class="comments"><a href="#comment_1">[[Comments]] (+{$listing.comments_num})</a></li></ul>
				{/if}
			</div>
			<div class="Pagging">&nbsp;
				{if $searchId != "" || $GLOBALS.user_page_uri == "/my-resume-details"}
					<ul>
						<li class="pagging">
							<img src="{image}prev_btn.png" alt="[[Previous]]" style="margin-right:2px;" border="0" />
							{if $prev_next_ids.prev}
								<a href="{$GLOBALS.site_url}/{if $GLOBALS.user_page_uri == "/my-resume-details"}my-resume-details{else}display-resume{/if}/{$prev_next_ids.prev}/?searchId={$searchId}&amp;page={$page}">[[Previous]]</a> &nbsp;
							{else}
								[[Previous]] &nbsp;
							{/if}
							{if $prev_next_ids.next}
								<a href="{$GLOBALS.site_url}/{if $GLOBALS.user_page_uri == "/my-resume-details"}my-resume-details{else}display-resume{/if}/{$prev_next_ids.next}/?searchId={$searchId}&amp;page={$page}">[[Next]]</a>
							{else}
								[[Next]]
							{/if}
							<img src="{image}next_btn.png" alt="[[Next]]" style="margin-left:2px;"  border="0"/>
						</li>
					</ul>
				{/if}
			</div>
			<!-- END MODIFY RESULTS / RATING / COMMENTS / PAGGING -->
		</div>
	</div> 
	
	
{/if}
	
	<div id="refineResults">
		<!--- PROFILE BLOCK --->
		<div class="userInfo">
			<div id="blockTop"></div>
			<div class="compProfileTitle">[[User Info]]</div>
			<div class="compProfileInfo">
				{if $listing.anonymous != 1 || $applications.anonymous === 0 }
					{if $listing.user.Photo.file_url}
						<center><img src="{$listing.user.Photo.file_url}" alt="" /></center>
					{/if}
						<span class="usernameResume"><strong>{$listing.user.FirstName} {$listing.user.LastName}</strong></span>
						<br />{$listing.user.Address}
						<br />{if $listing.user.City}{$listing.user.City}, {/if}<strong>[[$listing.user.State]]</strong> {if $listing.user.Country}([[$listing.user.Country]]){/if}
						<br /><br />
						<br /><strong>[[FormFieldCaptions!Phone]]</strong>: {$listing.user.PhoneNumber}
						<br /><strong>[[FormFieldCaptions!Email]]</strong>: <a href="mailto:{$listing.user.email}">{$listing.user.email}</a><br/>
					{* if $listing.Resume.file_url != ""}
						<br />
						<a href="?filename={$listing.Resume.saved_file_name}">
							<img src="{image}ico_resume.gif" alt=""/><span style="display: block; position: relative; top: -30px; left: 40px;">[[Uploaded resume available]]<br />[[Click here to view]]</span>
						</a>
					{/if *}	
						<a href="{$GLOBALS.site_url}/search-results-resumes/?action=search&amp;username[equal]={$listing.user.id}">[[All resumes by this user]]</a>
						<br /><strong><a href="{$GLOBALS.site_url}/private-messages/send/?to={$listing.user.id}" onclick="popUpWindow('{$GLOBALS.site_url}/private-messages/aj-send/?to={$listing.user.id}', 560, 400, '[[Send Private Message]]', true, {if $GLOBALS.current_user.logged_in}true{else}false{/if}); return false;"  class="pm_send_link">[[Send Private Message]]</a></strong>
				{else}
						<br /><strong>[[Anonymous User Info]]</strong>
						<br /><img src="{image}view_ditail.png" alt="[[Download Resume]]"/><a href="?filename={$listing.Resume.saved_file_name}">[[Download Resume]]</a>
						<br /><strong><a href="{$GLOBALS.site_url}/private-messages/send/?to={$listing.user.id}&amp;anonym=1" onclick="popUpWindow('{$GLOBALS.site_url}/private-messages/aj-send/?to={$listing.user.id}&anonym=1', 560, 400, '[[Send Private Message]]', true, {if $GLOBALS.current_user.logged_in}true{else}false{/if}); return false;"  class="pm_send_link">[[Send Private Message]]</a></strong>
				{/if}
				{* LINKEDIN: PROFILE WIDGET *}
				{module name="social" function="profile_widget" profileSID=$listing.user.id}
				{* end of : LINKEDIN: PROFILE WIDGET *}
				{foreach from=$video_fields item=field_id}
					{if $listing.$field_id.file_url != ""}
					<br/><center>{include file="video_player.tpl"}</center><br/>
					{/if}
				{/foreach}
				{if $listing.Youtubevideo}
					<br /><center><strong>[[FormFieldCaptions!youtube]]:</strong></center>
					{display property='Youtubevideo'}
				{/if}
				{foreach from=$listing.pictures key=key item=picture name=picimages }
						<br/><a target="_blank" href ="{$picture.picture_url}"> <img src="{$picture.thumbnail_url}" border="0" title="{$picture.caption}" alt="{$picture.caption}" /> </a>
				{/foreach}
			</div>
			<div class="compProfileBottom"></div>
		</div>
		<!--- END PROFILE BLOCK --->
	</div>
	
	<div id="listingsResults">
		<!--- LISTING INFO BLOCK --->
		<div class="listingInfo">
			<h2>{$listing.Title}</h2>
			<div class="clr"><br/></div>
				<div class="smallListingInfo"><strong>[[FormFieldCaptions!Resumes ID]]</strong>: [[$listing.id]]</div>
				<div class="smallListingInfo"><strong>[[FormFieldCaptions!Resumes Views]]</strong>: {$listing.views}
				
				
			{if $listing.Resume.file_url != ""}
				<div class="downloadResume_right">
					<a href="?filename={$listing.Resume.saved_file_name}">
						<img src="{image}ico_resume.gif" alt=""/><span style="display: block; position: relative; top: -30px; left: 40px;">[[Uploaded resume]]<br />[[available. Click]]<br />[[here to view]]</span>
					</a>
				</div>
			{/if}
				
				</div>
				<div class="smallListingInfo"><strong>[[FormFieldCaptions!Location]]:</strong> {if $listing.City}{$listing.City}, {/if}[[$listing.State]], [[Property_Country!{$listing.Country}]]</div>
				<div class="smallListingInfo"><strong>[[FormFieldCaptions!Zip Code]]:</strong> {$listing.ZipCode}</div>
				<div class="smallListingInfo"><strong>[[FormFieldCaptions!Posted]]:</strong> [[$listing.activation_date]]</div>
				<div class="smallListingInfo"><strong>[[FormFieldCaptions!Job Type]]:</strong> [[$listing.EmploymentType]]</div>
				<div class="smallListingInfo"><strong>[[FormFieldCaptions!Job Category]]:</strong> [[$listing.JobCategory]]</div>
			<div class="clr"><br/></div>
			
			{if $listing.Objective}
				<h3>[[FormFieldCaptions!Objective]]</h3>
				{$listing.Objective}
				<div class="clr"><br/></div>
			{/if}
			
			{if $listing.Education}
				<h3>[[FormFieldCaptions!Education]]:</h3>
			    {display property='Education' }
			    <div class="clr"><br/></div>
			{/if}
			
			{if $listing.WorkExperience}
				<h3>[[FormFieldCaptions!Work Experience]]:</h3>
				{display property='WorkExperience'}
				<div class="clr"><br/></div>
			{/if}

			{if $listing.TotalYearsExperience}
				<h3>[[FormFieldCaptions!Total Years Experience]]:</h3>
				{$listing.TotalYearsExperience} [[years]]
				<div class="clr"><br/></div>
			{/if}
		
			{if $listing.Skills}
				<h3>[[FormFieldCaptions!Skills]]:</h3>
				{$listing.Skills}
				<div class="clr"><br/></div>
			{/if}
		
			{if $listing.DesiredSalary.value}
				<h3>[[FormFieldCaptions!Desired Salary]]:</h3>
				{display property="DesiredSalary"} [[$listing.DesiredSalaryType]]
				<div class="clr"><br/></div>
			{/if}
		
			{if $listing.Occupations}
				<h3>[[FormFieldCaptions!Occupations]]:</h3>
				{display property='Occupations'}
			    <div class="clr"><br/></div>
			{/if}
		    
			{* SOCIAL PLUGIN: FACEBOOK LIKE BUTTON *}
			{module name="social" function="facebook_like_button" listing=$listing type="Resume"}
			{* / SOCIAL PLUGIN: FACEBOOK LIKE BUTTON *}
			{if $GLOBALS.plugins.ShareThisPlugin.active == 1 && $GLOBALS.settings.display_on_resume_page == 1}
				{$GLOBALS.settings.header_code}
				{$GLOBALS.settings.code}
			{/if}
			
			<div class="clr"><br/></div>
		    	
			{if $acl->isAllowed('add_resume_comments')}
					{include file="listing_comments.tpl" listing=$listing }
			{/if}
			
			
			
			
			
		</div>
		<!--- END LISTING INFO BLOCK --->
	</div>
	
	<div id="endResults">
		<ul class="listingLinksBottom">	
			{if $searchId != "" || $GLOBALS.user_page_uri == "/my-resume-details"}
				<li class="paggingBottom">
					<p align="right" class="page_navigator">
						<img src="{image}prev_btn.png" alt=""  border="0"/>
						<font color="#787878">
						{if $prev_next_ids.prev}
							<a href="{$GLOBALS.site_url}/{if $GLOBALS.user_page_uri == "/my-resume-details"}my-resume-details{else}display-resume{/if}/{$prev_next_ids.prev}/?searchId={$searchId}">[[Previous]]</a>
						{else}
							[[Previous]]
						{/if}
						&nbsp;
						{if $prev_next_ids.next}
							<a href="{$GLOBALS.site_url}/{if $GLOBALS.user_page_uri == "/my-resume-details"}my-resume-details{else}display-resume{/if}/{$prev_next_ids.next}/?searchId={$searchId}">[[Next]]</a>
						{else}
							[[Next]]
						{/if}
						</font>	
						<img src="{image}next_btn.png" alt=""  border="0"/>
					</p>
				</li>
			{/if}
		</ul>
		<!--- END BOTTOM PAGGING --->
	</div>
	{/if}
</div>