<div class="browse">
<a href="{$GLOBALS.site_url}{$user_page_uri}">[[$TITLE]]</a>
{foreach from=$browse_navigation_elements item=element name="nav_elements"}
{title}{tr metadata=$element.metadata mode="raw"}{$element.caption}{/tr}{/title}
{keywords}{tr metadata=$element.metadata mode="raw"}{$element.caption}{/tr}{/keywords}
{description}{tr metadata=$element.metadata mode="raw"}{$element.caption}{/tr}{/description}
 / 
  {if $smarty.foreach.nav_elements.last} 	
  	{tr metadata=$element.metadata}{$element.caption}{/tr} 	
  {else}
  	<a href="{$GLOBALS.site_url}{$element.uri}">{tr metadata=$element.metadata}{$element.caption}{/tr}</a>
  {/if}
{/foreach}
</div>

{include file="error.tpl"}
{if empty($listings)}
<table width=100% cellpadding="5px"><tr valign=top>

{assign var="columnCount" value="5"}
{foreach from = $browseItems item = browseItem name=browseItems}  
	<td><a href="{$browseItem.url|escape:"url"}/">[[Property_JobCategory!{$browseItem.caption}]] ({$browseItem.count})</a></td>
	{if $smarty.foreach.browseItems.iteration % $columnCount == 0}</tr><tr>{/if}
{foreachelse}
	<td>[[There are no listings with requested parameters in the system.]]</td>
{/foreach}
</tr></table>

{else}
{include file="search_results_jobs.tpl"}
{/if}
