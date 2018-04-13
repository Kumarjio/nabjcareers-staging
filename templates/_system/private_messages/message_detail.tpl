<div id="pmDetails">
	<fieldset>
		{if $message.outbox == 0}
			<strong>[[Message from]]:</strong>
			<span>
				{if $message.anonym && $message.anonym == $message.from_id}
				[[Anonymous User]]
				{else}
				{$message.from_first_name} {$message.from_last_name}
				{/if}
			</span>
		{else}
			<strong>[[Message to]]:</strong>
			<span>{$message.to_first_name} {$message.to_last_name}</span>
		{/if}
	</fieldset>
	<fieldset>
		<strong>[[Date]]:</strong>
		<span>{$message.data}</span>
	</fieldset>
	<fieldset>
		<strong>[[Subject]]:</strong>
		<span>{$message.subject}</span>
	</fieldset>
	{$message.message}
</div>
{if $message.outbox == 0}
	<input type="button" id="pm_delete" value="[[Delete]]">
	<input type="hidden" value="{$GLOBALS.site_url}/private-messages/inbox/read/?id={$message.id}&action=delete" id="pm_delete_link">
	<input type="button" id="pm_reply" value="[[Reply]]">
	<input type="hidden" value="{$GLOBALS.site_url}/private-messages/reply/?id={$message.id}" id="pm_reply_link">
{else}
	<input type="button" id="pm_delete" value="[[Delete]]">
	<input type="hidden" value="{$GLOBALS.site_url}/private-messages/inbox/read/?id={$message.id}&action=delete" id="pm_delete_link">
{/if}