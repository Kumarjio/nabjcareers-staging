<select multiple="multiple" id="{$id}" class="inputList fieldType{$id}" name='{$id}[multi_like][]' style=" width:315px;">
	<option value="">[[Miscellaneous!Select:raw]] [[FormFieldCaptions!{$caption}:raw]]</option>
	{foreach from=$list_values item=list_value}
		<option value='{$list_value.id}' {foreach from=$value.multi_like item=value_id}{if $list_value.id == $value_id}selected="selected"{/if}{/foreach} >{tr mode="raw" domain="Property_$id"}{$list_value.caption}{/tr}</option>
	{/foreach}
</select>
<br />
<small>[[Use the "Control" key to choose two or more options]].</small>