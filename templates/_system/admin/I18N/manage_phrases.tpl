<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.bgiframe.js"></script>
<link type="text/css" href="{$GLOBALS.site_url}/../system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />
{literal}
<script type="text/javascript">
	$.ui.dialog.defaults.bgiframe = true;
	$(function() {
		var content = "<img src='{/literal}{$GLOBALS.site_url}/../system/ext/jquery/progbar.gif{literal}'>";
		
		$(".goEditPhrase").click(function(){
			$("#editPhraseDialog").dialog('destroy');
			$("#editPhraseDialog").attr({title: "Loading"});
			$("#editPhraseDialog").html(content).dialog({width: 200});
			var link = $(this).attr("href");
			$.get(link, function(data){
				$("#editPhraseDialog").dialog('destroy');
				$("#editPhraseDialog").attr({title: "Edit Phrase"});
				$("#editPhraseDialog").html(data).dialog({width: 650});
			});
			return false;
		});
	});
	</script>
{/literal}

<div id="editPhraseDialog" style="display: none"></div>

{breadcrumbs}Manage Phrases{/breadcrumbs}
<h1>Manage Phrases</h1>

{if $errors}
	{foreach from=$errors item=error}
		<p class="error">{$error}</p>
	{/foreach}
{/if}

<div id="result">
{if $result}
	{if $result eq 'added'}
		<p class="message">The new phrase was successfully {$result}</p>
	{elseif $result eq 'deleted'}
		<p class="message">The phrase was {$result}</p>
	{/if}
{/if}
</div>

<form method="post">
	<input type="hidden" name="curr_lang" id="curr_lang" value="{$criteria.language}">
	<table>
		<tr>
			<td>Phrase ID:</td>
			<td><input type="text" name="phrase_id" value="{$criteria.phrase_id|escape}"></td>
		</tr>
		<tr>
			<td>Domain:</td>
			<td>
				<select name="domain">
					<option value="">Any</option>
					{foreach from=$domains item=domain}
					<option value="{$domain}"{if $criteria.domain == $domain} selected{/if}>{$domain}</option>
					{/foreach}
				</select>
			</td>
		</tr>
		<tr>
			<td>Languages:</td>
			<td>
				<select name="language">
				{foreach from=$languages item=language}
				<option value="{$language.id}"
					{if $criteria.language == $language.id}
					 selected
					{assign var='chosen_language_id' value=$language.id}
					{assign var='chosen_language_caption' value=$language.caption}
					{/if}>{$language.caption}</option>
				{/foreach}
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="hidden" name="action" value="search_phrases" />
				<span class="greenButtonEnd"><input type="submit" value="Show" class="greenButton" /></span>
			</td>
		</tr>
	</table>
</form>
<p><a href="{$GLOBALS.site_url}/add-phrase/">Add a New Phrase</a></p>

<table width="60%">
	<thead>
		<tr>
			<th>Phrase ID</th>
			<th>{$chosen_language_caption}</th>
			<th colspan=2 class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$phrases item=phrase}
			{if $phrase.domain != $domain}
				</tbody>
				<thead>
					<tr>
						<th colspan=4>{$phrase.domain}</th>
					</tr>
				</thead>
				<tbody>
			{/if}
			<tr class="{cycle values = 'evenrow,oddrow'}" id="tr_{$phrase.id|replace:' ':'_'}">
				<td><a href="{$GLOBALS.site_url}/edit-phrase/?phrase={$phrase.id|escape:"url"}&domain={$phrase.domain}" title="Edit" class="goEditPhrase">{$phrase.id|escape}</a></td>
				<td class="translated"><a href="{$GLOBALS.site_url}/edit-phrase/?phrase={$phrase.id|escape:"url"}&domain={$phrase.domain}&lang={$chosen_language_id}" class="goEditPhrase">{$phrase.translations.$chosen_language_id|escape}</a></td>
				<td><a href="{$GLOBALS.site_url}/edit-phrase/?phrase={$phrase.id|escape:"url"}&domain={$phrase.domain}" title="Edit" class="goEditPhrase"><img src="{image}edit.png" border=0 alt="Edit"></a></td>
				<td>
					{capture name="delete_confirm_script"}
						return confirm('Do you want to delete `{$phrase.id|escape:"javascript"}` phrase?')
					{/capture}
					<a href="?action=delete_phrase&phrase={$phrase.id|escape}&domain={$phrase.domain}" onclick="{$smarty.capture.delete_confirm_script|escape:"html"}" title="Delete"><img src="{image}delete.png" border=0 alt="Delete"></a>
				</td>
			</tr>
			{assign var=domain value=$phrase.domain}
		{/foreach}
	</tbody>
</table>