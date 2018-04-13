<div class="headerBox">
	<h1>[[Resume Search Results]]</h1>
</div>
{if $ERRORS}
	{include file="error.tpl"}
{else}

	<div class="modifySearch">
		<a href="{$GLOBALS.site_url}/search-resumes/?searchId={$searchId}"> [[Modify search]]</a>
	</div>
	<div class="numberResults">
		{assign var="listings_number" value=$listing_search.listings_number}
		[[Results:]] {$listings_number} {if $listings_number == 1}[[Resume]]{else}[[Resumes]]{/if}
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
			<div class="boxResultsResumes">
		    	<a name="listing_{$listing.id}"></a>
		    	<h2><a href="{$GLOBALS.site_url}/display-resume/{$listing.id}/{$listing.Title|regex_replace:"/[\\/\\\:*?\"<>|%#$\s]/":"-"}.html?searchId={$searchId}&amp;page={$listing_search.current_page}">{$listing.Title}</a></h2>
		    	{if $listing.anonymous == 1}[[Anonymous User]]{else}{$listing.user.FirstName} {$listing.user.LastName}{/if}, &nbsp;{$listing.City}
		    	<br/><br/>[[Date posted]]: [[$listing.activation_date]]
			</div>
			<div class="clr"><br/></div>
		{/foreach}
	{else}
		<p class="error">[[There are no Resumes meeting the selected criteria in the system. ]]</p>
	{/if}

	<div class="modifySearch">
		<a href="{$GLOBALS.site_url}/search-resumes/?searchId={$searchId}"> [[Modify search]]</a>
	</div>
	<div class="numberResults">
		{assign var="listings_number" value=$listing_search.listings_number}
		[[Results:]] {$listings_number} {if $listings_number == 1}[[Resume]]{else}[[Resumes]]{/if}
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