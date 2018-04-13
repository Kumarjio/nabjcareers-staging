<h1>[[Create New Questionnaire]]</h1>
<p class="error">[[You do not have permissions to add Questionnaires]]</p>
{if !$authorized}
	{module name="users" function="login"}
{/if}