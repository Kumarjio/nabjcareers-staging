{if $category.name != 'Archive'}
	{breadcrumbs}<a href="{$GLOBALS.site_url}/news-categories/">News Categories</a> &#187; {$category.name} &#187; Edit Category{/breadcrumbs}
	<h1>Edit Category</h1>
	
	{foreach from=$errors item=error}
		<p class="error">{$error}</p>
	{/foreach}
	
	<form action="{$GLOBALS.site_url}/news-categories/" method=post>
		<fieldset>
			<legend>Edit Category</legend>
			<input type="hidden" name="action" value= "edit">
			<input type="hidden" name="category_sid" value="{$category.sid}" />
			<table class="fieldset">
				<tr class="">
					<td>Category Name</td>
					<td><input type="text" name="category_name" value="{$category.name}"></td>
					<td></td>
					<td><span class="greenButtonEnd"><input type="submit" name="submit" value="Update" class="greenButton" /></span></td>
				</tr>
			</table>
		</fieldset>
	</form>
	
	<p><a href="{$GLOBALS.site_url}/manage-news/?action=add&category_sid={$category.sid}">Add News</a></p>
{else}
	{breadcrumbs}<a href="{$GLOBALS.site_url}/news-categories/">News Categories</a> &#187; {$category.name} &#187; View{/breadcrumbs}
	<h1>View Archive</h1>
{/if}
<div style="display:inline-block;">
<div class="numberPerPage">
	<form id="news_per_page_form" method="get" action="{$GLOBALS.site_url}/news-categories/">
		<input type="hidden" name="action" value="edit" />
		<input type="hidden" name="category_sid" value="{$category.sid}" />
		
		<span style="padding-left:50px">Number of Articles per page:</span>
		<select name="items_per_page" onchange="submit()" class="perPage">
			<option value="10" {if $items_per_page == 10}selected{/if}>10</option>
			<option value="20" {if $items_per_page == 20}selected{/if}>20</option>
			<option value="50" {if $items_per_page == 50}selected{/if}>50</option>
			<option value="100" {if $items_per_page == 100}selected{/if}>100</option>
		</select>
		<div class="clr"><br/></div>
		<div style="text-align: right;">
			{if $current_page-1 > 0}&nbsp;<a href="?page={$current_page-1}">&lt;Previous</a>{else}&#171; Previous{/if}
			{if $current_page-3 > 0}&nbsp;<a href="?page=1">1</a>{/if}
			{if $current_page-3 > 1}&nbsp;...{/if}
			{if $current_page-2 > 0}&nbsp;<a href="?page={$current_page-2}">{$current_page-2}</a>{/if}
			{if $current_page-1 > 0}&nbsp;<a href="?page={$current_page-1}">{$current_page-1}</a>{/if}
			<strong>{$current_page}</strong>
			{if $current_page+1 <= $pages}&nbsp;<a href="?page={$current_page+1}">{$current_page+1}</a>{/if}
			{if $current_page+2 <= $pages}&nbsp;<a href="?page={$current_page+2}">{$current_page+2}</a>{/if}
			{if $current_page+3 < $pages}&nbsp;...{/if}
			{if $current_page+3 < $pages + 1}&nbsp;<a href="?page={$pages}">{$pages}</a>{/if}
			{if $current_page+1 <= $pages}&nbsp;<a href="?page={$current_page+1}">Next&gt;</a>{else}Next &#187;{/if}
		</div>
		
		<input type="hidden" name="page" value="1" />
	</form>
</div>
<div class="clr"><br/></div>

<form method="post" action="{$GLOBALS.site_url}/manage-news/" name="resultsForm">
	<input type="hidden" name="category_sid" value="{$category.sid}" />
	<input type="hidden" name="action" id="action" value="">
	
	Actions with Selected:<br>
	{if $category.name != 'Archive'}
		<span class="greenButtonInEnd"><input type="submit" value="Activate" class="greenButtonIn" onclick="submitForm('activate');"></span>
		<span class="greenButtonInEnd"><input type="submit" value="Deactivate" class="greenButtonIn" onclick="submitForm('deactivate');"></span>
		<span class="greenButtonInEnd"><input type="submit" value="Archive" class="greenButtonIn" onclick="if ( confirm('Are you sure you want to move the selected News to archive?') ) submitForm('archive');"></span>
	{/if}
		<span class="deleteButtonEnd"><input type="submit" value="Delete" class="deleteButton" onclick="if ( confirm('Are you sure you want to delete the selected News?') ) submitForm('delete');"></span>
	<div class="clr"><br/></div>
	
	<table>
		<thead>
			<tr>
				<th><input type="checkbox" id="all_checkboxes_control"></th>
				<th>
					<a href="{$GLOBALS.site_url}/news-categories/?action=edit&category_sid={$category.sid}&restore=1&amp;sorting_field=id&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'id'}DESC{else}ASC{/if}">ID</a>
					{if $sorting_field == 'id'}
						{if $sorting_order == 'ASC'}
							<img src="{image}b_up_arrow.gif" alt="Up" />
						{else}
							<img src="{image}b_down_arrow.gif" alt="Down" />
						{/if}
					{/if}
				</th>
				<th>
					<a href="{$GLOBALS.site_url}/news-categories/?action=edit&category_sid={$category.sid}&restore=1&amp;sorting_field=title&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'title'}DESC{else}ASC{/if}">Title</a>
					{if $sorting_field == 'title'}
						{if $sorting_order == 'ASC'}
							<img src="{image}b_up_arrow.gif" alt="Up" />
						{else}
							<img src="{image}b_down_arrow.gif" alt="Down" />
						{/if}
					{/if}
				</th>
				<th>
					<a href="{$GLOBALS.site_url}/news-categories/?action=edit&category_sid={$category.sid}&restore=1&amp;sorting_field=date&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'date'}DESC{else}ASC{/if}">Publication Date</a>
					{if $sorting_field == 'date'}
						{if $sorting_order == 'ASC'}
							<img src="{image}b_up_arrow.gif" alt="Up" />
						{else}
							<img src="{image}b_down_arrow.gif" alt="Down" />
						{/if}
					{/if}
				</th>
				<th>
					<a href="{$GLOBALS.site_url}/news-categories/?action=edit&category_sid={$category.sid}&restore=1&amp;sorting_field=expiration_date&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'expiration_date'}DESC{else}ASC{/if}">Expiration Date</a>
					{if $sorting_field == 'expiration_date'}
						{if $sorting_order == 'ASC'}
							<img src="{image}b_up_arrow.gif" alt="Up" />
						{else}
							<img src="{image}b_down_arrow.gif" alt="Down" />
						{/if}
					{/if}
				</th>
				
			{if $category.name != 'Archive'}
				<th>
					<a href="{$GLOBALS.site_url}/news-categories/?action=edit&category_sid={$category.sid}&restore=1&amp;sorting_field=active&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'active'}DESC{else}ASC{/if}">Status</a>
					{if $sorting_field == 'active'}
						{if $sorting_order == 'ASC'}
							<img src="{image}b_up_arrow.gif" alt="Up" />
						{else}
							<img src="{image}b_down_arrow.gif" alt="Down" />
						{/if}
					{/if}
				</th>
			{/if}
			
				<th>
					<a href="{$GLOBALS.site_url}/news-categories/?action=edit&category_sid={$category.sid}&restore=1&amp;sorting_field=link&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'link'}DESC{else}ASC{/if}">URL</a>
					{if $sorting_field == 'link'}
						{if $sorting_order == 'ASC'}
							<img src="{image}b_up_arrow.gif" alt="Up" />
						{else}
							<img src="{image}b_down_arrow.gif" alt="Down" />
						{/if}
					{/if}
				</th>
				
				<th>
					<a href="{$GLOBALS.site_url}/news-categories/?action=edit&category_sid={$category.sid}&restore=1&amp;sorting_field=lang&amp;sorting_order={if $sorting_order == 'ASC' && $sorting_field == 'lang'}DESC{else}ASC{/if}">Language</a>
					{if $sorting_field == 'lang'}
						{if $sorting_order == 'ASC'}
							<img src="{image}b_up_arrow.gif" alt="Up" />
						{else}
							<img src="{image}b_down_arrow.gif" alt="Down" />
						{/if}
					{/if}
				</th>
	
				<th colspan="2" class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$articles item=item name=news_block}
			<tr class="{cycle values = 'evenrow,oddrow'}">
				<td><input type="checkbox" name="news[{$item.sid}]" value="1" id="checkbox_{$smarty.foreach.news_block.iteration}"></td>
				<td>{$item.sid}</td>
				<td>{$item.title}</td>
				<td>{tr type='date'}{$item.date}{/tr}</td>
				<td>{if empty($item.expiration_date)}Never Expire{else}{tr type='date'}{$item.expiration_date}{/tr}{/if}</td>
				
				{if $category.name != 'Archive'}
					<td>{if $item.active == 1}Active{else}Not&nbsp;Active{/if}</td>
				{/if}
			
				<td>{$item.link}</td>
				<td>
					{foreach from=$GLOBALS.languages item=language}
						{if $language.id == $item.lang}{$language.caption}{/if}
					{/foreach}
				</td>
				<td><a href="{$GLOBALS.site_url}/manage-news/?action=edit&article_sid={$item.sid}&category_sid={$category.sid}" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a></td>
				<td><a href="{$GLOBALS.site_url}/manage-news/?action=delete&news[{$item.sid}]=1&category_sid={$category.sid}" onclick="return confirm('Are you sure you want to delete the selected News?')" title="Delete"><img src="{image}delete.png" border=0 alt="Delete"></a></td>
			</tr>
			{/foreach}
		</tbody>
	</table>

</form>
</div>


<script>
var total={$smarty.foreach.news_block.total};
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
	document.getElementById('action').value = action;
	var form = document.resultsForm;
	form.submit();
}

{/literal}
</script>