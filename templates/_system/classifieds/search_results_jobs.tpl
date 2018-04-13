<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.bgiframe.js"></script>
<script type="text/javascript" language="JavaScript">
	{literal}
		$.ui.dialog.defaults.bgiframe = true;
		function submitForm(id) {
			lpp = document.getElementById("listings_per_page" + id);
			location.href = '?{/literal}searchId={$searchId}{literal}&action=search&page=1&listings_per_page=' + lpp.value;
		}
	function popUpWindow(url, widthWin, heightWin, title, parentReload, userLoggedIn){
		reloadPage = false;
		newPageReload = false;
		$("#messageBox").dialog( 'destroy' ).html('{/literal}<img style="vertical-align: middle" src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" /> [[Please, wait ...]]{literal}');
		$("#messageBox").dialog({
			width: widthWin,
			height: heightWin,
			modal: true,
			title: title,
			close: function(event, ui) {
				if((parentReload == true) && !userLoggedIn || newPageReload == true) {
					if(reloadPage == true)
						parent.document.location.reload();
				}
			}
		}).dialog( 'open' );
		$.get(url, function(data){
			$("#messageBox").html(data);
		});
		return false;
	}
	function SaveAd(noteId, url){
		$.get(url, function(data){
			$("#"+noteId).html(data);
		});
	}
	{/literal}
</script>

{if $ERRORS}
	{include file="error.tpl"}
{else}
<div {if $refineSearch}class="results"{else}class="noRefine"{/if}>

	<div id="topResults">
		<div class="headerBgBlock">
			{if isset($search_criteria.username.value)}
				{assign var=tmp_listing value=$listings|@current}
				{if $userInfo.CompanyName ne ''}
					{assign var="companyName" value=$userInfo.CompanyName}
					<!-- This page of company profile, with list of vacancy -->
					{include file="company_profile.tpl"}
					{if isset($smarty.get.company_name)}{assign var=$companyName value=$smarty.get.company_name.equal}{/if}
					<div class="Results">[[Jobs by $companyName]]</div><span></span>
				{/if}
			{else}

				{if isset($smarty.get.userProfile)} 
					{assign var="companyName" value=$smarty.get.CompanyName.multi_like.0}
					<!-- This page of company profile, with list of vacancy -->
					{include file="company_profile.tpl"}
					{if isset($smarty.get.CompanyName.multi_like)}{assign var=$companyName value=$smarty.get.CompanyName.multi_like.0}{/if}
					<div class="Results">[[Jobs by {$smarty.get.CompanyName.multi_like.0} ]]</div><span></span>
				{else}
					<div class="Results">[[Jobs Search Results]]</div><span></span>
				{/if}

			{/if}
		
			<!-- TOP QUICK LINKS -->
			{if $userInfo.CompanyName eq '' }
				<div class="topResultsLinks">
					<ul>
						<li class="modifySearchIco"><a href="{$GLOBALS.site_url}/find-jobs/?searchId={$searchId}"> [[Modify search]]</a></li>
						{if $listing_type_id != ''}
							<li class="saveSearchIco"><a onclick="popUpWindow('{$GLOBALS.site_url}/save-search/?searchId={$searchId}', 300, 300, '[[Save this Search]]', true, {if $GLOBALS.current_user.logged_in}true{else}false{/if}); return false;" href="{$GLOBALS.site_url}/save-search/?searchId={$searchId}">[[Save this Search]]</a></li>
							<li class="saveSearchIco"><a onclick="popUpWindow('{$GLOBALS.site_url}/save-search/?searchId={$searchId}&alert=1', 300, 300, '[[Save Job Alert]]', true, {if $GLOBALS.current_user.logged_in}true{else}false{/if}); return false;" href="{$GLOBALS.site_url}/save-search/?searchId={$searchId}">[[Save Job Alert]]</a></li>
						{/if}
						<li class="savedIco">
							{if $GLOBALS.current_user.logged_in}
								<a href="{$GLOBALS.site_url}/saved-jobs">[[Saved jobs]]</a>
							{else}
								<a onclick="popUpWindow('{$GLOBALS.site_url}/saved-listings/?listing_type_id=job', 300, 300, '[[Saved jobs]]'); return false;" href="{$GLOBALS.site_url}/saved-listings/">[[Saved jobs]]</a>
							{/if}
						</li>
						<li class="savedIco">
							{if $GLOBALS.current_user.logged_in}
								<a href="{$GLOBALS.site_url}/saved-searches/">[[Saved searches]]</a>
							{else}
								<a onclick="popUpWindow('{$GLOBALS.site_url}/saved-searches/', 300, 300, '[[Saved searches]]'); return false;" href="{$GLOBALS.site_url}/saved-searches/">[[Saved searches]]</a>
							{/if}
						</li>
					</ul>
				</div>
			{/if}	
			<!-- END TOP QUICK LINKS -->
		</div>
			

		<!-- TOP RESULTS - PER PAGE - PAGE NAVIGATION -->
		<div class="topNavBarLeft"></div>
		<div class="topNavBar">
			<div class="numberResults">
				{assign var="listings_number" value=$listing_search.listings_number}
				[[Results: $listings_number Jobs]]
				{if $search_criteria.ZipCode.value.location and $search_criteria.ZipCode.value.radius}
					{assign var="radius" value=$search_criteria.ZipCode.value.radius}
					{capture name=radius_search_unit}
						[[$GLOBALS.radius_search_unit]]
					{/capture}
					{assign var="radius_search_unit" value=$smarty.capture.radius_search_unit}
					{assign var="location" value=$search_criteria.ZipCode.value.location}
					[[within $radius $radius_search_unit of $location]]
				{/if}
			</div>

			<div class="numberPerPage">
				<form id="listings_per_page_form" method="get" action="" class="tableSRNavPerPage">
					[[Number of jobs per page]]:
					<select id="listings_per_page1" name="listings_per_page1" onchange="submitForm(1); return false;">
						<option value="10" {if $listing_search.listings_per_page == 10}selected="selected"{/if}>10</option>
						<option value="20" {if $listing_search.listings_per_page == 20}selected="selected"{/if}>20</option>
						<option value="50" {if $listing_search.listings_per_page == 50}selected="selected"{/if}>50</option>
						<option value="100" {if $listing_search.listings_per_page == 100}selected="selected"{/if}>100</option>
					</select>
				</form>
			</div>

			<div class="pageNavigation">
				<span class="prevBtn">
					<img src="{image}prev_btn.png" alt="[[Previous]]"/>
					{if $listing_search.current_page-1 > 0}
						<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page-1}">[[Previous]]</a>
					{else}
						<a>[[Previous]]</a>
					{/if}
				</span>
				<span class="navigationItems">
					{if $listing_search.current_page-3 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page=1">1</a>{/if}
					{if $listing_search.current_page-3 > 1}...{/if}
					{if $listing_search.current_page-2 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page-2}">{$listing_search.current_page-2}</a>{/if}
					{if $listing_search.current_page-1 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page-1}">{$listing_search.current_page-1}</a>{/if}
					<strong>{$listing_search.current_page}</strong>
					{if $listing_search.current_page+1 <= $listing_search.pages_number}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page+1}">{$listing_search.current_page+1}</a>{/if}
					{if $listing_search.current_page+2 <= $listing_search.pages_number}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page+2}">{$listing_search.current_page+2}</a>{/if}
					{if $listing_search.current_page+3 < $listing_search.pages_number}...{/if}
					{if $listing_search.current_page+3 < $listing_search.pages_number + 1}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.pages_number}">{$listing_search.pages_number}</a>{/if}
				</span>
				<span class="nextBtn">
					{if $listing_search.current_page+1 <= $listing_search.pages_number}
						<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page+1}">[[Next]]</a>
					{else}
						<a>[[Next]]</a>
					{/if}
					<img src="{image}next_btn.png" alt="[[Next]]"/>
				</span>
			</div>
		</div>
		<div class="topNavBarRight"></div>
		<!-- END TOP RESULTS - PER PAGE - PAGE NAVIGATION -->
	</div>

	<!-- START REFINE SEARCH -->
	{if $refineSearch}
		<div id="refineResults">
			<div id="blockBg">
				<div id="blockTop"></div>
				<div id="blockInner">
					<table cellpadding="0" cellspacing="0" id="currentSearch">
						<thead>
							<tr>
								<th class="tableLeft"> </th>
								<th>[[Current Search]]:</th>
								<th class="tableRight"> </th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td>
									{foreach from=$currentSearch item=fieldInfo key=fieldID}
										{capture name="refineTranslationDomain"}Property_{$fieldID}{/capture}
										<div class="currentSearch"><strong>[[FormFieldCaptions!{$fieldInfo.name}]]</strong></div>
										{foreach from=$fieldInfo.field item=field_value key=field_type}
											{if $field_type == 'monetary'}
												{foreach from=$field_value item=val key=real_val name=loopVal}
													{if $smarty.foreach.loopVal.iteration%2 == 0}
														[[to]]
													{/if}
													<span class="curSearchItem">
														<a href='?searchId={$searchId}&amp;action=undo&amp;param={$fieldID}&amp;type={$field_type}&amp;value={$real_val}{if $show_brief_or_detailed}&amp;show_brief_or_detailed={$show_brief_or_detailed}{/if}'>[[(undo)]]</a> {tr domain=$smarty.capture.refineTranslationDomain}{$val}{/tr}
													</span>
												{/foreach}
											{else}									
												{foreach from=$field_value item=val key=real_val}
													<span class="curSearchItem"><a href='?searchId={$searchId}&amp;action=undo&amp;param={$fieldID}&amp;type={$field_type}&amp;value={$real_val}{if $show_brief_or_detailed}&amp;show_brief_or_detailed={$show_brief_or_detailed}{/if}'>[[(undo)]]</a> {tr domain=$smarty.capture.refineTranslationDomain}{$val}{/tr}</span><br/>
												{/foreach}
											{/if}
										{/foreach}
									{/foreach}
								</td>
								<td></td>
							</tr>
						</tbody>
					</table>
					<br/>
					<table cellpadding="0" cellspacing="0" width="100%" id="refineResults">
						<thead>
							<tr>
								<th class="tableLeft"> </th>
								<th>[[Refine Results]]:</th>
								<th class="tableRight"> </th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$refineFields item=refineField}
								{if $refineField.show && $refineField.count_results}
									<tr>
										<td></td>
										<td>
											<div class="refine_button">
												<div class="refine_icon">[+]</div>
												<strong>[[FormFieldCaptions!{$refineField.caption}]]</strong>
											</div>
											<div class="refine_block" style="display: none">
												{foreach from=$refineField.search_result item=val name=fieldValue}
													{if $smarty.foreach.fieldValue.iteration == 6}
													
													
														<div class="block_values"  style="display: none">
																										
													
													{/if}
													{capture name="refineTranslationDomain"}Property_{$refineField.field_name}{/capture}
													{if $refineField.criteria}
														{if !in_array($val.value, $refineField.criteria) && (!$val.sid || ($val.sid && !in_array($val.sid, $refineField.criteria))) }
															<div class="refineItem"><a href='?searchId={$searchId}&amp;action=refine&amp;{$refineField.field_name}[multi_like_and][]={if $val.sid}{$val.sid}{else}{$val.value}{/if}{if $val.listing}&amp;search_type=company_name{/if}{if $show_brief_or_detailed}&amp;show_brief_or_detailed={$show_brief_or_detailed}{/if}'>{tr domain=$smarty.capture.refineTranslationDomain}{$val.value}{/tr}</a> ({$val.count})</div>
														{/if}
													{else}
														<div class="refineItem"><a href='?searchId={$searchId}&amp;action=refine&amp;{$refineField.field_name}[multi_like_and][]={if $val.sid}{$val.sid}{else}{$val.value}{/if}{if $val.listing}&amp;search_type=company_name{/if}{if $show_brief_or_detailed}&amp;show_brief_or_detailed={$show_brief_or_detailed}{/if}'>{tr domain=$smarty.capture.refineTranslationDomain}{$val.value}{/tr}</a> ({$val.count})</div>
													{/if}
												{/foreach}
												{if $smarty.foreach.fieldValue.total > 6}
													
													
													</div>
													
													
													<div class="block_values_button"> &nbsp; &#187; [[more]]</div>
												{/if}
											</div>
										</td>
										<td></td>
									</tr>
								{/if}
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
		{/if}
		<!-- END REFINE SEARCH -->

		<!-- LISTINGS TABLE -->
			<div id="listingsResults">
				{if $listings}
					<table cellspacing="0">
						<thead>
							<tr>
								<th class="tableLeft"> </th>
								<th width="50%">
									<a href="?searchId={$searchId}&amp;action=search&amp;sorting_field=Title&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'Title'}DESC{else}ASC{/if}&amp;page={$listing_search.current_page}">[[FormFieldCaptions!Title]]</a>
									{if $is_show_brief_or_detailed}
										<a href="?{if $searchId}searchId={$searchId}&amp;{/if}{if $params|strpos:"searchId" !== false}{$params|regex_replace:"/searchId=$searchId&amp;/":""|regex_replace:"/&amp;show_brief_or_detailed=$show_brief_or_detailed/":""}{else}{$params}{/if}&amp;show_brief_or_detailed={if $show_brief_or_detailed == 'brief'}detailed{else}brief{/if}" id="showBriefOrDetailed">({if $show_brief_or_detailed == 'brief'}[[show detailed]]{else}[[show brief]]{/if})</a>
									{/if}
									{if $listing_search.sorting_field == 'Title'}{if $listing_search.sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="Up" />{else}<img src="{image}b_down_arrow.png" alt="Down" />{/if}{/if}
								</th>
								<th width="20%">
									{if $userInfo.CompanyName eq '' }
										<a href="?searchId={$searchId}&amp;action=search&amp;sorting_field=CompanyName&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'CompanyName'}DESC{else}ASC{/if}&amp;page={$listing_search.current_page}">[[FormFieldCaptions!Company]]</a>
										{if $listing_search.sorting_field == 'CompanyName'}{if $listing_search.sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="Up" />{else}<img src="{image}b_down_arrow.png" alt="Down" />{/if}{/if}
									{/if}
								</th>
								<th>
									<a href="?searchId={$searchId}&amp;action=search&amp;sorting_field=City&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'City'}DESC{else}ASC{/if}&amp;page={$listing_search.current_page}">[[FormFieldCaptions!City]]</a>
									{if $listing_search.sorting_field == 'City'}{if $listing_search.sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="Up" />{else}<img src="{image}b_down_arrow.png" alt="Down" />{/if}{/if}
								</th>
								<th width="10%">
									<a href="?searchId={$searchId}&amp;action=search&amp;sorting_field=activation_date&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'activation_date'}DESC{else}ASC{/if}&amp;page={$listing_search.current_page}">[[FormFieldCaptions!Posted]]</a>
									{if $listing_search.sorting_field == 'activation_date'}{if $listing_search.sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="Up" />{else}<img src="{image}b_down_arrow.png" alt="Down" />{/if}{/if}
								</th>
								<th class="tableRight"> </th>
							</tr>
						</thead>
						<tbody>
							<!-- Job Info Start -->
							{foreach from=$listings item=listing name=listings}
		{if $listing.deleted != 1}
							{if $listing.api}
								{if $api != $listing.api}
									<tr>
										<td colspan="6" style="border-top: 3px solid #B2B2B2;">{$listing.code}<br/></td>
									</tr>
									{assign var="api" value=$listing.api}
								{/if}
								<tr {if $listing.priority == 1}class="priorityListing"{else}class="{cycle values = 'evenrow,oddrow' advance=false}"{/if}>
									<td> </td>
									<td>
							    		<a name="listing_{$listing.id}"></a>
							    		<a href="{$listing.url}"  {if $listing.api == 'indeed'}onmousedown="{$listing.onmousedown}"{/if}><strong>{$listing.Title}</strong></a>
									</td>
									<td>
										{if $listing.CompanyName}
											{$listing.CompanyName}
										{else}
											{$listing.company_name}
										{/if}
									</td>
									<td>{$listing.City}</td>
									<td>[[$listing.activation_date]]</td>
									<td> </td>
								</tr>
								<tr {if $listing.priority == 1}class="priorityListing"{else}class="{cycle values = 'evenrow,oddrow' advance=false}"{/if}>
									<td> </td>
									{if $show_brief_or_detailed != 'brief'}<td colspan="4">{$listing.JobDescription|strip_tags|truncate:120}</td>
									{else}
										<td colspan="4"></td>
									{/if}
									<td> </td>
								</tr>
								<tr {if $listing.priority == 1}class="priorityListing"{else}class="{cycle values = 'evenrow,oddrow' advance=true}"{/if}>
									<td colspan="6"><br/></td>
								</tr>
								<tr>
									<td colspan="6" class="separateListing"> </td>
								</tr>
							{else}
								<tr {if $listing.priority == 1}class="priorityListing"{else}class="{cycle values = 'evenrow,oddrow' advance=false}"{/if}>
									<td> </td>
									<td>
							    		<a name="listing_{$listing.id}"></a>
							    		<a href="{$GLOBALS.site_url}/display-job/{$listing.id}/{$listing.Title|regex_replace:"/[\\/\\\:*?\"<>|%#$\s]/":"-"}.html?searchId={$searchId}&amp;page={$listing_search.current_page}"><strong>{$listing.Title}</strong></a>
									</td>
									<td>
									{if $listing.CompanyName}
										{$listing.CompanyName}
									{else if $userInfo.CompanyName eq '' }
										{if $listing.company_name}
											<a href="{$GLOBALS.site_url}/search-results-jobs/?action=search&amp;username[equal]={$listing.user.id}&amp;company_name[equal]={$listing.company_name}">{$listing.company_name}</a>
										{else}
											{if strpos($listing.user.CompanyName, '-') !== false}
												<a href="{$GLOBALS.site_url}/search-results-jobs/?action=search&amp;username[equal]={$listing.user.id}">{* $listing.user.CompanyName *}{$listing.CompanyName}</a>
											{else}
												<a href="{$GLOBALS.site_url}/company/{$listing.user.CompanyName|replace:" ":"-"|escape:"url"}">{* $listing.user.CompanyName *}{$listing.CompanyName}</a>
											{/if}
										{/if}
									{/if}
									</td>
									<td>{$listing.City}</td>
									<td>[[$listing.activation_date]]</td>
									<td> </td>
								</tr>
								<tr {if $listing.priority == 1}class="priorityListing"{else}class="{cycle values = 'evenrow,oddrow' advance=false}"{/if}>
									<td> </td>
									{if $show_brief_or_detailed != 'brief'}<td colspan="4">{$listing.JobDescription|strip_tags|truncate:120}</td>
									{else}
										<td colspan="4"></td>
									{/if}
									<td> </td>
								</tr>
								<tr {if $listing.priority == 1}class="priorityListing"{else}class="{cycle values = 'evenrow,oddrow' advance=true}"{/if}>
									<td> </td>
									<td colspan="4">
										<ul>
											<li class="saved2Ico">
												<span id='notes_{$listing.id}'>
							    					{if $listing.saved_listing}
							    						{if $listing.saved_listing.note && $listing.saved_listing.note != ''}
							    							<a href="{$GLOBALS.site_url}/edit-notes/?listing_id={$listing.id}" onclick="SaveAd( 'formNote_{$listing.id}', '{$GLOBALS.site_url}/edit-notes/?listing_sid={$listing.id}'); return false;"  class="action">[[Edit notes]]</a>&nbsp;&nbsp;
							    						{else}
							    							<a href="{$GLOBALS.site_url}/add-notes/?listing_id={$listing.id}" onclick="SaveAd( 'formNote_{$listing.id}', '{$GLOBALS.site_url}/add-notes/?listing_sid={$listing.id}'); return false;"  class="action">[[Add notes]]</a>&nbsp;&nbsp;
							    						{/if}
							    					{else}
							    						<a href="{$GLOBALS.site_url}/saved-ads/?listing_id={$listing.id}" onclick="{if $GLOBALS.current_user.logged_in}SaveAd('notes_{$listing.id}', '{$GLOBALS.site_url}/saved-ads/?listing_id={$listing.id}&listing_type=job'){else}popUpWindow('{$GLOBALS.site_url}/saved-ads/?listing_id={$listing.id}&listing_type=job', 300, 300, 'Save this Job', true, {if $GLOBALS.current_user.logged_in}true{else}false{/if}){/if}; return false;"  class="action">[[Save ad]]</a>&nbsp;&nbsp;
							    					{/if}
												</span>
											</li>
											<li class="viewDetails"><a href="{$GLOBALS.site_url}/display-job/{$listing.id}/{$listing.Title|regex_replace:"/[\\/\\\:*?\"<>|%#$\s]/":"-"}.html?searchId={$searchId}&amp;page={$listing_search.current_page}">[[View job details]]</a></li>
											{if $listing.video.file_url}<li class="viewVideo"><a style="cursor: hand;" onclick="popUpWindow('{$GLOBALS.site_url}/video-player/?listing_id={$listing.id}&amp;field_id=video', 282, 300, 'VideoPlayer'); return false;"  href="{$GLOBALS.site_url}/video-player/?listing_id={$listing.id}&amp;field_id=video">[[Watch a video]]</a></li>{/if}
										</ul>
										<span id = 'formNote_{$listing.id}'>
											{if $listing.saved_listing && $listing.saved_listing.note && $listing.saved_listing.note != ''}
											<b>[[My notes]]:</b> {$listing.saved_listing.note}
											{/if}
										</span><br/>
									</td>
									<td> </td>
								</tr>
								<tr>
									<td colspan="6" class="separateListing"> </td>
								</tr>
							{/if}
	{/if}
							{/foreach}
							<!-- END Job Info Start -->
						</tbody>
					</table>
				{else}
					<center>[[There are no postings meeting the criteria you specified]]</center>
				{/if}
			</div>
		<!-- END LISTINGS TABLE -->
		{if $api}
            {if $api == 'indeed'}
                <script type="text/javascript" src="http://www.indeed.com/ads/apiresults.js"></script>
            {/if}
        {/if}
		<!-- BOTTOM RESULTS - PER PAGE - PAGE NAVIGATION -->
		<div id="endResults">
			<div class="topResultsLinks">
				<div class="topNavBarLeft"></div>
				<div class="topNavBar">
					<div class="numberResults">
						{assign var="listings_number" value=$listing_search.listings_number}
						[[Results: $listings_number Jobs]]
						{if $search_criteria.ZipCode.value.location and $search_criteria.ZipCode.value.radius}
							{assign var="radius" value=$search_criteria.ZipCode.value.radius}
							{capture name=radius_search_unit}
								[[$GLOBALS.radius_search_unit]]
							{/capture}
							{assign var="radius_search_unit" value=$smarty.capture.radius_search_unit}
							{assign var="location" value=$search_criteria.ZipCode.value.location}
							[[within $radius $radius_search_unit of $location]]
						{/if}
					</div>
					<div class="numberPerPage">
						<form id="listings_per_page_form" method="get" action="" class="tableSRNavPerPage">
							[[Number of jobs per page]]:
							<select id="listings_per_page2" name="listings_per_page2" onchange="submitForm(2); return false;">
								<option value="10" {if $listing_search.listings_per_page == 10}selected="selected"{/if}>10</option>
								<option value="20" {if $listing_search.listings_per_page == 20}selected="selected"{/if}>20</option>
								<option value="50" {if $listing_search.listings_per_page == 50}selected="selected"{/if}>50</option>
								<option value="100" {if $listing_search.listings_per_page == 100}selected="selected"{/if}>100</option>
							</select>
						</form>
					</div>
					<div class="pageNavigation">
						<span class="prevBtn"><img src="{image}prev_btn.png" alt=""/>
						{if $listing_search.current_page-1 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page-1}">[[Previous]]</a>{else}<a>[[Previous]]</a>{/if}</span>
						<span class="navigationItems">
							{if $listing_search.current_page-3 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page=1">1</a>{/if}
							{if $listing_search.current_page-3 > 1}...{/if}
							{if $listing_search.current_page-2 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page-2}">{$listing_search.current_page-2}</a>{/if}
							{if $listing_search.current_page-1 > 0}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page-1}">{$listing_search.current_page-1}</a>{/if}
							<strong>{$listing_search.current_page}</strong>
							{if $listing_search.current_page+1 <= $listing_search.pages_number}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page+1}">{$listing_search.current_page+1}</a>{/if}
							{if $listing_search.current_page+2 <= $listing_search.pages_number}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page+2}">{$listing_search.current_page+2}</a>{/if}
							{if $listing_search.current_page+3 < $listing_search.pages_number}...{/if}
							{if $listing_search.current_page+3 < $listing_search.pages_number + 1}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.pages_number}">{$listing_search.pages_number}</a>{/if}
						</span>
						<span class="nextBtn">{if $listing_search.current_page+1 <= $listing_search.pages_number}<a href="?searchId={$searchId}&amp;action=search&amp;page={$listing_search.current_page+1}">[[Next]]</a>{else}<a>[[Next]]</a>{/if}
						<img src="{image}next_btn.png" alt=""/></span>
					</div>
				</div>
				<div class="topNavBarRight"></div>
			</div>
		</div>
		<!-- END BOTTOM RESULTS - PER PAGE - PAGE NAVIGATION -->
	</div>
{/if}

{literal}
	<script>
		$(".refine_button").click(function(){
			var butt = $(this);
			$(this).next(".refine_block").slideToggle("normal", function(){
					if ($(this).css("display") == "block") {
						butt.children(".refine_icon").html("[-]");
					} else {
						butt.children(".refine_icon").html("[+]");
					}
				});
		});
		$(".block_values_button").click(function(){
			var butt = $(this);
			$(this).prev(".block_values").slideToggle("normal", function(){
					if ($(this).css("display") == "block") {
						butt.html("{/literal} &nbsp; &#171; [[less]]{literal}");
					} else {
						butt.html("{/literal} &nbsp; &#187; [[more]]{literal}");
					}
				});
		});
	</script>
{/literal}