{foreach from=$profiles item=profile name=profile_block}
	<div class="FeaturedCompaniesLogo">
		{if strpos($profile.CompanyName, '-') !== false}
			<a href="{$GLOBALS.site_url}/search-results-jobs/?action=search&amp;username[equal]={$profile.id}"><img src="{$profile.Logo.thumb_file_url}" alt="{$profile.WebSite}" border="0" /></a>
		{else}
			<a href="{$GLOBALS.site_url}/company/{$profile.CompanyName|replace:" ":"-"|escape:"url"}"><img src="{$profile.Logo.thumb_file_url}" border="0" alt="{$profile.WebSite}"/></a>
		{/if}
	</div>
	{if $smarty.foreach.profile_block.iteration is div by $number_of_cols}
		<div class="clr"></div>
	{/if}
{/foreach}