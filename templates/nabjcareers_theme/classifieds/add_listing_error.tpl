{if $GLOBALS.current_user.group.id eq "Employer"}	
	<h1>{if $clone_job}[[Clone Job]]{else}[[Add a New Listing]]{/if}</h1>

{elseif !$GLOBALS.current_user.group.id}	
	<h1>
		{if $clone_job}[[Clone Job]]
		
		{elseif $listing_type_id == "Resume"}[[Add a new Resume]]
		{elseif $listing_type_id == "Job"}[[Add a new Job]]
		{/if}
	</h1>

{else}
	<h1>{if $clone_job}[[Clone Job]]{else}[[Add a New Resume]]{/if}</h1>
{/if}

{if $error eq 'NO_LISTING_PACKAGE_AVAILABLE'}
	[[There's no listing packages available on your membership plan]]
{elseif $error eq 'LISTINGS_NUMBER_LIMIT_EXCEEDED'}

	{if $GLOBALS.current_user.group.id eq "Employer"}	
		[[You've reached the limit of number of listings allowed by your plan]]
		<p><a href="{$GLOBALS.site_url}/subscription">[[Please choose new subscription plan]]</a></p> 
	{elseif $GLOBALS.current_user.group.id eq "JobSeeker"}
		[[You have already posted a resume. You can only have one resume at a time. To see your resume click the button below]]
		<p><a class="button" href="{$GLOBALS.site_url}/my-listings/">[[My resume]]</a></p> 	
	{/if}


{elseif $error eq 'NO_CONTRACT'}
	[[Choose your memberhsip plan]]
{elseif $error eq 'DO_NOT_MATCH_POST_THIS_TYPE_LISTING'}
	[[You do not have permissions to post {$listing_type_id} listings.]]
{elseif $error eq 'NOT_LOGGED_IN'}
	{if $listing_type_id == "Resume"}
		[[Please log in to upload a resume. If you do not have an account, please]] <a href="{$GLOBALS.site_url}/registration/">[[Register.]]</a>
	{elseif $listing_type_id == "Job"}
		[[Please log in to place a new posting. If you do not have an account, please]] <a href="{$GLOBALS.site_url}/registration/">[[Register.]]</a>
	{/if}
	<br/><br/>
	{module name="users" function="login"}
{/if}
