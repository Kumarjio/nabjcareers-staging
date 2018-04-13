<select id="{$id}" class="searchList {if $complexField}complexField{/if}" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" >
	
	{foreach from=$list_values item=list_value}
		<option value='{$list_value.id}' {if $list_value.id == $value}selected="selected"{/if} >{tr mode="raw" domain="Property_$id"}{$list_value.caption}{/tr}</option>
	{/foreach}
</select>