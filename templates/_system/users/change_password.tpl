{foreach from=$errors key=error_code item=error_message}

    {if $error_code == 'EMPTY_USERNAME'}
		<p style="color:red;">[[Username is empty]]</p>
    {elseif $error_code == 'EMPTY_VERIFICATION_KEY'}
		<p style="color:red;">[[Verification key is empty]]</p>
    {elseif $error_code == 'WRONG_VERIFICATION_KEY'}
		<p style="color:red;">[[Worng verification key is specified]]</p>
	{elseif $error_code == 'PASSWORD_NOT_CONFIRMED'}
		<p style="color:red;">[[Password is not confirmed or empty]]</p>
	{/if}

{/foreach}

<form method="post">
	<table>
		<tr>
			<td colspan="2">
				<input type="hidden" name="username" value="{$username}" />
				<input type="hidden" name="verification_key" value="{$verification_key}" />
			</td>
		</tr>
		<tr>
			<td>[[FormFieldCaptions!Password]]:</td><td><input type="password" name="password" class="text" /></td>
		</tr>
		<tr>
			<td>[[FormFieldCaptions!Confirm password]]:</td><td><input type="password" name="confirm_password" class="text" /></td>
		</tr>
	    <tr>
			<td>&nbsp;</td><td><input type="submit" name="submit" value="[[Submit:raw]]" class="button" /></td>
		</tr>
	</table>
</form>