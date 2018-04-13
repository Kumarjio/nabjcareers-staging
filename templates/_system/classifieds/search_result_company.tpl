{assign var="previous_title" value="1"}
<script type="text/javascript" language="JavaScript">
{literal}
function submitForm(id) {
	lpp = document.getElementById("listings_per_page" + id);
	location.href = '?{/literal}searchId={$searchId}{literal}&action=search&page=1&listings_per_page=' + lpp.value;
}
</script>
{/literal}
<div class="SearchResultsCompany">
	{if $ERRORS}
		{include file="error.tpl"}
	{else}
		{if $tmp_listing.user.CompanyName eq '' }
			<h1>[[Company Search Results]]</h1>
		{/if}
	<!-- RESULTS / PER PAGE / NAVIGATION -->
	<div class="topNavBarLeft"></div>
	<div class="topNavBar">
		<div class="numberResults">[[Results: $usersCount Company]]</div>
		<div class="numberPerPage">
			<form id="listings_per_page_form" method="get" action="" class="tableSRNavPerPage">
			[[Number of company per page]]:
				<select id="listings_per_page1" name="listings_per_page1" onchange="submitForm(1); return false;">
				<option value="10" {if $listings_per_page == 10}selected="selected"{/if}>10</option>
				<option value="20" {if $listings_per_page == 20}selected="selected"{/if}>20</option>
				<option value="50" {if $listings_per_page == 50}selected="selected"{/if}>50</option>
				<option value="100" {if $listings_per_page == 100}selected="selected"{/if}>100</option>
			</select>
			</form>
		</div>
		<div class="pageNavigation">
			<span class="prevBtn"><img src="{image}prev_btn.png" alt="[[Previous]]"/>
			{if $current_page-1 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$current_page-1}">[[Previous]]</a>{else}<a>[[Previous]]</a>{/if}</span>
			{if $current_page-3 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page=1">1</a>{/if}
			{if $current_page-3 > 1}...{/if}
			{if $current_page-2 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$current_page-2}">{$current_page-2}</a>{/if}
			{if $current_page-1 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$current_page-1}">{$current_page-1}</a>{/if}
			<strong>{$current_page}</strong>
			{if $current_page+1 <= $pages_number}<a href="?searchId={$searchId}&amp;action=search&amp;page={$current_page+1}">{$current_page+1}</a>{/if}
			{if $current_page+2 <= $pages_number}<a href="?searchId={$searchId}&amp;action=search&amp;page={$current_page+2}">{$current_page+2}</a>{/if}
			{if $current_page+3 < $pages_number}...{/if}
			{if $current_page+3 < $pages_number + 1}<a href="?searchId={$searchId}&amp;action=search&amp;page={$pages_number}">{$pages_number}</a>{/if}
			<span class="nextBtn">{if $current_page+1 <= $pages_number}<a href="?searchId={$searchId}&amp;action=search&amp;page={$current_page+1}">[[Next]]</a>{else}<a>[[Next]]</a>{/if}
			<img src="{image}next_btn.png" alt="[[Next]]"/></span>
		</div>
	</div>
	<div class="topNavBarRight"></div>
	<div class="clr"><br/></div>
	<!-- END RESULTS / PER PAGE / NAVIGATION -->

	{if $found_users_sids}
	<table cellspacing="0">
		<thead>
			<tr>
				<th class="tableLeft"> </th>
				<th width="10%">&nbsp;</th>
				<th>
					<a href="?searchId={$searchId}&sorting_field=CompanyName&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'CompanyName'}DESC{else}ASC{/if}">[[Company name]]</a>
					{if $sorting_field == 'CompanyName'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="Up" />{else}<img src="{image}b_down_arrow.png" alt="Down" />{/if}{/if}
				</th>
				<th>
					<a href="?searchId={$searchId}&sorting_field=City&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'City'}DESC{else}ASC{/if}">[[FormFieldCaptions!City]]</a>
					{if $sorting_field == 'City'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="Up" />{else}<img src="{image}b_down_arrow.png" alt="Down" />{/if}{/if}
				</th>
				<th>
					<a href="?searchId={$searchId}&sorting_field=State&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'State'}DESC{else}ASC{/if}">[[FormFieldCaptions!State]]</a>
					{if $sorting_field == 'State'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="Up" />{else}<img src="{image}b_down_arrow.png" alt="Down" />{/if}{/if}
				</th>
				<th>
					<a href="?searchId={$searchId}&sorting_field=number_of_jobs&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'number_of_jobs'}DESC{else}ASC{/if}" style="float: right;">[[No of jobs]]</a>
					{if $sorting_field == 'number_of_jobs'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.png" alt="Up" />{else}<img src="{image}b_up_arrow.png" alt="Down" />{/if}{/if}
				</th>
				<th class="tableRight"> </th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$found_users_sids item=user_sid name=users_block}

			{display property='username' object_sid=$user_sid assign='username'}
			{display property='CompanyName' object_sid=$user_sid assign='companyNameAlias'}

				{if $previous_title !== $companyNameAlias}
					
					<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
						
						<td class="compLogo" colspan="2">
							<center>
								{if strpos($companyNameAlias, '-') !== false}
									{*  <a href="{$GLOBALS.site_url}/search-results-jobs/?action=search&amp;username[equal]={$user_sid}">{display property='Logo' object_sid=$user_sid}</a> *}
										<a href="{$GLOBALS.site_url}/search-results-jobs/?action=search&CompanyName[multi_like][]={$companyNameAlias}&userProfile={$user_sid}>{display property='Logo' object_sid=$user_sid}</a>
								{else}
									{* <a href="{$GLOBALS.site_url}/company/{$companyNameAlias|replace:" ":"-"|escape:"url"}">{display property='Logo' object_sid=$user_sid}</a> *}
									<a href="{$GLOBALS.site_url}/search-results-jobs/?action=search&CompanyName[multi_like][]={$companyNameAlias}&userProfile={$user_sid}">{display property='Logo' object_sid=$user_sid}</a>
								{/if}
							</center>
						</td>
						<td>
							<strong>
								{if strpos($companyNameAlias, '-') !== false}
									{*  <a href="{$GLOBALS.site_url}/search-results-jobs/?action=search&amp;username[equal]={$user_sid}">{display property='CompanyName' object_sid=$user_sid}</a> *}
										<a href="{$GLOBALS.site_url}/search-results-jobs/?action=search&CompanyName[multi_like][]={$companyNameAlias}&userProfile={$user_sid}">{display property='CompanyName' object_sid=$user_sid}</a>
								{else}
									{*  <a href="{$GLOBALS.site_url}/company/{$companyNameAlias|replace:" ":"-"|escape:"url"}">{display property='CompanyName' object_sid=$user_sid}</a> *}
										<a href="{$GLOBALS.site_url}/search-results-jobs/?action=search&CompanyName[multi_like][]={$companyNameAlias}&userProfile={$user_sid}">{display property='CompanyName' object_sid=$user_sid}</a>								
								{/if}
							</strong>
						</td>
						<td>{display property='City' object_sid=$user_sid}</td>
						<td>{display property='State' object_sid=$user_sid}</td>
						<td align="right">{display property='countListings' object_sid=$user_sid}</td>
						<td></td>
					</tr>
	
				{/if}
				{assign var="previous_title" value=$companyNameAlias}
			{/foreach}
		</tbody>
	</table>
	
	<!-- RESULTS / PER PAGE / NAVIGATION -->
	<div class="clr"><br/></div>
	<div class="topNavBarLeft"></div>
	<div class="topNavBar">
		<div class="numberResults">[[Results: $usersCount Company]]</div>
		<div class="numberPerPage">
			<form id="listings_per_page_form" method="get" action="" class="tableSRNavPerPage">
			[[Number of jobs per page]]:
				<select id="listings_per_page2" name="listings_per_page2" onchange="submitForm(2); return false;">
				<option value="10" {if $listings_per_page == 10}selected="selected"{/if}>10</option>
				<option value="20" {if $listings_per_page == 20}selected="selected"{/if}>20</option>
				<option value="50" {if $listings_per_page == 50}selected="selected"{/if}>50</option>
				<option value="100" {if $listings_per_page == 100}selected="selected"{/if}>100</option>
			</select>
			</form>
		</div>
		<div class="pageNavigation">
			<span class="prevBtn"><img src="{image}prev_btn.png" alt="[[Previous]]"/>
		    {if $current_page-1 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$current_page-1}">[[Previous]]</a>{else}<a>[[Previous]]</a>{/if}</span>
			{if $current_page-3 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page=1">1</a>{/if}
			{if $current_page-3 > 1}...{/if}
			{if $current_page-2 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$current_page-2}">{$current_page-2}</a>{/if}
			{if $current_page-1 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$current_page-1}">{$current_page-1}</a>{/if}
			<strong>{$current_page}</strong>
			{if $current_page+1 <= $pages_number}<a href="?searchId={$searchId}&amp;action=search&amp;page={$current_page+1}">{$current_page+1}</a>{/if}
			{if $current_page+2 <= $pages_number}<a href="?searchId={$searchId}&amp;action=search&amp;page={$current_page+2}">{$current_page+2}</a>{/if}
			{if $current_page+3 < $pages_number}...{/if}
			{if $current_page+3 < $pages_number + 1}<a href="?searchId={$searchId}&amp;action=search&amp;page={$pages_number}">{$pages_number}</a>{/if}
			<span class="nextBtn">{if $current_page+1 <= $pages_number}<a href="?searchId={$searchId}&amp;action=search&amp;page={$current_page+1}">[[Next]]</a>{else}<a>[[Next]]</a>{/if}
			<img src="{image}next_btn.png" alt="[[Next]]"/></span>
		</div>
	</div>
	<div class="topNavBarRight"></div>
	<!-- END RESULTS / PER PAGE / NAVIGATION -->
	{/if}
	{/if}
</div>