<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.form.js"></script>
{literal}
<script type="text/javascript"><!--
	function tellFriendSubmit() {
		  var options = {
				  target: "#messageBox",
				  url:  $("#tellFriendForm").attr("action")
				}; 
		  $("#tellFriendForm").ajaxSubmit(options);
		return false;
	}
--></script>
{/literal}
{if $is_data_submitted && !$errors}
   	[[Your letter was sent]]
{else}
	{if $errors}
		<font size="3" style="color:red;">[[Cannot send letter]]</font><br />
	{/if}
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
			{elseif $error_code eq 'NOT_VALID_EMAIL_FORMAT'} [[Email format is not valid]]
			{/if}

			</font>

	{/foreach}
	<form method="post" action="{$GLOBALS.site_url}/tell-friends/" id="tellFriendForm" onsubmit="return tellFriendSubmit()">
		<input type="hidden" name="is_data_submitted" value="1" />
		<input type="hidden" name="listing_id" value="{$listing_info.id}" />

		<table cellpadding="5">
	        <tr class="headrow">
 				<td colspan="2">[[Recommend listing with ID]]: '{$listing_info.id}'</td>
			</tr>
			<tr>
				<td>[[Your name]]:</td>
				<td><input type="text" name="name" value="{$info.name}" /></td>
			</tr>
	        <tr>
				<td>[[Your friend's name]]:</td>
				<td><input type="text" name="friend_name" value="{$info.friend_name}" /></td>
			</tr>
	        <tr>
				<td>[[Your friend's e-mail address]]:</td>
				<td><input type="text" name="friend_email" value="{$info.friend_email}" /></td>
			</tr>
			<tr>
				<td colspan="2">
					[[Your comment (will be send with the recommendation)]]:<br />
					<textarea name="comment" cols="45" rows="5">{$info.comment}</textarea>
				</td>
			</tr>
			{if $isCaptcha == 1}
			<tr>
				<td>[[$captcha.caption]]:</td>
				<td align="right">{input property=$captcha.id}</td>
			</tr>
			{/if}
			<tr>
				<td colspan="2" align="right"><input type="submit" value="[[Send:raw]]" /></td>
			</tr>
		</table>

	</form>
	{/if}
{/if}