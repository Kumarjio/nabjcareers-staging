{tr type="multilist"}
{foreach from=$value item=list_value}
		{tr domain="Property_$id"}{$list_value}{/tr}
{/foreach}
{/tr}