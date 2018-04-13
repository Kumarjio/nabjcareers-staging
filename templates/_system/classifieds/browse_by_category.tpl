{assign var="empty" value="true"}
<ul class="browseListing">
	{foreach from = $browseItems item = browseItem name=browseItems}
		{if $browseItem.count > 0}
			{assign var="empty" value="false"}
			<li><a class='brByCategoryLink'  href="{$GLOBALS.site_url}/browse-by-category/{$browseItem.url|escape:"url"}/">[[Property_JobCategory!{$browseItem.caption|truncate:28:"...":true}]] <span class="blue">({$browseItem.count})</span></a></li>
			{if $smarty.foreach.browseItems.iteration is div by $columns}</ul><ul class="browseListing">{/if}
		{/if}
	{/foreach}		
	{if $empty == "true"}
		<li>[[There are no listings with requested parameters in the system.]]</li>
	{/if}
</ul>