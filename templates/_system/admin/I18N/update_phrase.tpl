<script>

$("#updatePhraseForm").submit(function(){ldelim}
	$("#editPhraseDialog").dialog('destroy');
	
	link = "{$GLOBALS.site_url}/edit-phrase/";
	var content = "<img src='{$GLOBALS.site_url}/../system/ext/jquery/progbar.gif'>";
	
{foreach from=$langs item=lang}
{if empty($chosen_lang) || (!empty($chosen_lang) && $chosen_lang == $lang.id)}
	var trans_val_{$lang.id} = $("#translations_{$lang.id}").val();
{/if}
{/foreach}

	var curr_lang = $("#curr_lang").val();
	new_val = $("#translations_"+curr_lang).val();

	$("#editPhraseDialog").html("[[Please wait...]]<br>" + content).dialog({ldelim}width: 180{rdelim});
	
	$.post(link, {ldelim}phrase: "{$phrase.id}", domain: "{$phrase.domain}", lang: "{$chosen_lang}", action: "update_phrase"{foreach from=$langs item=lang}{if empty($chosen_lang) || (!empty($chosen_lang) && $chosen_lang == $lang.id)}, 'translations[{$lang.id}]': trans_val_{$lang.id} {/if}{/foreach}{rdelim}, function(data){ldelim}
		var tr_id_replace = "tr_{$phrase.id|replace:' ':'_'}";
		$("#" + tr_id_replace).children(".translated").children().text(new_val);
		$("#editPhraseDialog").dialog('destroy');
		return false;
	{rdelim});
	return false;
{rdelim});

</script>



{foreach from=$errors item=error}
	<p class="error">{$error}</p>
{/foreach}
<p>Fields marked with an asterisk (<font color="red">*</font>) are mandatory</p>

<fieldset>
	<legend>Edit Phrase</legend>
	<form method="post" enctype="multipart/form-data" id="updatePhraseForm" name="updatePhraseForm">
		<table>
			<thead>
			    <tr>
			        <th>Domain</th>
			        <th>{$phrase.domain}</th>
			    </tr>
		    </thead>
		    <tr>
		        <td>Phrase ID</td>
		        <td>{$phrase.id|escape}</td>
		    </tr>
		    {foreach from=$langs item=lang}
		    	{if empty($chosen_lang) || (!empty($chosen_lang) && $chosen_lang == $lang.id)}
			    <tr>
			        <td>{$lang.caption}</td>        
			        <td>
		        		{assign var="lang_id" value=$lang.id}
		        		<textarea name="translations[{$lang.id}]" id="translations_{$lang.id}" rows="4" cols="63">{$phrase.translations.$lang_id|escape}</textarea>
			        </td>
			    </tr>
			    {/if}
		    {/foreach}
		    <tr>
		        <td colspan="2">
		        	<input type="hidden" name="phrase" value="{$phrase.id|escape}" />
		        	<input type="hidden" name="domain" value="{$phrase.domain}" />
		        	<input type="hidden" name="lang" value="{$chosen_lang}" />
		        	<input type="hidden" name="action" value="update_phrase" />
		        	<span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton" /></span>
		        </td>
		    </tr>
		</table>
	</form>
</fieldset>