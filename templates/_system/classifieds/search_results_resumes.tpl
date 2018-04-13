<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.bgiframe.js"></script>
<script type="text/javascript" language="JavaScript">
{literal}
$.ui.dialog.defaults.bgiframe = true;
function submitForm(id) {
	lpp = document.getElementById("listings_per_page" + id);
	location.href = "?{/literal}searchId={$searchId}{literal}&action=search&page=1&listings_per_page=" + lpp.value;
}
function popUpWindow(url, widthWin, heightWin, title, parentReload, userLoggedIn){
	reloadPage = false;
	newPageReload = false;
	$("#messageBox").dialog( 'destroy' ).html('{/literal}<img style="vertical-align: middle;" src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" /> [[Please, wait ...]]{literal}');
	$("#messageBox").dialog({
		width: widthWin,
		height: heightWin,
		modal: true,
		title: title,
		close: function(event, ui) {
			if((parentReload == true && !userLoggedIn) || newPageReload == true) {
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
					{if $tmp_listing.user.FirstName ne '' or $tmp_listing.user.LastName ne ''}
						{assign var="firstName" value=$tmp_listing.user.FirstName}
						{assign var="lastName" value=$tmp_listing.user.LastName}
						<div class="Results">[[Resumes by $firstName $lastName]]</div><span></span>
					{/if}
				{else}
					<div class="Results">[[Resume Search Results]]</div><span></span>
				{/if}
				<!-- TOP QUICK LINKS -->
				<div class="topResultsLinks">
					<ul>
						<li class="modifySearchIco"><a href="{$GLOBALS.site_url}/search-resumes/?searchId={$searchId}">[[Modify search]]</a></li>
						{if $listing_type_id != ''}<li class="saveSearchIco"><a onclick="popUpWindow('{$GLOBALS.site_url}/save-search/?searchId={$searchId}', 350, 300, '[[Save this Search]]', true, {if $GLOBALS.current_user.logged_in}true{else}false{/if}); return false;" href="{$GLOBALS.site_url}/save-search/?searchId={$searchId}">[[Save this Search]]</a></li>{/if}
						{if $listing_type_id != ''}<li class="saveSearchIco"><a onclick="popUpWindow('{$GLOBALS.site_url}/save-search/?searchId={$searchId}&alert=1', 350, 300, '[[Save Resume Alert]]', true, {if $GLOBALS.current_user.logged_in}true{else}false{/if}); return false;" href="{$GLOBALS.site_url}/save-search/?searchId={$searchId}">[[Save Resume Alert]]</a></li>{/if}
						<li class="savedIco">
							{if $GLOBALS.current_user.logged_in}<a href="{$GLOBALS.site_url}/saved-resumes">[[Saved resumes]]</a>
							{else}<a onclick="popUpWindow('{$GLOBALS.site_url}/saved-listings/?listing_type_id=resume', 350, 300, '[[Saved resumes]]'); return false;" href="{$GLOBALS.site_url}/saved-listings/">[[Saved resumes]]</a>
							{/if}
						</li>
						<li class="savedIco">
							{if $GLOBALS.current_user.logged_in}<a href="{$GLOBALS.site_url}/saved-searches/">[[Saved searches]]</a>
							{else}<a onclick="popUpWindow('{$GLOBALS.site_url}/saved-searches/', 350, 300, '[[Saved searches]]'); return false;" href="{$GLOBALS.site_url}/saved-searches/">[[Saved searches]]</a>
							{/if}
						</li>
					</ul>
				</div>
				<!-- END TOP QUICK LINKS -->
			</div>

			<!-- TOP RESULTS - PER PAGE - PAGE NAVIGATION -->
			<div class="topNavBarLeft"></div>
			<div class="topNavBar">
				<div class="numberResults">
					{assign var="listings_number" value=$listing_search.listings_number}
					[[Results: $listings_number Resumes]]
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
						[[Number of resumes per page]]:
						<select id="listings_per_page1" name="listings_per_page1" onchange="submitForm(1); return false;">
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
					<img src="{image}next_btn.png"  alt=""/></span>
				</div>
			</div>
			<div class="topNavBarRight"></div>
			<!-- END RESULTS / PER PAGE / NAVIGATION -->
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
								{foreach from=$currentSearch item=fieldInfo key=fieldID}
								{capture name="refineTranslationDomain"}Property_{$fieldID}{/capture}
								<tr>
									<td></td>
									<td>
									<div class="currentSearch"><strong>[[FormFieldCaptions!{$fieldInfo.name}]]</strong></div>
										{foreach from=$fieldInfo.field item=field_value key=field_type}
											{if $field_type == 'monetary'}
												{foreach from=$field_value item=val key=real_val name=loopVal}
													{if $smarty.foreach.loopVal.iteration%2 == 0}
														[[to]]
													{/if}
													<span class="curSearchItem"><a href='?searchId={$searchId}&action=undo&param={$fieldID}&type={$field_type}&value={$real_val}{if $show_brief_or_detailed}&amp;show_brief_or_detailed={$show_brief_or_detailed}{/if}'>[[(undo)]]</a> {tr domain=$smarty.capture.refineTranslationDomain}{$val}{/tr}</span>
												{/foreach}
											{else}
												{foreach from=$field_value item=val key=real_val}
													<span class="curSearchItem"><a href='?searchId={$searchId}&action=undo&param={$fieldID}&type={$field_type}&value={$real_val}{if $show_brief_or_detailed}&amp;show_brief_or_detailed={$show_brief_or_detailed}{/if}'>[[(undo)]]</a> {tr domain=$smarty.capture.refineTranslationDomain}{$val}{/tr}</span><br/>
												{/foreach}
											{/if}
										{/foreach}
									</td>
									<td></td>
								</tr>
								{/foreach}
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
											<td width="100%">
												<div class="refine_button"><div class="refine_icon">[+]</div><strong>[[FormFieldCaptions!{$refineField.caption}]]</strong></div>
												<div class="refine_block" style="display: none">
													{foreach from=$refineField.search_result item=val name=fieldValue}
														{if $smarty.foreach.fieldValue.iteration == 6}
															<div class="block_values"  style="display: none">
														{/if}
														{capture name="refineTranslationDomain"}Property_{$refineField.field_name}{/capture}
														{if $refineField.criteria}
															{if !in_array($val.value, $refineField.criteria) && (!$val.sid || ($val.sid && !in_array($val.sid, $refineField.criteria))) }
																<div class="refineItem"><a href='?searchId={$searchId}&amp;action=refine&amp;{$refineField.field_name}[multi_like_and][]={if $val.sid}{$val.sid}{else}{$val.value}{/if}{if $show_brief_or_detailed}&amp;show_brief_or_detailed={$show_brief_or_detailed}{/if}'>{tr domain=$smarty.capture.refineTranslationDomain}{$val.value}{/tr}</a> ({$val.count})</div>
															{/if}
														{else}
															<div class="refineItem"><a href='?searchId={$searchId}&amp;action=refine&amp;{$refineField.field_name}[multi_like_and][]={if $val.sid}{$val.sid}{else}{$val.value}{/if}{if $show_brief_or_detailed}&amp;show_brief_or_detailed={$show_brief_or_detailed}{/if}'>{tr domain=$smarty.capture.refineTranslationDomain}{$val.value}{/tr}</a> ({$val.count})</div>
														{/if}
													{/foreach}
													{if $smarty.foreach.fieldValue.total > 6}
														</div><div class="block_values_button"> &nbsp; &#187; [[more]]</div>
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
								<th width="25%">[[FormFieldCaptions!Name]]</th>
								<th width="30%">
									<a href="?searchId={$searchId}&amp;action=search&amp;sorting_field=Title&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'Title'}DESC{else}ASC{/if}">[[FormFieldCaptions!Title]]</a>
									{if $is_show_brief_or_detailed}
										<a href="?{if $searchId}searchId={$searchId}&amp;{/if}{if $params|strpos:"searchId" !== false}{$params|regex_replace:"/searchId=$searchId&amp;/":""|regex_replace:"/&amp;show_brief_or_detailed=$show_brief_or_detailed/":""}{else}{$params}{/if}&amp;show_brief_or_detailed={if $show_brief_or_detailed == 'brief'}detailed{else}brief{/if}" id="showBriefOrDetailed">({if $show_brief_or_detailed == 'brief'}[[show detailed]]{else}[[show brief]]{/if})</a>
									{/if}
									{if $listing_search.sorting_field == 'Title'}{if $listing_search.sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="Up" />{else}<img src="{image}b_down_arrow.png" alt="Down" />{/if}{/if}
								</th>
								<th>
									<a href="?searchId={$searchId}&amp;action=search&amp;sorting_field=TotalYearsExperience&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'TotalYearsExperience'}DESC{else}ASC{/if}">[[FormFieldCaptions!Experience]]</a>
									{if $listing_search.sorting_field == 'TotalYearsExperience'}{if $listing_search.sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="Up" />{else}<img src="{image}b_down_arrow.png" alt="Down" />{/if}{/if}
								</th>
								<th>
									<a href="?searchId={$searchId}&amp;action=search&amp;sorting_field=City&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'City'}DESC{else}ASC{/if}">[[FormFieldCaptions!City]]</a>
									{if $listing_search.sorting_field == 'City'}{if $listing_search.sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="Up" />{else}<img src="{image}b_down_arrow.png" alt="Down" />{/if}{/if}
								</th>
								<th width="10%">
									<a href="?searchId={$searchId}&amp;action=search&amp;sorting_field=activation_date&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'activation_date'}DESC{else}ASC{/if}">[[FormFieldCaptions!Posted]]</a>
									{if $listing_search.sorting_field == 'activation_date'}{if $listing_search.sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="Up" />{else}<img src="{image}b_down_arrow.png" alt="Down" />{/if}{/if}
								</th>
								<th class="tableRight"> </th>
							</tr>
						</thead>
						<tbody>
						<!-- Job Info Start -->
						{foreach from=$listings item=listing name=listings}
							{if $listing.anonymous == 1 && $search_criteria.username.value != ''}
								{* it's anonimous resume and search resumes by name - don't show it *}
							{else}
								<tr {if $listing.priority == 1}class="priorityListing"{else}class="{cycle values = 'evenrow,oddrow' advance=false}"{/if}>
									<td> </td>
									<td>
							    		<a name="listing_{$listing.id}">&nbsp;</a>
							    		<strong>{if $listing.anonymous == 1}[[Anonymous User]]{else}{$listing.user.FirstName} {$listing.user.LastName}{/if}</strong>
									</td>
									<td>
							    		<a href="{$GLOBALS.site_url}/display-resume/{$listing.id}/{$listing.Title|regex_replace:"/[\\/\\\:*?\"<>|%#$\s]/":"-"}.html?searchId={$searchId}&amp;page={$listing_search.current_page}" class="JobTittleSR"><strong>{$listing.Title}</strong></a>
									</td>
									<td> {if $listing.TotalYearsExperience>0}{$listing.TotalYearsExperience} [[years]]{/if}</td>
									<td> [[Property_City!{$listing.City}]]</td>
									<td> [[$listing.activation_date]]</td>
									<td> </td>
								</tr>
								{if $show_brief_or_detailed != 'brief'}
									{if $listing.Objective}
										<tr {if $listing.priority == 1}class="priorityListing"{else}class="{cycle values = 'evenrow,oddrow' advance=false}"{/if}>
											<td> </td>
											<td colspan="5">{$listing.Objective|strip_tags|truncate:120}</td>
											<td> </td>
										</tr>
									{/if}
								{/if}
								<tr {if $listing.priority == 1}class="priorityListing"{else}class="{cycle values = 'evenrow,oddrow' advance=true}"{/if}>
									<td> </td>
									<td colspan="5">
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
								   						<a href="{$GLOBALS.site_url}/saved-ads/?listing_id={$listing.id}" onclick="{if $GLOBALS.current_user.logged_in}SaveAd('notes_{$listing.id}', '{$GLOBALS.site_url}/saved-ads/?listing_id={$listing.id}&listing_type=resume'){else}popUpWindow('{$GLOBALS.site_url}/saved-ads/?listing_id={$listing.id}&listing_type=resume', 300, 300, '[[Save this Resume]]', true, {if $GLOBALS.current_user.logged_in}true{else}false{/if}){/if}; return false;"  class="action">[[Save ad]]</a>
								   					{/if}
												</span>
											</li>
											<li class="viewDetails"><a href="{$GLOBALS.site_url}/display-resume/{$listing.id}/{$listing.Title|regex_replace:"/[\\/\\\:*?\"<>|%#$\s]/":"-"}.html?searchId={$searchId}&amp;page={$listing_search.current_page}">[[View resume details]]</a></li>
											{if $listing.video.file_url}<li class="viewVideo"><a onclick="popUpWindow('{$GLOBALS.site_url}/video-player/?listing_id={$listing.id}', 282, 300, 'VideoPlayer'); return false;"  href="{$GLOBALS.site_url}/video-player/?listing_id={$listing.id}">[[Watch a video]]</a></li>{/if}				
										</ul>
										<span id = 'formNote_{$listing.id}'>
										{if $listing.saved_listing && $listing.saved_listing.note && $listing.saved_listing.note != ''}
											<b>[[My notes]]:</b> {$listing.saved_listing.note}
										{/if}
										</span><br/><br/>
									</td>
									<td> </td>
								</tr>
								<tr>
									<td colspan="7" class="separateListing"> </td>
								</tr>
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

		<!-- BOTTOM RESULTS - PER PAGE - PAGE NAVIGATION -->
		<div id="endResults">
			<div class="topResultsLinks">
				<div class="topNavBarLeft"></div>
				<div class="topNavBar">
					<div class="numberResults">
						{assign var="listings_number" value=$listing_search.listings_number}
						[[Results: $listings_number Resumes]]
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
						[[Number of resumes per page]]:
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
            {* LINKEDIN: PEOPLE SEARCH : max value of $count = 25 *}
            {module name="social" function="linkedin_people_search_results" profileSID=$listing.user.id count="5"}
            {* / LINKEDIN: PEOPLE SEARCH *}
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