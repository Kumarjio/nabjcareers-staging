{foreach from=$value item=list_value name="multifor"}
{tr domain="Property_$id"}{$list_value}{/tr}{if !$smarty.foreach.multifor.last}, {/if}
{/foreach}