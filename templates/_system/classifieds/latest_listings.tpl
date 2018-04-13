{if $listings}
	{foreach from=$listings item=listing name=listings_block}
		<div class="featuredListings">
			<a href="{$GLOBALS.site_url}/display-job/{$listing.id}/{$listing.Title|regex_replace:"/[\\/\\\:*?\"<>|%#$\s]/":"-"}.html">{$listing.Title}</a><br />
			<span class="green">
				{if $listing.City}{$listing.City}, {/if}[[$listing.State]]
				<br />{* Check for JobG8 listing property *}{if $listing.company_name}{$listing.company_name}{else}{$listing.user.CompanyName}{/if}
			</span>		
		</div>
		{if $smarty.foreach.listings_block.iteration is div by $number_of_cols}<div class="clr"><br/></div>{/if}
	{/foreach}
{else}
	<center>[[There are no listings with requested parameters in the system.]]</center>
{/if}