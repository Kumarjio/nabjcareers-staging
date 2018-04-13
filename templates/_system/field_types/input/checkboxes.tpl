{foreach from=$list_values item=list_value}
<input type="checkbox" name="{$id}[]" {foreach from=$value item=value_id}{if $list_value.id == $value_id}checked="checked"{/if}{/foreach} value="{$list_value.id}" />&nbsp;{$list_value.caption}<br/>
{/foreach}