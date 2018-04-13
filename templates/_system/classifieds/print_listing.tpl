{if $errors}
    {foreach from=$errors key=error_code item=error_message}

		<font size="3" class="error">

		{if $error_code == 'UNDEFINED_LISTING_ID'} [[Listing ID is not defined]]
		
		{elseif $error_code == 'WRONG_LISTING_ID_SPECIFIED'} [[There is no listing in the system with the specified ID]]
		
		{elseif $error_code == 'LISTING_IS_NOT_ACTIVE'} [[Listing with specified ID is not active]]
		
		{elseif $error_code == 'LISTING_IS_NOT_APPROVED'} [[Listing with specified ID is waiting for approve]]

		{/if}

		</font>

	{/foreach}

{else}
	{if $listing.type.id == "Job"}
		{include file="job_details.tpl" listing=$listing }
	{else if $listing.type.id == "Resume"}
		{include file="resume_details.tpl" listing=$listing }
	{/if}
{/if}