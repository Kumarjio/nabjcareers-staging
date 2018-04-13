<select class="searchList {if $complexField}complexField{/if}" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" >
	<option value="">Select {if $id == 'profile_field_as_dv'}user profile field {else}{$caption}{/if}</option>
	{foreach from=$list_values item=list_value}
		<option value='{$list_value.id}' {if $list_value.id == $value}selected="selected"{/if} >{$list_value.caption}</option>
	{/foreach}
</select>