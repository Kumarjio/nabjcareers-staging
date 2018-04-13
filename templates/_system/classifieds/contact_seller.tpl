<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.form.js"></script>
{literal}
<script type="text/javascript"><!--
	function contactUserSubmit() {
		  var options = {
				  target: "#messageBox",
				  url:  $("#contactUserForm").attr("action")
				}; 
		  $("#contactUserForm").ajaxSubmit(options);
		return false;
	}
--></script>
{/literal}
{if $is_data_submitted}
	{if $errors}
    	<font size="3" style="color:red;">[[Cannot send letter]]</font>
    {else}
    	[[Your letter was sent]]
    {/if}
{else}
	{if $errors.UNDEFINED_LISTING_ID == 1}
		{foreach from=$errors key=error_code item=error_message}
			<font size="3" style="color:red;">
			{if $error_code == 'UNDEFINED_LISTING_ID'} [[Listing ID is not defined]] {/if}
			</font>
		{/foreach}
	{else}
	{foreach from=$errors key=error_code item=error_message}
			<font size="3" style="color:red;">
			{if $error_code  eq 'EMPTY_VALUE'} [[Enter Security code]] 
			{elseif $error_code eq 'NOT_VALID'} [[Security code is not valid]]
			{/if}
			</font>
	{/foreach}
	<form method="POST" action='{$GLOBALS.site_url}/contact-seller/' id='contactUserForm' onsubmit='return contactUserSubmit()'>
		<input type="hidden" name="is_data_submitted" value="1" />
		<input type="hidden" name="listing_id" value="{$listing_id}" />
		<table cellpadding="5" style="border: 1px solid black;"  class="headrowText">
	        <tr class="headrow">
				<td colspan="2">[[Inquiry for listing with ID]]: '{$listing_id}'</td>
			</tr>
			<tr>
				<td>[[Your name]]:</td>
				<td><input type="text" name="name" value="{$GLOBALS.current_user.user_name}" /></td>
			</tr>
	        <tr>
				<td>[[Your e-mail]]:</td>
				<td><input type="text" name="email" value="{$GLOBALS.current_user.email}" /></td>
			</tr>
			<tr>
				<td colspan="2">[[Your request]]:<br /> <textarea name="request" cols="43" rows="5"></textarea> </td>
			</tr>
			{if $isCaptcha == 1}
			<tr>
				<td>[[Enter code from image]]:</td>
				<td>
					 {include file="../field_types/input/captcha.tpl"}
				</td>
			</tr>
			{/if}
			<tr>
				<td colspan="2" align="right"><input type="submit" value="[[Send:raw]]" class="button" /></td>
			</tr>
		</table>

	</form>
	{/if}
{/if}