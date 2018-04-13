{title}Unsubscribe Newsletter{/title}
<h1>Unsubscribe Newsletter</h1>
{if $error eq 'NOT_LOGGED_IN'}
	[[Please log in to unsubscribe newsletter. ]]
	<br/><br/>
	{module name="users" function="login"}
{/if}
