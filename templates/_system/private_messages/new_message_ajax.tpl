<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.form.js"></script>
<form method="post" action="{$GLOBALS.site_url}/private-messages/aj-send/" id="pm_send_form">
	<fieldset>
		<div class="inputName" style="width: 25%;"><strong>[[Message to]]</strong></div>
		<div class="inputField">
			{if $anonym}
				[[Anonymous User]]
				<input type="hidden" name="anonym" value="{if $form_to != ""}{$form_to}{else}{$to}{/if}"/>
			{else}
				{$display_to}
			{/if}
			<input type="hidden" name="form_to" id="form_to" value="{if $form_to != ""}{$form_to}{else}{$to}{/if}"/>
		</div>
	</fieldset>
	<fieldset>
		<div class="inputName" style="width: 25%;"><strong>[[Subject]]</strong></div>
		<div class="inputField"><input type="text" name="form_subject" id="form_subject" value="{$form_subject}"></div>
	</fieldset>
	<fieldset>
		<div class="inputName"><strong>[[Message]]</strong></div>
	</fieldset>
	<fieldset>
		<div class="inputField">{WYSIWYGEditor name="form_message" class="inputText" width="514px" height="200px" type="fckeditor" value="$form_message" conf="Basic"}</div>
	</fieldset>
	<fieldset>
		<div class="inputField"><input type="checkbox" name="form_save" id="pm_checkbox" value="1" {if $save }checked="checked"{/if}> [[Save to outbox]]</div>
	</fieldset>
	<input type="submit" id="pm_send_button" value="[[Send]]" class="button" />
	<input type="hidden" name="act" value="send" />
	{if $cc}
		<input type="hidden" name="cc" value="{$cc}" />
	{/if}
</form>

<script language="JavaScript" type="text/javascript">
	{literal}
	var reloadPage = true;
	function pm_check() {
		
		if ( $.trim($("#form_to").val()) == '') {
			alert('{/literal}[[All fields are required]]{literal}');
			return false;
		}
		if ( $.trim($("#form_subject").val()) == '') {
			alert('{/literal}[[All fields are required]]{literal}');
			return false;
		}
		if ( $.trim(FCKeditorAPI.GetInstance('form_message').GetXHTML()) == '') {
			alert('{/literal}[[All fields are required]]{literal}');
			return false;
		}
		return true;
	}
	
	$("#pm_send_form").submit(function() {
		if (pm_check()) {
			var mess = FCKeditorAPI.GetInstance('form_message').GetXHTML();
			var che = 0;
			if ($("#pm_checkbox").attr("checked")) 
				che = 1;
			$("#pm_checkbox").val(che);
			$("#form_message").val(mess);
			var options = {
				target: "#messageBox",
				url:  $("#pm_send_form").attr("action")
			};
			$("#pm_send_form").ajaxSubmit(options);
		}
		return false;					
	});	
	{/literal}
</script>