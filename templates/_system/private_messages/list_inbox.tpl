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
				<th width="30%">[[From]]</th>
				<th width="40%">[[Subject]]</th>
				<th width="15%">[[Date]]</th>
				<th> </th>
				<th class="tableRight"> </th>
			</tr>
		</thead>
		<tbody>
		{foreach from=$message_list item=one}
			<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
				<td> </td>
				<td><input type="checkbox" name="pm_check[]" value="{$one.id}" class="pm_checkbox"></td>
				<td>
					<a href="{$GLOBALS.site_url}/private-messages/inbox/read/?id={$one.id}">
					{if $one.anonym && $one.anonym != $GLOBALS.current_user.id}
						[[Anonymous User]]
					{else}
						{$one.from_first_name} {$one.from_last_name}
					{/if}
					</a>
				</td>
				<td><a href="{$GLOBALS.site_url}/private-messages/inbox/read/?id={$one.id}">{if $one.status == 0}<b>{$one.subject}</b>{else}{$one.subject}{/if}</a></td>
				<td>{$one.time|date_format:$dateFormat} {$one.time|date_format:"%H:%M"}</td>
				<td>
					{if $one.status == 0}<img src="{image}f_norm.gif" title="[[Unread]]">
					{elseif $one.status == 1}<img src="{image}f_norm_no.gif" title="[[Read]]">
					{elseif $one.status == 2}<img src="{image}f_norm_re.gif" title="[[Replied]]">
					{/if}
				</td>
				<td> </td>
			</tr>
			<tr>
				<td colspan="7" class="separateListing"> </td>
			</tr>
		{/foreach}
		</tbody>
	</table>
	<div class="clr"><br/></div>
	<input type="button" class="button" value="[[Mark as Read]]" id="pm_controll_mark"> <input type="button" class="button" value="[[Delete]]" id="pm_controll_delete">
	<div class="clr"></div>
	{foreach from=$navigate item=one key=page}
	 {if $one|count_characters == 0}{$page}{else}<a href="?page={$one}">{$page}</a>{/if}
	{/foreach}
</form>