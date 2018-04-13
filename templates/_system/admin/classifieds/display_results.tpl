<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.bgiframe.js"></script>
<link type="text/css" href="{$GLOBALS.site_url}/../system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />
{literal}
	<script type="text/javascript">
		$.ui.dialog.defaults.bgiframe = true;
		var progBar = "<img src='{/literal}{$GLOBALS.site_url}/../system/ext/jquery/progbar.gif{literal}'>";
		
		$(function() {
			
			$("input[id=rejectButton]").click(function(){
					$("#dialog").dialog('destroy');
					$("#dialog").attr({title: "Enter Reject Reason:"});
					$("#dialog").dialog();
					return false;
			});
			
			$("#submitReject").click(function(){
				val = $("textarea[name='reason']").val();
				$("input[name='rejectReason']").val( val );
				$("input[name='action_name']").val('reject');
	
				$("form[name='resultsForm']").submit();
			});
	
	
			$("input[id=modify_date_button]").click(function() {
				$("#modify_date_dialog").dialog('destroy');
				$("#modify_date_dialog").attr({title: "Modify Expiration Date"});
				$("#modify_date_dialog").dialog();
			});
	
			$("#modify_send_button").click(function(){
				val = $("#days").val();
				$("#days_to_change").val( val );
				$("input[name='action_name']").val('datemodify');
				$("#modify_date_dialog").dialog('destroy').html("{/literal}[[Please wait...]]{literal}" + progBar).dialog( {width: 250});
				$("form[name='resultsForm']").submit();
			});
			
		});
	</script>
{/literal}


<p>
	Results: {$count_listings} listings
	<form id="listings_per_page_form" method="get" action="?">
		{if $listing_search.current_page-1 > 0}&nbsp;<a href="?restore=1&amp;page={$listing_search.current_page-1}">&#171; Previous</a>{else} &#171; Previous{/if}
		{if $listing_search.current_page-3 > 0}&nbsp;<a href="?restore=1&amp;page=1">1</a>{/if}
		{if $listing_search.current_page-3 > 1}&nbsp;...{/if}
		{if $listing_search.current_page-2 > 0}&nbsp;<a href="?restore=1&amp;page={$listing_search.current_page-2}">{$listing_search.current_page-2}</a>{/if}
		{if $listing_search.current_page-1 > 0}&nbsp;<a href="?restore=1&amp;page={$listing_search.current_page-1}">{$listing_search.current_page-1}</a>{/if}
		<strong>{$listing_search.current_page}</strong>
		{if $listing_search.current_page+1 <= $listing_search.pages_number}&nbsp;<a href="?restore=1&amp;page={$listing_search.current_page+1}">{$listing_search.current_page+1}</a>{/if}
		{if $listing_search.current_page+2 <= $listing_search.pages_number}&nbsp;<a href="?restore=1&amp;page={$listing_search.current_page+2}">{$listing_search.current_page+2}</a>{/if}
		{if $listing_search.current_page+3 < $listing_search.pages_number}&nbsp;...{/if}
		{if $listing_search.current_page+3 < $listing_search.pages_number + 1}&nbsp;<a href="?restore=1&amp;page={$listing_search.pages_number}">{$listing_search.pages_number}</a>{/if}
		{if $listing_search.current_page+1 <= $listing_search.pages_number}&nbsp;<a href="?restore=1&amp;page={$listing_search.current_page+1}">Next &#187;</a>{else}Next &#187;{/if}
	
		<span style="padding-left:50px">Number of listings per page:</span>
		<select name="listings_per_page" onchange="submit()" class="perPage">
			<option value="10" {if $listing_search.listings_per_page == 10}selected{/if}>10</option>
			<option value="20" {if $listing_search.listings_per_page == 20}selected{/if}>20</option>
			<option value="50" {if $listing_search.listings_per_page == 50}selected{/if}>50</option>
			<option value="100" {if $listing_search.listings_per_page == 100}selected{/if}>100</option>
		</select>
	
		<input type="hidden" name="restore" value="1" />
		<input type="hidden" name="page" value="1" />
	</form>
</p>

<form method="post" action="{$GLOBALS.site_url}/listing-actions/" name="resultsForm">
	<input type="hidden" name="action_name" id="action_name" value="">
	<input type="hidden" name="rejectReason" value="">
	<input type="hidden" name="days_to_change" id="days_to_change" value="">
	
	<div id="dialog" style="display: none">
		<textarea name="reason" cols="30" rows="4"></textarea>
		<span class="greenButtonEnd"><input type="submit" value="Submit Reject" class="greenButton" id="submitReject" /></span>
	</div>

	<div id="modify_date_dialog" style="display: none">
		Modify Expiration Date for <input type="text" size="2" id="days" name="days"> days
		<div class="clr"><br/></div>
		<span class="greenButtonEnd"><input type="submit" id="modify_send_button" name="modify_send_button" value="Modify" class="greenButton" /></span>
	</div>

	<p>
		Actions with Selected:<br/>
		<span class="greenButtonInEnd"><input type="submit" value="Activate" class="greenButtonIn" onclick="submitForm('activate');"></span>
		<span class="greenButtonInEnd"><input type="submit" value="Deactivate" class="greenButtonIn" onclick="submitForm('deactivate');"></span>
		<span class="deleteButtonEnd"><input type="submit" value="Delete" class="deleteButton" onclick="if ( confirm('Are you sure you want to delete this listing?') ) submitForm('delete');"></span>
		{if $showApprovalStatusField == 1}
			<span class="greenButtonInEnd"><input type="submit" value="Approve" class="greenButtonIn" onclick="submitForm('approve');"></span>
			<span class="greenButtonInEnd"><input type="submit" value="Reject" class="greenButtonIn" id="rejectButton"></span>
		{/if}
		<span class="greenButtonInEnd"><input type="button" id="modify_date_button" name="modify_date_button" value="Modify Expiration Date" class="greenButtonIn" /></span>
	</p>

<div class="clr"><br/></div>

<table>
	<thead>
		<tr>
			<th><input type="checkbox" id="all_checkboxes_control"></th>
			<th>
				<a href="?restore=1&amp;sorting_field=id&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'id'}DESC{else}ASC{/if}">ID</a>
				{if $listing_search.sorting_field == 'id'}
					{if $listing_search.sorting_order == 'ASC'}
						<img src="{image}b_up_arrow.gif" alt="Up" />
					{else}
						<img src="{image}b_down_arrow.gif" alt="Down" />
					{/if}
				{/if}
			</th>
			<th>
				<a href="?restore=1&amp;sorting_field=Title&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'Title'}DESC{else}ASC{/if}">Title</a>
				{if $listing_search.sorting_field == 'Title'}
					{if $listing_search.sorting_order == 'ASC'}
						<img src="{image}b_up_arrow.gif" alt="Up" />
					{else}
						<img src="{image}b_down_arrow.gif" alt="Down" />
					{/if}
				{/if}
			</th>
			<th>
				<a href="?restore=1&amp;sorting_field=listing_type&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'listing_type'}DESC{else}ASC{/if}">Listing Type</a>
				{if $listing_search.sorting_field == 'listing_type'}
					{if $listing_search.sorting_order == 'ASC'}
						<img src="{image}b_up_arrow.gif" alt="Up" />
					{else}
						<img src="{image}b_down_arrow.gif" alt="Down" />
					{/if}
				{/if}
			</th>
			<th>
				<a href="?restore=1&amp;sorting_field=JobCategory&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'JobCategory'}DESC{else}ASC{/if}">Job Category</a>
				{if $listing_search.sorting_field == 'JobCategory'}
					{if $listing_search.sorting_order == 'ASC'}
						<img src="{image}b_up_arrow.gif" alt="Up" />
					{else}
						<img src="{image}b_down_arrow.gif" alt="Down" />
					{/if}
				{/if}
			</th>
			<th>
				<a href="?restore=1&amp;sorting_field=activation_date&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'activation_date'}DESC{else}ASC{/if}">Activation Date</a>
				{if $listing_search.sorting_field == 'activation_date'}
					{if $listing_search.sorting_order == 'ASC'}
						<img src="{image}b_up_arrow.gif" alt="Up" />
					{else}
						<img src="{image}b_down_arrow.gif" alt="Down" />
					{/if}
				{/if}
			</th>
			<th>
				<a href="?restore=1&amp;sorting_field=expiration_date&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'expiration_date'}DESC{else}ASC{/if}">Expiration Date</a>
				{if $listing_search.sorting_field == 'expiration_date'}
					{if $listing_search.sorting_order == 'ASC'}
						<img src="{image}b_up_arrow.gif" alt="Up" />
					{else}
						<img src="{image}b_down_arrow.gif" alt="Down" />
					{/if}
				{/if}
			</th>
			<th>
				<a href="?restore=1&amp;sorting_field=username&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'username'}DESC{else}ASC{/if}">Listing User</a>
				{if $listing_search.sorting_field == 'username'}
					{if $listing_search.sorting_order == 'ASC'}
						<img src="{image}b_up_arrow.gif" alt="Up" />
					{else}
						<img src="{image}b_down_arrow.gif" alt="Down" />
					{/if}
				{/if}
			</th>
			<th>
				<a href="?restore=1&amp;sorting_field=views&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'views'}DESC{else}ASC{/if}">Views</a>
				{if $listing_search.sorting_field == 'views'}
					{if $listing_search.sorting_order == 'ASC'}
						<img src="{image}b_up_arrow.gif" alt="Up" />
					{else}
						<img src="{image}b_down_arrow.gif" alt="Down" />
					{/if}
				{/if}
			</th>
			<th>
				<a href="?restore=1&amp;sorting_field=active&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'active'}DESC{else}ASC{/if}">Status</a>
				{if $listing_search.sorting_field == 'active'}
					{if $listing_search.sorting_order == 'ASC'}
						<img src="{image}b_up_arrow.gif" alt="Up" />
					{else}
						<img src="{image}b_down_arrow.gif" alt="Down" />
					{/if}
				{/if}
			</th>
			{if $showApprovalStatusField != false }
				<th>
					<a href="?restore=1&amp;sorting_field=status&amp;sorting_order={if $listing_search.sorting_order == 'ASC' && $listing_search.sorting_field == 'status'}DESC{else}ASC{/if}">Approval Status</a>
					{if $listing_search.sorting_field == 'status'}
						{if $listing_search.sorting_order == 'DESC'}
							<img src="{image}b_up_arrow.gif" alt="Up" />
						{else}
							<img src="{image}b_down_arrow.gif" alt="Down" />
						{/if}
					{/if}
				</th>
			{/if}
			<th colspan=3 class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$listings item=listing name=listings_block}
			<tr class="{cycle values = 'evenrow,oddrow'}">
				<td><input type="checkbox" name="listings[{$listing.id}]" value="1" id="checkbox_{$smarty.foreach.listings_block.iteration}" /></td>
				<td><a href="{$GLOBALS.site_url}/display-listing/?listing_id={$listing.id}">{$listing.id}</a></td>
				<td><a href="{$GLOBALS.site_url}/display-listing/?listing_id={$listing.id}"><b>{$listing.Title}</b></a></td>
				<td>{$listing.type.id}</td>
				<td>
					{foreach from=$listing.JobCategory item=category name=jobCategory}
						{$category}{if !$smarty.foreach.jobCategory.last}, {/if}
					{/foreach}
				</td>
				<td><span title="{$listing.activation_date}">{$listing.activation_date|regex_replace:"/\s.*/":""}</span></td>
				<td><span title="{$listing.expiration_date}">{$listing.expiration_date|regex_replace:"/\s.*/":""}</span></td>
				<td><a href="mailto:{$listing.user.email}">{$listing.user.username}</a></td>
				<td>{$listing.views}</td>
				<td>{if $listing.active == 1}Active{else}Not Active{/if}</td>
		        {if $showApprovalStatusField != false }
		            <td {if $listing.reject_reason != ''}title="Reason: {$listing.reject_reason}"{/if}>
		                {foreach from=$listingsTypesInfo item='listingTypeInfo'}
		                    {if $listingTypeInfo.id == $listing.type.id && $listingTypeInfo.waitApprove}
		                        {$listing.approveStatus}
		                    {/if}
		                {/foreach}
		            </td>
		        {/if}
		        <td>
		            {if $listing.active}
		                <a href="{$GLOBALS.site_url}/listing-actions/?action_name=Deactivate&amp;listings[{$listing.id}]=1">Deactivate</a>
		            {else}
		                <a href="{$GLOBALS.site_url}/listing-actions/?action_name=Activate&amp;listings[{$listing.id}]=1">Activate</a>
		            {/if}
		        </td>
				<td><a href="{$GLOBALS.site_url}/edit-listing/?listing_id={$listing.id}" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a></td>
				<td><a href="{$GLOBALS.site_url}/listing-actions/?action_name=Delete&amp;listings[{$listing.id}]=1" onclick="return confirm('Are you sure you want to delete this listing?')" title="Delete"><img src="{image}delete.png" border="0" alt="Delete"></a></td>
			</tr>
		{/foreach}
	</tbody>
</table>

<p>
	Actions with Selected:<br/>
	<span class="greenButtonInEnd"><input type="submit" value="Activate" class="greenButtonIn" onclick="submitForm('activate');" /></span>
	<span class="greenButtonInEnd"><input type="submit" value="Deactivate" class="greenButtonIn" onclick="submitForm('deactivate');" /></span>
	<span class="deleteButtonEnd"><input type="submit" value="Delete" class="deleteButton" onclick="if ( confirm('Are you sure you want to delete this listing?') ) submitForm('delete');" /></span>
	{if $showApprovalStatusField == 1}
		<span class="greenButtonInEnd"><input type="submit" value="Approve" class="greenButtonIn" onclick="submitForm('approve');" /></span>
		<span class="greenButtonInEnd"><input type="submit" value="Reject" class="greenButtonIn" id="rejectButton" /></span>
	{/if}
	<span class="greenButtonInEnd"><input type="button" id="modify_date_button" name="modify_date_button" value="Modify Expiration Date" class="greenButtonIn" /></span>
</p>
</form>

<div class="clr"><br/></div>
<p>
	{if $listing_search.current_page-1 > 0}&nbsp;<a href="?restore=1&amp;page={$listing_search.current_page-1}">&#171; Previous</a>{else}&#171; Previous{/if}
	{if $listing_search.current_page-3 > 0}&nbsp;<a href="?restore=1&amp;page=1">1</a>{/if}
	{if $listing_search.current_page-3 > 1}&nbsp;...{/if}
	{if $listing_search.current_page-2 > 0}&nbsp;<a href="?restore=1&amp;page={$listing_search.current_page-2}">{$listing_search.current_page-2}</a>{/if}
	{if $listing_search.current_page-1 > 0}&nbsp;<a href="?restore=1&amp;page={$listing_search.current_page-1}">{$listing_search.current_page-1}</a>{/if}
	<strong>{$listing_search.current_page}</strong>
	{if $listing_search.current_page+1 <= $listing_search.pages_number}&nbsp;<a href="?restore=1&amp;page={$listing_search.current_page+1}">{$listing_search.current_page+1}</a>{/if}
	{if $listing_search.current_page+2 <= $listing_search.pages_number}&nbsp;<a href="?restore=1&amp;page={$listing_search.current_page+2}">{$listing_search.current_page+2}</a>{/if}
	{if $listing_search.current_page+3 < $listing_search.pages_number}&nbsp;...{/if}
	{if $listing_search.current_page+3 < $listing_search.pages_number + 1}&nbsp;<a href="?restore=1&amp;page={$listing_search.pages_number}">{$listing_search.pages_number}</a>{/if}
	{if $listing_search.current_page+1 <= $listing_search.pages_number}&nbsp;<a href="?restore=1&amp;page={$listing_search.current_page+1}">Next &#187;</a>{else}Next &#187;{/if}
</p>

<script>
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
	
	function submitForm(action) {
		document.getElementById('action_name').value = action;
		var form = document.resultsForm;
		form.submit();
	}
	{/literal}
</script>