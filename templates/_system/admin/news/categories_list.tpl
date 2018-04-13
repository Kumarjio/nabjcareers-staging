{breadcrumbs}News Categories{/breadcrumbs}
<h1>News Categories</h1>

<form action="{$GLOBALS.site_url}/news-categories/">
	<input type="hidden" name="action" value="save_display_setting" />
	<table>
		<tr id="clearTable">
				<td>News Block Display On Front-end &nbsp;</td>
				<td align=center>
					<select name="settings[show_news_on_main_page]">
						<option value="0"{if $show_news_on_main_page == 0} selected="selected"{/if}>disable</option>
						<option value="1"{if $show_news_on_main_page == 1} selected="selected"{/if}>enable</option>
					</select>
				</td>
				<td></td>
		</tr>
		<tr  id="clearTable">
			<td>Number of News to Display on Homepage</td>
			<td><input type="text" name="settings[number_news_on_main_page]" value="{$number_news_on_main_page}" /></td>
			<td><span class="greenButtonEnd"><input type="submit" name="news_switch" value="Save" class="greenButton" /></span></td>
		</tr>
	</table>
</form>

<div class="clr"><br /></div>
{foreach from=$errors item=error}
	<p class="error">{$error}</p>
{/foreach} 

<form action="{$GLOBALS.site_url}/system/news/" method=post>
	<fieldset>
		<legend>Add a New Category</legend>
		<input type= "hidden" name="action" value= "add">
		<table class="fieldset">
			<tr class="">
				<td>Category Name</td>
				<td><input type="text" name="category_name" value=""></td>
				<td></td>
				<td><span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton" /></span></td>
			</tr>
		</table>
	</fieldset>
</form>

<div class="clr"><br /></div>

<form method="post" action="{$GLOBALS.site_url}/news-categories/" name="resultsForm">
	<input type="hidden" name="action" id="action" value="">
	<table>
		<thead>
			<tr>
				<th>Category Name</th>
				<th>Number of News</th>
				<th colspan="2" class="actions">Actions</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbodY>
			{foreach from=$categories item=item name=categories}
				{if $item.name != 'archive' && $item.name != 'Archive'}
				<tr class="{cycle values = 'evenrow,oddrow' advance=false}" onmouseover="this.className='highlightrow'" onmouseout="this.className='{cycle values = 'evenrow,oddrow'}'">
					<td>{$item.name}</td>
					<td>{$item.count}</td>
					<td><a href="{$GLOBALS.site_url}/news-categories/?action=edit&category_sid={$item.sid}" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a></td>
					<td><a href="{$GLOBALS.site_url}/news-categories/?action=delete&categories[{$item.sid}]=1" onclick="return confirm('All News of this Category will be deleted as well. Delete this Category?')" title="Delete"><img src="{image}delete.png" border=0 alt="Delete"></a></td>
					<td>
						{if $smarty.foreach.categories.iteration < $smarty.foreach.categories.total}
							<a href="?category_sid={$item.sid}&amp;action=move_down"><img src="{image}b_down_arrow.gif" border="0" alt=""/></a>
						{/if} 
					</td>
					<td>
						{if $smarty.foreach.categories.iteration > 1}
							<a href="?category_sid={$item.sid}&amp;action=move_up"><img src="{image}b_up_arrow.gif" border="0" alt=""/></a>
						{/if} 
					</td>
				</tr>
				{/if}
			{/foreach}
		</tbodY>
	</table>
</form>

<br/><a href="{$GLOBALS.site_url}/news-categories/?action=edit&category_sid={$archive_category.sid}">View Archive</a>

<script>
	{literal}
		function submitForm(action) {
			document.getElementById('action').value = action;
			var form = document.resultsForm;
			form.submit();
		}
	{/literal}
</script>