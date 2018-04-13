<select multiple="multiple" class="inputList fieldType{$id} {if $complexField}complexField{/if}" name="{if $complexField}{$complexField}[{$id}][{$complexStep}][]{else}{$id}[]{/if}" style="width:315px" >
	<option value="" >[[Miscellaneous!Select:raw]] [[FormFieldCaptions!{$caption}:raw]]</option>
	{foreach from=$list_values item=list_value}
		<option value='{$list_value.id}' {foreach from=$value item=value_id}{if $list_value.id == $value_id}selected="selected"{/if}{/foreach} >{tr mode="raw" domain="Property_$id"}{$list_value.caption}{/tr}</option>
	{/foreach}
</select><br/>
<small>[[Use the "Control" key to choose two or more options]].</small>