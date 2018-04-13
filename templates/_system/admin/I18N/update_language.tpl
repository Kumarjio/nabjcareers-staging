{breadcrumbs}<a href="{$GLOBALS.site_url}/manage-languages/">Manage Languages</a> &#187; Edit language{/breadcrumbs}
<h1>Edit language {$lang.caption}</h1>

{foreach from=$errors item=error}
	<p class="error">{$error}</p>
{/foreach}
<p>Fields marked with an asterisk (<font color="red">*</font>) are mandatory</p>

<fieldset>
	<legend>Edit Language <b>{$lang.caption}</b></legend>
	<table>
		<form method="post" enctype="multipart/form-data">    
			<tr>
		        <td colspan="2">Language Caption</td>       
		        <td><input type="text" name="caption" value="{$lang.caption}" /></td>
		    </tr>
		    <tr>
		        <td colspan="2">Active</td>
		        <td>
		        	<input type="hidden" name="active" value="0" />
		        	<input type="checkbox" name="active"{if $lang.active} checked {/if} value="1"/>
		        </td>
		    </tr>
		    <tr>
		        <td colspan="2">Date Format</td>
		        <td>
		        	<input type="text" name="date_format" value="{$lang.date_format}" /><br />
		        	<small>
		        		default format symbols that are supported: <br />%Y, %m, %d (%Y - year, %m - month, %d - day)<br /><br />
		        		example of March,9 2008:<br />
		        		&nbsp;&nbsp;%Y-%m-%d => 2008-03-09<br />
						&nbsp;&nbsp;%m/%d/%Y => 03/09/2008<br />
						&nbsp;&nbsp;%d.%m.%Y => 09.03.2008<br /><br />
		        	</small>
		        </td>
		    </tr>
		    <tr>
		        <td colspan="2">Decimal Separator</td>
		        <td>
		            <select name="decimal_separator">
		            	<option value=""{if $lang.decimal_separator == ''} selected {/if}>none</option>
		                <option value="."{if $lang.decimal_separator == '.'} selected {/if}>dot</option>
		                <option value=","{if $lang.decimal_separator == ','} selected {/if}>comma</option>
		            </select>
		        </td>
		    </tr>
		    <tr>
		        <td colspan="2">Thousands Separator</td>
		        <td>
		        	<select name="thousands_separator">
						<option value=".">dot</option>
						<option value=","{if $lang.thousands_separator == ','} selected {/if}>comma</option>
						<option value=" "{if $lang.thousands_separator == ' '} selected {/if}>space</option>
		            </select>
		        </td>
		    </tr>
		    <tr>
		        <td colspan="2">Decimals</td>
		        <td>
		        	<select name="decimals">
		        		<option value="0">0</option>
						<option value="1"{if $lang.decimals == '1'} selected {/if}>1</option>
						<option value="2"{if $lang.decimals == '2'} selected {/if}>2</option>
						<option value="3"{if $lang.decimals == '3'} selected {/if}>3</option>
						<option value="4"{if $lang.decimals == '4'} selected {/if}>4</option>
						<option value="5"{if $lang.decimals == '5'} selected {/if}>5</option>
		            </select>
		        </td>
		    </tr>
		    <tr>
		        <td colspan="2">Right to Left Layout</td>
		        <td>
					<input type="hidden" name="rightToLeft" value="0" />
					<input type="checkbox" name="rightToLeft"{if $lang.rightToLeft} checked="checked" {/if} value="1" />
		        </td>
		    </tr>
		    <tr>
		        <td colspan="3">
		        	<input type="hidden" name="languageId" value="{$lang.id}" />
		        	<input type="hidden" name="action" value="update_language" />
		        	<span class="greenButtonEnd"><input type="submit" value="Edit" class="greenButton" /></span>
		        </td>
		    </tr>
		</form>
	</table>
</fieldset>
<p><a href="{$GLOBALS.site_url}/manage-phrases/?language={$lang.id}&action=search_phrases">Translate Phrases</a></p>
<p><a href="{$GLOBALS.site_url}/import-language/">Import translations</a></p>
<p><a href="{$GLOBALS.site_url}/export-language/">Export translations</a></p>
