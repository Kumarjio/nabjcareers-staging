<select multiple class="inputList" {if $complexField}complexField{/if}" name="{if $complexField}{$complexField}[{$id}][{$complexStep}][]{else}{$id}[]{/if}" style=" width:385px;" >
	{if !$no_first_option}<option value="" >[[Miscellaneous!Select:raw]] [[FormFieldCaptions!{$caption}:raw]]</option>{/if}
	{foreach from=$list_values item=list_value}
		<option value='{$list_value.id}' {foreach from=$value item=value_id}{if $list_value.id == $value_id}selected="selected"{/if}{/foreach} >{tr mode="raw" domain="Property_$id"}{$list_value.caption}{/tr}</option>
	{/foreach}
</select><br/>
{if $comment}
<small>[[{$comment}]].</small>
{/if}