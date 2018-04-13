<form method="post" action="" id="pm_send_form">
	<input type="hidden" name="reply_id" value="{$reply_id}">
	<div id="pmDetails">
		<fieldset class="reply">
			<strong>[[Message to]]:</strong>
			<span>
				{if $errors.form_to}<font color="red">{$errors.form_to}</font>{/if}
				{if $message.anonym && $message.anonym == $message.from_id}
				[[Anonymous User]]
				<input type="hidden" name="form_to" id="form_to" value="{$message.to_name}" />
				{else}
				<input type="text" name="form_to" id="form_to" value="{$message.to_name}" />
				{/if}
				<input type="hidden" name="anonym" value="{$message.anonym}"/>
			</span>
		</fieldset>
		<fieldset class="reply">
			<strong>[[Subject]]:</strong>
			<span>
				{if $errors.form_subject}<font color="red">{$errors.form_subject}</font>{/if}
				<input type="text" name="form_subject" id="form_subject" value="{$message.subject}" />
			</span>
		</fieldset>
		<strong>[[Message]]:</strong><br><br>
		{if $errors.form_message}<font color="red">{$errors.form_message}</font><br>{/if}
		{WYSIWYGEditor name="form_message" class="inputText" width="100%" height="200px" type="fckeditor" value=$message.message conf="Basic"}
		<input type="checkbox" name="form_save" value="1" {if $save }checked=checked{/if} /> [[Save to outbox]]
		<br/><br/><input type="submit" value="[[Send]]" />
	</div>
</form>

<script>
	{literal}
		$("#pm_send_form").submit(function(){
			// verification
			return true;
		});
	{/literal}
</script>