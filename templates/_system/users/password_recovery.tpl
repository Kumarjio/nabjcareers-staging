{foreach from=$errors key=error_code item=error_message}
	{if $error_code == 'WRONG_EMAIL'}
		<p style="color:red;">[[You specified wrong email]]</p>
	{/if}
{/foreach}
[[Please, enter your email in the field below and we'll send you a link to a page where you can change your password]]:
<form method="post" action="">
	<input type="text" name="email" value="{$email}" class="text" />
	<input type="submit" name="submit" value="[[Submit:raw]]" class="button" />
</form>