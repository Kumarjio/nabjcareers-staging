{foreach from=$list_values item=list_value}
<input type="radio" name="{$id}" {if $list_value.id == $value}checked="checked"{/if} value="{$list_value.id}" />&nbsp;{$list_value.caption}<br/>
{/foreach}