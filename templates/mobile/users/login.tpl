<div class="Box">
	{if $ajaxRelocate}
	<link type="text/css" href="{$GLOBALS.site_url}/system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />	
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.form.js"></script>
	{literal}
	<script>
		function loginSubmit() {
			var options = {
					  target: "#messageBox",
					  url:  $("#loginForm").attr("action")
					}; 
			$("#loginForm").ajaxSubmit(options);
			return false;
		}
	</script>
	{/literal}
	{/if}
	<h1>[[Sign In]]</h1>
	{* Redirect to homepage for mobile version *}
	{capture name=url}{php}
		echo base64_encode(SJB_System::getSystemSettings("SITE_URL") . '/');
	{/php}{/capture}
	
	{include file="errors.tpl" errors=$errors}
	<form action="{$GLOBALS.site_url}/login/" method="post" id="loginForm" {if $ajaxRelocate} onsubmit="return loginSubmit()" {/if}>
		<input type="hidden" name="return_url" value="{$smarty.capture.url}" />
		<input type="hidden" name="action" value="login" />
		{if $ajaxRelocate}<input type="hidden" name="ajaxRelocate" value="1" />{/if}
			[[FormFieldCaptions!Username]]<br/>
			<input type="text" name="username" /><br/>
			
			[[FormFieldCaptions!Password]]<br/>
			<input type="password" name="password" /><br/>
			
			<input type="checkbox" name="keep" /> [[Keep me signed in]]
			<div class="inputField"><input type="submit" value="[[Login:raw]]" class="button" /></div>
	</form>
</div>