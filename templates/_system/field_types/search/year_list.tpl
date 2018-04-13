{capture name="select_box_field_from"}
	<select name="{$id}[not_less]" class="list">
	{section name=foo start=$minimum loop=$maximum+1}
	    <option value="{$smarty.section.foo.index}" {if $value.not_less eq $smarty.section.foo.index}selected{/if}>{$smarty.section.foo.index}</option>
	{/section}
	</select> 
{/capture}

{capture name="select_box_field_to"}   
	{if $value.not_more}{assign var="max" value=$value.not_more}{else}{assign var="max" value=$maximum}{/if}
	<select name="{$id}[not_more]" class="list">
	{section name=foo start=$minimum loop=$maximum+1}
	    <option value="{$smarty.section.foo.index}" {if $max eq $smarty.section.foo.index}selected{/if}>{$smarty.section.foo.index}</option>
	{/section}
	</select>
{/capture}

{assign var="select_box_field_from" value="`$smarty.capture.select_box_field_from`"}
{assign var="select_box_field_to" value="`$smarty.capture.select_box_field_to`"}

[[$select_box_field_from to $select_box_field_to]]
