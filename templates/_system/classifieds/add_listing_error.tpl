<h1>{if $clone_job}[[Clone Job]]{else}[[Add a New Listing]]{/if}</h1>
{if $error eq 'NO_LISTING_PACKAGE_AVAILABLE'}
	[[There's no listing packages available on your membership plan]]
{elseif $error eq 'LISTINGS_NUMBER_LIMIT_EXCEEDED'}
	[[You've reached the limit of number of listings allowed by your plan]]
	<p><a href="{$GLOBALS.site_url}/subscription">[[Please choose new subscription plan]]</a></p> 
{elseif $error eq 'NO_CONTRACT'}
	[[Choose your memberhsip plan]]
{elseif $error eq 'DO_NOT_MATCH_POST_THIS_TYPE_LISTING'}
	[[You do not have permissions to post {$listing_type_id} listings.]]
{elseif $error eq 'NOT_LOGGED_IN'}
	[[Please log in to place a new posting. If you do not have an account, please]] <a href="{$GLOBALS.site_url}/registration/">[[Register.]]</a>
	<br/><br/>
	{module name="users" function="login"}
{/if}
