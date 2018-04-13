{title} {$listing.Title} {/title}
{keywords} {$listing.Title} {/keywords}
{description} {$listing.Title} {/description}
{if $errors}
    {foreach from=$errors key=error_code item=error_message}
		<font size="3" class="error">
			{if $error_code == 'UNDEFINED_LISTING_ID'} [[Listing ID is not defined]]
				{elseif $error_code == 'WRONG_LISTING_ID_SPECIFIED'} [[There is no listing in the system with the specified ID]]
				{elseif $error_code == 'LISTING_IS_NOT_ACTIVE'} [[Listing with specified ID is not active]]
				{elseif $error_code == 'NOT_OWNER'} [[You're not the owner of this posting]]
				{elseif $error_code == 'LISTING_IS_NOT_APPROVED'} [[Listing with specified ID is not approved by admin]]
				{elseif $error_code == 'WRONG_DISPLAY_TEMPLATE'} [[Wrong template to display listing]]
			{/if}
		</font>
	{/foreach}
{else}
	<div class="topLinksListing">{if $GLOBALS.current_user.logged_in}<a href="{$GLOBALS.site_url}/saved-ads/?listing_id={$listing.id}&amp;listing_type=resume" class="action">[[Save this Resume]]</a> | {/if}<a href="{$GLOBALS.site_url}/tell-friends/?listing_id={$listing.id}" class="action">[[Email this resume]]</a> | <a href="{$GLOBALS.site_url}{$search_uri}?action=search&amp;searchId={$searchId}&amp;page={$page}#listing_{$listing.id}">[[Back to Results]]</a></div>
	<div class="clr"><br/></div> 

	<h2>{$listing.Title}</h2>
	<strong>[[Location]]:</strong> [[$listing.State]], [[{$listing.City}]]
	<br/><strong>[[Job Category]]:</strong> {display property=JobCategory}
	<br/><strong>[[FormFieldCaptions!Posted]]:</strong> [[$listing.activation_date]]
	<br/><strong>[[FormFieldCaptions!Salary]]:</strong> {if $listing.Salary.value != '' && $listing.Salary.value != 0}{$listing.Salary.currency_sign} [[{$listing.Salary.value}]] [[$listing.SalaryType]]{/if}

	<h3>[[FormFieldCaptions!Objective]]</h3>
	{$listing.Objective}

	<h3>[[FormFieldCaptions!Work Experience]]:</h3>
	{display property=WorkExperience}

	<h3>[[FormFieldCaptions!Total Years Experience]]:</h3>
	{if $listing.TotalYearsExperience}{$listing.TotalYearsExperience} [[years]]{/if}

	<h3>[[FormFieldCaptions!Education]]:</h3>
	{display property=Education}

	<h3>[[FormFieldCaptions!Skills]]:</h3>
	{$listing.Skills}

	<h3>[[FormFieldCaptions!Desired Salary]]:</h3>
	{if $listing.DesiredSalary.value != '' && $listing.Salary.value != 0}[[$listing.DesiredSalary.currency_sign]][[$listing.DesiredSalary.value]] [[$listing.DesiredSalaryType]]{/if}

	<h3>[[$form_fields.Occupations.caption]]:</h3>
	{display property=Occupations}
	
	<div class="clr"><br/></div>
	<div class="headerBox">
		<h1>[[User Info]]</h1>
	</div>

{if $listing.anonymous != 1 || $applications.anonymous === 0 }
	<br /><strong>{$listing.user.FirstName} {$listing.user.LastName}</strong>
	<br /><strong>[[Location]]:</strong> [[$listing.user.State]], {$listing.user.City}
	<br /><strong>[[Email]]:</strong> {$listing.user.email}
	<br/><strong>[[FormFieldCaptions!Phone]]:</strong> {$listing.user.PhoneNumber}
{else}
	<br /><strong>[[Anonymous User Info]]</strong>
{/if}

	<div class="clr"><br/></div>
	<div class="topLinksListing">{if $GLOBALS.current_user.logged_in}<a href="{$GLOBALS.site_url}/saved-ads/?listing_id={$listing.id}&amp;params=resume" class="action">[[Save this Resume]]</a> | {/if}<a href="{$GLOBALS.site_url}/tell-friends/?listing_id={$listing.id}" class="action">[[Email this resume]]</a> | <a href="{$GLOBALS.site_url}{$search_uri}?action=search&amp;searchId={$searchId}&amp;page={$page}#listing_{$listing.id}">[[Back to Results]]</a></div>

{/if}