<div id="tree_{$name}_level_{$level}">
	<span style="width: 150px; float: left; margin: 0 0 10px 0; display: block;">[[$levelName]]:</span>
	<span style="width: 400px; float: left; margin: 0 0 10px 0; display: block;">
		<select name="select_tree_{$name}_level_{$level}" id="select_tree_{$name}_level_{$level}">
			<option value="">[[Select {$name} {$levelName}]]</option>
			{foreach from=$tree_values item=treeItem}
			<option value="{$treeItem.sid}" {if in_array($treeItem.sid,$checked)}selected="selected"{/if}>{$treeItem.caption}</option>
			{/foreach}
		</select>
	</span>
	<div class="clr"></div>
	<div id="tree_{$name}_level_{$level+1}"></div>
</div>

<script type="text/javascript">
goTroughSelectedElements_{$name}("{$level}", "{$level+1}");
$("#select_tree_{$name}_level_{$level}").change(function(){ldelim}
	goTroughSelectedElements_{$name}("{$level}", "{$level+1}");
	saveTreeElement_{$name}("{$level}");
{rdelim});


</script>
