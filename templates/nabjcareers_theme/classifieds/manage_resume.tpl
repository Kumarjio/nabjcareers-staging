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



	
	<div id="refineResults">
		<!--- PROFILE BLOCK --->
		<div class="userInfo listingManage">
			<div id="blockTop"></div>
			<div class="compProfileTitle">[[User Info]]</div>
			<div class="compProfileInfo">
				{if $listing.anonymous != 1 || $applications.anonymous === 0 }
					{if $listing.user.Photo.file_url}
						<center><img src="{$listing.user.Photo.file_url}" alt="" /></center>
					{/if}
						<strong>{$listing.user.FirstName} {$listing.user.LastName}</strong>
						<br />{$listing.user.Address}
						<br />{if $listing.user.City}{$listing.user.City}, {/if}<strong>[[$listing.user.State]]</strong> {if $listing.user.Country}([[$listing.user.Country]]){/if}
						<br /><br />
						<br /><strong>[[FormFieldCaptions!Phone]]</strong>: {$listing.user.PhoneNumber}
						<br /><strong>[[FormFieldCaptions!Email]]</strong>: <a href="mailto:{$listing.user.email}">{$listing.user.email}</a><br/>
					{if $listing.Resume.file_url != ""}
						<br /><img src="{image}view_ditail.png" alt=""/> <a href="{$GLOBALS.site_url}/manage-resume/{$listing.id}/?filename={$listing.Resume.saved_file_name}">[[Download Resume]]</a>
					{/if}	
						<br /><a href="{$GLOBALS.site_url}/search-results-resumes/?action=search&amp;username[equal]={$listing.user.id}">[[All resumes by this user]]</a>
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
	
	<div class="managelistingsResults">
		<!--- LISTING INFO BLOCK --->
		<div class="listingInfo">
			<h2>{$listing.Title}</h2>
			<div class="clr"><br/></div>
				<div class="smallListingInfo"><strong>[[FormFieldCaptions!Resumes ID]]</strong>: [[$listing.id]]</div>
				<div class="smallListingInfo"><strong>[[FormFieldCaptions!Resumes Views]]</strong>: {$listing.views}</div>
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
		    
	
			
			<div class="clr"><br/></div>
		    	

		</div>
		<!--- END LISTING INFO BLOCK --->
	</div>
	
	
	{/if}
</div>