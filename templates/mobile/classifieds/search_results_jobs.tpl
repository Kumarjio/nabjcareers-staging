<div class="headerBox">
	<h1>[[Job Search Results]]</h1>
</div>
{if $ERRORS}
	{include file="error.tpl"}
{else}
    {if !empty($errors)}
        {foreach from=$errors item='error'}
            <p class="error">{$error}</p>
        {/foreach}
    {/if}
	<div class="modifySearch">
		<a href="{$GLOBALS.site_url}/find-jobs/?searchId={$searchId}"> [[Modify search]]</a>
	</div>
	<div class="numberResults">
		{assign var="listings_number" value=$listing_search.listings_number}
		[[Results:]] {$listings_number} {if $listings_number == 1}[[Job]]{else}[[Jobs]]{/if}
	</div>
	<div class="clr"></div>
	<div class="pagging">
		{if $listing_search.current_page-1 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page-1}">[[Previous]]</a>&nbsp;{/if}
			{if $listing_search.current_page-3 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page=1">1</a>{/if}
			{if $listing_search.current_page-3 > 1}...{/if}
			{if $listing_search.current_page-2 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page-2}">{$listing_search.current_page-2}</a>{/if}
			{if $listing_search.current_page-1 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page-1}">{$listing_search.current_page-1}</a>{/if}
			<strong>{$listing_search.current_page}</strong>
			{if $listing_search.current_page+1 <= $listing_search.pages_number}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page+1}">{$listing_search.current_page+1}</a>{/if}
			{if $listing_search.current_page+2 <= $listing_search.pages_number}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page+2}">{$listing_search.current_page+2}</a>{/if}
			{if $listing_search.current_page+3 < $listing_search.pages_number}...{/if}
			{if $listing_search.current_page+3 < $listing_search.pages_number + 1}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.pages_number}">{$listing_search.pages_number}</a>{/if}
		{if $listing_search.current_page+1 <= $listing_search.pages_number}&nbsp;<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page+1}">[[Next]]</a>{/if}	
	</div>
	<div class="clr"><br/></div>

	{if $listings}	
		{foreach from=$listings item=listing name=listings}
		{if $listing.api}
			{if $api != $listing.api}
				<div style="border-top: 3px solid #B2B2B2; padding:10px 0 10px 0;">{$listing.code}</div>
				{assign var="api" value=$listing.api}
				{assign var=api_used_$api value=1} {* this array used to load js-files for multiple api *}
			{/if}
			<div class="boxResults">
		    	<a name="listing_{$listing.id}"></a>
		    	<h2><a href="{$listing.url}" {$listing.onmousedown}>{$listing.Title}</a></h2>
		    	{if $userInfo.CompanyName eq '' }{if $listing.company_name}{$listing.company_name}{else}{$listing.user.CompanyName}{/if},&nbsp;{/if}{$listing.City}
		    	<br/><span>{$listing.JobDescription|strip_tags|truncate:120}</span>
		    	<br/><br/>[[Date posted]]: [[$listing.activation_date]]
			</div>
		{else}
			<div class="boxResults">
		    	<a name="listing_{$listing.id}"></a>
		    	<h2><a href="{$GLOBALS.site_url}/display-job/{$listing.id}/{$listing.Title|regex_replace:"/[\\/\\\:*?\"<>|%#$\s]/":"-"}.html?searchId={$searchId}&amp;page={$listing_search.current_page}">{$listing.Title}</a></h2>
		    	{if $userInfo.CompanyName eq '' }{if $listing.company_name}{$listing.company_name}{else}{$listing.user.CompanyName}{/if},&nbsp;{/if}{$listing.City}
		    	<br/><span>{$listing.JobDescription|strip_tags|truncate:120}</span>
		    	<br/><br/>[[Date posted]]: [[$listing.activation_date]]
			</div>
		{/if}
			<div class="clr"><br/></div>
		{/foreach}
	{else}
		<p class="error">[[There are no Jobs meeting the selected criteria in the system. ]]</p>
	{/if}
	
	<div class="modifySearch">
		<a href="{$GLOBALS.site_url}/find-jobs/?searchId={$searchId}"> [[Modify search]]</a>
	</div>
	<div class="numberResults">
		{assign var="listings_number" value=$listing_search.listings_number}
		[[Results:]] {$listings_number} {if $listings_number == 1}[[Job]]{else}[[Jobs]]{/if}
	</div>
	<div class="clr"></div>
	<div class="pagging">
		{if $listing_search.current_page-1 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page-1}">[[Previous]]</a>&nbsp;{/if}
			{if $listing_search.current_page-3 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page=1">1</a>{/if}
			{if $listing_search.current_page-3 > 1}...{/if}
			{if $listing_search.current_page-2 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page-2}">{$listing_search.current_page-2}</a>{/if}
			{if $listing_search.current_page-1 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page-1}">{$listing_search.current_page-1}</a>{/if}
			<strong>{$listing_search.current_page}</strong>
			{if $listing_search.current_page+1 <= $listing_search.pages_number}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page+1}">{$listing_search.current_page+1}</a>{/if}
			{if $listing_search.current_page+2 <= $listing_search.pages_number}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page+2}">{$listing_search.current_page+2}</a>{/if}
			{if $listing_search.current_page+3 < $listing_search.pages_number}...{/if}
			{if $listing_search.current_page+3 < $listing_search.pages_number + 1}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.pages_number}">{$listing_search.pages_number}</a>{/if}
		{if $listing_search.current_page+1 <= $listing_search.pages_number}&nbsp;<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page+1}">[[Next]]</a>{/if}	
	</div>
	<div class="clr"><br/></div>
	
{/if}