{foreach from=$GLOBALS.languages item=language}
	{if $language.id == $GLOBALS.current_language}
		{assign var=dateFormat value=$language.date_format}
	{/if}
{/foreach}
<form action="" method="post" id="pm_form">
	<input type="hidden" id="pm_action" name="pm_action" value="">
	{foreach from=$navigate item=one key=page}
		{if $one|count_characters == 0}{$page}{else}<a href="?page={$one}">{$page}</a>{/if}
	{/foreach}
	<table cellspacing="0">
		<thead>
			<tr>
				<th class="tableLeft"> </th>
				<th width="1"><input type="checkbox" id="pm_all_check"></th>
				<th width="30%">[[To]]</th>
				<th width="50%">[[Subject]]</th>
				<th>[[Date]]</th>
				<th class="tableRight"> </th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$message_list item=one}
				<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
					<td> </td>
					<td><input type="checkbox" name="pm_check[]" value="{$one.id}" class="pm_checkbox"></td>
					<td>
						{if $one.anonym && $one.anonym != $GLOBALS.current_user.id}
						[[Anonymous User]]
						{else}
						{$one.to_first_name} {$one.to_last_name}{if $one.to_first_name == '' && $one.to_last_name == ''}{$one.to_name}{/if}
						{/if}

					</td>
					<td><a href="{$GLOBALS.site_url}/private-messages/outbox/read/?id={$one.id}">{$one.subject}</a></td>
					<td>{$one.time|date_format:$dateFormat} {$one.time|date_format:"%H:%M"}</td>
					<td> </td>
				</tr>
				<tr>
					<td colspan="6" class="separateListing"> </td>
				</tr>
			{/foreach}
		</tbody>
	</table>
	<div class="clr"><br/></div>
	<input type="button" value="[[Delete]]" id="pm_controll_delete" class="button">
	{foreach from=$navigate item=one key=page}
		{if $one|count_characters == 0}{$page}{else}<a href="?page={$one}">{$page}</a>{/if}
	{/foreach}
</form>