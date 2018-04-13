{breadcrumbs}
	<a href="{$GLOBALS.site_url}/news-categories/">News Categories</a> 
	&#187; <a href="{$GLOBALS.site_url}/news-categories/?action=edit&amp;category_sid={$category.sid}">{$category.name}</a>
	&#187; <a href="{$GLOBALS.site_url}/news-categories/?action=edit&amp;category_sid={$category.sid}">Edit Category</a> 
	&#187; Edit Article
{/breadcrumbs}

<h1>Edit Article</h1>

{foreach from=$errors item=error key=error_code}
	<p class="error">{$error_code}</p>
{/foreach} 


<fieldset>
	<legend>Edit Article</legend>
	<form method="post" action="" enctype="multipart/form-data">
		<input type="hidden" name="category_sid" value="{$category.sid}" />
		<input type="hidden" name="article_sid" value="{$article_sid}" />
		<input type="hidden" name="action" value="edit" />
		<table>
			<tr>
				<td valign="top">Title:</td>
				<td><input type="text" name="article_title" value="{$article_title}" style="width: 600px;"></td>
			</tr>
			
			<tr class="">
				<td>Language</td>
				<td>
				<select name="article_language">
				{foreach from=$GLOBALS.languages item=language}
					<option value="{$language.id}"{if $language.id == $article_language} selected="selected"{/if}>{$language.caption}</option>
				{/foreach}
				</td>
			</tr>
			
			<tr>
				<td valign="top">Brief Text:</td>
				<td>{WYSIWYGEditor name="article_brief" class="inputText" width="600" height="200" type="fckeditor" value=$article_brief conf="BasicAdmin"}</td>
			</tr>
			
			<tr>
				<td valign="top">Full Text:</td>
				<td>{WYSIWYGEditor name="article_text" class="inputText" width="600" height="300" type="fckeditor" value=$article_text conf="BasicAdmin"}</td>
			</tr>
			
			<tr>
				<td valign="top">Redirect To URL:</td>
				<td><input type="text" name="article_link" value="{$article_link}" style="width: 600px;"></td>
			</tr>
			
			<tr>
				<td valign="top">Publication Date:</td>
				<td><input type="text" name="article_publication_date" value="{tr type="date"}{$article_publication_date}{/tr}" id="article_publication_date" style="width: 200px;"></td>
			</tr>
			
			<tr>
				<td valign="top">Expiration Date:</td>
				<td><input type="text" name="article_expiration_date" value="{tr type="date"}{$article_expiration_date}{/tr}" id="article_expiration_date" style="width: 200px;"></td>
			</tr>
			
			<tr>
				<td valign="top">Move To Category:</td>
				<td>
					<select name="article_category">
						<option value="">Select Category</option>
					{foreach from=$all_categories item=current_category}
						{if $current_category.sid != $category.sid}
						<option value="{$current_category.sid}">{$current_category.name}</option>
						{/if}
					{/foreach}
					</select>
				</td>
			</tr>
			
			<tr>
				<td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" name="form_submit" value="Update" class="greenButton" /></span></td>
			</tr>
		</table>
	</form>
</fieldset>



<script language="JavaScript" type="text/javascript" src="{$GLOBALS.user_site_url}/system/ext/jquery/jquery-ui.js"></script>

<script>

$( function () {ldelim}

	var dFormat = '{$GLOBALS.current_language_data.date_format}';
	{literal}
	dFormat = dFormat.replace('%m', "mm");
	dFormat = dFormat.replace('%d', "dd");
	dFormat = dFormat.replace('%Y', "yy");
	
	$("#article_publication_date, #article_expiration_date").datepicker({dateFormat: dFormat, showOn: 'button', buttonImage: '{/literal}{$GLOBALS.user_site_url}/system/ext/jquery/calendar.gif{literal}', buttonImageOnly: true });
	
	{/literal}

{rdelim});

</script>
