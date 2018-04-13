{foreach from=$assoc_array item=val name=tree_value key=k}
<b>{tr domain="Property_$id"}{$k}{/tr}</b>{if $val}:{/if} {foreach from=$val item=child name=child_lv1}{tr domain="Property_$id"}{$child}{/tr}{if !$smarty.foreach.child_lv1.last}, {/if}{/foreach}{if !$smarty.foreach.tree_value.last}<br />{/if}
{/foreach}