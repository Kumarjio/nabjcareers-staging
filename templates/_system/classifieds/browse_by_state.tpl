<ul class="browseListing">
	{foreach from = $browseItems item = browseItem name=browseItems}  
		{if $browseItem.count > 0}
			<li><a class='browseItem' href="{$GLOBALS.site_url}/browse-by-state/{$browseItem.url}/">[[{$browseItem.caption|truncate:28:"...":true}]] <span class="blue">({$browseItem.count})</span></a></li>
			{if $smarty.foreach.browseItems.iteration is div by $columns}</ul><ul class="browseListing">{/if}
		{/if}
	{foreachelse}
		<li>[[There are no listings with requested parameters in the system.]]</li>
	{/foreach}
</ul>