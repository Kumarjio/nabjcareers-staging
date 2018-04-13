{breadcrumbs}Flagged Listings{/breadcrumbs}
<h1>Flagged Listings</h1>

<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.bgiframe.js"></script>
{literal}
	<script type="text/javascript">
		$.ui.dialog.defaults.bgiframe = true;
		var progbar = "<img src='{/literal}{$GLOBALS.site_url}/../system/ext/jquery/progbar.gif{literal}'>";
		var parentReload = true;
		$(function() {
			$("a.editListing, a.editUser").click(function(){
				$("#messageBox").dialog('destroy');
				$("#messageBox").attr({title: "Loading"});
				$("#messageBox").html(progbar).dialog({width: 180});
				var link = $(this).attr("href");
				$.get(link, function(data){
					$("#messageBox").dialog('destroy');
					$("#messageBox").attr({title: "Edit User Listing"});
					$("#messageBox").html(data).dialog({
						width: 570,
						height: 500,
						close: function(event, ui) {
							if(parentReload == true) {
								parent.document.location.reload();
						}}
						
					});
				}, 'html');
				return false;
			});
			
		});
	{/literal}
	</script>

	<form name="filter">
		<input type="hidden" name="sorting_order" value="{$sorting_order}" />
		<input type="hidden" name="sorting_field" value="{$sorting_field}" />
		<fieldset id="filter_fieldset">
			<legend>Filter By</legend>
			<table>
				<thead>
					<tr>
						<th>Listing Type</th>
						<th>Title</th>
						<th>Listing Owner</th>
						<th>Flag</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<select name="listing_type">
								<option value="">All</option>
								{foreach from=$listing_types item=type key=key}
									<option value="{$type.sid}" {if $type.sid == $listing_type_sid}selected="selected"{/if}>{$type.id}</option>
								{/foreach}
							</select>
						</td>
						<td><input type="text" name="filter_title"  value="{$filters.title}"/></td>
						<td><input type="text" name="filter_user" value="{$filters.username}"/></td>
						<td>
							<select name="filter_flag">
								<option value="">All</option>
									{foreach from=$all_flags item=flag}
										<option value="{$flag.sid}" {if $flag.sid == $filters.flag} selected="selected"{/if}>{$flag.value}</option>
									{/foreach}
							</select>
						</td>
						<td><input name="action" value="filter" type="hidden"><span class="greenButtonEnd"><input value="Filter" type="submit" class="greenButton" /></span></td>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</form>


<p>
	<form id="listings_per_page_form" method="get" action="?">
		{if $current_page-1 > 0}&nbsp;<a href="?restore=1&amp;page={$current_page-1}">&#171; Previous</a>{else}&#171; Previous{/if}
		{if $current_page-3 > 0}&nbsp;<a href="?restore=1&amp;page=1">1</a>{/if}
		{if $current_page-3 > 1}&nbsp;...{/if}
		{if $current_page-2 > 0}&nbsp;<a href="?restore=1&amp;page={$current_page-2}">{$current_page-2}</a>{/if}
		{if $current_page-1 > 0}&nbsp;<a href="?restore=1&amp;page={$current_page-1}">{$current_page-1}</a>{/if}
		<strong>{$current_page}</strong>
		{if $current_page+1 <= $pages}&nbsp;<a href="?restore=1&amp;page={$current_page+1}">{$current_page+1}</a>{/if}
		{if $current_page+2 <= $pages}&nbsp;<a href="?restore=1&amp;page={$current_page+2}">{$current_page+2}</a>{/if}
		{if $current_page+3 < $pages}&nbsp;...{/if}
		{if $current_page+3 < $pages + 1}&nbsp;<a href="?restore=1&amp;page={$listing_search.pages_number}">{$pages}</a>{/if}
		{if $current_page+1 <= $pages}&nbsp;<a href="?restore=1&amp;page={$current_page+1}">Next&#187; </a>{else}Next&#187; {/if}

		<span style="padding-left:50px">Number of listings per page:</span>
		<select name="per_page" onchange="submit()" class="perPage">
			<option value="10" {if $per_page == 10}selected{/if}>10</option>
			<option value="20" {if $per_page == 20}selected{/if}>20</option>
			<option value="50" {if $per_page == 50}selected{/if}>50</option>
			<option value="100" {if $per_page == 100}selected{/if}>100</option>
		</select>
		<input type="hidden" name="restore" value="1" />
		<input type="hidden" name="page" value="1" />
	</form>
</p>
<p><strong>Total Flags:</strong> {$total_flags_number}</p>
<form method="post" name="flagged_listings_form">
	<input name="action_name" id="action_name" value="" type="hidden">
	<input name="restore" id="restore" value="1" type="hidden">
	<span class="greenButtonInEnd"><input name="action" value="Remove Flag" class="greenButtonIn" onclick="if ( confirm('Are you sure you want to remove flag from selected listing(s)?') ) submitForm('remove');" type="button"></span>
	<span class="greenButtonInEnd"><input name="action" value="Deactivate Listing" class="greenButtonIn" onclick="if ( confirm('Are you sure you want to deactivate selected listing(s)?') ) submitForm('deactivate');" type="button"></span>
	<span class="greenButtonInEnd"><input name="action" value="Delete Listing" class="greenButtonIn" onclick="if ( confirm('Are you sure you want to delete this Flag Reason?') ) submitForm('delete');" type="button"></span>
	<div class="clr"><br/></div>
	<table>
		<thead>
			<tr class="headrow">
				<th><input id="all_checkboxes_control" type="checkbox"></th>
				<th>
					<a href="?restore=1&amp;sorting_field=sid&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'sid'}DESC{else}ASC{/if}&amp;page={$current_page}">ID</a>
						{if $sorting_field == 'sid'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.gif" alt="Up" />{else}<img src="{image}b_down_arrow.gif" alt="Down" />{/if}{/if}
				</th>
				<th>
					<a href="?restore=1&amp;sorting_field=title&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'title'}DESC{else}ASC{/if}&amp;page={$current_page}">Title</a>
						{if $sorting_field == 'title'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.gif" alt="Up" />{else}<img src="{image}b_down_arrow.gif" alt="Down" />{/if}{/if}
				</th>
				<th>
					<a href="?restore=1&amp;sorting_field=active&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'active'}DESC{else}ASC{/if}&amp;page={$current_page}">Status</a>
						{if $sorting_field == 'active'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.gif" alt="Up" />{else}<img src="{image}b_down_arrow.gif" alt="Down" />{/if}{/if}
				</th>
				<th>
					<a href="?restore=1&amp;sorting_field=username&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'username'}DESC{else}ASC{/if}&amp;page={$current_page}">Listing Owner</a>
						{if $sorting_field == 'username'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.gif" alt="Up" />{else}<img src="{image}b_down_arrow.gif" alt="Down" />{/if}{/if}
				</th>
				<th>
					<a href="?restore=1&amp;sorting_field=flag_user&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'flag_user'}DESC{else}ASC{/if}&amp;page={$current_page}">Flagged By</a>
						{if $sorting_field == 'flag_user'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.gif" alt="Up" />{else}<img src="{image}b_down_arrow.gif" alt="Down" />{/if}{/if}
				</th>
				<th>
					<a href="?restore=1&amp;sorting_field=date&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'date'}DESC{else}ASC{/if}&amp;page={$current_page}">Flag Date</a>
						{if $sorting_field == 'date'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.gif" alt="Up" />{else}<img src="{image}b_down_arrow.gif" alt="Down" />{/if}{/if}
				</th>
				<th>
					<a href="?restore=1&amp;sorting_field=flag_reason&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'flag_reason'}DESC{else}ASC{/if}&amp;page={$current_page}">Flag Reason</a>
						{if $sorting_field == 'flag_reason'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.gif" alt="Up" />{else}<img src="{image}b_down_arrow.gif" alt="Down" />{/if}{/if}
				</th>
				<th>
					<a href="?restore=1&amp;sorting_field=comment&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'comment'}DESC{else}ASC{/if}&amp;page={$current_page}">Comment</a>
						{if $sorting_field == 'comment'}{if $sorting_order == 'ASC'}<img src="{image}b_up_arrow.gif" alt="Up" />{else}<img src="{image}b_down_arrow.gif" alt="Down" />{/if}{/if}
				</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$listings item=elem name=flagged_block}
				<tr class="{cycle values="oddrow,evenrow"}">
					<td><input type="checkbox" name="flagged[{$elem.sid}]" value="1" id="checkbox_{$smarty.foreach.flagged_block.iteration}" /></td>
					<td>{$elem.sid}</td>
					<td>
						{if $elem.listing_info.Title}
							<a href="{$GLOBALS.site_url}/edit-listing/?listing_id={$elem.listing_sid}" target="_blank" class="editListing">{$elem.listing_info.Title}</a>
						{else}
							{$elem.listing_sid} (deleted)
						{/if}
					</td>
					<td>{if $elem.listing_info.active == 0}Not Active{else}Active{/if}</td>
					<td><a href="{$GLOBALS.site_url}/edit-user/?username={$elem.user_info.username}" target="_blank" class="editUser">{$elem.user_info.username}</a></td>
					<td>{if empty($elem.flagged_user)}anonymous{else}<a href="{$GLOBALS.site_url}/edit-user/?username={$elem.flagged_user.username}" target="_blank" class="editUser">{$elem.flagged_user.username}</a>{/if}</td>
					<td>{$elem.date|truncate:"10":''}</td>
					<td>{$elem.flag_reason}</td>
					<td>{$elem.comment}</td>
				</tr>
			{/foreach}
		</tbody>
	</table>
	<div class="clr"><br/></div>
	<span class="greenButtonInEnd"><input name="action" value="Remove Flag" class="greenButtonIn" onclick="if ( confirm('Are you sure you want to remove flag from selected listing(s)?') ) submitForm('remove');" type="button"></span>
	<span class="greenButtonInEnd"><input name="action" value="Deactivate Listing" class="greenButtonIn" onclick="if ( confirm('Are you sure you want to deactivate selected listing(s)?') ) submitForm('deactivate');"  type="button"/></span>
	<span class="greenButtonInEnd"><input name="action" value="Delete Listings" class="greenButtonIn" onclick="if ( confirm('Are you sure you want to delete selected listing(s)?') ) submitForm('delete');" type="button" /></span>
</form>
<div class="clr"><br/></div>
<form id="listings_per_page_form" method="get" action="?">
	{if $current_page-1 > 0}&nbsp;<a href="?restore=1&amp;page={$current_page-1}">&#171; Previous</a>{else}&#171; Previous{/if}
	{if $current_page-3 > 0}&nbsp;<a href="?restore=1&amp;page=1">1</a>{/if}
	{if $current_page-3 > 1}&nbsp;...{/if}
	{if $current_page-2 > 0}&nbsp;<a href="?restore=1&amp;page={$current_page-2}">{$current_page-2}</a>{/if}
	{if $current_page-1 > 0}&nbsp;<a href="?restore=1&amp;page={$current_page-1}">{$current_page-1}</a>{/if}
	<b>{$current_page}</b>
	{if $current_page+1 <= $pages}&nbsp;<a href="?restore=1&amp;page={$current_page+1}">{$current_page+1}</a>{/if}
	{if $current_page+2 <= $pages}&nbsp;<a href="?restore=1&amp;page={$current_page+2}">{$current_page+2}</a>{/if}
	{if $current_page+3 < $pages}&nbsp;...{/if}
	{if $current_page+3 < $pages + 1}&nbsp;<a href="?restore=1&amp;page={$listing_search.pages_number}">{$pages}</a>{/if}
	{if $current_page+1 <= $pages}&nbsp;<a href="?restore=1&amp;page={$current_page+1}">Next &#187;</a>{else}Next &#187;{/if}

	<span style="padding-left:50px">Number of listings per page:</span>
	<select name="per_page" onchange="submit()" class="perPage">
		<option value="10" {if $per_page == 10}selected{/if}>10</option>
		<option value="20" {if $per_page == 20}selected{/if}>20</option>
		<option value="50" {if $per_page == 50}selected{/if}>50</option>
		<option value="100" {if $per_page == 100}selected{/if}>100</option>
	</select>
	<input type="hidden" name="restore" value="1" />
	<input type="hidden" name="page" value="1" />
</form>
<script>
	var total={$smarty.foreach.flagged_block.total};
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
		var form = document.flagged_listings_form;
		form.submit();
	}
	
	{/literal}
</script>