
<div id="displayListing">
	
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

		--></script>
		{/literal}
	
	
	
	<div id="refineResults">
		<!--- PROFILE BLOCK --->
		<div class="userInfo listingManage">
			<div id="blockTop"></div>
			<div class="compProfileTitle">[[Company Info]]</div>
			<div class="compProfileInfo">
				{if $listing.anonymous != 1 || $applications.anonymous === 0 }
					{if $listing.user.Logo.file_url}
						<center><img src="{$listing.user.Logo.file_url}" alt="" /></center><br/>
					{/if}
					{* Check for JobG8 listings property *}
					<strong>
						{if $listing.company_name}{$listing.company_name}
						{elseif $listing.CompanyName}{$listing.CompanyName}
						{else}{$listing.user.CompanyName}{/if}</strong>					
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
	
	<div class="managelistingsResults">
		<!--- LISTING INFO BLOCK --->
		<div class="listingInfo">
			<h2>{$listing.Title}</h2>
			<div class="clr"><br/></div>
			<div class="smallListingInfo"><strong>[[FormFieldCaptions!Job ID]]</strong>: [[$listing.id]]</div>
			<div class="smallListingInfo"><strong>[[FormFieldCaptions!Job Views]]</strong>: {$listing.views}</div>
			<div class="smallListingInfo"><strong>[[FormFieldCaptions!Location]]:</strong> {if $listing.City}{$listing.City}, {/if}{if $listing.State !='Outside The US (No State)'}[[$listing.State]], {/if}[[Property_Country!{$listing.Country}]]</div>
			<div class="smallListingInfo"><strong>[[FormFieldCaptions!Zip Code]]:</strong> {$listing.ZipCode}</div>
			<div class="smallListingInfo"><strong>[[FormFieldCaptions!Job Category]]:</strong> {* display property=JobCategory *}{$listing.JobCategory}</div>
			<div class="smallListingInfo"><strong>[[FormFieldCaptions!Employment Type]]:</strong> {* display property=EmploymentType *}{$listing.EmploymentType}</div>
			<div class="smallListingInfo"><strong>[[FormFieldCaptions!Salary]]:</strong> {* display property=Salary *}{$listing.Salary.value} [[$listing.SalaryType]]</div>
			<div class="smallListingInfo"><strong>[[FormFieldCaptions!Posted]]:</strong> [[$listing.activation_date]]</div>
			<div class="clr"><br/></div>
	
			{if !$listing.company_name}
				{if $listing.Occupations}
					<h3>[[Occupations]]</h3>
					{display property=Occupations}{$listing.Occupations}
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
	

	
		</div>
		<!--- END LISTING INFO BLOCK --->
	</div>
	

	{/if}
</div>