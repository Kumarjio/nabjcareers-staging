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
{if $GLOBALS.user_page_uri == "/"}
	{* SOCIAL PLUGIN: LOGIN BUTTON *}
		{module name="social" function="social_login"}
	{* / SOCIAL PLUGIN: LOGIN BUTTON *}
	{include file="errors.tpl" errors=$errors}
	<form action="" method="post" id="loginForm" {if $ajaxRelocate} onsubmit="return loginSubmit()" {/if}>
		<input type="hidden" name="return_url" value="{$return_url}" />
		<input type="hidden" name="action" value="login" />
		{if $ajaxRelocate}<input type="hidden" name="ajaxRelocate" value="1" />{/if}
		
				
		
		<fieldset>
			<div class="inputFieldLogin">
				[[FormFieldCaptions!Username]]<br/>
				<input type="text" class="logInNameInput" name="username" />
			</div>
		</fieldset>
		<fieldset>
			<div class="inputFieldLogin">
				[[FormFieldCaptions!Password]]<br/>
				<input class="logInPassInput" type="password" name="password" /> <input type="submit" value="[[GO:raw]]" id="buttonLogin" />
			</div>
		</fieldset>
		<br/>
		<input type="checkbox" name="keep" /> [[Keep me signed in]]<br/><br/>
		<a href="{$GLOBALS.site_url}/password-recovery/">[[Forgot Your Password?]]</a><br/><br/>
		<a href="{$GLOBALS.site_url}/registration/">[[First Time Users - Register Here]]</a><br/><br/>
	</form>
{else}
	<h1>[[Sign In]]</h1>
	{include file="errors.tpl" errors=$errors}
	<form action="{$GLOBALS.site_url}/login/" method="post" id="loginForm" {if $ajaxRelocate} onsubmit="return loginSubmit()" {/if}>
		<input type="hidden" name="return_url" value="{$return_url}" />
		<input type="hidden" name="action" value="login" />
		{if $ajaxRelocate}<input type="hidden" name="ajaxRelocate" value="1" />{/if}
		<fieldset>
			<div class="inputName">[[FormFieldCaptions!Username]]</div>
			<div class="inputField"><input type="text" class="logInNameInput" name="username" /></div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[FormFieldCaptions!Password]]</div>
			<div class="inputField"><input class="logInPassInput2" type="password" name="password" /></div>
		</fieldset>
		<fieldset>
			<div class="inputName">&nbsp;</div>
			<div class="inputField"><input type="checkbox" name="keep" /> [[Keep me signed in]]</div>
		</fieldset>
		<fieldset>
			<div class="inputName">&nbsp;</div>
			<div class="inputField"><input type="submit" value="[[Login:raw]]" class="button" /></div>
		</fieldset>
	</form>
	<br/>
	<a  href="{$GLOBALS.site_url}/password-recovery/">[[Forgot Your Password?]]</a>&nbsp;|&nbsp; <a href="{$GLOBALS.site_url}/registration/">[[First Time Users - Register Here]]</a>
	{* SOCIAL PLUGIN: LOGIN BUTTONs *}
	<div class="soc_reg_form">
	{module name="social" function="social_plugins"}
	</div>
	{* / SOCIAL PLUGIN: LOGIN BUTTONs *}
{/if}