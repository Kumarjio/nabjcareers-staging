
<table cellpadding="3" class="indexResultsTable">
	<tr>
		<th width="48%"><strong>[[Job Title]]</strong></td>
		<th width="25%">[[Company]]</td>
		<th>[[Location]]</td>
	</tr>
	{if $listings}
		{foreach from=$listings item=listing name=listings_block}
			<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
				<td><a href="{$GLOBALS.site_url}/display-job/{$listing.id}/{$listing.Title|regex_replace:"/[\\/\\\:*?\"<>|%#$\s]/":"-"}.html">{$listing.Title}</a></td>
				<td>
				{* Check for JobG8 listing property *}
					{if $listing.company_name}{$listing.company_name}{else}{$listing.CompanyName|truncate:"33":'...'}{/if}
				</td>
				<td>{if $listing.City}{$listing.City}, {/if}{if $listing.State !='Outside The US (No State)'}[[$listing.State]], {/if}[[$listing.Country]]</td>
			</tr>
		{foreachelse}
			<td></td>
		{/foreach}
	{else}
		<tr>
			<td colspan="3">[[There are no listings with requested parameters in the system.]]</td>
		</tr>
	{/if}
</table>