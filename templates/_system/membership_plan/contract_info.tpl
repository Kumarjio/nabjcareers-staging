{if ($error=='NOT_EXECUTED')}
	[[The service was not executed, contact to administrator of the site.]]
{elseif ($error=='NOT_AVAILABLE')}
	[[This service is not available for you.]]
{elseif ($error=='NOT_FOUND')}
	[[This service is not found.]]
{/if}