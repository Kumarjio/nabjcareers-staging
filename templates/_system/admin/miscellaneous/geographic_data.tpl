{breadcrumbs}ZipCode Database {/breadcrumbs}
<h1>ZipCode Database </h1>
{foreach from=$errors item=error key=field_caption}
	{if $error eq 'EMPTY_VALUE'}
		<p class="error">'{$field_caption}' is empty</p>
	{elseif $error eq 'NOT_UNIQUE_VALUE'}
		<p class="error">'{$field_caption}' this value is already used in the system</p>
	{elseif $error eq 'NOT_CONFIRMED'}
		<p class="error">'{$field_caption}' not confirmed</p>
	{elseif $error eq 'DATA_LENGTH_IS_EXCEEDED'}
		<p class="error">'{$field_caption}' length is exceeded</p>
	{elseif $error eq 'NOT_INT_VALUE'}
		<p class="error">'{$field_caption}' is not an integer value</p>
	{elseif $error eq 'OUT_OF_RANGE'}
		<p class="error">'{$field_caption}' value is out of range</p>
	{elseif $error eq 'NOT_FLOAT_VALUE'}
		<p class="error">'{$field_caption}' is not an float value</p>
	{/if}
{/foreach}

<fieldset>
	<legend>Add a New Location</legend>
	<form method="post">
	<input type="hidden" name="action" value="add">
		<table>
			<tr>
				<td>Name</td>
				<td><input type="text" name="name" value="{$location_info.name}"> <font color="red">*</font></td>
			</tr>
			<tr>
				<td>Longitude</td>
				<td><input type="text" name="longitude" value="{$location_info.longitude}"> <font color="red">*</font></td>
			</tr>
			<tr>
				<td>Latitude</td>
				<td><input type="text" name="latitude" value="{$location_info.latitude}"> <font color="red">*</font></td>
			</tr>
			<tr>
				<td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton" /></span></td></tr>
		</table>
	</form>
</fieldset>

<p><a href="?action=clear_data" onclick="return confirm('Are you sure you want to clear all geographical data?')">Clear data</a></p>
<p><a href="{$GLOBALS.site_url}/geographic-data/import-data/">Import data from file</a></p>

<div class="setting_button" id="mediumButton"><strong>Click to modify search criteria</strong><div class="setting_icon"><div id="accordeonClosed"></div></div></div>
<div class="setting_block" style="display: none"  id="clearTable">
	<form method="get" name="search_form" >
		<table  width="100%">
			<tr>
				<td>Name</td>
				<td><input type="text" name="search[name]" value="{$search.name}"></td>
			</tr>
			<tr>
				<td>Longitude</td>
				<td><input type="text" name="search[longitude]" value="{$search.longitude}"></td>
			</tr>
			<tr>
				<td>Latitude</td>
				<td><input type="text" name="search[latitude]" value="{$search.latitude}"></td>
			</tr>
			<tr>
				<td colspan="2">
		            <input type="hidden" name="action" value="search" />
					<span class="greenButtonEnd"><input type="submit" value="Search" class="greenButton" /></span>
				</td>
		</table>
	</form>
</div>
<div class="actionSelected">
{if $page_count > 1}
	<p>
		{if $page_number-1 > 0}<a href="?page_number={$page_number-1}">Previous</a>{/if}
		{if $page_number-3 > 0}<a href="?page_number=1">1</a>{/if}
		{if $page_number-3 > 1}...{/if}
		{if $page_number-2 > 0}<a href="?page_number={$page_number-2}">{$page_number-2}</a>{/if}
		{if $page_number-1 > 0}<a href="?page_number={$page_number-1}">{$page_number-1}</a>{/if}
		<strong>{$page_number}</strong>
		{if $page_number+1 <= $page_count}<a href="?page_number={$page_number+1}">{$page_number+1}</a>{/if}
		{if $page_number+2 <= $page_count}<a href="?page_number={$page_number+2}">{$page_number+2}</a>{/if}
		{if $page_number+3 < $page_count}...{/if}
		{if $page_number+3 < $page_count + 1}<a href="?page_number={$page_count}">{$page_count}</a>{/if}
		{if $page_number+1 <= $page_count}<a href="?page_number={$page_number+1}">Next</a>{/if}
	</p>
{/if}
</div>
<div class="numberPerPage">
	<strong>[[Number of zip codes per page]]:</strong>
	<select id="zip_codes_per_page" name="zip_codes_per_page" onchange="window.location = '?&zip_codes_per_page='+this.value+'&{$query}';" class="perPage">
		<option value="10" {if $zip_codes_per_page == 10}selected="selected"{/if}>10</option>
		<option value="20" {if $zip_codes_per_page == 20}selected="selected"{/if}>20</option>
		<option value="50" {if $zip_codes_per_page == 50}selected="selected"{/if}>50</option>
		<option value="100" {if $zip_codes_per_page == 100}selected="selected"{/if}>100</option>
	</select>
</div>

<div class="clr"><br/></div>
<form method="post" name="locations_form">
	<input type="hidden" name="action_name" id="action_name" value="" />
	
	<span class="deleteButtonEnd"><input type="button" name="action" value="Delete" class="deleteButton" onclick="if ( confirm('Are you sure you want to delete selected ZipCode(s)?') ) submitForm('delete');"></span>
	<div class="clr"><br/></div>
	
	<table>
		<thead>
			<tr>
				<th><input type="checkbox" id="all_checkboxes_control"></th>
				<th><a href="?sorting_field=name&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'name'}DESC{else}ASC{/if}&zip_codes_per_page={$zip_codes_per_page}{if $online==1}&online=1{/if}">Name</a>
				{if $sorting_field == 'name'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
				</th>
				<th><a href="?sorting_field=longitude&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'longitude'}DESC{else}ASC{/if}&zip_codes_per_page={$zip_codes_per_page}{if $online==1}&online=1{/if}">Longitude</a>
				{if $sorting_field == 'longitude'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
				</th>
				<th><a href="?sorting_field=latitude&sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'latitude'}DESC{else}ASC{/if}&zip_codes_per_page={$zip_codes_per_page}{if $online==1}&online=1{/if}">Latitude</a>
				{if $sorting_field == 'latitude'}{if $sorting_order == 'ASC'}<img src="{image}b_down_arrow.gif">{else}<img src="{image}b_up_arrow.gif">{/if}{/if}
				</th>
				<th colspan=2 class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$location_collection item=location name=location_block}
			<tr class="{cycle values='oddrow,evenrow'}">
				<td><input type="checkbox" name="locations[{$location.sid}]" value="1" id="checkbox_{$smarty.foreach.location_block.iteration}" /></td>
				<td>{$location.name}</td>
				<td>{$location.longitude}</td>
				<td>{$location.latitude}</td>
				<td><a href="{$GLOBALS.site_url}/geographic-data/edit-location/?sid={$location.sid}" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a></td>
				<td><a href="?action=delete&location_sid={$location.sid}" onclick="return confirm('Are you sure you want to delete this data?')" title="Delete"><img src="{image}delete.png" border=0 alt="Delete"></a></td>
			</tr>
			{/foreach}
		</tbody>
	</table>
	
	<div class="clr"><br/></div>
	<span class="deleteButtonEnd"><input type="button" name="action" value="Delete" class="deleteButton" onclick="if (confirm('Are you sure you want to delete selected ZipCode(s)?')) submitForm('delete');"></span>
</form>
<script>
	var total={$smarty.foreach.location_block.total};
	{literal}
	
	
	function set_checkbox(param) {
		for (i = 1; i <= total; i++) {
			if (checkbox = document.getElementById('checkbox_' + i))
				checkbox.checked = param;
		}
	}
	
	$("#all_checkboxes_control").click(function() {
		if (this.checked == false)
			set_checkbox(false);
		else
			set_checkbox(true);
	});
	
	
	function submitForm(action) {
		document.getElementById('action_name').value = action;
		var form = document.locations_form;
		form.submit();
	}

	$(".setting_button").click(function(){
		var butt = $(this);
		$(this).next(".setting_block").slideToggle("normal", function(){
				if ($(this).css("display") == "block") {
					butt.children(".setting_icon").html("<div id='accordeonOpen'></div>");
					butt.children("strong").text("Click to hide search criteria");
				} else {
					butt.children(".setting_icon").html("<div id='accordeonClosed'></div>");
					butt.children("strong").text("Click to modify search criteria");
				}
			});
	});
	{/literal}
	{if $search}
		{literal}
		var butt = $(".setting_button");
		butt.next(".setting_block").slideToggle("normal", function(){
			butt.children(".setting_icon").html("<div id='accordeonOpen'></div>");
			butt.children("strong").text("Click to hide search criteria");
		});
		{/literal}
	{/if}
</script>
