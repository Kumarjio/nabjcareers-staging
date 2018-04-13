<select name='{$id}[equal]'>
	{if $id != 'data_source'}
		<option value="">Any {$caption}</option>
	{elseif $id == 'data_source'}
		<option value="">[[Miscellaneous!Select:raw]] [[FormFieldCaptions!{$caption}:raw]]</option>
	{/if}
	{foreach from=$list_values item=list_value}
		<option value='{$list_value.id}' {if $list_value.id == $value.equal}selected="selected"{/if} >{$list_value.caption}</option>
	{/foreach}
</select>