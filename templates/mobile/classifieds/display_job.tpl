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
	<div class="topLinksListing">{if $acl->isAllowed('apply_for_a_job')}<a href="{$GLOBALS.site_url}{if $listing.company_name}/apply-now-external/?listing_id={$listing.id}{else}/apply-now/?listing_id={$listing.id}{/if}{if $isApplied}&params=isApplied{/if}&amp;searchId={$searchId}&amp;page={$page}">[[Apply now]]</a> | {/if}{if $GLOBALS.current_user.logged_in}<a href="{$GLOBALS.site_url}/saved-ads/?listing_id={$listing.id}&listing_type=job&amp;searchId={$searchId}&amp;page={$page}" class="action">[[Save this Job]]</a> | {/if}<a href="{$GLOBALS.site_url}/tell-friends/?listing_id={$listing.id}&amp;searchId={$searchId}&amp;page={$page}" class="action">[[Email this job]]</a> | <a href="{$GLOBALS.site_url}{$search_uri}?action=search&amp;searchId={$searchId}&amp;page={$page}#listing_{$listing.id}">[[Back to Results]]</a></div>
	<div class="clr"><br/></div>
	
	<h2>{$listing.Title}</h2>
	<strong>[[Location]]:</strong> [[$listing.State]], [[{$listing.City}]]
	<br/><strong>[[Employment Type]]:</strong> {display property=EmploymentType}
	<br/><strong>[[Job Category]]:</strong> {display property=JobCategory}
	<br/><strong>[[FormFieldCaptions!Salary]]:</strong> {if $listing.Salary.value != '' && $listing.Salary.value != 0}{$listing.Salary.currency_sign} [[{$listing.Salary.value}]] [[$listing.SalaryType]]{/if}
	<br/><strong>[[FormFieldCaptions!Posted]]:</strong> [[$listing.activation_date]]
	
	<h3>[[$form_fields.Occupations.caption]]:</h3>
	{display property=Occupations}
	
	<h3>[[FormFieldCaptions!Job Description]]:</h3>
	{$listing.JobDescription}
	
	<h3>[[FormFieldCaptions!Job Requirements]]:</h3>
	{$listing.JobRequirements}
	
	<div class="clr"><br/></div>
	<div class="headerBox">
		<h1>[[Company Info]]</h1>
	</div>
	{if empty($listing.company_name)}
	<br /><strong>[[Address]]:</strong> {$listing.user.Address}
	<br /><strong>[[Location]]:</strong> [[$listing.user.State]], {$listing.user.City}
	<br /><strong>[[Email]]:</strong> {$listing.user.email}
	<br/><strong>[[FormFieldCaptions!Phone]]:</strong> {$listing.user.PhoneNumber}
	<br/><strong>[[FormFieldCaptions!Web]]:</strong> <a href="{if strpos($listing.user.WebSite, 'http://') === false}http://{/if}{$listing.user.WebSite}" target="_blank">{$listing.user.WebSite}</a>
	{else}
	<br /><strong>Company Name:</strong> {$listing.company_name}
	{/if}
	
	<div class="clr"><br/></div>
	<div class="topLinksListing">{if $acl->isAllowed('apply_for_a_job')}<a href="{$GLOBALS.site_url}{if $listing.company_name}/apply-now-external/?listing_id={$listing.id}{else}/apply-now/?listing_id={$listing.id}{/if}{if $isApplied}&params=isApplied{/if}&amp;searchId={$searchId}&amp;page={$page}">[[Apply now]]</a> | {/if}{if $GLOBALS.current_user.logged_in}<a href="{$GLOBALS.site_url}/saved-ads/?listing_id={$listing.id}&params=job&amp;searchId={$searchId}&amp;page={$page}" class="action">[[Save this Job]]</a> | {/if}<a href="{$GLOBALS.site_url}/tell-friends/?listing_id={$listing.id}" class="action">[[Email this job]]</a> | <a href="{$GLOBALS.site_url}{$search_uri}?action=search&amp;searchId={$searchId}&amp;page={$page}#listing_{$listing.id}">[[Back to Results]]</a></div>
{/if}