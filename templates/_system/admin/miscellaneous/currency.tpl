{if $action eq 'list'}
	{breadcrumbs}Currency Settings{/breadcrumbs}
	<h1>Currency Settings</h1>
	<p><a href="{$GLOBALS.site_url}/currency-list/?action=add">Add a New Currency</a></p>

	<table>
		<thead>
			<tr>
				<th>Currency Name</th>
				<th>Currency Code</th>
				<th>Currency Sign</th>
				<th>Exchange Rate</th>
				<th>Default Currency</th>
				<th>Status</th>
				<th></th>
				<th colspan="3" class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$currency item=curr key=currency_id}
				<tr class="{cycle values="oddrow,evenrow"}">
					<td>{$curr.name}</td>
					<td>{$curr.currency_code}</td>
					<td>{$curr.currency_sign}</td>
					<td>{if $curr.main != 1}{$curr.course}{/if}</td>
					<td>{if $curr.main == 1}<b>Default</b>{else}<a href='?action=default&sid={$curr.sid}'>Make default<a/>{/if}</td>
					<td>{if $curr.active == 1}Active{else}Not Active{/if}</td>
					<td>{if $curr.active == 1}<a href='?action=deactivate&sid={$curr.sid}'>Deactivate<a/>{else}<a href='?action=activate&sid={$curr.sid}'>Activate<a/>{/if}</td>
					<td><a href="{$GLOBALS.site_url}/currency-list/?action=edit&sid={$curr.sid}" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a></td>
					<td><a href="{$GLOBALS.site_url}/currency-list/?action=delete&sid={$curr.sid}" onclick='return confirm("Are you sure you want to delete this currency?")' title="Delete"><img src="{image}delete.png" border=0 alt="Delete"></a></td>
				</tr>
			{/foreach}
		</tbody>
	</table>
{elseif $action eq 'add'}
	{breadcrumbs}<a href="{$GLOBALS.site_url}/currency-list/">Currency Settings</a> &#187; {if $button == 'Edit'}Edit{else}Add a New{/if} Currency{/breadcrumbs}
	<h1>{if $button == 'Edit'}Edit{else}Add a New{/if} Currency</h1>
	{foreach from=$errors item=error key=field_caption}
		{if $error eq 'EMPTY_VALUE'}
			<p class="error">'{$field_caption}' [[is empty]]</p>
		{elseif $error eq 'NOT_UNIQUE_VALUE'}
			<p class="error">'{$field_caption}' [[this value is already used in the system]]</p>
		{elseif $error eq 'NOT_FLOAT_VALUE'}
			<p class="error">'{$field_caption}' [[is not an float value]]</p>
		{elseif $error eq 'NOT_VALID_ID_VALUE'}
			<p class="error">'{$field_caption}' [[is not valid]]</p>
		{elseif $error eq 'CAN_NOT_EQUAL_NULL'}
			<p class="error">'{$field_caption}' [[can not equal "0"]]</p>
		{/if}
	{/foreach}
	<fieldset>
		<legend>{if $button == 'Edit'}Edit{else}Add a New{/if} Currency</legend>
		<form method=post>
		{if $button == 'Edit'}<input type="hidden" name="sid" value="{$sid}" />{/if}
		<table>
			{foreach from=$form_fields item=form_field}
				<tr>
					<td valign=top>[[$form_field.caption]]</td>
					<td valign=top>{if $form_field.is_required} <font color="red">*</font>{/if}</td>
					<td>
						{input property=$form_field.id}{if $form_field.id == 'name'}<br /><span style="font-size:11px; font-style: italic;">Please do not use any space characters in the Name field.<br />Use only letters, numbers and underscore characters.</span>
						{elseif $form_field.id == 'course'}<br /><span style="font-size:11px; font-style: italic;">Set exchange rate between this currency and the default currency.</span>{/if}
					</td>
				</tr>
			{/foreach}
			<tr>
				<td colspan="3"><span class="greenButtonEnd"><input type="submit" name='submit' value="{$button}" class="greenButton" /></span></td>
			</tr>
		</table>
		</form>
	</fieldset>
{/if}