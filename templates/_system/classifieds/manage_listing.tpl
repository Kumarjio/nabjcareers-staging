
<h1>Preview Job</h1>

<p>Please review your job posting. <br />
If you find an error, click on the <b>"Edit this Job"</b> button below and make any necessary changes. 
When finished adding all jobs, please click the <b>"Activate Jobs"</b> button below. 
</p>

{if $waitApprove == 1}<p>Your {$listing.type.id|strtolower} posting is successfully created and waiting for approval</p>{/if}
{if $errors == null}
{if $listing.type.id eq "Job"}
	{assign var='link' value='my-job-details'}
{elseif $listing.type.id eq 'Resume'}
	{assign var='link' value='my-resume-details'}
{/if}

{if !$listing.active && $listing.package.price != 0}
	<div id="job_actions_btn">
	<a class="abutton" href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Job">[[Add another job]]</a>
	<a class="abutton" href="{$GLOBALS.site_url}/edit-listing/?listing_id={$listing.id}"> [[Edit Listing]]</a>
	{* <a class="abutton" href="{$GLOBALS.site_url}/pay-for-listing/?listing_id={$listing.id}"> [[Activate Jobs]]</a> *}
	<a class="abutton" href="{$GLOBALS.site_url}/new-listings-activate/"> [[Activate Jobs]]</a>
	</div>
	
	{* ELDAR *}
	<p>{include file="display_job.tpl"}</p>
	<script type="text/javascript">
		{literal}
		document.getElementById("listingsResults").style.marginRight = "-8px";
		{/literal}
	</script>
	{* end ELDAR *}
	
	
	{/if}
	

	{*
	{if $acl->isAllowed('add_featured_listings') && !$listing.featured}
	<p><a href="{$GLOBALS.site_url}/make-featured/?listing_id={$listing.id}"> [[Upgrade to Featured]] </a></p>
	{/if}
	{if $listing.type.id eq "Job"}
	<p><a href="{$GLOBALS.site_url}/clone-job/?listing_id={$listing.id}">[[Clone this job posting]]</a></p>
	{/if}
		
	<br /><p><b>OR you can:</b></p><br />
	<p><a href="{$GLOBALS.site_url}/subscription/?page=manage_listing">[[Get Full access to resume database with DISCOUNT!]]</a></p>
	*}
	
	
{else}
	{foreach from=$errors key=error item=error_message}
		{if $error == 'PARAMETERS_MISSED'}
		<p class="error">[[The key parameters are not specified]]</p>
		{elseif $error == 'WRONG_PARAMETERS_SPECIFIED'}
		<p class="error">[[Wrong parameters are specified]]</p>
		{elseif $error == 'NOT_OWNER'}
		<p class="error">[[You are not owner of this listing]]</p>
		{elseif $error == 'NOT_LOGGED_IN'}
		{assign var="url" value=$GLOBALS.site_url|cat:"/registration/"}
		<p class="error">[[Please log in to access this page. If you do not have an account, please]] <a href="{$url}">[[Register]]</a></p>
		<br/><br/>
		{module name="users" function="login"}
		{/if}
	{/foreach}
{/if}

{* ELDAR *}
<br /><br />
<p><b>Posting length: </b>{$listing.package.listing_lifetime} days</p>
	<p><b>Featured: </b>{if $listing.featured == 1} yes {else}no{/if}</p>
	<p><b>Priority: </b>{if $listing.priority == 1} yes {else}no{/if}</p>
	
	