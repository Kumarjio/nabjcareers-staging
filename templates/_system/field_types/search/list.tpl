<select name='{$id}[multi_like][]' class="searchList">
	{if $id != 'email_frequency'}
		<option value="">[[Miscellaneous!Any:raw]] [[FormFieldCaptions!{$caption}:raw]]</option>
	{/if}
	{foreach from=$list_values item=list_value}
		<option value='{$list_value.id}' {foreach from=$value.multi_like item=value_id}{if $list_value.id == $value_id}selected="selected"{/if}{/foreach} >{tr mode="raw" domain="Property_$id"}{$list_value.caption}{/tr}</option>
	{/foreach}
</select>