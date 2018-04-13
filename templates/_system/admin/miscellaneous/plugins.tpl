{breadcrumbs}Plugins{/breadcrumbs}
<h1>Plugins</h1>

{if $saved == 1}
	<p class="message">Saved Succesfully</p>
{/if}

<form method="post">
    <table>
    	<thead>
		    <tr>
		    	<th>Plugin Name</th>
		    	<th>Status</th>
		    	<th></th>
		    </tr>
    	</thead>
    	<tbody>
		    {foreach from=$plugins item=plugin key=key}
		    <tr class="{cycle values = 'evenrow,oddrow'}">
		    	<td>{$plugin.name}</td>
		    	<td>
		    		<input type="hidden" name="path[{$key}]" value="{$plugin.config_file}" />
		    		<input type="hidden" name="active[{$key}]" value="0" />
		    		<input type="checkbox" name="active[{$key}]" value="1" {if $plugin.active == 1}checked="checked"{else}{/if} />
		    	</td>
		    	<td>{if $plugin.settings || $plugin.name == 'TwitterIntegrationPlugin'}<a href="?action=settings&plugin={$plugin.name}">Settings</a>{/if}</td>
		    </tr>
		    {/foreach}
		</tbody>
    	<tr id="clearTable">
	    	<td colspan="3">
	    		<input type="hidden" name="action" value="save" />
	    		<span class="greenButtonEnd"><input type="submit" class="greenButton" value="Save" /></span>
	    	</td>
    </tr>
    </table>
</form>