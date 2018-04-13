{foreach from=$form_fields item=form_field}

<p><span class="red">{if $form_field.is_required}*{/if}</span> [[$form_field.caption]]</p>
<p>
		{if $form_field.type == 'list'}
			{input property=$form_field.id template='radiobuttons.tpl'}
		{elseif $form_field.type == 'multilist'}
			{input property=$form_field.id template='checkboxes.tpl'}
		{else}
			{input property=$form_field.id}
		{/if}
</p>
{/foreach}