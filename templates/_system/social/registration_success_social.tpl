<br/><br/>
[[You have successfully registered on our <a href="{$GLOBALS.site_url}">site</a>]]

<ol>
	<li><a href="{$GLOBALS.site_url}/edit-profile/" title="">[[Take just another moment to provide a few more details on your "Profile" page]]</a></li>
	{if $listingID}
	<li><a href="{$GLOBALS.site_url}/edit-listing/?listing_id={$listingID}" title="">[[Upload/sync your most recent resume from {$socialNetwork}]]</a></li>
	{/if}
</ol>