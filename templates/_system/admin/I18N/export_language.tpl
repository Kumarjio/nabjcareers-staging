{breadcrumbs}Export language{/breadcrumbs}
<h1>Export language</h1>
{foreach from=$errors item=error}
	<p class="error">{$error}</p>
{/foreach}

<table>
	<form method="post">
	<input type="hidden" name="action" value="export_language">
		<tr class="evenrow">
			<td>Select language to export</td>
			<td>
	            <select name="languageId">            
	            	{foreach from=$languages item=lang}            	
	            	<option value="{$lang.id}">{$lang.caption}</option>            		
	            	{/foreach}            	
	            </select>
	        </td>
	    </tr>
	    <tr class="oddrow">
	        <td colspan="2" align="right">
	        	<span class="greenButtonEnd"><input type="submit" value="Export" class="greenButton" /></span>
	        </td>
	    </tr>
	</form>
</table>