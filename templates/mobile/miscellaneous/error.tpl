{if $ERROR eq 'NOT_SUBSCRIBE'}
	<p class="error">[[You don't have permissions to access this page.]]</p>
	{if $page_function eq "search_form" or $page_function eq "search_results" or $page_function eq "display_listing"}
		<p class="error">[[You have reached number of views allowed by your subscription.]]</p>
		<br/><a href="javascript: history.back()">[[Back to search results]]</a>
{/if}
{elseif $ERROR eq 'NOT_LOGIN'}
	{assign var="url" value=$GLOBALS.site_url|cat:"/registration/"} 
	<p class="error">[[Please log in to access this page.]]</p>
	<br/><br/>
	{module name="users" function="login"}
{elseif $ERROR eq 'ACCESS_DENIED'}
	<p class="error">[[You don't have permissions to access this page.]]</p>
	<p><a href="#" onclick="history.back()">[[Back]]</a></p>
{/if}