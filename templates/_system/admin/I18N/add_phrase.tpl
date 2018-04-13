{breadcrumbs}<a href="{$GLOBALS.site_url}/manage-phrases/">Manage Phrases</a> &#187; Add a New Phrase{/breadcrumbs}
<h1>Add a New Phrase</h1>
{if $errors}
	{foreach from=$errors item=error}
		{if $error eq 'PHRASE_ALREADY_EXISTS'}
			<p class="error">'{$error}' The new phrase can not be added</p>
		{/if}
	{/foreach}
{/if}
<p>Fields marked with an asterisk (<font color="red">*</font>) are mandatory</p>

<fieldset>
	<legend>Add a New Phrase</legend>
	<table>
	<form method="post" enctype="multipart/form-data">    
	    <tr>
	        <td>Phrase ID</td>
	        <td><input type="text" name="phrase" value="{$request_data.phrase|escape}" /> <font color="red">*</font></td>
	    </tr>   
	    <tr>
	        <td>Domain</td>
	        <td>
	            <select name="domain">            
	            	{foreach from=$domains item=domain}
	            		<option value="{$domain}"{if $request_data.domain == $domain} selected {/if}>{$domain}</option>
	            	{/foreach}
	            </select>
	        </td>
	    </tr>
	    {foreach from=$langs item=lang}
	    <tr>
	        <td>{$lang.caption}</td>
	        {assign var="lang_id" value=$lang.id}
	        <td><textarea name="translations[{$lang.id}]" rows="4" cols="63">{$request_data.translations.$lang_id|escape}</textarea></td>
	    </tr>
	    {/foreach}
	    <tr>
	        <td colspan="2">
	        	<input type="hidden" name="action" value="add_phrase" />
	        	<span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton" /></span>
	        </td>
	    </tr>
	</form>
	</table>
</fieldset>