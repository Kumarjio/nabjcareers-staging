<div id="pmDetails">
	<form method="post" action="" id="pm_send_form">
		{if $info != ""}<p class="message">{$info}</p>{/if}
		{if $error.form_to}<p class="error">{$error.form_to}</p>{/if}
		<fieldset class="reply">
			<strong>[[Message to]]:</strong>
			<span>
				{if $display_to}
					{$display_to}
					<input style="width: 200px" type="hidden" name="form_to" id="form_to" value="{if $form_to != ""}{$form_to}{else}{$to}{/if}" /></td></tr>
				{else}
					<input style="width: 200px" type="text" name="form_to" id="form_to" value="{if $form_to != ""}{$form_to}{else}{$to}{/if}" /></td></tr>
				{/if}
			</span>
		</fieldset>
		<fieldset class="reply">
			<strong>[[Subject]]:</strong>
			<span>
				{if $error.form_subject}<font color="red">{$error.form_subject}</font><br>{/if}
				<input type="text" name="form_subject" id="form_subject" value="{$form_subject}" />
			</span>
		</fieldset>
		<br/><strong>[[Message]]:</strong><br/>
		{if $error.form_message}<font color="red">{$error.form_message}</font><br>{/if}
		{WYSIWYGEditor name="form_message" class="inputText" width="100%" height="200px" type="fckeditor" value=$form_message conf="Basic"}
		<br/><input type="checkbox" name="form_save" value="1" {if $save }checked=checked{/if} /> [[Save to outbox]]
		<br/><br/><input type="submit" value="[[Send]]">
	</form>
</div>