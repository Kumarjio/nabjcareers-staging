{foreach from=$activated_jobs item=activated_job name=activated_jobs_block}
<p class="message">Your Job ID {$activated_job} has successfully been activated using your job credits.</p>
{/foreach} 

{if $url != "/new-listings-activate/"}

	{if $acl->isAllowed('bulk_job_import')}<p><a href='{$GLOBALS.site_url}/job-import/'><strong>[[Bulk job import from exl/csv file]]</strong></a></p>{/if}

	{if $GLOBALS.current_user.group.id == 'Employer'}
		{assign var="url" value=$GLOBALS.site_url|cat:"/add-listing/?listing_type_id=Job"}
		<p>{if !$listings|@count && empty($search_criteria)}[[You have no listings now]]{/if} [[Click]] <a href="{$url}">[[here]]</a> [[to add a new listing.]]</p>
	{else}
	
		{if $listingsInfo.listingsLeft != 0}
			{assign var="url" value=$GLOBALS.site_url|cat:"/add-listing/?listing_type_id=Resume"}
			<p>{if !$listings|@count && empty($search_criteria) && $GLOBALS.current_user.group.id == 'Employer'}[[You have no listings now.]]{/if} [[Click]] <a href="{$url}">[[here]]</a> [[to add a new resume.]]</p>
		{/if}
	{/if}
	

{else}
	<h1>Confirming Jobs to Activate</h1>
{/if} 

{if !$listings|@count}
	{if !empty($search_criteria)}
		<p class="error">[[No listings found.]]</p>
	{/if}
{else}
<p id="p_error" class="empty"></p>
<script type="text/javascript" language="JavaScript">
	{literal}
	function submit()
	{
		form = document.getElementById("listings_per_page_form");
		form.submit();
	}
	{/literal}
</script>

<!-- PER PAGE / NAVIGATION -->
<br />
<div class="numberPerPage">
	<form id="listings_per_page_form" method="get" action="">
		[[Number of listings per page]]:
		<select name="listings_per_page" onchange="submit()">
			<option value="10" {if $listing_search.listings_per_page == 10}selected="selected"{/if}>10</option>
			<option value="20" {if $listing_search.listings_per_page == 20}selected="selected"{/if}>20</option>
			<option value="50" {if $listing_search.listings_per_page == 50}selected="selected"{/if}>50</option>
			<option value="100" {if $listing_search.listings_per_page == 100}selected="selected"{/if}>100</option>
		</select>
		<input type="hidden" name="restore" value="" />
		<input type="hidden" name="page" value="1" />
	</form>
	<br />
	<span class="prevBtn">
		{if $listing_search.current_page-1 > 0}<a href="?restore=1&amp;page={$listing_search.current_page-1}"><img src="{image}prev_btn.png" alt="[[Previous]]" border="0"/>[[Previous]]</a>
		{else}<img src="{image}prev_btn.png" alt="[[Previous]]" border="0"/><a>[[Previous]]</a>{/if}
	</span>
	<span class="navigationItems">
		{if $listing_search.current_page-3 > 0}<a href="?restore=1&amp;page=1">1</a>{/if}
		{if $listing_search.current_page-3 > 1}...{/if}
		{if $listing_search.current_page-2 > 0}<a href="?restore=1&amp;page={$listing_search.current_page-2}">{$listing_search.current_page-2}</a>{/if}
		{if $listing_search.current_page-1 > 0}<a href="?restore=1&amp;page={$listing_search.current_page-1}">{$listing_search.current_page-1}</a>{/if}
		<strong>{$listing_search.current_page}</strong>
		{if $listing_search.current_page+1 <= $listing_search.pages_number}<a href="?restore=1&amp;page={$listing_search.current_page+1}">{$listing_search.current_page+1}</a>{/if}
		{if $listing_search.current_page+2 <= $listing_search.pages_number}<a href="?restore=1&amp;page={$listing_search.current_page+2}">{$listing_search.current_page+2}</a>{/if}
		{if $listing_search.current_page+3 < $listing_search.pages_number}...{/if}
		{if $listing_search.current_page+3 < $listing_search.pages_number + 1}<a href="?restore=1&amp;page={$listing_search.pages_number}">{$listing_search.pages_number}</a>{/if}
		{if $listing_search.current_page+1 <= $listing_search.pages_number}
	</span>
	<span class="nextBtn">
		<a href="?restore=1&amp;page={$listing_search.current_page+1}">[[Next]]<img src="{image}next_btn.png" alt="[[Next]]" border="0" /></a>
		{else}<a>[[Next]]</a> <img src="{image}next_btn.png" alt="[[Next]]" border="0" />{/if}
	</span>
</div>
<div class="pageNavigation">
	<form method="post" action="" onSubmit="return checkboxes_verification();">
	[[Actions with Selected]]:
	
{if $GLOBALS.current_user.group.id eq "Employer"}	
	<input id="confirm_activat_btn" type="submit" name="action_activate" value="[[Confirm Activation and Pay]]" 
	class="button" onclick="return jobs_Status_Checker();" />
{elseif $GLOBALS.current_user.group.id eq "JobSeeker"}
	<input id="confirm_activat_btn" type="submit" name="action_activate" value="[[Active Resume]]" class="button" />
{/if}	

	
	<input type="submit" name="action_deactivate" value="[[Deactivate:raw]]" class="button" />
	
	{* Deleted jobs MOD 08-06-2014*}					
	{if $GLOBALS.current_user.group.caption == 'Employer'}
		<input type="submit" name="action_deleted" value="[[Delete Job:raw]]" class="button" onclick="return confirm('[[Are you sure?:raw]]')" />
	{else}
		<input type="submit" name="action_delete" value="[[Delete:raw]]" class="button" onclick="return confirm('[[Are you sure?:raw]]')" />
	{/if}
	{* END of Deleted jobs MOD 08-06-2014*}						
			
</div>

<!-- END PER PAGE / NAVIGATION -->

<div class="clr"><br/></div>
<div class="results">
<table cellspacing="0">
	<thead>
		<tr>
			<th class="tableLeft"> </th>
			<th width="1"><input type="checkbox" id="all_checkboxes_control" /></th>
			<th width="30%">
				[[Sort by]]: <a href="?restore=1&amp;sorting_field=Title&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'Title'}DESC{else}ASC{/if}">[[FormFieldCaptions!Title]]</a>
				{if $sorting_field == 'Title'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="[[Up]]" />{else}<img src="{image}b_down_arrow.png" alt="[[Down]]" />{/if}{/if}
			</th>
			<th width="10%">
				{if $hasSubusersWithListings}
					<a href="?restore=1&amp;sorting_field=subuser_sid&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'subuser_sid'}DESC{else}ASC{/if}">[[Listing Owner]]</a>
					{if $sorting_field == 'subuser_sid'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="[[Up]]" />{else}<img src="{image}b_down_arrow.png" alt="[[Down]]" />{/if}{/if}
				{/if}
			</th>
			<th width="10%">
				<a href="?restore=1&amp;sorting_field=id&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'id'}DESC{else}ASC{/if}">{if $GLOBALS.current_user.group.id == 'Employer'}[[FormFieldCaptions!Job ID]]{else}[[FormFieldCaptions!Resume ID]]{/if}</a>
				{if $sorting_field == 'id'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="[[Up]]" />{else}<img src="{image}b_down_arrow.png" alt="[[Down]]" />{/if}{/if}
			</th>
			<th width="10%">
				{if $property.activation_date.is_sortable}
					<a href="?restore=1&amp;sorting_field=activation_date&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'activation_date'}DESC{else}ASC{/if}">[[FormFieldCaptions!Posted]]</a>
					{if $sorting_field == 'activation_date'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="Up" />{else}<img src="{image}b_down_arrow.png" alt="Down" />{/if}{/if}
				{else}
					[[FormFieldCaptions!Posted]]
				{/if}
			</th>
			<th width="7%">
				<a href="?restore=1&amp;sorting_field=active&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'active'}DESC{else}ASC{/if}">[[FormFieldCaptions!Active]]</a>
				{if $sorting_field == 'active'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="Up" />{else}<img src="{image}b_down_arrow.png" alt="Down" />{/if}{/if}
			</th>
			<th width="9%">
				<a href="?restore=1&amp;sorting_field=views&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'views'}DESC{else}ASC{/if}">[[FormFieldCaptions!Number of Views]]</a>
				{if $sorting_field == 'views'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="Up" />{else}<img src="{image}b_down_arrow.png" alt="Down" />{/if}{/if}
			</th>
			<th width="10%">
				{if $GLOBALS.current_user.group.id == 'Employer'}
					<a href="?restore=1&amp;sorting_field=applications&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'applications'}DESC{else}ASC{/if}">[[FormFieldCaptions!Applications]]</a>
					{if $sorting_field == 'applications'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="Up" />{else}<img src="{image}b_down_arrow.png" alt="Down" />{/if}{/if}
				{/if}
			</th>
			<th width="10%">
				{if $waitApprove == 1}
					<a href="?restore=1&amp;sorting_field=status&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'status'}DESC{else}ASC{/if}">[[FormFieldCaptions!Approval Status]]</a>
					{if $sorting_field == 'status'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.png" alt="Up" />{else}<img src="{image}b_down_arrow.png" alt="Down" />{/if}{/if}
				{/if}
			</th>
			<th class="tableRight"> </th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$listings item=listing name=listings_block}
		
		
		{if $listing.type.id eq 'Job'}
			{assign var='link' value='my-job-details'}
		{elseif $listing.type.id eq 'Resume'}
			{assign var='link' value='my-resume-details'}
		{/if}
		
		{if $listing.deleted != 1}
			<tr {if $listing.priority == 1}class="priorityListing"{else}class="{cycle values = 'evenrow,oddrow' advance=false}"{/if}>
				<td> </td>
				<td class="noTdPad">
					<input type="checkbox" class="listings_checkboxes {if $listing.active}activeListing{/if}" name="listings[{$listing.id}]" value="1" 
						id="checkbox_{$smarty.foreach.listings_block.iteration}" {if $listing.is_new == 1}checked="checked"{/if} />
				</td>
				<td><a href="{$GLOBALS.site_url}/{$link}/{$listing.id}/{$listing.Title|regex_replace:"/[\\/\\\:*?\"<>|%#$\s]/":"-"}.html"><strong>{$listing.Title} {if $listing.anonymous == 1}(anonymous){/if}</strong></a></td>
				<td>
					{if $hasSubusersWithListings}
						{if $listing.subuser}{$listing.subuser.username}{else}{$listing.user.username}{/if}
					{/if}
				</td>
				<td>#&nbsp;{$listing.id}</td>
				<td>[[$listing.activation_date]]</td>
				<td>&nbsp;&nbsp;{if $listing.active}{$listing.active}{else}-{/if}</td>
				<td>{$listing.views}</td>
				<td>
					{if $GLOBALS.current_user.group.id == 'Employer'}	
						{if !$apps[$listing.id]}-{else}<a href="{$GLOBALS.site_url}/system/applications/view/?appJobId={$listing.id}">{$apps[$listing.id]|default:"-"}</a>{/if}
					{/if}
				</td>
				<td>
					{if $waitApprove == 1}
						{if $listing.reject_reason != '' && $listing.approveStatus != 'approved'}
							<a title="Reject reason: {$listing.reject_reason}">{$listing.approveStatus}</a> | <a href="?action_sendToApprove=1&amp;listings[{$listing.id}]=1">Submit for approval</a>
						{else}
							{$listing.approveStatus}
						{/if}
					{/if}
				</td>
				<td> </td>
			</tr>
			<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
				<td> </td>
				<td> </td>
				<td colspan="8">
					<ul>
						<li><a href="{$GLOBALS.site_url}/{$link}/{$listing.id}/{$listing.Title|regex_replace:"/[\\/\\\:*?\"<>|%#$\s]/":"-"}.html">[[View details]]</a> |</li>
						<li><a href="{$GLOBALS.site_url}/edit-listing/?listing_id={$listing.id}">[[Edit]]</a> |</li>
						{if $GLOBALS.current_user.group.caption == 'Employer'}<li><a href="{$GLOBALS.site_url}/clone-job/?listing_id={$listing.id}">[[Clone]]</a> |</li>{/if}
						<li>
							{if $listing.active}
								<a href="?action_deactivate=1&amp;listings[{$listing.id}]=1">[[Deactivate]]</a> |
							{else}
								{if $listing.complete == 1}<a href="{$GLOBALS.site_url}/pay-for-listing/?listing_id={$listing.id}">[[Confirm Activation]]</a> |{/if}
							{/if}
						</li>
						
						
						{* Deleted jobs MOD 08-06-2014*}					
							{if $GLOBALS.current_user.group.caption == 'Employer'}
								<li><a href="?action_deleted=1&amp;listings[{$listing.id}]=1" onclick="return confirm('[[Are you sure?:raw]]')">[[Delete Job]]</a></li>
							{else}
								<li><a href="?action_delete=1&amp;listings[{$listing.id}]=1" onclick="return confirm('[[Are you sure?:raw]]')">[[Delete]]</a></li>
							{/if}
						{* END of Deleted jobs MOD 08-06-2014*}					
								
						{if !$listing.featured && $listing.active}
							<li> | <a href="{$GLOBALS.site_url}/make-featured/?listing_id={$listing.id}">[[Upgrade to Featured]]</a></li>
						{/if}
						
						{if !$listing.priority && $listing.active}
							<li> | <a href="{$GLOBALS.site_url}/make-priority/?listing_id={$listing.id}">[[Upgrade to Priority]]</a></li>
						{/if}
					</ul>
				</td>
				<td> </td>
			</tr>
			<tr>
				<td colspan="11" class="separateListing"> </td>
			</tr>
		{/if}	
		
		
		{/foreach}
</table>
</div>
<div class="clr"><br/></div>

{if $GLOBALS.current_user.group.id eq "Employer"}	
	<input id="confirm_activat_btn" type="submit" name="action_activate" value="[[Confirm Activation and Pay]]" class="button" onclick="return jobs_Status_Checker();"  />
{elseif $GLOBALS.current_user.group.id eq "JobSeeker"}
{*	<input id="confirm_activat_btn" type="submit" name="action_activate" value="[[Confirm Activation]]" class="button" /> *}
{/if}	

{if $GLOBALS.current_user.group.id eq "Employer"}	
	<input type="submit" name="action_deactivate" value="[[Deactivate:raw]]" class="button" />
	
	
	
	{* Deleted jobs MOD 08-06-2014*}	
		{* <input type="submit" name="action_delete" value="[[Delete:raw]]" class="button" onclick="return confirm('[[Are you sure?:raw]]')" /> *}
		<input type="submit" name="action_deleted" value="[[Delete Job:raw]]" class="button" onclick="return confirm('[[Are you sure?:raw]]')" />

{/if}	

<div class="pageNavigation">
	<span class="prevBtn">
	{if $listing_search.current_page-1 > 0}
		<a href="?restore=1&amp;page={$listing_search.current_page-1}">
			<img src="{image}prev_btn.png" alt="[[Previous]]" border="0"/>
			[[Previous]]
		</a>
	{else}
		<img src="{image}prev_btn.png" alt="[[Previous]]"  border="0" /><a>[[Previous]]</a>{/if}
	</span>
	<span class="navigationItems">
		{if $listing_search.current_page-3 > 0}<a href="?restore=1&amp;page=1">1</a>{/if}
		{if $listing_search.current_page-3 > 1}...{/if}
		{if $listing_search.current_page-2 > 0}<a href="?restore=1&amp;page={$listing_search.current_page-2}">{$listing_search.current_page-2}</a>{/if}
		{if $listing_search.current_page-1 > 0}<a href="?restore=1&amp;page={$listing_search.current_page-1}">{$listing_search.current_page-1}</a>{/if}
		<strong>{$listing_search.current_page}</strong>
		{if $listing_search.current_page+1 <= $listing_search.pages_number}<a href="?restore=1&amp;page={$listing_search.current_page+1}">{$listing_search.current_page+1}</a>{/if}
		{if $listing_search.current_page+2 <= $listing_search.pages_number}<a href="?restore=1&amp;page={$listing_search.current_page+2}">{$listing_search.current_page+2}</a>{/if}
		{if $listing_search.current_page+3 < $listing_search.pages_number}...{/if}
		{if $listing_search.current_page+3 < $listing_search.pages_number + 1}<a href="?restore=1&amp;page={$listing_search.pages_number}">{$listing_search.pages_number}</a>{/if}
	</span>
	<span class="nextBtn">
		{if $listing_search.current_page+1 <= $listing_search.pages_number}
			<a href="?restore=1&amp;page={$listing_search.current_page+1}" >[[Next]]</a> <img src="{image}next_btn.png" alt="[[Next]]"  border="0"/>
		{else}
			<a>[[Next]]</a> <img src="{image}next_btn.png" alt="[[Next]]" border="0"/>
		{/if}
	</span>
</div>
</form>

<script language="JavaScript" type="text/javascript" >
var total={$smarty.foreach.listings_block.total};
{literal}
function set_checkbox(param) {
	for (i = 1; i <= total; i++) {
		if (checkbox = document.getElementById('checkbox_' + i))
			checkbox.checked = param;
	}
}
$("#all_checkboxes_control").click(function() {
	if ( this.checked == false)
		set_checkbox(false);
	else
		set_checkbox(true);
});
{/literal}
</script>


{* Eldar 08/11/2011 *}
<script language="JavaScript" type="text/javascript" >
{literal}
var Core = {};
Core.getElementsByClass = function(theClass) {
	var elementArray = Array();
	elementArray = document.getElementsByTagName("*");

	var pattern = new RegExp("(^| )" + theClass + "( |$)");
	var matchedArray = Array();

	for (var i = 0; i < elementArray.length; i++) {
		if (pattern.test(elementArray[i].className)) {
			matchedArray[matchedArray.length] = elementArray[i];
		}
	}
	return matchedArray;
};



	var checkboxes_listings;
	
	function checkboxes_verification() {
		var checkboxes_checked = false;
		checkboxes_listings	 = Core.getElementsByClass("listings_checkboxes");
		for(i=0; i<checkboxes_listings.length; i++) {
			if(checkboxes_listings[i].checked) {
				checkboxes_checked = true;
				return true;
				break;
		   	}
		}
		if(checkboxes_checked == false) {

			var txt = document.createTextNode("You must select which jobs you want to activate.");
			document.getElementById('p_error').appendChild(txt);
			document.getElementById('p_error').setAttribute("class", "error"); 
	   	}
		return false;
	}
	
	
	
function jobs_Status_Checker() {
	var $j_checkbox = $(".activeListing");
	$j_checkbox.each( 
		function(i) { 
			if ( this.checked ) {		
				var obj=$(this);			
				var id=obj.attr("name").substr(9,5);
				alert ("You checked listing #"+id+" which is already active. It will be unchecked.");
				this.checked=false;
			}
			
		} 
	)
}
{/literal}
</script>
{/if}